<?php 

/**
* Visual Composer Norebro Team Members Group shortcode
*/

add_shortcode( 'norebro_team_members_group', 'norebro_team_members_group_func' );

function norebro_team_members_group_func( $atts, $content = '' ) {
	if ( isset( $atts ) && is_array( $atts ) ) extract( $atts );

	// Default values, parsing and filtering
	$content_bg = isset( $content_bg ) ? NorExtraFilter::string( $content_bg ) : false;
	
	$appearance_effect = isset( $appearance_effect ) ? NorExtraFilter::string( $appearance_effect, 'attr', 'none' ) : 'none';
	$appearance_duration = isset( $appearance_duration ) ? NorExtraFilter::string( $appearance_duration, 'attr', false ) : false;
	if ( $appearance_duration ) $appearance_duration = intval( str_replace( 'ms', '', $appearance_duration ) );

	$css_class = isset( $css_class ) ? ' ' . NorExtraFilter::string( $css_class, 'attr', '' )  : '';

	// Styling
	$team_group_uniqid = uniqid( 'argenta-custom-' );

	$content_bg_css = '';
	if ( $content_bg ) {
		$content_bg_css = 'background-color:' . $content_bg . ';';
	}

	// Assembling
	include( plugin_dir_path( __FILE__ ) . 'team_members_group__style.php' );
	ob_start();
	include( plugin_dir_path( __FILE__ ) . 'team_members_group__view.php' );
	return ob_get_clean();
}