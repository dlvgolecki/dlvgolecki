<?php
/* ==========================================================
  Portfolio Image
=========================================================== */
if ( !function_exists('elstn_portfolio_image_function')) {
  function elstn_portfolio_image_function( $atts, $content = NULL ) {
    extract(shortcode_atts(array(
      'title'  => '',
      'type'  => '',
      'image'  => '',
      'class'  => '',
    ), $atts));

    // Metabox
    $elston_meta  = get_post_meta( get_the_id(), 'portfolio_type_metabox', true );

    $popup_type = $elston_meta['portfolio_popup'];
    $popup_type = ($popup_type == 'popup_modern') ? 'popup-modern' : '' ;
    $large_image =  wp_get_attachment_image_src( $image, 'full' );
    $large_image = $large_image[0];

    ob_start();

    if($type == 'p_img_w'){ ?>
      <div class="popup <?php echo esc_attr($popup_type);?> <?php echo esc_attr($class);?>">
      <a href="<?php echo esc_url($large_image);?>"><img src="<?php echo esc_url($large_image);?>" alt=""></a>
      </div>
    <?php } elseif ($type == 'p_gal') { ?>
      <div class="gallery-item popup <?php echo esc_attr($popup_type);?> <?php echo esc_attr($class);?>">
        <a href="<?php echo esc_url($large_image);?>"><img src="<?php echo esc_url($large_image);?>" alt=""></a>
        <span><?php echo esc_attr($title);?></span>
      </div>
    <?php } else { ?>
      <div class="elstn-portfolio-picture popup <?php echo esc_attr($popup_type);?> <?php echo esc_attr($class);?>">
        <a href="<?php echo esc_url($large_image);?>"><img src="<?php echo esc_url($large_image);?>" alt=""></a>
      </div>
    <?php }

    $output = ob_get_clean();

    return $output;
  }
}
add_shortcode( 'elstn_portfolio_image', 'elstn_portfolio_image_function' );
