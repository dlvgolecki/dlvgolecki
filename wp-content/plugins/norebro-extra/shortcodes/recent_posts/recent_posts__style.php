<?php

/**
* Visual Composer Norebro Recent Posts shortcode custom style
*/

$_style_block = '';

if ( $items_css ) {
	$_style_block .= '#' . $recent_posts_uniqid . ' .norebro-card-wrapper{';
	$_style_block .= $items_css;
	$_style_block .= '}';

	$_style_block .= '#' . $recent_posts_uniqid . ' .norebro-card-wrapper .blog-grid .overlay{';
	$_style_block .= $card_text_css;
	if ( ! in_array( $card_layout, array( 'simple' ) ) ) {
		$_style_block .= $card_background_css;
	}
	$_style_block .= '}';
	
	if ( in_array( $card_layout, array( 'simple' ) ) ) {
		$_style_block .= '#' . $recent_posts_uniqid . ' .norebro-card-wrapper .blog-grid:hover{';
		$_style_block .= $card_background_css;
		$_style_block .= '}';
	}
	
	$_style_block .= '#' . $recent_posts_uniqid . ' .norebro-card-wrapper .blog-grid p{';
	$_style_block .= $card_text_css;
	$_style_block .= '}';
}

if ( $card_heading_css ) {
	$_style_block .= '#' . $recent_posts_uniqid . ' .norebro-card-wrapper .blog-grid h3 > a{';
	$_style_block .= $card_heading_css;
	$_style_block .= '}';
}

if ( $card_subtitle_css ) {
	$_style_block .= '#' . $recent_posts_uniqid . ' .norebro-card-wrapper .blog-grid footer,';
	$_style_block .= '#' . $recent_posts_uniqid . ' .norebro-card-wrapper .blog-grid footer a,';
	$_style_block .= '#' . $recent_posts_uniqid . ' .norebro-card-wrapper .blog-grid footer .data{';
	$_style_block .= $card_subtitle_css;
	$_style_block .= '}';
}

if ( $use_pagination ) {
	if ( $pagination_css ) {
		switch ( $pagination_type ) {
			case 'simple':
				$_style_block .= '#' . $recent_posts_uniqid . ' .pagination a {';
				$_style_block .= $pagination_css;
				$_style_block .= '}';
				break;
			case 'lazy_scroll':
			case 'lazy_button':
				$_style_block .= '#' . $recent_posts_uniqid . ' .lazy-load {';
				$_style_block .= $pagination_css;
				$_style_block .= '}';
				break;
		}
	}
	if ( $pagination_hover_css ) {
		switch ( $pagination_type ) {
			case 'simple':
				$_style_block .= '#' . $recent_posts_uniqid . ' .pagination a:hover,';
				$_style_block .= '#' . $recent_posts_uniqid . ' .pagination a.active {';
				$_style_block .= $pagination_hover_css;
				$_style_block .= '}';
				break;
			case 'lazy_scroll':
			case 'lazy_button':
				$_style_block .= '#' . $recent_posts_uniqid . ' .lazy-load:hover {';
				$_style_block .= $pagination_hover_css;
				$_style_block .= '}';
				break;
		}
	}
}

NorebroLayout::append_to_shortcodes_css_buffer( $_style_block );