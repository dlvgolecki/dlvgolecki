<?php 

/**
* Visual Composer Norebro WooCoomerce categories module shortcode
*/

add_shortcode( 'norebro_woo_categories', 'norebro_woo_categories_func' );

function norebro_woo_categories_func( $atts ) {
	$layout = $alignment = $subtitle_position = $appearance_effect = $appearance_duration = $css_class = $woo_categories 
	= $layout_columns = $title_typo = $description_typo = $button_typo = $title_color = $description_color = $overlay_color 
	= $button = NULL;
	if ( isset( $atts ) && is_array( $atts ) ) extract( $atts );

	// Default values, parsing and filtering

	$layout = NorExtraFilter::string( $layout, 'string', 'default');
	$alignment = NorExtraFilter::string( $alignment, 'string', 'left');
	$subtitle_position = NorExtraFilter::string( $subtitle_position, 'string', 'bottom');
	$woo_categories = NorExtraFilter::string( $woo_categories, 'string', '');
	$layout_columns = NorExtraFilter::string( $layout_columns, 'string', '1');

	$title_typo = NorExtraFilter::string( $title_typo, 'string', '');
	$description_typo = NorExtraFilter::string( $description_typo, 'string', '');
	$button_typo = NorExtraFilter::string( $button_typo, 'string', '');
	$title_color = NorExtraFilter::string( $title_color, 'string', '');
	$description_color = NorExtraFilter::string( $description_color, 'string', '');
	$overlay_color = NorExtraFilter::string( $overlay_color, 'string', '');
	$button = NorExtraFilter::string( $button, 'string', '');

	$appearance_effect = isset( $appearance_effect ) ? NorExtraFilter::string( $appearance_effect, 'attr', 'none' ) : 'none';
	$appearance_duration = isset( $appearance_duration ) ? NorExtraFilter::string( $appearance_duration, 'attr', false ) : false;
	if ( $appearance_duration ) $appearance_duration = intval( str_replace( 'ms', '', $appearance_duration ) );

	$css_class = isset( $css_class ) ? ' ' . NorExtraFilter::string( $css_class, 'attr', '' ) : '';

	$_woo_categories = array();
    if (!empty($woo_categories)) {
        foreach (explode(',', $woo_categories) as $category_id) {
            $category_id = (int)$category_id;
            $term = get_term_by('id', $category_id, 'product_cat');
            $cat = (object)array('title' => '', 'description' => '', 'url' => '', 'image' => '');
            if ($term) {
                $cat->title = isset($term->name) ? $term->name : '';
                $cat->description = isset($term->description) ? $term->description : '';
                $cat->url = get_term_link($category_id, 'product_cat');
                $thumbnail_id = get_woocommerce_term_meta($category_id, 'thumbnail_id', true);
                if ($thumbnail_id) {
                    $cat->image = wp_get_attachment_image_src($thumbnail_id, 'large');
                    if (is_array($cat->image)) {
                        $cat->image = $cat->image[0];
                    }
                } else {
                    $cat->image = wc_placeholder_img_src();
                }
                if ($cat->image) {
                    $cat->image = str_replace(' ', '%20', $cat->image);
                }
            }
            $_woo_categories[] = $cat;
        }
    } else {
        $terms = get_terms( 'product_cat', array() );

        if ( $terms ) {
            foreach ($terms as $term) {

                $cat = (object) array( 'title' => '', 'description' => '', 'url' => '', 'image' => '');
                $cat->title = isset($term->name) ? $term->name : '';
                $cat->description = isset($term->description) ? $term->description : '';
                $cat->url = get_term_link( $term->term_id, 'product_cat' );
                $thumbnail_id = get_term_meta( $term->term_id, 'thumbnail_id', true );

                if ( $thumbnail_id ) {
                    $cat->image = wp_get_attachment_image_src( $thumbnail_id, 'large' );
                    if ( is_array( $cat->image ) ) {
                        $cat->image = $cat->image[0];
                    }
                } else {
                    $cat->image = wc_placeholder_img_src();
                }
                if ( $cat->image ) { $cat->image = str_replace( ' ', '%20', $cat->image ); }
                $_woo_categories[] = $cat;
            }
        }
    }
    $woo_categories = $_woo_categories;

	$layout_columns_class = '12';
	switch ($layout_columns) {
		case '1': $layout_columns_class = '12'; break;
		case '2': $layout_columns_class = '6'; break;
		case '3': $layout_columns_class = '4'; break;
		case '4': $layout_columns_class = '3'; break;
	}

	// Styling
	$woo_categories_uniqid = uniqid( 'norebro-custom-' );
	
	$layout_class = $alignment_class = '';
	if ( $layout == 'boxed' ) {
		$layout_class .= ' style-2';
	}
	switch ($alignment) {
		case 'left': $alignment_class .= ' text-left'; break;
		case 'center': $alignment_class .= ' text-center'; break;
		case 'right': $alignment_class .= ' text-right'; break;
		default: $alignment_class .= ' text-left'; break;
	}

	$title_css = NorExtraParser::VC_typo_to_CSS( $title_typo );
	$title_css .= NorExtraParser::VC_color_to_CSS( $title_color, 'color:{{color}};' );
	$description_css = NorExtraParser::VC_typo_to_CSS( $description_typo );
	$description_css .= NorExtraParser::VC_color_to_CSS( $description_color, 'color:{{color}};' );

	$overlay_css = ( $overlay_color ) ? NorExtraParser::VC_color_to_CSS( $overlay_color, 'background-color:{{color}};' ) : '';
	$button = preg_replace( '/\&amp\;/', '&', $button );
	parse_str( $button, $button );
	$button_settings = NorExtraParser::VC_button_to_css( $button );
	$button_css = NorExtraParser::VC_typo_to_CSS( $button_typo );
	$button_css .= $button_settings['css'];
	$button_css_hover = $button_settings['hover-css'];
	$button_class = isset( $button_settings['classes'] ) ? ' ' . $button_settings['classes'] : '';

	// Assembling
	include( plugin_dir_path( __FILE__ ) . 'woo_categories__style.php' );
	ob_start();
	include( plugin_dir_path( __FILE__ ) . 'woo_categories__view.php' );
	return ob_get_clean();
}