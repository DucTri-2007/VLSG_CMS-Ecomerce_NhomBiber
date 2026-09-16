<?php
header('Content-Type: text/plain');
error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once(__DIR__ . '/wp-load.php');

// Create submission folder
$submission_dir = 'C:/Users/DELL/.gemini/antigravity-ide/brain/99cecffb-25df-47ca-b41e-71da0a53bdf7/b11_submission';
if (!file_exists($submission_dir)) {
    mkdir($submission_dir, 0777, true);
}

// Generate File_ProductData.csv
$csv_file = $submission_dir . '/File_ProductData.csv';
$fp = fopen($csv_file, 'w');
// UTF-8 BOM
fputs($fp, "\xEF\xBB\xBF");

// CSV Header
fputcsv($fp, array(
    'ID', 'Type', 'SKU', 'Name', 'Published', 'Is featured?', 'Visibility in catalog',
    'Short description', 'Description', 'Tax status', 'In stock?', 'Stock',
    'Regular price', 'Categories', 'Images'
));

$products = get_posts(array(
    'post_type'      => 'product',
    'post_status'    => array('publish'),
    'posts_per_page' => -1,
    'orderby'        => 'ID',
    'order'          => 'ASC'
));

foreach ($products as $p) {
    $product_id = $p->ID;
    $sku = get_post_meta($product_id, '_sku', true);
    $price = get_post_meta($product_id, '_regular_price', true);
    $stock = get_post_meta($product_id, '_stock', true);
    if (!$stock) $stock = 50;
    
    // Categories
    $terms = wp_get_post_terms($product_id, 'product_cat', array('fields' => 'names'));
    $categories = implode(', ', $terms);

    // Image URL
    $thumb_id = get_post_thumbnail_id($product_id);
    $img_url = wp_get_attachment_url($thumb_id);
    if (!$img_url) $img_url = 'https://images.unsplash.com/photo-1558981806-ec527fa84c39?w=600';

    fputcsv($fp, array(
        $product_id,
        'simple',
        $sku ? $sku : 'MBH-' . $product_id,
        $p->post_title,
        1,
        0,
        'visible',
        'Mũ bảo hiểm Biber chính hãng đạt chuẩn an toàn ECE 22.06 & DOT.',
        $p->post_content,
        'none',
        1,
        $stock,
        $price ? $price : '1500000',
        $categories ? $categories : 'Mũ Bảo Hiểm',
        $img_url
    ));
}

fclose($fp);
echo "Successfully generated File_ProductData.csv at $csv_file with " . count($products) . " items!\n";
?>
