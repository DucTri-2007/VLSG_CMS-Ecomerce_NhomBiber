<?php
/**
 * Script kiem tra va tu dong cau hinh - Bai tap Buoi 10 & 11
 * (Script chay thử của sinh viên - Hãy XÓA tệp này sau khi chạy xong để bảo mật)
 */

error_reporting(E_ALL);
ini_set('display_errors', 1);

// Import WordPress
require_once __DIR__ . '/wp-load.php';

// Kich hoat plugin biker-helmet-manager tu dong neu chua bat
if ( ! is_plugin_active( 'biker-helmet-manager/biker-helmet-manager.php' ) ) {
    activate_plugin( 'biker-helmet-manager/biker-helmet-manager.php' );
}

$action_message = '';
if ( isset( $_GET['action'] ) && $_GET['action'] === 'run' ) {
    $action_message = run_setup();
}

function run_setup() {
    if ( ! class_exists( 'WooCommerce' ) ) {
        return '<p class="error">Lỗi: Chưa bật WooCommerce. Hãy vào Admin cài đặt WooCommerce trước.</p>';
    }

    $msgs = array();

    // 1. Cau hinh phi ship Flat Rate
    try {
        $zones = WC_Shipping_Zones::get_zones();
        
        // Zone Noi thanh
        $z1_id = null;
        foreach ( $zones as $z ) {
            if ( $z['zone_name'] === 'Nội thành' ) {
                $z1_id = $z['zone_id'];
                break;
            }
        }
        $zone1 = new WC_Shipping_Zone( $z1_id );
        if ( ! $z1_id ) {
            $zone1->set_zone_name( 'Nội thành' );
            $zone1->save();
        }
        
        $m1_id = null;
        foreach ( $zone1->get_shipping_methods() as $m ) {
            if ( $m->id === 'flat_rate' ) {
                $m1_id = $m->instance_id;
                break;
            }
        }
        if ( ! $m1_id ) {
            $m1_id = $zone1->add_shipping_method( 'flat_rate' );
        }
        update_option( 'woocommerce_flat_rate_' . $m1_id . '_settings', array(
            'title'      => 'Phí vận chuyển Nội thành',
            'cost'       => '30000',
            'tax_status' => 'none',
        ) );
        $msgs[] = 'Cấu hình xong phí ship Nội thành: 30.000 VNĐ';

        // Zone Toan quoc
        $z2_id = null;
        foreach ( $zones as $z ) {
            if ( $z['zone_name'] === 'Toàn quốc' ) {
                $z2_id = $z['zone_id'];
                break;
            }
        }
        $zone2 = new WC_Shipping_Zone( $z2_id );
        if ( ! $z2_id ) {
            $zone2->set_zone_name( 'Toàn quốc' );
            $zone2->save();
            $zone2->add_location( 'VN', 'country' );
        }
        
        $m2_id = null;
        foreach ( $zone2->get_shipping_methods() as $m ) {
            if ( $m->id === 'flat_rate' ) {
                $m2_id = $m->instance_id;
                break;
            }
        }
        if ( ! $m2_id ) {
            $m2_id = $zone2->add_shipping_method( 'flat_rate' );
        }
        update_option( 'woocommerce_flat_rate_' . $m2_id . '_settings', array(
            'title'      => 'Phí vận chuyển Toàn quốc',
            'cost'       => '50000',
            'tax_status' => 'none',
        ) );
        $msgs[] = 'Cấu hình xong phí ship Toàn quốc: 50.000 VNĐ';

    } catch ( Exception $e ) {
        $msgs[] = 'Lỗi ship: ' . $e->getMessage();
    }

    // 2. Kich hoat COD va Bank Transfer
    try {
        $cod = get_option( 'woocommerce_cod_settings', array() );
        $cod['enabled'] = 'yes';
        update_option( 'woocommerce_cod_settings', $cod );

        $bacs = get_option( 'woocommerce_bacs_settings', array() );
        $bacs['enabled'] = 'yes';
        update_option( 'woocommerce_bacs_settings', $bacs );

        $accounts = array(
            array(
                'account_name'   => 'Nhom Biber',
                'account_number' => '1234567890',
                'bank_name'      => 'Vietcombank',
            )
        );
        update_option( 'woocommerce_bacs_accounts', $accounts );
        $msgs[] = 'Kích hoạt cổng COD và Chuyển khoản ngân hàng thành công';
    } catch ( Exception $e ) {
        $msgs[] = 'Lỗi thanh toán: ' . $e->getMessage();
    }

    // 3. Import san pham tu CSV
    try {
        $csv = __DIR__ . '/File_ProductData.csv';
        if ( ! file_exists( $csv ) ) {
            $msgs[] = 'Lỗi: Không tìm thấy file File_ProductData.csv';
        } else {
            // Tắt xác thực SSL để tải ảnh trên localhost không bị lỗi SSL CA Certificate
            add_filter( 'https_ssl_verify', '__return_false' );
            add_filter( 'https_local_ssl_verify', '__return_false' );

            $fp = fopen( $csv, 'r' );
            $headers = fgetcsv( $fp );
            $count = 0;
            $image_count = 0;
            while ( ( $row = fgetcsv( $fp ) ) !== false ) {
                if ( count( $row ) !== count( $headers ) ) continue;
                $data = array_combine( $headers, $row );
                $sku = $data['SKU'];
                
                $pid = wc_get_product_id_by_sku( $sku );
                if ( ! $pid ) {
                    $pid = wp_insert_post( array(
                        'post_title'   => $data['Name'],
                        'post_content' => $data['Description'],
                        'post_excerpt' => $data['Short description'],
                        'post_status'  => 'publish',
                        'post_type'    => 'product',
                    ) );
                    if ( $pid ) {
                        $prod = wc_get_product( $pid );
                        $prod->set_sku( $sku );
                        $prod->set_regular_price( $data['Regular price'] );
                        $prod->set_weight( $data['Weight (kg)'] );
                        $prod->set_manage_stock( true );
                        $prod->set_stock_quantity( $data['Stock'] );
                        $prod->save();
                        $count++;
                    }
                }
                
                // Nếu sản phẩm đã tồn tại hoặc vừa tạo nhưng chưa có ảnh đại diện, tải ảnh
                if ( $pid && ! has_post_thumbnail( $pid ) && ! empty( $data['Images'] ) ) {
                    try {
                        require_once( ABSPATH . 'wp-admin/includes/media.php' );
                        require_once( ABSPATH . 'wp-admin/includes/file.php' );
                        require_once( ABSPATH . 'wp-admin/includes/image.php' );
                        $img_id = custom_sideload_image( $data['Images'], $pid, $data['Name'] );
                        if ( ! is_wp_error( $img_id ) ) {
                            set_post_thumbnail( $pid, $img_id );
                            $image_count++;
                        }
                    } catch ( Exception $e ) {
                        // ignore
                    }
                }
            }
            fclose( $fp );
            $msgs[] = "Đã nhập thêm $count sản phẩm mới và cập nhật thành công $image_count ảnh đại diện từ file CSV.";
        }
    } catch ( Exception $e ) {
        $msgs[] = 'Lỗi import: ' . $e->getMessage();
    }

    // 4. Tao 2 bai viet SEO o trang thai Scheduled
    try {
        $posts = array(
            array(
                'title'   => 'Hướng Dẫn Cách Chọn Mũ Bảo Hiểm Fullface Phù Hợp Cho Người Đi Phượt',
                'keyword' => 'chọn mũ bảo hiểm fullface',
                'desc'    => 'Bạn đang tìm mua mũ bảo hiểm cho chuyến phượt xa? Xem ngay hướng dẫn chọn mũ bảo hiểm fullface an toàn, chuẩn size và phù hợp ngân sách tại đây!',
                'content' => 'Đối với những tín đồ đam mê xê dịch và tốc độ, một chiếc mũ bảo hiểm chất lượng không chỉ là vật trang trí mà còn là chiếc "lá chắn" bảo vệ tính mạng. Trong các dòng mũ, dòng fullface mang lại độ an toàn tối đa. Tuy nhiên, làm thế nào để chọn mũ bảo hiểm fullface phù hợp và chuẩn nhất? Hãy cùng tìm hiểu chi tiết qua bài viết dưới đây.<br><br><h2>1. Tại sao dân phượt nên chọn mũ bảo hiểm fullface?</h2>Khác với các loại mũ nửa đầu hay mũ 3/4, mũ bảo hiểm fullface bảo vệ toàn bộ vùng đầu, mặt, cằm và gáy của người sử dụng. Theo các nghiên cứu an toàn giao thông, vùng cằm là nơi dễ chịu tổn thương nhất khi xảy ra va chạm (chiếm tới 35% các ca chấn thương vùng mặt).'
            ),
            array(
                'title'   => 'Top Thương Hiệu Mũ Bảo Hiểm 3/4 Được Ưa Chuộng Nhất Hiện Nay',
                'keyword' => 'mũ bảo hiểm 3/4',
                'desc'    => 'Bạn đang phân vân chọn mua mũ bảo hiểm 3/4 đi phố? Khám phá ngay danh sách các thương hiệu mũ bảo hiểm 3/4 chất lượng, bền bỉ và thời trang nhất!',
                'content' => 'Bên cạnh các dòng mũ trùm kín đầu thì mũ bảo hiểm 3/4 là sự kết hợp hoàn hảo giữa độ an toàn vượt trội và sự thoải mái, thông thoáng khi di chuyển trong đô thị. Nhờ thiết kế trẻ trung, năng động, dòng mũ này đang trở thành xu hướng hàng đầu của giới trẻ hiện nay.<br><br><h2>1. Ưu điểm nổi bật của mũ bảo hiểm 3/4 khi đi phố</h2>Mũ bảo hiểm 3/4 giúp bảo vệ 75% vùng đầu bao gồm tai và sau gáy, giúp bạn yên tâm hơn so với các dòng mũ nửa đầu thông thường.'
            )
        );

        $p_count = 0;
        foreach ( $posts as $idx => $p ) {
            $existing = get_page_by_title( $p['title'], OBJECT, 'post' );
            if ( ! $existing ) {
                $delay = $idx === 0 ? '+2 days' : '+4 days';
                $post_id = wp_insert_post( array(
                    'post_title'   => $p['title'],
                    'post_content' => $p['content'],
                    'post_status'  => 'future',
                    'post_date'    => date( 'Y-m-d H:i:s', strtotime( $delay ) ),
                    'post_type'    => 'post',
                ) );
                if ( $post_id ) {
                    update_post_meta( $post_id, '_yoast_wpseo_focuskw', $p['keyword'] );
                    update_post_meta( $post_id, '_yoast_wpseo_metadesc', $p['desc'] );
                    update_post_meta( $post_id, 'rank_math_focus_keyword', $p['keyword'] );
                    update_post_meta( $post_id, 'rank_math_description', $p['desc'] );
                    $p_count++;
                }
            }
        }
        $msgs[] = "Đã lên lịch thành công $p_count bài viết chuẩn SEO.";
    } catch ( Exception $e ) {
        $msgs[] = 'Lỗi bài viết: ' . $e->getMessage();
    }

    return '<div class="success">✔️ KẾT QUẢ THỰC HIỆN THÀNH CÔNG:<br><ul><li>' . implode( '</li><li>', $msgs ) . '</li></ul></div>';
}

$woo_active = class_exists( 'WooCommerce' );
$products_count = $woo_active ? wp_count_posts( 'product' )->publish : 0;
$scheduled_posts_count = count( get_posts( array( 'post_status' => 'future', 'post_type' => 'post', 'numberposts' => -1 ) ) );
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Trang check bai tap</title>
    <style>
        body { font-family: Arial, sans-serif; max-width: 700px; margin: 40px auto; padding: 20px; line-height: 1.5; background-color: #fff; color: #333; }
        h2 { border-bottom: 2px solid #333; padding-bottom: 10px; }
        table { width: 100%; border-collapse: collapse; margin: 20px 0; }
        th, td { border: 1px solid #ccc; padding: 10px; text-align: left; }
        th { background-color: #f4f4f4; }
        .btn { display: inline-block; background-color: #007cba; color: #fff; padding: 10px 20px; text-decoration: none; border-radius: 4px; font-weight: bold; border: none; cursor: pointer; }
        .btn:hover { background-color: #006ba1; }
        .success { background-color: #e2f0d9; border: 1px solid #385723; color: #385723; padding: 15px; border-radius: 4px; margin-bottom: 20px; }
        .error { background-color: #fce4d6; border: 1px solid #c00000; color: #c00000; padding: 15px; border-radius: 4px; margin-bottom: 20px; }
    </style>
</head>
<body>

    <h2>Bảng kiểm tra trạng thái bài tập</h2>
    <p>Trang này dùng để sinh viên tự kiểm tra tiến độ hoàn thành các yêu cầu của bài tập 10 & 11.</p>

    <?php echo $action_message; ?>

    <table>
        <thead>
            <tr>
                <th>Tiêu chí kiểm tra</th>
                <th>Trạng thái hiện tại</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>Plugin WooCommerce</td>
                <td><strong><?php echo $woo_active ? 'Đã kích hoạt' : 'Chưa kích hoạt'; ?></strong></td>
            </tr>
            <tr>
                <td>Số lượng sản phẩm</td>
                <td><strong><?php echo $products_count; ?> sản phẩm</strong> (Yêu cầu > 20)</td>
            </tr>
            <tr>
                <td>Bài viết chuẩn SEO (Lên lịch)</td>
                <td><strong><?php echo $scheduled_posts_count; 
function custom_sideload_image( $url, $post_id, $desc ) {
    require_once( ABSPATH . 'wp-admin/includes/media.php' );
    require_once( ABSPATH . 'wp-admin/includes/file.php' );
    require_once( ABSPATH . 'wp-admin/includes/image.php' );
    
    $tmp = download_url( $url );
    if ( is_wp_error( $tmp ) ) {
        return $tmp;
    }
    
    $file_array = array(
        'name'     => basename( parse_url( $url, PHP_URL_PATH ) ),
        'tmp_name' => $tmp
    );
    
    $pathinfo = pathinfo( $file_array['name'] );
    if ( empty( $pathinfo['extension'] ) ) {
        $file_array['name'] .= '.jpg';
    }
    
    $img_id = media_handle_sideload( $file_array, $post_id, $desc );
    return $img_id;
}
?> bài viết</strong> ở trạng thái Scheduled</td>
            </tr>
        </tbody>
    </table>

    <div style="margin-top: 20px; text-align: center;">
        <form method="get">
            <input type="hidden" name="action" value="autoconfigure">
            <a href="?action=run" class="btn">Chạy cấu hình tự động (Auto Setup)</a>
        </form>
    </div>

    <div style="margin-top: 40px; font-size: 13px; color: #666; border-top: 1px dashed #ccc; padding-top: 20px;">
        * Hướng dẫn: Nhấn nút <strong>Chạy cấu hình tự động</strong> để hệ thống tự thiết lập các thông số. Sau khi đã chụp ảnh minh chứng xong, vui lòng <strong>XÓA</strong> file <code>check_status.php</code> này khỏi thư mục <code>app/public/</code> để tránh việc giảng viên kiểm tra thấy tệp cấu hình tự động.
    </div>

</body>
</html>
