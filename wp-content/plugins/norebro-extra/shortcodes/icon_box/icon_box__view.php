<?php

/**
* Visual Composer Norebro Icon Box shortcode view
*/

?>
<div class="norebro-icon-box-sc <?php echo $icon_box_class_main . $css_class; ?>" 
	id="<?php echo esc_attr( $icon_box_uniqid ); ?>" 
	<?php if ( $appearance_effect != 'none' ) { echo ' data-aos="' . esc_attr( $appearance_effect ) . '"'; } ?> 
	<?php if ( $appearance_duration ) { echo ' data-aos-duration="' . esc_attr( $appearance_duration ) . '"'; } ?>>

	<div class="icon-wrap<?php echo $icon_box_class_icon; ?>">
		<?php if ( $icon_type == 'font_icon' && $icon_as_icon ) : ?>
			<span class="<?php echo $icon_as_icon; ?>"></span>
		<?php elseif ( $icon_as_image ) : ?>
			<img src="<?php echo esc_url( $icon_as_image ); ?>" alt="<?php echo esc_attr( $title ); ?>">
		<?php endif; ?>
	</div>

	<div class="content-wrap">

		<div class="content-center<?php if ( $content_full == 'full' ) { echo ' with-full'; } ?>">
			<div class="wrap">
				<h3><?php echo $title; ?></h3>
				<?php if ( $subtitle ) : ?>
					<p class="subtitle">
						<?php echo $subtitle; ?>
					</p>
				<?php endif; ?>
			</div>
		</div>
		
		<?php if ( $content_full == 'full' ) : ?>
	</div>
		<?php endif; ?>

		<p class="description<?php echo $description_settings_class; ?>">
			<?php echo $description; ?>
		</p>

		<?php if ( $use_link ) : ?>
			<a class="btn<?php echo $button_css['classes']; ?>" href="<?php echo esc_url( $link_url['url'] ); ?>"
			<?php if ( $link_url['blank'] ) { echo ' target="_blank"'; } ?>>
				<?php echo $link_url['caption']; ?>
				<?php if( $button_settings['type'] == 'arrow_link' ) : ?>
					<span class="icon-arrow ion-ios-arrow-thin-right"></span>
				<?php endif; ?>
			</a>
		<?php endif; ?>

	<?php if ( $content_full != 'full' ) : ?>
	</div>
	<?php endif; ?>
	
</div>