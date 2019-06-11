<?php
/**
 * Social List Icon - Shortcode Options
 */
add_action( 'init', 'elstn_social_list_icons_vc_map' );
if ( ! function_exists( 'elstn_social_list_icons_vc_map' ) ) {
  function elstn_social_list_icons_vc_map() {
    vc_map( array(
      "name" => __( "Social Lists", 'elston-core'),
      "base" => "elstn_social_list_icons",
      "description" => __( "Social List Icons Area/Block", 'elston-core'),
      "icon" => "fa fa-adn color-pink",
      "category" => VictorLib::elstn_cat_name(),
      "params" => array(
        array(
          'type' => 'param_group',
          'value' => '',
          'heading' => __( 'Social Profile Lists', 'elston-core' ),
          'param_name' => 'list_items',
          // Note params is mapped inside param-group:
          'params' => array(
            array(
              'type' => 'vt_icon',
              'value' => '',
              'heading' => __( 'Select Icon', 'elston-core' ),
              'param_name' => 'select_icon',
            ),
            array(
              'type' => 'href',
              'value' => '',
              'heading' => __( 'Social Profile Link', 'elston-core' ),
              'param_name' => 'link',
              'admin_label' => true,
            ),

          )
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
        VictorLib::elston_class(),
        // Styling
        array(
          "type" => "colorpicker",
          "heading" => __( "Icon Color", 'elston-core' ),
          "param_name" => "text_color",
          'value' => '',
          'admin_label' => true,
          "group" => __( "Styling", 'elston-core'),
          'edit_field_class'  => 'vc_col-md-6 vc_column vt_field_space',
        ),
        array(
          "type" => "colorpicker",
          "heading" => __( "Icon Hover Color", 'elston-core' ),
          "param_name" => "text_hover_color",
          'value' => '',
          "group" => __( "Styling", 'elston-core'),
          'edit_field_class'  => 'vc_col-md-6 vc_column vt_field_space',
        ),
      )
    ) );
  }
}
