<?php
/**
 * Đăng ký Custom Taxonomies: Danh mục Mũ & Thương hiệu Mũ
 */

if (!defined('ABSPATH')) {
    exit;
}

add_action('init', 'biker_t5_register_taxonomies');
function biker_t5_register_taxonomies() {
    // 1. Taxonomy: Danh mục Mũ (Hierarchical - giống category)
    $cat_labels = array(
        'name'              => 'Danh Mục Mũ',
        'singular_name'     => 'Danh Mục Mũ',
        'search_items'      => 'Tìm kiếm Danh mục',
        'all_items'         => 'Tất cả Danh mục',
        'parent_item'       => 'Danh mục cha',
        'parent_item_colon' => 'Danh mục cha:',
        'edit_item'         => 'Sửa Danh mục',
        'update_item'       => 'Cập nhật Danh mục',
        'add_new_item'      => 'Thêm Danh mục Mới',
        'new_item_name'     => 'Tên Danh mục Mới',
        'menu_name'         => 'Danh Mục Mũ',
    );

    register_taxonomy('danh_muc_mu', array('san_pham_mu'), array(
        'hierarchical'      => true,
        'labels'            => $cat_labels,
        'show_ui'           => true,
        'show_admin_column' => true,
        'query_var'         => true,
        'rewrite'           => array('slug' => 'danh-muc-mu'),
        'show_in_rest'      => true,
    ));

    // 2. Taxonomy: Thương hiệu Mũ (Brands)
    $brand_labels = array(
        'name'              => 'Thương Hiệu Mũ',
        'singular_name'     => 'Thương Hiệu Mũ',
        'search_items'      => 'Tìm Thương hiệu',
        'all_items'         => 'Tất cả Thương hiệu',
        'edit_item'         => 'Sửa Thương hiệu',
        'update_item'       => 'Cập nhật Thương hiệu',
        'add_new_item'      => 'Thêm Thương hiệu Mới',
        'new_item_name'     => 'Tên Thương hiệu Mới',
        'menu_name'         => 'Thương Hiệu Mũ',
    );

    register_taxonomy('thuong_hieu_mu', array('san_pham_mu'), array(
        'hierarchical'      => true,
        'labels'            => $brand_labels,
        'show_ui'           => true,
        'show_admin_column' => true,
        'query_var'         => true,
        'rewrite'           => array('slug' => 'thuong-hieu-mu'),
        'show_in_rest'      => true,
    ));
}

// Thêm Custom Meta Fields cho Thương Hiệu (Xuất Xứ & Logo URL)
add_action('thuong_hieu_mu_add_form_fields', 'biker_t5_add_thuong_hieu_fields');
function biker_t5_add_thuong_hieu_fields($taxonomy) {
    ?>
    <div class="form-field">
        <label for="xuat_xu">Xuất Xứ (Quốc gia)</label>
        <input type="text" name="xuat_xu" id="xuat_xu" placeholder="VD: Ý (Italy), Nhật Bản, Việt Nam, Thái Lan...">
        <p class="description">Nơi xuất xứ của thương hiệu mũ.</p>
    </div>
    <div class="form-field">
        <label for="logo_url">URL Logo Thương Hiệu</label>
        <input type="text" name="logo_url" id="logo_url" placeholder="https://domain.com/logo.png">
        <p class="description">Đường dẫn hình ảnh logo thương hiệu.</p>
    </div>
    <?php
}

add_action('thuong_hieu_mu_edit_form_fields', 'biker_t5_edit_thuong_hieu_fields');
function biker_t5_edit_thuong_hieu_fields($term) {
    $xuat_xu = get_term_meta($term->term_id, 'xuat_xu', true);
    $logo_url = get_term_meta($term->term_id, 'logo_url', true);
    ?>
    <tr class="form-field">
        <th scope="row"><label for="xuat_xu">Xuất Xứ (Quốc gia)</label></th>
        <td>
            <input type="text" name="xuat_xu" id="xuat_xu" value="<?php echo esc_attr($xuat_xu); ?>">
            <p class="description">Nơi xuất xứ của thương hiệu mũ.</p>
        </td>
    </tr>
    <tr class="form-field">
        <th scope="row"><label for="logo_url">URL Logo Thương Hiệu</label></th>
        <td>
            <input type="text" name="logo_url" id="logo_url" value="<?php echo esc_attr($logo_url); ?>">
            <p class="description">Đường dẫn hình ảnh logo thương hiệu.</p>
        </td>
    </tr>
    <?php
}

// Lưu Term Meta cho Thương Hiệu
add_action('created_thuong_hieu_mu', 'biker_t5_save_thuong_hieu_fields');
add_action('edited_thuong_hieu_mu', 'biker_t5_save_thuong_hieu_fields');
function biker_t5_save_thuong_hieu_fields($term_id) {
    if (isset($_POST['xuat_xu'])) {
        update_term_meta($term_id, 'xuat_xu', sanitize_text_field($_POST['xuat_xu']));
    }
    if (isset($_POST['logo_url'])) {
        update_term_meta($term_id, 'logo_url', esc_url_raw($_POST['logo_url']));
    }
}
