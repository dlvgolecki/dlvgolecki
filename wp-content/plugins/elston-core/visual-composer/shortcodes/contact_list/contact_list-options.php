<?php
/**
 * Contact List - Shortcode Options
 */
add_action( 'init', 'elstn_contact_list_vc_map' );
if ( ! function_exists( 'elstn_contact_list_vc_map' ) ) {
  function elstn_contact_list_vc_map() {
    vc_map( array(
      "name" => __( "Contact List", 'elston-core'),
      "base" => "elstn_contact_list",
      "description" => __( "Contact Info Block", 'elston-core'),
      "icon" => "fa fa-outdent color-slate-blue",
      "category" => VictorLib::elstn_cat_name(),
      "params" => array(
        array(
          "type"        =>'textfield',
          "heading"     =>__('Title of Contact Info', 'elston-core'),
          "param_name"  => 'contact_title',
          "value"       => '',
          "admin_label"       => true
        ),
        array(
          "type"        =>'textarea_html',
          "heading"     =>__('Details Contact Info', 'elston-core'),
          "param_name"  => 'content',
          "value"       => '',
        ),
        VictorLib::elston_class(),

      )
    ) );
  }
}
