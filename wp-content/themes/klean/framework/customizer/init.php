<?php
/**
 * klean Theme Customizer
 *
 * @package klean
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function klean_customize_register( $wp_customize ) {
    $wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
    $wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
    $wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';
    $wp_customize->get_control( 'header_textcolor' )->label		= __('Site Title Color', 'klean');
    $wp_customize->get_control( 'header_textcolor' )->priority	= 11;
    $wp_customize->remove_section( 'nav' );
}
add_action( 'customize_register', 'klean_customize_register' );

require_once get_template_directory().'/framework/customizer/_customizer_controls.php';
require_once get_template_directory().'/framework/customizer/_layouts.php';
require_once get_template_directory().'/framework/customizer/_googlefonts.php';
require_once get_template_directory().'/framework/customizer/_sanitization.php';
require_once get_template_directory().'/framework/customizer/_misc_scripts.php';
require_once get_template_directory().'/framework/customizer/init.php';
require_once get_template_directory().'/framework/customizer/header.php';
require_once get_template_directory().'/framework/customizer/skins.php';
require_once get_template_directory().'/framework/customizer/social-icons.php';

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function klean_customize_preview_js() {
    wp_enqueue_script( 'klean_customizer', get_template_directory_uri() . '/js/customizer.js', array( 'customize-preview' ), '20130508', true );
}
add_action( 'customize_preview_init', 'klean_customize_preview_js' );

