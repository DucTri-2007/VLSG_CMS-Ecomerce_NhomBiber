<?php
function biber_helmets_enqueue_styles() {
    wp_enqueue_style('biber-helmets-style', get_stylesheet_uri());
}
add_action('wp_enqueue_scripts', 'biber_helmets_enqueue_styles');

// AJAX handler để lấy logout URL có nonce
add_action('wp_ajax_biker_get_logout_url', 'biker_get_logout_url_handler');
add_action('wp_ajax_nopriv_biker_get_logout_url', 'biker_get_logout_url_handler');
function biker_get_logout_url_handler() {
    echo wp_logout_url(home_url('/trang-chu.html'));
    wp_die();
}
