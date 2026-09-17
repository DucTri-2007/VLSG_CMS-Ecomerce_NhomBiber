<?php
require_once('wp-load.php');
$themes = wp_get_themes(array('errors' => null));
echo "All themes:\n";
foreach ($themes as $slug => $theme) {
    echo $slug . " - " . $theme->get('Name') . "\n";
    if ($theme->errors()) {
        echo "  Errors: " . print_r($theme->errors(), true) . "\n";
    }
}
$broken = wp_get_themes(array('errors' => true));
echo "\nBroken themes:\n";
foreach ($broken as $slug => $theme) {
    echo $slug . " - " . $theme->get('Name') . "\n";
    echo "  Errors: " . print_r($theme->errors(), true) . "\n";
}
