<?php 

/**
* Visual Composer Norebro Carousel shortcode
*/

add_shortcode( 'norebro_carousel', 'norebro_carousel_func' );

function norebro_carousel_func( $atts, $content = '' ) {
	if ( isset( $atts ) && is_array( $atts ) ) extract( $atts );

	// Default values, parsing and filtering
	$loop = isset( $loop ) ? NorExtraFilter::boolean( $loop ) : true;

	$offset_items = isset( $offset_items ) ? NorExtraFilter::boolean( $offset_items ) : false;
	$offset_size = isset( $offset_size ) ? NorExtraFilter::string( $offset_size, 'string', '70%' ) : '70%';
	$item_desktop = isset( $item_desktop ) ? NorExtraFilter::string( $item_desktop, 'string', '5' ) : '5';
	$item_tablet = isset( $item_tablet ) ? NorExtraFilter::string( $item_tablet, 'string', '3' ) : '3';
	$item_mobile = isset( $item_mobile ) ? NorExtraFilter::string( $item_mobile, 'string', '1' ) : '1';
	$items_gap = isset( $items_gap ) ? NorExtraFilter::string( $items_gap, 'string', '15px' ) : '15px';
	$pagination_show = isset( $pagination_show ) ? NorExtraFilter::boolean( $pagination_show ) : true;
	$dots_each = isset( $dots_each ) ? NorExtraFilter::string( $dots_each, 'string', '' ) : '';
	$navigation_buttons = isset( $navigation_buttons ) ? NorExtraFilter::boolean( $navigation_buttons ) : true;
	$position_nav_buttons = isset( $position_nav_buttons ) ? NorExtraFilter::string( $position_nav_buttons, 'attr', 'default' )  : 'default';
	$slide_by = isset( $slide_by ) ? NorExtraFilter::string( $slide_by, 'string', '1' ) : '1';
	$scroll_per_page = isset( $scroll_per_page ) ? NorExtraFilter::boolean( $scroll_per_page ) : true;
	$autoplay = isset( $autoplay ) ? NorExtraFilter::boolean( $autoplay ) : true;
	$autoplay_time = isset( $autoplay_time ) ? NorExtraFilter::string( $autoplay_time, 'string', '5' ) : '5';
	$stop_on_hover = isset( $stop_on_hover ) ? NorExtraFilter::boolean( $stop_on_hover ) : true;
	
	$nav_bg_color = isset( $nav_bg_color ) ? NorExtraFilter::string( $nav_bg_color ) : false;
	$nav_color = isset( $nav_color ) ? NorExtraFilter::string( $nav_color ) : false;
	$dots_color = isset( $dots_color ) ? NorExtraFilter::string( $dots_color ) : false;
	
	$appearance_effect = isset( $appearance_effect ) ? NorExtraFilter::string( $appearance_effect, 'attr', 'none' )  : 'none';
	$appearance_duration = isset( $appearance_duration ) ? NorExtraFilter::string( $appearance_duration, 'attr', false )  : false;
	if ( $appearance_duration ) $appearance_duration = intval( str_replace( 'ms', '', $appearance_duration ) );

	$css_class = isset( $css_class ) ? ' ' . NorExtraFilter::string( $css_class, 'attr', '' )  : '';

	// Styling
	$slider_uniqid = uniqid( 'norebro-custom-' );

	$items_css = ( $items_gap ) ? 'padding-left:' . $items_gap . ';padding-right:' . $items_gap . ';' : '';

	$dots_settings = NorExtraParser::VC_color_to_CSS( $dots_color, 'border-color:{{color}};' );
	$dots_after_settings = NorExtraParser::VC_color_to_CSS( $dots_color, 'background-color:{{color}};' );
	$nav_bg_settings = NorExtraParser::VC_color_to_CSS( $nav_bg_color, 'background-color:{{color}};' );
	$nav_settings = NorExtraParser::VC_color_to_CSS( $nav_color, 'color:{{color}};' );

	$slider_object = (object) array();
	$slider_object->loop = (bool) $loop;
	$slider_object->dots = (bool) $pagination_show;
	$slider_object->nav = (bool) $navigation_buttons;
	$slider_object->autoplay = (bool) $autoplay;
	$slider_object->autoplayHoverPause = (bool) $stop_on_hover;
	if ( $navigation_buttons ) {
		$slider_object->navContainerClass = 'slider-nav';
	}
	if ( $item_desktop ) {
		$slider_object->itemsDesktop = $item_desktop;
	}
	if ( $item_tablet ) {
		$slider_object->itemsTablet = $item_tablet;
	}
	if ( $item_mobile ) {
		$slider_object->itemsMobile = $item_mobile;
	}
	if ( $dots_each ) {
		$slider_object->dotsEach = $dots_each;
	}
	if ( $slide_by ) {
		if ( $slide_by == 'page' ) {
			$slider_object->slideBy = 'page';
		} else {
			$slider_object->slideBy = $slide_by;
		}
	}
	// if ( $navigation_buttons && $slide_speed ) {
	// 	$slider_object->navSpeed = $slide_speed;
	// }
	if ( $autoplay_time ) {
		$slider_object->autoplayTimeout = $autoplay_time;
	}
	$slider_json = json_encode( $slider_object );

	$slider_class = '';
	if ( $offset_items ) {
		$slider_class .= ' slider-offset';
	}
	if ( $navigation_buttons == 'false' ) {
		$slider_class .= ' full';
	}
	if ( !$navigation_buttons ) {
		$slider_class .= ' without-nav';
	}
	if ( $navigation_buttons ) {
		if ( $position_nav_buttons == 'offset' ) {
			$slider_class .= ' nav-offset';
		}
		if ( $position_nav_buttons == 'inset' ) {
			$slider_class .= ' nav-inset';
		}
	}

	$slider_css = '';
	if ( $items_gap && !$offset_items ) {
		$slider_css .= 'margin:0 -' . ( intval( $items_gap ) / 2 ) . 'px;';
	}

	if ( $offset_items ){
		$slider_css .= 'margin: 0 -' . $offset_size . ';';
	}

	// Assembling
	ob_start();
	include( plugin_dir_path( __FILE__ ) . 'carousel__style.php' );
	include( plugin_dir_path( __FILE__ ) . 'carousel__view.php' );
	return ob_get_clean();
}