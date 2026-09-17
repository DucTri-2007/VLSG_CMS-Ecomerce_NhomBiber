<?php
/**
 * CPT: Biến Thể Mũ Bảo Hiểm (bien_the_mu)
 */

if (!defined('ABSPATH')) {
    exit;
}

add_action('init', 'biker_t5_register_cpt_bien_the');
function biker_t5_register_cpt_bien_the() {
    $labels = array(
        'name'               => 'Biến Thể Mũ',
        'singular_name'      => 'Biến Thể Mũ',
        'menu_name'          => 'Biến Thể Mũ',
        'name_admin_bar'     => 'Biến Thể Mũ',
        'add_new'            => 'Thêm Biến Thể Mới',
        'add_new_item'       => 'Thêm Biến Thể Mới',
        'new_item'           => 'Biến Thể Mới',
        'edit_item'          => 'Chỉnh Sửa Biến Thể',
        'view_item'          => 'Xem Biến Thể',
        'all_items'          => 'Tất Cả Biến Thể',
        'search_items'       => 'Tìm Biến Thể',
        'not_found'          => 'Không tìm thấy biến thể nào.',
    );

    $args = array(
        'labels'             => $labels,
        'public'             => true,
        'publicly_queryable' => false,
        'show_ui'            => true,
        'show_in_menu'       => 'edit.php?post_type=san_pham_mu', // Gộp dưới menu Mũ Bảo Hiểm
        'query_var'          => true,
        'capability_type'    => 'post',
        'has_archive'        => false,
        'hierarchical'       => false,
        'supports'           => array('title', 'thumbnail'),
        'show_in_rest'       => true,
    );

    register_post_type('bien_the_mu', $args);
}

// Thêm Meta Box cho Biến Thể
add_action('add_meta_boxes', 'biker_t5_add_bien_the_metaboxes');
function biker_t5_add_bien_the_metaboxes() {
    add_meta_box(
        'biker_t5_bien_the_details',
        '🎨 Chi Tiết Biến Thể Mũ (Size, Màu, Kính, Giá, SKU, Tồn Kho)',
        'biker_t5_render_bien_the_metabox',
        'bien_the_mu',
        'normal',
        'high'
    );
}

function biker_t5_render_bien_the_metabox($post) {
    wp_nonce_field('biker_t5_save_bien_the_meta', 'biker_t5_bien_the_nonce');

    $product_id     = get_post_meta($post->ID, '_product_id', true);
    $kich_co        = get_post_meta($post->ID, '_kich_co', true);
    $mau_sac_tem    = get_post_meta($post->ID, '_mau_sac_tem', true);
    $loai_kinh      = get_post_meta($post->ID, '_loai_kinh', true);
    $so_luong_ton   = get_post_meta($post->ID, '_so_luong_ton_kho', true);
    $gia_thuc_te    = get_post_meta($post->ID, '_gia_ban_thuc_te', true);
    $ma_sku         = get_post_meta($post->ID, '_ma_sku', true);

    // Lấy danh sách Mũ bảo hiểm chính
    $products = get_posts(array(
        'post_type'      => 'san_pham_mu',
        'posts_per_page' => -1,
        'orderby'        => 'title',
        'order'          => 'ASC',
    ));
    ?>
    <div class="biker-meta-grid">
        <div class="biker-field-group full-width">
            <label for="product_id"><strong>Thuộc Sản Phẩm Mũ Bảo Hiểm (Khóa ngoại - FK):</strong></label>
            <select id="product_id" name="product_id" style="width:100%;">
                <option value="">-- Chọn mũ bảo hiểm gốc --</option>
                <?php foreach ($products as $p): ?>
                    <option value="<?php echo esc_attr($p->ID); ?>" <?php selected($product_id, $p->ID); ?>>
                        <?php echo esc_html($p->post_title); ?> (ID: <?php echo esc_html($p->ID); ?>)
                    </option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="biker-field-group">
            <label for="ma_sku"><strong>Mã SKU (Mã phân loại):</strong></label>
            <input type="text" id="ma_sku" name="ma_sku" value="<?php echo esc_attr($ma_sku); ?>" placeholder="VD: AGV-K1-BLK-M" style="width:100%;">
        </div>

        <div class="biker-field-group">
            <label for="kich_co"><strong>Kích Cỡ (Size):</strong></label>
            <select id="kich_co" name="kich_co" style="width:100%;">
                <option value="">-- Chọn kích cỡ --</option>
                <option value="S (55-56 cm)" <?php selected($kich_co, 'S (55-56 cm)'); ?>>Size S (55 - 56 cm)</option>
                <option value="M (57-58 cm)" <?php selected($kich_co, 'M (57-58 cm)'); ?>>Size M (57 - 58 cm)</option>
                <option value="L (59-60 cm)" <?php selected($kich_co, 'L (59-60 cm)'); ?>>Size L (59 - 60 cm)</option>
                <option value="XL (61-62 cm)" <?php selected($kich_co, 'XL (61-62 cm)'); ?>>Size XL (61 - 62 cm)</option>
                <option value="XXL (63-64 cm)" <?php selected($kich_co, 'XXL (63-64 cm)'); ?>>Size XXL (63 - 64 cm)</option>
            </select>
        </div>

        <div class="biker-field-group">
            <label for="mau_sac_tem"><strong>Màu Sắc / Tem:</strong></label>
            <input type="text" id="mau_sac_tem" name="mau_sac_tem" value="<?php echo esc_attr($mau_sac_tem); ?>" placeholder="VD: Đen Nhám, Trắng Đỏ, Tem RedBull, Rossi Winter Test..." style="width:100%;">
        </div>

        <div class="biker-field-group">
            <label for="loai_kinh"><strong>Loại Kính Đi Kèm:</strong></label>
            <select id="loai_kinh" name="loai_kinh" style="width:100%;">
                <option value="">-- Chọn loại kính --</option>
                <option value="Kính Trong Suốt (Clear)" <?php selected($loai_kinh, 'Kính Trong Suốt (Clear)'); ?>>Kính Trong Suốt (Clear)</option>
                <option value="Kính Khói Đen (Dark Smoke)" <?php selected($loai_kinh, 'Kính Khói Đen (Dark Smoke)'); ?>>Kính Khói Đen (Dark Smoke)</option>
                <option value="Kính Tráng Gương Bạc (Silver Iridium)" <?php selected($loai_kinh, 'Kính Tráng Gương Bạc (Silver Iridium)'); ?>>Kính Tráng Gương Bạc</option>
                <option value="Kính Gương Vàng 7 Màu (Rainbow)" <?php selected($loai_kinh, 'Kính Gương Vàng 7 Màu (Rainbow)'); ?>>Kính Gương 7 Màu</option>
                <option value="Kính Đôi (2 Kính: Ngoài Trong + Trong Râm)" <?php selected($loai_kinh, 'Kính Đôi (2 Kính: Ngoài Trong + Trong Râm)'); ?>>2 Kính (Kính ngoài + Kính âm)</option>
                <option value="Không có kính (No Visor)" <?php selected($loai_kinh, 'Không có kính (No Visor)'); ?>>Không có kính</option>
            </select>
        </div>

        <div class="biker-field-group">
            <label for="gia_ban_thuc_te"><strong>Giá Bán Thực Tế (VNĐ):</strong></label>
            <input type="number" step="1000" id="gia_ban_thuc_te" name="gia_ban_thuc_te" value="<?php echo esc_attr($gia_thuc_te); ?>" placeholder="VD: 1450000" style="width:100%;">
        </div>

        <div class="biker-field-group">
            <label for="so_luong_ton_kho"><strong>Số Lượng Tồn Kho:</strong></label>
            <input type="number" min="0" id="so_luong_ton_kho" name="so_luong_ton_kho" value="<?php echo esc_attr($so_luong_ton !== '' ? $so_luong_ton : '10'); ?>" style="width:100%;">
        </div>
    </div>
    <?php
}

// Lưu dữ liệu Meta Box Biến Thể
add_action('save_post_bien_the_mu', 'biker_t5_save_bien_the_meta');
function biker_t5_save_bien_the_meta($post_id) {
    if (!isset($_POST['biker_t5_bien_the_nonce']) || !wp_verify_nonce($_POST['biker_t5_bien_the_nonce'], 'biker_t5_save_bien_the_meta')) {
        return;
    }
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return;
    }
    if (!current_user_can('edit_post', $post_id)) {
        return;
    }

    $fields = array('product_id', 'kich_co', 'mau_sac_tem', 'loai_kinh', 'so_luong_ton_kho', 'gia_ban_thuc_te', 'ma_sku');
    foreach ($fields as $field) {
        if (isset($_POST[$field])) {
            update_post_meta($post_id, '_' . $field, sanitize_text_field($_POST[$field]));
        }
    }
}

// Cột hiển thị bảng Admin Biến thể
add_filter('manage_bien_the_mu_posts_columns', 'biker_t5_bien_the_columns');
function biker_t5_bien_the_columns($columns) {
    return array(
        'cb'              => $columns['cb'],
        'title'           => 'Tên Biến Thể',
        'product_parent'  => 'Mũ Chính (Sản phẩm)',
        'ma_sku'          => 'Mã SKU',
        'kich_co'         => 'Size',
        'mau_sac_tem'     => 'Màu / Tem',
        'loai_kinh'       => 'Loại Kính',
        'gia_ban_thuc_te' => 'Giá Bán',
        'so_luong_ton'    => 'Tồn Kho',
        'date'            => $columns['date'],
    );
}

add_action('manage_bien_the_mu_posts_custom_column', 'biker_t5_render_bien_the_columns', 10, 2);
function biker_t5_render_bien_the_columns($column, $post_id) {
    switch ($column) {
        case 'product_parent':
            $pid = get_post_meta($post_id, '_product_id', true);
            if ($pid && $p = get_post($pid)) {
                echo '<a href="' . get_edit_post_link($pid) . '"><strong>' . esc_html($p->post_title) . '</strong></a>';
            } else {
                echo '<span style="color:#999;">Chưa gán</span>';
            }
            break;
        case 'ma_sku':
            $sku = get_post_meta($post_id, '_ma_sku', true);
            echo $sku ? '<code>' . esc_html($sku) . '</code>' : '—';
            break;
        case 'kich_co':
            echo esc_html(get_post_meta($post_id, '_kich_co', true) ?: '—');
            break;
        case 'mau_sac_tem':
            echo esc_html(get_post_meta($post_id, '_mau_sac_tem', true) ?: '—');
            break;
        case 'loai_kinh':
            echo esc_html(get_post_meta($post_id, '_loai_kinh', true) ?: '—');
            break;
        case 'gia_ban_thuc_te':
            $gia = get_post_meta($post_id, '_gia_ban_thuc_te', true);
            echo $gia ? '<strong>' . number_format(floatval($gia), 0, ',', '.') . ' đ</strong>' : '—';
            break;
        case 'so_luong_ton':
            $qty = get_post_meta($post_id, '_so_luong_ton_kho', true);
            $qty_num = intval($qty);
            $badge_color = ($qty_num > 0) ? '#28a745' : '#dc3545';
            echo '<span style="background:' . $badge_color . '; color:#fff; padding:2px 8px; border-radius:4px; font-weight:bold;">' . $qty_num . '</span>';
            break;
    }
}
