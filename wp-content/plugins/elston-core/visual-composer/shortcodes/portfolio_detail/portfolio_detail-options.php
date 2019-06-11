<?php
/**
 * Portfolio Details - Shortcode Options
 */
add_action( 'init', 'elstn_portfolio_details_vc_map' );
if ( ! function_exists( 'elstn_portfolio_details_vc_map' ) ) {
  function elstn_portfolio_details_vc_map() {
    vc_map( array(
      "name" => __( "Portfolio Details", 'elston-core'),
      "base" => "elstn_portfolio_details",
      "description" => __( "Portfolio Details", 'elston-core'),
      "icon" => "fa fa-list color-blue",
      "category" => VictorLib::elstn_cat_name(),
      "params" => array(

        array(
          'type' => 'dropdown',
          'heading' => __( 'Portfolio Details Block Type', 'elston-core' ),
          'value' => array(
            __( 'Version One - Text Center Boxed', 'elston-core' ) => 'one',
            __( 'Version Two - Text Left Boxed', 'elston-core' ) => 'two',
            __( 'Version Three - Details Sidebar Left', 'elston-core' ) => 'three',
            __( 'Version Four - Details Sidebar Right', 'elston-core' ) => 'four',
            __( 'Version Five - Full Width Slider', 'elston-core' ) => 'five',
            __( 'Version Six - Left Info and Right Content', 'elston-core' ) => 'six',
          ),
          'admin_label' => true,
          'param_name' => 'version',
          'description' => __( 'Select Portfolio Details Block Type.', 'elston-core' ),
        ),

        array(
          'type' => 'dropdown',
          'heading' => __( 'Sidebar Floting Style', 'elston-core' ),
          'value' => array(
            __( 'Sticky', 'elston-core' ) => 'sticky',
            __( 'Floting', 'elston-core' ) => 'floting',
          ),
          'param_name' => 'sidebar_style',
          'description' => __( 'Select Sidebar Floting Style.', 'elston-core' ),
          'dependency' => array(
            'element' => 'version',
            'value' => array('three','four'),
          ),
        ),

        array(
          'type' => 'dropdown',
          'heading' => __( 'Portfolio Title', 'elston-core' ),
          'value' => array(
            __( 'Default', 'elston-core' ) => 'default',
            __( 'Custom', 'elston-core' ) => 'custom',
          ),
          'admin_label' => true,
          'param_name' => 'heading_text',
          'description' => __( 'Select Default or Custom Heading.', 'elston-core' ),
        ),

        array(
          "type"        =>'textfield',
          "heading"     =>__('Type Text', 'elston-core'),
          "param_name"  => "custom_heading",
          "value"       => "",
          "description" => __( "Enter the text to show.", 'elston-core'),
          'dependency' => array(
            'element' => 'heading_text',
            'value' => array('custom'),
          ),
        ),

        array(
          "type"        =>'textfield',
          "heading"     =>__('Sub Heading', 'elston-core'),
          "param_name"  => "sub_heading",
          "value"       => "",
          "description" => __( "Enter sub heading.", 'elston-core'),
          'dependency' => array(
            'element' => 'version',
            'value' => array('one', 'three', 'four'),
          ),
        ),

        array(
          "type"        => "textarea_html",
          "param_name"  => 'content',
          "value"       => '',
          "description" => __( "Description.", "elston-core" )
        ),

        array(
          "type"        =>'href',
          "heading"     =>__('Link', 'elston-core'),
          "param_name"  => "link",
          "value"       => "",
          "description" => __( "Project link.", 'elston-core'),
          'edit_field_class'   => 'vc_col-md-6 vc_column vt_field_space',
        ),

        array(
          "type" => "switcher",
          "heading" => __( "Open New Tab?", 'elston-core' ),
          "param_name" => "open_link",
          "std" => false,
          'value' => '',
          "on_text"  => __( "Yes", 'elston-core' ),
          "off_text" => __( "No", 'elston-core' ),
          'edit_field_class'   => 'vc_col-md-6 vc_column vt_field_space',
        ),

        array(
          "type"        =>'textfield',
          "heading"     =>__('Link Text', 'elston-core'),
          "param_name"  => "link_text",
          "value"       => "",
          "description" => __( "Enter link text.", 'elston-core'),
          'edit_field_class'   => 'vc_col-md-6 vc_column vt_field_space',
        ),

        array(
          "type"        =>'textfield',
          "heading"     =>__('Link Before Text', 'elston-core'),
          "param_name"  => "link_before_text",
          "value"       => "",
          "description" => __( "Enter before link text.", 'elston-core'),
          'edit_field_class'   => 'vc_col-md-6 vc_column vt_field_space',
        ),

        array(
          "type"        =>'textfield',
          "heading"     =>__('Client Name', 'elston-core'),
          "param_name"  => "client",
          "value"       => "",
          "description" => __( "Enter client name.", 'elston-core'),
          'edit_field_class'   => 'vc_col-md-6 vc_column vt_field_space',
          'dependency' => array(
            'element' => 'version',
            'value' => array('two', 'three', 'four', 'five', 'six'),
          ),
        ),

        array(
          "type"        =>'href',
          "heading"     =>__('Client Link', 'elston-core'),
          "param_name"  => "client_link",
          "value"       => "",
          "description" => __( "Enter client link.", 'elston-core'),
          'edit_field_class'   => 'vc_col-md-6 vc_column vt_field_space',
          'dependency' => array(
            'element' => 'version',
            'value' => array('two', 'three', 'four', 'five', 'six'),
          ),
        ),

        array(
          "type"        =>'textfield',
          "heading"     =>__('Year', 'elston-core'),
          "param_name"  => "year",
          "value"       => "",
          "description" => __( "Enter year Ex: 2016.", 'elston-core'),
          'edit_field_class'   => 'vc_col-md-6 vc_column vt_field_space',
          'dependency' => array(
            'element' => 'version',
            'value' => array('three', 'four', 'five', 'six'),
          ),
        ),

        // Portfolio Detail List
        array(
          'type' => 'param_group',
          'value' => '',
          'heading' => __( 'Portfolio Detail List', 'elston-core' ),
          'param_name' => 'detail_lists',
          'dependency' => array(
            'element' => 'version',
            'value' => array('two', 'three', 'four', 'five', 'six'),
          ),
          'params' => array(
            array(
              'type' => 'textfield',
              'value' => '',
              "admin_label"=> true,
              'heading' => __( 'Title', 'elston-core' ),
              'param_name' => 'title',
            ),
            array(
              'type' => 'textfield',
              'value' => '',
              'heading' => __( 'Text One', 'elston-core' ),
              'param_name' => 'text_one',
              'edit_field_class'   => 'vc_col-md-6 vc_column vt_field_space',
            ),
            array(
              'type' => 'textfield',
              'value' => '',
              'heading' => __( 'Text One Link', 'elston-core' ),
              'param_name' => 'text_one_link',
              'edit_field_class'   => 'vc_col-md-6 vc_column vt_field_space',
            ),
            array(
              'type' => 'textfield',
              'value' => '',
              'heading' => __( 'Text Two', 'elston-core' ),
              'param_name' => 'text_two',
              'edit_field_class'   => 'vc_col-md-6 vc_column vt_field_space',
            ),
            array(
              'type' => 'textfield',
              'value' => '',
              'heading' => __( 'Text Two Link', 'elston-core' ),
              'param_name' => 'text_two_link',
              'edit_field_class'   => 'vc_col-md-6 vc_column vt_field_space',
            ),
          )
        ),

        array(
          "type" => "switcher",
          "heading" => __( "Social Share Active?", 'elston-core' ),
          "param_name" => "share_on",
          "std" => false,
          'value' => '',
          "on_text"  => __( "Yes", 'elston-core' ),
          "off_text" => __( "No", 'elston-core' ),
          'dependency' => array(
            'element' => 'version',
            'value' => array('one','three','four','five'),
          ),
          'edit_field_class'   => 'vc_col-md-6 vc_column vt_field_space',
        ),
        array(
          'type' => 'dropdown',
          'heading' => __( 'Share Alignment', 'elston-core' ),
          'value' => array(
            __( 'Default', 'elston-core' ) => 'share-default',
            __( 'Center', 'elston-core' ) => 'share-center',
            __( 'Left', 'elston-core' ) => 'share-left',
            __( 'Right', 'elston-core' ) => 'share-right',
          ),
          'param_name' => 'share_alignment',
          'default' => 'share-default',
          'description' => __( 'Select Share Alignment.', 'elston-core' ),
          'dependency' => array(
            'element' => 'version',
            'value' => array('one','three','four','five'),
          ),
          'edit_field_class'   => 'vc_col-md-6 vc_column vt_field_space',
        ),

        VictorLib::elston_class(),

      )
    ) );
  }
}
