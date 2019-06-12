<?php 

/**
* Visual Composer Norebro Pricing table fetures shortcode
*/

add_shortcode( 'norebro_pricing_table_features', 'norebro_pricing_table_features_func' );

function norebro_pricing_table_features_func( $atts ) {
	if ( isset( $atts ) && is_array( $atts ) ) extract( $atts );

	// Default values, parsing and filtering
	$title = isset( $title ) ? NorExtraFilter::string( $title ) : false;
	$features_value = isset( $features_value ) ? json_decode( urldecode( NorExtraFilter::string( $features_value ) ) ) : false;
	$title_typo = isset( $title_typo ) ? NorExtraFilter::string( $title_typo ) : false;
	$features_title_typo = isset( $features_title_typo ) ? NorExtraFilter::string( $features_title_typo ) : false;
	$bg_color = isset( $bg_color ) ? NorExtraFilter::string( $bg_color ) : false;
	$borders_color = isset( $borders_color ) ? NorExtraFilter::string( $borders_color ) : false;
	$title_color = isset( $title_color ) ? NorExtraFilter::string( $title_color ) : false;
	$features_title_color = isset( $features_title_color ) ? NorExtraFilter::string( $features_title_color ) : false;
	
	$appearance_effect = isset( $appearance_effect ) ? NorExtraFilter::string( $appearance_effect, 'attr', 'none' ) : 'none';
	$appearance_duration = isset( $appearance_duration ) ? NorExtraFilter::string( $appearance_duration, 'attr', false ) : false;
	if ( $appearance_duration ) $appearance_duration = intval( str_replace( 'ms', '', $appearance_duration ) );

	$css_class = isset( $css_class ) ? ' ' . NorExtraFilter::string( $css_class, 'attr', '' )  : '';

	if ( $features_value ) {
		foreach ($features_value as $feature_key => $feature_value) {
			if ( isset( $feature_value->feature_title ) ) {
				$features_value[$feature_key]->feature_title = NorExtraFilter::string( $feature_value->feature_title );
			} else {
				$features_value[$feature_key]->feature_title = false;
			}
		}
	}

	// Styling
	$pricing_table_uniqid = uniqid( 'norebro-custom-' );

	$pricing_table_settings = NorExtraParser::VC_color_to_CSS( $bg_color, 'background-color:{{color}};' );
	$borders_settings = NorExtraParser::VC_color_to_CSS( $borders_color, 'border-color:{{color}};' );
	$title_settings = NorExtraParser::VC_color_to_CSS( $title_color, 'color:{{color}};' );
	$features_titles_settings = NorExtraParser::VC_color_to_CSS( $features_title_color, 'color:{{color}};' );

	$title_settings .= NorExtraParser::VC_typo_to_CSS( $title_typo );
	$features_titles_settings .= NorExtraParser::VC_typo_to_CSS( $features_title_typo );

	NorExtraParser::VC_typo_custom_font( $title_typo );
	NorExtraParser::VC_typo_custom_font( $features_title_typo );

	$icons_collection = array();

	// Assembling
	include( plugin_dir_path( __FILE__ ) . 'pricing_table_features__style.php' );
	ob_start();
	include( plugin_dir_path( __FILE__ ) . 'pricing_table_features__view.php' );
	return ob_get_clean();
}
