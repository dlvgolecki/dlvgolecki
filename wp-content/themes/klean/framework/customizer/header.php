<?php
function klean_customize_register_header($wp_customize) {
    $wp_customize->get_section('title_tagline')->panel = 'klean_header_panel';
    $wp_customize->get_section('header_image')->panel = 'klean_header_panel';

    $wp_customize->add_panel('klean_header_panel', array(
        'title' => __('Header Settings', 'klean'),
        'priority' => 20,
    ));
}
add_action('customize_register', 'klean_customize_register_header');