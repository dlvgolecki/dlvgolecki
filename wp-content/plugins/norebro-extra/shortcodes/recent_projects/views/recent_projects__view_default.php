<div data-norebro-portfolio-grid="true"
	id="<?php echo $recent_projects_uniqid; ?>"
	class="norebro-recent-projects-sc"
	<?php if ( $appearance_effect != 'none' ) { echo ' data-aos="' . $appearance_effect . '"'; } ?>
	<?php if ( $appearance_duration ) { echo ' data-aos-duration="' . intval( $appearance_duration ) . '"'; } ?>>

	<?php if ( $show_projects_filter ) : ?>
		<?php
			if ( is_array( $projects_category ) ) {
				$cat_ids = get_terms( array( 'taxonomy' => 'norebro_portfolio_category', 'include' => $projects_category ) );
			} else {
				$cat_ids = get_terms( array( 'taxonomy' => 'norebro_portfolio_category' ) );
			}
			if ( is_array( $cat_ids ) && $cat_ids ) :
		?>
		<div class="portfolio-sorting<?php echo $filter_align_class; ?>" data-filter="portfolio">
			<ul class="unstyled">
				<li>
					<a class="active" href="#all" data-isotope-filter="*">
						<span class="name"><?php esc_html_e( 'All', 'norebro-extra' ); ?></span>
						<span class="num"></span>
					</a>
				</li>
				<?php foreach ( $cat_ids as $cat_obj ) : ?>
					<li>
						<a href="#<?php echo $cat_obj->slug; ?>" data-isotope-filter=".norebro-filter-project-<?php echo hash( 'md4', $cat_obj->slug, false ); ?>">
							<span class="name"><?php echo $cat_obj->name; ?></span>
							<span class="num"></span>
						</a>
					</li>
				<?php endforeach; ?>
			</ul>
		</div>
		<?php endif; ?>
	<?php endif; ?>

	<?php
		$items_per_page = intval( $pagination_items_per_page );
	?>

	<div class="vc_row <?php echo $css_class; ?>" data-isotope-grid="true" data-lazy-container="true">

		<?php
			$_post_start = 0;
			$_post_end = count( $projects_data );
		?>

		<?php for ( $_post_i = $_post_start; $_post_i < $_post_end; $_post_i++ ) : ?>
		<?php
			$_project_object = $projects_data[$_post_i];
            $_project_object->image_size = $portfolio_images_size;
			$norebro_project = NorExtraParser::project_object( $_project_object );
			$norebro_project['in_popup'] = $open_in_popup;
			$norebro_project['popup_autoplay'] = $popup_autoplay;
			$norebro_project['popup_mouse_scrolling'] = $popup_mouse_scrolling;
			$norebro_project['popup_navigation'] = $popup_show_nav_buttons;
			$norebro_project['popup_autoplay_time'] = $popup_autoplay_time;
			$norebro_project['hide_view_link_in_popup'] = $hide_view_link_in_popup;
			$norebro_project['metro_style'] = $metro_style;
			NorebroHelper::set_storage_item_data( $norebro_project );



			$col_class = $column_class;
			if ( $norebro_project['grid_style'] == '2col' ) {
				$col_class = $column_double_class;
			}

			// Animation calculating
			$_anim_attrs = '';
			if ( in_array( $animation_type, array( 'sync', 'async' ) ) ) {
				$_anim_attrs .= ' data-aos-once="true"';
				$_anim_attrs .= ' data-aos="' . $animation_effect . '"';
				if ( $animation_type == 'async' ) {
					$_columns_in_row = (int) substr( $columns_in_row, 0, 1 );
					if ( $columns_in_row <= 0 ) { $columns_in_row = 1; }
					$_delay = ( 400 / $_columns_in_row ) * ( $_post_i % $_columns_in_row );
					$_delay = (int) $_delay - ( $_delay % 50 );
					$_anim_attrs .= ' data-aos-delay="' . $_delay . '"';
				}
			}

			echo '<div class="portfolio-item-wrap masonry-block' . (( $norebro_project['grid_style'] != '2col' ) ? ' grid-item' : '') . $col_class . ( ( $projects_solid ) ? ' post-offset' : '' ) . ' norebro-project-item ' . $norebro_project['categories_group'] . '" data-lazy-item="true">';

			if ( $_anim_attrs ) {
				echo '<div' . $_anim_attrs . '>';
			}

			switch ( $card_layout ) {
				case 'grid_1_hover_1':
					include( locate_template( 'parts/portfolio-cards/grid_1_hover_1.php' ) );
					break;
				case 'grid_1_hover_2':
					include( locate_template( 'parts/portfolio-cards/grid_1_hover_2.php' ) );
					break;
				case 'grid_1_hover_3':
					include( locate_template( 'parts/portfolio-cards/grid_1_hover_3.php' ) );
					break;
				case 'grid_2_hover_1':
					include( locate_template( 'parts/portfolio-cards/grid_2_hover_1.php' ) );
					break;
				case 'grid_2_hover_2':
					include( locate_template( 'parts/portfolio-cards/grid_2_hover_2.php' ) );
					break;
				case 'grid_2_hover_3':
					include( locate_template( 'parts/portfolio-cards/grid_2_hover_3.php' ) );
					break;
				default:
					include( locate_template( 'parts/portfolio-cards/grid_1_hover_1.php' ) );
					break;
			}

			if ( $open_in_popup ) {
				ob_start();
				NorebroHelper::set_storage_item_data( $norebro_project );
				include( locate_template( 'parts/portfolio-cards/_popup.php' ) );
				NorebroLayout::append_to_footer_buffer_content( ob_get_clean() );
			}

			if ( $_anim_attrs ) {
				echo '</div>';
			}

		?>
			<div class="clear"></div>
		</div>
	<?php endfor; ?>
	</div>

	<?php
		if ( $use_pagination ) {

			if ( $pagination_type == 'simple' ) {

				NorebroLayout::the_paginator_layout( $paged, $query->max_num_pages );

			} else if ( $pagination_type == 'lazy_scroll' ) {

				echo '<div class="lazy-load loading font-titles" data-lazy-load="scroll" data-lazy-pages-count="' . esc_attr( $query->max_num_pages ) . '">';
				echo '<span class="loading-text">' . esc_html__( 'Loading', 'norebro-extra' ) . '</span>';
				echo '<span class="icon ion-refresh"></span>';
				echo '</div>';

			}  else if ( $pagination_type == 'lazy_button' ) {

				echo '<div class="lazy-load load-more font-titles" data-lazy-load="click" data-lazy-pages-count="' . esc_attr( $query->max_num_pages ) . '">';
				echo '<span class="loadmore-text">' . esc_html__( 'Load More', 'norebro-extra' ) . '</span>';
				echo '<span class="loading-text">' . esc_html__( 'Loading', 'norebro-extra' ) . '</span>';
				echo '<span class="icon ion-refresh"></span>';
				echo '</div>';

			}

		}

	?>

</div>
