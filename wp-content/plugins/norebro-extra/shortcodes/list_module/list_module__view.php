<?php

/**
* Visual Composer Norebro List Module shortcode view
*/

?>
<ul class="norebro-list-box-sc list-box <?php echo $list_box_class . $css_class; ?>" 
	id="<?php echo esc_attr( $list_box_uniqid ); ?>"
	<?php if ( $appearance_effect != 'none' ) { echo ' data-aos="' . $appearance_effect . '"'; } ?> 
	<?php if ( $appearance_duration ) { echo ' data-aos-duration="' . intval( $appearance_duration ) . '"'; } ?>>
	
	<?php if ( ( $list_style == 'default' || $list_style == 'line' ) && $list_value_type1 ) : ?>
		
		<?php foreach ( $list_value_type1 as $list_object ) : ?>
		<li>
			<?php if ( $list_object->list_title ) : ?>
				<h4 class="title"><?php echo $list_object->list_title; ?></h4>
			<?php endif; ?>
		</li>
		<?php endforeach; ?>

	<?php elseif ( ( $list_style == 'icon' || $list_style == 'shape_icon' ) && $list_value_type2 ) : ?>
		
		<?php foreach ( $list_value_type2 as $list_object ) : ?>
		<li>
			<div class="wrap">
				<div class="col col-icon">
					<?php if ( $list_object->list_image ) : ?>
						<img src="<?php echo esc_url( $list_object->list_image ); ?>" alt="">
					<?php elseif ( $list_object->list_icon ) : ?>
						<span class="icon <?php echo $list_object->list_icon; ?>"></span>
						<?php $icons_collection[] = $list_object->list_icon; ?>
					<?php endif; ?>
				</div>
				<div class="col col-title">
					<?php if ( $list_object->list_title ) : ?>
						<h4 class="title"><?php echo $list_object->list_title; ?></h4>
					<?php endif; ?>
				</div>
			</div>
		</li>
		<?php endforeach; ?>

	<?php endif; ?>

</ul>