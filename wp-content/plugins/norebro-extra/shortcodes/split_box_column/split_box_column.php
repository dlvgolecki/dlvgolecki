<?php 

/**
* Visual Composer Norebro Split Box Column shortcode
*/

add_shortcode( 'norebro_split_box_column', 'norebro_split_box_column_func' );

function norebro_split_box_column_func( $atts, $content = '' ) {
	// Assembling
	ob_start();
	include( plugin_dir_path( __FILE__ ) . 'split_box_column__view.php' );
	return ob_get_clean();
}