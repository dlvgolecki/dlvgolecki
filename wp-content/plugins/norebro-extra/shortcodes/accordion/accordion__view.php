<?php

/**
* Visual Composer Norebro Accordion shortcode view
*/

?>
<div class="norebro-accordion-sс accordion-box <?php echo $accordion_class; ?><?php echo $css_class; ?>" 
	id="<?php echo esc_attr( $accordion_uniqid ); ?>"
	data-norebro-accordion="0"
	<?php if ( $appearance_effect != 'none' ) { echo ' data-aos="' . $appearance_effect . '"'; } ?> 
	<?php if ( $appearance_duration ) { echo ' data-aos-duration="' . intval( $appearance_duration ) . '"'; } ?>>

	<?php echo do_shortcode( $content ); ?>
	
</div>