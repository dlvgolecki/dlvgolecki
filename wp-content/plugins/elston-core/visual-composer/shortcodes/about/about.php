<?php
/* ==========================================================
  Portfolio Title
=========================================================== */
if ( !function_exists('elstn_about_function')) {
  function elstn_about_function( $atts, $content = NULL ) {
    extract(shortcode_atts(array(
      'title'  => '',
      'sub_title'  => '',
      'text'  => '',
      'link'  => '',
      'about_image'  => '',
      'about_image_position'  => '',
      'btn_type'  => '',
      'btn_style'  => '',
      'btn_size'  => '',
      'btn_open_link'  => '',
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

    $large_image = wp_get_attachment_image_src( $about_image, 'full' );
    $large_image = $large_image[0];
    $image = aq_resize( $large_image, '930', '1050', true );

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
    $text = $text ? '<span class="btn-text">'.$text.'</span>' : '';
    $link = $link ? 'href="'. $link .'"' : '';
    $btn_open_link = $btn_open_link ? ' target="_blank"' : '';

    $btn_type = ($btn_type == 'btn-bg') ? 'elstn-btn-one' : 'elstn-btn-two';
    $btn_style = ($btn_style == 'rounded') ? 'elstn-btn-rounded' : '';
    if ($btn_size == 'medium') {
      $btn_size = 'elstn-btn-medium';
    } elseif ($btn_size == 'large'){
      $btn_size = 'elstn-btn-large';
    } else {
      $btn_size = '';
    }

    ob_start();
    ?>

    <div class="about-wrapper <?php echo esc_attr( $class );?>">
      <?php if( $about_image_position == 'left' ) { ?>
      <div class="col-md-6">
        <div class="about-picture" style="background-image: url(<?php echo esc_attr( $image );?>);"></div>
      </div>
      <?php } ?>
      <div class="col-md-6">
        <div class="elstn-table-container">
          <div class="elstn-align-container">
            <div class="about-text">
              <div class="elstn-heading-wrap">
              <h1 class="elstn-heading"><?php echo esc_html( $title );?></h1>
              <span class="elstn-sub-heading"><?php echo esc_html( $sub_title );?></span>
              </div>
              <?php echo do_shortcode( $content );?>
              <?php if($text){ ?>
              <div class="contact-button"><a class="elstn-btn <?php echo $custom_css .' '.$btn_size .' '. $btn_type .' '. $btn_style .' '. $styled_class; ?>" <?php echo $link . $btn_open_link;?>><?php echo $text;?></a></div>
              <?php } ?>
            </div>
          </div>
        </div>
      </div>
      <?php if( $about_image_position == 'right' ) { ?>
      <div class="col-md-6">
        <div class="about-picture" style="background-image: url(<?php echo esc_attr( $image );?>);"></div>
      </div>
      <?php } ?>
    </div>

    <?php
    $output = ob_get_clean();

    return $output;
  }
}
add_shortcode( 'elstn_about', 'elstn_about_function' );
