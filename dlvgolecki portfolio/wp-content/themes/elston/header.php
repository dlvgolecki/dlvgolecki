<?php
/*
 * The header for our theme.
 * Author & Copyright: VictorThemes
 * URL: https://victorthemes.com
 */
?><!DOCTYPE html>
<!--[if IE 8]> <html <?php language_attributes(); ?> class="ie8"> <![endif]-->
<!--[if !IE]><!--> <html <?php language_attributes(); ?>> <!--<![endif]-->
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<?php
$viewport = cs_get_option('theme_responsive');
if($viewport == 'on') { ?>
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
<?php } else { }

if ( ! function_exists( 'has_site_icon' ) || ! has_site_icon() ) {
  if (cs_get_option('brand_fav_icon')) {
    echo '<link rel="shortcut icon" href="'. esc_url(wp_get_attachment_url(cs_get_option('brand_fav_icon'))) .'" />';
  } else { ?>
    <link rel="shortcut icon" href="<?php echo esc_url(ELSTON_IMAGES); ?>/favicon.png" />
  <?php }
  if (cs_get_option('iphone_icon')) {
    echo '<link rel="apple-touch-icon" sizes="57x57" href="'. esc_url(wp_get_attachment_url(cs_get_option('iphone_icon'))) .'" >';
  }
  if (cs_get_option('iphone_retina_icon')) {
    echo '<link rel="apple-touch-icon" sizes="114x114" href="'. esc_url(wp_get_attachment_url(cs_get_option('iphone_retina_icon'))) .'" >';
    echo '<link name="msapplication-TileImage" href="'. esc_url(wp_get_attachment_url(cs_get_option('iphone_retina_icon'))) .'" >';
  }
  if (cs_get_option('ipad_icon')) {
    echo '<link rel="apple-touch-icon" sizes="72x72" href="'. esc_url(wp_get_attachment_url(cs_get_option('ipad_icon'))) .'" >';
  }
  if (cs_get_option('ipad_retina_icon')) {
    echo '<link rel="apple-touch-icon" sizes="144x144" href="'. esc_url(wp_get_attachment_url(cs_get_option('ipad_retina_icon'))) .'" >';
  }
}
?>
<meta name="msapplication-TileColor" content="#ffffff">
<meta name="theme-color" content="#ffffff">

<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">

<?php

// Metabox
global $post;
$elston_id    = ( isset( $post ) ) ? $post->ID : false;
$elston_id    = ( is_home() ) ? get_option( 'page_for_posts' ) : $elston_id;
$elston_id    = ( elston_is_woocommerce_shop() ) ? wc_get_page_id( 'shop' ) : $elston_id;
$elston_id    = ( ! is_tag() && ! is_archive() && ! is_search() && ! is_404() && ! is_singular('testimonial') ) ? $elston_id : false;
$elston_meta  = get_post_meta( $elston_id, 'portfolio_type_metabox', true );
if ($elston_meta) {
  $portfolio_layout_options = $elston_meta['portfolio_layout_options'];
  $portfolio_layout_options = ($portfolio_layout_options == 'slider') ? 'scroll-false' : '' ;
} else {
  $portfolio_layout_options = '';
}

// Parallax
$bg_parallax = cs_get_option('theme_bg_parallax');
$hav_parallax = $bg_parallax ? ' parallax-window' : '';
$parallax_speed = cs_get_option('theme_bg_parallax_speed');
$bg_parallax_speed = $parallax_speed ? $parallax_speed : '0.4';

// Theme Layout Width
$bg_overlay_color  = cs_get_option( 'theme_bg_overlay_color' );
$sidebar_design = cs_get_option('select_sidebar_design');
$sidebar_click_active_class = ($sidebar_design == 'click') ? 'clickevent' : '';

wp_head();
?>
</head>

<?php
if ($bg_parallax) { ?>
  <body <?php echo body_class(); ?> data-stellar-background-ratio="<?php echo esc_attr($bg_parallax_speed); ?>">
<?php } else { ?>
  <body <?php echo body_class(); ?>>
<?php } ?>

<?php if($bg_overlay_color) { ?>
<div class="layout-overlay" style="background-color: <?php echo esc_attr($bg_overlay_color); ?>;"></div>
<?php } ?>

<div id="elston-wrapper" class="<?php echo esc_attr($sidebar_click_active_class); ?>"> <!-- #elston-wrapper -->

  <!-- elstn sidebar -->
  <?php get_template_part( 'layouts/sidebar/main' ); ?>

  <!-- elstn wrapper -->
  <div class="elstn-wrapper">
    <div class="elstn-wrap-inner"><?php
