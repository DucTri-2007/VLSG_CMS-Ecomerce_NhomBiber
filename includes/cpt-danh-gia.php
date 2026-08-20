<?php
/**
 * CPT: Đánh Giá & Nhận Xét Mũ Bảo Hiểm (danh_gia_mu)
 */

if (!defined('ABSPATH')) {
    exit;
}

add_action('init', 'biker_t5_register_cpt_danh_gia');
function biker_t5_register_cpt_danh_gia() {
    $labels = array(
        'name'               => 'Đánh Giá & Review',
        'singular_name'      => 'Đánh Giá',
        'menu_name'          => 'Đánh Giá Mũ',
        'name_admin_bar'     => 'Đánh Giá',
        'add_new'            => 'Thêm Đánh Giá Mới',
        'add_new_item'       => 'Thêm Đánh Giá Mới',
        'new_item'           => 'Đánh Giá Mới',
        'edit_item'          => 'Chỉnh Sửa Đánh Giá',
        'view_item'          => 'Xem Đánh Giá',
        'all_items'          => 'Tất Cả Đánh Giá',
        'search_items'       => 'Tìm Đánh Giá',
        'not_found'          => 'Không có đánh giá nào.',
    );

    $args = array(
        'labels'             => $labels,
        'public'             => false,
        'publicly_queryable' => false,
        'show_ui'            => true,
        'show_in_menu'       => 'edit.php?post_type=san_pham_mu', // Gộp dưới menu Mũ Bảo Hiểm
        'query_var'          => true,
        'capability_type'    => 'post',
        'has_archive'        => false,
        'hierarchical'       => false,
        'supports'           => array('title'),
        'show_in_rest'       => true,
    );

    register_post_type('danh_gia_mu', $args);
}

// Thêm Meta Box Đánh Giá
add_action('add_meta_boxes', 'biker_t5_add_danh_gia_metaboxes');
function biker_t5_add_danh_gia_metaboxes() {
    add_meta_box(
        'biker_t5_danh_gia_details',
        '⭐ Thông Tin Đánh Giá & Điểm Sao',
        'biker_t5_render_danh_gia_metabox',
        'danh_gia_mu',
        'normal',
        'high'
    );
}

function biker_t5_render_danh_gia_metabox($post) {
    wp_nonce_field('biker_t5_save_danh_gia_meta', 'biker_t5_danh_gia_nonce');

    $product_id      = get_post_meta($post->ID, '_product_id', true);
    $nguoi_danh_gia  = get_post_meta($post->ID, '_nguoi_danh_gia', true);
    $so_sao          = get_post_meta($post->ID, '_so_sao', true) ?: 5;
    $binh_luan       = get_post_meta($post->ID, '_binh_luan', true);

    $products = get_posts(array(
        'post_type'      => 'san_pham_mu',
        'posts_per_page' => -1,
        'orderby'        => 'title',
        'order'          => 'ASC',
    ));
    ?>
    <div class="biker-meta-grid">
        <div class="biker-field-group">
            <label for="product_id"><strong>Mũ Bảo Hiểm Được Đánh Giá (Khóa Ngoại - FK):</strong></label>
            <select id="product_id" name="product_id" style="width:100%;">
                <option value="">-- Chọn mũ bảo hiểm --</option>
                <?php foreach ($products as $p): ?>
                    <option value="<?php echo esc_attr($p->ID); ?>" <?php selected($product_id, $p->ID); ?>>
                        <?php echo esc_html($p->post_title); ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="biker-field-group">
            <label for="nguoi_danh_gia"><strong>Tên Người Đánh Giá:</strong></label>
            <input type="text" id="nguoi_danh_gia" name="nguoi_danh_gia" value="<?php echo esc_attr($nguoi_danh_gia); ?>" placeholder="VD: Trần Đình Trọng" style="width:100%;">
        </div>

        <div class="biker-field-group">
            <label for="so_sao"><strong>Số Sao Đánh Giá:</strong></label>
            <select id="so_sao" name="so_sao" style="width:100%; font-size:16px;">
                <option value="5" <?php selected($so_sao, 5); ?>>⭐⭐⭐⭐⭐ (5/5 - Tuyệt vời)</option>
                <option value="4" <?php selected($so_sao, 4); ?>>⭐⭐⭐⭐ (4/5 - Rất tốt)</option>
                <option value="3" <?php selected($so_sao, 3); ?>>⭐⭐⭐ (3/5 - Bình thường)</option>
                <option value="2" <?php selected($so_sao, 2); ?>>⭐⭐ (2/5 - Chưa hài lòng)</option>
                <option value="1" <?php selected($so_sao, 1); ?>>⭐ (1/5 - Kém)</option>
            </select>
        </div>

        <div class="biker-field-group full-width">
            <label for="binh_luan"><strong>Nội Dung Nhận Xét:</strong></label>
            <textarea id="binh_luan" name="binh_luan" rows="4" style="width:100%;" placeholder="VD: Mũ đội rất êm và cách âm tốt khi chạy tốc độ cao..."><?php echo esc_textarea($binh_luan); ?></textarea>
        </div>
    </div>
    <?php
}

// Lưu dữ liệu Đánh Giá
add_action('save_post_danh_gia_mu', 'biker_t5_save_danh_gia_meta');
function biker_t5_save_danh_gia_meta($post_id) {
    if (!isset($_POST['biker_t5_danh_gia_nonce']) || !wp_verify_nonce($_POST['biker_t5_danh_gia_nonce'], 'biker_t5_save_danh_gia_meta')) {
        return;
    }
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return;
    }
    if (!current_user_can('edit_post', $post_id)) {
        return;
    }

    $fields = array('product_id', 'nguoi_danh_gia', 'so_sao', 'binh_luan');
    foreach ($fields as $field) {
        if (isset($_POST[$field])) {
            update_post_meta($post_id, '_' . $field, sanitize_text_field($_POST[$field]));
        }
    }
}

// Cột hiển thị bảng Admin Đánh Giá
add_filter('manage_danh_gia_mu_posts_columns', 'biker_t5_danh_gia_columns');
function biker_t5_danh_gia_columns($columns) {
    return array(
        'cb'             => $columns['cb'],
        'title'          => 'Tiêu Đề Đánh Giá',
        'product'        => 'Mũ Bảo Hiểm',
        'nguoi_danh_gia' => 'Người Đánh Giá',
        'so_sao'         => 'Đánh Giá Sao',
        'binh_luan'      => 'Nội Dung',
        'date'           => 'Ngày Đăng',
    );
}

add_action('manage_danh_gia_mu_posts_custom_column', 'biker_t5_render_danh_gia_columns', 10, 2);
function biker_t5_render_danh_gia_columns($column, $post_id) {
    switch ($column) {
        case 'product':
            $pid = get_post_meta($post_id, '_product_id', true);
            if ($pid && $p = get_post($pid)) {
                echo '<a href="' . get_edit_post_link($pid) . '"><strong>' . esc_html($p->post_title) . '</strong></a>';
            } else {
                echo '<span style="color:#999;">Chưa gán</span>';
            }
            break;
        case 'nguoi_danh_gia':
            echo esc_html(get_post_meta($post_id, '_nguoi_danh_gia', true) ?: 'Ẩn danh');
            break;
        case 'so_sao':
            $stars = intval(get_post_meta($post_id, '_so_sao', true) ?: 5);
            echo '<span style="color:#f39c12; font-size:16px;">' . str_repeat('★', $stars) . str_repeat('☆', 5 - $stars) . '</span> (' . $stars . '/5)';
            break;
        case 'binh_luan':
            $cmt = get_post_meta($post_id, '_binh_luan', true);
            echo esc_html(wp_trim_words($cmt, 10, '...'));
            break;
    }
}
