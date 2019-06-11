<?php
/*
 * All CSS and JS files are enqueued from this file
 * Author & Copyright: VictorThemes
 * URL: https://victorthemes.com
 */

/**
 * Enqueue Files for FrontEnd
 */
if ( ! function_exists( 'elston_scripts_styles' ) ) {
  function elston_scripts_styles() {

    // Styles
    wp_enqueue_style( 'font-awesome', ELSTON_URI . '/inc/theme-options/cs-framework/assets/css/font-awesome.min.css' );
    wp_enqueue_style( 'bootstrap-css', ELSTON_CSS .'/bootstrap.min.css', array(), '3.3.6', 'all' );
    wp_enqueue_style( 'simple-line-icons', ELSTON_CSS .'/simple-line-icons.css', array(), '2.3.2', 'all' );
    wp_enqueue_style( 'elston-owl-carousel', ELSTON_CSS .'/owl.carousel.css', array(), '2.4', 'all' );
    wp_enqueue_style( 'elston-fullpage', ELSTON_CSS .'/fullpage.css', array(), '2.8.2', 'all' );
    wp_enqueue_style( 'elston-magnific-popup', ELSTON_CSS .'/magnific-popup.css', array(), ELSTON_VERSION, 'all' );
    wp_enqueue_style( 'elston-style', ELSTON_CSS .'/styles.css', array(), ELSTON_VERSION, 'all' );

    // Scripts
    wp_enqueue_script( 'bootstrap-js', ELSTON_SCRIPTS . '/bootstrap.min.js', array( 'jquery' ), '3.3.6', true );
    wp_enqueue_script( 'elston-hoverdir', ELSTON_SCRIPTS . '/hoverdir.js', array( 'jquery' ), '1.1.2', true );
    wp_enqueue_script( 'elston-plugins', ELSTON_SCRIPTS . '/plugins.js', array( 'jquery' ), ELSTON_VERSION, true );
    wp_enqueue_script( 'elston-scripts', ELSTON_SCRIPTS . '/scripts.js', array( 'jquery' ), ELSTON_VERSION, true );

    // Comments
    wp_enqueue_script( 'elston-validate-js', ELSTON_SCRIPTS . '/jquery.validate.min.js', array( 'jquery' ), '1.9.0', true );
    wp_add_inline_script( 'elston-validate-js', 'jQuery(document).ready(function($) {$("#commentform").validate({rules: {author: {required: true,minlength: 2},email: {required: true,email: true},comment: {required: true,minlength: 10}}});});' );

    // WooCommerce
    if (class_exists( 'WooCommerce' )){
      wp_enqueue_style( 'elston-woocommerce-layout', ELSTON_URI . '/inc/plugins/woocommerce/woocommerce-layout.css', null, 1.0, 'all' );
      wp_enqueue_style( 'elston-woocommerce', ELSTON_URI . '/inc/plugins/woocommerce/woocommerce.css', null, 1.0, 'all' );
    }

    // Responsive Active
    $viewport = cs_get_option('theme_responsive');
    if($viewport == 'on') {
      wp_enqueue_style( 'elston-responsive', ELSTON_CSS .'/responsive.css', array(), ELSTON_VERSION, 'all' );
    }

    // Comments JS
    if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
      wp_enqueue_script( 'comment-reply' );
    }

  }
  add_action( 'wp_enqueue_scripts', 'elston_scripts_styles' );
}

/**
 * Enqueue Files for BackEnd
 */
if ( ! function_exists( 'elston_admin_scripts_styles' ) ) {
  function elston_admin_scripts_styles() {

    wp_enqueue_style('admin-main', ELSTON_CSS . '/admin-styles.css', __FILE__);
    wp_enqueue_style('simple-line-icons', ELSTON_CSS . '/simple-line-icons.css', __FILE__);
    wp_enqueue_script('admin-scripts', ELSTON_SCRIPTS . '/admin-scripts.js', __FILE__);

  }
  add_action( 'admin_enqueue_scripts', 'elston_admin_scripts_styles' );
}

/* Enqueue All Styles */
if ( ! function_exists( 'elston_framework_wp_enqueue_styles' ) ) {
  function elston_framework_wp_enqueue_styles() {

    elston_google_fonts();

    add_action( 'wp_head', 'elston_custom_css', 99 );
    add_action( 'wp_head', 'elston_custom_js', 99 );

    if ( is_child_theme() ){
      wp_enqueue_style( 'elston_child', get_stylesheet_uri() );
    }

  }
  add_action( 'wp_enqueue_scripts', 'elston_framework_wp_enqueue_styles' );
}
