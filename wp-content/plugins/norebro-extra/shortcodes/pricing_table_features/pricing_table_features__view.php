<?php

/**
* Visual Composer Norebro Pricing Table Features shortcode view
*/

?>
<div class="norebro-pricing-table-features-sc pricing-table features<?php echo $css_class; ?>"
	id="<?php echo esc_attr( $pricing_table_uniqid ); ?>"
	<?php if ( $appearance_effect != 'none' ) { echo ' data-aos="' . esc_attr( $appearance_effect ) . '"'; } ?> 
	<?php if ( $appearance_duration ) { echo ' data-aos-duration="' . esc_attr( $appearance_duration ) . '"'; } ?>>
	
	<h3 class="title"><?php echo $title; ?></h3>
	<ul class="list-box border simple text-left">
		<?php if ( $features_value ) : ?>
			<?php foreach ( $features_value as $feature_object ) : ?>
		<li>
			<?php if ( $feature_object->feature_title ) : ?>
			<span class="title"><?php echo $feature_object->feature_title; ?></span>
			<?php endif; ?>
		</li>
			<?php endforeach; ?>
		<?php endif; ?>
	</ul><!--.list-box-->

</div>