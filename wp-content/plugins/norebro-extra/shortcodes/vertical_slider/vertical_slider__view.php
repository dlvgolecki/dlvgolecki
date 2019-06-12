<?php

/**
* Visual Composer Norebro Vertical Fullscreen Slider shortcode view
*/

?>
<div class="norebro-vertical-slider-sc norebro-onepage disable-on-mobile <?php echo $css_class; ?>" 
	id="<?php echo esc_attr( $split_pages_uniqid ); ?>"
	data-options='<?php echo $onepage_json; ?>' 
	data-norebro-onepage="true">

	<div class="onepage-stage">
		<?php echo do_shortcode( $content ); ?>
	</div>

</div>