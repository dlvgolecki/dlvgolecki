<?php
/**
 * Contact Banner - Shortcode Options
 */
add_action( 'init', 'elstn_contact_banner_vc_map' );
if ( ! function_exists( 'elstn_contact_banner_vc_map' ) ) {
  function elstn_contact_banner_vc_map() {
    vc_map( array(
      "name" => __( "Contact Banner", 'elston-core'),
      "base" => "elstn_contact_banner",
      "description" => __( "Contact Banner Area/Block", 'elston-core'),
      "icon" => "fa fa-paper-plane color-pink",
      "category" => VictorLib::elstn_cat_name(),
      "params" => array(
        array(
          "type"        =>'textfield',
          "heading"     =>__('Title', 'elston-core'),
          "param_name"  => 'title',
          "value"       => '',
          "admin"       => true,
          "description" => __( "Contact banner title.", "elston-core" )
        ),

        array(
          "type"        =>'textfield',
          "heading"     =>__('Link Text', 'elston-core'),
          "param_name"  => 'text',
          "value"       => '',
          "description" => __( "Enter button text.", "elston-core" ),
          'edit_field_class'   => 'vc_col-md-6 vc_column vt_field_space',
        ),

        array(
          "type" => "switcher",
          "heading" => __( "Open New Tab?", 'elston-core' ),
          "param_name" => "btn_open_link",
          "std" => false,
          'value' => '',
          "on_text" => __( "Yes", 'elston-core' ),
          "off_text" => __( "No", 'elston-core' ),
          'edit_field_class'   => 'vc_col-md-6 vc_column vt_field_space',
        ),

        array(
          "type"        =>'href',
          "heading"     =>__('Link', 'elston-core'),
          "param_name"  => 'link',
          "value"       => '',
          "description" => __( "Enter link of button.", "elston-core" ),
          'edit_field_class'   => 'vc_col-md-6 vc_column vt_field_space',
        ),

        array(
          'type' => 'dropdown',
          'heading' => __( 'Button Size', 'elston-core' ),
          'value' => array(
            __('Select Button Type', 'elston-core') => '',
            __('Default', 'elston-core') => 'default',
            __('Medium', 'elston-core') => 'medium',
            __('Large', 'elston-core') => 'large',
          ),
          'param_name' => 'btn_size',
          'edit_field_class'   => 'vc_col-md-6 vc_column vt_field_space',
        ),

        array(
          'type' => 'dropdown',
          'heading' => __( 'Button Type', 'elston-core' ),
          'value' => array(
            __('Select Button Type', 'elston-core') => '',
            __('Button With Background', 'elston-core') => 'btn-one',
            __('Button With Border', 'elston-core') => 'btn-two',
          ),
          'param_name' => 'btn_type',
          'edit_field_class'   => 'vc_col-md-6 vc_column vt_field_space',
        ),

        array(
          'type' => 'dropdown',
          'heading' => __( 'Button Style', 'elston-core' ),
          'value' => array(
            __('Select Button Style', 'elston-core') => '',
            __('Squred', 'elston-core') => 'squred',
            __('Rounded', 'elston-core') => 'rounded',
          ),
          'param_name' => 'btn_style',
          'edit_field_class'   => 'vc_col-md-6 vc_column vt_field_space',
        ),

        VictorLib::elston_class(),

        // Styling
        array(
          "type" => "colorpicker",
          "heading" => __( "Button Text Color", 'elston-core' ),
          "param_name" => "text_color",
          'value' => '',
          "group" => __( "Styling", 'elston-core'),
          'edit_field_class'  => 'vc_col-md-6 vc_column vt_field_space',
        ),
        array(
          "type" => "colorpicker",
          "heading" => __( "Button Text Hover Color", 'elston-core' ),
          "param_name" => "text_hover_color",
          'value' => '',
          "group" => __( "Styling", 'elston-core'),
          'edit_field_class'  => 'vc_col-md-6 vc_column vt_field_space',
        ),
        array(
          "type" => "colorpicker",
          "heading" => __( "Button Background Hover Color", 'elston-core' ),
          "param_name" => "bg_hover_color",
          'value' => '',
          "group" => __( "Styling", 'elston-core'),
          'edit_field_class'  => 'vc_col-md-6 vc_column vt_field_space',
        ),
        array(
          "type" => "colorpicker",
          "heading" => __( "Button Border Hover Color", 'elston-core' ),
          "param_name" => "border_hover_color",
          'value' => '',
          "group" => __( "Styling", 'elston-core'),
          'edit_field_class'  => 'vc_col-md-6 vc_column vt_field_space',
        ),
        array(
          "type" => "textfield",
          "heading" => __( "Button Text Size", 'elston-core' ),
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
