<?php

/**
* Visual Composer Norebro Carousel shortcode view
*/

?>
<div class="norebro-slider-sc slider-wrap">
	<div class="slider norebro-slider <?php echo $slider_class . $css_class; ?>" 
	id="<?php echo esc_attr( $slider_uniqid ); ?>" 
	data-norebro-slider='<?php echo $slider_json; ?>' 
	<?php if ( $appearance_effect != 'none' ) { echo ' data-aos="' . esc_attr( $appearance_effect ) . '"'; } ?>
	<?php if ( $appearance_duration ) { echo ' data-aos-duration="' . esc_attr( $appearance_duration ) . '"'; } ?>>

		<?php echo do_shortcode( $content ); ?>
		
	</div>
</div>