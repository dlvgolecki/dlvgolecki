<?php
function klean_customize_register_social($wp_customize) {
    $wp_customize-> add_section(
        'klean_social',
        array(
            'title'			=> __('Social Icons','klean'),
            'description'	=> __('Manage the Social Icon Setings of your site.','klean'),
            'priority'		=> 20,
            'panel'         => 'klean_header_panel'
        )
    );

    $wp_customize-> add_setting(
        'social',
        array(
            'default'			=> false,
            'sanitize_callback'	=> 'klean_sanitize_checkbox',
        )
    );

    $wp_customize-> add_control(
        'social',
        array(
            'type'		=> 'checkbox',
            'label'		=> __('Enable Social Icons','klean'),
            'section'	=> 'klean_social',
            'settings'  => 'social',
            'priority'	=> 1,
        )
    );

    $wp_customize-> add_setting(
        'klean-social-color',
        array(
            'sanitize_callback'	=> 'sanitize_hex_color',
        )
    );

    $wp_customize->add_control(
        new WP_Customize_Color_Control(
            $wp_customize,
            'klean-social-color',
            array(
                'label' => __('Background of the Social Icons','klean'),
                'section' => 'klean_social',
                'settings' => 'klean-social-color',
                'priority'  => 1
            )
        )
    );

    $wp_customize-> add_setting(
        'klean-social-icon-color',
        array(
            'sanitize_callback'	=> 'sanitize_hex_color',
        )
    );

    $wp_customize->add_control(
        new WP_Customize_Color_Control(
            $wp_customize,
            'klean-social-icon-color',
            array(
                'label' => __('Color of the Social Icons','klean'),
                'section' => 'klean_social',
                'settings' => 'klean-social-icon-color',
                'priority'   => 2
            )
        )
    );

    $social_networks = array( //Redefinied in Sanitization Function.
        'none' => __('-','klean'),
        'facebook' => __('Facebook','klean'),
        'twitter' => __('Twitter','klean'),
        'google-plus' => __('Google Plus','klean'),
        'instagram' => __('Instagram','klean'),
        'rss' => __('RSS Feeds','klean'),
        'vine' => __('Vine','klean'),
        'vimeo-square' => __('Vimeo','klean'),
        'youtube' => __('Youtube','klean'),
        'flickr' => __('Flickr','klean'),
    );

    $social_count = count($social_networks);

    for ($x = 1 ; $x <= ($social_count - 3) ; $x++) :

        $wp_customize->add_setting(
            'klean_social_'.$x, array(
            'sanitize_callback' => 'klean_sanitize_social',
            'default' => 'none'
        ));

        $wp_customize->add_control( 'klean_social_'.$x, array(
            'settings' => 'klean_social_'.$x,
            'label' => __('Icon ','klean').$x,
            'section' => 'klean_social',
            'type' => 'select',
            'choices' => $social_networks,
        ));

        $wp_customize->add_setting(
            'klean_social_url'.$x, array(
            'sanitize_callback' => 'esc_url_raw'
        ));

        $wp_customize->add_control( 'klean_social_url'.$x, array(
            'settings' => 'klean_social_url'.$x,
            'description' => __('Icon ','klean').$x.__(' Url','klean'),
            'section' => 'klean_social',
            'type' => 'url',
            'choices' => $social_networks,
        ));

    endfor;

    function klean_sanitize_social( $input ) {
        $social_networks = array(
            'none' ,
            'facebook',
            'twitter',
            'google-plus',
            'instagram',
            'rss',
            'vine',
            'vimeo-square',
            'youtube',
            'flickr'
        );
        if ( in_array($input, $social_networks) )
            return $input;
        else
            return '';
    }
}
add_action('customize_register', 'klean_customize_register_social');