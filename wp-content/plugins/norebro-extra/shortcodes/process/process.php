<?php 

/**
* Visual Composer Norebro Process shortcode
*/

add_shortcode( 'norebro_process', 'norebro_process_func' );

function norebro_process_func( $atts ) {
	if ( isset( $atts ) && is_array( $atts ) ) extract( $atts );

	// Default values, parsing and filtering
	$number = isset( $number ) ? NorExtraFilter::string( $number, 'string', '01.' ) : '01.';
	$title = isset( $title ) ? NorExtraFilter::string( $title, 'string', '' ) : '';
	$description = isset( $description ) ? NorExtraFilter::string( $description, 'textarea', '' ) : '';
	$number_typo = isset( $number_typo ) ? NorExtraFilter::string( $number_typo ) : false;
	$title_typo = isset( $title_typo ) ? NorExtraFilter::string( $title_typo ) : false;
	$description_typo = isset( $description_typo ) ? NorExtraFilter::string( $description_typo ) : false;
	$boxed = isset( $boxed ) ? NorExtraFilter::boolean( $boxed ) : false;
	$bg_color = isset( $bg_color ) ? NorExtraFilter::string( $bg_color ) : false;
	$number_color = isset( $number_color ) ? NorExtraFilter::string( $number_color ) : false;
	$title_color = isset( $title_color ) ? NorExtraFilter::string( $title_color ) : false;
	$description_color = isset( $description_color ) ? NorExtraFilter::string( $description_color ) : false;
	
	$appearance_effect = isset( $appearance_effect ) ? NorExtraFilter::string( $appearance_effect, 'attr', 'none' )  : 'none';
	$appearance_duration = isset( $appearance_duration ) ? NorExtraFilter::string( $appearance_duration, 'attr', false )  : false;
	if ( $appearance_duration ) $appearance_duration = intval( str_replace( 'ms', '', $appearance_duration ) );
	
	$css_class = isset( $css_class ) ? ' ' . NorExtraFilter::string( $css_class, 'attr', '' )  : '';

	// Styling
	$process_uniqid = uniqid( 'norebro-custom-' );

	$process_settings = NorExtraParser::VC_color_to_CSS( $bg_color, 'background-color:{{color}};' );

	$number_settings = NorExtraParser::VC_color_to_CSS( $number_color, 'color:{{color}};' );
	$number_settings .= NorExtraParser::VC_typo_to_CSS( $number_typo );

	$title_settings = NorExtraParser::VC_color_to_CSS( $title_color, 'color:{{color}};' );
	$title_settings .= NorExtraParser::VC_typo_to_CSS( $title_typo );

	$description_settings = NorExtraParser::VC_color_to_CSS( $description_color, 'color:{{color}};' );
	$description_settings .= NorExtraParser::VC_typo_to_CSS( $description_typo );

	$process_settings_class = '';
	if ( $boxed ) {
		$process_settings_class .= ' boxed';
	}

	NorExtraParser::VC_typo_custom_font( $title_typo );
	NorExtraParser::VC_typo_custom_font( $description_typo );

	// Assembling
	include( plugin_dir_path( __FILE__ ) . 'process__style.php' );
	ob_start();
	include( plugin_dir_path( __FILE__ ) . 'process__view.php' );
	return ob_get_clean();
}