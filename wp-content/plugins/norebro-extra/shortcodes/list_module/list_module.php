<?php 

/**
* Visual Composer Norebro List Module shortcode
*/

add_shortcode( 'norebro_list_module', 'norebro_list_module_func' );

function norebro_list_module_func( $atts ) {
	if ( isset( $atts ) && is_array( $atts ) ) extract( $atts );

	// Default values, parsing and filtering
	$list_layout = isset( $list_layout ) ? NorExtraFilter::string( $list_layout, 'string', 'default') : 'default';
	$list_style = isset( $list_style ) ? NorExtraFilter::string( $list_style, 'string', 'default') : 'default';
	$list_value_type1 = isset( $list_value_type1 ) ? json_decode( urldecode( NorExtraFilter::string( $list_value_type1 ) ) ) : false;
	$list_value_type2 = isset( $list_value_type2 ) ? json_decode( urldecode( NorExtraFilter::string( $list_value_type2 ) ) ) : false;

	$title_typo = isset( $title_typo ) ? NorExtraFilter::string( $title_typo ) : false;

	$title_color = isset( $title_color ) ? NorExtraFilter::string( $title_color, 'string', false ) : false;
	$border_color = isset( $border_color ) ? NorExtraFilter::string( $border_color, 'string', false ) : false;
	$icon_color = isset( $icon_color ) ? NorExtraFilter::string( $icon_color, 'string', false ) : false;
	$icon_shape_color = isset( $icon_shape_color ) ? NorExtraFilter::string( $icon_shape_color, 'string', 'brand' ) : 'brand';

	$appearance_effect = isset( $appearance_effect ) ? NorExtraFilter::string( $appearance_effect, 'attr', 'none' ) : 'none';
	$appearance_duration = isset( $appearance_duration ) ? NorExtraFilter::string( $appearance_duration, 'attr', false ) : false;
	if ( $appearance_duration ) $appearance_duration = intval( str_replace( 'ms', '', $appearance_duration ) );

	$css_class = isset( $css_class ) ? ' ' . NorExtraFilter::string( $css_class, 'attr', '' ) : '';

	if ( $list_value_type1 ) {
		foreach ($list_value_type1 as $list_key => $list_value) {
			if ( isset( $list_value->list_title ) ) {
				$list_value_type1[$list_key]->list_title = NorExtraFilter::string( $list_value->list_title );
			} else {
				$list_value_type1[$list_key]->list_title = false;
			}
		}
	}

	if ( $list_value_type2 ) {
		foreach ($list_value_type2 as $list_key => $list_value) {
			if ( isset( $list_value->list_title ) ) {
				$list_value_type2[$list_key]->list_title = NorExtraFilter::string( $list_value->list_title );
			} else {
				$list_value_type2[$list_key]->list_title = false;
			}
			if ( isset( $list_value->list_icon ) ) {
				$list_value_type2[$list_key]->list_icon = NorExtraFilter::string( $list_value->list_icon, 'attr' );
				$GLOBALS['norebro_icon_fonts'][] = NorExtraFilter::string( $list_value_type2[$list_key]->list_icon, 'attr' );
			} else {
				$list_value_type2[$list_key]->list_icon = false;
			}
			if ( isset( $list_value->list_image ) ) {
				$list_value_type2[$list_key]->list_image = NorExtraFilter::string( wp_get_attachment_url( NorExtraFilter::string( $list_value->list_image ) ), 'attr' );
			} else {
				$list_value_type2[$list_key]->list_image = false;
			}
		}
	}

	// Styling
	$list_box_uniqid = uniqid( 'norebro-custom-' );

	$list_box_class = '';

	if ( $list_style == 'icon' ) {
		$list_box_class .= ' with-icon';
	}

	if ( $list_style == 'shape_icon' ) {
		$list_box_class .= ' with-icon icon-fill';
	} 

	if( $list_style == 'line' ){
		$list_box_class .= ' style-line';
	}

	switch ( $list_layout ) {
		case 'border_items':
			$list_box_class .= ' border';
			break;
		case 'offset_border_items':
			$list_box_class .= ' border offset';
			break;
	}

	$title_settings = NorExtraParser::VC_color_to_CSS( $title_color, 'color:{{color}};' );
	$border_settings = NorExtraParser::VC_color_to_CSS( $border_color, 'border-color:{{color}};' );
	$icon_settings = NorExtraParser::VC_color_to_CSS( $icon_color, 'color:{{color}};' );
	if ( $list_style == 'shape_icon' ) {
		$icon_shape_settings = NorExtraParser::VC_color_to_CSS( $icon_shape_color, 'background-color:{{color}};' );
	} else {
		$icon_shape_settings = '';
	}

	NorExtraParser::VC_typo_custom_font( $title_typo );

	$title_settings .= NorExtraParser::VC_typo_to_CSS( $title_typo );

	// Assembling
	include( plugin_dir_path( __FILE__ ) . 'list_module__style.php' );
	ob_start();
	include( plugin_dir_path( __FILE__ ) . 'list_module__view.php' );
	return ob_get_clean();
}