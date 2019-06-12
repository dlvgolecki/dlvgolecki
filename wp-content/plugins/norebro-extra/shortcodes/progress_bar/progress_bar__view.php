<?php

/**
* Visual Composer Norebro Progress Bar shortcode view
*/

?>
<div class="norebro-progress-bar-sc progress-bar <?php echo $progress_bar_class; ?><?php echo $css_class; ?>"
	id="<?php echo esc_attr( $progress_bar_uniqid ); ?>"
	data-norebro-progress-bar="<?php echo esc_attr( $percent ); ?>"
	<?php if ( $appearance_effect != 'none' ) { echo ' data-aos="' . $appearance_effect . '"'; } ?> 
	<?php if ( $appearance_duration ) { echo ' data-aos-duration="' . intval( $appearance_duration ) . '"'; } ?>>
	
	<h4>
		<span class="left"><?php echo $name; ?></span>
		<?php if ( !$percent_in_tooltip ) : ?>
			<span class="right"><span class="percent">0</span>%</span>
		<?php endif; ?>
	</h4>
	<div class="clear"></div>

	<div class="line-wrap"<?php if ( $percent_in_tooltip ) { echo ' data-tooltip="true"'; } ?>>
		<?php if ( $layout != 'split' ) : ?>
			<div class="line brand-bg-color">
				<?php if ( $percent_in_tooltip ) : ?>
					<h4 class="line-percent">
						<span class="percent">0</span>%
					</h4>
				<?php endif; ?>
			</div>
		<?php endif; ?>
	</div>

</div>