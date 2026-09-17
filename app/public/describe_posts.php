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

$res = $conn->query("DESCRIBE wp_posts");
while ($row = $res->fetch_assoc()) {
    echo "{$row['Field']} | {$row['Type']} | Null: {$row['Null']} | Default: {$row['Default']}\n";
}
?>
