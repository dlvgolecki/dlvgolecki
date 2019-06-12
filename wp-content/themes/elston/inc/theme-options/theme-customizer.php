<?php
/*
 * All customizer related options for Elston theme.
 * Author & Copyright: VictorThemes
 * URL: https://victorthemes.com
 */

if( ! function_exists( 'elston_framework_customizer' ) ) {
  function elston_framework_customizer( $options ) {

	$options        = array(); // remove old options

	// Primary Color
	$options[]      = array(
	  'name'        => 'elemets_color_section',
	  'title'       => esc_html__('Primary Color', 'elston'),
	  'settings'    => array(

	    // Fields Start
			array(
				'name'      => 'all_element_colors',
				'default'   => '#c7ac75',
				'control'   => array(
					'type'  => 'color',
					'label' => esc_html__('Elements Color', 'elston'),
					'description'    => esc_html__('This is theme primary color, means it\'ll affect all elements that have default color of our theme primary color.', 'elston'),
				),
			),
	    // Fields End

	  )
	);
	// Primary Color

	// Menu Color
	$options[]      = array(
	  'name'        => 'menu_section',
	  'title'       => esc_html__('Menu Colors', 'elston'),
	  'description' => esc_html__('This is all about menu area text and link colors.', 'elston'),
	  'settings'    => array(
		    // Fields Start
			array(
				'name'      => 'menu_links_color',
				'control'   => array(
					'type'  => 'color',
					'label' => esc_html__('Menu Color', 'elston'),
				),
			),
			array(
				'name'      => 'menu_link_hover_color',
				'control'   => array(
					'type'  => 'color',
					'label' => esc_html__('Menu Hover Color', 'elston'),
				),
			),
		    array(
				'name'      => 'submenu_color',
				'control'   => array(
					'type'  => 'color',
					'label' => esc_html__('Sub Menu Color', 'elston'),
				),
			),
		    array(
				'name'      => 'submenu_hover_color',
				'control'   => array(
					'type'  => 'color',
					'label' => esc_html__('Sub Menu Hover Color', 'elston'),
				),
			),
	    	// Fields End
        ),
	);
	// Menu Color

	// Content Color
	$options[]      = array(
	  'name'        => 'content_section',
	  'title'       => esc_html__('Content Colors', 'elston'),
	  'description' => esc_html__('This is all about content area text and heading colors.', 'elston'),
	  'sections'    => array(

	  	array(
	      'name'          => 'content_text_section',
	      'title'         => esc_html__('Content Text', 'elston'),
	      'settings'      => array(

			    // Fields Start
			    array(
						'name'      => 'body_color',
						'control'   => array(
							'type'  => 'color',
							'label' => esc_html__('Body & Content Color', 'elston'),
						),
					),
					array(
						'name'      => 'body_links_color',
						'control'   => array(
							'type'  => 'color',
							'label' => esc_html__('Body Links Color', 'elston'),
						),
					),
					array(
						'name'      => 'body_link_hover_color',
						'control'   => array(
							'type'  => 'color',
							'label' => esc_html__('Body Links Hover Color', 'elston'),
						),
					),
					array(
						'name'      => 'sidebar_content_color',
						'control'   => array(
							'type'  => 'color',
							'label' => esc_html__('Side Menu Icon Color', 'elston'),
						),
					),
					array(
						'name'      => 'sidebar_content_hover_color',
						'control'   => array(
							'type'  => 'color',
							'label' => esc_html__('Side Menu Icon Hover Color', 'elston'),
						),
					),
			    // Fields End
			  )
			),

			// Text Colors Section
			array(
		      'name'          => 'content_heading_section',
		      'title'         => esc_html__('Headings', 'elston'),
		      'settings'      => array(

		      	// Fields Start
				array(
					'name'      => 'content_heading_color',
					'control'   => array(
						'type'  => 'color',
						'label' => esc_html__('Content Heading Color', 'elston'),
					),
				),// Fields End
	      	)
	      ),

	  )
	);
	// Content Color

	// Footer Color
	$options[]      = array(
	  'name'        => 'footer_section',
	  'title'       => esc_html__('Footer Colors', 'elston'),
	  'description' => esc_html__('This is all about footer area text and link colors.', 'elston'),
	  'settings'    => array(
		    // Fields Start
		    array(
				'name'      => 'footer_color',
				'control'   => array(
					'type'  => 'color',
					'label' => esc_html__('Footer Content Color', 'elston'),
				),
			),
			array(
				'name'      => 'footer_links_color',
				'control'   => array(
					'type'  => 'color',
					'label' => esc_html__('Footer Links Color', 'elston'),
				),
			),
			array(
				'name'      => 'footer_link_hover_color',
				'control'   => array(
					'type'  => 'color',
					'label' => esc_html__('Footer Links Hover Color', 'elston'),
				),
			),
	    	// Fields End
        ),
	);
	// Footer Color

	return $options;

  }
  add_filter( 'cs_customize_options', 'elston_framework_customizer' );
}
