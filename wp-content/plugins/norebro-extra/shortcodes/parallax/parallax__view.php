<?php

/**
* Visual Composer Norebro Parallax shortcode view
*/

?>
<div class="norebro-parallax-sc parallax<?php if ( $css_class ) { echo $css_class; } ?>"
id="<?php echo esc_attr( $parallax_uniqid ); ?>"
data-parallax-bg="<?php echo esc_attr( $parallax ); ?>" 
data-parallax-speed="<?php echo esc_attr( $parallax_speed ); ?>">
	
	<div class="parallax-bg"></div>
	<div class="parallax-content">
		<?php echo do_shortcode( $content ); ?>
	</div>

</div>