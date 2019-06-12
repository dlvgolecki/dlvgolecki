<?php 

/**
* Visual Composer Norebro Split Screen Left Column shortcode
*/

add_shortcode( 'norebro_split_screen_column_left', 'norebro_split_screen_column_left_func' );

function norebro_split_screen_column_left_func( $atts, $content = '' ) {
	// Assembling
	ob_start();
	include( plugin_dir_path( __FILE__ ) . 'split_screen_column_left__view.php' );
	return ob_get_clean();
}