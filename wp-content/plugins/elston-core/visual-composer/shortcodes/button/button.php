<?php
/* ===========================================================
    Button
=========================================================== */
if ( !function_exists('elstn_button_function')) {
  function elstn_button_function( $atts, $content = NULL ) {

    extract(shortcode_atts(array(
      'button_size'  => '',
      'button_text'  => '',
      'button_link'  => '',
      'button_type'  => '',
      'button_style'  => '',
      'open_link'  => '',
      'class'  => '',
      // Styling
      'text_color'  => '',
      'text_hover_color'  => '',
      'bg_hover_color'  => '',
      'border_hover_color'  => '',
      'text_size'  => '',
      // Design
      'css' => ''
    ), $atts));

    // Design Tab
    $custom_css = ( function_exists( 'vc_shortcode_custom_css_class' ) ) ? vc_shortcode_custom_css_class( $css, ' ' ) : '';

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
    $button_type = ($button_type == 'btn-bg') ? ' elstn-btn-one' : ' elstn-btn-two';
    $button_style = ($button_style == 'rounded') ? ' elstn-btn-rounded' : '';

    $output = '<a class="elstn-btn '. $custom_css . $button_size . $button_type . $button_style . $styled_class . $class .'" '. $button_link . $open_link .'>' . $button_text .'</a>';

    return $output;

  }
}
add_shortcode( 'elstn_button', 'elstn_button_function' );
