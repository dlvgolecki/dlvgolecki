<?php

/**
* Visual Composer Norebro Accordion Inner shortcode view
*/

?>
<div id="<?php echo $accordion_inner_uniqid; ?>" class="item<?php echo $css_class; ?>">
	
	<div class="title">
		<?php if ( $with_icon && $icon_as_icon) : ?>
			<span class="icon <?php echo $icon_as_icon; ?>"></span>
		<?php endif; ?>
		<h4><?php echo $heading; ?></h4>
		<div class="control">
			<span class="ion-plus"></span>
		</div>
	</div>

	<div class="content">
		<div class="wrap">
			<?php echo do_shortcode( $content_html ); ?>
		</div>
	</div>

</div>