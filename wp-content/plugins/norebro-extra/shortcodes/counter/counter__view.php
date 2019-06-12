<?php

/**
* Visual Composer Norebro Counter shortcode view
*/

?>
<div class="norebro-counter-box-sc counter-box<?php echo $css_class; ?>" 
	id="<?php echo esc_attr( $counter_box_uniqid ); ?>"
	<?php if ( $appearance_effect != 'none' ) { echo ' data-aos="' . $appearance_effect . '"'; } ?> 
	<?php if ( $appearance_duration ) { echo ' data-aos-duration="' . $appearance_duration . '"'; } ?>>

	<?php if ( $layout == "number_with_icon" && $icon_position == 'top' ): ?>
		<?php if ( $icon_as_icon ) : ?>
			<span class="counter-box-icon inline <?php echo $icon_as_icon; ?>"></span>
		<?php elseif ( $icon_as_image ) : ?>
			<img src="<?php echo $icon_as_image; ?>" alt="<?php if ( $title ) { echo esc_attr( $title ); } ?>">
		<?php endif; ?>
	<?php endif; ?>

	<div class="counter-box-count" data-counter="<?php echo $count_number; ?>">
		<?php if ( $layout == "number_with_icon" && $icon_position == 'left' ): ?>
			<?php if ( $icon_as_icon ) : ?>
				<span class="counter-box-icon <?php echo $icon_as_icon; ?>"></span>
			<?php elseif ( $icon_as_image ) : ?>
				<img src="<?php echo $icon_as_image; ?>" alt="<?php if ( $title ) { echo esc_attr( $title ); } ?>">
			<?php endif; ?>
		<?php endif; ?>
		<span class="count">0</span>
		<?php if ( $layout == "number_with_icon" && $icon_position == 'right' ): ?>
			<?php if ( $icon_as_icon ) : ?>
				<span class="counter-box-icon inline <?php echo $icon_as_icon; ?>"></span>
			<?php elseif ( $icon_as_image ) : ?>
				<img src="<?php echo $icon_as_image; ?>" alt="<?php if ( $title ) { echo esc_attr( $title ); } ?>">
			<?php endif; ?>
		<?php endif; ?>
	</div>

	<?php if ( $subtitle && $subtitle_position == 'top' ): ?>
		<p class="subtitle"><?php echo $subtitle; ?></p>
	<?php endif; ?>
	<?php if ( $title ): ?>
		<h3 class="title"><?php echo $title; ?></h3>
	<?php endif; ?>
	<?php if ( $subtitle && $subtitle_position == 'bottom' ): ?>
		<p class="subtitle"><?php echo $subtitle; ?></p>
	<?php endif; ?>

</div>