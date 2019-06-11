<?php
/* ==========================================================
  Portfolio Title
=========================================================== */
if ( !function_exists('elstn_social_share_function')) {
  function elstn_social_share_function( $atts, $content = NULL ) {
    extract(shortcode_atts(array(
      'title'  => '',
      'share_alignment'  => '',
      'class'  => '',
    ), $atts));
    global $post;
    $page_url = get_permalink($post->ID );
    $title = $post->post_title;
    $share_text = cs_get_option('share_text');
    $share_text = $share_text ? $share_text : __( 'Share', 'elston-core' );
    $share_on_text = cs_get_option('share_on_text');
    $share_on_text = $share_on_text ? $share_on_text : __( 'Share', 'elston-core' );
    $share_alignment = $share_alignment ? $share_alignment : 'share-default';
    ob_start();
    ?>
    <div class="<?php echo esc_attr($share_alignment); ?>">
    <div class="elstn-share-link <?php echo esc_attr($class); ?>">
      <div class="link-wrapper">
        <i aria-hidden="true" class="fa fa-share-alt"></i>
        <span><?php echo esc_attr($share_text); ?></span>
          <a href="http://twitter.com/home?status=<?php print(urlencode($title)); ?>+<?php print(urlencode($page_url)); ?>" class="icon-fa-twitter" data-toggle="tooltip" data-placement="top" title="<?php echo esc_attr( $share_on_text .' '); echo esc_attr('Twitter', 'elston-core'); ?>"><i class="fa fa-twitter"></i></a>
          <a href="http://www.facebook.com/sharer/sharer.php?u=<?php print(urlencode($page_url)); ?>&amp;t=<?php print(urlencode($title)); ?>" class="icon-fa-facebook" data-toggle="tooltip" data-placement="top" title="<?php echo esc_attr( $share_on_text .' '); echo esc_attr('Facebook', 'elston-core'); ?>"><i class="fa fa-facebook"></i></a>
          <a href="http://www.linkedin.com/shareArticle?mini=true&amp;url=<?php print(urlencode($page_url)); ?>&amp;title=<?php print(urlencode($title)); ?>" class="icon-fa-linkedin" data-toggle="tooltip" data-placement="top" title="<?php echo esc_attr( $share_on_text .' '); echo esc_attr('Linkedin', 'elston-core'); ?>"><i class="fa fa-linkedin"></i></a>
          <a href="https://plus.google.com/share?url=<?php print(urlencode($page_url)); ?>" class="icon-fa-google-plus" data-toggle="tooltip" data-placement="top" title="<?php echo esc_attr( $share_on_text .' '); echo esc_attr('Google+', 'elston-core'); ?>"><i class="fa fa-google-plus"></i></a>
      </div>
    </div>
    </div>
    <?php
    $output = ob_get_clean();
    return $output;
  }
}
add_shortcode( 'elstn_social_share', 'elstn_social_share_function' );
