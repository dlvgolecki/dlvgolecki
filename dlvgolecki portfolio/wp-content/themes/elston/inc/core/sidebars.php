<?php
/*
 * Elston Theme Widgets
 * Author & Copyright: VictorThemes
 * URL: https://victorthemes.com
 */

if ( ! function_exists( 'elston_widget_init' ) ) {
	function elston_widget_init() {
		if ( function_exists( 'register_sidebar' ) ) {

			// Main Widget Area
			register_sidebar(
				array(
					'name' => __( 'Main Widget Area', 'elston' ),
					'id' => 'main-widget',
					'description' => __( 'Appears on posts and pages.', 'elston' ),
					'before_widget' => '<div id="%1$s" class="elstn-widget %2$s">',
					'after_widget' => '</div> <!-- end widget -->',
					'before_title' => '<h4 class="widget-title">',
					'after_title' => '</h4>',
				)
			);
			// Main Widget Area

		}
	}
	add_action( 'widgets_init', 'elston_widget_init' );
}
