<?php

/**
* Visual Composer Norebro Process shortcode view
*/

?>
<div class="norebro-process-sc process <?php echo $process_settings_class . $css_class; ?>"
	id="<?php echo esc_attr( $process_uniqid ); ?>"
	<?php if ( $appearance_effect != 'none' ) { echo ' data-aos="' . $appearance_effect . '"'; } ?> 
	<?php if ( $appearance_duration ) { echo ' data-aos-duration="' . intval( $appearance_duration ) . '"'; } ?>>
		
	<div class="number"><?php echo $number; ?></div>
	<h3><?php echo $title; ?></h3>
	<p class="description"><?php echo $description; ?></p>

</div>