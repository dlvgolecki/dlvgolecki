<?php 

/**
* Visual Composer Norebro Split Screen page shortcode
*/

add_shortcode( 'norebro_split_screen', 'norebro_split_screen_func' );

function norebro_split_screen_func( $atts, $content = '' ) {
	if ( isset( $atts ) && is_array( $atts ) ) extract( $atts );

	// Default values, parsing and filtering
	$bg_color = isset( $bg_color ) ? NorExtraFilter::string( $bg_color ) : false;
	$bg_image = isset( $bg_image ) ? NorExtraFilter::string( $bg_image ) : false;
	$bg_size = isset( $bg_size ) ? NorExtraFilter::string( $bg_size, 'string', 'cover' ) : 'cover';
	$side_paddings = isset( $side_paddings ) ? NorExtraFilter::string( $side_paddings ) : '7%';
	$css_class = isset( $css_class ) ? ' ' . NorExtraFilter::string( $css_class, 'attr', '' )  : '';

	// Style
	$split_screen_uniqid = uniqid( 'norebro-custom-' );

	$bg_css = '';
	if ( $bg_color ) {
		$bg_css .= 'background-color: ' . $bg_color . ';';
	}
	if ( $bg_image ) {
		$bg_image = wp_get_attachment_image_src( $bg_image, 'full' );
		if ( is_array( $bg_image ) ) {
			$bg_image = $bg_image[0];
		}
		$bg_css .= 'background-image: url(\'' . $bg_image . '\');';
		switch ( $bg_size ) {
			case 'contain':
				$bg_css .= 'background-size: contain;';
				break;
			case 'no-repeat':
				$bg_css .= 'background-repeat: no-repeat;';
				break;
			case 'repeat':
				$bg_css .= 'background-repeat: repeat;';
				break;
			case 'cover':
			default:
				$bg_css .= 'background-size: cover;';
				break;
		}
	}

	$side_paddings_css = ( $side_paddings ) ? 'padding: 0 ' . $side_paddings . ';' : '';

	// Assembling
	include( plugin_dir_path( __FILE__ ) . 'split_screen__style.php' );
	ob_start();
	include( plugin_dir_path( __FILE__ ) . 'split_screen__view.php' );
	return ob_get_clean();
}