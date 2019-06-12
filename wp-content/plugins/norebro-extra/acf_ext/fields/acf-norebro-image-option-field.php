<?php

// exit if accessed directly
if( ! defined( 'ABSPATH' ) ) exit;


// check if class already exists
if( !class_exists('norebro_acf_field_image_option') ) :


class norebro_acf_field_image_option extends acf_field {

	function __construct( $settings ) {
		$this->name = 'image_option';
		$this->label = __('Norebro Image Option', 'norebro-extra');
		$this->category = 'basic';
		$this->defaults = array();
		$this->l10n = array(
			'error'	=> __('Error! Please enter a higher value', 'norebro-extra'),
		);
		$this->settings = $settings;

		// do not delete!
    	parent::__construct();
    	
	}
	
	function render_field_settings( $field ) {
		acf_render_field_setting( $field, array(
			'label'			=> __('Image option','norebro-extra'),
			'instructions'	=> __('Create options with format:<br>"value:img_path:desc"<br>For ex,<br> "type_1:/img/a.png:First".<br>Enter each option on a new line.','norebro-extra'),
			'type'			=> 'textarea',
			'name'			=> 'image_option_value'
		));
	}

	function render_field( $field ) {
		$url = $this->settings['url'];
		$version = $this->settings['version'];
		?>
		<div class="norebro-acf-image-option-type">
			<?php
			$items = $field['image_option_value'];
			foreach ( $items as $item ) {
				echo '<div class="naiot-item" data-naiot-setting-value="' . $item['name'] . '">';
				echo '<div class="naiot-container">';
				echo '<img src="' . $url . 'assets/images/' . $item['src'] . '?v=' . $version . '" alt="' . $item['name'] . '"/>';
				echo '</div>';
				echo '<div class="naiot-description">' . ( (isset( $item['description'] ) ) ? $item['description'] : '') . '</div>';
				echo '</div>';
			}
			?>
			<input type="hidden" name="<?php echo esc_attr($field['name']) ?>" value="<?php echo esc_attr($field['value']) ?>" />
		</div>
		<?php
	}
	
	function input_admin_enqueue_scripts() {
		$url = $this->settings['url'];
		$version = $this->settings['version'];

		// register & include JS
		wp_register_script('norebro-image-option', "{$url}assets/js/naiot.js", array('acf-input'), $version);
		wp_enqueue_script('norebro-image-option');

		// register & include CSS
		wp_register_style('norebro-image-option', "{$url}assets/css/naiot.css", array('acf-input'), $version);
		wp_enqueue_style('norebro-image-option');
		
	}
	
}

// initialize
new norebro_acf_field_image_option( $this->settings );

// class_exists check
endif;

?>