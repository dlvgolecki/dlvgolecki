<?php
/* ==========================================================
  Service Info
=========================================================== */
if ( !function_exists('elstn_service_info_function')) {
  function elstn_service_info_function( $atts, $content = NULL ) {
    extract(shortcode_atts(array(
      'title'  => '',
      'type'  => '',
      'des'  => '',
      'icon'  => '',
      'class'  => '',
    ), $atts));

    ob_start();

    if($type=='group'){ ?>
      <div class="service-item <?php echo esc_attr($class) ;?>">
        <div class="pull-left"><i class="et-icon <?php echo esc_attr($icon) ;?>"></i></div>
        <div class="service-info">
          <h4><?php echo esc_html($title) ;?></h4>
          <p style="line-height:1.6;"><?php echo do_shortcode( $content );?></p>
        </div>
      </div>
      <?php } else { ?>
      <div class="service-info <?php echo esc_attr($class) ;?>">
        <i class="et-icon <?php echo esc_attr($icon) ;?>"></i>
        <h4><?php echo esc_html($title) ;?></h4>
        <p style="line-height:1.7;"><?php echo do_shortcode( $content );?></p>
      </div>
      <?php }
    $output = ob_get_clean();

    return $output;
  }
}
add_shortcode( 'elstn_service_info', 'elstn_service_info_function' );
