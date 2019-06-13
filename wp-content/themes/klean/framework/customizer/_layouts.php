<?php
function klean_customize_register_layouts($wp_customize) {
    $wp_customize->get_section('colors')->panel = 'klean_design_panel';
    $wp_customize->get_section('background_image')->panel = 'klean_design_panel';

    $wp_customize->add_panel('klean_design_panel', array(
        'title' => __( 'Design & Layouts', 'klean' ),
        'priority' => 40,
    ));

    $wp_customize->add_section(
        'klean_design_options',
        array(
            'title'     => __('Blog Layout','klean'),
            'priority'  => 0,
            'panel'     => 'klean_design_panel'
        )
    );


    $wp_customize->add_setting(
        'klean_blog_layout',
        array( 'sanitize_callback' => 'klean_sanitize_blog_layout' )
    );

    function klean_sanitize_blog_layout( $input ) {
        if ( in_array($input, array('klean', 'grid','grid_2_column') ) )
            return $input;
        else
            return '';
    }

    $wp_customize->add_control(
        'klean_blog_layout',array(
            'label' => __('Select Layout','klean'),
            'settings' => 'klean_blog_layout',
            'section'  => 'klean_design_options',
            'type' => 'select',
            'choices' => array(
                'klean' => __('Klean Theme Layout','klean'),
                'grid' => __('Basic Blog Layout','klean'),
                'grid_2_column' => __('Grid - 2 Column','klean'),
            )
        )
    );

    $wp_customize-> add_section(
        'klean_sidebar_layout',
        array(
            'title'			=> __('Sidebar Layout','klean'),
            'priority'		=> 20,
            'panel' => 'klean_design_panel'
        )
    );

    $wp_customize-> add_setting(
        'klean-post-sidebar',
        array(
            'default'			=> true,
            'sanitize_callback'	=> 'klean_sanitize_checkbox',
        )
    );

    $wp_customize-> add_control(
        'klean-post-sidebar',
        array(
            'type'		=> 'checkbox',
            'label'		=> __('Show Sidebar Everywhere','klean'),
            'section'	=> 'klean_sidebar_layout',
            'priority'	=> 1,
        )
    );


    $wp_customize-> add_section('klean_basic_settings', array(
        'title' => __('Basic Settings', 'klean'),
        'priority' => 10,
        'panel' => 'klean_design_panel'
    ));

    $wp_customize-> add_setting(
        'klean-featured-image',
        array(
            'default'	=> true,
            'sanitize_callback'	=> 'klean_sanitize_checkbox'
        )
    );

    $wp_customize-> add_control(
        'klean-featured-image',
        array(
            'type'	=> 'checkbox',
            'label'	=> __('Show Featured Image in the Posts', 'klean'),
            'section'	=> 'klean_basic_settings',
            'priority'	=> 5
        )
    );


    $wp_customize->add_section('klean_footer_settings', array(
        'title' => __('Footer Settings', 'klean'),
        'priority' => 30,
        'panel' => 'klean_design_panel'
    ));

    $wp_customize->add_setting(
        'klean-footer-text',
        array(
            'default'		=> '',
            'sanitize_callback'	=> 'klean_sanitize_text'
        )
    );

    $wp_customize->add_control('klean-footer-text',
        array('label' => __('Footer Text','klean'),
            'section' => 'klean_footer_settings',
            'settings' => 'klean-footer-text',
            'type' => 'text'
        )
    );
}
add_action('customize_register', 'klean_customize_register_layouts');