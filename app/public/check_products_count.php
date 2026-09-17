<?php
header('Content-Type: text/plain');
error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once(__DIR__ . '/wp-load.php');

$products = get_posts(array(
    'post_type'   => 'product',
    'post_status' => array('publish', 'draft', 'private'),
    'posts_per_page' => -1
));

echo "Total Products Count: " . count($products) . "\n";
foreach ($products as $p) {
    echo "- ID: {$p->ID}, SKU: " . get_post_meta($p->ID, '_sku', true) . ", Title: {$p->post_title}\n";
}
?>
