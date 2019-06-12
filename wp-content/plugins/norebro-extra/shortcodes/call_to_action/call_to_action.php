<?php 

/**
* Visual Composer Norebro Call To Action shortcode
*/

add_shortcode( 'norebro_call_to_action', 'norebro_call_to_action_func' );

function norebro_call_to_action_func( $atts ) {
	$title = $subtitle = $without_side_paddings = $icon_use = $icon_position = $icon_type = $icon_as_icon = 
	$icon_as_image = $title_typo = $subtitle_typo = $bg_color = $title_color = $subtitle_color = $readmore_button = 
	$link = $appearance_effect = $appearance_duration = $css_class = NULL;
	if ( isset( $atts ) && is_array( $atts ) ) extract( $atts );

	// Default values, parsing and filtering
	$title = rawurldecode( base64_decode( isset( $title ) ? $title : '' ) );
	$title = NorExtraFilter::string( $title, 'string', '' );
	$subtitle = rawurldecode( base64_decode( isset( $subtitle ) ? $subtitle : '' ) );
	$subtitle = NorExtraFilter::string( $subtitle, 'string', '' );
	$without_side_paddings = NorExtraFilter::boolean( $without_side_paddings );

	$icon_use = NorExtraFilter::boolean( $icon_use );
	$icon_position = NorExtraFilter::string( $icon_position, 'string', 'left' );
	$icon_type = NorExtraFilter::string( $icon_type, 'string', 'font_icon' );
	$icon_as_icon = NorExtraFilter::string( $icon_as_icon, 'string', '' );
	$icon_as_image = NorExtraFilter::string( $icon_as_image, 'string', '' );

	$title_typo = NorExtraFilter::string( $title_typo );
	$subtitle_typo = NorExtraFilter::string( $subtitle_typo );

	$bg_color = NorExtraFilter::string( $bg_color );
	$title_color = NorExtraFilter::string( $title_color );
	$subtitle_color = NorExtraFilter::string( $subtitle_color );
	$readmore_button = NorExtraFilter::string( $readmore_button );

	$link = NorExtraParser::VC_link_params( ( $link ) ? $link : '', array( 'caption' => '' ) );

	$appearance_effect = NorExtraFilter::string( $appearance_effect, 'attr', 'none' );
	$appearance_duration = NorExtraFilter::string( $appearance_duration, 'attr', false );
	if ( $appearance_duration ) $appearance_duration = intval( str_replace( 'ms', '', $appearance_duration ) );

	$css_class = ( $css_class ) ? ' ' . NorExtraFilter::string( $css_class, 'attr', '' ) : '';

	// Styling
	$call_to_action_uniqid = uniqid( 'norebro-custom-' );

	if ( $icon_type == 'font_icon' && $icon_as_icon ) {
		$GLOBALS['norebro_icon_fonts'][] = $icon_as_icon;
	}

	$readmore_button = preg_replace( '/\&amp\;/', '&', $readmore_button );
	parse_str( $readmore_button, $button_settings );
	$button_css = NorExtraParser::VC_button_to_css( $button_settings );

	$call_to_action_settings = NorExtraParser::VC_color_to_CSS( $bg_color, 'background-color:{{color}};' );
	$title_settings = NorExtraParser::VC_color_to_CSS( $title_color, 'color:{{color}};' );
	$subtitle_settings = NorExtraParser::VC_color_to_CSS( $subtitle_color, 'color:{{color}};' );

	$title_settings .= NorExtraParser::VC_typo_to_CSS( $title_typo );
	$subtitle_settings .= NorExtraParser::VC_typo_to_CSS( $subtitle_typo );

	NorExtraParser::VC_typo_custom_font( $title_typo );
	NorExtraParser::VC_typo_custom_font( $subtitle_typo );

	if ( $without_side_paddings ) {
		$call_to_action_settings .= ' padding-left:0;padding-right:0;';
	}

	// Assembling
	include( plugin_dir_path( __FILE__ ) . 'call_to_action__style.php' );
	ob_start();
	include( plugin_dir_path( __FILE__ ) . 'call_to_action__view.php' );
	return ob_get_clean();
}