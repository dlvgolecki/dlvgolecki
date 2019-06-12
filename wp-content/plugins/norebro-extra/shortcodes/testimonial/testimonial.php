<?php 

/**
* Visual Composer Norebro Testimonial shortcode
*/

add_shortcode( 'norebro_testimonial', 'norebro_testimonial_func' );

function norebro_testimonial_func( $atts ) {
	if ( isset( $atts ) && is_array( $atts ) ) extract( $atts );

	// Default values, parsing and filtering
	$block_type_layout = ( isset( $block_type_layout ) ) ? NorExtraFilter::string( $block_type_layout, 'string', 'default' ) : 'default';
	$block_type_alignment_default = isset( $block_type_alignment_default ) ? NorExtraFilter::string( $block_type_alignment_default, 'string', 'center' ) : 'center';
	$block_type_alignment_top = isset( $block_type_alignment_top ) ? NorExtraFilter::string( $block_type_alignment_top, 'string', 'center' ) : 'center';
	$block_type_alignment_middle = isset( $block_type_alignment_middle ) ? NorExtraFilter::string( $block_type_alignment_middle, 'string', 'center' ) : 'center';
	$quote = isset( $quote ) ? NorExtraFilter::string( $quote, 'textarea', '' ) : '';
	$author = isset( $author ) ? NorExtraFilter::string( $author, 'string', '' ) : '';
	$position = isset( $position ) ? NorExtraFilter::string( $position, 'string', '' ) : '';
	$photo = isset( $photo ) ? NorExtraFilter::string( wp_get_attachment_url( NorExtraFilter::string( $photo ) ), 'attr' ) : false;

	$quote_typo = isset( $quote_typo ) ? NorExtraFilter::string( $quote_typo ) : false;
	$author_typo = isset( $author_typo ) ? NorExtraFilter::string( $author_typo ) : false;
	$position_typo = isset( $position_typo ) ? NorExtraFilter::string( $position_typo ) : false;

	$image_border_color = isset( $image_border_color ) ? NorExtraFilter::string( $image_border_color ) : false;
	$quote_color = isset( $quote_color ) ? NorExtraFilter::string( $quote_color ) : false;
	$author_color = isset( $author_color ) ? NorExtraFilter::string( $author_color ) : false;
	$position_color = isset( $position_color ) ? NorExtraFilter::string( $position_color ) : false;

	$appearance_effect = isset( $appearance_effect ) ? NorExtraFilter::string( $appearance_effect, 'attr', 'none' ) : 'none';
	$appearance_duration = isset( $appearance_duration ) ? NorExtraFilter::string( $appearance_duration, 'attr', false ) : false;
	if ( $appearance_duration ) $appearance_duration = intval( str_replace( 'ms', '', $appearance_duration ) );

	$css_class = ( isset( $css_class ) ) ? ' ' . NorExtraFilter::string( $css_class, 'attr', '' )  : '';

	$type_class = '';
	switch ( $block_type_layout ) {
		case 'photo_top':
			$type_class .= ' top-avatar';
			if ( $block_type_alignment_top == 'left' ) {
				$type_class .= ' text-left';
			}
			if ( $block_type_alignment_top == 'right' ) {
				$type_class .= ' text-right';
			}
			break;
		case 'photo_middle':
			$type_class .= ' middle-avatar';
			if ( $block_type_alignment_middle == 'left' ) {
				$type_class .= ' text-left';
			}
			if ( $block_type_alignment_middle == 'right' ) {
				$type_class .= ' text-right';
			}
			break;
		default:
			if ( $block_type_alignment_default == 'left' ) {
				$type_class .= ' text-left';
			}
			if ( $block_type_alignment_default == 'right' ) {
				$type_class .= ' text-right';
			}
			break;
	}

	// Styling
	$testimonial_uniqid = uniqid( 'norebro-custom-' );

	$image_settings = NorExtraParser::VC_color_to_CSS( $image_border_color, 'border-color:{{color}};' );
	$quote_settings = NorExtraParser::VC_color_to_CSS( $quote_color, 'color:{{color}};' );
	$author_settings = NorExtraParser::VC_color_to_CSS( $author_color, 'color:{{color}};' );
	$position_settings = NorExtraParser::VC_color_to_CSS( $position_color, 'color:{{color}};' );

	$quote_settings .= NorExtraParser::VC_typo_to_CSS( $quote_typo );
	$author_settings .= NorExtraParser::VC_typo_to_CSS( $author_typo );
	$position_settings .= NorExtraParser::VC_typo_to_CSS( $position_typo );

	NorExtraParser::VC_typo_custom_font( $quote_typo );
	NorExtraParser::VC_typo_custom_font( $author_typo );
	NorExtraParser::VC_typo_custom_font( $position_typo );

	// Assembling
	include( plugin_dir_path( __FILE__ ) . 'testimonial__style.php' );
	ob_start();
	include( plugin_dir_path( __FILE__ ) . 'testimonial__view.php' );
	return ob_get_clean();
}

