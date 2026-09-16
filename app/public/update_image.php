<?php
header('Content-Type: text/plain');
error_reporting(E_ALL);
ini_set('display_errors', 1);

$db_name = 'local';
$db_user = 'root';
$db_pass = 'root';
$db_host = 'localhost';

$conn = new mysqli($db_host, $db_user, $db_pass, $db_name);
if ($conn->connect_error) {
    die("DB connection failed: " . $conn->connect_error);
}

// New high quality helmet image URL
$old_url = 'https://images.unsplash.com/photo-1599819811279-d5ad9cccf838?auto=format&fit=crop&w=800&q=80';
$new_url = 'https://images.unsplash.com/photo-1558981806-ec527fa84c39?auto=format&fit=crop&w=800&q=80';

// Replace in wp_posts for front page / Trang chủ
$stmt = $conn->prepare("UPDATE wp_posts SET post_content = REPLACE(post_content, ?, ?) WHERE post_type = 'page'");
$stmt->bind_param("ss", $old_url, $new_url);
$stmt->execute();

echo "Replaced image in " . $stmt->affected_rows . " page(s).\n";
?>
