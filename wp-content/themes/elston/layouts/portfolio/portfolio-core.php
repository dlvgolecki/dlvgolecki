<?php
/* Grid or Full page portfolio page (loop items)
 * Author & Copyright: VictorThemes
 * URL: https://victorthemes.com
 */

// Metabox
$elston_id    = ( isset( $post ) ) ? $post->ID : 0;
$elston_meta  = get_post_meta( $elston_id, 'portfolio_type_metabox', true );
$view_case_studies_text = cs_get_option('portfolio_wide_style_banner_link_text');
$view_case_studies_text = $view_case_studies_text ? $view_case_studies_text : esc_attr__( 'View case studies', 'elston' );

$portfolio_style = cs_get_option('portfolio_style');
$view_more = cs_get_option('view_more_text');
$view_more = $view_more ? $view_more : esc_html__('View More', 'elston');
$portfolio_hover_style = cs_get_option('portfolio_hover_style');

  // Category
  global $post;
  $terms = wp_get_post_terms( $post->ID, 'portfolio_category' );
  $cat_class ='';
  foreach ($terms as $term) {
    $cat_class .= 'cat-' . $term->slug . ' ';
  }

  $cat_name = array();
  foreach ($terms as $tname) {
    $cat_name[]= $tname->name;
  }
  $term_cat = join( ", ", $cat_name );

  // Featured Image
  $large_image =  wp_get_attachment_image_src( get_post_thumbnail_id(get_the_ID()), 'fullsize', false, '' );
  $large_image = $large_image[0];
  if ($portfolio_style == 'wide' || $portfolio_style == 'masonry') {
    $portfolio_img = $large_image;
    if ($elston_meta && $elston_meta['portfolio_wide_image']) {
      $featured_img = wp_get_attachment_url($elston_meta['portfolio_wide_image']);
    } else {
      $featured_img = ( $portfolio_img ) ? $portfolio_img : esc_url(ELSTON_IMAGES) . '/banner/1920x1050.png';
    }
  } else {
    $portfolio_img = aq_resize( $large_image, '465', '350', true );
    $featured_img = ( $portfolio_img ) ? $portfolio_img : esc_url(ELSTON_IMAGES) . '/banner/465x350.png';
  }
?>

<?php if ($portfolio_style == 'wide') { ?>
<div class="section moveDown elstn-fixed-bg" id="section<?php echo esc_attr($post->ID);?>" style="background-image:url(<?php echo esc_url($featured_img); ?>);">
  <div class="portfolio-caption gray-color">
    <h2><?php esc_attr(the_title()); ?></h2>
    <div class="clearfix"><a href="<?php esc_url(the_permalink()); ?>"><?php echo $view_case_studies_text; ?></a></div>
  </div>
</div>
<?php } else { ?>
<div class="item <?php echo esc_attr($cat_class); ?>" data-category="<?php echo esc_attr($cat_class); ?>">
  <div class="item-info">
    <div class="elstn-table-container">
      <div class="elstn-align-container">
        <h4><a href="<?php esc_url(the_permalink()); ?>"><?php esc_attr(the_title()); ?></a></h4>
        <h6><?php echo esc_attr($term_cat); ?></h6>
      </div>
    </div>
  </div>
  <?php if ($portfolio_hover_style === 'expand-hover') { ?>
  <div class="expand-hover-bg"></div>
  <?php } ?>
  <img src="<?php echo esc_url($featured_img); ?>" alt="<?php echo esc_attr(get_the_title()); ?>"/>
</div>
<?php }