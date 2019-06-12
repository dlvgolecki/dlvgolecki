<?php

/**
* Visual Composer Norebro Banner shortcode view
*/

?>
<div class="norebro-banner-box-sc <?php echo $banner_box_class . $css_class; ?>"
	id="<?php echo esc_attr( $banner_box_uniqid ); ?>"
	<?php if ( $appearance_effect != 'none' ) { echo ' data-aos="' . $appearance_effect . '"'; } ?>
	<?php if ( $appearance_duration ) { echo ' data-aos-duration="' . intval( $appearance_duration ) . '"'; } ?>>

	<?php if ( $block_type_layout == 'inner' || $block_type_layout == 'inner_hover' ) : ?>
		<div class="image-wrap">
			<img src="<?php echo esc_attr( $background_image ); ?>" alt="<?php echo NorExtraFilter::string( $title, 'attr', '' ); ?>">
			<div class="overlay"<?php echo !empty($overlay_color) ? ' style="background:'.$overlay_color.'"' : '' ?>>
				<div class="content">
					<h4><?php echo $title; ?></h4>
					<?php if ( $subtitle ) : ?>
						<p class="subtitle<?php if ( $block_type_subtitle == 'before' ) { echo ' top'; } ?>">
							<?php echo $subtitle; ?>
						</p>
					<?php endif; ?>
					<p class="description"><?php echo $description; ?></p>
				</div>
				<?php if ( $use_link ) : ?>
				<a class="btn btn-white<?php echo $button_css['classes']; ?>" href="<?php echo $link_url['url']; ?>"<?php if ( $link_url['blank'] ) { echo ' target="_blank"'; } ?>>
					<?php echo $link_url['caption']; ?>
					<?php if( $button_settings['type'] == 'arrow_link' ) : ?>
						<span class="icon-arrow ion-ios-arrow-thin-right"></span>
					<?php endif; ?>
				</a>
				<?php endif; ?>
			</div>
		</div>
	<?php else : ?>
		<div class="image-wrap">
			<img src="<?php echo $background_image; ?>" alt="<?php echo NorExtraFilter::string( $title, 'attr', '' ); ?>">
			<div class="overlay default">
				<?php if ( $use_link && $block_type_layout != 'overlay_title' && $block_type_layout != 'hover_title' ) : ?>
				<a class="btn btn-white<?php echo $button_css['classes']; ?>" href="<?php echo $link_url['url']; ?>"<?php if ( $link_url['blank'] ) { echo ' target="_blank"'; } ?>>
					<?php echo $link_url['caption']; ?>
					<?php if( $button_settings['type'] == 'arrow_link' ) : ?>
						<span class="icon-arrow ion-ios-arrow-thin-right"></span>
					<?php endif; ?>
				</a>
				<?php endif; ?>
			</div>
		</div>
		<div class="content">

			<div class="title-wrap">
				<h4><?php echo $title; ?></h4>
				<?php if ( $subtitle ) : ?>
				<p class="subtitle<?php if ( $block_type_subtitle == 'before' ) { echo ' top'; } ?>"><?php echo $subtitle; ?></p>
				<?php endif; ?>
			</div>

			<div class="description-wrap">
				<p class="description"><?php echo $description; ?></p>

				<?php if ( $use_link && ( $block_type_layout == 'overlay_title' || $block_type_layout == 'hover_title' ) ) : ?>
				<a class="btn<?php echo $button_css['classes']; ?>" href="<?php echo $link_url['url']; ?>"<?php if ( $link_url['blank'] ) { echo ' target="_blank"'; } ?>>
					<?php echo $link_url['caption']; ?>
					<?php if( $button_settings['type'] == 'arrow_link' ) : ?>
						<span class="icon-arrow ion-ios-arrow-thin-right"></span>
					<?php endif; ?>
				</a>
				<?php endif; ?>
			</div>

		</div>
	<?php endif; ?>

</div>
