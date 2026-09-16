<?php
header('Content-Type: text/plain');
error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once(__DIR__ . '/wp-load.php');

// 1. Configure Payment Methods (COD & BACS)
update_option('woocommerce_cod_settings', array(
    'enabled'     => 'yes',
    'title'       => 'Thanh toán khi nhận hàng (COD)',
    'description' => 'Thanh toán bằng tiền mặt khi nhận hàng tận nơi.',
    'instructions'=> 'Vui lòng chuẩn bị đúng số tiền mặt khi nhân viên giao hàng đến.'
));

update_option('woocommerce_bacs_settings', array(
    'enabled'      => 'yes',
    'title'        => 'Chuyển khoản ngân hàng',
    'description'  => 'Thực hiện thanh toán vào tài khoản ngân hàng của Biber Helmets.',
    'instructions' => 'Nội dung chuyển khoản: [Mã đơn hàng] - [Số điện thoại]',
    'account_details' => array(
        array(
            'account_name'   => 'BIBER HELMETS - NHOM BIBER',
            'account_number' => '999988887777',
            'bank_name'      => 'Ngân hàng MBBank (Quân Đội)',
            'sort_code'      => '',
            'iban'           => '',
            'bic'            => ''
        )
    )
));

// Update active gateways option
update_option('woocommerce_gateway_order', array('cod' => 1, 'bacs' => 2));

// 2. Configure Shipping Zones & Rates
global $wpdb;

// Clean existing zones if needed or ensure Nội thành & Toàn quốc exist
$wpdb->query("DELETE FROM {$wpdb->prefix}woocommerce_shipping_zones WHERE zone_id > 0");
$wpdb->query("DELETE FROM {$wpdb->prefix}woocommerce_shipping_zone_methods WHERE zone_id > 0");

// Zone 1: Nội thành (30.000 VNĐ)
$wpdb->insert("{$wpdb->prefix}woocommerce_shipping_zones", array('zone_name' => 'Nội thành', 'zone_order' => 1));
$zone1_id = $wpdb->insert_id;
$wpdb->insert("{$wpdb->prefix}woocommerce_shipping_zone_methods", array('zone_id' => $zone1_id, 'method_id' => 'flat_rate', 'method_order' => 1, 'is_enabled' => 1));
$instance1_id = $wpdb->insert_id;
update_option("woocommerce_flat_rate_{$instance1_id}_settings", array('title' => 'Giao hàng Nội thành', 'cost' => '30000', 'tax_status' => 'none'));

// Zone 2: Toàn quốc (50.000 VNĐ)
$wpdb->insert("{$wpdb->prefix}woocommerce_shipping_zones", array('zone_name' => 'Toàn quốc', 'zone_order' => 2));
$zone2_id = $wpdb->insert_id;
$wpdb->insert("{$wpdb->prefix}woocommerce_shipping_zone_methods", array('zone_id' => $zone2_id, 'method_id' => 'flat_rate', 'method_order' => 1, 'is_enabled' => 1));
$instance2_id = $wpdb->insert_id;
update_option("woocommerce_flat_rate_{$instance2_id}_settings", array('title' => 'Giao hàng Toàn quốc', 'cost' => '50000', 'tax_status' => 'none'));

echo "Configured Payment Methods (COD & BACS) and Shipping Zones (Nội thành 30k & Toàn quốc 50k) successfully!\n";
?>
