<?php

/**
* Visual Composer Norebro Video shortcode
*/

add_shortcode( 'norebro_video', 'norebro_video_func' );

function norebro_video_func( $atts ) {
	if ( isset( $atts ) && is_array( $atts ) ) extract( $atts );

	// Default values, parsing and filtering
	$layout = isset( $layout ) ? NorExtraFilter::string( $layout, 'string', 'boxed_shape') : 'boxed_shape';
	$button_layout = isset( $button_layout ) ? NorExtraFilter::string( $button_layout, 'string', 'filled') : 'filled';
	$preview_image = isset( $preview_image ) ? wp_get_attachment_url( $preview_image ) : false;
	$link = isset( $link ) ? NorExtraFilter::string( $link, 'string', '' ) : '';
	$start_time = isset( $start_time ) ? NorExtraFilter::string( $start_time, 'string', '' ) : '';
	$title = isset( $title ) ? rawurldecode( base64_decode( $title ) ) : '';
	$title = NorExtraFilter::string( $title, 'string', '' );
	$alignment = isset( $alignment ) ? NorExtraFilter::string( $alignment, 'string', 'center' ) : 'center';

	$title_typo = isset( $title_typo ) ? NorExtraFilter::string( $title_typo ) : false;

	$background_color = isset( $background_color ) ? NorExtraFilter::string( $background_color, 'string', false ) : false;
	$border_color = isset( $border_color ) ? NorExtraFilter::string( $border_color, 'string', false ) : false;
	$button_shadow = isset( $button_shadow ) ? NorExtraFilter::boolean( $button_shadow ) : false;
	$button_anim = isset( $button_anim ) ? NorExtraFilter::boolean( $button_anim ) : false;
	$button_color = isset( $button_color ) ? NorExtraFilter::string( $button_color, 'string', false ) : false;
	$button_hover_color = isset( $button_hover_color ) ? NorExtraFilter::string( $button_hover_color, 'string', false ) : false;
	$icon_color = isset( $icon_color ) ? NorExtraFilter::string( $icon_color, 'string', false ) : false;
	$icon_hover_color = isset( $icon_hover_color ) ? NorExtraFilter::string( $icon_hover_color, 'string', false ) : false;
	$title_color = isset( $title_color ) ? NorExtraFilter::string( $title_color, 'string', false ) : false;

	$appearance_effect = isset( $appearance_effect ) ? NorExtraFilter::string( $appearance_effect, 'attr', 'none' ) : 'none';
	$appearance_duration = isset( $appearance_duration ) ? NorExtraFilter::string( $appearance_duration, 'attr', false ) : false;
	if ( $appearance_duration ) $appearance_duration = intval( str_replace( 'ms', '', $appearance_duration ) );

	$css_class = isset( $css_class ) ? ' ' . NorExtraFilter::string( $css_class, 'attr', '' ) : '';

	$url = parse_url( $link );

	// YouTube
	if ( isset( $url['host'] ) ) {
		if ( $url['host'] == 'www.youtube.com' || $url['host'] == 'youtube.com' || $url['host'] == 'youtu.be' ) {
			if ( isset( $url['query'] ) ) {
				parse_str( $url['query'], $query );
			}

			if ( isset( $query['v'] ) && $query['v'] ) {
				$link = 'https://www.youtube.com/embed/' . $query['v'];
			}
		}

		// Vimeo
		if ( isset( $url['host'] ) && ( $url['host'] == 'www.vimeo.com' || $url['host'] == 'vimeo.com' ) ) {
			if ( isset( $url['path'] ) && $url['path'] ) {
				$link = 'https://player.vimeo.com/video' . $url['path'];
			}
		}
	}

	// Styling
	$video_module_uniqid = uniqid( 'norebro-custom-' );

	$video_module_class = '';

	if ( $layout == 'boxed_shape' || $layout == 'outline' ) {
		$video_module_class .= ' boxed';
	}
	if ( $layout == 'outline' ) {
		$video_module_class .= ' outline';
	}
	if ( $button_anim ){
		$video_module_class .= ' with-anim';
	}

	$title_settings = NorExtraParser::VC_color_to_CSS( $title_color, 'color:{{color}};' );

	$video_module_settings = '';
	if ( $layout != 'with_preview' ) {
		$video_module_settings = NorExtraParser::VC_color_to_CSS( $background_color, 'background-color:{{color}};' );
		$border_settings = NorExtraParser::VC_color_to_CSS( $border_color, 'border-color:{{color}};' );
		$video_module_settings .= $border_settings;
	}

	$button_settings = '';
	$button_hover_settings = '';

	if ( $button_layout == 'outline' ) {
		$button_settings = NorExtraParser::VC_color_to_CSS( $button_color, 'border-color:{{color}};' );
		$button_hover_settings = NorExtraParser::VC_color_to_CSS( $button_hover_color, 'background:{{color}};border-color:{{color}};' );
	} else {
		$button_settings = NorExtraParser::VC_color_to_CSS( $button_color, 'background-color:{{color}};border-color:{{color}};' );
		$button_hover_settings = NorExtraParser::VC_color_to_CSS( $button_hover_color, ' border-color:{{color}};' );
	}

	$button_after_before_css = '';
	if ( $button_color && $button_color != 'brand' ) {
		$button_after_before_css .= 'border-color:' . $button_color . ';';
	}

	$button_settings_class = '';
	if ( $button_shadow ) {
		$button_settings_class .= ' shadow';
	}
	if ( $button_layout == 'outline' ) {
		$button_settings_class .= ' outline';
	}

	$icon_settings = NorExtraParser::VC_color_to_CSS( $icon_color, 'color:{{color}};' );
	$icon_hover_settings = NorExtraParser::VC_color_to_CSS( $icon_hover_color, 'color:{{color}} !important;' );

	NorExtraParser::VC_typo_custom_font( $title_typo );

	$title_settings .= NorExtraParser::VC_typo_to_CSS( $title_typo );

	// Assembling
	ob_start();
	include( plugin_dir_path( __FILE__ ) . 'video__style.php' );
	include( plugin_dir_path( __FILE__ ) . 'video__view.php' );
	return ob_get_clean();
}
