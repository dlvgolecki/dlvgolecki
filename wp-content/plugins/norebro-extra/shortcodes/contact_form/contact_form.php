<?php 

/**
* Visual Composer Norebro Contact Form shortcode
*/

add_shortcode( 'norebro_contact_form', 'norebro_contact_form_func' );

function norebro_contact_form_func( $atts ) {
	if ( isset( $atts ) && is_array( $atts ) ) extract( $atts );

	// Default values, parsing and filtering
	$form_id = isset( $form_id ) ? NorExtraFilter::string( $form_id, 'string', '') : '';
	$form_style = isset( $form_style ) ? NorExtraFilter::string( $form_style, 'string', 'classic') : 'classic';
	$fields_offset = isset( $fields_offset ) ? NorExtraFilter::string( $fields_offset, 'string', '10px') : '10px';

	$button = isset( $button ) ? NorExtraFilter::string( $button ) : 'color=brand';
	$button_position = isset( $button_position ) ? NorExtraFilter::string( $button_position ) : 'left';
	$fields_color = isset( $fields_color ) ? NorExtraFilter::string( $fields_color ) : false;
	$fields_border_color = isset( $fields_border_color ) ? NorExtraFilter::string( $fields_border_color ) : false;
	$fields_text_color = isset( $fields_text_color ) ? NorExtraFilter::string( $fields_text_color ) : false;
	$fields_focus_border_color = isset( $fields_focus_border_color ) ? NorExtraFilter::string( $fields_focus_border_color ) : false;
	
	$appearance_effect = isset( $appearance_effect ) ? NorExtraFilter::string( $appearance_effect, 'attr', 'none' )  : 'none';
	$appearance_duration = isset( $appearance_duration ) ? NorExtraFilter::string( $appearance_duration, 'attr', false )  : false;
	if ( $appearance_duration ) $appearance_duration = intval( str_replace( 'ms', '', $appearance_duration ) );

	$css_class = ( isset( $css_class ) ) ? ' ' . NorExtraFilter::string( $css_class, 'attr', '' )  : '';

	// Styling
	$contact_form_uniqid = uniqid( 'norebro-custom-' );

	$contact_form_class = '';
	if ( $button_position ) {
		$contact_form_class .= ' text-' . $button_position;
	}
	if ( $form_style != 'border' ) {
		$contact_form_class .= ' ' . $form_style;
	}
	if ( intval( $fields_offset ) == 0 ) {
		$contact_form_class .= ' without-label-offset';
	}

	$fields_css = $fields_focus_css = $fields_placeholder_css = '';
	if ( $fields_color ) {
		if ( $form_style == 'classic') {
			$fields_css .= 'border-color: ' . $fields_color . '; color: ' . $fields_color . ';';
			$fields_placeholder_css .= 'color: ' . $fields_color . ';';
		} else {
			$fields_css .= 'background: ' . $fields_color . ';';
		}
	}
	if ( $fields_border_color && $form_style != 'flat' ) {
		$fields_css .= 'border-color: ' . $fields_border_color . ';';
	}
	if ( $fields_text_color ) {
		$fields_css .= 'color: ' . $fields_text_color . ';';
		$fields_placeholder_css .= 'color: ' . $fields_text_color . ';';
	}
	if ( $fields_focus_border_color ) {
		$fields_focus_css .= 'border-color: ' . $fields_focus_border_color . ';';
	}

	// Read more button
	$button = preg_replace( '/\&amp\;/', '&', $button );
	parse_str( $button, $button_settings );
	$button_css = NorExtraParser::VC_button_to_css( $button_settings );

	$label_css = '';
	if ( $fields_offset ) {
		$label_css = 'padding-top: ' . $fields_offset . '; padding-right: ' . $fields_offset .';';
	}

	// Assembling
	include( plugin_dir_path( __FILE__ ) . 'contact_form__style.php' );
	ob_start();
	include( plugin_dir_path( __FILE__ ) . 'contact_form__view.php' );
	return ob_get_clean();
}