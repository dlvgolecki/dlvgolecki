<?php

	/**
	* Visual Composer Norebro Typography custom type
	*/
	if ( function_exists ( 'vc_add_shortcode_param' ) ) {
		vc_add_shortcode_param( 'norebro_typography', 'norebro_extra_typography_settings_field', plugins_url( 'typography.js' , __FILE__ ) );
	}
	
	function norebro_extra_typography_settings_field( $settings, $value ) {
		$font_size = $line_height = $letter_spacing = $weight = $italic = $underline = $use_custom_font = $custom_font = $fonts = '';
		$value_array = NorExtraParser::VC_typo_to_array($value);

        $fonts_type = NorebroSettings::get('font_type', 'global');

        switch ($fonts_type) {
            case 'adobe_fonts':
                $fonts = NorExtraAdobeFonts::get_abobe_fonts_array();
                break;
            case 'google_fonts':
                $fonts = NorExtraGoogleFonts::get_google_fonts_array();
                break;
            default:
                $fonts = NorExtraGoogleFonts::get_google_fonts_array();
                break;
        }

		$uniq = uniqid( 'norebro_vc_check_' );
		ob_start();

?>
		<div class="norebro_extra_typography_block">
			<input type="hidden" name="<?php echo esc_attr( $settings['param_name'] ); ?>" class="wpb_vc_param_value" value="<?php echo esc_attr( $value ); ?>">
			<div class="row">
				<div class="split-column">
					<label>
						<div class="title"><?php esc_html_e( 'Font size', 'norebro-extra' ); ?></div>
						<div class="input-pixeles-wrap">
							<input type="text" data-target="font-size" value="<?php echo esc_attr( $value_array['font_size'] ); ?>">
							<div class="pixeles">px</div>
						</div>
					</label>
				</div>
				<div class="split-column">
					<label>
						<div class="title"><?php esc_html_e( 'Line height', 'norebro-extra' ); ?></div>
						<div class="input-pixeles-wrap">
							<input type="text" data-target="line-height" value="<?php echo esc_attr( $value_array['line_height'] ); ?>">
							<div class="pixeles">px</div>
						</div>
					</label>
				</div>
				<div class="split-column">
					<label>
						<div class="title"><?php esc_html_e( 'Letter spacing', 'norebro-extra' ); ?></div>
						<div class="input-pixeles-wrap">
							<input type="text" data-target="letter-spacing" value="<?php echo esc_attr( $value_array['letter_spacing'] ); ?>">
							<div class="pixeles">px</div>
						</div>
					</label>
				</div>
				<div class="split-column">
					<label>
						<div class="title"><?php esc_html_e( 'Font weight', 'norebro-extra' ); ?></div>
						<div class="input-pixeles-wrap">
							<select data-target="weight">
								<option value="inherit">inherit</option>
							<?php
								$check_point = false;
								if ( $value_array['weight'] ) {
									$check_point = $value_array['weight'];
								}
								for ($i=1; $i <= 9; $i++) {
									$selected = ( $check_point == $i * 100 ) ? ' selected="selected"' : '';
									echo '<option value="' . $i . '00"' . $selected . '>' . $i . '00</option>';
								}
							?>
							</select>
						</div>
					</label>
				</div>
			</div>
			<div class="row">
				<div class="split-column column-6">
					<div class="title"><?php esc_html_e( 'Font style', 'norebro-extra' ); ?></div>
					<div class="input-styles-wrap row">
						<div class="split-column column-6">
							<div class="cbrio_custom_check">
								<input id="<?php echo $uniq . 'n'; ?>" type="checkbox" data-target="normal"<?php if ($value_array['normal']) echo ' checked="checked"'; ?>>
								<label for="<?php echo $uniq . 'n'; ?>" class="cbrio_custom_check">normal</label>
							</div>
							<div class="cbrio_custom_check">
								<input id="<?php echo $uniq . 'i'; ?>" type="checkbox" data-target="italic"<?php if ($value_array['italic']) echo ' checked="checked"'; ?>>
								<label for="<?php echo $uniq . 'i'; ?>"><em>italic</em></label>
							</div>
						</div>
						<div class="split-column column-6">
							<div class="cbrio_custom_check">
								<input id="<?php echo $uniq . 'u'; ?>" type="checkbox" data-target="underline"<?php if ($value_array['underline']) echo ' checked="checked"'; ?>>
								<label for="<?php echo $uniq . 'u'; ?>" class="cbrio_custom_check"><u>underline</u></label>
							</div>
							<div class="cbrio_custom_check">
								<input id="<?php echo $uniq . 'up'; ?>" type="checkbox" data-target="uppercase"<?php if ($value_array['uppercase']) echo ' checked="checked"'; ?>>
								<label for="<?php echo $uniq . 'up'; ?>" class="cbrio_custom_check">UPPERCASE</label>
							</div>
						</div>
					</div>
				</div>
				<div class="split-column">
					<div class="title"><?php esc_html_e( 'Custom font family', 'norebro-extra' ); ?></div>
					<div class="input-styles-wrap">
						<span class="cbrio_custom_check">
							<input id="<?php echo $uniq . 'c'; ?>" type="checkbox" data-target="use-custom-font"<?php if ($value_array['use_custom_font']) echo ' checked="checked"'; ?>> 
							<label for="<?php echo $uniq . 'c'; ?>" class="cbrio_custom_check"><?php _e( 'Custom font', 'norebro-extra'); ?></label>
						</span>
					</div>
				</div>
				
				<div class="split-column custom-font-panel"<?php if (!$value_array['use_custom_font']) echo 'style="display: none;"';?>>
					<div class="title">
                        <?php
                        if( $fonts_type == 'google_fonts' ) {
                            esc_html_e('Google Fonts', 'norebro-extra');
                        } elseif( $fonts_type == 'adobe_fonts' ) {
                            esc_html_e('Adobe Typekit Fonts', 'norebro-extra');
                        }
                        ?>
                    </div>
					<div class="input-fonts-wrap">
                        <select data-target="custom-font">
                            <?php if($fonts_type == 'google_fonts'){ ?>
                                <optgroup label="Recommend to use">
                                    <option value="Poppins:400,700"><?php esc_html_e( 'Poppins', 'norebro-extra' ); ?></option>
                                    <option value="Rubik:300,300i,400,400i,700,700i"><?php esc_html_e( 'Rubik', 'norebro-extra' ); ?></option>
                                </optgroup>
                                <option disabled>&mdash;</option>
                            <?php } ?>
                            <?php foreach ($fonts as $font_object) { $_value = $font_object->font_family . ':' . $font_object->font_styles; ?>
                                <option value="<?php echo $_value; ?>"<?php if ($_value == $value_array['custom_font']) echo 'selected="selected"'?>><?php echo $font_object->font_family; ?></option>
                            <?php } ?>
                        </select>
					</div>
                    <?php if( $fonts_type == 'google_fonts' ) { ?>
                        <div class="tip"><?php echo sprintf( __( 'See %s', 'norebro-extra'), '<a href="https://fonts.google.com/" target="_blank">fonts.google.com</a>' ); ?></div>
                    <?php } ?>
				</div>
			</div>
		</div>
<?php

		$content = ob_get_contents();
		ob_end_clean();
		return $content;
	}