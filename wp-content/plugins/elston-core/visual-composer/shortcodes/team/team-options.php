<?php
/**
 * Team - Shortcode Options
 */
add_action( 'init', 'elstn_team_vc_map' );
if ( ! function_exists( 'elstn_team_vc_map' ) ) {
  function elstn_team_vc_map() {
    vc_map( array(
      "name" => __( "Team Member", 'elston-core'),
      "base" => "elstn_team",
      "description" => __( "Team Area/Block", 'elston-core'),
      "icon" => "fa fa-users color-green",
      "category" => VictorLib::elstn_cat_name(),
      "params" => array(

        array(
          "type"        =>'textfield',
          "heading"     =>__('Limit', 'elston-core'),
          "param_name"  => "team_limit",
          "value"       => '',
          'admin_label' => true,
          "description" => __( "Enter the number of items to show.", 'elston-core'),
        ),

        array(
          'type' => 'dropdown',
          'heading' => __( 'Order', 'elston-core' ),
          'value' => array(
            __( 'Select Order', 'elston-core' ) => '',
            __('Asending', 'elston-core') => 'ASC',
            __('Desending', 'elston-core') => 'DESC',
          ),
          'param_name' => 'team_order',
          'admin_label' => true,
          'edit_field_class'   => 'vc_col-md-6 vc_column vt_field_space',
        ),

        array(
          'type' => 'dropdown',
          'heading' => __( 'Order By', 'elston-core' ),
          'value' => array(
            __('None', 'elston-core') => 'none',
            __('ID', 'elston-core') => 'ID',
            __('Title', 'elston-core') => 'title',
            __('Date', 'elston-core') => 'date',
          ),
          'param_name' => 'team_orderby',
          'admin_label' => true,
          'edit_field_class'   => 'vc_col-md-6 vc_column vt_field_space',
        ),

        array(
          "type"        =>'textfield',
          "heading"     =>__('Show Member by ID?', 'elston-core'),
          "param_name"  => "team_ids",
          "value"       => '',
          'admin_label' => true,
          "description" => __( "Enter comma seperated team member ID to show in a page. Ex: 1,3,5,6", 'elston-core'),
        ),

        VictorLib::elston_class(),

      )
    ) );
  }
}
