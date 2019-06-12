<?php 

	/**
	* Visual Composer Norebro Split Box Column Inner shortcode
	*/

	add_shortcode( 'norebro_split_box_column_inner', 'norebro_split_box_column_inner_func' );

	function norebro_split_box_column_inner_func( $atts, $content = '' ) {
		// Assembling
		ob_start();
		include( plugin_dir_path( __FILE__ ) . 'split_box_column_inner__view.php' );
		return ob_get_clean();
	}