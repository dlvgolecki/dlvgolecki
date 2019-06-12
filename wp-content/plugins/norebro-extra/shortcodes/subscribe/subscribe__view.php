<?php

/**
* Visual Composer Norebro Subscribe shortcode view
*/

?>
<div class="norebro-subscribe-sc subscribe <?php echo $subscribe_append_class . $css_class; ?>"
	id="<?php echo esc_attr( $subscribe_uniqid ); ?>" 
	<?php if ( $appearance_effect != 'none' ) { echo ' data-aos="' . esc_attr( $appearance_effect ) . '"'; } ?>
	<?php if ( $appearance_duration ) { echo ' data-aos-duration="' . esc_attr( $appearance_duration ) . '"'; } ?>>

	<form action="https://feedburner.google.com/fb/a/mailverify" method="post" target="popupwindow" onsubmit="window.open('https://feedburner.google.com/fb/a/mailverify?uri=<?php echo esc_attr( $feedburner_name ); ?>', 'popupwindow', 'scrollbars=yes,width=550,height=520'); return true" class="text-<?php echo $alignment; ?>">
		<table>
			<tr>
				<td>
					<input type="text" 
						placeholder="<?php echo esc_attr( $input_placeholder ); ?>" 
						name="email" 
						<?php if ( $input_class ) { echo ' class="' . $input_class . '"'; } ?>
					>
					<input type="hidden" value="<?php echo esc_attr( $feedburner_name ); ?>" name="uri"/>
					<input type="hidden" name="loc" value="en_US"/>
				</td>
				<td class="btn-wrap">
					<input type="submit" class="btn<?php echo $button_css['classes']; ?>" value="<?php echo $button_text; ?>">
				</td>
			</tr>
		</table>
	</form>

</div>