<?php
/*
Plugin Name: Elston Core
Plugin URI: https://victorthemes.com/themes/elston
Description: Plugin to contain shortcodes and custom post types of this theme.
Author: VictorThemes
Author URI: https://victorthemes.com/
Version: 1.4.1
Text Domain: elston-core
*/

if( ! function_exists( 'elston_core_direct_access' ) ) {
	function elston_core_direct_access() {
		if( ! defined( 'ABSPATH' ) ) {
			exit( 'Forbidden' );
		}
	}
}

// Plugin URL
define( 'ELSTN_PLUGIN_URL', plugins_url( '/', __FILE__ ) );

// Plugin PATH
define( 'ELSTN_PLUGIN_PATH', plugin_dir_path( __FILE__ ) );
define( 'ELSTN_PLUGIN_ASTS', ELSTN_PLUGIN_URL . 'assets' );
define( 'ELSTN_PLUGIN_INC', ELSTN_PLUGIN_PATH . 'inc' );

// DIRECTORY SEPARATOR
define ( 'ELSTN_DS' , DIRECTORY_SEPARATOR );

// VictorThemes Shortcode Path
define( 'ELSTN_SHORTCODE_BASE_PATH', ELSTN_PLUGIN_PATH . 'visual-composer/' );
define( 'ELSTN_SHORTCODE_PATH', ELSTN_SHORTCODE_BASE_PATH . 'shortcodes/' );

/**
 * Check if Codestar Framework is Active or Not!
 */
function is_cs_framework_active() {
  return ( defined( 'CS_VERSION' ) ) ? true : false;
}

/* VTHEME_NAME_P */
define('VTHEME_NAME_P', 'Elston', true);

// Initial File
include_once( ABSPATH . 'wp-admin/includes/plugin.php' );
if (is_plugin_active('elston-core/elston-core.php')) {

	// Custom Post Types
	require_once( ELSTN_PLUGIN_INC . '/custom-post-type.php' );

  /* One Click Install */
  require_once( ELSTN_PLUGIN_INC . '/import/init.php' );

  // Shortcodes
  require_once( ELSTN_SHORTCODE_BASE_PATH . '/vc-setup.php' );
  require_once( ELSTN_PLUGIN_INC . '/custom-shortcodes/theme-shortcodes.php' );
  require_once( ELSTN_PLUGIN_INC . '/custom-shortcodes/custom-shortcodes.php' );

}

/**
 * Plugin language
 */
function elston_plugin_language_setup() {
  load_plugin_textdomain( 'elston-core', false, dirname( plugin_basename( __FILE__ ) ) . '/languages' );
}
add_action( 'init', 'elston_plugin_language_setup' );

/* WPAUTOP for shortcode output */
if( ! function_exists( 'elston_set_wpautop' ) ) {
  function elston_set_wpautop( $content, $force = true ) {
    if ( $force ) {
      $content = wpautop( preg_replace( '/<\/?p\>/', "\n", $content ) . "\n" );
    }
    return do_shortcode( shortcode_unautop( $content ) );
  }
}

/* Use shortcodes in text widgets */
add_filter('widget_text', 'do_shortcode');

/* Shortcodes enable in the_excerpt */
add_filter('the_excerpt', 'do_shortcode');

/* Remove p tag and add by our self in the_excerpt */
remove_filter('the_excerpt', 'wpautop');

/**
 *
 * Encode string for backup options
 *
 * @since 1.0.0
 * @version 1.0.0
 *
 */
if ( ! function_exists( 'cs_encode_string' ) ) {
  function cs_encode_string( $string ) {
    return rtrim( strtr( call_user_func( 'base'. '64' .'_encode', addslashes( gzcompress( serialize( $string ), 9 ) ) ), '+/', '-_' ), '=' );
  }
}

/**
 *
 * Decode string for backup options
 *
 * @since 1.0.0
 * @version 1.0.0
 *
 */
if ( ! function_exists( 'cs_decode_string' ) ) {
  function cs_decode_string( $string ) {
    return unserialize( gzuncompress( stripslashes( call_user_func( 'base'. '64' .'_decode', rtrim( strtr( $string, '-_', '+/' ), '=' ) ) ) ) );
  }
}

/* Add Extra Social Fields in Admin User Profile */
if( ! function_exists( 'elston_theme_add_twitter_facebook' ) ) {
  function elston_theme_add_twitter_facebook( $contactmethods ) {
    $contactmethods['facebook']   = 'Facebook';
    $contactmethods['twitter']    = 'Twitter';
    $contactmethods['google_plus']  = 'Google Plus';
    $contactmethods['linkedin']   = 'Linkedin';
    return $contactmethods;
  }
  add_filter('user_contactmethods','elston_theme_add_twitter_facebook',10,1);
}
