<?php

/**
* Visual Composer Norebro Clients logo shortcode view
*/

?>
<div class="norebro-client-logo-sc clients-logo text-center<?php echo $css_class; ?>"
	id="<?php echo esc_attr( $clients_logo_uniqid ); ?>"
	<?php if ( $appearance_effect != 'none' ) { echo ' data-aos="' . $appearance_effect . '"'; } ?>
	<?php if ( $appearance_duration ) { echo ' data-aos-duration="' . $appearance_duration . '"'; } ?>>

	<?php if ($link): ?>
		<a href="<?php echo $link ?>"<?php echo $in_new_tab ? ' target="_blank"' : '' ?>>
	<?php endif; ?>

		<?php if ( ! $layout_type || $layout_type == 'default' ) : ?>
			<div class="first-image">
				<img src="<?php echo $image_logo; ?>" alt="<?php echo esc_attr( $title ); ?>">
			</div>
			<div class="second-image">
				<img src="<?php echo $image_logo; ?>" alt="<?php echo esc_attr( $title ); ?>">
			</div>
		<?php endif; ?>

		<?php if ( $layout_type == 'overlay' ) : ?>
			<img src="<?php echo esc_url( $image_logo ); ?>" alt="<?php echo esc_attr( $title ); ?>">
			<div class="overlay">
				<h4 class="title"><?php echo $title; ?></h4>
				<img src="<?php echo esc_url( $image_logo ); ?>" alt="<?php echo esc_attr( $title ); ?>">
				<p class="description"><?php echo $description; ?></p>
			</div>
		<?php endif; ?>

	<?php if ($link): ?>
		</a>
	<?php endif; ?>

</div>
