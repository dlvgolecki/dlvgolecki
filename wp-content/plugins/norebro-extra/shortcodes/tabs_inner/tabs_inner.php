<?php 

/**
* Visual Composer Norebro Tabs Inner shortcode
*/

add_shortcode( 'norebro_tabs_inner', 'norebro_tabs_inner_func' );

function norebro_tabs_inner_func( $atts, $content_html = '' ) {
	if ( isset( $atts ) && is_array( $atts ) ) extract( $atts );

	// Default values, parsing and filtering
	$title = isset( $title ) ? NorExtraFilter::string( $title, 'string', '' ) : '';
	$tab_id = isset( $tab_id ) ? NorExtraFilter::string( $tab_id, 'attr', '' ) : '';

	$css_class = isset( $css_class ) ? ' ' . NorExtraFilter::string( $css_class, 'attr', '' )  : '';

	// Assembling
	ob_start();
	include( plugin_dir_path( __FILE__ ) . 'tabs_inner__view.php' );
	return ob_get_clean();
}