<?php
/* ==========================================================
  Portfolio Title
=========================================================== */
if ( !function_exists('elstn_clients_function')) {
  function elstn_clients_function( $atts, $content = NULL ) {
    extract(shortcode_atts(array(
      'images'  => '',
      'item'  => 5,
      'loop'  => false,
      'class'  => '',
    ), $atts));

    ob_start();
    ?>

    <div class="elstn-clients <?php echo esc_attr( $class ); ?>">
      <div class="wrapper">
        <div class="elstn-default-slider" data-items="<?php echo esc_attr( $item ); ?>" data-margin="0" data-loop="<?php echo esc_attr( $loop ); ?>" data-nav="false">
          <?php
          if( !empty( $images ) ) {
            $clients = explode( ',', $images );
            foreach($clients as $client){
              $large_image =  wp_get_attachment_image_src( $client, 'full' );
              $large_image =  $large_image[0];
              $client_image =  aq_resize( $large_image, '109', '83', true );
            ?>
            <div class="item"><img src="<?php echo esc_url($client_image);?>" alt=""/></div>
            <?php } ?>
          <?php } ?>
        </div>
      </div>
    </div>

    <?php
    $output = ob_get_clean();

    return $output;
  }
}
add_shortcode( 'elstn_clients', 'elstn_clients_function' );
