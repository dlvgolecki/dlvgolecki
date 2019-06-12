<?php
/**
 * Initialize the meta boxes. 
 */
add_action( 'admin_init', 'mega_custom_meta_boxes' );
function mega_custom_meta_boxes() {

  $portfolio_settings_meta_box = array(
    'id'          => 'portfolio_settings',
    'title'       => 'Portfolio Settings',
    'desc'        => '',
    'pages'       => array( 'portfolio' ),
    'context'     => 'normal',
    'priority'    => 'default',
    'fields'      => array(
      array(
        'label'       => 'Portfolio Item Background Color',
        'id'          => 'portfolio_highlight_background_color',
        'type'        => 'colorpicker-opacity',
        'desc'        => 'Choose a value for background color.',
        'std'         => '',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => ''
      ),
	  array(
        'label'       => 'Portfolio Item Text Color',
        'id'          => 'portfolio_highlight_text_color',
        'type'        => 'colorpicker',
        'desc'        => 'Choose a value for text color.',
        'std'         => '',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => ''
      ),
	  array(
        'label'       => 'Portfolio Custom URL',
        'id'          => 'portfolio_custom_url',
        'type'        => 'text',
        'desc'        => 'If you want to link the portfolio item to a custom URL, enter the URL here.',
        'std'         => '',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => ''
      ),
  	)
  );
  ot_register_meta_box( $portfolio_settings_meta_box );

}