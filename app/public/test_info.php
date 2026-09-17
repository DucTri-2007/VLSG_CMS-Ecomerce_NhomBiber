<?php
header('Content-Type: text/plain');
error_reporting(E_ALL);
ini_set('display_errors', 1);
require_once __DIR__ . '/wp-load.php';

global $wpdb;
echo "Searching database for 'Pardon our dust'...\n";
$tables = $wpdb->get_col("SHOW TABLES");
foreach ($tables as $table) {
    $columns = $wpdb->get_col("DESCRIBE `$table`");
    $where = array();
    foreach ($columns as $col) {
        $where[] = "`$col` LIKE '%Pardon our dust%'";
    }
    if (!empty($where)) {
        $sql = "SELECT * FROM `$table` WHERE " . implode(" OR ", $where) . " LIMIT 5";
        $results = $wpdb->get_results($sql, ARRAY_A);
        if (!empty($results)) {
            echo "Found in Table: $table\n";
            foreach ($results as $row) {
                // Print key fields
                if (isset($row['ID'])) echo "ID: " . $row['ID'] . "\n";
                if (isset($row['post_title'])) echo "Post Title: " . $row['post_title'] . "\n";
                if (isset($row['post_type'])) echo "Post Type: " . $row['post_type'] . "\n";
                if (isset($row['option_name'])) echo "Option Name: " . $row['option_name'] . "\n";
            }
        }
    }
}
echo "Search finished.\n";
?>
