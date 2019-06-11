<?php
/* ==========================================================
  Banner
=========================================================== */
if ( !function_exists('elstn_banner_function')) {
  function elstn_banner_function( $atts, $content = NULL ) {
    extract(shortcode_atts(array(
      'type'  => '',
      'parallax_type'  => '',
      'text_color'  => '',
      'class'  => '',
    ), $atts));

    // Shortcode Style CSS
    $e_uniqid     = uniqid();
    $inline_style = '';

    // Text Color
    if ( $text_color ) {
      $inline_style .= '.elstn-text-'. $e_uniqid .' .banner-caption, .elstn-text-'. $e_uniqid .' .banner-caption h1, .elstn-text-'. $e_uniqid .' .banner-caption h2, .elstn-text-'. $e_uniqid .' .banner-caption h3, .elstn-text-'. $e_uniqid .' .banner-caption h4, .elstn-text-'. $e_uniqid .' .banner-caption p{';
      $inline_style .= ( $text_color ) ? 'color:'. $text_color .';' : '';
      $inline_style .= '}';
    }

    // add inline style
    add_inline_style( $inline_style );
    $styled_class = ' elstn-text-'. $e_uniqid;

    if ($type == 'fixed') {
      $type = 'elstn-fixed-section';
    } elseif($type == 'parallax'){
      if ($parallax_type == 'text') {
        $type = 'elstn-parallax-text';
      } else {
        $type = 'elstn-parallax-section';
      }
    } else {
      $type = '';
    }

    ob_start();
    ?>

    <?php if( $parallax_type != 'text' ) { ?>
    <div class="elstn-banner-spacer"></div>
    <?php } ?>

    <div class="elstn-top-banner <?php echo esc_attr($type);?> <?php echo $styled_class;?>">
      <div class="banner-caption">
        <div class="elstn-table-container">
          <div class="elstn-align-container">
            <?php echo do_shortcode( $content ); ?>
          </div>
        </div>
      </div>
    </div>

    <?php
    $output = ob_get_clean();

    return $output;
  }
}
add_shortcode( 'elstn_banner', 'elstn_banner_function' );
