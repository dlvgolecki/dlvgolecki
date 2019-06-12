<?php

/**
* Visual Composer Norebro Split Screens shortcode view
*/

?>
<div class="norebro-split-screen-sc norebro-splitscreen<?php echo $css_class; ?>"
	id="<?php echo $split_screens_uniqid; ?>" 
	data-norebro-splitscreen="true" 
	data-options='<?php echo $multiscroll_json; ?>' 
	<?php if ( $navigation_buttons ) { echo ' data-arg-splitscreen-nav="true"'; } ?>>

	<?php echo do_shortcode( $content ); ?>

</div>