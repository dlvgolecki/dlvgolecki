<?php 

/**
* Visual Composer Norebro Banner shortcode
*/

add_shortcode( 'norebro_banner', 'norebro_banner_func' );

function norebro_banner_func( $atts ) {
	if ( isset( $atts ) && is_array( $atts ) ) extract( $atts );

	// Default values, parsing and filtering
	$block_type_layout = isset( $block_type_layout ) ? NorExtraFilter::string( $block_type_layout, 'string', 'full' ) : 'full';
	$block_type_full_align = isset( $block_type_full_align ) ? NorExtraFilter::string( $block_type_full_align, 'string', 'left' ) : 'left';
	$block_type_inner_align = isset( $block_type_inner_align ) ? NorExtraFilter::string( $block_type_inner_align, 'string', 'top_left' ) : 'top_left';
	$block_type_subtitle = isset( $block_type_subtitle ) ? NorExtraFilter::string( $block_type_subtitle, 'string', 'after' ) : 'after';
	$inner_padding = isset( $inner_padding ) ? NorExtraFilter::string( $inner_padding ) : '30px';
	$title = isset( $title ) ? NorExtraFilter::string( $title ) : false;
	$subtitle = isset( $subtitle ) ? NorExtraFilter::string( $subtitle ) : false;
	$description = isset( $description ) ? rawurldecode( base64_decode( $description ) ) : '';
	$description = NorExtraFilter::string( $description, 'textarea', '' );
	$background_image = isset( $background_image ) ? NorExtraFilter::string( wp_get_attachment_url( NorExtraFilter::string( $background_image ) ), 'attr' ) : false;
	$use_link = isset( $use_link ) ? NorExtraFilter::boolean( $use_link ) : true;

	$readmore_button = isset( $readmore_button ) ? NorExtraFilter::string( $readmore_button ) : 'type=outline&size=small';

	$title_typo = isset( $title_typo ) ? NorExtraFilter::string( $title_typo ) : false;
	$subtitle_typo = isset( $subtitle_typo ) ? NorExtraFilter::string( $subtitle_typo ) : false;
	$description_typo = isset( $description_typo ) ? NorExtraFilter::string( $description_typo ) : false;
	$title_color = isset( $title_color ) ? NorExtraFilter::string( $title_color ) : false;
	$subtitle_color = isset( $subtitle_color ) ? NorExtraFilter::string( $subtitle_color ) : false;
	$description_color = isset( $description_color ) ? NorExtraFilter::string( $description_color ) : false;
	$overlay_color = isset( $overlay_color ) ? NorExtraFilter::string( $overlay_color ) : false;

	$appearance_effect = isset( $appearance_effect ) ? NorExtraFilter::string( $appearance_effect, 'attr', 'none' )  : 'none';
	$appearance_duration = isset( $appearance_duration ) ? NorExtraFilter::string( $appearance_duration, 'attr', false )  : false;
	if ( $appearance_duration ) $appearance_duration = intval( str_replace( 'ms', '', $appearance_duration ) );
	
	$css_class = isset( $css_class ) ? ' ' . NorExtraFilter::string( $css_class, 'attr', '' )  : '';

	$link_url = NorExtraParser::VC_link_params( ( isset( $link_url ) ? $link_url : '' ), array( 'caption' => esc_html__( 'Read More', 'norebro-extra' ) ) );

	// Styling
	$banner_box_uniqid = uniqid( 'norebro-custom-' );

	$banner_box_class = 'banner-box';
	switch ( $block_type_layout ) {
		case 'boxed':
			$banner_box_class .= ' boxed';
			break;
		case 'inner':
			$banner_box_class .= ' inner';
			break;
		case 'inner_hover':
			$banner_box_class .= ' inner hover';
			break;
		case 'overlay_title':
			$banner_box_class .= ' overlay-title';
			break;
		case 'hover_title':
			$banner_box_class .= ' overlay-title hover';
			break;
	}
	switch ( $block_type_full_align ) {
		case 'center':
			$banner_box_class .= ' text-center';
			break;
		case 'right':
			$banner_box_class .= ' text-right';
			break;
	}

	$title_css = NorExtraParser::VC_typo_to_CSS( $title_typo );
	$title_css .= NorExtraParser::VC_color_to_CSS( $title_color, 'color:{{color}};' );

	$subtitle_css 	= NorExtraParser::VC_typo_to_CSS( $subtitle_typo );
	$subtitle_css 	.= NorExtraParser::VC_color_to_CSS( $subtitle_color, 'color:{{color}};' );

	$description_css = NorExtraParser::VC_typo_to_CSS( $description_typo );
	$description_css .= NorExtraParser::VC_color_to_CSS( $description_color, 'color:{{color}};' );

	$overlay_css = ( $overlay_color ) ? 'background-color: ' . $overlay_color : ';';
	$inner_padding_css = 'padding:' . $inner_padding . ';';

	$content_css = '';
	if ( $block_type_layout == 'boxed' || $block_type_layout == 'overlay_title' || $block_type_layout == 'hover_title' ) {
		$content_css = 'padding-left:' . $inner_padding .';padding-right:' . $inner_padding . ';';
	}

	$title_wrap_css = '';
	if ( $block_type_layout == 'overlay_title' ) {
		$title_wrap_css = 'padding:' . $inner_padding . ';';
	}
	if ( $block_type_layout == 'hover_title' ) {
		$title_wrap_css = 'padding-bottom:' . $inner_padding . ';';
	}

	$readmore_button = preg_replace( '/\&amp\;/', '&', $readmore_button );
	parse_str( $readmore_button, $button_settings );
	$button_css = NorExtraParser::VC_button_to_css( $button_settings );

	if ( $block_type_layout == 'inner' || $block_type_layout == 'inner_hover' ) {
		$button_css['css'] .= 'bottom:' . $inner_padding . ';';
	}

	NorExtraParser::VC_typo_custom_font( $title_typo );
	NorExtraParser::VC_typo_custom_font( $subtitle_typo );
	NorExtraParser::VC_typo_custom_font( $description_typo );

	// Assembling
	include( plugin_dir_path( __FILE__ ) . 'banner__style.php' );
	ob_start();
	include( plugin_dir_path( __FILE__ ) . 'banner__view.php' );
	return ob_get_clean();
}