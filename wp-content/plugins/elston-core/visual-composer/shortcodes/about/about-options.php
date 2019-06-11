<?php
/**
 * List - Shortcode Options
 */
add_action( 'init', 'elstn_about_vc_map' );
if ( ! function_exists( 'elstn_about_vc_map' ) ) {
  function elstn_about_vc_map() {
    vc_map( array(
      "name" => __( "About", 'elston-core'),
      "base" => "elstn_about",
      "description" => __( "About Information Area/Block", 'elston-core'),
      "icon" => "fa fa-user color-grey",
      "category" => VictorLib::elstn_cat_name(),
      "params" => array(
        array(
          "type"        =>'textfield',
          "heading"     => __('Title', 'elston-core'),
          "param_name"  => 'title',
          "value"       => '',
          "description" => __( "About title.", "elston-core" )
        ),
        array(
          "type"        =>'textfield',
          "heading"     => __('Sub Title', 'elston-core'),
          "param_name"  => 'sub_title',
          "value"       => '',
          "description" => __( "About Subtitle.", "elston-core" )
        ),
        array(
          "type"        => 'attach_image',
          "heading"     => __('Upload Image', 'elston-core'),
          "param_name"  => 'about_image',
          "value"       => '',
          "description" => __( "Upload HD Image more than : 930x1050 size.", "elston-core" ),
          'edit_field_class' => 'vc_col-md-6 vc_column vt_field_space',
        ),
        array(
          'type' => 'dropdown',
          'heading' => __( 'Image on Left/Right?', 'elston-core' ),
          'value' => array(
            __( 'Select Image Position', 'elston-core' ) => '',
            __( 'Left', 'elston-core' ) => 'left',
            __( 'Right', 'elston-core' ) => 'right',
          ),
          'admin_label' => true,
          'param_name' => 'about_image_position',
          'description' => __( 'Select about image postion on left or right', 'elston-core' ),
          'edit_field_class'   => 'vc_col-md-6 vc_column vt_field_space',
        ),
        array(
          'type' => 'textarea_html',
          'heading' => __( 'About Details Information', 'elston-core' ),
          'value' => '',
          'param_name' => 'content',
        ),

        array(
          "type"        => 'textfield',
          "heading"     => __('Button Link Text', 'elston-core'),
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
          'edit_field_class' => 'vc_col-md-6 vc_column vt_field_space',
        ),

        array(
          "type"        =>'href',
          "heading"     =>__('Link', 'elston-core'),
          "param_name"  => 'link',
          "value"       => '',
          "description" => __( "Enter link of button.", "elston-core" ),
          'edit_field_class' => 'vc_col-md-6 vc_column vt_field_space',
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
            __('Button With Background', 'elston-core') => 'btn-bg',
            __('Button With Border', 'elston-core') => 'btn-border',
          ),
          'param_name' => 'btn_type',
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
          'edit_field_class' => 'vc_col-md-6 vc_column vt_field_space',
        ),
        array(
          "type" => "colorpicker",
          "heading" => __( "Button Background Hover Color", 'elston-core' ),
          "param_name" => "bg_hover_color",
          'value' => '',
          "group" => __( "Styling", 'elston-core'),
          'edit_field_class' => 'vc_col-md-6 vc_column vt_field_space',
        ),
        array(
          "type" => "colorpicker",
          "heading" => __( "Button Border Hover Color", 'elston-core' ),
          "param_name" => "border_hover_color",
          'value' => '',
          "group" => __( "Styling", 'elston-core'),
          'edit_field_class' => 'vc_col-md-6 vc_column vt_field_space',
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
