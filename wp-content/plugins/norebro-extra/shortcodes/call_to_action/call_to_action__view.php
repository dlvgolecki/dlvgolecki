<?php

/**
* Visual Composer Norebro Call To Action shortcode view
*/

?>
<div class="norebro-cta-sc call-to-action<?php echo $css_class; ?>"
	id="<?php echo esc_attr( $call_to_action_uniqid ); ?>"
	<?php if ( $appearance_effect != 'none' ) { echo ' data-aos="' . esc_attr( $appearance_effect ) . '"'; } ?> 
	<?php if ( $appearance_duration ) { echo ' data-aos-duration="' . esc_attr( $appearance_duration ) . '"'; } ?>>

	<div class="content-center">
		<div class="wrap">
			<h3 class="title">
				<?php echo $title; ?>
			</h3>
			<?php if ( $subtitle ) : ?>
				<p class="subtitle">
					<?php echo $subtitle; ?>
				</p>
			<?php endif; ?>
		</div>

		<div class="wrap">
			<a href="<?php echo esc_url( $link['url'] ); ?>"<?php if ( $link['blank'] ) echo ' target="_blank"'; ?> 
			class="btn btn-white<?php echo $button_css['classes'] . $css_class; ?>">
				<?php if ( $icon_use && $icon_as_icon && $icon_position == 'left' ): ?>
					<span class="icon <?php echo $icon_as_icon; ?>"></span>
				<?php endif; ?>
				
				<span class="text"><?php echo $link['caption']; ?></span>
				
				<?php if ( $icon_use && $icon_as_icon && $icon_position == 'right' ): ?>
					<span class="icon <?php echo $icon_as_icon; ?>"></span>
				<?php endif; ?>
			</a>
		</div>
	</div>

</div>