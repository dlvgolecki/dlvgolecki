<?php
function klean_customize_register_googlefonts($wp_customize){
    $wp_customize->add_section(
        'klean_typo_options',
        array(
            'title'     => __('Google Web Fonts','klean'),
            'priority'  => 41,
            'panel' => 'klean_design_panel'
        )
    );

    $font_array = array('Source Sans Pro', 'HIND','Khula','Open Sans','Droid Sans','Droid Serif','Roboto','Roboto Condensed','Lato','Bree Serif','Oswald','Slabo','Lora','Source Sans Pro','Arimo','Bitter','Noto Sans');
    $fonts = array_combine($font_array, $font_array);

    $wp_customize->add_setting(
        'klean_title_font',
        array(
            'default'=> 'Source Sans Pro',
            'sanitize_callback' => 'klean_sanitize_gfont'
        )
    );

    function klean_sanitize_gfont( $input ) {
        if ( in_array($input, array('Source Sans Pro', 'HIND','Khula','Open Sans','Droid Sans','Droid Serif','Roboto','Roboto Condensed','Lato','Bree Serif','Oswald','Slabo','Lora','Source Sans Pro','Arimo','Bitter','Noto Sans') ) )
            return $input;
        else
            return '';
    }

    $wp_customize->add_control(
        'klean_title_font',array(
            'label' => __('Title','klean'),
            'settings' => 'klean_title_font',
            'section'  => 'klean_typo_options',
            'type' => 'select',
            'choices' => $fonts,
        )
    );

    $wp_customize->add_setting(
        'klean_body_font',
        array(	'default'=> 'Source Sans Pro',
            'sanitize_callback' => 'klean_sanitize_gfont' )
    );

    $wp_customize->add_control(
        'klean_body_font',array(
            'label' => __('Body','klean'),
            'settings' => 'klean_body_font',
            'section'  => 'klean_typo_options',
            'type' => 'select',
            'choices' => $fonts
        )
    );
}
add_action('customize_register', 'klean_customize_register_googlefonts');