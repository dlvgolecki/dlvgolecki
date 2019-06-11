<?php
/* ==========================================================
  Portfolio Title
=========================================================== */
if ( !function_exists('elstn_target_info_function')) {
  function elstn_target_info_function( $atts, $content = NULL ) {
    extract(shortcode_atts(array(
      'title'  => '',
      'des'  => '',
      'class'  => '',
    ), $atts));

    ob_start();
    ?>
      <div class="target-info <?php echo esc_attr($class) ;?>">
        <h4><?php echo esc_html($title) ;?></h4>
        <p style="line-height:1.7;"><?php echo do_shortcode( $content );?></p>
      </div>
    <?php
    $output = ob_get_clean();

    return $output;
  }
}
add_shortcode( 'elstn_target_info', 'elstn_target_info_function' );
