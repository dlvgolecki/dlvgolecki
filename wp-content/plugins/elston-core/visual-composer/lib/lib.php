<?php
/**
 * Visual Composer Library
 * Common Fields
 */
class VictorLib {

	// Get Theme Name
	public static function elstn_cat_name() {
		return __( "by VictorThemes", 'elston-core' );
	}

	// Extra Class
	public static function elston_class() {
		return array(
		  "type" => "textfield",
		  "heading" => __( "Extra class name", 'elston-core' ),
		  "param_name" => "class",
		  'value' => '',
		  "description" => __( "Custom styled class name.", 'elston-core')
		);
	}

}

/*
 * Load All Shortcodes within a directory of visual-composer/shortcodes
 */
function elstn_all_shortcodes() {
	$dirs = glob( ELSTN_SHORTCODE_PATH . '*', GLOB_ONLYDIR );
	if ( !$dirs ) return;
	foreach ($dirs as $dir) {
		$dirname = basename( $dir );

		/* Include all shortcodes backend options file */
		$options_file = $dir . ELSTN_DS . $dirname . '-options.php';
		$options = array();
		if ( file_exists( $options_file ) ) {
			include_once( $options_file );
		} else {
			continue;
		}

		/* Include all shortcodes frondend options file */
		$shortcode_class_file = $dir . ELSTN_DS . $dirname .'.php';
		if ( file_exists( $shortcode_class_file ) ) {
			include_once( $shortcode_class_file );
		}
	}
}
elstn_all_shortcodes();

if( ! function_exists( 'vc_add_shortcode_param' ) && function_exists( 'add_shortcode_param' ) ) {
  function vc_add_shortcode_param( $name, $form_field_callback, $script_url = null ) {
    return add_shortcode_param( $name, $form_field_callback, $script_url );
  }
}

/* Inline Style */
global $all_inline_styles;
$all_inline_styles = array();
if( ! function_exists( 'add_inline_style' ) ) {
  function add_inline_style( $style ) {
    global $all_inline_styles;
    array_push( $all_inline_styles, $style );
  }
}

/* Enqueue Inline Styles */
if ( ! function_exists( 'elstn_enqueue_inline_styles' ) ) {
  function elstn_enqueue_inline_styles() {

    global $all_inline_styles;

    if ( ! empty( $all_inline_styles ) ) {
      echo '<style id="elston-inline-style" type="text/css">'. elston_compress_css_lines( join( '', $all_inline_styles ) ) .'</style>';
    }

  }
  add_action( 'wp_footer', 'elstn_enqueue_inline_styles' );
}

/* Validate px entered in field */
if( ! function_exists( 'elstn_check_px' ) ) {
  function elstn_check_px( $num ) {
    return ( is_numeric( $num ) ) ? $num . 'px' : $num;
  }
}

/* Tabs Fileds */
if( function_exists( 'elstn_vt_tabs_function' ) ) {
  add_shortcode( 'vc_tabs', 'elstn_vt_tabs_function' );
  add_shortcode( 'vc_tab', 'elstn_vt_tab_function' );
}
