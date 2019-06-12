<?php

/**
* Visual Composer Norebro Gallery shortcode view
*/

?>
<div class="norebro-gallery-sc <?php echo $gallery_class . $css_class; ?>"
	id="<?php echo esc_attr( $images_uniqid ); ?>"
	data-gallery="<?php echo esc_attr( $gallery_uniqid ); ?>"
	<?php if ( $appearance_effect != 'none' ) { echo ' data-aos="' . $appearance_effect . '"'; } ?>
	<?php if ( $appearance_duration ) { echo ' data-aos-duration="' . intval( $appearance_duration ) . '"'; } ?>>

	<?php

		$pagination_page = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;
		$items_per_page = intval( $pagination_items_per_page );

		$_image_start = 0;
		$_image_end = count( $gallery );

		if ( $use_pagination ) {
			$_image_start = $pagination_page * $items_per_page - $items_per_page;
			$_image_end = count( $gallery );

			if ( $_image_end > $_image_start + $items_per_page ) {
				$_image_end = $_image_start + $items_per_page;
			}
		}
	?>

	<div class="vc_row<?php if ( $masonry_grid ) { echo ' norebro-masonry'; } ?>" data-lazy-container="true">

	<?php for ( $_image_i = $_image_start; $_image_i < $_image_end; $_image_i++ ) : ?>
	<?php $image = $gallery[ $_image_i ]; ?>
	<div class="<?php echo $column_class; ?> masonry-block grid-item gallery-image" data-gallery-item="<?php echo $_image_i; ?>" data-lazy-item="true">
		<div class="wrap">
			<?php if ( $metro_style ) : ?>
			<div class="tmp-image" data-norebro-bg-image="<?php echo $image['full']; ?>"></div>
			<?php endif; ?>
			<img class="gimg" src="<?php echo $image['url']; ?>" alt="<?php echo $image['alt']; ?>">
			<div class="overlay<?php echo $overlay_class; ?>">
				<div class="content-center text-center">
					<div class="wrap">
						<h4 class="inline">
						<?php if ( $show_title ) : ?>
							<?php echo $image['title']; ?>
						<?php else: ?>
							<?php esc_html_e( 'View Fullscreen', 'norebro-extra' ); ?>
						<?php endif; ?>
						</h4>
						<div class="icon inline ion-ios-plus-empty"></div>
					</div>
				</div>
			</div>
			<div class="gallery-description">
				<h3 class="title"><?php echo $image['title']; ?></h3>
				<p class="subtitle small">
					<?php echo $image['caption']; ?>
				</p>
			</div>
		</div>
	</div>
	<?php endfor; ?>
	<div class="clear"></div>

	</div>

	<?php

		if ( $use_pagination ) {

			$pages_count = ceil( count( $gallery ) / $items_per_page );

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

	?>

</div>

<div class="norebro-gallery-opened-sc custom-gallery<?php echo $css_class; ?>"
	id="<?php echo esc_attr( $gallery_uniqid ); ?>"
	data-options='<?php echo $gallery_json; ?>'>

	<div class="expand">
		<span class="ion-android-expand"></span>
	</div>
	<div class="close">
		<span class="ion-ios-close-empty"></span>
	</div>

</div>
