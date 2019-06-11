<?php
/**
 * Button - Shortcode Options
 */
add_action( 'init', 'elstn_button_vc_map' );
if ( ! function_exists( 'elstn_button_vc_map' ) ) {
  function elstn_button_vc_map() {
    vc_map( array(
      "name" => __( "Button", 'elston-core'),
      "base" => "elstn_button",
      "description" => __( "Button Styles", 'elston-core'),
      "icon" => "fa fa-mouse-pointer color-orange",
      "category" => VictorLib::elstn_cat_name(),
      "params" => array(

        array(
          'type' => 'dropdown',
          'heading' => __( 'Button Size', 'elston-core' ),
          'value' => array(
            __( 'Select Button Size', 'elston-core' ) => '',
            __( 'Small', 'elston-core' ) => 'elstn-btn-small',
            __( 'Medium', 'elston-core' ) => 'elstn-btn-medium',
            __( 'Large', 'elston-core' ) => 'elstn-btn-large',
          ),
          'admin_label' => true,
          'param_name' => 'button_size',
          'description' => __( 'Select button size', 'elston-core' ),
        ),
        array(
          "type" => "textfield",
          "heading" => __( "Button Text", 'elston-core' ),
          "param_name" => "button_text",
          'value' => '',
          'admin_label' => true,
          "description" => __( "Enter your button text.", 'elston-core'),
          'edit_field_class'  => 'vc_col-md-6 vc_column vt_field_space',
        ),
        array(
          "type" => "href",
          "heading" => __( "Button Link", 'elston-core' ),
          "param_name" => "button_link",
          'value' => '',
          "description" => __( "Enter your button link.", 'elston-core'),
          'edit_field_class'  => 'vc_col-md-6 vc_column vt_field_space',
        ),
        array(
          "type" => "switcher",
          "heading" => __( "Open New Tab?", 'elston-core' ),
          "param_name" => "open_link",
          "std" => false,
          'value' => '',
          "on_text" => __( "Yes", 'elston-core' ),
          "off_text" => __( "No", 'elston-core' ),
        ),

        array(
          'type' => 'dropdown',
          'heading' => __( 'Button Type', 'elston-core' ),
          'value' => array(
            __('Select Button Type', 'elston-core') => '',
            __('Button With Background', 'elston-core') => 'btn-bg',
            __('Button With Border', 'elston-core') => 'btn-border',
          ),
          'param_name' => 'button_type',
          'edit_field_class' => 'vc_col-md-6 vc_column vt_field_space',
        ),

        array(
          'type' => 'dropdown',
          'heading' => __( 'Button Style', 'elston-core' ),
          'value' => array(
            __('Select Button Style', 'elston-core') => '',
            __('Squred', 'elston-core') => 'squred',
            __('Rounded', 'elston-core') => 'rounded',
          ),
          'param_name' => 'button_style',
          'edit_field_class' => 'vc_col-md-6 vc_column vt_field_space',
        ),

        VictorLib::elston_class(),

        // Styling
        array(
          "type" => "colorpicker",
          "heading" => __( "Text Color", 'elston-core' ),
          "param_name" => "text_color",
          'value' => '',
          "group" => __( "Styling", 'elston-core'),
          'edit_field_class'  => 'vc_col-md-6 vc_column vt_field_space',
        ),
        array(
          "type" => "colorpicker",
          "heading" => __( "Text Hover Color", 'elston-core' ),
          "param_name" => "text_hover_color",
          'value' => '',
          "group" => __( "Styling", 'elston-core'),
          'edit_field_class'  => 'vc_col-md-6 vc_column vt_field_space',
        ),
        array(
          "type" => "colorpicker",
          "heading" => __( "Background Hover Color", 'elston-core' ),
          "param_name" => "bg_hover_color",
          'value' => '',
          "group" => __( "Styling", 'elston-core'),
          'edit_field_class'  => 'vc_col-md-6 vc_column vt_field_space',
        ),
        array(
          "type" => "colorpicker",
          "heading" => __( "Border Hover Color", 'elston-core' ),
          "param_name" => "border_hover_color",
          'value' => '',
          "group" => __( "Styling", 'elston-core'),
          'edit_field_class'  => 'vc_col-md-6 vc_column vt_field_space',
        ),
        array(
          "type" => "textfield",
          "heading" => __( "Text Size", 'elston-core' ),
          "param_name" => "text_size",
          'value' => '',
          "description" => __( "Enter button text font size. [Eg: 14px]", 'elston-core'),
          "group" => __( "Styling", 'elston-core'),
        ),

        // Design Tab
        array(
          "type" => "css_editor",
          "heading" => __( "Text Size", 'elston-core' ),
          "param_name" => "css",
          "group" => __( "Design", 'elston-core'),
        ),

      )
    ) );
  }
}
