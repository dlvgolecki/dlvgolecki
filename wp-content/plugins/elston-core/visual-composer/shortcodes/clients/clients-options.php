<?php
/**
 * List - Shortcode Options
 */
add_action( 'init', 'elstn_clients_vc_map' );
if ( ! function_exists( 'elstn_clients_vc_map' ) ) {
  function elstn_clients_vc_map() {
    vc_map( array(
      "name" => __( "Clients", 'elston-core'),
      "base" => "elstn_clients",
      "description" => __( "Clients Image Slider Area/Block", 'elston-core'),
      "icon" => "fa fa-dribbble color-grey",
      "category" => VictorLib::elstn_cat_name(),
      "params" => array(

        array(
          "type"        =>'attach_images',
          "heading"     =>__('Clients Images', 'elston-core'),
          "param_name"  => 'images',
          "value"       => '',
          "description" => __( "Upload Clients Images.", "elston-core" )
        ),

        array(
          "type"        =>'textfield',
          "heading"     =>__('Limit', 'elston-core'),
          "param_name"  => 'item',
          "value"       => '',
          "description" => __( "Enter the number of items to show.", 'elston-core'),
          'edit_field_class'   => 'vc_col-md-6 vc_column vt_field_space',
        ),

        array(
          'type' => 'dropdown',
          'heading' => __( 'Item Loop?', 'elston-core' ),
          'value' => array(
            __('False', 'elston-core') => false,
            __('True', 'elston-core') => true,
          ),
          'param_name' => 'loop',
          "description" => __( "True will be repeted items on scroll.", 'elston-core'),
          'edit_field_class'   => 'vc_col-md-6 vc_column vt_field_space',
        ),
        VictorLib::elston_class(),

      )
    ) );
  }
}
