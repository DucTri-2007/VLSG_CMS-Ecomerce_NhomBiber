<?php
/**
 * CPT: Đơn Hàng (don_hang_mu) & Chi Tiết Đơn Hàng (Order Items)
 */

if (!defined('ABSPATH')) {
    exit;
}

add_action('init', 'biker_t5_register_cpt_don_hang');
function biker_t5_register_cpt_don_hang() {
    $labels = array(
        'name'               => 'Đơn Hàng',
        'singular_name'      => 'Đơn Hàng',
        'menu_name'          => 'Đơn Hàng Mũ',
        'name_admin_bar'     => 'Đơn Hàng',
        'add_new'            => 'Tạo Đơn Hàng Mới',
        'add_new_item'       => 'Tạo Đơn Hàng Mới',
        'new_item'           => 'Đơn Hàng Mới',
        'edit_item'          => 'Xem / Sửa Đơn Hàng',
        'view_item'          => 'Xem Đơn Hàng',
        'all_items'          => 'Tất Cả Đơn Hàng',
        'search_items'       => 'Tìm Kiếm Đơn Hàng',
        'not_found'          => 'Không có đơn hàng nào.',
    );

    $args = array(
        'labels'             => $labels,
        'public'             => false,
        'publicly_queryable' => false,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'query_var'          => true,
        'capability_type'    => 'post',
        'has_archive'        => false,
        'hierarchical'       => false,
        'menu_position'      => 6,
        'menu_icon'          => 'dashicons-cart',
        'supports'           => array('title'),
        'show_in_rest'       => true,
    );

    register_post_type('don_hang_mu', $args);
}

// Thêm Meta Box Thông Tin Khách & Chi Tiết Đơn Hàng
add_action('add_meta_boxes', 'biker_t5_add_don_hang_metaboxes');
function biker_t5_add_don_hang_metaboxes() {
    add_meta_box(
        'biker_t5_don_hang_info',
        '📦 Thông Tin Giao Hàng & Thanh Toán',
        'biker_t5_render_don_hang_info_metabox',
        'don_hang_mu',
        'normal',
        'high'
    );

    add_meta_box(
        'biker_t5_don_hang_items',
        '🛒 Chi Tiết Đơn Hàng (Sản Phẩm & Biến Thể Mũ)',
        'biker_t5_render_don_hang_items_metabox',
        'don_hang_mu',
        'normal',
        'high'
    );
}

function biker_t5_render_don_hang_info_metabox($post) {
    wp_nonce_field('biker_t5_save_don_hang_meta', 'biker_t5_don_hang_nonce');

    $nguoi_nhan     = get_post_meta($post->ID, '_nguoi_nhan', true);
    $sdt_nhan       = get_post_meta($post->ID, '_sdt_nhan', true);
    $dia_chi_giao   = get_post_meta($post->ID, '_dia_chi_giao', true);
    $phuong_thuc_tt = get_post_meta($post->ID, '_phuong_thuc_tt', true);
    $trang_thai     = get_post_meta($post->ID, '_trang_thai', true) ?: 'cho_duyet';
    $tong_tien      = get_post_meta($post->ID, '_tong_tien', true) ?: 0;
    ?>
    <div class="biker-meta-grid">
        <div class="biker-field-group">
            <label for="nguoi_nhan"><strong>Tên Người Nhận:</strong></label>
            <input type="text" id="nguoi_nhan" name="nguoi_nhan" value="<?php echo esc_attr($nguoi_nhan); ?>" placeholder="VD: Nguyễn Văn An" style="width:100%;">
        </div>

        <div class="biker-field-group">
            <label for="sdt_nhan"><strong>Số Điện Thoại Nhận:</strong></label>
            <input type="text" id="sdt_nhan" name="sdt_nhan" value="<?php echo esc_attr($sdt_nhan); ?>" placeholder="VD: 0987654321" style="width:100%;">
        </div>

        <div class="biker-field-group full-width">
            <label for="dia_chi_giao"><strong>Địa Chỉ Giao Hàng:</strong></label>
            <textarea id="dia_chi_giao" name="dia_chi_giao" rows="2" style="width:100%;" placeholder="VD: Số 123 Đường Cầu Giấy, Phường Dịch Vọng, Cầu Giấy, Hà Nội"><?php echo esc_textarea($dia_chi_giao); ?></textarea>
        </div>

        <div class="biker-field-group">
            <label for="phuong_thuc_tt"><strong>Phương Thức Thanh Toán:</strong></label>
            <select id="phuong_thuc_tt" name="phuong_thuc_tt" style="width:100%;">
                <option value="COD" <?php selected($phuong_thuc_tt, 'COD'); ?>>Thanh toán khi nhận hàng (COD)</option>
                <option value="Banking" <?php selected($phuong_thuc_tt, 'Banking'); ?>>Chuyển khoản ngân hàng (QR Banking)</option>
                <option value="MoMo" <?php selected($phuong_thuc_tt, 'MoMo'); ?>>Ví MoMo</option>
                <option value="VNPay" <?php selected($phuong_thuc_tt, 'VNPay'); ?>>Cổng thanh toán VNPay</option>
            </select>
        </div>

        <div class="biker-field-group">
            <label for="trang_thai"><strong>Trạng Thái Đơn Hàng:</strong></label>
            <select id="trang_thai" name="trang_thai" style="width:100%; font-weight:bold;">
                <option value="cho_duyet" <?php selected($trang_thai, 'cho_duyet'); ?>>⏳ Chờ Duyệt (Pending)</option>
                <option value="dang_xu_ly" <?php selected($trang_thai, 'dang_xu_ly'); ?>>⚙️ Đang Chuẩn Bị Hàng</option>
                <option value="dang_giao" <?php selected($trang_thai, 'dang_giao'); ?>>🚚 Đang Giao Hàng (Shipping)</option>
                <option value="hoan_thanh" <?php selected($trang_thai, 'hoan_thanh'); ?>>✅ Hoàn Thành (Completed)</option>
                <option value="da_huy" <?php selected($trang_thai, 'da_huy'); ?>>❌ Đã Hủy (Cancelled)</option>
            </select>
        </div>

        <div class="biker-field-group full-width" style="background:#f8f9fa; padding:15px; border-radius:6px; border-left: 4px solid #2271b1;">
            <label for="tong_tien" style="font-size:16px;"><strong>TỔNG TIỀN ĐƠN HÀNG (VNĐ):</strong></label>
            <input type="number" step="1000" id="tong_tien" name="tong_tien" value="<?php echo esc_attr($tong_tien); ?>" style="width:250px; font-size:18px; font-weight:bold; color:#d63638;">
            <span class="field-desc">Tổng giá trị đơn hàng sau khi tính số lượng và đơn giá các sản phẩm.</span>
        </div>
    </div>
    <?php
}

function biker_t5_render_don_hang_items_metabox($post) {
    $order_items = get_post_meta($post->ID, '_chi_tiet_don_hang', true);
    if (!is_array($order_items) || empty($order_items)) {
        $order_items = array(
            array('ten_bien_the' => '', 'so_luong' => 1, 'don_gia' => 0, 'thanh_tien' => 0)
        );
    }

    // Danh sách các biến thể có sẵn
    $variants = get_posts(array(
        'post_type'      => 'bien_the_mu',
        'posts_per_page' => -1,
        'orderby'        => 'title',
        'order'          => 'ASC'
    ));
    ?>
    <table class="widefat biker-order-items-table" id="biker-order-items-table">
        <thead>
            <tr>
                <th style="width:40%;">Biến Thể Mũ Bảo Hiểm</th>
                <th style="width:15%;">Số Lượng</th>
                <th style="width:20%;">Đơn Giá (VNĐ)</th>
                <th style="width:25%;">Thành Tiền (VNĐ)</th>
            </tr>
        </thead>
        <tbody id="biker-order-items-tbody">
            <?php foreach ($order_items as $index => $item): ?>
            <tr>
                <td>
                    <select name="order_items[<?php echo $index; ?>][variant_id]" class="variant-select" style="width:100%;">
                        <option value="">-- Chọn biến thể mũ --</option>
                        <?php foreach ($variants as $v):
                            $v_price = get_post_meta($v->ID, '_gia_ban_thuc_te', true);
                            $v_sku = get_post_meta($v->ID, '_ma_sku', true);
                            $v_size = get_post_meta($v->ID, '_kich_co', true);
                        ?>
                            <option value="<?php echo esc_attr($v->ID); ?>" data-price="<?php echo esc_attr($v_price); ?>" <?php selected(isset($item['variant_id']) ? $item['variant_id'] : '', $v->ID); ?>>
                                <?php echo esc_html($v->post_title); ?> [SKU: <?php echo esc_html($v_sku); ?> | <?php echo esc_html($v_size); ?>]
                            </option>
                        <?php endforeach; ?>
                    </select>
                </td>
                <td>
                    <input type="number" min="1" name="order_items[<?php echo $index; ?>][so_luong]" value="<?php echo esc_attr(isset($item['so_luong']) ? $item['so_luong'] : 1); ?>" class="item-qty" style="width:100%;">
                </td>
                <td>
                    <input type="number" step="1000" name="order_items[<?php echo $index; ?>][don_gia]" value="<?php echo esc_attr(isset($item['don_gia']) ? $item['don_gia'] : 0); ?>" class="item-price" style="width:100%;">
                </td>
                <td>
                    <input type="number" name="order_items[<?php echo $index; ?>][thanh_tien]" value="<?php echo esc_attr(isset($item['thanh_tien']) ? $item['thanh_tien'] : 0); ?>" class="item-total" style="width:100%; font-weight:bold;">
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <p class="description" style="margin-top:10px;">💡 Hệ thống ghi nhận chi tiết thực thể quan hệ 1:N giữa <strong>ĐƠN HÀNG</strong> và <strong>CHI TIẾT ĐƠN HÀNG</strong>.</p>
    <?php
}

// Lưu dữ liệu Đơn Hàng
add_action('save_post_don_hang_mu', 'biker_t5_save_don_hang_meta');
function biker_t5_save_don_hang_meta($post_id) {
    if (!isset($_POST['biker_t5_don_hang_nonce']) || !wp_verify_nonce($_POST['biker_t5_don_hang_nonce'], 'biker_t5_save_don_hang_meta')) {
        return;
    }
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return;
    }
    if (!current_user_can('edit_post', $post_id)) {
        return;
    }

    $fields = array('nguoi_nhan', 'sdt_nhan', 'dia_chi_giao', 'phuong_thuc_tt', 'trang_thai', 'tong_tien');
    foreach ($fields as $field) {
        if (isset($_POST[$field])) {
            update_post_meta($post_id, '_' . $field, sanitize_text_field($_POST[$field]));
        }
    }

    if (isset($_POST['order_items']) && is_array($_POST['order_items'])) {
        $clean_items = array();
        foreach ($_POST['order_items'] as $item) {
            if (!empty($item['variant_id'])) {
                $clean_items[] = array(
                    'variant_id' => intval($item['variant_id']),
                    'so_luong'   => intval($item['so_luong']),
                    'don_gia'    => floatval($item['don_gia']),
                    'thanh_tien' => floatval($item['thanh_tien']),
                );
            }
        }
        update_post_meta($post_id, '_chi_tiet_don_hang', $clean_items);
    }
}

// Cột hiển thị bảng Admin Đơn Hàng
add_filter('manage_don_hang_mu_posts_columns', 'biker_t5_don_hang_columns');
function biker_t5_don_hang_columns($columns) {
    return array(
        'cb'             => $columns['cb'],
        'title'          => 'Mã Đơn Hàng',
        'nguoi_nhan'     => 'Người Nhận',
        'sdt_nhan'       => 'SĐT',
        'phuong_thuc_tt' => 'Phương Thức TT',
        'tong_tien'      => 'Tổng Tiền',
        'trang_thai'     => 'Trạng Thái',
        'date'           => 'Ngày Đặt',
    );
}

add_action('manage_don_hang_mu_posts_custom_column', 'biker_t5_render_don_hang_columns', 10, 2);
function biker_t5_render_don_hang_columns($column, $post_id) {
    switch ($column) {
        case 'nguoi_nhan':
            echo esc_html(get_post_meta($post_id, '_nguoi_nhan', true) ?: '—');
            break;
        case 'sdt_nhan':
            echo esc_html(get_post_meta($post_id, '_sdt_nhan', true) ?: '—');
            break;
        case 'phuong_thuc_tt':
            echo esc_html(get_post_meta($post_id, '_phuong_thuc_tt', true) ?: 'COD');
            break;
        case 'tong_tien':
            $val = get_post_meta($post_id, '_tong_tien', true);
            echo $val ? '<strong style="color:#d63638;">' . number_format(floatval($val), 0, ',', '.') . ' đ</strong>' : '0 đ';
            break;
        case 'trang_thai':
            $status = get_post_meta($post_id, '_trang_thai', true) ?: 'cho_duyet';
            $map = array(
                'cho_duyet'  => array('⏳ Chờ Duyệt', '#f39c12'),
                'dang_xu_ly' => array('⚙️ Đang Chuẩn Bị', '#3498db'),
                'dang_giao'  => array('🚚 Đang Giao', '#9b59b6'),
                'hoan_thanh' => array('✅ Hoàn Thành', '#2ecc71'),
                'da_huy'     => array('❌ Đã Hủy', '#e74c3c'),
            );
            $info = isset($map[$status]) ? $map[$status] : array($status, '#95a5a6');
            echo '<span style="background:' . $info[1] . '; color:#fff; padding:3px 10px; border-radius:4px; font-weight:600; font-size:12px;">' . $info[0] . '</span>';
            break;
    }
}
