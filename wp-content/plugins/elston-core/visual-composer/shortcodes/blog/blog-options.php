<?php
/**
 * Blog - Shortcode Options
 */
add_action( 'init', 'elstn_blog_vc_map' );
if ( ! function_exists( 'elstn_blog_vc_map' ) ) {
  function elstn_blog_vc_map() {
    vc_map( array(
      "name" => __( "Blog", 'elston-core'),
      "base" => "elstn_blog",
      "description" => __( "Blog Styles", 'elston-core'),
      "icon" => "fa fa-newspaper-o color-red",
      "category" => VictorLib::elstn_cat_name(),
      "params" => array(

        array(
          'type' => 'dropdown',
          'heading' => __( 'Blog Style', 'elston-core' ),
          'value' => array(
            __( 'Select Blog Style', 'elston-core' ) => '',
            __( 'Grid', 'elston-core' ) => 'classic',
            __( 'Modern', 'elston-core' ) => 'modern',
          ),
          'admin_label' => true,
          'param_name' => 'blog_style',
          'description' => __( 'Select your blog style.', 'elston-core' ),
        ),
        array(
          "type"        => 'textfield',
          "heading"     => __('Limit', 'elston-core'),
          "param_name"  => "blog_limit",
          "value"       => "",
          'admin_label' => true,
          "description" => __( "Enter the number of items to show.", 'elston-core'),
        ),

        array(
    			"type"        => "notice",
    			"heading"     => __( "Meta's to Hide", 'elston-core' ),
    			"param_name"  => 'mts_opt',
    			'class'       => 'cs-warning',
    			'value'       => '',
    		),
        array(
          "type"        => 'switcher',
          "heading"     => __('Category', 'elston-core'),
          "param_name"  => "blog_category",
          "value"       => "",
          "std"         => false,
          'edit_field_class' => 'vc_col-md-6 vc_column vt_field_space',
        ),
        array(
          "type"        => 'switcher',
          "heading"     => __('Date', 'elston-core'),
          "param_name"  => "blog_date",
          "value"       => "",
          "std"         => false,
          'edit_field_class' => 'vc_col-md-6 vc_column vt_field_space',
        ),
        array(
          'type' => 'dropdown',
          'heading' => __( 'Order', 'elston-core' ),
          'value' => array(
            __('Select Blog Order', 'elston-core') => '',
            __('Asending', 'elston-core') => 'ASC',
            __('Desending', 'elston-core') => 'DESC',
          ),
          'param_name' => 'blog_order',
          'edit_field_class' => 'vc_col-md-6 vc_column vt_field_space',
        ),
        array(
          'type' => 'dropdown',
          'heading' => __( 'Order By', 'elston-core' ),
          'value' => array(
            __('None', 'elston-core') => 'none',
            __('ID', 'elston-core') => 'ID',
            __('Author', 'elston-core') => 'author',
            __('Title', 'elston-core') => 'title',
            __('Date', 'elston-core') => 'date',
          ),
          'param_name' => 'blog_orderby',
          'edit_field_class' => 'vc_col-md-6 vc_column vt_field_space',
        ),
        array(
          "type"        => 'textfield',
          "heading"     => __('Show only certain categories?', 'elston-core'),
          "param_name"  => "blog_show_category",
          "value"       => "",
          "description" => __( "Enter category SLUGS (comma separated) you want to display.", 'elston-core')
        ),
        array(
          "type"        => 'textfield',
          "heading"     => __('Read More Text', 'elston-core'),
          "param_name"  => "read_more_txt",
          "value"       => "",
          "description" => __( "Enter read more button text.", 'elston-core'),
          'dependency' => array(
            'element' => 'blog_style',
            'value' => array('classic'),
          ),
        ),
        array(
          "type"        => 'dropdown',
          "heading"     => __('Pagination', 'elston-core'),
          "param_name"  => "blog_pagination",
          'value' => array(
            __('None', 'elston-core') => 'none',
            __('Number Pagination', 'elston-core') => 'number',
            __('Ajax Pagination', 'elston-core') => 'ajax',
          ),
        ),
        array(
          "type"        => 'textfield',
          "heading"     => __('Pagination More Text', 'elston-core'),
          "param_name"  => "more_text",
          "value"       => "",
          "description" => __( "Enter ajax pagination button/link text.", 'elston-core'),
          'dependency' => array(
            'element' => 'blog_pagination',
            'value' => array('ajax'),
          ),
        ),
        array(
          "type"        => 'textfield',
          "heading"     => __('Loading Text', 'elston-core'),
          "param_name"  => "loading_text",
          "value"       => "",
          "description" => __( "Enter ajax pagination text while loading data.", 'elston-core'),
          'dependency' => array(
            'element' => 'blog_pagination',
            'value' => array('ajax'),
          ),
          'edit_field_class' => 'vc_col-md-6 vc_column vt_field_space',
        ),
        array(
          "type"        =>'textfield',
          "heading"     =>__('End Text', 'elston-core'),
          "param_name"  => "end_text",
          "value"       => "",
          "description" => __( "Enter ajax pagination text when no data remains.", 'elston-core'),
          'dependency' => array(
            'element' => 'blog_pagination',
            'value' => array('ajax'),
          ),
          'edit_field_class'   => 'vc_col-md-6 vc_column vt_field_space',
        ),

        VictorLib::elston_class(),

      )
    ) );
  }
}
