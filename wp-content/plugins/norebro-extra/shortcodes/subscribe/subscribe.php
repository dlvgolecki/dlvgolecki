<?php 

/**
* Visual Composer Norebro Subscribe shortcode
*/

add_shortcode( 'norebro_subscribe', 'norebro_subscribe_func' );

function norebro_subscribe_func( $atts ) {
	if ( isset( $atts ) && is_array( $atts ) ) extract( $atts );

	// Default values, parsing and filtering
	$input_type = isset( $input_type ) ? NorExtraFilter::string( $input_type, 'string', 'outline') : 'outline';
	$alignment = isset( $alignment ) ? NorExtraFilter::string( $alignment, 'string', 'center') : 'center';
	$fullwidth = isset( $fullwidth ) ? NorExtraFilter::boolean( $fullwidth ) : true;
	$squared_shapes = isset( $squared_shapes ) ? NorExtraFilter::boolean( $squared_shapes ) : false;
	$input_placeholder = isset( $input_placeholder ) ? NorExtraFilter::string( $input_placeholder, 'string', __( 'Enter your email', 'norebro-extra' ) ) : __( 'Enter your email', 'norebro-extra' );
	$button_text = isset( $button_text ) ? NorExtraFilter::string( $button_text, 'string', __( 'Subscribe', 'norebro-extra' ) ) : __( 'Subscribe', 'norebro-extra' );
	$feedburner_name = isset( $feedburner_name ) ? NorExtraFilter::string( $feedburner_name, 'attr', '' ) : '';
	$input_color = isset( $input_color ) ? NorExtraFilter::string( $input_color, 'string', false ) : false;
	$input_bg_color = isset( $input_bg_color ) ? NorExtraFilter::string( $input_bg_color, 'string', false ) : false;
	$input_border_color = isset( $input_border_color ) ? NorExtraFilter::string( $input_border_color, 'string', false ) : false;
	$button = isset( $button ) ? NorExtraFilter::string( $button ) : false;

	$appearance_effect = isset( $appearance_effect ) ? NorExtraFilter::string( $appearance_effect, 'attr', 'none' ) : 'none';
	$appearance_duration = isset( $appearance_duration ) ? NorExtraFilter::string( $appearance_duration, 'attr', false ) : false;
	if ( $appearance_duration ) $appearance_duration = intval( str_replace( 'ms', '', $appearance_duration ) );

	$css_class = isset( $css_class ) ? ' ' . NorExtraFilter::string( $css_class, 'attr', '' ) : '';


	// Styling
	$subscribe_uniqid = uniqid( 'norebro-custom-' );

	$input_class = '';

	$button = preg_replace( '/\&amp\;/', '&', $button );
	parse_str( $button, $button_settings );
	$button_css = NorExtraParser::VC_button_to_css( $button_settings );

	$subscribe_append_class = '';
	switch ( $input_type ) {
		case 'outline':
			$subscribe_append_class = ' outline';
			$input_class .= 'outline';
			break;
		case 'flat':
			$subscribe_append_class = ' flat';
			$input_class .= ' flat';
			break;
	}

	if ( $squared_shapes ) {
		$subscribe_append_class .= ' squared';
		$input_class .= ' squared';
		$button_css['classes'] .= ' btn-squared';
	}

	$table_css = '';
	if ( $fullwidth ) {
		$table_css .= 'width:100%;';
	}


	$input_color_css = '';
	$input_color_css .= NorExtraParser::VC_color_to_CSS( $input_color, 'color:{{color}};' );

	if ( $input_type == 'flat' ) {
		$input_color_css .= NorExtraParser::VC_color_to_CSS( $input_bg_color, 'background-color:{{color}};' );
	} else {
		$input_color_css .= NorExtraParser::VC_color_to_CSS( $input_border_color, 'border-color:{{color}};' );
	}

	// Assembling
	include( plugin_dir_path( __FILE__ ) . 'subscribe__style.php' );
	ob_start();
	include( plugin_dir_path( __FILE__ ) . 'subscribe__view.php' );
	return ob_get_clean();
}