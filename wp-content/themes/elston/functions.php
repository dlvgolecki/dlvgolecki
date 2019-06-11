<?php
/*
 * Elston Theme's Functions
 * Author & Copyright: VictorThemes
 * URL: https://victorthemes.com
 */

/**
 * Define - Folder Paths
 */
define( 'ELSTON_PATH', get_template_directory() );
define( 'ELSTON_URI', get_template_directory_uri() );
define( 'ELSTON_CSS', ELSTON_URI . '/assets/css' );
define( 'ELSTON_IMAGES', ELSTON_URI . '/assets/images' );
define( 'ELSTON_SCRIPTS', ELSTON_URI . '/assets/js' );
define( 'ELSTON_FRAMEWORK', get_template_directory() . '/inc' );
define( 'ELSTON_LAYOUT', get_template_directory() . '/layouts' );
define( 'ELSTON_CS_IMAGES', ELSTON_URI . '/inc/theme-options/theme-extend/images' );
define( 'ELSTON_CS_FRAMEWORK', get_template_directory() . '/inc/theme-options/theme-extend' ); // Called in Icons field *.json
define( 'ELSTON_ADMIN_PATH', get_template_directory() . '/inc/theme-options/cs-framework' ); // Called in Icons field *.json

/**
 * Define - Global Theme Info's
 */
if (is_child_theme()) { // If Child Theme Active
	$elston_child = wp_get_theme();
	$elston_get_parent = $elston_child->Template;
	$elston_theme = wp_get_theme($elston_get_parent);
} else { // Parent Theme Active
	$elston_theme = wp_get_theme();
}
define('ELSTON_NAME', $elston_theme->get( 'Name' ), true);
define('ELSTON_VERSION', $elston_theme->get( 'Version' ), true);
define('ELSTON_BRAND_URL', $elston_theme->get( 'AuthorURI' ), true);
define('ELSTON_BRAND_NAME', $elston_theme->get( 'Author' ), true);


/**
 * All Main Files Include
 */
require_once( ELSTON_FRAMEWORK . '/init.php' );
