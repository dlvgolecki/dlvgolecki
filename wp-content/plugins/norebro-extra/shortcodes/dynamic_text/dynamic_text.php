<?php 

/**
* Visual Composer Norebro Dynamic text shortcode
*/

add_shortcode( 'norebro_dynamic_text', 'norebro_dynamic_text_func' );

function norebro_dynamic_text_func( $atts ) {
	if ( isset( $atts ) && is_array( $atts ) ) extract( $atts );

	// Default values, parsing and filtering
	if ( isset( $pre_title ) && $pre_title ) {
		$pre_title = str_replace( ' ', '&nbsp;', $pre_title );
	}
	$pre_title = isset( $pre_title ) ? NorExtraFilter::string( $pre_title ) : '';
	if ( isset( $post_title ) && $post_title ) {
		$post_title = str_replace( ' ', '&nbsp;', $post_title );
	}
	$post_title = isset( $post_title ) ? NorExtraFilter::string( $post_title ) : '';
	$dynamic_title = isset( $dynamic_title ) ? json_decode( urldecode( $dynamic_title ) ) : array();
	$_dynamic_title = array();
	foreach ( $dynamic_title as $title ) {
		$_dynamic_title[] = $title->dynamic_part;
	}
	$dynamic_title = $_dynamic_title;

	$loop = ( isset( $loop ) ) ? NorExtraFilter::boolean( $loop ) : true;

	$alignment = isset( $alignment ) ? NorExtraFilter::string( $alignment, 'attr', 'left' ) : 'left';
	$type_speed = isset( $type_speed ) ? NorExtraFilter::string( $type_speed, 'attr', 'slow' ) : 'slow';
	$static_color = isset( $static_color ) ? NorExtraFilter::string( $static_color, 'string', false ) : false;
	$dynamic_color = isset( $dynamic_color ) ? NorExtraFilter::string( $dynamic_color, 'string', false ) : false;
	$static_typo = isset( $static_typo ) ? NorExtraFilter::string( $static_typo ) : false;
	$dynamic_typo = isset( $dynamic_typo ) ? NorExtraFilter::string( $dynamic_typo ) : false;

	$appearance_effect = isset( $appearance_effect ) ? NorExtraFilter::string( $appearance_effect, 'attr', 'none' )  : 'none';
	$appearance_duration = isset( $appearance_duration ) ? NorExtraFilter::string( $appearance_duration, 'attr', false )  : false;
	$appearance_duration = intval( str_replace( 'ms', '', $appearance_duration ) );
	
	$css_class = isset( $css_class ) ? ' ' . NorExtraFilter::string( $css_class, 'attr', '' ) : '';

	// Styling
	$dynamic_text_uniqid = uniqid( 'norebro-custom-' );

	NorebroHelper::add_required_script( 'typed' );

	switch ( $type_speed ) {
		case 'slow':
			$type_speed = array(
				'type' => 140,
				'delay' => 5000,
				'back' => 35
			);
			break;
		case 'normal':
			$type_speed = array(
				'type' => 70,
				'delay' => 2500,
				'back' => 25
			);
			break;
		case 'fast':
			$type_speed = array(
				'type' => 40,
				'delay' => 2400,
				'back' => 20
			);
			break;
		case 'very_fast':
		default:
			$type_speed = array(
				'type' => 20,
				'delay' => 1600,
				'back' => 15
			);
			break;
	}

	$options = (object) array();
	$options->strings = $dynamic_title;
	$options->typeSpeed = $type_speed['type'];
	$options->backDelay = $type_speed['delay'];
	$options->backSpeed = $type_speed['back'];
	$options->loop = $loop;
	$options_json = json_encode( $options );
	
	$alignment_css = ( $alignment ) ? 'text-align:' . $alignment . ';' : '';
	$static_color_css = ( $static_color ) ? 'color:' . $static_color . ';' : '';
	$dynamic_color_css = ( $dynamic_color ) ? 'color:' . $dynamic_color . ';' : '';
	$static_typo_css = NorExtraParser::VC_typo_to_CSS( $static_typo );
	$dynamic_typo_css = NorExtraParser::VC_typo_to_CSS( $dynamic_typo );

	NorExtraParser::VC_typo_custom_font( $static_typo );
	NorExtraParser::VC_typo_custom_font( $dynamic_typo );

	// Assembling
	include( plugin_dir_path( __FILE__ ) . 'dynamic_text__style.php' );
	ob_start();
	include( plugin_dir_path( __FILE__ ) . 'dynamic_text__view.php' );
	return ob_get_clean();
}
