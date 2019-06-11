<?php
/*
 * Codestar Framework - Custom Style
 * Author & Copyright: VictorThemes
 * URL: https://victorthemes.com
 */

/* All Dynamic CSS Styles */
if ( ! function_exists( 'elston_dynamic_styles' ) ) {
  function elston_dynamic_styles() {

    // Typography
    $elston_get_typography  = elston_get_typography();

    $all_element_color  = cs_get_customize_option( 'all_element_colors' );

  ob_start();

global $post;
$elston_id    = ( isset( $post ) ) ? $post->ID : 0;
$elston_id    = ( is_home() ) ? get_option( 'page_for_posts' ) : $elston_id;
$elston_id    = ( elston_is_woocommerce_shop() ) ? wc_get_page_id( 'shop' ) : $elston_id;
$elston_meta  = get_post_meta( $elston_id, 'page_type_metabox', true );

$portfolio_args = array(
  'post_type' => 'portfolio',
  'status' => 'publish',
);
$portfolio_wide = new WP_Query($portfolio_args);
if ($portfolio_wide->have_posts()) : while ($portfolio_wide->have_posts()) : $portfolio_wide->the_post();
  $portfolio_meta  = get_post_meta( $post->ID, 'portfolio_type_metabox', true );
  if ($portfolio_meta['portfolio_wide_nav_color']) {
  global $post;
echo <<<CSS

  .section{$post->ID} div#fp-nav ul li a.active span,
  .section{$post->ID} div.fp-slidesNav ul li a.active span,
  .section{$post->ID} div#fp-nav ul li:hover a.active span,
  .section{$post->ID} div.fp-slidesNav ul li:hover a.active span {border-color: {$portfolio_meta['portfolio_wide_nav_color']};background-color:transparent;}
  .section{$post->ID} div#fp-nav ul li a span,
  .section{$post->ID} div.fp-slidesNav ul li a span {background-color: {$portfolio_meta['portfolio_wide_nav_color']};}

CSS;
  }
endwhile;
endif;
wp_reset_postdata();

/* Primary Colors */
if ($all_element_color) {
echo <<<CSS
  .no-class {}
  a:hover, a:focus,
  .elstn-btn-one:hover,
  input[type='submit']:hover,
  .elstn-btn-one:focus,
  input[type='submit']:focus,
  .portfolio-caption a:hover,
  .portfolio-caption.gray-color a:hover,
  nav ul li a.active,
  nav ul li.sub-menu-item ul.sub-menu a:hover,
  nav .s-back a,
  .contact-links .block a:hover,
  .elstn-social-links a:hover,
  .elstn-wrapper .elstn-social-links a:hover,
  .banner-caption a:hover,
  .elstn-about-wrap .nav-tabs li a.active,
  .elstn-about-wrap .nav-tabs > li.active > a,
  .nav-tabs > li.active > a:focus,
  .nav-tabs > li.active > a:hover,
  .mate-contact-link ul li a:hover,
  .elstn-footer a:hover,
  .elstn-back-top a:hover,
  .blog-info .clearfix a:hover,
  .elstn-load-more a:hover,
  .share-post h6 a:hover,
  .content-inner a,
  .content-inner .bp-tags li a:hover,
  .contact-list p a,
  .contact-list .clearfix a:hover,
  .elstn-detail-container ul li a:hover,
  .elstn-detail-container ul li a:hover span,
  .link-wrapper a:hover,
  .elstn-more-project a:hover,
  .elstn-detail-wrap p a,
  .action-link a,
  .project-controls .action-links a:hover,
  .elstn-project-wrap ul li span a:hover,
  .elstn-project-wrap ul li span a:hover span {color: {$all_element_color};}
  .vc_tta-color-grey.vc_tta-style-classic .vc_tta-tab.vc_active > a {color: {$all_element_color} !important;}

  .elstn-btn-one,
  input[type='submit'],
  .elstn-btn-two:hover,
  .elstn-btn-two:focus,
  .action-links .toggle-link:hover span,
  .action-links .toggle-link:hover span:before,
  .action-links .toggle-link:hover span:after,
  .action-links .grid-link:hover span,
  .action-links .grid-link:hover span:before,
  .action-links .grid-link:hover span:after,
  .elstn-about-wrap .nav-tabs li.active a:after,
  .project-grid a:hover span,
  .project-controls .action-links a.portfolio-link:hover span,
  .elstn-project-wrap .portfolio-title:after,
  .sidebar-widgets .widget_search input[type="submit"]:hover {background: {$all_element_color};}

  .elstn-btn-one:hover,
  input[type='submit']:hover,
  .elstn-btn-one:focus,
  input[type='submit']:focus,
  .elstn-btn-two:hover,
  .elstn-btn-two:focus,
  div.owl-dot.active,
  .vc_tta-tabs:not([class*=vc_tta-gap]):not(.vc_tta-o-no-fill).vc_tta-tabs-position-top .vc_tta-tab.vc_active>a::after,
  .elstn-back-top a:hover,
  .sticky .blog-item {border-color: {$all_element_color};}
  .content-inner blockquote, blockquote {border-left-color: {$all_element_color};}

CSS;
}

// Content Colors
$body_color  = cs_get_customize_option( 'body_color' );
if ($body_color) {
echo <<<CSS
  .no-class {}
  body , p, .elstn-blog-detail p, dd, .table>tbody>tr>td, address,.elstn-comments-area .elstn-comments-meta .comments-date, .testimonial-owner span, .content-inner h5, .content-inner h6, .content-inner ul li, .content-inner ol li, .blog-date,.content-inner .bp-tags span,input[type="text"], input[type="email"], input[type="tel"], input[type="search"], input[type="date"], input[type="time"], input[type="datetime-local"], input[type="month"], input[type="url"], input[type="number"], input[type="password"], textarea, select, .form-control,.elstn-testimonials p,.elstn-portfolio-detail .elstn-testimonials .testimonial-owner:before,.link-wrapper .fa-share-alt,.elstn-detail-container ul li span,.elstn-heading-wrap span,.elstn-detail-container.version2 .action-link,.elstn-services.version2 .service-info p,.about-text p,
  .about-text h4{color: {$body_color};}
  .content-inner ul li:before, .comment-area ul li:before{border-color: {$body_color};}
CSS;
}
$body_links_color  = cs_get_customize_option( 'body_links_color' );
if ($body_links_color) {
echo <<<CSS
  .no-class {}
  a,
  .content-inner a,
  .contact-list p a,
  .elstn-detail-wrap p a,
  .action-link a,
  nav ul li a.active,
  .blog-info .clearfix a,
  .elstn-load-more a,
  .elstn-about-wrap .nav-tabs li a.active,
  .vc_tta-color-grey.vc_tta-style-classic .vc_tta-tab.vc_active>a,
  .elstn-blogs.version2 .blog-item.ishover .blog-date a,
  .elstn-blogs.version2 .blog-date a,
  .elstn-blog-detail .blog-date a,
  .share-post h6 a,
  .share-post ul li a,
  .share-post ul li a .fa,
  .content-inner a,
  .content-inner .bp-tags li a,
  .contact-list p a,
  .contact-list .clearfix a,
  .elstn-detail-container ul li a,
  .link-wrapper a,
  .elstn-more-project a,
  .elstn-detail-wrap p a,
  .action-link a,
  .project-controls .action-links a,
  .elstn-project-wrap ul li span a,
  .elstn-more-project a,
  .project-grid a span,
  .see-project a,
  .elstn-back-top a,
  .woocommerce ul.product_list_widget a,
  .elstn-project-wrap ul li span,
  .banner-caption a,
  .portfolio-caption a {color: {$body_links_color};}

  .project-grid a span,div.owl-dot,
  .animation-arrow a::before,
  .animation-arrow a::after {background: {$body_links_color};}
CSS;
}
$body_link_hover_color  = cs_get_customize_option( 'body_link_hover_color' );
if ($body_link_hover_color) {
echo <<<CSS
  .no-class {}
  body a:hover,
  .portfolio-caption a:hover,
  .portfolio-caption.gray-color a:hover,
  nav ul li.sub-menu-item ul.sub-menu a:hover,
  .contact-links .block a:hover,
  .elstn-social-links a:hover,
  .elstn-wrapper .elstn-social-links a:hover,
  .banner-caption a:hover,
  .mate-contact-link ul li a:hover,
  .elstn-footer a:hover,
  .elstn-back-top a:hover,
  .blog-info .clearfix a:hover,
  .elstn-load-more a:hover,
  .share-post h6 a:hover,
  .share-post ul li a:hover,
  .share-post ul li a:hover i,
  .content-inner .bp-tags li a:hover,
  .contact-list p a:hover,
  .contact-list .clearfix a:hover,
  .elstn-detail-container ul li a:hover,
  .link-wrapper a:hover,
  .elstn-more-project a:hover,
  .project-controls .action-links a:hover,
  .elstn-project-wrap ul li span a:hover,
  .elstn-more-project a,
  .see-project a:hover,
  .elstn-back-top a:hover,
  .woocommerce ul.product_list_widget a:hover {color: {$body_link_hover_color};}

  .project-grid a:hover span,
  .animation-arrow a:hover:before,
  .animation-arrow a:hover:after {background: {$body_link_hover_color};}
CSS;
}

$sidebar_content_color  = cs_get_customize_option( 'sidebar_content_color' );
if ($sidebar_content_color) {
echo <<<CSS
  .no-class {}
  .contact-links,
  .contact-links .block,
  .contact-links .block p,
  .contact-links .block a,
  .elstn-social-links a,
  .action-links a,
  .widget_rss .rssSummary {color: {$sidebar_content_color};}

  .action-links .toggle-link span, .action-links .toggle-link span:before, .action-links .toggle-link span:after, .action-links .grid-link span, .action-links .grid-link span:before, .action-links .grid-link span:after{background: {$sidebar_content_color};}
CSS;
}


$sidebar_content_hover_color  = cs_get_customize_option( 'sidebar_content_hover_color' );
if ($sidebar_content_hover_color) {
echo <<<CSS
  .no-class {}
  .elstn-social-links a:hover,
  .elstn-social-links a:active,
  .elstn-social-links a:focus,
  .action-links a:hover,
  .action-links a:active,
  .action-links a:focus,
  .contact-links .block a:hover,
  .contact-links .block a:active,
  .contact-links .block a:focus{color: {$sidebar_content_hover_color};}

  .action-links .toggle-link:hover span, .action-links .toggle-link:hover span:before, .action-links .toggle-link:hover span:after, .action-links .grid-link:hover span, .action-links .grid-link:hover span:before, .action-links .grid-link:hover span:after {background: {$sidebar_content_hover_color};}
CSS;
}

$content_heading_color  = cs_get_customize_option( 'content_heading_color' );
if ($content_heading_color) {
echo <<<CSS
  .no-class {}
  h1,
  h2,
  h3,
  h4,
  .blog-name a,
  .portfolio-caption h2,
  .elstn-masonry .item .item-info h4,
  .contact-form h3,
  .elstn-products-wrap h3,
  .elstn-heading-wrap h3,
  .elstn-products-wrap h3,
  .elstn-top-banner.white-color .banner-caption h1,
  .elstn-wrapper .banner-caption h1,
  .elstn-heading-wrap h1,
  .content-inner h1,
  .elstn-blogs.version2 .elstn-top-title h1,
  .elstn-top-title h1,
  .elstn-contact-banner h2,
  .elstn-heading-wrap h2,
  .content-inner h2,
  .elstn-detail-container h2,
  .elstn-detail-wrap .elstn-heading-wrap h2,
  .elstn-detail-wrap.version2 .elstn-heading-wrap h2,
  .elstn-portfolio-detail.version2 .elstn-detail-container .elstn-heading-wrap h2,
  .elstn-detail-container.version2 h2,
  .elstn-comments-area .comments-title,
  .elstn-more-post .post-caption span,
  .comment-reply-title,
  .elstn-masonry .item .item-info h4 a,
  .elstn-masonry .item .item-info h4,
  .elstn-masonry .item .item-info h6,
  .contact-list h4,
  .elstn-services.version2 .service-info h4,
  .service-item .et-icon,
  .about-text h4,
  .elstn-about-wrap .nav-tabs li a, .elstn-about-wrap .nav-tabs li.vc_tta-tab a,
  .portfolio-title,
  .target-info h4,
  .elstn-comments-area .elstn-comments-meta h4,
  .service-info h4,
  .mate-name span {color: {$content_heading_color};}


  .elstn-detail-wrap .elstn-heading-wrap span:after, .elstn-detail-container.version2 ul:after{background-color: {$content_heading_color};}
CSS;
}

$footer_color  = cs_get_customize_option( 'footer_color' );
if ($footer_color) {
echo <<<CSS
  .no-class {}
  .elstn-footer,
  .elstn-footer h1,
  .elstn-footer h2,
  .elstn-footer h3,
  .elstn-footer h4,
  .elstn-footer li,
  .elstn-footer p{color: {$footer_color};}
CSS;
}

$footer_links_color  = cs_get_customize_option( 'footer_links_color' );
if ($footer_links_color) {
echo <<<CSS
  .no-class {}
  .elstn-footer a{color: {$footer_links_color};}
CSS;
}

$footer_link_hover_color  = cs_get_customize_option( 'footer_link_hover_color' );
if ($footer_link_hover_color) {
echo <<<CSS
  .no-class {}
  .elstn-footer a:hover, .elstn-footer a:active, .elstn-footer a:focus{color: {$footer_link_hover_color};}
CSS;
}

$menu_links_color  = cs_get_customize_option( 'menu_links_color' );
if ($menu_links_color) {
echo <<<CSS
  .no-class {}
  .elstn-sidebar nav ul > li,
  .elstn-sidebar nav ul > li > a{color: {$menu_links_color};}
CSS;
}

$menu_link_hover_color  = cs_get_customize_option( 'menu_link_hover_color' );
if ($menu_link_hover_color) {
echo <<<CSS
  .no-class {}
  .elstn-sidebar nav ul > li:hover,
  .elstn-sidebar nav ul > li > a:hover{color: {$menu_link_hover_color};}
CSS;
}

$submenu_color  = cs_get_customize_option( 'submenu_color' );
if ($submenu_color) {
echo <<<CSS
  .no-class {}
  .elstn-sidebar nav ul ul li,
  .elstn-sidebar nav ul ul li a,
  nav ul li.sub-menu-item ul.sub-menu li a {color: {$submenu_color};}
CSS;
}

$submenu_hover_color  = cs_get_customize_option( 'submenu_hover_color' );
if ($submenu_hover_color) {
echo <<<CSS
  .no-class {}
  .elstn-sidebar nav ul ul li:hover,
  .elstn-sidebar nav ul ul li a:hover,
  nav ul li.sub-menu-item ul.sub-menu li a:hover {color: {$submenu_hover_color};}
CSS;
}

// Maintenance Mode
$maintenance_mode_bg  = cs_get_option( 'maintenance_mode_bg' );
if ($maintenance_mode_bg) {
  $maintenance_css = ( ! empty( $maintenance_mode_bg['image'] ) ) ? 'background-image: url('. $maintenance_mode_bg['image'] .');' : '';
  $maintenance_css .= ( ! empty( $maintenance_mode_bg['repeat'] ) ) ? 'background-repeat: '. $maintenance_mode_bg['repeat'] .';' : '';
  $maintenance_css .= ( ! empty( $maintenance_mode_bg['position'] ) ) ? 'background-position: '. $maintenance_mode_bg['position'] .';' : '';
  $maintenance_css .= ( ! empty( $maintenance_mode_bg['attachment'] ) ) ? 'background-attachment: '. $maintenance_mode_bg['attachment'] .';' : '';
  $maintenance_css .= ( ! empty( $maintenance_mode_bg['size'] ) ) ? 'background-size: '. $maintenance_mode_bg['size'] .';' : '';
  $maintenance_css .= ( ! empty( $maintenance_mode_bg['color'] ) ) ? 'background-color: '. $maintenance_mode_bg['color'] .';' : '';
echo <<<CSS
  .no-class {}
  .vt-maintenance-mode {
    {$maintenance_css}
  }
CSS;
}

  echo $elston_get_typography;

  $output = ob_get_clean();
  return $output;

  }

}

/**
 * Custom Font Family
 */
if ( ! function_exists( 'elston_custom_font_load' ) ) {
  function elston_custom_font_load() {

    $font_family       = cs_get_option( 'font_family' );

    ob_start();

    if( ! empty( $font_family ) ) {

      foreach ( $font_family as $font ) {
        echo '@font-face{';

        echo 'font-family: "'. $font['name'] .'";';

        if( empty( $font['css'] ) ) {
          echo 'font-style: normal;';
          echo 'font-weight: normal;';
        } else {
          echo $font['css'];
        }

        echo ( ! empty( $font['ttf']  ) ) ? 'src: url('. esc_url($font['ttf']) .');' : '';
        echo ( ! empty( $font['eot']  ) ) ? 'src: url('. esc_url($font['eot']) .');' : '';
        echo ( ! empty( $font['svg']  ) ) ? 'src: url('. esc_url($font['svg']) .');' : '';
        echo ( ! empty( $font['woff'] ) ) ? 'src: url('. esc_url($font['woff']) .');' : '';
        echo ( ! empty( $font['otf']  ) ) ? 'src: url('. esc_url($font['otf']) .');' : '';

        echo '}';
      }

    }

    // Typography
    $output = ob_get_clean();
    return $output;
  }
}

/* Custom Styles */
if( ! function_exists( 'elston_custom_css' ) ) {
  function elston_custom_css() {
    wp_enqueue_style('elston-default-style', get_template_directory_uri() . '/style.css');
    $output  = elston_custom_font_load();
    $output .= elston_dynamic_styles();
    $output .= cs_get_option( 'theme_custom_css' );
    $custom_css = elston_compress_css_lines( $output );

    wp_add_inline_style( 'elston-default-style', $custom_css );
  }
  add_action( 'wp_enqueue_scripts', 'elston_custom_css' );
}

/* Custom JS */
if( ! function_exists( 'elston_custom_js' ) ) {
  function elston_custom_js() {
    if ( ! wp_script_is( 'jquery', 'done' ) ) {
      wp_enqueue_script( 'jquery' );
    }
    $output = cs_get_option( 'theme_custom_js' );
    wp_add_inline_script( 'jquery-migrate', $output );
  }
  add_action( 'wp_enqueue_scripts', 'elston_custom_js' );
}
