<?php

/**
* Visual Composer Norebro Recent Projects shortcode custom style
*/

if ( $is_slider || $is_onepage || $is_splitscreen ) {
	$_style_block = '';

	if ( $dots_css ) {
		$_style_block .= '#' . $recent_projects_uniqid . ' .dots li{';
		$_style_block .= $dots_css;
		$_style_block .= '}';
		$_style_block .= '#' . $recent_projects_uniqid . ' .dots li:before{';
		$_style_block .= $dots_css_before;
		$_style_block .= '}';
	}
	if ( $nav_css ) {
		$_style_block .= '#' . $recent_projects_uniqid . ' .slider-nav > div{';
		$_style_block .= $nav_css;
		$_style_block .= '}';
	}
	if ( $scroll_desc_css ){
		$_style_block .= '#' . $recent_projects_uniqid . ' .scroll{';
		$_style_block .= $scroll_desc_css;
		$_style_block .= '}';
		$_style_block .= '#' . $recent_projects_uniqid . ' .scroll:after{';
		$_style_block .= $scroll_desc_css;
		$_style_block .= '}';
	}

	NorebroLayout::append_to_shortcodes_css_buffer( $_style_block );
}


$_style_block = '';

if ( $grid_css ) {
	$_style_block .= '#' . $recent_projects_uniqid . '{';
	$_style_block .= $grid_css;
	$_style_block .= '}';
}
if ( $grid_items_gap_css && $grid_row_css ) {
	$_style_block .= '#' . $recent_projects_uniqid . ' div.portfolio-item-wrap{';
	$_style_block .= $grid_items_gap_css;
	$_style_block .= '}';

	if ( $is_slider ) {
		$_style_block .= '#' . $recent_projects_uniqid . ' div.slider{';
		$_style_block .= $grid_row_css;
		$_style_block .= '}';
	} else {
		$_style_block .= '#' . $recent_projects_uniqid . ' div.vc_row{';
		$_style_block .= $grid_row_css;
		$_style_block .= '}';
	}

	if ( $card_layout == 'grid_6' ){
		if ( $grid_css ) {
			$_style_block .= '#' . $recent_projects_uniqid . ' .owl-stage-outer{';
			$_style_block .= $grid_css;
			$_style_block .= '}';
		}
		$_style_block .= '#' . $recent_projects_uniqid . ' .owl-prev{';
		$_style_block .= 'margin-left:' . ( esc_attr( $grid_items_gap ) ) . ';';
		$_style_block .= '}';
		$_style_block .= '#' . $recent_projects_uniqid . ' .owl-next{';
		$_style_block .= 'margin-right:' . ( esc_attr( $grid_items_gap ) ) . ';';
		$_style_block .= '}';
	}
	if ( $card_layout == 'grid_4' ){
		$_style_block .= '#' . $recent_projects_uniqid . ' .owl-prev,';
		$_style_block .= '#' . $recent_projects_uniqid . ' .owl-next{';
		$_style_block .= 'margin-left:' . ( esc_attr( $grid_items_gap ) ) . ';';
		$_style_block .= '}';
		$_style_block .= '#' . $recent_projects_uniqid . ' .owl-dots{';
		$_style_block .= 'margin-right:' . ( esc_attr( $grid_items_gap ) ) . ';';
		$_style_block .= '}';
	}
}
if ( $bg_css ) {
	switch ( $card_layout ) {
		case 'grid_5':
			$_style_block .= '#' . $recent_projects_uniqid . '{';
			$_style_block .= $bg_css;
			$_style_block .= '}';
			break;
	}
}
if ( $overlay_css ) {
	switch ( $card_layout ) {
		case 'grid_1_hover_1':
		case 'grid_1_hover_2':
		case 'grid_1_hover_3':
			$_style_block .= '#' . $recent_projects_uniqid . ' .portfolio-item .description{';
			$_style_block .= $overlay_css;
			$_style_block .= '}';
			break;
		case 'grid_2_hover_2':
		case 'grid_4':
		case 'grid_7':
		case 'grid_8':
			$_style_block .= '#' . $recent_projects_uniqid . ' .overlay{';
			$_style_block .= $overlay_css;
			$_style_block .= '}';
			break;
	}
}
if ( $category_css ) {
	$_style_block .= '#' . $recent_projects_uniqid . ' .portfolio-item .category{';
	$_style_block .= $category_css;
	$_style_block .= '}';
}
if ( $title_css ) {
	$_style_block .= '#' . $recent_projects_uniqid . ' .portfolio-item h4,';
	$_style_block .= '#' . $recent_projects_uniqid . ' .portfolio-item h4 a{';
	$_style_block .= $title_css;
	$_style_block .= '}';
}
if ( $more_css ) {
	switch ( $card_layout ) {
		case 'grid_1_hover_1':
		case 'grid_1_hover_2':
		case 'grid_1_hover_3':
			$_style_block .= '#' . $recent_projects_uniqid . ' .portfolio-item .more{';
			$_style_block .= $more_css;
			$_style_block .= '}';
			break;
		case 'grid_2_hover_2':
			$_style_block .= '#' . $recent_projects_uniqid . ' .overlay span{';
			$_style_block .= $more_css;
			$_style_block .= '}';
			break;
		case 'grid_4':
		case 'grid_5':
		case 'grid_7':
		case 'grid_8':
			$_style_block .= '#' . $recent_projects_uniqid . ' .portfolio-item .more,';
			$_style_block .= '#' . $recent_projects_uniqid . ' .portfolio-item .more span{';
			$_style_block .= $more_css;
			$_style_block .= '}';
			$_style_block .= '#' . $recent_projects_uniqid . ' .portfolio-item .more:before{';
			$_style_block .= $more_css_before;
			$_style_block .= '}';
			break;
	}
}

if ( $use_pagination ) {
	if ( $pagination_css ) {
		switch ( $pagination_type ) {
			case 'simple':
				$_style_block .= '#' . $recent_projects_uniqid . ' .pagination a {';
				$_style_block .= $pagination_css;
				$_style_block .= '}';
				break;
			case 'lazy_scroll':
			case 'lazy_button':
				$_style_block .= '#' . $recent_projects_uniqid . ' .lazy-load {';
				$_style_block .= $pagination_css;
				$_style_block .= '}';
				break;
		}
	}
	if ( $pagination_hover_css ) {
		switch ( $pagination_type ) {
			case 'simple':
				$_style_block .= '#' . $recent_projects_uniqid . ' .pagination a:hover,';
				$_style_block .= '#' . $recent_projects_uniqid . ' .pagination a.active {';
				$_style_block .= $pagination_hover_css;
				$_style_block .= '}';
				break;
			case 'lazy_scroll':
			case 'lazy_button':
				$_style_block .= '#' . $recent_projects_uniqid . ' .lazy-load:hover {';
				$_style_block .= $pagination_hover_css;
				$_style_block .= '}';
				break;
		}
	}
}

NorebroLayout::append_to_shortcodes_css_buffer( $_style_block );