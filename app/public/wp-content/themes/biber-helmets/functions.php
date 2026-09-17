<?php
/**
 * Biber Helmets Theme Functions
 */

// Nạp dữ liệu 10 bài viết (Ảnh 1), 8 sản phẩm (Ảnh 2) và bộ trích xuất ảnh tự động
require_once get_template_directory() . '/biker-articles-data.php';
require_once get_template_directory() . '/biker-products-data.php';
require_once get_template_directory() . '/crop_assets.php';

// 1. Enqueue CSS & Google Fonts & FontAwesome chuẩn tiếng Việt không lỗi font
function biber_helmets_enqueue_styles() {
    wp_enqueue_style('biber-helmets-fonts', 'https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&family=Outfit:wght@500;600;700;800;900&family=Roboto:ital,wght@0,400;0,500;0,700;1,400&display=swap', array(), null);
    wp_enqueue_style('biber-helmets-fontawesome', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css', array(), '6.4.0');
    wp_enqueue_style('biber-helmets-style', get_stylesheet_uri(), array('biber-helmets-fontawesome'), '1.2');
}
add_action('wp_enqueue_scripts', 'biber_helmets_enqueue_styles');

// 2. Theme Setup
function biber_helmets_setup() {
    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
    add_theme_support('woocommerce');
    add_theme_support('wc-product-gallery-zoom');
    add_theme_support('wc-product-gallery-lightbox');
    add_theme_support('wc-product-gallery-slider');
    
    // Tự động kiểm tra và đồng bộ media
    if (function_exists('biker_extract_all_media_assets')) {
        biker_extract_all_media_assets();
    }
}
add_action('after_setup_theme', 'biber_helmets_setup');

// 3. Tự động chuyển đổi URL máy ảo cục bộ (biker.local/localhost) thành domain hiện tại
function biker_sanitize_media_url($url) {
    if (empty($url) || !is_string($url)) {
        return $url;
    }
    // Thay thế các domain cục bộ phổ biến khi migrate database từ máy ảo
    $url = preg_replace('#https?://(?:biker\.local|localhost|127\.0\.0\.1)(?::\d+)?#i', home_url(), $url);
    
    // Nếu site đang chạy SSL/HTTPS, chuẩn hoá giao thức sang https://
    if (is_ssl() && strpos($url, 'http://') === 0) {
        $url = str_replace('http://', 'https://', $url);
    }
    return $url;
}

add_filter('wp_get_attachment_url', 'biker_fix_local_media_url');
function biker_fix_local_media_url($url) {
    return biker_sanitize_media_url($url);
}

add_filter('wp_get_attachment_image_src', 'biker_fix_local_media_src');
function biker_fix_local_media_src($image) {
    if (is_array($image) && !empty($image[0])) {
        $image[0] = biker_sanitize_media_url($image[0]);
    }
    return $image;
}

/**
 * 4. TỰ ĐỘNG LẤY ẢNH ĐẦU TIÊN TRONG BÀI VIẾT LÀM ẢNH ĐẠI DIỆN (FEATURED IMAGE)
 */
function biker_auto_set_featured_image($post_id) {
    if (wp_is_post_revision($post_id) || wp_is_post_autosave($post_id)) {
        return;
    }
    if (has_post_thumbnail($post_id)) {
        return;
    }
    
    $post = get_post($post_id);
    if (!$post || $post->post_type !== 'post') {
        return;
    }
    
    $output = preg_match_all('/<img.+src=[\'"]([^\'"]+)[\'"].*>/i', $post->post_content, $matches);
    if ($output && isset($matches[1][0])) {
        $first_img_url = biker_sanitize_media_url($matches[1][0]);
        
        global $wpdb;
        $attachment = $wpdb->get_col($wpdb->prepare("SELECT ID FROM {$wpdb->posts} WHERE guid=%s", $first_img_url));
        if (!empty($attachment)) {
            set_post_thumbnail($post_id, $attachment[0]);
        }
    }
}
add_action('save_post', 'biker_auto_set_featured_image');

/**
 * 5. HÀM HIỂN THỊ ẢNH BÀI BÁO (THUMBNAIL HELPER)
 * Trích xuất từ 10 hình ảnh an toàn giao thông của Ảnh 1
 */
function biker_get_post_image($post_id = null, $class = 'biker-post-img') {
    if (!$post_id) {
        $post_id = get_the_ID();
    }
    
    $theme_uri = get_template_directory_uri();
    
    // Trường hợp 1: Có ảnh đại diện chính thức trong WordPress
    if (has_post_thumbnail($post_id)) {
        $thumb_id = get_post_thumbnail_id($post_id);
        $thumb_src = wp_get_attachment_image_src($thumb_id, 'large');
        if (!empty($thumb_src[0])) {
            $img_url = biker_sanitize_media_url($thumb_src[0]);
            $title_attr = esc_attr(get_the_title($post_id));
            $class_attr = esc_attr($class);
            return '<img src="' . esc_url($img_url) . '" alt="' . $title_attr . '" class="' . $class_attr . '" onerror="this.onerror=null;this.src=\'' . $theme_uri . '/assets/images/news-1.jpg\';" style="width:100%; height:100%; object-fit:cover; display:block;" />';
        }
    }
    
    // Ánh xạ 10 ảnh bài viết từ Ảnh 1
    $idx = (absint($post_id) % 10) + 1;
    $post_img_url = $theme_uri . '/assets/images/news-' . $idx . '.jpg';
    $fallback_full = $theme_uri . '/assets/images/news-grid-full.jpg';
    
    $title_attr = esc_attr(get_the_title($post_id));
    $class_attr = esc_attr($class);
    $onerror_js = "this.onerror=null;this.src='{$fallback_full}';";

    return '<img src="' . esc_url($post_img_url) . '" alt="' . $title_attr . '" class="' . $class_attr . '" onerror="' . $onerror_js . '" style="width:100%; height:100%; object-fit:cover; display:block;" />';
}

/**
 * TỰ ĐỘNG BẬT ĐĂNG KÝ VÀ KHẮC PHỤC LỖI NGHẼN LUỒNG ĐĂNG NHẬP / ĐĂNG KÝ
 */
add_filter('pre_option_woocommerce_enable_myaccount_registration', '__return_true');
add_filter('pre_option_users_can_register', '__return_true');
add_filter('pre_option_woocommerce_registration_generate_password', '__return_false');
add_filter('pre_option_woocommerce_registration_generate_username', '__return_false');

/**
 * Tự động đồng bộ các ảnh nón và showroom trích xuất từ Brain vào theme nếu có quyền
 */
add_action('after_setup_theme', 'biker_auto_sync_extracted_images');
function biker_auto_sync_extracted_images() {
    $brain_dir = 'C:/Users/DELL/.gemini/antigravity-ide/brain/c9698785-a1f5-48b6-a06e-c05c89c93b5e/';
    if (is_dir($brain_dir)) {
        $files = array(
            $brain_dir . '.user_uploaded/media_1789584619892.png' => get_template_directory() . '/assets/images/biker-logo.png',
            $brain_dir . '.user_uploaded/media_1789584919234.png' => get_template_directory() . '/assets/images/helmets-grid-new.png',
            $brain_dir . 'helmet_agv_k1_s_1789583640639.jpg' => get_template_directory() . '/assets/images/agv-k1-s.jpg',
            $brain_dir . 'helmet_shoei_x15_1789583675436.jpg' => get_template_directory() . '/assets/images/shoei-x15.jpg',
            $brain_dir . 'helmet_kyt_34_1789583710621.jpg' => get_template_directory() . '/assets/images/kyt-venom.jpg',
            $brain_dir . 'helmet_ls2_carbon_1789583604238.jpg' => get_template_directory() . '/assets/images/ls2-carbon.jpg',
            $brain_dir . 'post_showroom_shelf_1789583756378.jpg' => get_template_directory() . '/assets/images/post-showroom-1.jpg',
            $brain_dir . 'post_biker_shop_1789583793962.jpg' => get_template_directory() . '/assets/images/post-showroom-2.jpg',
            $brain_dir . 'post_helmet_fitting_1789583832861.jpg' => get_template_directory() . '/assets/images/post-showroom-3.jpg',
        );
        foreach ($files as $src => $dest) {
            if (file_exists($src) && (!file_exists($dest) || filesize($dest) != filesize($src))) {
                @copy($src, $dest);
            }
        }
    }
}

/**
 * 6. HIỂN THỊ CỘT ẢNH ĐẠI DIỆN TRONG TRANG QUẢN TRỊ BÀI VIẾT (WP-ADMIN)
 */
add_filter('manage_posts_columns', 'biker_add_thumbnail_column');
function biker_add_thumbnail_column($columns) {
    $new_columns = array();
    foreach ($columns as $key => $title) {
        if ($key === 'title') {
            $new_columns['biker_thumb'] = __('Ảnh minh họa', 'biber-helmets');
        }
        $new_columns[$key] = $title;
    }
    return $new_columns;
}

add_action('manage_posts_custom_column', 'biker_show_thumbnail_column', 10, 2);
function biker_show_thumbnail_column($column_name, $post_id) {
    if ($column_name === 'biker_thumb') {
        echo '<div style="width:60px; height:45px; border-radius:6px; overflow:hidden; background:#222; border:1px solid #444;">';
        echo biker_get_post_image($post_id, 'admin-thumb');
        echo '</div>';
    }
}

/**
 * 7. AJAX FRAGMENT CẬP NHẬT SỐ LƯỢNG GIỎ HÀNG REALTIME TRÊN HEADER
 */
add_filter('woocommerce_add_to_cart_fragments', 'biker_header_add_to_cart_fragment');
function biker_header_add_to_cart_fragment($fragments) {
    ob_start();
    $count = (WC()->cart) ? WC()->cart->get_cart_contents_count() : 0;
    ?>
    <span class="biker-cart-count" style="position: absolute; top: -4px; right: -4px; background: #ffb703; color: #000; font-size: 11px; font-weight: 800; border-radius: 50%; width: 18px; height: 18px; display: flex; align-items: center; justify-content: center; box-shadow: 0 2px 5px rgba(0,0,0,0.5);">
        <?php echo $count; ?>
    </span>
    <?php
    $fragments['span.biker-cart-count'] = ob_get_clean();
    return $fragments;
}

/**
 * 8. ĐẢM BẢO 100% SẢN PHẨM CÓ ẢNH HIỂN THỊ (ĐỒNG BỘ 21 SẢN PHẨM SHOP VÀ TRANG CHỦ)
 */
function biker_get_product_smart_image($post_id = null) {
    if (!$post_id) {
        $post_id = get_the_ID();
    }
    
    $theme_uri = get_template_directory_uri();
    $title = strtolower(get_the_title($post_id));
    
    // Ánh xạ chính xác cho toàn bộ 21 dòng sản phẩm WooCommerce
    if (strpos($title, 'shoei') !== false || strpos($title, 'x-fifteen') !== false) {
        return $theme_uri . '/assets/images/shoei-x15.jpg';
    } elseif (strpos($title, 'agv') !== false || strpos($title, 'k1') !== false) {
        return $theme_uri . '/assets/images/agv-k1-s.jpg';
    } elseif (strpos($title, 'kyt') !== false || strpos($title, 'venom') !== false || strpos($title, 'thor') !== false) {
        return $theme_uri . '/assets/images/kyt-venom.jpg';
    } elseif (strpos($title, 'ls2') !== false || strpos($title, 'ff906') !== false || strpos($title, 'advant') !== false || strpos($title, 'carbon') !== false) {
        return $theme_uri . '/assets/images/ls2-carbon.jpg';
    } elseif (strpos($title, 'qualifier') !== false || strpos($title, 'bell') !== false || strpos($title, 'mips') !== false) {
        return $theme_uri . '/assets/images/agv-k1-s.jpg';
    } elseif (strpos($title, 'hjc') !== false || strpos($title, 'c70') !== false || strpos($title, 'i100') !== false) {
        return $theme_uri . '/assets/images/agv-k1-s.jpg';
    } elseif (strpos($title, 'royal') !== false || strpos($title, 'm139') !== false || strpos($title, 'm20c') !== false) {
        return $theme_uri . '/assets/images/ls2-carbon.jpg';
    } elseif (strpos($title, 'andes') !== false || strpos($title, '3s111') !== false || strpos($title, '109k') !== false) {
        return $theme_uri . '/assets/images/kyt-venom.jpg';
    } elseif (strpos($title, 'bulldog') !== false || strpos($title, 'heli') !== false) {
        return $theme_uri . '/assets/images/ls2-carbon.jpg';
    } elseif (strpos($title, 'givi') !== false || strpos($title, 'siena') !== false || strpos($title, 'challenger') !== false) {
        return $theme_uri . '/assets/images/shoei-x15.jpg';
    } elseif (strpos($title, 'yohe') !== false || strpos($title, '950') !== false) {
        return $theme_uri . '/assets/images/ls2-carbon.jpg';
    } elseif (strpos($title, 'mt') !== false || strpos($title, 'thunder') !== false) {
        return $theme_uri . '/assets/images/agv-k1-s.jpg';
    } elseif (strpos($title, 'zeus') !== false || strpos($title, '613') !== false) {
        return $theme_uri . '/assets/images/kyt-venom.jpg';
    } elseif (strpos($title, 'chita') !== false || strpos($title, 'napoly') !== false) {
        return $theme_uri . '/assets/images/kyt-venom.jpg';
    }
    
    // Dự phòng xoay vòng 4 ảnh chất lượng cao có sẵn
    $available_images = array(
        $theme_uri . '/assets/images/agv-k1-s.jpg',
        $theme_uri . '/assets/images/shoei-x15.jpg',
        $theme_uri . '/assets/images/kyt-venom.jpg',
        $theme_uri . '/assets/images/ls2-carbon.jpg'
    );
    $idx = absint($post_id) % count($available_images);
    return $available_images[$idx];
}

// Bắt buộc WooCommerce Shop sử dụng ảnh hợp lệ 100% không bao giờ bị lỗi ảnh
add_filter('woocommerce_product_get_image', 'biker_force_valid_woocommerce_product_image', 99, 5);
function biker_force_valid_woocommerce_product_image($image_html, $product, $size, $attr, $placeholder) {
    $post_id = $product ? $product->get_id() : get_the_ID();
    $smart_img = esc_url(biker_get_product_smart_image($post_id));
    $title = $product ? esc_attr($product->get_name()) : 'Biker Helmet';
    return '<img src="' . $smart_img . '" alt="' . $title . '" class="woocommerce-placeholder wp-post-image" onerror="this.onerror=null;this.src=\'' . esc_url(get_template_directory_uri() . '/assets/images/agv-k1-s.jpg') . '\';" style="width:100%;height:100%;object-fit:cover;display:block;" />';
}

add_filter('woocommerce_placeholder_img_src', 'biker_custom_woocommerce_placeholder');
function biker_custom_woocommerce_placeholder($src) {
    return biker_get_product_smart_image();
}

add_filter('woocommerce_placeholder_img', 'biker_custom_woocommerce_placeholder_html', 10, 3);
function biker_custom_woocommerce_placeholder_html($html, $size, $dimensions) {
    $default_img = esc_url(biker_get_product_smart_image());
    return '<img src="' . $default_img . '" alt="Biker Helmet ECE 22.06" class="woocommerce-placeholder wp-post-image" onerror="this.onerror=null;this.src=\'' . esc_url(get_template_directory_uri() . '/assets/images/agv-k1-s.jpg') . '\';" style="width:100%;height:100%;object-fit:cover;" />';
}

add_filter('post_thumbnail_html', 'biker_ensure_product_thumbnail_html', 99, 5);
function biker_ensure_product_thumbnail_html($html, $post_id, $post_thumbnail_id, $size, $attr) {
    $default = esc_url(biker_get_product_smart_image($post_id));
    if (empty($html) || strpos($html, 'unsplash.com') !== false) {
        return '<img src="' . $default . '" alt="' . esc_attr(get_the_title($post_id)) . '" class="biker-fallback-img wp-post-image" onerror="this.onerror=null;this.src=\'' . esc_url(get_template_directory_uri() . '/assets/images/agv-k1-s.jpg') . '\';" style="width:100%;height:100%;object-fit:cover;">';
    }
    if (strpos($html, 'onerror=') === false) {
        $html = str_replace('<img ', '<img onerror="this.onerror=null;this.src=\'' . $default . '\';" ', $html);
    }
    return $html;
}

/**
 * 9. TỰ ĐỘNG ĐỒNG BỘ 10 BÀI VIẾT AN TOÀN VÀO CƠ SỞ DỮ LIỆU WORDPRESS (WP_POSTS)
 * Giải quyết triệt để: Trang chủ có 10 bài nhưng trang bài viết / wp-admin lại trống
 */
function biker_sync_10_safety_posts_to_db() {
    if (!function_exists('biker_get_10_safety_articles')) return;
    
    $articles = biker_get_10_safety_articles();
    foreach ($articles as $art) {
        $existing = get_page_by_path($art['slug'], OBJECT, 'post');
        if (!$existing) {
            $post_id = wp_insert_post(array(
                'post_title'   => $art['title'],
                'post_content' => $art['content'],
                'post_excerpt' => $art['excerpt'],
                'post_status'  => 'publish',
                'post_type'    => 'post',
                'post_name'    => $art['slug'],
                'post_date'    => date('Y-m-d H:i:s', strtotime('-' . (11 - $art['id']) . ' days')),
            ));
            if ($post_id && !is_wp_error($post_id)) {
                wp_set_object_terms($post_id, $art['category'], 'category');
            }
        }
    }
}
add_action('init', 'biker_sync_10_safety_posts_to_db');

/**
 * 9. BẢO MẬT & RESET TOÀN BỘ PHIÊN LÀM VIỆC (SESSION) KHI ADMIN / USER ĐĂNG XUẤT
 */
add_action('wp_logout', 'biker_full_logout_cleanup');
function biker_full_logout_cleanup() {
    // 1. Hủy phiên làm việc WordPress
    wp_destroy_current_session();
    wp_clear_auth_cookie();

    // 2. Hủy session giỏ hàng WooCommerce
    if ( function_exists('WC') && WC()->session ) {
        WC()->session->destroy_session();
    }

    // 3. Xóa sạch mọi cookie auth
    if ( ! empty($_COOKIE) ) {
        foreach ( $_COOKIE as $name => $value ) {
            if ( strpos($name, 'wordpress_') !== false || strpos($name, 'wp-') !== false || strpos($name, 'woocommerce_') !== false ) {
                setcookie($name, '', time() - 3600, '/');
                setcookie($name, '', time() - 3600, '/', $_SERVER['HTTP_HOST'] ?? '');
            }
        }
    }
}

// Ngăn chặn trình duyệt và proxy/Varnish cache lại trang khi người dùng đã đăng xuất
add_action('send_headers', 'biker_prevent_caching_auth_pages');
function biker_prevent_caching_auth_pages() {
    if ( is_user_logged_in() || is_account_page() || is_cart() || is_checkout() || isset($_GET['loggedout']) ) {
        nocache_headers();
        header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0, post-check=0, pre-check=0");
        header("Pragma: no-cache");
        header("Expires: Wed, 11 Jan 1984 05:00:00 GMT");
    }
}

