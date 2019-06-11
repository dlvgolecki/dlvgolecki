<?php
/* ==========================================================
  Portfolio Title
=========================================================== */
if ( !function_exists('elstn_contact_list_function')) {
  function elstn_contact_list_function( $atts, $content = NULL ) {
    extract(shortcode_atts(array(
      'contact_title'  => '',
      'class'  => '',
    ), $atts));

    $output = '<div class="contact-list '.$class.'"><h4>'.$contact_title.'</h4><p>'.do_shortcode( $content ).'</p></div>';

    return $output;
  }
}
add_shortcode( 'elstn_contact_list', 'elstn_contact_list_function' );
