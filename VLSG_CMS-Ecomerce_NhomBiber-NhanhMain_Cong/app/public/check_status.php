<?php
/**
 * Tool tự động kiểm tra và cấu hình minh chứng bài tập B10 & B11
 * Nhà phát triển: Antigravity AI
 * Dự án: Biker Helmet - Nhóm Biber
 */

// Bật thông báo lỗi để tiện debug
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Khởi động WordPress
$wp_load_path = __DIR__ . '/wp-load.php';
if ( ! file_exists( $wp_load_path ) ) {
    die( 'Lỗi: Tệp check_status.php phải được đặt trong thư mục gốc của WordPress (thư mục chứa wp-load.php).' );
}
require_once $wp_load_path;

// Kiểm tra xem người dùng có nhấn nút chạy tự động hay không
$action_status = '';
if ( isset( $_GET['action'] ) && $_GET['action'] === 'autoconfigure' ) {
    $action_status = run_auto_configuration();
}

// ----------------------------------------------------
// HÀM CHẠY CẤU HÌNH TỰ ĐỘNG
// ----------------------------------------------------
function run_auto_configuration() {
    if ( ! class_exists( 'WooCommerce' ) ) {
        return 'error|WooCommerce chưa được kích hoạt. Hãy kích hoạt WooCommerce trước khi chạy cấu hình tự động.';
    }

    $log = array();

    // 1. Cấu hình Vùng vận chuyển (Shipping Zones)
    try {
        // Zone "Nội thành"
        $zone1 = null;
        $zones = WC_Shipping_Zones::get_zones();
        foreach ( $zones as $z ) {
            if ( $z['zone_name'] === 'Nội thành' ) {
                $zone1 = new WC_Shipping_Zone( $z['zone_id'] );
                break;
            }
        }
        if ( ! $zone1 ) {
            $zone1 = new WC_Shipping_Zone();
            $zone1->set_zone_name( 'Nội thành' );
            $zone1->save();
        }
        $methods1 = $zone1->get_shipping_methods();
        $has_flat_rate1 = false;
        foreach ( $methods1 as $m ) {
            if ( $m->id === 'flat_rate' ) {
                $has_flat_rate1 = true;
                update_option( 'woocommerce_flat_rate_' . $m->instance_id . '_settings', array(
                    'title'      => 'Phí vận chuyển Nội thành',
                    'cost'       => '30000',
                    'tax_status' => 'none',
                ) );
                break;
            }
        }
        if ( ! $has_flat_rate1 ) {
            $instance_id = $zone1->add_shipping_method( 'flat_rate' );
            update_option( 'woocommerce_flat_rate_' . $instance_id . '_settings', array(
                'title'      => 'Phí vận chuyển Nội thành',
                'cost'       => '30000',
                'tax_status' => 'none',
            ) );
        }
        $log[] = 'Đã cấu hình vùng vận chuyển "Nội thành" (phí cố định 30.000đ).';

        // Zone "Toàn quốc"
        $zone2 = null;
        foreach ( $zones as $z ) {
            if ( $z['zone_name'] === 'Toàn quốc' ) {
                $zone2 = new WC_Shipping_Zone( $z['zone_id'] );
                break;
            }
        }
        if ( ! $zone2 ) {
            $zone2 = new WC_Shipping_Zone();
            $zone2->set_zone_name( 'Toàn quốc' );
            $zone2->save();
            $zone2->add_location( 'VN', 'country' );
        }
        $methods2 = $zone2->get_shipping_methods();
        $has_flat_rate2 = false;
        foreach ( $methods2 as $m ) {
            if ( $m->id === 'flat_rate' ) {
                $has_flat_rate2 = true;
                update_option( 'woocommerce_flat_rate_' . $m->instance_id . '_settings', array(
                    'title'      => 'Phí vận chuyển Toàn quốc',
                    'cost'       => '50000',
                    'tax_status' => 'none',
                ) );
                break;
            }
        }
        if ( ! $has_flat_rate2 ) {
            $instance_id = $zone2->add_shipping_method( 'flat_rate' );
            update_option( 'woocommerce_flat_rate_' . $instance_id . '_settings', array(
                'title'      => 'Phí vận chuyển Toàn quốc',
                'cost'       => '50000',
                'tax_status' => 'none',
            ) );
        }
        $log[] = 'Đã cấu hình vùng vận chuyển "Toàn quốc" (phí cố định 50.000đ).';
    } catch ( Exception $e ) {
        $log[] = 'Lỗi cấu hình vận chuyển: ' . $e->getMessage();
    }

    // 2. Kích hoạt Cổng thanh toán (Payments)
    try {
        // Kích hoạt COD
        $cod_settings = get_option( 'woocommerce_cod_settings', array() );
        $cod_settings['enabled'] = 'yes';
        update_option( 'woocommerce_cod_settings', $cod_settings );

        // Kích hoạt BACS (Bank Transfer) và tạo tài khoản giả định
        $bacs_settings = get_option( 'woocommerce_bacs_settings', array() );
        $bacs_settings['enabled'] = 'yes';
        update_option( 'woocommerce_bacs_settings', $bacs_settings );

        $accounts = array(
            array(
                'account_name'   => 'NHOM BIBER HELMET',
                'account_number' => '1234567890',
                'bank_name'      => 'Vietcombank',
                'sort_code'      => '',
                'iban'           => '',
                'bic'            => '',
            )
        );
        update_option( 'woocommerce_bacs_accounts', $accounts );
        $log[] = 'Đã kích hoạt thanh toán COD và Chuyển khoản ngân hàng (tài khoản: NHOM BIBER HELMET - Vietcombank).';
    } catch ( Exception $e ) {
        $log[] = 'Lỗi kích hoạt thanh toán: ' . $e->getMessage();
    }

    // 3. Import Sản phẩm từ File_ProductData.csv
    try {
        $csv_file = '';
        $paths_to_try = array(
            __DIR__ . '/File_ProductData.csv',
            __DIR__ . '/../File_ProductData.csv',
            __DIR__ . '/../../File_ProductData.csv',
            __DIR__ . '/../../../File_ProductData.csv'
        );
        foreach ( $paths_to_try as $path ) {
            if ( file_exists( $path ) ) {
                $csv_file = $path;
                break;
            }
        }

        if ( empty( $csv_file ) ) {
            $log[] = 'Cảnh báo: Không tìm thấy tệp File_ProductData.csv. Không thể tự động nhập sản phẩm.';
        } else {
            $file = fopen( $csv_file, 'r' );
            $headers = fgetcsv( $file );
            $imported_count = 0;
            $skipped_count = 0;

            while ( ( $row = fgetcsv( $file ) ) !== false ) {
                // Đảm bảo số lượng phần tử khớp nhau
                if ( count( $row ) !== count( $headers ) ) {
                    continue;
                }
                $data = array_combine( $headers, $row );
                $sku = $data['SKU'];

                // Kiểm tra xem sản phẩm đã tồn tại chưa
                $product_id = wc_get_product_id_by_sku( $sku );
                if ( ! $product_id ) {
                    $post_id = wp_insert_post( array(
                        'post_title'   => $data['Name'],
                        'post_content' => $data['Description'],
                        'post_excerpt' => $data['Short description'],
                        'post_status'  => 'publish',
                        'post_type'    => 'product',
                    ) );

                    if ( $post_id ) {
                        $product = wc_get_product( $post_id );
                        $product->set_sku( $sku );
                        $product->set_regular_price( $data['Regular price'] );
                        $product->set_weight( $data['Weight (kg)'] );
                        $product->set_manage_stock( true );
                        $product->set_stock_quantity( $data['Stock'] );
                        $product->set_stock_status( $data['In stock?'] ? 'instock' : 'outofstock' );
                        $product->set_reviews_allowed( $data['Allow customer reviews?'] );

                        // Thêm danh mục
                        $categories = explode( '>', $data['Categories'] );
                        $cat_ids = array();
                        foreach ( $categories as $cat ) {
                            $cat = trim( $cat );
                            $term = term_exists( $cat, 'product_cat' );
                            if ( ! $term ) {
                                $term = wp_insert_term( $cat, 'product_cat' );
                            }
                            if ( ! is_wp_error( $term ) ) {
                                $cat_ids[] = (int) $term['term_id'];
                            }
                        }
                        if ( ! empty( $cat_ids ) ) {
                            wp_set_object_terms( $post_id, $cat_ids, 'product_cat' );
                        }

                        // Sideload ảnh mẫu
                        if ( ! empty( $data['Images'] ) ) {
                            try {
                                require_once( ABSPATH . 'wp-admin/includes/media.php' );
                                require_once( ABSPATH . 'wp-admin/includes/file.php' );
                                require_once( ABSPATH . 'wp-admin/includes/image.php' );
                                $img_id = media_sideload_image( $data['Images'], $post_id, $data['Name'], 'id' );
                                if ( ! is_wp_error( $img_id ) ) {
                                    set_post_thumbnail( $post_id, $img_id );
                                }
                            } catch ( Exception $e ) {
                                // Bỏ qua nếu tải ảnh lỗi
                            }
                        }

                        $product->save();
                        $imported_count++;
                    }
                } else {
                    $skipped_count++;
                }
            }
            fclose( $file );
            $log[] = "Đã nhập thêm $imported_count sản phẩm mới từ tệp CSV (đã bỏ qua $skipped_count sản phẩm trùng lặp).";
        }
    } catch ( Exception $e ) {
        $log[] = 'Lỗi nhập sản phẩm: ' . $e->getMessage();
    }

    // 4. Soạn thảo và Lên lịch đăng 2 bài viết SEO
    try {
        $seo_posts = array(
            array(
                'title'       => 'Hướng Dẫn Cách Chọn Mũ Bảo Hiểm Fullface Phù Hợp Cho Người Đi Phượt',
                'keyword'     => 'chọn mũ bảo hiểm fullface',
                'description' => 'Bạn đang tìm mua mũ bảo hiểm cho chuyến phượt xa? Xem ngay hướng dẫn chọn mũ bảo hiểm fullface an toàn, chuẩn size và phù hợp ngân sách tại đây!',
                'content'     => 'Đối với những tín đồ đam mê xê dịch và tốc độ, một chiếc mũ bảo hiểm chất lượng không chỉ là vật trang trí mà còn là chiếc "lá chắn" bảo vệ tính mạng. Trong các dòng mũ, dòng fullface mang lại độ an toàn tối đa. Tuy nhiên, làm thế nào để chọn mũ bảo hiểm fullface phù hợp và chuẩn nhất? Hãy cùng tìm hiểu chi tiết qua bài viết dưới đây.<br><br><h2>1. Tại sao dân phượt nên chọn mũ bảo hiểm fullface?</h2>Khác với các loại mũ nửa đầu hay mũ 3/4, mũ bảo hiểm fullface bảo vệ toàn bộ vùng đầu, mặt, cằm và gáy của người sử dụng. Theo các nghiên cứu an toàn giao thông, vùng cằm là nơi dễ chịu tổn thương nhất khi xảy ra va chạm (chiếm tới 35% các ca chấn thương vùng mặt). Do đó, việc sở hữu một chiếc mũ trùm kín đầu là cực kỳ quan trọng cho các hành trình dài.<br><br><h2>2. Tiêu chí quan trọng khi chọn mũ bảo hiểm fullface</h2>Để chọn được chiếc mũ vừa vặn, hãy chú ý các chứng chỉ an toàn như ECE 22.06 hay DOT. Ngoài ra vỏ mũ nên làm bằng nhựa ABS nguyên sinh hoặc sợi Carbon siêu nhẹ để giảm mỏi cổ khi đi xa.'
            ),
            array(
                'title'       => 'Top Thương Hiệu Mũ Bảo Hiểm 3/4 Được Ưa Chuộng Nhất Hiện Nay',
                'keyword'     => 'mũ bảo hiểm 3/4',
                'description' => 'Bạn đang phân vân chọn mua mũ bảo hiểm 3/4 đi phố? Khám phá ngay danh sách các thương hiệu mũ bảo hiểm 3/4 chất lượng, bền bỉ và thời trang nhất!',
                'content'     => 'Bên cạnh các dòng mũ trùm kín đầu thì mũ bảo hiểm 3/4 là sự kết hợp hoàn hảo giữa độ an toàn vượt trội và sự thoải mái, thông thoáng khi di chuyển trong đô thị. Nhờ thiết kế trẻ trung, năng động, dòng mũ này đang trở thành xu hướng hàng đầu của giới trẻ hiện nay.<br><br><h2>1. Ưu điểm nổi bật của mũ bảo hiểm 3/4 khi đi phố</h2>Mũ bảo hiểm 3/4 giúp bảo vệ 75% vùng đầu bao gồm tai và sau gáy, giúp bạn yên tâm hơn so với các dòng mũ nửa đầu thông thường mà vẫn rất thông thoáng khi dừng đèn đỏ.<br><br><h2>2. Các thương hiệu nổi tiếng</h2>Bạn có thể chọn mua các mẫu mũ bảo hiểm 3/4 đến từ thương hiệu KYT (phong cách MotoGP), LS2 (thương hiệu Tây Ban Nha), hoặc Bulldog (phong cách cổ điển vintage cực kỳ tinh tế).'
            )
        );

        $post_scheduled_count = 0;
        foreach ( $seo_posts as $idx => $p ) {
            $existing = get_page_by_title( $p['title'], OBJECT, 'post' );
            if ( ! $existing ) {
                $days = $idx === 0 ? '+2 days' : '+4 days';
                $post_id = wp_insert_post( array(
                    'post_title'   => $p['title'],
                    'post_content' => $p['content'],
                    'post_status'  => 'future',
                    'post_date'    => date( 'Y-m-d H:i:s', strtotime( $days ) ),
                    'post_type'    => 'post',
                ) );

                if ( $post_id ) {
                    // Cập nhật thẻ meta cho Yoast SEO & RankMath
                    update_post_meta( $post_id, '_yoast_wpseo_focuskw', $p['keyword'] );
                    update_post_meta( $post_id, '_yoast_wpseo_metadesc', $p['description'] );
                    update_post_meta( $post_id, 'rank_math_focus_keyword', $p['keyword'] );
                    update_post_meta( $post_id, 'rank_math_description', $p['description'] );
                    $post_scheduled_count++;
                }
            }
        }
        $log[] = "Đã lên lịch thành công $post_scheduled_count bài viết SEO ở trạng thái Scheduled (lần lượt sau 2 ngày và 4 ngày).";
    } catch ( Exception $e ) {
        $log[] = 'Lỗi lên lịch bài viết SEO: ' . $e->getMessage();
    }

    return 'success|' . implode( '<br>✔️ ', $log );
}

// ----------------------------------------------------
// THU THẬP THÔNG TIN TRẠNG THÁI HIỆN TẠI
// ----------------------------------------------------
$woo_active = class_exists( 'WooCommerce' );
$products_count = 0;
$shipping_configured = false;
$shipping_zones_details = array();
$payment_cod_active = false;
$payment_bacs_active = false;
$bacs_account_info = '';
$seo_posts_scheduled = array();

if ( $woo_active ) {
    // 1. Số lượng sản phẩm
    $products_count = wp_count_posts( 'product' )->publish;

    // 2. Kiểm tra Shipping Zones
    $zones = WC_Shipping_Zones::get_zones();
    $has_noi_thanh = false;
    $has_toan_quoc = false;
    foreach ( $zones as $z ) {
        $methods = $z['shipping_methods'];
        $details = array();
        foreach ( $methods as $m ) {
            if ( $m->id === 'flat_rate' ) {
                $details[] = $m->title . ' (' . number_format( (float) $m->cost, 0, ',', '.' ) . 'đ)';
            }
        }

        if ( $z['zone_name'] === 'Nội thành' ) {
            $has_noi_thanh = true;
            $shipping_zones_details[] = 'Vùng "Nội thành": ' . ( empty( $details ) ? 'Chưa có Flat rate' : implode( ', ', $details ) );
        } elseif ( $z['zone_name'] === 'Toàn quốc' ) {
            $has_toan_quoc = true;
            $shipping_zones_details[] = 'Vùng "Toàn quốc": ' . ( empty( $details ) ? 'Chưa có Flat rate' : implode( ', ', $details ) );
        }
    }
    if ( $has_noi_thanh && $has_toan_quoc ) {
        $shipping_configured = true;
    }

    // 3. Kiểm tra Payments
    $gateways = WC()->payment_gateways->payment_gateways();
    if ( isset( $gateways['cod'] ) && $gateways['cod']->enabled === 'yes' ) {
        $payment_cod_active = true;
    }
    if ( isset( $gateways['bacs'] ) && $gateways['bacs']->enabled === 'yes' ) {
        $payment_bacs_active = true;
        // Lấy thông tin tài khoản ngân hàng
        $accounts = get_option( 'woocommerce_bacs_accounts', array() );
        if ( ! empty( $accounts ) ) {
            $acc = $accounts[0];
            $bacs_account_info = 'Ngân hàng: ' . $acc['bank_name'] . ' - STK: ' . $acc['account_number'] . ' - Chủ TK: ' . $acc['account_name'];
        }
    }
}

// 4. Kiểm tra bài viết SEO Scheduled
$scheduled_posts = get_posts( array(
    'post_status' => 'future',
    'post_type'   => 'post',
    'numberposts' => -1
) );
foreach ( $scheduled_posts as $post ) {
    $seo_posts_scheduled[] = $post->post_title . ' (Lên lịch lúc: ' . get_the_date( 'd-m-Y H:i', $post->ID ) . ')';
}
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Biber Helmet - Kiểm Tra & Cấu Hình Tự Động Minh Chứng</title>
    <style>
        :root {
            --primary: #FF416C;
            --primary-bg: #1a1a2e;
            --card-bg: rgba(255, 255, 255, 0.05);
            --success: #2ec4b6;
            --warning: #ffb703;
            --danger: #e63946;
        }

        body {
            font-family: 'Outfit', 'Inter', -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, sans-serif;
            background: linear-gradient(135deg, #0f0c20 0%, #15102a 50%, #1a0f30 100%);
            color: #f1f3f5;
            margin: 0;
            padding: 40px 20px;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }

        .container {
            max-width: 850px;
            width: 100%;
            background: rgba(25, 20, 45, 0.65);
            border-radius: 24px;
            box-shadow: 0 20px 50px rgba(0, 0, 0, 0.5);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.08);
            padding: 40px;
            box-sizing: border-box;
        }

        h1 {
            text-align: center;
            background: linear-gradient(90deg, #FF416C 0%, #FF4B2B 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            font-size: 32px;
            font-weight: 800;
            margin-top: 0;
            margin-bottom: 8px;
            letter-spacing: -0.5px;
        }

        .subtitle {
            text-align: center;
            color: #a0aec0;
            font-size: 16px;
            margin-bottom: 40px;
        }

        .notification {
            padding: 20px;
            border-radius: 16px;
            margin-bottom: 30px;
            font-size: 15px;
            line-height: 1.6;
        }

        .notification-success {
            background: rgba(46, 196, 182, 0.15);
            border: 1px solid var(--success);
            color: #c9f5f1;
        }

        .notification-error {
            background: rgba(230, 57, 70, 0.15);
            border: 1px solid var(--danger);
            color: #ffccd5;
        }

        .grid-cards {
            display: grid;
            grid-template-columns: 1fr;
            gap: 20px;
            margin-bottom: 40px;
        }

        @media (min-width: 600px) {
            .grid-cards {
                grid-template-columns: 1fr 1fr;
            }
        }

        .card {
            background: var(--card-bg);
            border-radius: 18px;
            padding: 24px;
            border: 1px solid rgba(255, 255, 255, 0.05);
            transition: all 0.3s ease;
        }

        .card:hover {
            transform: translateY(-4px);
            border-color: rgba(255, 65, 108, 0.3);
            box-shadow: 0 10px 25px rgba(255, 65, 108, 0.15);
        }

        .card-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 16px;
        }

        .card-title {
            font-size: 18px;
            font-weight: 700;
            color: #ffffff;
        }

        .badge {
            font-size: 12px;
            font-weight: 700;
            padding: 6px 12px;
            border-radius: 20px;
            text-transform: uppercase;
        }

        .badge-success {
            background: rgba(46, 196, 182, 0.2);
            color: var(--success);
            border: 1px solid var(--success);
        }

        .badge-danger {
            background: rgba(230, 57, 70, 0.2);
            color: var(--danger);
            border: 1px solid var(--danger);
        }

        .card-desc {
            font-size: 14px;
            color: #cbd5e0;
            line-height: 1.5;
        }

        .card-desc ul {
            margin: 8px 0 0 0;
            padding-left: 20px;
            color: #a0aec0;
        }

        .btn-container {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 16px;
            margin-bottom: 40px;
        }

        .btn {
            background: linear-gradient(90deg, #FF416C 0%, #FF4B2B 100%);
            border: none;
            color: white;
            padding: 16px 36px;
            font-size: 16px;
            font-weight: 700;
            border-radius: 50px;
            cursor: pointer;
            box-shadow: 0 10px 20px rgba(255, 65, 108, 0.3);
            transition: all 0.3s ease;
            text-decoration: none;
            text-align: center;
        }

        .btn:hover {
            transform: scale(1.03);
            box-shadow: 0 15px 30px rgba(255, 65, 108, 0.5);
        }

        .quick-links {
            background: rgba(255, 255, 255, 0.02);
            border-radius: 16px;
            padding: 24px;
            border: 1px solid rgba(255, 255, 255, 0.04);
        }

        .quick-links h3 {
            margin-top: 0;
            margin-bottom: 16px;
            font-size: 16px;
            color: #ffffff;
            font-weight: 700;
        }

        .link-list {
            display: flex;
            flex-wrap: wrap;
            gap: 12px;
        }

        .quick-link {
            background: rgba(255, 255, 255, 0.05);
            color: #cbd5e0;
            padding: 10px 18px;
            border-radius: 8px;
            font-size: 13px;
            text-decoration: none;
            border: 1px solid rgba(255, 255, 255, 0.08);
            transition: all 0.2s ease;
        }

        .quick-link:hover {
            background: rgba(255, 255, 255, 0.1);
            color: #ffffff;
            border-color: rgba(255, 255, 255, 0.2);
        }

        .evidence-guide {
            margin-top: 30px;
            font-size: 14px;
            background: rgba(255, 183, 3, 0.05);
            border: 1px solid rgba(255, 183, 3, 0.2);
            border-radius: 12px;
            padding: 20px;
            line-height: 1.6;
        }

        .evidence-guide strong {
            color: var(--warning);
        }
    </style>
</head>
<body>

<div class="container">
    <h1>Biker Helmet Dashboard</h1>
    <div class="subtitle">Trình kiểm tra &amp; Tự động cấu hình bài tập B10 / B11</div>

    <?php if ( ! empty( $action_status ) ) : 
        $parts = explode( '|', $action_status, 2 );
        $type = $parts[0];
        $msg = $parts[1];
    ?>
        <div class="notification <?php echo $type === 'success' ? 'notification-success' : 'notification-error'; ?>">
            <strong><?php echo $type === 'success' ? '✔️ Thành công:' : '❌ Có lỗi xảy ra:'; ?></strong><br>
            <?php echo $msg; ?>
        </div>
    <?php endif; ?>

    <div class="grid-cards">
        <!-- 1. Trạng thái WooCommerce -->
        <div class="card">
            <div class="card-header">
                <div class="card-title">WooCommerce</div>
                <span class="badge <?php echo $woo_active ? 'badge-success' : 'badge-danger'; ?>">
                    <?php echo $woo_active ? 'Đã kích hoạt' : 'Chưa có'; ?>
                </span>
            </div>
            <div class="card-desc">
                Plugin cốt lõi để xây dựng tính năng bán hàng và thanh toán trên website.
            </div>
        </div>

        <!-- 2. Số lượng sản phẩm -->
        <div class="card">
            <div class="card-header">
                <div class="card-title">Số lượng sản phẩm</div>
                <span class="badge <?php echo $products_count >= 20 ? 'badge-success' : 'badge-danger'; ?>">
                    <?php echo $products_count >= 20 ? 'Đạt' : 'Chưa đạt'; ?>
                </span>
            </div>
            <div class="card-desc">
                Yêu cầu: tối thiểu 20 sản phẩm.<br>
                <strong>Hiện tại: <?php echo $products_count; ?> sản phẩm.</strong>
            </div>
        </div>

        <!-- 3. Phí vận chuyển -->
        <div class="card">
            <div class="card-header">
                <div class="card-title">Shipping Zones</div>
                <span class="badge <?php echo $shipping_configured ? 'badge-success' : 'badge-danger'; ?>">
                    <?php echo $shipping_configured ? 'Đã cấu hình' : 'Chưa đạt'; ?>
                </span>
            </div>
            <div class="card-desc">
                Yêu cầu: Nội thành (30k VND) &amp; Toàn quốc (50k VND).
                <?php if ( ! empty( $shipping_zones_details ) ) : ?>
                    <ul>
                        <?php foreach ( $shipping_zones_details as $detail ) : ?>
                            <li><?php echo $detail; ?></li>
                        <?php endforeach; ?>
                    </ul>
                <?php endif; ?>
            </div>
        </div>

        <!-- 4. Phương thức thanh toán -->
        <div class="card">
            <div class="card-header">
                <div class="card-title">Cổng thanh toán</div>
                <span class="badge <?php echo ( $payment_cod_active && $payment_bacs_active ) ? 'badge-success' : 'badge-danger'; ?>">
                    <?php echo ( $payment_cod_active && $payment_bacs_active ) ? 'Sẵn sàng' : 'Thiếu cấu hình'; ?>
                </span>
            </div>
            <div class="card-desc">
                Yêu cầu: Thanh toán COD &amp; Chuyển khoản ngân hàng (có STK).<br>
                COD: <?php echo $payment_cod_active ? '✔️ Bật' : '❌ Tắt'; ?><br>
                Chuyển khoản: <?php echo $payment_bacs_active ? '✔️ Bật' : '❌ Tắt'; ?><br>
                <small style="color: #a0aec0;"><?php echo $bacs_account_info; ?></small>
            </div>
        </div>

        <!-- 5. Bài viết SEO -->
        <div class="card" style="grid-column: 1 / -1;">
            <div class="card-header">
                <div class="card-title">Bài viết SEO (Cấu trúc Silo)</div>
                <span class="badge <?php echo count( $seo_posts_scheduled ) >= 2 ? 'badge-success' : 'badge-danger'; ?>">
                    <?php echo count( $seo_posts_scheduled ) >= 2 ? 'Đạt' : 'Chưa đủ bài'; ?>
                </span>
            </div>
            <div class="card-desc">
                Yêu cầu: Viết 2 bài chuẩn SEO cấu trúc Silo, ở trạng thái <strong>"Scheduled" (Lên lịch)</strong>.
                <?php if ( ! empty( $seo_posts_scheduled ) ) : ?>
                    <ul>
                        <?php foreach ( $seo_posts_scheduled as $post ) : ?>
                            <li><?php echo $post; ?></li>
                        <?php endforeach; ?>
                    </ul>
                <?php else : ?>
                    <br><em>Hiện chưa có bài viết nào đang ở trạng thái Lên lịch (Scheduled).</em>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <div class="btn-container">
        <a href="?action=autoconfigure" class="btn">👉 CLICK ĐỂ TỰ ĐỘNG CẤU HÌNH TẤT CẢ (AUTO-CONFIGURE ALL) 👈</a>
        <div style="font-size: 13px; color: #a0aec0;">*Nút bấm sẽ tự động thêm 21 sản phẩm từ CSV, tạo 2 vùng vận chuyển, kích hoạt COD + STK ngân hàng và lên lịch 2 bài viết SEO.</div>
    </div>

    <div class="quick-links">
        <h3>Đường dẫn quản trị nhanh (Quick Links)</h3>
        <div class="link-list">
            <a href="/wp-admin/edit.php?post_type=product" target="_blank" class="quick-link">📦 Quản trị sản phẩm (Products)</a>
            <a href="/wp-admin/admin.php?page=wc-settings&tab=shipping" target="_blank" class="quick-link">🚚 Thiết lập Vận chuyển (Shipping)</a>
            <a href="/wp-admin/admin.php?page=wc-settings&tab=checkout" target="_blank" class="quick-link">💳 Thiết lập Thanh toán (Payments)</a>
            <a href="/wp-admin/edit.php?post_status=future&post_type=post" target="_blank" class="quick-link">📰 Quản trị bài viết Scheduled</a>
            <a href="/shop" target="_blank" class="quick-link">🛒 Xem Cửa hàng (Shop)</a>
            <a href="/checkout" target="_blank" class="quick-link">💳 Đi tới Thanh toán (Checkout)</a>
        </div>
    </div>

    <div class="evidence-guide">
        <strong>⚠️ Hướng dẫn chụp ảnh minh chứng:</strong><br>
        1. Click vào link <strong>"Quản trị sản phẩm (Products)"</strong>, chụp lại danh sách sản phẩm hiển thị góc trên có số lượng `All (21)` và lưu tên tệp là <strong>`Anh_ProductList.png`</strong>.<br>
        2. Truy cập trang <strong>"Đi tới Thanh toán (Checkout)"</strong> (đã bỏ 1 sản phẩm vào giỏ), điền địa chỉ để kích hoạt phí vận chuyển tương ứng, chụp ảnh màn hình phần phương thức thanh toán hiển thị rõ cả COD và Chuyển khoản Vietcombank, lưu tên tệp là <strong>`Anh_PaymentMethods.png`</strong>.<br>
        3. Copy tệp <strong>`File_ProductData.csv`</strong> trong thư mục dự án và 2 ảnh chụp trên bỏ vào 1 thư mục rồi nén lại thành <strong>`Nhom[X]_Buoi11_[TenDoAn].zip`</strong> để nộp bài B11.
    </div>
</div>

</body>
</html>
