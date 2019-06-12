<?php

/**
* Visual Composer Norebro Recent Projects shortcode view
*/

if ( ! $is_slider && ! $is_splitscreen && ! $is_onepage ) {
	include( plugin_dir_path( __FILE__ ) . 'views/recent_projects__view_default.php' );
}
if ( $is_slider ) {
	include( plugin_dir_path( __FILE__ ) . 'views/recent_projects__view_slider.php' );
}
if ( $is_splitscreen ) {
	include( plugin_dir_path( __FILE__ ) . 'views/recent_projects__view_split.php' );
}
if ( $is_onepage ) {
	include( plugin_dir_path( __FILE__ ) . 'views/recent_projects__view_onepage.php' );
}