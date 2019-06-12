<?php

/**
* Visual Composer Norebro Timeline Inner shortcode view
*/

?>
<div class="content<?php echo $css_class; ?>" id="<?php echo esc_attr( $timeline_uniqid ); ?>">
	<div class="wrap hidden" data-norebro-scroll-anim="hidden">
		
		<h3 class="title"><?php echo $title; ?></h3>
		
		<p class="subtitle"><?php echo $subtitle; ?></p>
		<p class="description"><?php echo $description; ?></p>
		
		<?php if ( $boxed ) : ?>
			<div class="triangle"></div>
		<?php endif; ?>

	</div>
</div>