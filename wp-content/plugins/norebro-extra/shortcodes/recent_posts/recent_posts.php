<?php 

/**
* Visual Composer Norebro Recent Posts shortcode
*/

add_shortcode( 'norebro_recent_posts', 'norebro_recent_posts_func' );

function norebro_recent_posts_func( $atts ) {
	if ( isset( $atts ) && is_array( $atts ) ) extract( $atts );

	// Default values, parsing and filtering
	$post_category = isset( $post_category ) ? NorExtraFilter::string( $post_category, 'string', 'all' ) : 'all';
	$card_layout = isset( $card_layout ) ? NorExtraFilter::string( $card_layout, 'string', 'classic' ) : 'classic';
	$columns_in_row = isset( $columns_in_row ) ? NorExtraFilter::string( $columns_in_row, 'string', '4-3-2-1' ) : '4-3-2-1';
	$posts_in_block = isset( $posts_in_block ) ? NorExtraFilter::string( $posts_in_block, 'string', 12 ) : 12;
	$card_boxed = isset( $card_boxed ) ? NorExtraFilter::boolean( $card_boxed ) : true;
	$card_gap = isset( $card_gap ) ? NorExtraFilter::string( $card_gap, 'string', '15px' ) : '15px';
	$card_striped = isset( $card_striped ) ? NorExtraFilter::boolean( $card_striped ) : false;
	$card_indented = isset( $card_indented ) ? NorExtraFilter::boolean( $card_indented ) : false;
	if ( $card_layout != 'striped' ) {
		$card_striped = false;
		$card_indented = false;
	}
	
	$text_typo = isset( $text_typo ) ? NorExtraFilter::string( $text_typo, 'string', '' ) : '';
	$heading_typo = isset( $heading_typo ) ? NorExtraFilter::string( $heading_typo, 'string', '' ) : '';
	$subtitle_typo = isset( $subtitle_typo ) ? NorExtraFilter::string( $subtitle_typo, 'string', '' ) : '';

	$use_pagination = isset( $use_pagination ) ? NorExtraFilter::boolean( $use_pagination ) : false;
	$pagination_type = isset( $pagination_type ) ? NorExtraFilter::string( $pagination_type, 'attr', 'simple' ) : 'simple';
	$pagination_items_per_page = isset( $pagination_items_per_page ) ? NorExtraFilter::string( $pagination_items_per_page, 'string', '6' ) : '6';

	$card_background_color = isset( $card_background_color ) ? NorExtraFilter::string( $card_background_color, 'string', false ) : false;
	$card_text_color = isset( $card_text_color ) ? NorExtraFilter::string( $card_text_color, 'string', false ) : false;
	$card_heading_color = isset( $card_heading_color ) ? NorExtraFilter::string( $card_heading_color, 'string', false ) : false;
	$card_subtitle_color = isset( $card_subtitle_color ) ? NorExtraFilter::string( $card_subtitle_color, 'string', false ) : false;

	$pagination_color = isset( $pagination_color ) ? NorExtraFilter::string( $pagination_color ) : false;
	$pagination_active_color = isset( $pagination_active_color ) ? NorExtraFilter::string( $pagination_active_color ) : false;

	$animation_type = isset( $animation_type ) ? NorExtraFilter::string( $animation_type, 'string', 'default' ) : 'default';
	$animation_effect = isset( $animation_effect ) ? NorExtraFilter::string( $animation_effect, 'string', 'fade-up' ) : 'fade-up';

	$appearance_effect = isset( $appearance_effect ) ? NorExtraFilter::string( $appearance_effect, 'attr', 'none' )  : 'none';
	$appearance_duration = isset( $appearance_duration ) ? NorExtraFilter::string( $appearance_duration, 'attr', false )  : false;
	if ( $appearance_duration ) $appearance_duration = intval( str_replace( 'ms', '', $appearance_duration ) );

	$css_class = isset( $css_class ) ? ' ' . NorExtraFilter::string( $css_class, 'attr', '' )  : '';

	if ( $post_category != 'all' ) {
		$_post_category = $post_category;
		$post_category = array();
		foreach ( explode( ',', $_post_category) as $category) {
			$post_category[] = intval( trim( $category ) );
		}
	}

	$_tax_query = array();
	if ( $post_category != 'all' ) {
		$_tax_query = array(
			array(
				'taxonomy' => 'category',
				'field'    => 'term_id',
				'terms'    => $post_category
			)
		);
	}

	$args = array(
		'posts_per_page' => intval( $posts_in_block ),
		'offset' => 0,
		'category' => '',
		'category_name' => '',
		'orderby' => 'date',
		'order' => 'DESC',
		'include' => '',
		'exclude' => '',
		'meta_key' => '',
		'meta_value' => '',
		'post_type' => 'post',
		'tax_query' => $_tax_query,
		'post_mime_type' => '',
		'post_parent' => '',
		'author' => '',
		'author_name' => '',
		'post_status' => 'publish',
		'suppress_filters' => false 
	);
	$posts_data = get_posts( $args );

	$column_class = NorExtraParser::VC_columns_to_CSS( $columns_in_row );
	$column_double_class = NorExtraParser::VC_columns_to_CSS( $columns_in_row, true );

	$columns_in_row = explode( '-', $columns_in_row );
	if ( is_array( $columns_in_row ) ) {
		$columns_in_row = intval( $columns_in_row[0] );
	}


	$items_css = '';
	if ( $card_gap ) {
		$items_css = 'padding: ' . $card_gap . '; ';
	}

	// Styling
	$recent_posts_uniqid = uniqid( 'norebro-custom-' );

	$card_background_css = NorExtraParser::VC_color_to_CSS( $card_background_color, 'background-color:{{color}};' );
	$card_text_css = NorExtraParser::VC_color_to_CSS( $card_text_color, 'color:{{color}};' );
	$card_heading_css = NorExtraParser::VC_color_to_CSS( $card_heading_color, 'color:{{color}};' );
	$card_subtitle_css = NorExtraParser::VC_color_to_CSS( $card_subtitle_color, 'color:{{color}};' );
	
	NorExtraParser::VC_typo_custom_font( $text_typo );
	NorExtraParser::VC_typo_custom_font( $heading_typo );
	NorExtraParser::VC_typo_custom_font( $subtitle_typo );

	$card_text_css .= NorExtraParser::VC_typo_to_CSS( $text_typo );
	$card_heading_css .= NorExtraParser::VC_typo_to_CSS( $heading_typo );
	$card_subtitle_css .= NorExtraParser::VC_typo_to_CSS( $card_subtitle_color );

	$pagination_class = $pagination_css = $pagination_hover_css = '';
	if ( $use_pagination ) {
		$pagination_css = NorExtraParser::VC_color_to_CSS( $pagination_color, 'color:{{color}};' );
		$pagination_hover_css = NorExtraParser::VC_color_to_CSS( $pagination_active_color, 'color:{{color}};' );
	}

	// Assembling
	include( plugin_dir_path( __FILE__ ) . 'recent_posts__style.php' );
	ob_start();
	include( plugin_dir_path( __FILE__ ) . 'recent_posts__view.php' );
	return ob_get_clean();
}