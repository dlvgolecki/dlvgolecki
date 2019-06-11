<?php
/* ==========================================================
  Title Block
=========================================================== */
if ( !function_exists('elstn_title_block_function')) {
  function elstn_title_block_function( $atts, $content = NULL ) {
    extract(shortcode_atts(array(
      'title'  => '',
      'class'  => '',
    ), $atts));

    ob_start();
    ?>
    <div class="elstn-top-title <?php echo esc_html( $class ); ?>">
      <h1><?php echo esc_html( $title ); ?></h1>
      <p><?php echo do_shortcode( $content ); ?></p>
    </div>
    <?php
    $output = ob_get_clean();

    return $output;
  }
}
add_shortcode( 'elstn_title_block', 'elstn_title_block_function' );
