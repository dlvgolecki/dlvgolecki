<?php

/**
* Visual Composer Norebro Testimonial shortcode view
*/

?>
<div class="norebro-testimonial-sc testimonials <?php echo $type_class . $css_class; ?>" 
	id="<?php echo esc_attr( $testimonial_uniqid ); ?>"
	<?php if ( $appearance_effect != 'none' ) { echo ' data-aos="' . esc_attr( $appearance_effect ) . '"'; } ?> 
	<?php if ( $appearance_duration ) { echo ' data-aos-duration="' . esc_attr( $appearance_duration ) . '"'; } ?>>
	
	<?php if ( $block_type_layout == 'photo_top' && $photo ) : ?>
		<div class="avatar">
			<img src="<?php echo esc_url( $photo ); ?>" alt="<?php echo esc_attr( $author ); ?>">
		</div>
	<?php endif; ?>

	<blockquote>
		<?php echo $quote; ?>
	</blockquote>

	<?php if ( ( $block_type_layout == 'photo_middle' ) && $photo ) : ?>
		<div class="avatar">
			<img src="<?php echo esc_url( $photo ); ?>" alt="<?php echo esc_attr( $author ); ?>">
		</div>
	<?php endif; ?>

	<h4 class="title">— <?php echo $author; ?></h4>
	<p class="subtitle small">
		<?php echo $position; ?>
	</p>

</div>