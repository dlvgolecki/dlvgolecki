<?php
/* ==========================================================
  Team
=========================================================== */
if ( !function_exists('elstn_team_function')) {
  function elstn_team_function( $atts, $content = NULL ) {
    extract(shortcode_atts(array(
      'title'  => '',
      'team_limit'  => '',
      'team_orderby'  => '',
      'team_order'  => '',
      'team_ids'  => '',
      'class'  => '',
    ), $atts));

    // $team_ids = ($team_ids) ? array($team_ids) : array();
    // Show ID
    if ($team_ids) {
      $team_ids = explode(',',$team_ids);
    } else {
      $team_ids = '';
    }

    $args = array(
      // other query params here,
      'post_type' => 'team',
      'post_status' => 'publish',
      'posts_per_page' => (int)$team_limit,
      'orderby' => $team_orderby,
      'order' => $team_order,
      'post__in' => $team_ids
    );

    $elstn_team = new WP_Query( $args );

    ob_start();
    ?>
    <div class="elstn-team <?php echo esc_attr( $class );?>">
      <?php
      if ($elstn_team->have_posts()) : while ($elstn_team->have_posts()) : $elstn_team->the_post();

        $large_image =  wp_get_attachment_image_src( get_post_thumbnail_id(), 'fullsize', false, '' );
        $large_image = $large_image[0];
        $post_img = aq_resize( $large_image, '465', '520', true );
        $post_meta = get_post_meta( get_the_ID(), 'team_options', true );
        $team_job_position = $post_meta['team_job_position'];
        $team_social_profiles = $post_meta['team_social_profiles'];
        $team_email_link = $post_meta['team_email_link'];
      ?>
      <div class="mate-list">
        <div class="mate-contact-link">
          <ul>
            <?php if($team_social_profiles) {
              foreach($team_social_profiles as $profile) { ?>
              <li>
                <a href="<?php echo esc_url( $profile['team_social_link'] );?>"><?php echo esc_attr__( $profile['team_social_title'], 'elston-core' ); ?></a>
              </li>
              <?php }
            }
            if($team_email_link) { ?>
            <li>
              <a href="mailto:<?php echo $team_email_link;?>"><?php echo esc_attr( $team_email_link );?></a>
            </li>
            <?php } ?>
          </ul>
        </div>
        <div class="mate-name">
          <span><?php the_title();?></span>
          <?php if($team_email_link) { ?>
          <div class="clearfix"><?php echo esc_attr( $team_job_position );?></div>
          <?php } ?>
        </div>
        <?php if($post_img) { ?>
          <img src="<?php echo esc_url( $post_img );?>" alt="" />
        <?php } ?>
      </div>
      <?php
        endwhile;
        endif;
        wp_reset_postdata();
      ?>
    </div>
    <?php
    $output = ob_get_clean();

    return $output;
  }
}
add_shortcode( 'elstn_team', 'elstn_team_function' );
