<?php

/**
* Visual Composer Norebro Recent Posts shortcode view
*/

?>
<div class="norebro-recent-posts-sc vc_row blog-posts-masonry" 
	id="<?php echo esc_attr( $recent_posts_uniqid ); ?>"
	<?php if ( $appearance_effect != 'none' ) { echo ' data-aos="' . esc_attr( $appearance_effect ) . '"'; } ?> 
	<?php if ( $appearance_duration ) { echo ' data-aos-duration="' . esc_attr( $appearance_duration ) . '"'; } ?>>

	<?php

		$pagination_page = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;
		$items_per_page = intval( $pagination_items_per_page );
		
		// Calculate pagination
		$_post_start = 0;
		$_post_end = count( $posts_data );

		if ( $use_pagination ) {
			$_post_start = $pagination_page * $items_per_page - $items_per_page;

			if ( $_post_end > $_post_start + $items_per_page ) {
				$_post_end = $_post_start + $items_per_page;
			}
		}

		echo '<div class="norebro-masonry" data-lazy-container="true">';

		for ( $_post_i = $_post_start; $_post_i < $_post_end; $_post_i++ ) {
			$_post_object = $posts_data[ $_post_i ];

            setup_postdata($_post_object);
            global $post;
            $post = $_post_object;

			$norebro_post = NorExtraParser::post_object( $_post_object, 'recent_posts', $_post_i + 1 );
			$norebro_post['boxed'] = $card_boxed;
			$norebro_post['grid_card_striped'] = $card_striped;
			$norebro_post['grid_card_indented'] = $card_indented;
			
			NorebroHelper::set_storage_item_data( $norebro_post );
			$col_class = $column_class;
			if ( $norebro_post['grid_style'] == '2col' ) {
				$col_class = $column_double_class;
			}
			// Animation calculating
			$_anim_attrs = '';
			if ( in_array( $animation_type, array( 'sync', 'async' ) ) ) {
				$_anim_attrs .= ' data-aos-once="true"';
				$_anim_attrs .= ' data-aos="' . $animation_effect . '"';
				if ( $animation_type == 'async' ) {
					$_columns_in_row = (int) substr( $columns_in_row, 0, 1);
					$_delay = ( 400 / $_columns_in_row ) * ( $_post_i % $_columns_in_row );
					$_delay = (int) $_delay - ( $_delay % 50 );
					$_anim_attrs .= ' data-aos-delay="' . $_delay . '"';
				}
			}
			echo '<div class="' . $col_class . ' blog-post-masonry masonry-block post-offset norebro-card-wrapper' . (( $norebro_post['grid_style'] != '2col' ) ? ' grid-item' : '') . ' data-lazy-item="true">';

			if ( $_anim_attrs ) {
				echo '<div ' . $_anim_attrs . '>';
			}

			switch ( $card_layout ) {
				case 'side_image':
					include( locate_template( 'parts/blog-cards/side_image.php' ) );
					break;
				case 'overlay':
					include( locate_template( 'parts/blog-cards/overlay.php' ) );
					break;
				case 'simple':
					include( locate_template( 'parts/blog-cards/simple.php' ) );
					break;
				case 'striped':
					include( locate_template( 'parts/blog-cards/striped.php' ) );
					break;
				case 'classic':
				default:
					include( locate_template( 'parts/blog-cards/classic.php' ) );
					break;
			}

			if ( $_anim_attrs ) {
				echo '</div>';
			}

			echo '<div class="clear"></div>';
			echo '</div>';
		}

		echo '</div>';


		if ( $use_pagination ) {

			$pages_count = ceil( count( $posts_data ) / $items_per_page );

			if ( $pagination_type == 'simple' ) {

				NorebroLayout::the_paginator_layout( $pagination_page, $pages_count );

			} else if ( $pagination_type == 'lazy_scroll' ) {

				echo '<div class="lazy-load loading font-titles" data-lazy-load="scroll" data-lazy-pages-count="' . esc_attr( $pages_count ) . '">';
				echo '<span class="loading-text">' . esc_html__( 'Loading', 'norebro-extra' ) . '</span>';
				echo '<span class="icon ion-refresh"></span>';
				echo '</div>';

			}  else if ( $pagination_type == 'lazy_button' ) {

				echo '<div class="lazy-load load-more font-titles" data-lazy-load="click" data-lazy-pages-count="' . esc_attr( $pages_count ) . '">';
				echo '<span class="loadmore-text">' . esc_html__( 'Load More', 'norebro-extra' ) . '</span>';
				echo '<span class="loading-text">' . esc_html__( 'Loading', 'norebro-extra' ) . '</span>';
				echo '<span class="icon ion-refresh"></span>';
				echo '</div>';

			} 

		}

    wp_reset_postdata();
	?>
	
</div>