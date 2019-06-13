<?php
/**
 * Enqueue the stylesheet.
 */
function klean_custom_wp_admin_style() {
    wp_enqueue_style( 'font-awesome', get_template_directory_uri() . '/assets/font-awesome/css/font-awesome.min.css' );
    wp_enqueue_style( 'klean-admin_css', get_template_directory_uri() . '/assets/css/admin.css' );
}
add_action( 'customize_controls_print_styles', 'klean_custom_wp_admin_style' );


function klean_add_editor_styles() {
    add_editor_style( 'editor-style.css' );
}
add_action( 'admin_init', 'klean_add_editor_styles' );