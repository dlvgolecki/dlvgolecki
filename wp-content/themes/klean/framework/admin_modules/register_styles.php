<?php
/**
 * Enqueue scripts and styles.
 */
function klean_scripts() {
    wp_enqueue_style( 'klean-style', get_stylesheet_uri() );

    wp_enqueue_style('klean-title-font', '//fonts.googleapis.com/css?family='.str_replace(" ", "+", esc_html(get_theme_mod('klean_title_font', 'Source Sans Pro')) ).':100,300,400,700' );

    wp_enqueue_style('klean-body-font', '//fonts.googleapis.com/css?family='.str_replace(" ", "+", esc_html(get_theme_mod('klean_body_font', 'Source Sans Pro') ) ).':100,300,400,700' );

    wp_enqueue_style('klean-bootstrap-style',get_template_directory_uri()."/assets/bootstrap/css/bootstrap.css", array('klean-style'));

    wp_enqueue_style( 'klean-main-theme-style', get_template_directory_uri() . '/assets/theme-styles/css/'.get_theme_mod('klean_skin', 'default').'.css', array(), null );

    wp_enqueue_style('klean-font-awesome', get_template_directory_uri()."/assets/font-awesome/css/font-awesome.min.css");

    wp_enqueue_script('jquery');

    wp_enqueue_script( 'klean-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20120206', true );

    wp_enqueue_script( 'klean-menu-js', get_template_directory_uri() . '/js/jquery.slicknav.min.js', array(), true );

    wp_enqueue_script( 'klean-custom-js', get_template_directory_uri() . '/js/custom.js', array(), true );

    wp_enqueue_script( 'klean-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20130115', true );

    if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
        wp_enqueue_script( 'comment-reply' );
    }
}
add_action( 'wp_enqueue_scripts', 'klean_scripts' );

