<?php

/**
* Visual Composer Norebro Pricing Table shortcode view
*/

?>
<div class="norebro-pricing-table-sc pricing-table"
	id="<?php echo esc_attr( $pricing_table_uniqid ); ?>" 
	<?php if ( $appearance_effect != 'none' ) { echo ' data-aos="' . esc_attr( $appearance_effect ) . '"'; } ?> 
	<?php if ( $appearance_duration ) { echo ' data-aos-duration="' . esc_attr( $appearance_duration ) . '"'; } ?>>

	<?php if ( $title ) : ?>
		<h3 class="title"><?php echo $title; ?></h3>
	<?php endif; ?>
	
	<?php if ( $subtitle ) : ?>
		<p class="subtitle pricing-subtitle small"><?php echo $subtitle; ?></p>
	<?php endif; ?>

	<div class="price">
		<h2 class="title">
			<?php if ( $price_currency ) : ?>
				<span class="icon"><?php echo $price_currency; ?></span>
			<?php endif; ?>
			<?php echo $price; ?>
		</h2>

		<?php if ( $price_caption ) : ?>
			<br>
			<div class="time-interval uppercase"><?php echo $price_caption; ?></div>
		<?php endif;	?>

		<p class="subtitle"><?php echo $description; ?></p>
	</div><!--pricing-table-price-->

	<?php if ( $features_value ) : ?>
		<ul class="list-box border simple text-center">
		
			<?php foreach ( $features_value as $feature_object ) : ?>
				<li class="<?php echo ( ( $feature_object->feature_icon == 'icon_minus' ) ? ' disabled' : '' ); ?>">
					<?php if ( $feature_object->feature_icon ) : ?>
						<?php if ( $feature_object->feature_icon == 'icon_plus' ) : ?>
							<span class="icon ion-ios-checkmark-outline"></span>
						<?php elseif ( $feature_object->feature_icon == 'icon_minus' ) : ?>
							<span class="icon ion-ios-close-outline"></span>
						<?php endif; ?>
					<?php endif; ?>

					<?php if ( $feature_object->feature_title ) : ?>
						<span class="title"><?php echo $feature_object->feature_title; ?></span>
					<?php endif; ?>
				</li>
			<?php endforeach; ?>

		</ul><!--.list-box-->
	<?php endif; ?>

	<?php if ( $add_button ) : ?>
		<a href="<?php echo $button_link['url']; ?>" class="btn<?php echo $button_css['classes']; ?>"<?php if ( $button_link['blank'] ) { echo ' target="_blank"'; } ?>><?php echo $button_link['caption']; ?>
			<?php if ( $button_settings['type'] == 'arrow_link' ): ?>
				<span class="icon-arrow ion-ios-arrow-thin-right"></span>
			<?php endif; ?>
		</a>
	<?php endif; ?>
</div>