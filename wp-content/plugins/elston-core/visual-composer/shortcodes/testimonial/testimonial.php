<?php
/* ===========================================================
    Testimonial
=========================================================== */
if ( !function_exists('elstn_testimonial_function')) {
  function elstn_testimonial_function( $atts, $content = NULL ) {

    extract(shortcode_atts(array(
      'type'  => '',
      'item'  => '',
      'testi_orderby'  => '',
      'testi_order'  => '',
      'testi_ids'  => '',
      'class'  => '',
    ), $atts));

    $testi_ids = ($testi_ids) ? array($testi_ids) : array();

    $args = array(
      // other query params here,
      'post_type' => 'testimonial',
      'post_status' => 'publish',
      'posts_per_page' => (int)$item,
      'orderby' => $testi_orderby,
      'order' => $testi_order,
      'post__in' => $testi_ids
    );

    $testi = new WP_Query($args);

    ob_start();

    if($testi->have_posts()){

      if($type == 'testi-bg'){ ?>
      <div class="elstn-testimonials testimonial-bg <?php esc_attr($class);?>">
        <div class="elstn-table-container">
          <div class="elstn-align-container">
            <div class="wrapper">
              <div class="elstn-default-slider" data-items="1" data-margin="0" data-loop="true" data-nav="false">
                <?php while($testi->have_posts()) { $testi->the_post();?>
                <div class="item">
                  <?php the_content();
                    global $post;
                    $elston_meta  = get_post_meta( $post->ID, 'testimonial_options', true );
                    $testi_name = $elston_meta['testi_name'];
                    $testi_pro = $elston_meta['testi_pro'];
                    $testi_name = ($testi_name) ? $testi_name : '' ;
                    $testi_pro = ($testi_pro) ? $testi_pro : '' ;
                  ?>
                  <div class="testimonial-owner"><?php echo esc_attr($testi_name);?> <span>- <?php echo esc_attr($testi_pro);?></span></div>
                </div>
                <?php } ?>
              </div>
            </div>
          </div>
        </div>
      </div>
      <?php } else { ?>
      <div class="elstn-testimonials <?php esc_attr($class);?>">
        <div class="wrapper">
          <div class="elstn-default-slider" data-items="1" data-margin="0" data-loop="false" data-nav="false">
            <?php while($testi->have_posts()) { $testi->the_post();?>
            <div class="item">
              <?php the_content();

                global $post;
                $elston_meta  = get_post_meta( $post->ID, 'testimonial_options', true );
                $testi_name = $elston_meta['testi_name'];
                $testi_name = ($testi_name) ? $testi_name : '' ;
              ?>
              <div class="testimonial-owner"><?php echo esc_attr($testi_name);?></div>
            </div>
            <?php } ?>
          </div>
        </div>
      </div>
      <?php }

      } else { ?>
      <div class="elstn-testimonials"><p><?php echo esc_html__( 'No Testimonial Found', 'elston-core' );?></p></div>
    <?php }

    wp_reset_postdata();
    $output = ob_get_clean();

    return $output;

  }
}
add_shortcode( 'elstn_testimonial', 'elstn_testimonial_function' );
