<?php
function klean_customize_register_skins($wp_customize) {
    $wp_customize->get_section('colors')->title = __('Theme Skins & Colors', 'klean');
    $wp_customize->get_section('colors')->panel = 'klean_design_panel';
    $wp_customize->get_setting('header_textcolor')->default = '#000000';

    $wp_customize-> add_setting(
        'klean-desc-color',
        array(
            'default'			=> '#555555',
            'sanitize_callback'	=> 'sanitize_hex_color',
            'transport'			=> 'postMessage',
        )
    );

    $wp_customize->add_control(
        new WP_Customize_Color_Control(
            $wp_customize,
            'klean-desc-color',
            array(
                'label' => __('Site Description Color','klean'),
                'section' => 'colors',
                'settings' => 'klean-desc-color',
                'priority'  => 12
            )
        )
    );

    $wp_customize->add_setting(
        'klean_skin',
        array(
            'default'=> 'default',
            'sanitize_callback' => 'klean_sanitize_skin'
        )
    );

    $skins = array( 'default' => __('Default(Klean)','klean'),
        'green' => __('Green','klean'),
        'brown' => __('Brown', 'klean'),
        'orange' => __('Orange', 'klean'),
    );

    $wp_customize->add_control(
        'klean_skin',array(
            'settings' => 'klean_skin',
            'section'  => 'colors',
            'label' => __('Choose Skin','klean'),
            'description' => __('Free Version of klean Supports 3 Different Skin Colors.','klean'),
            'type' => 'select',
            'choices' => $skins,
            'priority' => 40
        )
    );

    function klean_sanitize_skin( $input ) {
        if ( in_array($input, array('default','orange','green', 'brown') ) )
            return $input;
        else
            return '';
    }
}
add_action('customize_register', 'klean_customize_register_skins');