<?php
header('Content-Type: text/plain');
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Direct MySQLi connection using wp-config.php settings
$db_name = 'local';
$db_user = 'root';
$db_pass = 'root';
$db_host = 'localhost';

$conn = new mysqli($db_host, $db_user, $db_pass, $db_name);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

echo "Connected successfully to database: $db_name\n";

// List all tables
$result = $conn->query("SHOW TABLES");
echo "Tables:\n";
while ($row = $result->fetch_array()) {
    echo "- " . $row[0] . "\n";
}

// Get blogname and siteurl options
$result = $conn->query("SELECT option_value FROM wp_options WHERE option_name = 'blogname'");
if ($result) {
    $row = $result->fetch_assoc();
    echo "blogname option: " . ($row['option_value'] ?? 'not found') . "\n";
} else {
    echo "Error querying blogname: " . $conn->error . "\n";
}

$result = $conn->query("SELECT option_value FROM wp_options WHERE option_name = 'siteurl'");
if ($result) {
    $row = $result->fetch_assoc();
    echo "siteurl option: " . ($row['option_value'] ?? 'not found') . "\n";
} else {
    echo "Error querying siteurl: " . $conn->error . "\n";
}
?>
