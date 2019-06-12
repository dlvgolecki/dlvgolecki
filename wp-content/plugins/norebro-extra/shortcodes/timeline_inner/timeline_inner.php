<?php 

/**
* Visual Composer Norebro Timeline Inner shortcode
*/

add_shortcode( 'norebro_timeline_inner', 'norebro_timeline_inner_func' );

function norebro_timeline_inner_func( $atts ) {
	if ( isset( $atts ) && is_array( $atts ) ) extract( $atts );

	// Default values, parsing and filtering
	$boxed = isset( $boxed ) ? NorExtraFilter::boolean( $boxed ) : false;
	$title = isset( $title ) ? NorExtraFilter::string( $title, 'string', '' ) : '';
	$subtitle = isset( $subtitle ) ? NorExtraFilter::string( $subtitle, 'string', '' ) : '';
	//$description = isset( $description ) ? NorExtraFilter::string( $description, 'textarea', '' ) : '';
	
	$title_typo = isset( $title_typo ) ? NorExtraFilter::string( $title_typo ) : false;
	$subtitle_typo = isset( $subtitle_typo ) ? NorExtraFilter::string( $subtitle_typo ) : false;
	$desription_typo = isset( $desription_typo ) ? NorExtraFilter::string( $desription_typo ) : false;
	
	$background_color = isset( $background_color ) ? NorExtraFilter::string( $background_color ) : 'brand';
	$title_color = isset( $title_color ) ? NorExtraFilter::string( $title_color ) : false;
	$subtitle_color = isset( $subtitle_color ) ? NorExtraFilter::string( $subtitle_color ) : false;
	$description_color = isset( $description_color ) ? NorExtraFilter::string( $description_color ) : false;
	$dot_bg_color = isset( $dot_bg_color ) ? NorExtraFilter::string( $dot_bg_color ) : false;
	$dot_border_color = isset( $dot_border_color ) ? NorExtraFilter::string( $dot_border_color ) : 'brand';
	$line_color = isset( $line_color ) ? NorExtraFilter::string( $line_color ) : false;
	
	$css_class = isset( $css_class ) ? ' ' . NorExtraFilter::string( $css_class, 'attr', '' )  : '';

	// Styling
	$timeline_uniqid = uniqid( 'norebro-custom-' );

	if ( $boxed ) {
		$css_class .= ' boxed';
	}

	if ( $boxed ) {
		$background_settings = NorExtraParser::VC_color_to_CSS( $background_color, 'background-color:{{color}};' );
	} else {
		$background_settings = '';
	}

	$title_settings = NorExtraParser::VC_color_to_CSS( $title_color, 'color:{{color}};' );
	$subtitle_settings = NorExtraParser::VC_color_to_CSS( $subtitle_color, 'color:{{color}};' );
	$description_settings = NorExtraParser::VC_color_to_CSS( $description_color, 'color:{{color}};' );
	$dot_bg_settings = NorExtraParser::VC_color_to_CSS( $dot_bg_color, 'background-color:{{color}};' );
	$dot_border_settings = NorExtraParser::VC_color_to_CSS( $dot_border_color, 'border-color:{{color}};' );
	$dot_bg_settings .= $dot_border_settings;
	$line_settings = NorExtraParser::VC_color_to_CSS( $line_color, 'background-color:{{color}};' );

	$title_settings .= NorExtraParser::VC_typo_to_CSS( $title_typo );
	$subtitle_settings .= NorExtraParser::VC_typo_to_CSS( $subtitle_typo );
	$description_settings .= NorExtraParser::VC_typo_to_CSS( $desription_typo );

	NorExtraParser::VC_typo_custom_font( $title_typo );
	NorExtraParser::VC_typo_custom_font( $subtitle_typo );
	NorExtraParser::VC_typo_custom_font( $desription_typo );

	// Assembling
	include( plugin_dir_path( __FILE__ ) . 'timeline_inner__style.php' );
	ob_start();
	include( plugin_dir_path( __FILE__ ) . 'timeline_inner__view.php' );
	return ob_get_clean();
}