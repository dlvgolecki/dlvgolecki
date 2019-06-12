<?php
// Metabox
$elston_id    = ( isset( $post ) ) ? $post->ID : 0;
$elston_id    = ( is_home() ) ? get_option( 'page_for_posts' ) : $elston_id;
$elston_id    = ( elston_is_woocommerce_shop() ) ? wc_get_page_id( 'shop' ) : $elston_id;
$elston_id    = ( ! is_tag() && ! is_archive() && ! is_search() && ! is_404() && ! is_singular('testimonial') ) ? $elston_id : false;
$elston_meta  = get_post_meta( $elston_id, 'page_type_metabox', true );

$mobile_breakpoint = cs_get_option('mobile_breakpoint');
$breakpoint = $mobile_breakpoint ? $mobile_breakpoint : '767';

$select_sidebar_design = cs_get_option('select_sidebar_design');
$sidebar_design = $select_sidebar_design ? $select_sidebar_design : 'hover';
$sidebar_design_class = ($select_sidebar_design == 'click') ? 'nav-slyder' : '';

$walker_classname = 'wp_'.$sidebar_design.'_navwalker';

if ($elston_meta) {
  $choose_menu = $elston_meta['choose_menu'];
} else { $choose_menu = ''; }
$choose_menu = $choose_menu ? $choose_menu : '';

wp_nav_menu(
  array(
    'menu'              => 'primary',
    'theme_location'    => 'primary',
    'container'         => '',
    'container_class'   => '',
    'container_id'      => '',
    'menu'              => $choose_menu,
    'menu_id'           => 'main-nav',
    'menu_class'        => $sidebar_design_class,
    'fallback_cb'       => 'wp_'.$sidebar_design.'_navwalker::fallback',
    'walker'            => new $walker_classname()
  )
);
