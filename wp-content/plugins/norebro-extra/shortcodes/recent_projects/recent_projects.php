<?php

/**
* Visual Composer Norebro Recent Portfolio Projects shortcode
*/

add_shortcode( 'norebro_recent_projects', 'norebro_recent_projects_func' );

function norebro_recent_projects_func( $atts ) {
	if ( isset( $atts ) && is_array( $atts ) ) extract( $atts );

	// Default values, parsing and filtering
	$projects_solid = isset( $projects_solid ) ? NorExtraFilter::boolean( $projects_solid ) : false;
	$projects_category = isset( $projects_category ) ? NorExtraFilter::string( $projects_category, 'attr', 'all' ) : 'all';

	$open_in_popup = isset( $open_in_popup ) ? NorExtraFilter::boolean( $open_in_popup ) : false;
	$hide_view_link_in_popup = isset( $hide_view_link_in_popup ) ? NorExtraFilter::boolean( $hide_view_link_in_popup ) : false;
	$popup_show_nav_buttons = isset( $popup_show_nav_buttons ) ? NorExtraFilter::boolean( $popup_show_nav_buttons ) : false;
	$popup_mouse_scrolling = isset( $popup_mouse_scrolling ) ? NorExtraFilter::boolean( $popup_mouse_scrolling ) : false;
	$popup_autoplay = isset( $popup_autoplay ) ? NorExtraFilter::boolean( $popup_autoplay ) : false;
	$popup_autoplay_time = isset( $popup_autoplay_time ) ? NorExtraFilter::string( $popup_autoplay_time, 'attr', '5' ) : '5';

	$show_projects_filter = isset( $show_projects_filter ) ? NorExtraFilter::boolean( $show_projects_filter ) : true;
	$filter_align = isset( $filter_align ) ? NorExtraFilter::string( $filter_align, 'attr', 'center' ) : 'center';
	$columns_in_row = isset( $columns_in_row ) ? NorExtraFilter::string( $columns_in_row, 'attr', '4-3-2-1' ) : '4-3-2-1';
	$card_layout = isset( $card_layout ) ? NorExtraFilter::string( $card_layout, 'string', 'grid_1_hover_1' ) : 'grid_1_hover_1';
	$metro_style = isset( $metro_style ) ? NorExtraFilter::boolean( $metro_style ) : false;
	$grid_height = isset( $grid_height ) ? NorExtraFilter::string( $grid_height, 'string', '500px' ) : '500px';
	$grid_items_gap = isset( $grid_items_gap ) ? NorExtraFilter::string( $grid_items_gap, 'string', '15px' ) : '15px';
	$mouse_wheel_srolling = isset($mouse_wheel_srolling) ? NorExtraFilter::string( $mouse_wheel_srolling, 'string', 'true' ) : '0';

	$use_pagination = isset( $use_pagination ) ? NorExtraFilter::boolean( $use_pagination ) : false;

	$projects_in_block = isset( $projects_in_block ) ? NorExtraFilter::string( $projects_in_block, 'attr', 4 ) : 4;

	$pagination_type = isset( $pagination_type ) ? NorExtraFilter::string( $pagination_type, 'attr', 'simple' ) : 'simple';
	$pagination_items_per_page = isset( $pagination_items_per_page ) ? NorExtraFilter::string( $pagination_items_per_page, 'string', '6' ) : '6';

	$animation_type = isset( $animation_type ) ? NorExtraFilter::string( $animation_type, 'string', 'default' ) : 'default';
	$animation_effect = isset( $animation_effect ) ? NorExtraFilter::string( $animation_effect, 'string', 'fade-up' ) : 'fade-up';

	$portfolio_images_size = isset( $portfolio_images_size ) ? NorExtraFilter::string( $portfolio_images_size, 'string', 'medium_large' ) : 'inherit';
	if(!$portfolio_images_size || $portfolio_images_size == 'inherit') {
        $portfolio_images_size = NorebroSettings::get('portfolio_images_size', 'global');
    }

	if ( $projects_category != 'all' ) {
		$_projects_category = $projects_category;
		$projects_category = array();
		foreach ( explode( ',', $_projects_category) as $category) {
			$projects_category[] = intval( trim( $category ) );
		}
	}

	$appearance_effect = isset( $appearance_effect ) ? NorExtraFilter::string( $appearance_effect, 'attr', 'none' ) : 'none';
	$appearance_duration = isset( $appearance_duration ) ? NorExtraFilter::string( $appearance_duration, 'attr', false ) : false;
	if ( $appearance_duration ) $appearance_duration = intval( str_replace( 'ms', '', $appearance_duration ) );

	$css_class = isset( $css_class ) ? ' ' . NorExtraFilter::string( $css_class, 'attr', '' )  : '';

	$offset_items = isset( $offset_items ) ? NorExtraFilter::boolean( $offset_items ) : false;
	$item_desktop = isset( $item_desktop ) ? NorExtraFilter::string( $item_desktop, 'attr', '5' ) : '5';
	$item_tablet = isset( $item_tablet ) ? NorExtraFilter::string( $item_tablet, 'attr', '3' ) : '3';
	$item_mobile = isset( $item_mobile ) ? NorExtraFilter::string( $item_mobile, 'attr', '1' ) : '1';
	$loop = isset( $loop ) ? NorExtraFilter::boolean( $loop ) : true;
	$pagination_show = isset( $pagination_show ) ? NorExtraFilter::boolean( $pagination_show ) : true;
	$pagination_slider_type = isset( $pagination_slider_type ) ? NorExtraFilter::string( $pagination_slider_type, 'attr', 'numbers' ) : 'numbers';
	$navigation_buttons = isset( $navigation_buttons ) ? NorExtraFilter::boolean( $navigation_buttons ) : false;
	$dots_each = isset( $dots_each ) ? NorExtraFilter::string( $dots_each, 'attr', '' ) : '';
	$slide_by = isset( $slide_by ) ? NorExtraFilter::string( $slide_by, 'attr', '1' ) : '1';
	$slide_speed = isset( $slide_speed ) ? NorExtraFilter::string( $slide_speed, 'attr', '500' ) : '500';
	$autoplay = isset( $autoplay ) ? NorExtraFilter::boolean( $autoplay ) : true;
	$autoplay_time = isset( $autoplay_time ) ? NorExtraFilter::string( $autoplay_time, 'attr', '5' ) : '5';
	$stop_on_hover = isset( $stop_on_hover ) ? NorExtraFilter::boolean( $stop_on_hover ) : true;
	$hide_slider_scroll_label = isset( $hide_slider_scroll_label ) ? NorExtraFilter::boolean( $hide_slider_scroll_label ) : false;

	$overlay_color = isset( $overlay_color ) ? NorExtraFilter::string( $overlay_color ) : false;
	$bg_color = isset( $bg_color ) ? NorExtraFilter::string( $bg_color ) : false;
	$category_outline = isset( $category_outline ) ? NorExtraFilter::boolean( $category_outline ) : false;
	$category_bg_color = isset( $category_bg_color ) ? NorExtraFilter::string( $category_bg_color ) : false;
	$category_color = isset( $category_color ) ? NorExtraFilter::string( $category_color ) : false;
	$title_color = isset( $title_color ) ? NorExtraFilter::string( $title_color ) : false;
	$more_color = isset( $more_color ) ? NorExtraFilter::string( $more_color ) : false;
	$dots_color = isset( $dots_color ) ? NorExtraFilter::string( $dots_color ) : false;
	$nav_bg_color = isset( $nav_bg_color ) ? NorExtraFilter::string( $nav_bg_color ) : false;
	$nav_color = isset( $nav_color ) ? NorExtraFilter::string( $nav_color ) : false;
	$scroll_desc_color = isset( $scroll_desc_color ) ? NorExtraFilter::string( $scroll_desc_color ) : false;

	$pagination_color = isset( $pagination_color ) ? NorExtraFilter::string( $pagination_color ) : false;
	$pagination_active_color = isset( $pagination_active_color ) ? NorExtraFilter::string( $pagination_active_color ) : false;

	if ( $show_projects_filter ) {
		$css_class .= ' with-sorting';
	}

	$_tax_query = array();
	if ( $projects_category != 'all' ) {
		$_tax_query = array(
			array(
				'taxonomy' => 'norebro_portfolio_category',
				'terms'    => $projects_category
			)
		);
	}

	if (is_front_page()) {
		$paged = (get_query_var('page')) ? get_query_var('page') : 1;
	} else {
		$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
	}

	$args = array(
	  'posts_per_page' 	=> intval( $projects_in_block ),
	  'orderby' 		=> 'date',
	  'order' 			=> 'DESC',
	  'post_type' 		=> 'norebro_portfolio',
	  'tax_query' 		=> $_tax_query,
	  'post_status' 	=> 'publish',
	  'paged'			=> $paged
	);
	$query = new WP_Query( $args );

	$projects_data = $query->posts;

	$column_class = NorExtraParser::VC_columns_to_CSS( $columns_in_row );
	$column_double_class = NorExtraParser::VC_columns_to_CSS( $columns_in_row, true );

	$columns_in_row = explode( '-', $columns_in_row );
	if ( is_array( $columns_in_row ) ) {
		$columns_in_row = intval( $columns_in_row[0] );
	}

	$is_slider = false;
	$is_splitscreen = false;
	$is_onepage = false;

	switch ( $card_layout ) {
		case 'grid_4':
		case 'grid_6':
			$is_slider = true;
			break;
		case 'grid_5':
			$is_splitscreen = true;
			break;
		case 'grid_7':
		case 'grid_8':
			$is_onepage = true;
			break;
	}

	// Styling
	$recent_projects_uniqid = uniqid( 'norebro-custom-' );
	$GLOBALS['norebro_icon_fonts'][] = 'my-icon-arr-out';

	if ( $card_layout == 'grid_4' || $card_layout == 'grid_6' ) {
		$grid_items_gap_css = 'padding-left: ' . $grid_items_gap . '; padding-right:' . $grid_items_gap . ';';
		$grid_row_css = 'margin-left: -' . ( $grid_items_gap ) . ';margin-right: -' . ( $grid_items_gap ) . ';';
	} else {
		$grid_items_gap_css = 'padding: ' . $grid_items_gap . ';';
		$grid_row_css = 'margin: -' . ( $grid_items_gap ) . ';';
	}


	switch ( $filter_align ) {
		case 'left':
			$filter_align_class = ' text-left';
			break;
		case 'right':
			$filter_align_class = ' text-right';
			break;
		default:
			$filter_align_class = '';
			break;
	}

	$grid_css = '';
	if ( $grid_height ) {
		switch ( $card_layout ) {
			case 'grid_4':
			case 'grid_5':
			case 'grid_7':
			case 'grid_8':
				$grid_css = 'height: ' . $grid_height . ';';
				break;
		}
	}

	$dots_css = '';
	$dots_css_before = '';
	$dot_class = '';
	if ( $dots_color ) {
		if ( $dots_color == 'brand'  ) {
			$dot_class .= ' brand-color-i brand-bg-color-before-i';
		} else {
			$dots_css .= 'color:' . $dots_color . ';';
			$dots_css_before .= 'background-color:' . $dots_color . ';';
		}
	}

	$nav_css = '';
	$nav_btn_class = '';
	if ( $nav_color ) {
		if ( $nav_color == 'brand' ) {
			$nav_btn_class .= ' brand-color-i';
		} else {
			$nav_css .= 'color: ' . $nav_color . ';';
		}
	}
	if ( $nav_bg_color ) {
		if ( $nav_bg_color == 'brand' ) {
			$nav_btn_class .= ' brand-bg-color-i';
		} else {
			$nav_css .= 'background-color: ' . $nav_bg_color . ';';
		}
	}

	$scroll_desc_css = '';
	$scroll_desc_class = '';
	if ( $scroll_desc_color ) {
		if ( $scroll_desc_color == 'brand' ) {
			$scroll_desc_class .= ' brand-color-i brand-border-color-after-i';
		} else {
			$scroll_desc_css .= 'color: ' . $scroll_desc_color . ';border-color:' . $scroll_desc_color . ';';
		}
	}

	$overlay_css = ( $overlay_color ) ? 'background-color:' . $overlay_color . ';' : '';

	$bg_css = '';
	$bg_class = '';
	if ( $bg_color && $card_layout == 'grid_5' ) {
		if ( $bg_color == 'brand' ) {
			$bg_class .= ' brand-bg-color-i';
		} else {
			$bg_css .= 'background-color:' . $bg_color . ';';
		}
	}


	$more_css = '';
	$more_css_before = '';
	$more_class = '';
	if ( $more_color ) {
		switch ( $card_layout ) {
			case 'grid_1_hover_1':
			case 'grid_1_hover_2':
			case 'grid_1_hover_3':
				if ( $more_color == 'brand' ) {
					$more_class .= ' brand-color-i';
				} else {
					$more_css .= 'color:' . $more_color . ';';
				}
				break;
			case 'grid_2_hover_2':
				if ( $more_color == 'brand' ) {
					$more_class .= ' brand-color-i brand-border-color-i';
				} else {
					$more_css .= 'color:' . $more_color . ';border-color:' . $more_color . ';';
				}
				break;
			case 'grid_4':
			case 'grid_5':
			case 'grid_7':
			case 'grid_8':
				if ( $more_color == 'brand' ) {
					$more_class .= ' brand-color-i brand-bg-color-before-i';
				} else {
					$more_css .= 'color:' . $more_color . ';';
					$more_css_before .= 'background-color:' . $more_color . ';';
				}
				break;
		}
	}


	$category_css = '';
	$category_class = '';

	switch ( $card_layout ) {
		case 'grid_1_hover_1':
		case 'grid_1_hover_2':
		case 'grid_1_hover_3':
		case 'grid_3':
		case 'grid_4':
		case 'grid_5':
		case 'grid_7':
		case 'grid_8':
			if ( $category_outline ) {
				$category_class .= ' outline';
				if ( $category_color ) {
					if ( $category_color == 'brand' ) {
						$category_class .= ' brand-color-i brand-border-color-i';
					} else {
						$category_css .= 'color:' . $category_color . ';border-color:' . $category_color . ';';
					}
				}
			} else {
				if ( $category_color ) {
					if ( $category_color == 'brand' ) {
						$category_class .= ' brand-color-i';
					} else {
						$category_css .= 'color:' . $category_color . ';';
					}
				}
				if ( $category_bg_color ) {
					if ( $category_bg_color == 'brand' ) {
						$category_class .= ' brand-bg-color-i';
					} else {
						$category_css .= 'background-color: ' . $category_bg_color . ';';
					}
				}
			}
			break;
		case 'grid_2_hover_1':
		case 'grid_2_hover_2':
		case 'grid_2_hover_3':
		case 'grid_6':
			if ( $category_color ) {
				if ( $category_color == 'brand' ) {
					$category_class .= ' brand-color-i';
				} else {
					$category_css .= 'color:' . $category_color . ';';
				}
			}
			break;
	}


	$title_css = ( $title_color && $title_color != 'brand' ) ? 'color:' . $title_color . ';' : '';
	$title_class = '';
	if ( $title_color == 'brand' ) {
		$title_class .= ' brand-color-i';
	}

	$pagination_class = $pagination_css = $pagination_hover_css = '';

	if ( $use_pagination ) {
		$pagination_css = NorExtraParser::VC_color_to_CSS( $pagination_color, 'color:{{color}};' );
		$pagination_hover_css = NorExtraParser::VC_color_to_CSS( $pagination_active_color, 'color:{{color}};' );
	}

	if ( $is_slider ){
		$slider_object = (object) array();
        $slider_object->mousewheel = (bool) $mouse_wheel_srolling;
		$slider_object->loop = (bool) $loop;
		$slider_object->dots = (bool) $pagination_show;
		$slider_object->nav = (bool) $navigation_buttons;
		$slider_object->autoplay = (bool) $autoplay;
		$slider_object->autoplayHoverPause = (bool) $stop_on_hover;
		$slider_object->navContainerClass = 'slider-nav';
		$slider_object->keyControl = true;
		if ( $nav_btn_class ) $slider_object->navClass = array( $nav_btn_class, $nav_btn_class );
		if ( $dot_class ) $slider_object->dotClass = $dot_class;
		if ( $item_desktop ) $slider_object->itemsDesktop = $item_desktop;
		if ( $item_tablet ) $slider_object->itemsTablet = $item_tablet;
		if ( $item_mobile ) $slider_object->itemsMobile = $item_mobile;
		if ( $dots_each ) $slider_object->dotsEach = $dots_each;
		if ( $slide_by ) $slider_object->slideBy = ( $slide_by == 'page' ) ? 'page' : (int) $slide_by;
		if ( $slide_speed ) $slider_object->navSpeed = $slide_speed;
		if ( $autoplay_time ) $slider_object->autoplayTimeout = $autoplay_time;
		if ( $card_layout == 'grid_5' ) $slider_object->vertical = true;
		if ( $card_layout == 'grid_4' && $grid_height != 'auto' ) {
			$slider_object->autoHeight = false;
		}
		if ( $card_layout == 'grid_4' ) {
			$slider_object->dotsClass = 'slider-vertical-' . $pagination_slider_type;
		}



		$slider_json = json_encode( $slider_object );

		if ( ! $navigation_buttons ) {
			$css_class .= ' without-nav';
		}

		$slider_class = '';
		if ( $offset_items ) {
			$slider_class .= ' slider-offset';
		}
		if ( $navigation_buttons == 'false' ) {
			$slider_class .= ' full';
		}


		$slider_wrap_class = '';

		switch ( $card_layout ) {
			case 'grid_4':
				$slider_wrap_class .= ' portfolio-grid-4';
				break;
			case 'grid_6':
				$slider_wrap_class .= ' portfolio-grid-6';
				break;
		}
		if ( $hide_slider_scroll_label ) {
			$slider_wrap_class .= ' hide-scroll';
		}
	}

	if ( $is_splitscreen ) {
		NorebroHelper::add_required_script( 'multiscroll' );

		$multiscroll_object = (object) array();
        $multiscroll_object->mousewheel = (bool) $mouse_wheel_srolling;
		$multiscroll_object->nav = (bool) $navigation_buttons;
		$multiscroll_object->navContainerClass = 'slider-nav';
		$multiscroll_object->dots = (bool) $pagination_show;
		$multiscroll_object->dotsClass = 'slider-vertical-' . $pagination_slider_type;
		if ( $dot_class ) {
			$multiscroll_object->dotClass = $dot_class;
		}
		if ( $nav_btn_class ) {
			$multiscroll_object->navClass = array( 'up ' . $nav_btn_class, 'down ' . $nav_btn_class );
		} else {
			$multiscroll_object->navClass = array( 'up', 'down' );
		}
		$multiscroll_json = json_encode( $multiscroll_object );

		$splitscreen_class = '';
		switch ( $card_layout ) {
			case 'grid_5':
				$splitscreen_class .= ' portfolio-grid-5';
				break;
		}
	}

	if ( $is_onepage ) {
		$onepage_object = (object) array();
        $onepage_object->mousewheel = (bool) $mouse_wheel_srolling;
		$onepage_object->nav = (bool) $navigation_buttons;
		$onepage_object->navContainerClass = 'slider-nav';
		$onepage_object->dots = (bool) $pagination_show;
		$onepage_object->dotsClass = 'slider-vertical-' . $pagination_slider_type;
		if ( $nav_btn_class ) {
			$onepage_object->navClass = array( 'up ' . $nav_btn_class, 'down ' . $nav_btn_class );
		} else {
			$onepage_object->navClass = array( 'up', 'down' );
		}
		if ( $card_layout == 'grid_8' ) {
			$onepage_object->vertical = true;
		}
		$onepage_json = json_encode( $onepage_object );

		/*
		$onepage_json = '{';
		$onepage_json .= '"nav":' . (( $navigation_buttons ) ? 'true' : 'false' ) . ',';
		$onepage_json .= '"navContainerClass": "slider-nav",';
		$onepage_json .= '"dots":' . (( $pagination_show ) ? 'true' : 'false' ) . ',';
		$onepage_json .= '"dotsClass": "slider-vertical-numbers",';
		if ( $dot_class ) {
			$onepage_json .= '"dotClass":"' . $dot_class . '",';
		}
		if ( $nav_btn_class ) {
			$onepage_json .= '"navClass": ["up ' . $nav_btn_class . '","down ' . $nav_btn_class . '"],';
		} else {
			$onepage_json .= '"navClass": ["up","down"],';
		}
		$onepage_json[ strlen( $onepage_json ) - 1 ] = '}';
		*/

		$onepage_class = '';
		if ( $card_layout == 'grid_7' ) {
			$onepage_class .= ' portfolio-grid-7';
		}
		if ( $card_layout == 'grid_8' ) {
			$onepage_class .= ' horizontal portfolio-grid-8';
		}
		if ( $hide_slider_scroll_label ) {
			$onepage_class .= ' hide-scroll';
		}
	}

	// Assembling
	include( plugin_dir_path( __FILE__ ) . 'recent_projects__style.php' );
	ob_start();
	include( plugin_dir_path( __FILE__ ) . 'recent_projects__view.php' );
	return ob_get_clean();
}
