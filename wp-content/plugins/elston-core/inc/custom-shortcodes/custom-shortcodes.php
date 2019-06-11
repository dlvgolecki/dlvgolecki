<?php
/* Spacer */
function elston_spacer_function($atts, $content = true) {
  extract(shortcode_atts(array(
    "height" => '',
  ), $atts));

  $result = do_shortcode('[vc_empty_space height="'. $height .'"]');
  return $result;

}
add_shortcode("elston_spacer", "elston_spacer_function");

/* Social Icon */
function elston_social_function($atts, $content = NULL) {
  extract(shortcode_atts(array(
    "custom_class" => '',
    "position" => '',
    "margin_top" => '',
    "margin_bottom" => '',
  ), $atts));

  if($position == 'left'){
    $position = 'social-left';
  } elseif($position == 'right'){
    $position = 'social-right';
  } else {
    $position = '';
  }
  $margin_top = ($margin_top) ? 'margin-top:'.$margin_top.';' : '';
  $margin_bottom = ($margin_bottom) ? 'margin-bottom:'.$margin_bottom.';' : '';
  ob_start();

  $data = elston_wp_share_option();

  $data.=ob_get_clean();
  $result = '<div class="clearfix '.$position.' '.$custom_class.'" style="'.$margin_top.' '.$margin_bottom.'">'.$data.'</div>';
  return $result;
}
add_shortcode("elston_social", "elston_social_function");

/* Simple Images */
function elston_image_lists_function($atts, $content = true) {
  extract(shortcode_atts(array(
    "custom_class" => '',
  ), $atts));

  $result = '<div class="clear-fix image-list '. $custom_class .'">'. do_shortcode($content) .'</div>';
  return $result;

}
add_shortcode("elston_image_lists", "elston_image_lists_function");

/* Simple Image */
function elston_image_list_function($atts, $content = NULL) {
  extract(shortcode_atts(array(
    "get_image" => '',
    "link" => '',
    "open_tab" => ''
  ), $atts));

  // Atts
  if ($get_image) {
    $my_image = ($get_image) ? '<img src="'. $get_image .'" alt=""/>' : '';
  } else {
    $my_image = '';
  }
  if ($link) {
    $open_tab = $open_tab ? 'target="_blank"' : '';
    $link_o = '<a href="'. $link .'" '. $open_tab .'>';
    $link_c = '</a>';
  } else {
    $link_o = '';
    $link_c = '';
  }

  $result = '<div class="clear-fix blog-picture">'. $link_o . $my_image . $link_c .'</div>';
  return $result;

}
add_shortcode("elston_image_list", "elston_image_list_function");

/* Simple Underline Link */
function elston_simple_link_function($atts, $content = NULL) {
  extract(shortcode_atts(array(
    "link_style" => '',
    "link_icon" => '',
    "link_text" => '',
    "link" => '',
    "target_tab" => '',
    "custom_class" => '',
    // Normal
    "text_color" => '',
    "border_color" => '',
    // Hover
    "text_hover_color" => '',
    "border_hover_color" => '',
    // Size
    "text_size" => '',
  ), $atts));

  // Atts
  $target_tab = $target_tab ? 'target="_blank"' : '';
  if ($link_style === 'link-arrow-right') {
    $arrow_icon = $link_icon ? ' <i class="'. $link_icon .'"></i>' : ' <i class="fa fa-caret-right"></i>';
  } elseif ($link_style === 'link-arrow-left') {
    $arrow_icon = $link_icon ? ' <i class="'. $link_icon .'"></i>' : ' <i class="fa fa-caret-left"></i>';
  } else {
    $arrow_icon = '';
  }
  $link_style = $link_style ? $link_style. ' ' : 'link-underline ';

  // Shortcode Style CSS
  $e_uniqid       = uniqid();
  $inline_style   = '';

  // Colors & Size
  if ( $text_color || $text_size ) {
    $inline_style .= '.elstn-simple-link-'. $e_uniqid .'.elstn-'. $link_style .', .elstn-simple-link-'. $e_uniqid .'.elstn-link-arrow-left i, .elstn-simple-link-'. $e_uniqid .'.elstn-link-arrow-right i {';
    $inline_style .= ( $text_color ) ? 'color:'. $text_color .';' : '';
    $inline_style .= ( $text_size ) ? 'font-size:'. elstn_check_px($text_size) .';' : '';
    $inline_style .= '}';
  }
  if ( $text_hover_color ) {
    $inline_style .= '.elstn-simple-link-'. $e_uniqid .'.elstn-'. $link_style .':hover, .elstn-simple-link-'. $e_uniqid .'.elstn-link-arrow-right:hover, .elstn-simple-link-'. $e_uniqid .'.elstn-link-arrow-left:hover, .elstn-simple-link-'. $e_uniqid .'.elstn-link-arrow-right:hover i, .elstn-simple-link-'. $e_uniqid .'.elstn-link-arrow-left:hover i {';
    $inline_style .= ( $text_hover_color ) ? 'color:'. $text_hover_color .';' : '';
    $inline_style .= '}';
  }
  if ( $border_color ) {
    $inline_style .= '.elstn-simple-link-'. $e_uniqid .'.elstn-'. $link_style .':after {';
    $inline_style .= ( $border_color ) ? 'background-color:'. $border_color .';' : '';
    $inline_style .= '}';
  }
  if ( $border_hover_color ) {
    $inline_style .= '.elstn-simple-link-'. $e_uniqid .'.elstn-'. $link_style .':hover:after {';
    $inline_style .= ( $border_hover_color ) ? 'background-color:'. $border_hover_color .';' : '';
    $inline_style .= '}';
  }

  // add inline style
  add_inline_style( $inline_style );
  $styled_class  = ' elstn-simple-link-'. $e_uniqid;

  $result = '<a href="'. $link .'" '. $target_tab .' class="elstn-'. $link_style . $custom_class . $styled_class .'">'. $link_text . $arrow_icon .'</a>';
  return $result;

}
add_shortcode("elston_simple_link", "elston_simple_link_function");

/* Address Infos */
function elston_address_infos_function($atts, $content = true) {
  extract(shortcode_atts(array(
    "custom_class" => ''
  ), $atts));

  $result = '<div class="contact-list '. $custom_class .'">'. do_shortcode($content) .'</div>';
  return $result;

}
add_shortcode("elston_address_infos", "elston_address_infos_function");

/* Useful Links */
function elston_useful_links_function($atts, $content = true) {
   extract(shortcode_atts(array(
      "column_width" => '',
      "custom_class" => ''
   ), $atts));

   $result = '<ul class="elstn-useful-links '. $custom_class .' '. $column_width .'">'. do_shortcode($content) .'</ul>';
   return $result;

}
add_shortcode("elston_useful_links", "elston_useful_links_function");

/* Useful Link */
function elston_useful_link_function($atts, $content = NULL) {
   extract(shortcode_atts(array(
      "target_tab" => '',
      "title_link" => '',
      "link_title" => ''
   ), $atts));

   $title_link = ( isset( $title_link ) ) ? 'href="'. $title_link . '"' : '';
   $target_tab = ( $target_tab === '1' ) ? 'target="_blank"' : '';

   $result = '<li><a '. $title_link . $target_tab .'>'. $link_title .'</a></li>';
   return $result;

}
add_shortcode("elston_useful_link", "elston_useful_link_function");

/* Blockquote */
function elston_blockquote_function($atts, $content = true) {
  extract(shortcode_atts(array(
    "blockquote_style" => '',
    "text_size" => '',
    "custom_class" => '',
    "content_color" => '',
    "left_color" => '',
    "border_color" => '',
    "bg_color" => ''
  ), $atts));

  // Shortcode Style CSS
  $e_uniqid        = uniqid();
  $inline_style  = '';

  // Text Color
  if ( $text_size || $content_color || $border_color || $bg_color ) {
    $inline_style .= '.elstn-blockquote-'. $e_uniqid .' {';
    $inline_style .= ( $text_size ) ? 'font-size:'. $text_size .' !important;' : '';
    $inline_style .= ( $content_color ) ? 'color:'. $content_color .' !important;' : '';
    $inline_style .= ( $border_color ) ? 'border-color:'. $border_color .' !important;' : '';
    $inline_style .= ( $bg_color ) ? 'background-color:'. $bg_color .' !important;' : '';
    $inline_style .= '}';
  }
  if ( $left_color ) {
    $inline_style .= '.elstn-blockquote-'. $e_uniqid .':before {';
    $inline_style .= ( $left_color ) ? 'background-color:'. $left_color .' !important;' : '';
    $inline_style .= '}';
  }

  // add inline style
  add_inline_style( $inline_style );
  $styled_class  = ' elstn-blockquote-'. $e_uniqid;

  // Style
  $blockquote_style = ($blockquote_style === 'style-two') ? 'blockquote-two ' : '';

  $result = '<blockquote class="blog-quote '. $blockquote_style . $custom_class . $styled_class .'">'. do_shortcode($content) .'</blockquote>';
  return $result;

}
add_shortcode("elston_blockquote", "elston_blockquote_function");

/* Email Shortcode */
function elston_email_address_function($atts, $content = NULL) {
  $atts = shortcode_atts( array(
    'before_text' => '',
    "custom_class" => '',
    'email' => '',
    'email_link' => '',
  ), $atts );

  $atts['before_text'] = ($atts['before_text']) ? $atts['before_text'] . ': ' : '';

  $result = '<div class="block clearfix'.$atts['custom_class'].'">'.$atts['before_text'].'<a href="mailto:'.$atts['email_link'].'">'.$atts['email'].'</a></div>';
  return $result;
}
add_shortcode( 'elston_email','elston_email_address_function' );

/* Phone Shortcode */
function elston_phone_address_function($atts, $content = NULL) {
  $atts = shortcode_atts( array(
    'before_text' => '',
    "custom_class" => '',
    'phone' => '',
    'phone_link' => '',
  ), $atts );

  $atts['before_text'] = ($atts['before_text']) ? $atts['before_text'] . ': ' : '';

  $result = '<div class="block clearfix'.$atts['custom_class'].'">'.$atts['before_text'].'<a href="tel:'.$atts['phone_link'].'">'.$atts['phone'].'</a></div>';
  return $result;
}
add_shortcode( 'elston_phone','elston_phone_address_function' );

/* Single Testimonial Shortcode */
function elston_single_testimonial_function($atts, $content = NULL) {
  $atts = shortcode_atts( array(
    'testimonial' => '',
    'client' => '',
    "custom_class" => '',
  ), $atts );
  $result = '<div class="elstn-testimonials '.$atts['custom_class'].'"><p>'.$atts['testimonial'].'</p><div class="testimonial-owner">'.$atts['client'].'</div></div>';
  return $result;
}
add_shortcode( 'elston_single_testimonial','elston_single_testimonial_function' );

/* Button Shortcode */
function elston_button_function( $atts, $content = NULL ) {
  extract(shortcode_atts(array(
    'button_size'  => '',
    'button_text'  => '',
    'button_link'  => '',
    'button_type'  => '',
    'button_style'  => '',
    'open_link'  => '',
    'custom_class'  => '',
    // Styling
    'text_color'  => '',
    'text_hover_color'  => '',
    'bg_hover_color'  => '',
    'border_hover_color'  => '',
    'text_size'  => '',
  ), $atts));

  // Shortcode Style CSS
  $e_uniqid        = uniqid();
  $inline_style  = '';

  // Button Text Color
  if ( $text_color ) {
    $inline_style .= '.elstn-btn-'. $e_uniqid .' .btn-text {';
    $inline_style .= ( $text_color ) ? 'color:'. $text_color .';' : '';
    $inline_style .= '}';
  }
  // Button Text Hover Color
  if ( $text_hover_color ) {
    $inline_style .= '.elstn-btn-'. $e_uniqid .':hover .btn-text, .elstn-btn-'. $e_uniqid .':focus .btn-text, .elstn-btn-'. $e_uniqid .':active .btn-text {';
    $inline_style .= ( $text_hover_color ) ? 'color:'. $text_hover_color .' !important;' : '';
    $inline_style .= '}';
  }
  // Text Size
  if ( $text_size ) {
    $inline_style .= '.elstn-btn-'. $e_uniqid .' {';
    $inline_style .= ( $text_size ) ? 'font-size:'. $text_size .';' : '';
    $inline_style .= '}';
  }
  // Button Hover Color
  if ( $bg_hover_color || $border_hover_color ) {
    $inline_style .= '.elstn-btn-'. $e_uniqid .':hover, .elstn-btn-'. $e_uniqid .':focus, .elstn-btn-'. $e_uniqid .':active {';
    $inline_style .= ( $bg_hover_color ) ? 'background:'. $bg_hover_color .' !important;' : '';
    $inline_style .= ( $border_hover_color ) ? 'border-color: '. $border_hover_color .' !important;' : '';
    $inline_style .= '}';
  }

  // add inline style
  add_inline_style( $inline_style );
  $styled_class  = ' elstn-btn-'. $e_uniqid;

  // Styling
  $button_size = $button_size ? ' '. $button_size : ' elstn-btn-medium';
  $button_text = $button_text ? '<span class="btn-text">'.$button_text.'</span>' : '';
  $button_link = $button_link ? 'href="'. $button_link .'"' : '';
  $open_link = $open_link ? ' target="_blank"' : '';
  $button_type = ($button_type == 'btn-one') ? ' elstn-btn-one' : ' elstn-btn-two';
  $button_style = ($button_style == 'rounded') ? ' elstn-btn-rounded' : '';

  $output = '<a class="elstn-btn ' . $button_size . $button_type . $button_style . $styled_class .' '. $custom_class .'" '. $button_link . $open_link .'>' . $button_text .'</a>';

  return $output;

}
add_shortcode( 'elston_button', 'elston_button_function' );

/* Current Year - Shortcode */
if( ! function_exists( 'elston_current_year' ) ) {
  function elston_current_year() {
    return date('Y');
  }
  add_shortcode( 'elston_current_year', 'elston_current_year' );
}

/* Get Home Page URL - Via Shortcode */
if( ! function_exists( 'elston_home_url' ) ) {
  function elston_home_url() {
    return esc_url( home_url( '/' ) );
  }
  add_shortcode( 'elston_home_url', 'elston_home_url' );
}
