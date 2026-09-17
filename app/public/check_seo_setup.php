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

// Active plugins
$res = $conn->query("SELECT option_value FROM wp_options WHERE option_name = 'active_plugins'");
if ($res && $row = $res->fetch_assoc()) {
    $plugins = unserialize($row['option_value']);
    echo "Active Plugins:\n";
    print_r($plugins);
}

// Existing posts
$res = $conn->query("SELECT ID, post_title, post_status, post_date FROM wp_posts WHERE post_type = 'post'");
echo "\nExisting Posts:\n";
while ($row = $res->fetch_assoc()) {
    echo "- ID: {$row['ID']}, Title: {$row['post_title']}, Status: {$row['post_status']}, Date: {$row['post_date']}\n";
}
?>
