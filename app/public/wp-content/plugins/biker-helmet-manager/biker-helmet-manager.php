<?php
/**
 * Plugin Name: Biker T5 - Quản Lý Mũ Bảo Hiểm (Helmet Data Architecture)
 * Plugin URI:  https://github.com/biker-t5/helmet-manager
 * Description: Plugin khởi tạo cấu trúc dữ liệu Data Architecture (CPT, Taxonomies, Meta Boxes) cho Website Bán Mũ Bảo Hiểm theo sơ đồ ERD.
 * Version:     1.0.0
 * Author:      Biker T5 Team
 * Text Domain: biker-t5
 */

// Chống truy cập trực tiếp
if (!defined('ABSPATH')) {
    exit;
}

define('BIKER_T5_PATH', plugin_dir_path(__FILE__));
define('BIKER_T5_URL', plugin_dir_url(__FILE__));

// Load các file chức năng
require_once BIKER_T5_PATH . 'includes/taxonomies.php';
require_once BIKER_T5_PATH . 'includes/cpt-san-pham.php';
require_once BIKER_T5_PATH . 'includes/cpt-bien-the.php';
require_once BIKER_T5_PATH . 'includes/cpt-don-hang.php';
require_once BIKER_T5_PATH . 'includes/cpt-danh-gia.php';

// Enqueue CSS & JS cho giao diện Admin Meta Box
add_action('admin_enqueue_scripts', 'biker_t5_enqueue_admin_assets');
function biker_t5_enqueue_admin_assets($hook) {
    wp_enqueue_style(
        'biker-t5-admin-style',
        BIKER_T5_URL . 'assets/admin-style.css',
        array(),
        '1.0.0'
    );
}

// Tự động flush rewrite rules khi kích hoạt plugin
register_activation_hook(__FILE__, 'biker_t5_flush_rewrites');
function biker_t5_flush_rewrites() {
    biker_t5_register_taxonomies();
    biker_t5_register_cpt_san_pham();
    biker_t5_register_cpt_bien_the();
    biker_t5_register_cpt_don_hang();
    biker_t5_register_cpt_danh_gia();
    flush_rewrite_rules();
}
