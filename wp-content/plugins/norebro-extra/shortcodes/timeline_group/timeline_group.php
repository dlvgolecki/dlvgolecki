<?php 

/**
* Visual Composer Norebro Time Line Group shortcode
*/

add_shortcode( 'norebro_timeline_group', 'norebro_timeline_group_func' );

function norebro_timeline_group_func( $atts, $content = '' ) {
	if ( isset( $atts ) && is_array( $atts ) ) extract( $atts );

	// Default values, parsing and filtering
	$alignment = isset( $alignment ) ? NorExtraFilter::string( $alignment, 'string', 'left' ) : 'left';
	$css_class = isset( $css_class ) ? ' ' . NorExtraFilter::string( $css_class, 'attr', '' )  : '';

	if ( $alignment == 'right' ) {
		$css_class .= ' right';
	}

	// Assembling
	ob_start();
	include( plugin_dir_path( __FILE__ ) . 'timeline_group__view.php' );
	return ob_get_clean();
}