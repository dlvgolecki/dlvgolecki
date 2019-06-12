<?php

// exit if accessed directly
if( ! defined( 'ABSPATH' ) ) exit;

// check if class already exists
if( ! class_exists( 'acf_field_norebro_sizes' ) ) :


class acf_field_norebro_sizes extends acf_field {

	
	function __construct( $settings ) {

		$this->name = 'norebro_sizes';
		/*
		*  label (string) Multiple words, can include spaces, visible when selecting a field type
		*/
		$this->label = esc_html__( 'Norebro Responsive Font Sizes', 'norebro-extra' );
		/*
		*  category (string) basic | content | choice | relational | jquery | layout | CUSTOM GROUP NAME
		*/
		$this->category = 'basic';
		/*
		*  defaults (array) Array of default settings which are merged into the field object. These are used later in settings
		*/
		$this->defaults = array(
			'add_theme_inherited' => true
		);
		/*
		*  l10n (array) Array of strings that are used in JavaScript. This allows JS strings to be translated in PHP and loaded via:
		*  var message = acf._e('FIELD_NAME', 'error');
		*/
		
		$this->l10n = array(
			'error'	=> esc_html__( 'Error! Please enter a higher value', 'acf-norebro-typo' ),
		);
		/*
		*  settings (array) Store plugin settings (url, path, version) as a reference for later use with assets
		*/
		$this->settings = $settings;

		// do not delete!
    	parent::__construct();
    	
	}



	/*function render_field_settings( $field ) {
		acf_render_field_setting( $field, array(
			'label'			=> __( 'Add "Theme inherited" option?','acf' ),
			'instructions'	=> '',
			'name'			=> 'add_theme_inherited',
			'type'			=> 'true_false',
			'ui'			=> 1,
		));
	}*/
	
	
	function render_field( $field ) {
		$field_value = false;
		if ( $field['value'] ) {
			$field_value = json_decode( $field['value'] );
		}

		$text = acf_get_sub_array( $field, array('id', 'class', 'name', 'value') );
		$hidden = acf_get_sub_array( $field, array('name', 'value') );
		$uniqid = uniqid( 'norebro-typo' );
?>

		<div class="norebro-acf-sizes-field-content" data-uniqid="<?php echo $uniqid; ?>">

			<!-- Hidden field -->
			<?php acf_hidden_input( $hidden ); ?>

			<div class="row">

				<!-- Laptops font -->
				<div class="xl-col3 sm-col1">
					<strong class="label"><?php esc_html_e( 'For laptops', 'norebro-extra' ); ?> <span>(≤ 1440px of device width)</span></strong>
					<strong class="label">font-size:</strong>
					<input type="text" name="size-laptop"<?php if ( is_object( $field_value ) && isset( $field_value->laptop_size ) ) { echo ' value="' . $field_value->laptop_size . '"'; } ?> placeholder="Leave blank for inherit">
					<strong class="label">line-height:</strong>
					<input type="text" name="height-laptop"<?php if ( is_object( $field_value ) && isset( $field_value->laptop_height ) ) { echo ' value="' . $field_value->laptop_height . '"'; } ?> placeholder="Leave blank for inherit">
				</div>

				<!-- Tablets font -->
				<div class="xl-col3 sm-col1">
					<strong class="label"><?php esc_html_e( 'For tablets', 'norebro-extra' ); ?> <span>(≤ 1024px of device width)</span></strong>
					<strong class="label">font-size:</strong>
					<input type="text" name="size-tablet"<?php if ( is_object( $field_value ) && isset( $field_value->tablet_size ) ) { echo ' value="' . $field_value->tablet_size . '"'; } ?> placeholder="Leave blank for inherit">
					<strong class="label">line-height:</strong>
					<input type="text" name="height-tablet"<?php if ( is_object( $field_value ) && isset( $field_value->tablet_height ) ) { echo ' value="' . $field_value->tablet_height . '"'; } ?> placeholder="Leave blank for inherit">
				</div>

				<!-- Mobiles font -->
				<div class="xl-col3 sm-col1">
					<strong class="label"><?php esc_html_e( 'For mobiles', 'norebro-extra' ); ?> <span>(≤ 768px of device width)</span></strong>
					<strong class="label">font-size:</strong>
					<input type="text" name="size-mobile"<?php if ( is_object( $field_value ) && isset( $field_value->mobile_size ) ) { echo ' value="' . $field_value->mobile_size . '"'; } ?> placeholder="Leave blank for inherit">
					<strong class="label">line-height:</strong>
					<input type="text" name="height-mobile"<?php if ( is_object( $field_value ) && isset( $field_value->mobile_height ) ) { echo ' value="' . $field_value->mobile_height . '"'; } ?> placeholder="Leave blank for inherit">
				</div>

			</div>
		</div>

		<?php
	}

	function input_admin_enqueue_scripts() {
		global $wp_scripts, $wp_styles;

		$url = $this->settings['url'];
		$version = $this->settings['version'];

		// wp_register_style( 'acf-input-norebro', "{$url}assets/css/input.css", array( 'acf-input' ), $version );
		wp_enqueue_style( 'acf-input-norebro' );
		
		wp_register_script( 'acf-input-norebro-typo', "{$url}assets/js/input.js", array( 'acf-input' ), $version );
		wp_enqueue_script('acf-input-norebro-typo');
	}

	function load_value( $value, $post_id, $field ) {
		return $value;
	}
}

// initialize
new acf_field_norebro_sizes( $this->settings );

// class_exists check
endif;

?>