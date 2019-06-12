<?php 

/**
* Visual Composer Norebro Vertical Fullscreen Slider shortcode
*/

add_shortcode( 'norebro_vertical_slider', 'norebro_vertical_slider_func' );

function norebro_vertical_slider_func( $atts, $content = '' ) {
	$css_class = $animation_duration = $navigation_show = $elements_color = $pagination_type = $pagination_show = NULL;
	if ( isset( $atts ) && is_array( $atts ) ) extract( $atts );

	// Default values, parsing and filtering
	$navigation_show = NorExtraFilter::boolean( $navigation_show, true );
	$elements_color = NorExtraFilter::string( $elements_color, 'string', false );
	$pagination_type = NorExtraFilter::string( $pagination_type, 'string', 'bullets' );
	$pagination_show = NorExtraFilter::boolean( $pagination_show, true );
	$animation_duration = NorExtraFilter::string( $animation_duration, 'string', 'default' );

	$css_class = ( $css_class ) ? ' ' . NorExtraFilter::string( $css_class, 'attr', '' ) : '';

	// Styles
	$split_pages_uniqid = uniqid( 'norebro-custom-' );


	$onepage_object = (object) array();
	$onepage_object->nav = (bool) $navigation_show;
	$onepage_object->navContainerClass = 'slider-nav';
	$onepage_object->navClass = array( 'up', 'down' );
	$onepage_object->dots = (bool) $pagination_show;
	$onepage_object->mousewheel = true;
	switch ( $pagination_type ) {
		case 'bullets': $onepage_object->dotsClass = 'slider-vertical-dots'; break;
		case 'numbers': $onepage_object->dotsClass = 'slider-vertical-numbers'; break;
	}
	switch ( $animation_duration ) {
		case 'fast': $onepage_object->speed = 300; break;
		case 'default': $onepage_object->speed = 500; break;
		case 'slow': $onepage_object->speed = 800; break;
	}
	$onepage_json = json_encode( $onepage_object );

	$navigation_css = '';
	$navigation_active_css = '';
	if ( $elements_color ) {
		$navigation_css = 'color:' . $elements_color . ';';
		$navigation_active_css = 'background:transparent;';
	}

	// Assembling
	include( plugin_dir_path( __FILE__ ) . 'vertical_slider__style.php' );
	ob_start();
	include( plugin_dir_path( __FILE__ ) . 'vertical_slider__view.php' );
	return ob_get_clean();
}