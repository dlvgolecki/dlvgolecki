<?php

/**
* Visual Composer Norebro Tabs shortcode view
*/

?>
<div class="norebro-tabs-sc tab-box <?php echo $tab_box_class . $css_class; ?>"
	id="<?php echo esc_attr( $tabs_uniqid ); ?>" 
	data-norebro-tab-box="true" 
	data-options='<?php echo $tab_box_json; ?>' 
	<?php if ( $appearance_effect != 'none' ) { echo ' data-aos="' . esc_attr( $appearance_effect ) . '"'; } ?> 
	<?php if ( $appearance_duration ) { echo ' data-aos-duration="' . esc_attr( $appearance_duration ) . '"'; } ?>>
	
	<div class="buttons-wrap">
		<div class="buttons" role="tablist">
			<?php /* Generated tabs here */ ?>
			<div class="line brand-bg-color"></div>
		</div>
	</div>
	<div class="items" role="tabpanel">
		<?php echo do_shortcode( $content ); ?>
	</div>
	<div class="clear"></div>

</div>