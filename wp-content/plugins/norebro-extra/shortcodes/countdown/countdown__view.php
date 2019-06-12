<?php

/**
* Visual Composer Norebro Countdown shortcode view
*/

$labels = '';
$labels .= esc_html__( 'Months', 'norebro-extra' ) . ',';
$labels .= esc_html__( 'Days', 'norebro-extra' ) . ',';
$labels .= esc_html__( 'Hours', 'norebro-extra' ) . ',';
$labels .= esc_html__( 'Minutes', 'norebro-extra' ) . ',';
$labels .= esc_html__( 'Seconds', 'norebro-extra' );

?>
<div class="norebro-countdown-box-sc countdown-box <?php echo $countdown_box_class . $css_class; ?>" 
	id="<?php echo esc_attr( $countdown_box_uniqid ); ?>" 
	data-countdown-labels="<?php echo $labels; ?>" 
	data-countdown-box="template_<?php echo esc_attr( $countdown_box_uniqid ); ?>" 
	data-countdown-time="<?php echo esc_attr( $countdown_date ); ?>"
	<?php if ( $appearance_effect != 'none' ) { echo ' data-aos="' . esc_attr( $appearance_effect ) . '"'; } ?> 
	<?php if ( $appearance_duration ) { echo ' data-aos-duration="' . intval( $appearance_duration ) . '"'; } ?>>

</div>

<?php if ( $layout == 'default' ): ?>
	
	<script type="text/template" id="template_<?php echo esc_attr( $countdown_box_uniqid ); ?>">
		<div class="box-time <%= label %>">
			<div class="title-lead box-count box-next">
				<span class="number"><%= next %></span>
			</div>
			<p class="box-label"><%= label %></p>
		</div>
	</script>

<?php else: ?>

	<script type="text/template" id="template_<?php echo esc_attr( $countdown_box_uniqid ); ?>">
		<div class="box-time <%= label %>">
			<div class="title-lead box-count">
				<div class="box-current box-top">
					<span class="number"><%= current %></span>
				</div>
				<div class="box-next box-top">
					<span class="number"><%= next %></span>
					</div>
				<div class="box-next box-bottom">
					<span class="number"><%= next %></span>
					</div>
				<div class="box-current box-bottom">
					<span class="number"><%= current %></span>
				</div>
			</div>
			<p class="box-label"><%= label %></p>
		</div>
	</script>

<?php endif; ?>