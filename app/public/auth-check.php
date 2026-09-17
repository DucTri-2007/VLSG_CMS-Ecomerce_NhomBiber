<?php
require_once('wp-load.php');
header('Content-Type: application/json');
if (is_user_logged_in()) {
    $user = wp_get_current_user();
    echo json_encode([
        'logged_in' => true,
        'name' => $user->display_name,
        'roles' => $user->roles,
        'logout_url' => wp_logout_url(home_url('/trang-chu.html'))
    ]);
} else {
    echo json_encode(['logged_in' => false]);
}
