<?php

/**
 * Visual Composer Norebro Image shortcode view
 */

?>
<div class="norebro-image-sc <?php echo 'text-' . $alignment . ' ' . $css_class; ?>"
	id="<?php echo esc_attr( $image_uniqid ); ?>"
	<?php if ( $appearance_effect != 'none' ) { echo ' data-aos="' . esc_attr( $appearance_effect ) . '"'; } ?>
	<?php if ( $appearance_duration ) { echo ' data-aos-duration="' . esc_attr( $appearance_duration ) . '"'; } ?>>

    <img src="<?php echo esc_url( $image_url ); ?>" alt="<?php echo esc_attr( $title ); ?>" title="<?php echo esc_attr( $title ); ?>">

</div>