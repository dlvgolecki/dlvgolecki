<?php

/**
* Visual Composer Norebro Pie Chart shortcode view
*/

?>
<div class="norebro-chart-box-sc chart-box <?php echo $chart_class . $css_class; ?>"
	id="<?php echo esc_attr( $chart_box_uniqid ); ?>"
	<?php if ( $appearance_effect != 'none' ) { echo ' data-aos="' . esc_attr( $appearance_effect ) . '"'; } ?> 
	<?php if ( $appearance_duration ) { echo ' data-aos-duration="' . intval( $appearance_duration ) . '"'; } ?>>
	
	<div class="pie" data-chart-box="true" data-percent="<?php echo esc_attr( $percent ); ?>"<?php if ( $chart_color ) echo ' data-color="' . $chart_color . '"'; ?>>
		<div class="pie-content<?php echo $chart_content_settings_class; ?>">
			<?php if ( $layout == "icon" && $icon_as_icon ): ?>
				<span class="icon icon-large <?php echo esc_attr( $icon_as_icon ); ?>"></span>
			<?php else: ?>
				<span class="percent-wrap">
					<h4><span class="percent">0</span>%</h4>
				</span>
			<?php endif; ?>
		</div>
	</div>

	<div class="content">
		<div class="wrap">
		
			<?php if ( $layout == "icon" && $icon_as_icon ): ?>
				<span class="percent-wrap">
					<h4><span class="percent">0</span>%</h4>
				</span>
			<?php endif; ?>

			<?php if ( $subtitle && $subtitle_position == "top" ): ?>
				<p class="subtitle">
					<?php echo $subtitle; ?>
				</p>
			<?php endif; ?>
			<?php if ( $title ): ?>
				<h3 class="title">
					<?php echo $title; ?>
				</h3>
			<?php endif; ?>
			<?php if ( $subtitle && $subtitle_position == "bottom" ): ?>
				<p class="subtitle">
					<?php echo $subtitle; ?>
				</p>
			<?php endif; ?>

		</div>
	</div>

</div>