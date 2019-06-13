<?php
function klean_customize_register_miscscripts($wp_customize){
    $wp_customize->add_section(
        'klean_sec_pro',
        array(
            'title'     => __('Important Links','klean'),
            'priority'  => 10,
        )
    );

    $wp_customize->add_setting(
        'klean_pro',
        array( 'sanitize_callback' => 'esc_textarea' )
    );

    $wp_customize->add_control(
        new Klean_WP_Customize_Upgrade_Control(
            $wp_customize,
            'klean_pro',
            array(
                'description'	=> '<a class="klean-important-links" href="https://inkhive.com/contact-us/" target="_blank">'.__('InkHive Support Forum', 'klean').'</a>
                                    <a class="klean-important-links" href="https://inkhive.com/documentation/klean" target="_blank">'.__('Klean Documentation', 'klean').'</a>
                                    <a class="klean-important-links" href="https://demo.inkhive.com/klean-plus/" target="_blank">'.__('Klean Plus Live Demo', 'klean').'</a>
                                    <a class="klean-important-links" href="https://www.facebook.com/inkhivethemes/" target="_blank">'.__('We Love Our Facebook Fans', 'klean').'</a>
                                    <a class="klean-important-links" href="https://wordpress.org/support/theme/klean/reviews" target="_blank">'.__('Review Klean on WordPress', 'klean').'</a>',
                'section' => 'klean_sec_pro',
                'settings' => 'klean_pro',
            )
        )
    );
}
add_action('customize_register', 'klean_customize_register_miscscripts');