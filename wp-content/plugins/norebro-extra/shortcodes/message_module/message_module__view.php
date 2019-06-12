<?php

/**
* Visual Composer Norebro Message Module shortcode view
*/

?>
<?php if ( ! $full_width ) : ?><div class="text-center"><?php endif; ?>

<div class="norebro-message-module-sc message-box <?php echo $message_box_class . $css_class; ?>"
	id="<?php echo esc_attr( $message_box_uniqid ); ?>" 
	<?php if ( $appearance_effect != 'none' ) { echo ' data-aos="' . esc_attr( $appearance_effect ) . '"'; } ?> 
	<?php if ( $appearance_duration ) { echo ' data-aos-duration="' . esc_attr( $appearance_duration ) . '"'; } ?>>
	
	<?php echo $text; ?>

	<?php if ( $link ): ?>
		<a href="<?php echo esc_url( $link['url'] ); ?>"	<?php if ( $link['blank'] ) echo ' target="_blank"'; ?>>
			<?php echo $link['caption']; ?>
		</a>
	<?php endif; ?>

	<?php if ( ! $without_close_button ) : ?>
		<div class="close">
			<span class="ion-ios-close-empty"></span>
		</div>
	<?php endif; ?>

</div>

<?php if ( ! $full_width ) : ?></div><?php endif; ?>