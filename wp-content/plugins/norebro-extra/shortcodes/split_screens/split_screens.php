<?php 

/**
* Visual Composer Norebro Split Screens shortcode
*/

add_shortcode( 'norebro_split_screens', 'norebro_split_screens_func' );

function norebro_split_screens_func( $atts, $content = '' ) {
	if ( isset( $atts ) && is_array( $atts ) ) extract( $atts );

	// Default values, parsing and filtering
	$animation_duration = isset( $animation_duration ) ? NorExtraFilter::string( $animation_duration ) : 'default';
	$navigation_buttons  = isset( $navigation_buttons ) ? NorExtraFilter::boolean( $navigation_buttons ) : true;
	$navigation_type  = isset( $navigation_type ) ? NorExtraFilter::string( $navigation_type, 'string', 'bullets' ) : 'bullets';
	$navigation_color = isset( $navigation_color ) ? NorExtraFilter::string( $navigation_color ) : false;
	
	$css_class = isset( $css_class ) ? ' ' . NorExtraFilter::string( $css_class, 'attr', '' )  : '';

	// Styles
	$split_screens_uniqid = uniqid( 'norebro-custom-' );

	NorebroHelper::add_required_script( 'multiscroll' );

	$animation_duration_css = false;
	if ( $animation_duration != 'default' ) {
		switch ( $animation_duration ) {
			case 'fast':
				$animation_duration_css = 'transition:all .3s ease-in-out;';
				break;
			case 'slow':
				$animation_duration_css = 'transition:all 1s ease-in-out;';
				break;
		}
	}

	$multiscroll_object = (object) array();
	$multiscroll_object->nav = (bool) $navigation_buttons;
	$multiscroll_object->navContainerClass = 'slider-nav';
	$multiscroll_object->dots = true;
	$multiscroll_object->dotsClass = 'slider-vertical-' . ( ( $navigation_type == 'bullets' ) ? 'dots' : 'numbers' );
	$multiscroll_object->navClass = array( 'up', 'down' );
	$multiscroll_json = json_encode( $multiscroll_object );

	$navigation_css = '';
	$navigation_active_css = '';
	if ( $navigation_color ) {
		$navigation_css = 'background:' . $navigation_color . ';border-color:' . $navigation_color . ';';
		$navigation_active_css = 'background:transparent;';
	}

	// Reparse content
	$screens_content = array();
	$_screens_content = explode( '[/norebro_split_screen]', $content );
	foreach ( $_screens_content as $screen ) {
		if ( strlen( trim( $screen ) ) > 0 ) {
			$enter_pos = strpos( $screen, '[norebro_split_screen]' );
			$enter_len = strlen( '[norebro_split_screen]' );
			if ( $enter_pos > -1 ) {
				$screens_content[] = substr( $screen, $enter_pos + $enter_len );
			}
		}
	}

	foreach ( $screens_content as $key => $screen ) {
		$screens_content[$key] = array(
			'left' => array( 'attr' => '', 'content' => '' ),
			'right' => array( 'attr' => '', 'content' => '' )
		);

		preg_match( '/\[norebro_split_screen_column_left.*?\]/', $screen, $matches, PREG_OFFSET_CAPTURE );
		$left_enter_pos = ( count( $matches ) > 0 ) ? $matches[0][1] : false;
		$left_close_pos = strpos( $screen, '[/norebro_split_screen_column_left]' );		
		if ( $left_enter_pos > -1 && $left_close_pos > -1 ) {
			$screens_content[$key]['left']['content'] = substr( $screen, 
				$left_enter_pos + ( strlen( $matches[0][0] ) ), 
				$left_close_pos - $left_enter_pos - strlen( $matches[0][0] )
			);
			$screens_content[$key]['left']['attr'] = substr( $matches[0][0], 
				strlen( '[norebro_split_screen_column_left ' ), 
				strlen( $matches[0][0] ) - strlen( '[norebro_split_screen_column_left ' ) - 1
			);
		}

		preg_match( '/\[norebro_split_screen_column_right.*?\]/', $screen, $matches, PREG_OFFSET_CAPTURE );
		$right_enter_pos = ( count( $matches ) > 0 ) ? $matches[0][1] : false;
		$right_close_pos = strpos( $screen, '[/norebro_split_screen_column_right]' );
		if ( $right_enter_pos > -1 && $right_close_pos > -1 ) {
			$screens_content[$key]['right']['content'] = substr(
				$screen, 
				$right_enter_pos + ( strlen( $matches[0][0] ) ), 
				$right_close_pos - $right_enter_pos - strlen( $matches[0][0] )
			);
			$screens_content[$key]['right']['attr'] = substr( $matches[0][0], 
				strlen( '[norebro_split_screen_column_right '), 
				strlen( $matches[0][0] ) - strlen( '[norebro_split_screen_column_right ') - 1
			);
		}
	}
	// Bundle
	$content = '[norebro_split_screen_column_left]';
	foreach ( $screens_content as $screen ) {
		$content .= '[norebro_split_screen ' . $screen['left']['attr'] . ']' . $screen['left']['content'] . '[/norebro_split_screen]';
	}
	$content .= '[/norebro_split_screen_column_left]';
	$content .= '[norebro_split_screen_column_right]';
	foreach ( $screens_content as $screen ) {
		$content .= '[norebro_split_screen ' . $screen['right']['attr'] . ']' . $screen['right']['content'] . '[/norebro_split_screen]';
	}
	$content .= '[/norebro_split_screen_column_right]';

	// Assembling
	include( plugin_dir_path( __FILE__ ) . 'split_screens__style.php' );
	ob_start();
	include( plugin_dir_path( __FILE__ ) . 'split_screens__view.php' );
	return ob_get_clean();
}