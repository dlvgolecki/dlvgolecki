<?php
	// Main Text
	$need_copyright = cs_get_option('need_copyright');
	$secondary_text = cs_get_option('secondary_text');

	if (isset($need_copyright)) {
		$copyright_text = cs_get_option('copyright_text');
		if ($copyright_text) {
			echo do_shortcode($copyright_text);
		} else {
			esc_html_e( '&copy; ', 'elston' );
			echo esc_attr(date('Y'));
			esc_html_e( ' VictorThemes. All right reserved.', 'elston' );
		}
		echo "<br/>";
		echo do_shortcode($secondary_text);
	}
