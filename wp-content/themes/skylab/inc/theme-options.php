<?php
/**
 * Initialize the custom theme options.
 */
add_action( 'init', 'custom_theme_options' );

/**
 * Build the custom settings & update OptionTree.
 */
function custom_theme_options() {
  
  /* OptionTree is not loaded yet, or this is not an admin request */
  if ( ! function_exists( 'ot_settings_id' ) || ! is_admin() )
    return false;
    
  /**
   * Get a copy of the saved settings array. 
   */
  $saved_settings = get_option( ot_settings_id(), array() );
  
  /**
   * Custom settings array that will eventually be 
   * passes to the OptionTree Settings API Class.
   */
  $custom_settings = array( 
    'contextual_help' => array( 
      'sidebar'       => ''
    ),
    'sections'        => array( 
      array(
        'id'          => 'general',
        'title'       => __( 'General', 'skylab' )
      ),
      array(
        'id'          => 'typography',
        'title'       => __( 'Typography', 'skylab' )
      ),
      array(
        'id'          => 'header',
        'title'       => __( 'Header', 'skylab' )
      ),
      array(
        'id'          => 'secondary_menu',
        'title'       => __( 'Secondary Menu', 'skylab' )
      ),
      array(
        'id'          => 'top_bar',
        'title'       => __( 'Top Bar', 'skylab' )
      ),
      array(
        'id'          => 'footer',
        'title'       => __( 'Footer', 'skylab' )
      ),
      array(
        'id'          => 'portfolio_settings',
        'title'       => __( 'Portfolio Settings', 'skylab' )
      ),
	  array(
        'id'          => 'blog_settings',
        'title'       => __( 'Blog Settings', 'skylab' )
      ),
      array(
        'id'          => 'social',
        'title'       => __( 'Social Links', 'skylab' )
      ),
      array(
        'id'          => 'woocommerce',
        'title'       => __( 'WooCommerce', 'skylab' )
      )
    ),
    'settings'        => array(
	  array(
        'id'          => 'logo_font_size',
        'label'       => __( 'Logo Font Size', 'skylab' ),
        'desc'        => __( 'Choose a value for logo font size in pixels. Default value is 24.', 'skylab' ),
        'std'         => '24',
        'type'        => 'numeric-slider',
        'section'     => 'general',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '10,40,1',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'logo_text_transform',
        'label'       => __( 'Logo Text Transform', 'skylab' ),
        'desc'        => '',
        'std'         => '',
        'type'        => 'select',
        'section'     => 'general',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and',
        'choices'     => array( 
          array(
            'value'       => 'none',
            'label'       => __( 'None', 'skylab' ),
            'src'         => ''
          ),
          array(
            'value'       => 'uppercase',
            'label'       => __( 'Uppercase', 'skylab' ),
            'src'         => ''
          ),
		  array(
            'value'       => 'lowercase',
            'label'       => __( 'Lowercase', 'skylab' ),
            'src'         => ''
          )
        )
      ),
	  array(
        'id'          => 'logo_font_weight',
        'label'       => esc_html__( 'Logo Font Weight', 'skylab' ),
        'desc'        => '',
        'std'         => '700',
        'type'        => 'select',
        'section'     => 'general',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and',
        'choices'     => array(
		  array(
            'value'       => '100',
            'label'       => '100',
            'src'         => ''
          ),
		  array(
            'value'       => '200',
            'label'       => '200',
            'src'         => ''
          ),
		  array(
            'value'       => '300',
            'label'       => '300',
            'src'         => ''
          ),
          array(
            'value'       => '400',
            'label'       => '400',
            'src'         => ''
          ),
		  array(
            'value'       => '500',
            'label'       => '500',
            'src'         => ''
          ),
		  array(
            'value'       => '600',
            'label'       => '600',
            'src'         => ''
          ),
          array(
            'value'       => '700',
            'label'       => '700',
            'src'         => ''
          ),
		  array(
            'value'       => '800',
            'label'       => '800',
            'src'         => ''
          ),
		  array(
            'value'       => '900',
            'label'       => '900',
            'src'         => ''
          )
        )
      ),
      array(
        'id'          => 'logo_letter_spacing',
        'label'       => __( 'Logo Letter Spacing', 'skylab' ),
        'desc'        => __( 'Choose a value for logo letter spacing in pixels. Default value is 0.', 'skylab' ),
        'std'         => '0',
        'type'        => 'numeric-slider',
        'section'     => 'general',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '0,10,.5',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
	  array(
        'id'          => 'logo_font_style',
        'label'       => esc_html__( 'Logo Font Style', 'skylab' ),
        'desc'        => '',
        'std'         => '',
        'type'        => 'select',
        'section'     => 'general',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and',
        'choices'     => array( 
          array(
            'value'       => 'normal',
            'label'       => esc_html__( 'Normal', 'skylab' ),
            'src'         => ''
          ),
          array(
            'value'       => 'italic',
            'label'       => esc_html__( 'Italic', 'skylab' ),
            'src'         => ''
          )
        )
      ),
      array(
        'id'          => 'logo',
        'label'       => __( 'Logo', 'skylab' ),
        'desc'        => __( 'Upload a logo for your site.', 'skylab' ),
        'std'         => '',
        'type'        => 'upload',
        'section'     => 'general',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'logo_for_transparent_header',
        'label'       => __( 'Logo for Transparent Header', 'skylab' ),
        'desc'        => __( 'Upload a logo for transparent header for your site.', 'skylab' ),
        'std'         => '',
        'type'        => 'upload',
        'section'     => 'general',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'height_for_logo',
        'label'       => __( 'Height for Logo', 'skylab' ),
        'desc'        => __( 'Choose a value for the logos height in pixels. Default height is 18.', 'skylab' ),
        'std'         => '18',
        'type'        => 'numeric-slider',
        'section'     => 'general',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '15,60,1',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
	  array(
        'id'          => 'logo_image_and_logo_text_together',
        'label'       => __( 'Use logo image and logo text together', 'skylab' ),
        'desc'        => '',
        'std'         => '',
        'type'        => 'checkbox',
        'section'     => 'general',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and',
        'choices'     => array( 
          array(
            'value'       => 'yes',
            'label'       => __( 'Use logo image and logo text together', 'skylab' ),
            'src'         => ''
          )
        )
      ),
      array(
        'id'          => 'accent_color',
        'label'       => __( 'Accent Color', 'skylab' ),
        'desc'        => __( 'Choose a accent color for your site. Default value is #000000.', 'skylab' ),
        'std'         => '#000000',
        'type'        => 'colorpicker',
        'section'     => 'general',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
	  array(
        'id'          => 'body_color',
        'label'       => __( 'Body Color', 'skylab' ),
        'desc'        => __( 'Choose a body color for your site. Default value is #ffffff.', 'skylab' ),
        'std'         => '#ffffff',
        'type'        => 'colorpicker',
        'section'     => 'general',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
	  array(
        'id'          => 'primary_color',
        'label'       => __( 'Primary Color', 'skylab' ),
        'desc'        => __( 'Choose a primary color for your site. Default value is #999999.', 'skylab' ),
        'std'         => '#000000',
        'type'        => 'colorpicker',
        'section'     => 'general',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'secondary_color',
        'label'       => __( 'Secondary Color', 'skylab' ),
        'desc'        => __( 'Choose a secondary color for your site. Default value is #999999.', 'skylab' ),
        'std'         => '#999999',
        'type'        => 'colorpicker',
        'section'     => 'general',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
	  array(
        'id'          => 'third_color',
        'label'       => __( 'Third Color', 'skylab' ),
        'desc'        => __( 'Choose a third color for your site. Default value is #f2f2f2.', 'skylab' ),
        'std'         => '#f2f2f2',
        'type'        => 'colorpicker',
        'section'     => 'general',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
	  array(
        'id'          => 'borders_color',
        'label'       => __( 'Borders Color', 'skylab' ),
        'desc'        => __( 'Choose a borders color for your site. Default value is #e6e6e6.', 'skylab' ),
        'std'         => '#e6e6e6',
        'type'        => 'colorpicker',
        'section'     => 'general',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
	  array(
        'id'          => 'links_color',
        'label'       => __( 'Links Color', 'skylab' ),
        'desc'        => __( 'Choose a links color for your site. Default value is #000000.', 'skylab' ),
        'std'         => '#000000',
        'type'        => 'colorpicker',
        'section'     => 'general',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
	   array(
        'id'          => 'links_color_hover',
        'label'       => __( 'Links Color - Hover/Active', 'skylab' ),
        'desc'        => __( 'Choose a links color - hover/active for your site. Default value is #000000.', 'skylab' ),
        'std'         => '#000000',
        'type'        => 'colorpicker',
        'section'     => 'general',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'disable_right_click',
        'label'       => __( 'Disable Right Click for images', 'skylab' ),
        'desc'        => '',
        'std'         => '',
        'type'        => 'checkbox',
        'section'     => 'general',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and',
        'choices'     => array( 
          array(
            'value'       => 'yes',
            'label'       => __( 'Disable Right Click', 'skylab' ),
            'src'         => ''
          )
        )
      ),
      array(
        'id'          => 'page_load_progress_bar',
        'label'       => __( 'Page Load Progress Bar', 'skylab' ),
        'desc'        => '',
        'std'         => '',
        'type'        => 'select',
        'section'     => 'general',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and',
        'choices'     => array( 
          array(
            'value'       => 'enabled',
            'label'       => __( 'Enabled', 'skylab' ),
            'src'         => ''
          ),
          array(
            'value'       => 'disabled',
            'label'       => __( 'Disabled', 'skylab' ),
            'src'         => ''
          )
        )
      ),
	  array(
        'id'          => 'page_load_progress_bar_color',
        'label'       => __( 'Page load progress bar color', 'skylab' ),
        'desc'        => __( 'Choose a page load progress bar color for your site. Default value is #000000.', 'skylab' ),
        'std'         => '#000000',
        'type'        => 'colorpicker',
        'section'     => 'general',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'mobile_menu_position',
        'label'       => __( 'Mobile Menu Position', 'skylab' ),
        'desc'        => '',
        'std'         => '',
        'type'        => 'select',
        'section'     => 'general',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and',
        'choices'     => array( 
          array(
            'value'       => 'left',
            'label'       => __( 'Left', 'skylab' ),
            'src'         => ''
          ),
          array(
            'value'       => 'right',
            'label'       => __( 'Right', 'skylab' ),
            'src'         => ''
          )
        )
      ),
	  array(
        'id'          => 'logo_google_font_family',
        'label'       => __( 'Google Web Font Code for Logo Typography', 'skylab' ),
        'desc'        => __( '<p class="warning">Paste Google Web Font link for logo to your website.</p><p><b>Read more:</b> <a href="https://fonts.google.com/" target="_blank"><code>https://fonts.google.com/</code></a></p> </b><p><b>Example:</b> <code>https://fonts.googleapis.com/css?family=Lato:700</code></p>', 'skylab' ),
        'std'         => '',
        'type'        => 'text',
        'section'     => 'typography',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
	  array(
        'id'          => 'logo_google_font_name',
        'label'       => __( 'Google Web Font Name for Logo Typography', 'skylab' ),
        'desc'        => __( '<p>Enter the Google Web Font name for logo typography.</p>
<p><b>Example:</b> <code>Lato</code></p>', 'skylab' ),
        'std'         => '',
        'type'        => 'text',
        'section'     => 'typography',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
	  ),
      array(
        'id'          => 'primary_typography',
        'label'       => __( 'Primary Typography', 'skylab' ),
        'desc'        => __( 'The Primary Typography option type is for adding typographic styles to your site. The most important one though is Google Fonts to create custom font stacks.', 'skylab' ),
        'std'         => '',
        'type'        => 'typography',
        'section'     => 'typography',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'google_font_family',
        'label'       => __( 'Google Web Font Code for Primary Typography', 'skylab' ),
        'desc'        => __( '<p class="warning">Paste Google Web Font link to your website.</p><p><b>Read more:</b> <a href="https://fonts.google.com/" target="_blank"><code>https://fonts.google.com/</code></a></p> </b><p><b>Example:</b> <code>https://fonts.googleapis.com/css?family=Lato:400,400i,700,900</code></p>', 'skylab' ),
        'std'         => 'https://fonts.googleapis.com/css?family=Lato:400,400i,700,700i',
        'type'        => 'text',
        'section'     => 'typography',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'google_font_name',
        'label'       => __( 'Google Web Font Name for Primary Typography', 'skylab' ),
        'desc'        => __( '<p>Enter the Google Web Font name for primary typography.</p>
<p><b>Example:</b> <code>Lato</code></p>', 'skylab' ),
        'std'         => 'Lato',
        'type'        => 'text',
        'section'     => 'typography',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'menu_typography',
        'label'       => __( 'Menu Typography', 'skylab' ),
        'desc'        => __( 'The Menu Typography option type is for adding typographic styles for menu to your site. The most important one though is Google Fonts to create custom font stacks.', 'skylab' ),
        'std'         => '',
        'type'        => 'typography',
        'section'     => 'typography',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'menu_google_font_family',
        'label'       => __( 'Google Web Font Code for Menu Typography', 'skylab' ),
        'desc'        => __( '<p class="warning">Paste Google Web Font link for menu to your website.</p><p><b>Read more:</b> <a href="https://fonts.google.com/" target="_blank"><code>https://fonts.google.com/</code></a></p> </b><p><b>Example:</b> <code>https://fonts.googleapis.com/css?family=Lato:400,300</code></p>', 'skylab' ),
        'std'         => 'https://fonts.googleapis.com/css?family=Lato:400,300',
        'type'        => 'text',
        'section'     => 'typography',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'menu_google_font_name',
        'label'       => __( 'Google Web Font Name for Menu Typography', 'skylab' ),
        'desc'        => __( '<p>Enter the Google Web Font name for menu typography.</p>
<p><b>Example:</b> <code>Lato</code></p>', 'skylab' ),
        'std'         => 'Lato',
        'type'        => 'text',
        'section'     => 'typography',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'menu_font_size',
        'label'       => __( 'Menu Font Size', 'skylab' ),
        'desc'        => __( 'Choose a value for menu font size in pixels. Default value is 16.', 'skylab' ),
        'std'         => '16',
        'type'        => 'numeric-slider',
        'section'     => 'typography',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '10,30,1',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
	   array(
        'id'          => 'secondary_header_menu_font_size',
        'label'       => __( 'Secondary Menu in Header Font Size', 'skylab' ),
        'desc'        => __( 'Choose a value for secondary menu in header font size in pixels. Default value is 16.', 'skylab' ),
        'std'         => '16',
        'type'        => 'numeric-slider',
        'section'     => 'typography',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '10,30,1',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'menu_text_transform',
        'label'       => __( 'Menu Text Transform', 'skylab' ),
        'desc'        => '',
        'std'         => '',
        'type'        => 'select',
        'section'     => 'typography',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and',
        'choices'     => array( 
          array(
            'value'       => 'none',
            'label'       => __( 'None', 'skylab' ),
            'src'         => ''
          ),
          array(
            'value'       => 'uppercase',
            'label'       => __( 'Uppercase', 'skylab' ),
            'src'         => ''
          ),
		  array(
            'value'       => 'lowercase',
            'label'       => __( 'Lowercase', 'skylab' ),
            'src'         => ''
          )
        )
      ),
	  array(
        'id'          => 'secondary_header_menu_text_transform',
        'label'       => __( 'Secondary Menu in Header Text Transform', 'skylab' ),
        'desc'        => '',
        'std'         => '',
        'type'        => 'select',
        'section'     => 'typography',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and',
        'choices'     => array( 
          array(
            'value'       => 'none',
            'label'       => __( 'None', 'skylab' ),
            'src'         => ''
          ),
          array(
            'value'       => 'uppercase',
            'label'       => __( 'Uppercase', 'skylab' ),
            'src'         => ''
          ),
		  array(
            'value'       => 'lowercase',
            'label'       => __( 'Lowercase', 'skylab' ),
            'src'         => ''
          )
        )
      ),
	  array(
        'id'          => 'menu_font_weight',
        'label'       => esc_html__( 'Menu Font Weight', 'skylab' ),
        'desc'        => '',
        'std'         => '400',
        'type'        => 'select',
        'section'     => 'typography',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and',
        'choices'     => array(
		  array(
            'value'       => '100',
            'label'       => '100',
            'src'         => ''
          ),
		  array(
            'value'       => '200',
            'label'       => '200',
            'src'         => ''
          ),
		  array(
            'value'       => '300',
            'label'       => '300',
            'src'         => ''
          ),
          array(
            'value'       => '400',
            'label'       => '400',
            'src'         => ''
          ),
		  array(
            'value'       => '500',
            'label'       => '500',
            'src'         => ''
          ),
		  array(
            'value'       => '600',
            'label'       => '600',
            'src'         => ''
          ),
          array(
            'value'       => '700',
            'label'       => '700',
            'src'         => ''
          ),
		  array(
            'value'       => '800',
            'label'       => '800',
            'src'         => ''
          ),
		   array(
            'value'       => '900',
            'label'       => '900',
            'src'         => ''
          )
        )
      ),
	  array(
        'id'          => 'secondary_header_menu_font_weight',
        'label'       => esc_html__( 'Secondary Menu in Header Font Weight', 'skylab' ),
        'desc'        => '',
        'std'         => '400',
        'type'        => 'select',
        'section'     => 'typography',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and',
        'choices'     => array(
		  array(
            'value'       => '100',
            'label'       => '100',
            'src'         => ''
          ),
		  array(
            'value'       => '200',
            'label'       => '200',
            'src'         => ''
          ),
		  array(
            'value'       => '300',
            'label'       => '300',
            'src'         => ''
          ),
          array(
            'value'       => '400',
            'label'       => '400',
            'src'         => ''
          ),
		  array(
            'value'       => '500',
            'label'       => '500',
            'src'         => ''
          ),
		  array(
            'value'       => '600',
            'label'       => '600',
            'src'         => ''
          ),
          array(
            'value'       => '700',
            'label'       => '700',
            'src'         => ''
          ),
		  array(
            'value'       => '800',
            'label'       => '800',
            'src'         => ''
          ),
		   array(
            'value'       => '900',
            'label'       => '900',
            'src'         => ''
          )
        )
      ),
      array(
        'id'          => 'menu_letter_spacing',
        'label'       => __( 'Menu Letter Spacing', 'skylab' ),
        'desc'        => __( 'Choose a value for menu letter spacing in pixels. Default value is 0.', 'skylab' ),
        'std'         => '0',
        'type'        => 'numeric-slider',
        'section'     => 'typography',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '0,10,.5',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
	  array(
        'id'          => 'secondary_header_menu_letter_spacing',
        'label'       => __( 'Secondary Menu in Header Letter Spacing', 'skylab' ),
        'desc'        => __( 'Choose a value for secondary menu in header letter spacing in pixels. Default value is 0.', 'skylab' ),
        'std'         => '0',
        'type'        => 'numeric-slider',
        'section'     => 'typography',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '0,10,.5',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
	  array(
        'id'          => 'menu_font_style',
        'label'       => esc_html__( 'Menu Font Style', 'skylab' ),
        'desc'        => '',
        'std'         => '',
        'type'        => 'select',
        'section'     => 'typography',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and',
        'choices'     => array( 
          array(
            'value'       => 'normal',
            'label'       => esc_html__( 'Normal', 'skylab' ),
            'src'         => ''
          ),
          array(
            'value'       => 'italic',
            'label'       => esc_html__( 'Italic', 'skylab' ),
            'src'         => ''
          )
        )
      ),
	  array(
        'id'          => 'secondary_header_menu_font_style',
        'label'       => esc_html__( 'Secondary Menu in Header Font Style', 'skylab' ),
        'desc'        => '',
        'std'         => '',
        'type'        => 'select',
        'section'     => 'typography',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and',
        'choices'     => array( 
          array(
            'value'       => 'normal',
            'label'       => esc_html__( 'Normal', 'skylab' ),
            'src'         => ''
          ),
          array(
            'value'       => 'italic',
            'label'       => esc_html__( 'Italic', 'skylab' ),
            'src'         => ''
          )
        )
      ),
	  array(
        'id'          => 'menu_text_decoration_hover',
        'label'       => esc_html__( 'Menu Text Decoration - Hover/Active', 'skylab' ),
        'desc'        => '',
        'std'         => '',
        'type'        => 'select',
        'section'     => 'typography',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and',
        'choices'     => array( 
          array(
            'value'       => 'underline',
            'label'       => esc_html__( 'Underline', 'skylab' ),
            'src'         => ''
          ),
          array(
            'value'       => 'none',
            'label'       => esc_html__( 'None', 'skylab' ),
            'src'         => ''
          )
        )
      ),
      array(
        'id'          => 'heading_typography',
        'label'       => __( 'Heading Typography', 'skylab' ),
        'desc'        => __( 'The Heading Typography option type is for adding typographic styles for headings to your site. The most important one though is Google Fonts to create custom font stacks.', 'skylab' ),
        'std'         => '',
        'type'        => 'typography',
        'section'     => 'typography',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'heading_google_font_family',
        'label'       => __( 'Google Web Font Code for Heading Typography', 'skylab' ),
        'desc'        => __( '<p class="warning">Paste Google Web Font link for headings to your website.</p><p><b>Read more:</b> <a href="https://fonts.google.com/" target="_blank"><code>https://fonts.google.com/</code></a></p> </b><p><b>Example:</b> <code>https://fonts.googleapis.com/css?family=Lato:700</code></p>', 'skylab' ),
        'std'         => 'https://fonts.googleapis.com/css?family=Lato:700',
        'type'        => 'text',
        'section'     => 'typography',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'heading_google_font_name',
        'label'       => __( 'Google Web Font Name for Heading Typography', 'skylab' ),
        'desc'        => __( '<p>Enter the Google Web Font name for heading typography.</p>
<p><b>Example:</b> <code>Lato</code></p>', 'skylab' ),
        'std'         => 'Lato',
        'type'        => 'text',
        'section'     => 'typography',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
	  array(
        'id'          => 'body_font_size',
        'label'       => __( 'Body Font Size', 'skylab' ),
        'desc'        => __( 'Choose a value for body font size in pixels. Default value is 16.', 'skylab' ),
        'std'         => '16',
        'type'        => 'numeric-slider',
        'section'     => 'typography',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '14,22,1',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
	  array(
        'id'          => 'heading_font_weight',
        'label'       => esc_html__( 'Heading Font Weight', 'skylab' ),
        'desc'        => '',
        'std'         => '700',
        'type'        => 'select',
        'section'     => 'typography',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and',
        'choices'     => array(
		  array(
            'value'       => '100',
            'label'       => '100',
            'src'         => ''
          ),
		  array(
            'value'       => '200',
            'label'       => '200',
            'src'         => ''
          ),
		  array(
            'value'       => '300',
            'label'       => '300',
            'src'         => ''
          ),
          array(
            'value'       => '400',
            'label'       => '400',
            'src'         => ''
          ),
		  array(
            'value'       => '500',
            'label'       => '500',
            'src'         => ''
          ),
		  array(
            'value'       => '600',
            'label'       => '600',
            'src'         => ''
          ),
          array(
            'value'       => '700',
            'label'       => '700',
            'src'         => ''
          ),
		  array(
            'value'       => '800',
            'label'       => '800',
            'src'         => ''
          ),
		   array(
            'value'       => '900',
            'label'       => '900',
            'src'         => ''
          )
        )
      ),
	  array(
        'id'          => 'links_text_decoration',
        'label'       => esc_html__( 'Links Text Decoration', 'skylab' ),
        'desc'        => '',
        'std'         => '',
        'type'        => 'select',
        'section'     => 'typography',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and',
        'choices'     => array( 
          array(
            'value'       => 'underline',
            'label'       => esc_html__( 'Underline', 'skylab' ),
            'src'         => ''
          ),
          array(
            'value'       => 'none',
            'label'       => esc_html__( 'None', 'skylab' ),
            'src'         => ''
          )
        )
      ),
	  array(
        'id'          => 'links_font_style',
        'label'       => esc_html__( 'Links Font Style', 'skylab' ),
        'desc'        => '',
        'std'         => '',
        'type'        => 'select',
        'section'     => 'typography',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and',
        'choices'     => array( 
          array(
            'value'       => 'italic',
            'label'       => esc_html__( 'Italic', 'skylab' ),
            'src'         => ''
          ),
		  array(
            'value'       => 'normal',
            'label'       => esc_html__( 'Normal', 'skylab' ),
            'src'         => ''
          )
        )
      ),
      array(
        'id'          => 'header_style',
        'label'       => __( 'Header Style', 'skylab' ),
        'desc'        => '',
        'std'         => '',
        'type'        => 'select',
        'section'     => 'header',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and',
        'choices'     => array( 
		  array(
            'value'       => 'non_fixed',
            'label'       => __( 'Non-Fixed', 'skylab' ),
            'src'         => ''
          ),
          array(
            'value'       => 'fixed',
            'label'       => __( 'Fixed', 'skylab' ),
            'src'         => ''
          ),
		  array(
            'value'       => 'fixed-on-scroll',
            'label'       => __( 'Fixed on Scroll', 'skylab' ),
            'src'         => ''
          ),
        )
      ),
      array(
        'id'          => 'header_height_reduction_scrolling',
        'label'       => __( 'Header height reduction on scrolling', 'skylab' ),
        'desc'        => __( 'Note: Fixed header style must be enabled.', 'skylab' ),
        'std'         => '',
        'type'        => 'select',
        'section'     => 'header',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and',
        'choices'     => array( 
          array(
            'value'       => 'disable',
            'label'       => __( 'Disable', 'skylab' ),
            'src'         => ''
          ),
          array(
            'value'       => 'enable',
            'label'       => __( 'Enable', 'skylab' ),
            'src'         => ''
          )
        )
      ),
      array(
        'id'          => 'header_height',
        'label'       => __( 'Header Height (Width)', 'skylab' ),
        'desc'        => __( 'Choose a value for header height (width) in pixels. Default value is 64. Note: to adjust header width "Left" or "Right" value for "Header Position" option must be enabled.', 'skylab' ),
        'std'         => '64',
        'type'        => 'numeric-slider',
        'section'     => 'header',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '50,310,1',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
	  array(
        'id'          => 'header_height_on_scrolling',
        'label'       => esc_html__( 'Header Height on Scrolling', 'skylab' ),
        'desc'        => esc_html__( 'Choose a value for header height on scrolling in pixels. Default value is 74. Note: "Header Height Reduction on Scrolling" option must be enabled.', 'skylab' ),
        'std'         => '54',
        'type'        => 'numeric-slider',
        'section'     => 'header',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '40,180,1',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'enable_full_width_for_header',
        'label'       => __( 'Enable Full Width for Header', 'skylab' ),
        'desc'        => '',
        'std'         => '',
        'type'        => 'checkbox',
        'section'     => 'header',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and',
        'choices'     => array( 
          array(
            'value'       => 'yes',
            'label'       => __( 'Enable Full Width for Header', 'skylab' ),
            'src'         => ''
          )
        )
      ),
	  array(
        'id'          => 'header_position',
        'label'       => __( 'Header Position', 'skylab' ),
        'desc'        => '',
        'std'         => '',
        'type'        => 'select',
        'section'     => 'header',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and',
        'choices'     => array( 
		  array(
            'value'       => 'top',
            'label'       => __( 'Top', 'skylab' ),
            'src'         => ''
          ),
		  array(
            'value'       => 'left',
            'label'       => __( 'Left', 'skylab' ),
            'src'         => ''
          ),
          array(
            'value'       => 'bottom',
            'label'       => __( 'Bottom', 'skylab' ),
            'src'         => ''
          ),
		  array(
            'value'       => 'right',
            'label'       => __( 'Right', 'skylab' ),
            'src'         => ''
          ),
        )
      ),
	  array(
        'id'          => 'padding_for_left_right_header',
        'label'       => __( 'Right/Left Padding for Left/Right Header', 'skylab' ),
        'desc'        => '',
        'std'         => '',
        'type'        => 'select',
        'section'     => 'header',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and',
        'choices'     => array( 
		  array(
            'value'       => 'enabled',
            'label'       => __( 'Enable', 'skylab' ),
            'src'         => ''
          ),
		  array(
            'value'       => 'disabled',
            'label'       => __( 'Disable', 'skylab' ),
            'src'         => ''
          ),
        )
      ),
	  array(
        'id'          => 'center_content_horizontally_for_left_right_header',
        'label'       => __( 'Center Content Horizontally for Left/Right Header', 'skylab' ),
        'desc'        => '',
        'std'         => '',
        'type'        => 'select',
        'section'     => 'header',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and',
        'choices'     => array( 
		  array(
            'value'       => 'disabled',
            'label'       => __( 'Disable', 'skylab' ),
            'src'         => ''
          ),
		  array(
            'value'       => 'enabled',
            'label'       => __( 'Enable', 'skylab' ),
            'src'         => ''
          ),
        )
      ),
	  array(
        'id'          => 'logo_caption',
        'label'       => __( 'Logo Caption', 'skylab' ),
        'desc'        => __( 'Enter the logo caption you would like to display in header of your site.', 'skylab' ),
        'std'         => '',
        'type'        => 'text',
        'section'     => 'header',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'enable_button',
        'label'       => __( 'Enable Button', 'skylab' ),
        'desc'        => '',
        'std'         => '',
        'type'        => 'checkbox',
        'section'     => 'header',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and',
        'choices'     => array( 
          array(
            'value'       => 'yes',
            'label'       => __( 'Enable Button', 'skylab' ),
            'src'         => ''
          )
        )
      ),
      array(
        'id'          => 'button_url',
        'label'       => __( 'Button URL', 'skylab' ),
        'desc'        => __( 'Enter a URL for button.', 'skylab' ),
        'std'         => '',
        'type'        => 'text',
        'section'     => 'header',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'button_text',
        'label'       => __( 'Button Text', 'skylab' ),
        'desc'        => __( 'Enter a text for button.', 'skylab' ),
        'std'         => '',
        'type'        => 'text',
        'section'     => 'header',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'social_icons_position',
        'label'       => __( 'Social Icons Position', 'skylab' ),
        'desc'        => '',
        'std'         => '',
        'type'        => 'select',
        'section'     => 'header',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and',
        'choices'     => array( 
          array(
            'value'       => 'none',
            'label'       => __( 'None', 'skylab' ),
            'src'         => ''
          ),
          array(
            'value'       => 'top_bar',
            'label'       => __( 'Top Bar', 'skylab' ),
            'src'         => ''
          ),
          array(
            'value'       => 'header',
            'label'       => __( 'Header', 'skylab' ),
            'src'         => ''
          )
        )
      ),
      array(
        'id'          => 'search_header_position',
        'label'       => __( 'Search Position', 'skylab' ),
        'desc'        => '',
        'std'         => '',
        'type'        => 'select',
        'section'     => 'header',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and',
        'choices'     => array( 
		  array(
            'value'       => 'none',
            'label'       => __( 'None', 'skylab' ),
            'src'         => ''
          ),
          array(
            'value'       => 'header',
            'label'       => __( 'Header', 'skylab' ),
            'src'         => ''
          ),
          array(
            'value'       => 'top_bar',
            'label'       => __( 'Top Bar', 'skylab' ),
            'src'         => ''
          )
        )
      ),
      array(
        'id'          => 'header_info',
        'label'       => __( 'Header Info', 'skylab' ),
        'desc'        => __( 'Enter the info you would like to display in header of your site.', 'skylab' ),
        'std'         => '',
        'type'        => 'textarea',
        'section'     => 'header',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'woocommerce_cart_position',
        'label'       => __( 'WooCommerce Cart Position', 'skylab' ),
        'desc'        => '',
        'std'         => '',
        'type'        => 'select',
        'section'     => 'header',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and',
        'choices'     => array( 
          array(
            'value'       => 'none',
            'label'       => __( 'None', 'skylab' ),
            'src'         => ''
          ),
          array(
            'value'       => 'top_bar',
            'label'       => __( 'Top Bar', 'skylab' ),
            'src'         => ''
          ),
          array(
            'value'       => 'header',
            'label'       => __( 'Header', 'skylab' ),
            'src'         => ''
          )
        )
      ),
      array(
        'id'          => 'enable_wpml_language_switcher',
        'label'       => __( 'Enable WPML Language switcher', 'skylab' ),
        'desc'        => __( 'Enable WPML Language switcher. Note: WPML (<a href="http://wpml.org/" target="_blank">http://wpml.org/</a>) plugin must be installed.', 'skylab' ),
        'std'         => '',
        'type'        => 'checkbox',
        'section'     => 'header',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and',
        'choices'     => array( 
          array(
            'value'       => 'yes',
            'label'       => __( 'Enable WPML Language switcher', 'skylab' ),
            'src'         => ''
          )
        )
      ),
      array(
        'id'          => 'header_background_color',
        'label'       => __( 'Header Background Color', 'skylab' ),
        'desc'        => __( 'Choose a value for header background color. Default value is #ffffff.', 'skylab' ),
        'std'         => '#ffffff',
        'type'        => 'colorpicker',
        'section'     => 'header',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'navigation_link_color',
        'label'       => __( 'Navigation Link Color', 'skylab' ),
        'desc'        => __( 'Choose a value for navigation link color. Default value is #000000.', 'skylab' ),
        'std'         => '#000000',
        'type'        => 'colorpicker',
        'section'     => 'header',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
	  array(
        'id'          => 'secondary_header_menu_navigation_link_color',
        'label'       => __( 'Secondary Menu in Header Navigation Link Color', 'skylab' ),
        'desc'        => __( 'Choose a value for secondary menu in header navigation link color. Default value is #000000.', 'skylab' ),
        'std'         => '#000000',
        'type'        => 'colorpicker',
        'section'     => 'header',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'navigation_link_color_hover',
        'label'       => __( 'Navigation Link Color - Hover/Active', 'skylab' ),
        'desc'        => __( 'Choose a value for navigation link color - hover/active. Default value is #000000.', 'skylab' ),
        'std'         => '#000000',
        'type'        => 'colorpicker',
        'section'     => 'header',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
	  array(
        'id'          => 'secondary_header_menu_navigation_link_color_hover',
        'label'       => __( 'Secondary Menu in Header Navigation Link Color - Hover/Active', 'skylab' ),
        'desc'        => __( 'Choose a value for secondary menu in header navigation link color - hover/active. Default value is #000000.', 'skylab' ),
        'std'         => '#000000',
        'type'        => 'colorpicker',
        'section'     => 'header',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'header_text_color',
        'label'       => __( 'Header Text Color', 'skylab' ),
        'desc'        => __( 'Choose a value for header text color. Default value is #000000.', 'skylab' ),
        'std'         => '#000000',
        'type'        => 'colorpicker',
        'section'     => 'header',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
	  array(
        'id'          => 'header_link_color',
        'label'       => __( 'Header Link Color', 'skylab' ),
        'desc'        => __( 'Choose a value for header link color. Default value is #000000.', 'skylab' ),
        'std'         => '#000000',
        'type'        => 'colorpicker',
        'section'     => 'header',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'header_link_color_hover',
        'label'       => __( 'Header Link Color - Hover/Active', 'skylab' ),
        'desc'        => __( 'Choose a value for header link color - hover/active. Default value is #000000.', 'skylab' ),
        'std'         => '#000000',
        'type'        => 'colorpicker',
        'section'     => 'header',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
	  array(
        'id'          => 'header_social_links_color',
        'label'       => __( 'Social Links Color', 'skylab' ),
        'desc'        => __( 'Choose a value for social links color. Default value is #000000.', 'skylab' ),
        'std'         => '#000000',
        'type'        => 'colorpicker',
        'section'     => 'header',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
	  array(
        'id'          => 'header_social_links_color_hover',
        'label'       => __( 'Social Links Color - Hover/Active', 'skylab' ),
        'desc'        => __( 'Choose a value for social links color - hover/active. Default value is #000000.', 'skylab' ),
        'std'         => '#000000',
        'type'        => 'colorpicker',
        'section'     => 'header',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
	  array(
        'id'          => 'header_social_links_size',
        'label'       => __( 'Social Links Size', 'skylab' ),
        'desc'        => __( 'Choose a value for social links size in pixels. Default value is 13.', 'skylab' ),
        'std'         => '13',
        'type'        => 'numeric-slider',
        'section'     => 'header',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '12,18,1',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
	  array(
        'id'          => 'header_top_border',
        'label'       => __( 'Enable Top Border for Header', 'skylab' ),
        'desc'        => '',
        'std'         => '',
        'type'        => 'checkbox',
        'section'     => 'header',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and',
        'choices'     => array( 
          array(
            'value'       => 'yes',
            'label'       => __( 'Enable Top Border for Header', 'skylab' ),
            'src'         => ''
          )
        )
      ),
      array(
        'id'          => 'header_top_border_color',
        'label'       => __( 'Header Top Border Color', 'skylab' ),
        'desc'        => __( 'Choose a value for header top border color. Default value is #e6e6e6.', 'skylab' ),
        'std'         => '#e6e6e6',
        'type'        => 'colorpicker',
        'section'     => 'header',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
	  array(
        'id'          => 'header_bottom_border',
        'label'       => __( 'Enable Bottom Border for Header', 'skylab' ),
        'desc'        => '',
        'std'         => '',
        'type'        => 'checkbox',
        'section'     => 'header',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and',
        'choices'     => array( 
          array(
            'value'       => 'yes',
            'label'       => __( 'Enable Bottom Border for Header', 'skylab' ),
            'src'         => ''
          )
        )
      ),
      array(
        'id'          => 'header_bottom_border_color',
        'label'       => __( 'Header Bottom Border Color', 'skylab' ),
        'desc'        => __( 'Choose a value for header bottom border color. Default value is #e6e6e6.', 'skylab' ),
        'std'         => '#e6e6e6',
        'type'        => 'colorpicker',
        'section'     => 'header',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'menu_position',
        'label'       => __( 'Menu Position', 'skylab' ),
        'desc'        => '',
        'std'         => '',
        'type'        => 'select',
        'section'     => 'header',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and',
        'choices'     => array( 
		  array(
            'value'       => 'right',
            'label'       => __( 'Right', 'skylab' ),
            'src'         => ''
          ),
          array(
            'value'       => 'center',
            'label'       => __( 'Center', 'skylab' ),
            'src'         => ''
          ),
          array(
            'value'       => 'left',
            'label'       => __( 'Left', 'skylab' ),
            'src'         => ''
          )
        )
      ),
	  array(
        'id'          => 'logo_position',
        'label'       => esc_html__( 'Logo Position', 'skylab' ),
        'desc'        => '',
        'std'         => '',
        'type'        => 'select',
        'section'     => 'header',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and',
        'choices'     => array( 
          array(
            'value'       => 'left',
            'label'       => esc_html__( 'Left', 'skylab' ),
            'src'         => ''
          ),
          array(
            'value'       => 'center',
            'label'       => esc_html__( 'Center', 'skylab' ),
            'src'         => ''
          ),
		  array(
            'value'       => 'right',
            'label'       => esc_html__( 'Right', 'skylab' ),
            'src'         => ''
          )
        )
      ),
      array(
        'id'          => 'center_logo_and_menu',
        'label'       => __( 'Center Logo and Menu', 'skylab' ),
        'desc'        => '',
        'std'         => '',
        'type'        => 'checkbox',
        'section'     => 'header',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and',
        'choices'     => array( 
          array(
            'value'       => 'yes',
            'label'       => __( 'Center Logo and Menu', 'skylab' ),
            'src'         => ''
          )
        )
      ),
	  array(
        'id'          => 'menu_opacity_hover',
        'label'       => __( 'Menu Opacity on Hover', 'skylab' ),
        'desc'        => '',
        'std'         => '',
        'type'        => 'checkbox',
        'section'     => 'header',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and',
        'choices'     => array( 
          array(
            'value'       => 'yes',
            'label'       => __( 'Menu Opacity on Hover', 'skylab' ),
            'src'         => ''
          )
        )
      ),
      array(
        'id'          => 'center_and_enable_full_width_for_secondary_menu',
        'label'       => __( 'Center and Enable Full Width for Secondary Menu', 'skylab' ),
        'desc'        => '',
        'std'         => '',
        'type'        => 'checkbox',
        'section'     => 'secondary_menu',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and',
        'choices'     => array( 
          array(
            'value'       => 'yes',
            'label'       => __( 'Center and Enable Full Width for Secondary Menu', 'skylab' ),
            'src'         => ''
          )
        )
      ),
      array(
        'id'          => 'secondary_menu_align',
        'label'       => __( 'Secondary Menu Align', 'skylab' ),
        'desc'        => '',
        'std'         => '',
        'type'        => 'select',
        'section'     => 'secondary_menu',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and',
        'choices'     => array( 
          array(
            'value'       => 'right',
            'label'       => __( 'Right', 'skylab' ),
            'src'         => ''
          ),
          array(
            'value'       => 'left',
            'label'       => __( 'Left', 'skylab' ),
            'src'         => ''
          )
        )
      ),
      array(
        'id'          => 'enable_top_bar',
        'label'       => __( 'Enable Top Bar', 'skylab' ),
        'desc'        => '',
        'std'         => '',
        'type'        => 'checkbox',
        'section'     => 'top_bar',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and',
        'choices'     => array( 
          array(
            'value'       => 'yes',
            'label'       => __( 'Enable Top Bar', 'skylab' ),
            'src'         => ''
          )
        )
      ),
      array(
        'id'          => 'top_bar_info',
        'label'       => __( 'Top Bar Info', 'skylab' ),
        'desc'        => __( 'Enter the info you would like to display in top bar of your site.', 'skylab' ),
        'std'         => '',
        'type'        => 'textarea',
        'section'     => 'top_bar',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'top_bar_info_align',
        'label'       => __( 'Top Bar Info Align', 'skylab' ),
        'desc'        => '',
        'std'         => '',
        'type'        => 'select',
        'section'     => 'top_bar',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and',
        'choices'     => array( 
          array(
            'value'       => 'right',
            'label'       => __( 'Right', 'skylab' ),
            'src'         => ''
          ),
          array(
            'value'       => 'left',
            'label'       => __( 'Left', 'skylab' ),
            'src'         => ''
          )
        )
      ),
      array(
        'id'          => 'top_bar_background_color',
        'label'       => __( 'Top Bar Background Color', 'skylab' ),
        'desc'        => __( 'Choose a value for top bar background color. Default value is #000000.', 'skylab' ),
        'std'         => '#000000',
        'type'        => 'colorpicker',
        'section'     => 'top_bar',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'top_bar_text_color',
        'label'       => __( 'Top Bar Text Color', 'skylab' ),
        'desc'        => __( 'Choose a value for top bar text color. Default value is #ffffff.', 'skylab' ),
        'std'         => '#ffffff',
        'type'        => 'colorpicker',
        'section'     => 'top_bar',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'top_bar_link_color',
        'label'       => __( 'Top Bar Link Color', 'skylab' ),
        'desc'        => __( 'Choose a value for top bar link color. Default value is #ffffff.', 'skylab' ),
        'std'         => '#ffffff',
        'type'        => 'colorpicker',
        'section'     => 'top_bar',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'top_bar_link_color_hover',
        'label'       => __( 'Top Bar Link Color - Hover/Active', 'skylab' ),
        'desc'        => __( 'Choose a value for top bar link color - hover/active. Default value is #ffffff.', 'skylab' ),
        'std'         => '#ffffff',
        'type'        => 'colorpicker',
        'section'     => 'top_bar',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'top_bar_social_icons_color',
        'label'       => __( 'Top Bar Social Icons Color', 'skylab' ),
        'desc'        => __( 'Choose a value for social icons color. Default value is #ffffff.', 'skylab' ),
        'std'         => '#ffffff',
        'type'        => 'colorpicker',
        'section'     => 'top_bar',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'back_to_top_button',
        'label'       => __( 'Back To Top Button', 'skylab' ),
        'desc'        => '',
        'std'         => '',
        'type'        => 'select',
        'section'     => 'footer',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and',
        'choices'     => array( 
		  array(
            'value'       => 'enable',
            'label'       => __( 'Enable', 'skylab' ),
            'src'         => ''
          ),
          array(
            'value'       => 'disable',
            'label'       => __( 'Disable', 'skylab' ),
            'src'         => ''
          )
        )
      ),
      array(
        'id'          => 'back_to_top_button_align',
        'label'       => __( 'Back to Top Button Align', 'skylab' ),
        'desc'        => '',
        'std'         => '',
        'type'        => 'select',
        'section'     => 'footer',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and',
        'choices'     => array( 
		  array(
            'value'       => 'fixed',
            'label'       => __( 'Fixed', 'skylab' ),
            'src'         => ''
          ),
          array(
            'value'       => 'right',
            'label'       => __( 'Right', 'skylab' ),
            'src'         => ''
          ),
          array(
            'value'       => 'left',
            'label'       => __( 'Left', 'skylab' ),
            'src'         => ''
          )
        )
      ),
      array(
        'id'          => 'enable_full_width_for_footer',
        'label'       => __( 'Enable Full Width for Footer', 'skylab' ),
        'desc'        => '',
        'std'         => '',
        'type'        => 'checkbox',
        'section'     => 'footer',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and',
        'choices'     => array( 
          array(
            'value'       => 'yes',
            'label'       => __( 'Enable Full Width for Footer', 'skylab' ),
            'src'         => ''
          )
        )
      ),
      array(
        'id'          => 'back_to_top_button_color',
        'label'       => __( 'Back To Top Button Color', 'skylab' ),
        'desc'        => __( 'Choose a value for back to top button color. Default value is #000000.', 'skylab' ),
        'std'         => '#000000',
        'type'        => 'colorpicker',
        'section'     => 'footer',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'back_to_top_button_color_hover',
        'label'       => __( 'Back To Top Button Color - Hover/Active', 'skylab' ),
        'desc'        => __( 'Choose a value for back to top button color - hover/active. Default value is #000000.', 'skylab' ),
        'std'         => '#000000',
        'type'        => 'colorpicker',
        'section'     => 'footer',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'footer_background_color',
        'label'       => __( 'Footer Background Color', 'skylab' ),
        'desc'        => __( 'Choose a value for footer background color. Default value is #ffffff.', 'skylab' ),
        'std'         => '#ffffff',
        'type'        => 'colorpicker',
        'section'     => 'footer',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'footer_widget_title_color',
        'label'       => __( 'Footer Widget Title Color', 'skylab' ),
        'desc'        => __( 'Choose a value for footer widget title color in pixels. Default value is #000000.', 'skylab' ),
        'std'         => '#000000',
        'type'        => 'colorpicker',
        'section'     => 'footer',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'footer_text_color',
        'label'       => __( 'Footer Text Color', 'skylab' ),
        'desc'        => __( 'Choose a value for footer text color. Default value is #000000.', 'skylab' ),
        'std'         => '#000000',
        'type'        => 'colorpicker',
        'section'     => 'footer',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
	  array(
        'id'          => 'footer_text_size',
        'label'       => __( 'Footer Text Size', 'skylab' ),
        'desc'        => __( 'Choose a value for footer text size in pixels. Default value is 13.', 'skylab' ),
        'std'         => '13',
        'type'        => 'numeric-slider',
        'section'     => 'footer',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '12,18,1',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'footer_link_color',
        'label'       => __( 'Footer Link Color', 'skylab' ),
        'desc'        => __( 'Choose a value for footer link color. Default value is #000000.', 'skylab' ),
        'std'         => '#000000',
        'type'        => 'colorpicker',
        'section'     => 'footer',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'footer_link_color_hover',
        'label'       => __( 'Footer Link Color - Hover/Active', 'skylab' ),
        'desc'        => __( 'Choose a value for footer link color - hover/active. Default value is #000000.', 'skylab' ),
        'std'         => '#000000',
        'type'        => 'colorpicker',
        'section'     => 'footer',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'footer_bottom_area_background_color',
        'label'       => __( 'Footer Bottom Area Background Color', 'skylab' ),
        'desc'        => __( 'Choose a value for footer bottom area background color. Default value is #ffffff.', 'skylab' ),
        'std'         => '#ffffff',
        'type'        => 'colorpicker',
        'section'     => 'footer',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'footer_bottom_area_link_color',
        'label'       => __( 'Footer Bottom Area Link Color', 'skylab' ),
        'desc'        => __( 'Choose a value for footer bottom area link color. Default value is #000000.', 'skylab' ),
        'std'         => '#000000',
        'type'        => 'colorpicker',
        'section'     => 'footer',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'footer_bottom_area_link_color_hover',
        'label'       => __( 'Footer Bottom Area Link Color - Hover/Active', 'skylab' ),
        'desc'        => __( 'Choose a value for footer bottom area link color - hover/active. Default value is #000000.', 'skylab' ),
        'std'         => '#000000',
        'type'        => 'colorpicker',
        'section'     => 'footer',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'footer_bottom_area_text_color',
        'label'       => __( 'Footer Bottom Area Text Color', 'skylab' ),
        'desc'        => __( 'Choose a value for footer bottom area text color. Default value is #000000.', 'skylab' ),
        'std'         => '#000000',
        'type'        => 'colorpicker',
        'section'     => 'footer',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
	  array(
        'id'          => 'footer_social_links_color',
        'label'       => __( 'Footer Social Links Color', 'skylab' ),
        'desc'        => __( 'Choose a value for footer social links color. Default value is #000000.', 'skylab' ),
        'std'         => '#000000',
        'type'        => 'colorpicker',
        'section'     => 'footer',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
	  array(
        'id'          => 'footer_social_links_size',
        'label'       => __( 'Footer Social Links Size', 'skylab' ),
        'desc'        => __( 'Choose a value for footer social links size in pixels. Default value is 13.', 'skylab' ),
        'std'         => '13',
        'type'        => 'numeric-slider',
        'section'     => 'footer',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '12,18,1',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
	  array(
        'id'          => 'footer_bottom_area_top_padding',
        'label'       => __( 'Footer Bottom Area Top Padding', 'skylab' ),
        'desc'        => __( 'Choose a value for footer bottom area top padding in pixels. Default value is 50.', 'skylab' ),
        'std'         => '50',
        'type'        => 'numeric-slider',
        'section'     => 'footer',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '0,100,1',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
	  array(
        'id'          => 'footer_bottom_area_bottom_padding',
        'label'       => __( 'Footer Bottom Area Bottom Padding', 'skylab' ),
        'desc'        => __( 'Choose a value for footer bottom area bottom padding in pixels. Default value is 50.', 'skylab' ),
        'std'         => '50',
        'type'        => 'numeric-slider',
        'section'     => 'footer',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '0,100,1',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
	  array(
        'id'          => 'footer_top_border',
        'label'       => __( 'Enable Top Border for Footer', 'skylab' ),
        'desc'        => '',
        'std'         => '',
        'type'        => 'checkbox',
        'section'     => 'footer',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and',
        'choices'     => array( 
          array(
            'value'       => 'yes',
            'label'       => __( 'Enable Top Border for Footer', 'skylab' ),
            'src'         => ''
          )
        )
      ),
	  array(
        'id'          => 'footer_top_border_color',
        'label'       => __( 'Footer Top Border Color', 'skylab' ),
        'desc'        => __( 'Choose a value for Footer top border color. Default value is #e6e6e6.', 'skylab' ),
        'std'         => '#e6e6e6',
        'type'        => 'colorpicker',
        'section'     => 'footer',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
	  array(
        'id'          => 'footer_bottom_area_top_border',
        'label'       => __( 'Enable Top Border for Footer Bottom Area', 'skylab' ),
        'desc'        => '',
        'std'         => '',
        'type'        => 'checkbox',
        'section'     => 'footer',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and',
        'choices'     => array( 
          array(
            'value'       => 'yes',
            'label'       => __( 'Enable Top Border for Footer Bottom Area', 'skylab' ),
            'src'         => ''
          )
        )
      ),
	  array(
        'id'          => 'footer_bottom_area_top_border_color',
        'label'       => __( 'Footer Bottom Area Top Border Color', 'skylab' ),
        'desc'        => __( 'Choose a value for footer bottom area top border color. Default value is #e6e6e6.', 'skylab' ),
        'std'         => '#e6e6e6',
        'type'        => 'colorpicker',
        'section'     => 'footer',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
	  array(
        'id'          => 'footer_parallax',
        'label'       => esc_html__( 'Footer Parallax', 'skylab' ),
        'desc'        => '',
        'std'         => '',
        'type'        => 'select',
        'section'     => 'footer',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and',
        'choices'     => array( 
          array(
            'value'       => 'disable',
            'label'       => esc_html__( 'Disable', 'skylab' ),
            'src'         => ''
          ),
          array(
            'value'       => 'enable',
            'label'       => esc_html__( 'Enable', 'skylab' ),
            'src'         => ''
          )
        )
      ),
	  array(
        'id'          => 'single_portfolio_navigation',
        'label'       => __( 'Single Portfolio Navigation', 'skylab' ),
        'desc'        => '',
        'std'         => '',
        'type'        => 'select',
        'section'     => 'portfolio_settings',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and',
        'choices'     => array( 
		   array(
            'value'       => 'enable',
            'label'       => __( 'Enable', 'skylab' ),
            'src'         => ''
          ),
          array(
            'value'       => 'disable',
            'label'       => __( 'Disable', 'skylab' ),
            'src'         => ''
          )
        )
      ),
      array(
        'id'          => 'portfolio_page',
        'label'       => __( 'Portfolio Page', 'skylab' ),
        'desc'        => __( 'Select the portfolio page. Used for the "Back to the Projects" link.', 'skylab' ),
        'std'         => '',
        'type'        => 'page-select',
        'section'     => 'portfolio_settings',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
	  array(
        'id'          => 'single_post_navigation',
        'label'       => __( 'Single Post Navigation', 'skylab' ),
        'desc'        => '',
        'std'         => '',
        'type'        => 'select',
        'section'     => 'blog_settings',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and',
        'choices'     => array( 
		   array(
            'value'       => 'enable',
            'label'       => __( 'Enable', 'skylab' ),
            'src'         => ''
          ),
          array(
            'value'       => 'disable',
            'label'       => __( 'Disable', 'skylab' ),
            'src'         => ''
          )
        )
      ),
	  array(
        'id'          => 'social_links_style',
        'label'       => __( 'Social Links Style', 'skylab' ),
        'desc'        => '',
        'std'         => '',
        'type'        => 'select',
        'section'     => 'social',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and',
        'choices'     => array( 
          array(
            'value'       => '1',
            'label'       => '1',
            'src'         => ''
          ),
          array(
            'value'       => '2',
            'label'       => '2',
            'src'         => ''
          ),
		  array(
            'value'       => '3',
            'label'       => '3',
            'src'         => ''
          ),
		  array(
            'value'       => '4',
            'label'       => '4',
            'src'         => ''
          ),
		  array(
            'value'       => '5',
            'label'       => '5',
            'src'         => ''
          ),
		  array(
            'value'       => '6',
            'label'       => '6',
            'src'         => ''
          )
        )
      ),
	  array(
        'id'          => 'social_links_opacity_hover',
        'label'       => __( 'Social Links Opacity on Hover', 'skylab' ),
        'desc'        => '',
        'std'         => '',
        'type'        => 'checkbox',
        'section'     => 'social',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and',
        'choices'     => array( 
          array(
            'value'       => 'yes',
            'label'       => __( 'Social Links Opacity on Hover', 'skylab' ),
            'src'         => ''
          )
        )
      ),
      array(
        'id'          => 'social_links',
        'label'       => __( 'Social Links', 'skylab' ),
        'desc'        => '',
        'std'         => '',
        'type'        => 'checkbox',
        'section'     => 'social',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and',
        'choices'     => array( 
          array(
            'value'       => 'twitter',
            'label'       => __( 'Twitter', 'skylab' ),
            'src'         => ''
          ),
          array(
            'value'       => 'facebook',
            'label'       => __( 'Facebook', 'skylab' ),
            'src'         => ''
          ),
		  array(
            'value'       => 'linkedin',
            'label'       => __( 'LinkedIn', 'skylab' ),
            'src'         => ''
          ),
          array(
            'value'       => 'instagram',
            'label'       => __( 'Instagram', 'skylab' ),
            'src'         => ''
          ),
		  array(
            'value'       => 'tumblr',
            'label'       => __( 'Tumblr', 'skylab' ),
            'src'         => ''
          ),
          array(
            'value'       => 'gplus',
            'label'       => __( 'Google+', 'skylab' ),
            'src'         => ''
          ),
          array(
            'value'       => 'vimeo',
            'label'       => __( 'Vimeo', 'skylab' ),
            'src'         => ''
          ),
          array(
            'value'       => 'flickr',
            'label'       => __( 'Flickr', 'skylab' ),
            'src'         => ''
          ),
          array(
            'value'       => 'pinterest',
            'label'       => __( 'Pinterest', 'skylab' ),
            'src'         => ''
          ),
          array(
            'value'       => 'youtube',
            'label'       => __( 'YouTube', 'skylab' ),
            'src'         => ''
          ),
          array(
            'value'       => 'dribbble',
            'label'       => __( 'Dribbble', 'skylab' ),
            'src'         => ''
          ),
          array(
            'value'       => 'behance',
            'label'       => __( 'Behance', 'skylab' ),
            'src'         => ''
          ),
          array(
            'value'       => 'px',
            'label'       => __( '500px', 'skylab' ),
            'src'         => ''
          ),
          array(
            'value'       => 'vk',
            'label'       => __( 'VK', 'skylab' ),
            'src'         => ''
          ),
		  array(
            'value'       => 'email',
            'label'       => __( 'Email', 'skylab' ),
            'src'         => ''
          )
        )
      ),
      array(
        'id'          => 'twitter_url',
        'label'       => __( 'Twitter Address (URL)', 'skylab' ),
        'desc'        => '',
        'std'         => 'https://twitter.com/',
        'type'        => 'text',
        'section'     => 'social',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'facebook_url',
        'label'       => __( 'Facebook Address (URL)', 'skylab' ),
        'desc'        => '',
        'std'         => 'http://www.facebook.com/',
        'type'        => 'text',
        'section'     => 'social',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'instagram_url',
        'label'       => __( 'Instagram Address (URL)', 'skylab' ),
        'desc'        => '',
        'std'         => 'http://instagram.com/',
        'type'        => 'text',
        'section'     => 'social',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'linkedin_url',
        'label'       => __( 'LinkedIn Address (URL)', 'skylab' ),
        'desc'        => '',
        'std'         => 'http://www.linkedin.com/',
        'type'        => 'text',
        'section'     => 'social',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'pinterest_url',
        'label'       => __( 'Pinterest Address (URL)', 'skylab' ),
        'desc'        => '',
        'std'         => 'http://pinterest.com/',
        'type'        => 'text',
        'section'     => 'social',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'gplus_url',
        'label'       => __( 'Google+ Address (URL)', 'skylab' ),
        'desc'        => '',
        'std'         => 'https://plus.google.com/',
        'type'        => 'text',
        'section'     => 'social',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'vimeo_url',
        'label'       => __( 'Vimeo Address (URL)', 'skylab' ),
        'desc'        => '',
        'std'         => 'http://vimeo.com/',
        'type'        => 'text',
        'section'     => 'social',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'flickr_url',
        'label'       => __( 'Flickr Address (URL)', 'skylab' ),
        'desc'        => '',
        'std'         => 'http://www.flickr.com/',
        'type'        => 'text',
        'section'     => 'social',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'tumblr_url',
        'label'       => __( 'Tumblr Address (URL)', 'skylab' ),
        'desc'        => '',
        'std'         => 'https://www.tumblr.com/',
        'type'        => 'text',
        'section'     => 'social',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'youtube_url',
        'label'       => __( 'YouTube Address (URL)', 'skylab' ),
        'desc'        => '',
        'std'         => 'http://www.youtube.com/',
        'type'        => 'text',
        'section'     => 'social',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'dribbble_url',
        'label'       => __( 'Dribbble Address (URL)', 'skylab' ),
        'desc'        => '',
        'std'         => 'http://dribbble.com/',
        'type'        => 'text',
        'section'     => 'social',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'behance_url',
        'label'       => __( 'Behance Address (URL)', 'skylab' ),
        'desc'        => '',
        'std'         => 'http://www.behance.net/',
        'type'        => 'text',
        'section'     => 'social',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'px_url',
        'label'       => __( '500px Address (URL)', 'skylab' ),
        'desc'        => '',
        'std'         => 'https://500px.com/',
        'type'        => 'text',
        'section'     => 'social',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'vk_url',
        'label'       => __( 'VK Address (URL)', 'skylab' ),
        'desc'        => '',
        'std'         => 'http://vk.com/',
        'type'        => 'text',
        'section'     => 'social',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
	  array(
        'id'          => 'email_address',
        'label'       => __( 'Email Address', 'skylab' ),
        'desc'        => '',
        'std'         => 'placeholder@example.com',
        'type'        => 'text',
        'section'     => 'social',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'enable_woocommerce_links',
        'label'       => __( 'Enable WooCommerce Links', 'skylab' ),
        'desc'        => '',
        'std'         => '',
        'type'        => 'select',
        'section'     => 'woocommerce',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and',
        'choices'     => array( 
          array(
            'value'       => 'disable',
            'label'       => __( 'Disable', 'skylab' ),
            'src'         => ''
          ),
          array(
            'value'       => 'enable',
            'label'       => __( 'Enable', 'skylab' ),
            'src'         => ''
          )
        )
      ),
      array(
        'id'          => 'shop_layout',
        'label'       => __( 'Shop Layout', 'skylab' ),
        'desc'        => '',
        'std'         => 'left-sidebar',
        'type'        => 'radio-image',
        'section'     => 'woocommerce',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'shop_columns',
        'label'       => __( 'Shop Columns', 'skylab' ),
        'desc'        => '',
        'std'         => '',
        'type'        => 'select',
        'section'     => 'woocommerce',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and',
        'choices'     => array( 
          array(
            'value'       => '3',
            'label'       => __( '3', 'skylab' ),
            'src'         => ''
          ),
          array(
            'value'       => '2',
            'label'       => __( '2', 'skylab' ),
            'src'         => ''
          ),
          array(
            'value'       => '4',
            'label'       => __( '4', 'skylab' ),
            'src'         => ''
          )
        )
      ),
      array(
        'id'          => 'header_background_for_shop',
        'label'       => __( 'Hader Background for Shop', 'skylab' ),
        'desc'        => __( 'Upload header background for shop.', 'skylab' ),
        'std'         => '',
        'type'        => 'upload',
        'section'     => 'woocommerce',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'add_to_cart_text_on_single_product',
        'label'       => __( 'The add to cart text on single product', 'skylab' ),
        'desc'        => __( 'Enter the add to cart text on single product.', 'skylab' ),
        'std'         => '',
        'type'        => 'text',
        'section'     => 'woocommerce',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'revolution_slider_alias',
        'label'       => __( 'Revolution Slider Alias', 'skylab' ),
        'desc'        => __( 'The alias that will be used for embedding the slider on shop page. Example: slider1.', 'skylab' ),
        'std'         => '',
        'type'        => 'text',
        'section'     => 'woocommerce',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'enable_carousel_slider_for_related_products_on_single_product_page',
        'label'       => __( 'Enable Carousel Slider for Related Products on Single Product Page', 'skylab' ),
        'desc'        => '',
        'std'         => '',
        'type'        => 'checkbox',
        'section'     => 'woocommerce',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and',
        'choices'     => array( 
          array(
            'value'       => 'yes',
            'label'       => __( 'Enable Carousel Slider for Related Products on Single Product Page', 'skylab' ),
            'src'         => ''
          )
        )
      ),
      array(
        'id'          => 'additional_info_on_single_product_page',
        'label'       => __( 'Additional Info on Single Product Page', 'skylab' ),
        'desc'        => __( 'Enter the info you would like to display on single product page of your site.', 'skylab' ),
        'std'         => '',
        'type'        => 'textarea',
        'section'     => 'woocommerce',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      )
    )
  );
  
  /* allow settings to be filtered before saving */
  $custom_settings = apply_filters( ot_settings_id() . '_args', $custom_settings );
  
  /* settings are not the same update the DB */
  if ( $saved_settings !== $custom_settings ) {
    update_option( ot_settings_id(), $custom_settings ); 
  }
  
  /* Lets OptionTree know the UI Builder is being overridden */
  global $ot_has_custom_theme_options;
  $ot_has_custom_theme_options = true;
  
}