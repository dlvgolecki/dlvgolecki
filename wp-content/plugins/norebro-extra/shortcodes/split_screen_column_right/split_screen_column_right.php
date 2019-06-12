<?php 

/**
* Visual Composer Norebro Split Screen Right Column shortcode
*/

add_shortcode( 'norebro_split_screen_column_right', 'norebro_split_screen_column_right_func' );

function norebro_split_screen_column_right_func( $atts, $content = '' ) {
	// Assembling
	ob_start();
	include( plugin_dir_path( __FILE__ ) . 'split_screen_column_right__view.php' );
	return ob_get_clean();
}