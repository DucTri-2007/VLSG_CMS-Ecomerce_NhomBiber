<?php
/**
 * CPT: Sản Phẩm Mũ Bảo Hiểm (san_pham_mu)
 */

if (!defined('ABSPATH')) {
    exit;
}

add_action('init', 'biker_t5_register_cpt_san_pham');
function biker_t5_register_cpt_san_pham() {
    $labels = array(
        'name'               => 'Sản Phẩm Mũ',
        'singular_name'      => 'Sản Phẩm Mũ',
        'menu_name'          => 'Mũ Bảo Hiểm',
        'name_admin_bar'     => 'Sản Phẩm Mũ',
        'add_new'            => 'Thêm Mũ Mới',
        'add_new_item'       => 'Thêm Mũ Bảo Hiểm Mới',
        'new_item'           => 'Mũ Bảo Hiểm Mới',
        'edit_item'          => 'Chỉnh Sửa Mũ',
        'view_item'          => 'Xem Mũ',
        'all_items'          => 'Tất Cả Mũ Bảo Hiểm',
        'search_items'       => 'Tìm Kiếm Mũ',
        'not_found'          => 'Không tìm thấy mũ bảo hiểm nào.',
    );

    $args = array(
        'labels'             => $labels,
        'public'             => true,
        'publicly_queryable' => true,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'query_var'          => true,
        'rewrite'            => array('slug' => 'san-pham-mu'),
        'capability_type'    => 'post',
        'has_archive'        => true,
        'hierarchical'       => false,
        'menu_position'      => 5,
        'menu_icon'          => 'dashicons-shield-alt',
        'supports'           => array('title', 'editor', 'thumbnail', 'excerpt', 'custom-fields'),
        'show_in_rest'       => true,
    );

    register_post_type('san_pham_mu', $args);
}

// Thêm Meta Box cho Sản Phẩm Mũ
add_action('add_meta_boxes', 'biker_t5_add_san_pham_metaboxes');
function biker_t5_add_san_pham_metaboxes() {
    add_meta_box(
        'biker_t5_san_pham_details',
        '⚙️ Thông Tin Kỹ Thuật & Giá Mũ Bảo Hiểm',
        'biker_t5_render_san_pham_metabox',
        'san_pham_mu',
        'normal',
        'high'
    );
}

function biker_t5_render_san_pham_metabox($post) {
    wp_nonce_field('biker_t5_save_san_pham_meta', 'biker_t5_san_pham_nonce');

    $chat_lieu_vo  = get_post_meta($post->ID, '_chat_lieu_vo', true);
    $chuan_an_toan = get_post_meta($post->ID, '_chuan_an_toan', true);
    $gia_niem_yet  = get_post_meta($post->ID, '_gia_niem_yet', true);
    ?>
    <div class="biker-meta-grid">
        <div class="biker-field-group">
            <label for="gia_niem_yet"><strong>Giá Niêm Yết (VNĐ):</strong></label>
            <input type="number" step="1000" id="gia_niem_yet" name="gia_niem_yet" value="<?php echo esc_attr($gia_niem_yet); ?>" placeholder="VD: 1500000" style="width:100%;">
            <span class="field-desc">Giá bán gốc/niêm yết của mũ bảo hiểm.</span>
        </div>

        <div class="biker-field-group">
            <label for="chat_lieu_vo"><strong>Chất Liệu Vỏ Mũ:</strong></label>
            <select id="chat_lieu_vo" name="chat_lieu_vo" style="width:100%;">
                <option value="">-- Chọn chất liệu vỏ --</option>
                <option value="Nhựa ABS nguyên sinh" <?php selected($chat_lieu_vo, 'Nhựa ABS nguyên sinh'); ?>>Nhựa ABS nguyên sinh (Chống va đập cao)</option>
                <option value="Sợi thủy tinh (Fiberglass)" <?php selected($chat_lieu_vo, 'Sợi thủy tinh (Fiberglass)'); ?>>Sợi thủy tinh (Fiberglass)</option>
                <option value="Sợi Carbon (Carbon Fiber)" <?php selected($chat_lieu_vo, 'Sợi Carbon (Siêu nhẹ, siêu bền)'); ?>>Sợi Carbon (Siêu nhẹ, siêu bền)</option>
                <option value="Nhựa Polycarbonate" <?php selected($chat_lieu_vo, 'Nhựa Polycarbonate'); ?>>Nhựa Polycarbonate</option>
                <option value="Composite tổng hợp" <?php selected($chat_lieu_vo, 'Composite tổng hợp'); ?>>Composite tổng hợp</option>
            </select>
        </div>

        <div class="biker-field-group">
            <label for="chuan_an_toan"><strong>Tiêu Chuẩn An Toàn:</strong></label>
            <select id="chuan_an_toan" name="chuan_an_toan" style="width:100%;">
                <option value="">-- Chọn chuẩn an toàn --</option>
                <option value="QCVN 2:2008/BKHCN (Việt Nam)" <?php selected($chuan_an_toan, 'QCVN 2:2008/BKHCN (Việt Nam)'); ?>>QCVN (Việt Nam)</option>
                <option value="DOT FMVSS 218 (Mỹ)" <?php selected($chuan_an_toan, 'DOT FMVSS 218 (Mỹ)'); ?>>DOT (Chuẩn Mỹ)</option>
                <option value="ECE 22.05 (Châu Âu)" <?php selected($chuan_an_toan, 'ECE 22.05 (Châu Âu)'); ?>>ECE 22.05 (Châu Âu)</option>
                <option value="ECE 22.06 (Châu Âu mới nhất)" <?php selected($chuan_an_toan, 'ECE 22.06 (Châu Âu mới nhất)'); ?>>ECE 22.06 (Châu Âu mới nhất)</option>
                <option value="SNELL M2020 (Đua xe chuyên nghiệp)" <?php selected($chuan_an_toan, 'SNELL M2020 (Đua xe chuyên nghiệp)'); ?>>SNELL (Chuẩn đường đua)</option>
                <option value="JIS T 8133 (Nhật Bản)" <?php selected($chuan_an_toan, 'JIS T 8133 (Nhật Bản)'); ?>>JIS (Nhật Bản)</option>
            </select>
        </div>
    </div>
    <?php
}

// Lưu dữ liệu Meta Box Sản Phẩm Mũ
add_action('save_post_san_pham_mu', 'biker_t5_save_san_pham_meta');
function biker_t5_save_san_pham_meta($post_id) {
    if (!isset($_POST['biker_t5_san_pham_nonce']) || !wp_verify_nonce($_POST['biker_t5_san_pham_nonce'], 'biker_t5_save_san_pham_meta')) {
        return;
    }
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return;
    }
    if (!current_user_can('edit_post', $post_id)) {
        return;
    }

    if (isset($_POST['chat_lieu_vo'])) {
        update_post_meta($post_id, '_chat_lieu_vo', sanitize_text_field($_POST['chat_lieu_vo']));
    }
    if (isset($_POST['chuan_an_toan'])) {
        update_post_meta($post_id, '_chuan_an_toan', sanitize_text_field($_POST['chuan_an_toan']));
    }
    if (isset($_POST['gia_niem_yet'])) {
        update_post_meta($post_id, '_gia_niem_yet', sanitize_text_field($_POST['gia_niem_yet']));
    }
}

// Thêm Cột Tùy Chỉnh vào Danh Sách Admin Mũ
add_filter('manage_san_pham_mu_posts_columns', 'biker_t5_san_pham_columns');
function biker_t5_san_pham_columns($columns) {
    $new_cols = array();
    $new_cols['cb'] = $columns['cb'];
    $new_cols['thumbnail'] = 'Ảnh Mũ';
    $new_cols['title'] = 'Tên Mũ Bảo Hiểm';
    $new_cols['taxonomy-danh_muc_mu'] = 'Danh Mục';
    $new_cols['taxonomy-thuong_hieu_mu'] = 'Thương Hiệu';
    $new_cols['gia_niem_yet'] = 'Giá Niêm Yết';
    $new_cols['chat_lieu_vo'] = 'Chất Liệu';
    $new_cols['chuan_an_toan'] = 'Chuẩn An Toàn';
    $new_cols['date'] = $columns['date'];
    return $new_cols;
}

add_action('manage_san_pham_mu_posts_custom_column', 'biker_t5_render_san_pham_columns', 10, 2);
function biker_t5_render_san_pham_columns($column, $post_id) {
    switch ($column) {
        case 'thumbnail':
            if (has_post_thumbnail($post_id)) {
                echo get_the_post_thumbnail($post_id, array(50, 50));
            } else {
                echo '<span style="color:#aaa;">Chưa có ảnh</span>';
            }
            break;
        case 'gia_niem_yet':
            $gia = get_post_meta($post_id, '_gia_niem_yet', true);
            echo $gia ? number_format(floatval($gia), 0, ',', '.') . ' VNĐ' : '<span style="color:#aaa;">—</span>';
            break;
        case 'chat_lieu_vo':
            $val = get_post_meta($post_id, '_chat_lieu_vo', true);
            echo $val ? esc_html($val) : '<span style="color:#aaa;">—</span>';
            break;
        case 'chuan_an_toan':
            $val = get_post_meta($post_id, '_chuan_an_toan', true);
            echo $val ? '<span class="biker-badge-tag">' . esc_html($val) . '</span>' : '<span style="color:#aaa;">—</span>';
            break;
    }
}
