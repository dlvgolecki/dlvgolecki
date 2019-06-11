<?php
/* ==========================================================
  Portfolio
=========================================================== */
if ( !function_exists('elstn_portfolio_function')) {
  function elstn_portfolio_function( $atts, $content = NULL ) {
    extract(shortcode_atts(array(
      'class'  => '',
      'style'  => '',
      'hover_style'  => '',
      'banner_title'  => '',
      'banner_subtitle'  => '',
      'banner_link'  => '',
      'banner_link_text'  => '',
      'banner_image'  => '',
      'pagination'  => '',
      'pagination_type'  => '',
      'posts_per_page'  => -1,
      'category'  => '',

      // Listing
      'blog_order'  => '',
      'blog_col'  => '',
      'blog_orderby'  => '',
      'blog_show_category'  => '',
    ), $atts));

    $banner_image = ($banner_image) ? wp_get_attachment_url( $banner_image, 'full' ) : ELSTN_PLUGIN_ASTS . '/images/1920x1050.png' ;

    if ($style == 'wide') {
      $portfolio_core_style = '';
      $hover_style = '';
      $portfolio_col = '';
      $portfolio_id = 'elstn-fullpage';
    } else {
      $portfolio_core_style = 'elstn-masonry';
      $portfolio_id = '';
      $portfolio_col = $blog_col;
    }

    $more_text = cs_get_option('more_text');
    $portfolio_pagination = cs_get_option('portfolio_pagination');

    if (is_cs_framework_active()) {
      $view_case_studies_text = cs_get_option('portfolio_wide_style_banner_link_text');
      $view_case_studies_text = $view_case_studies_text ? $view_case_studies_text : esc_attr__( 'View case studies', 'elston' );
    } else {
      $view_case_studies_text = esc_attr__( 'View case studies', 'elston' );
    }

    // Metabox
    // $elston_id    = ( isset( $post ) ) ? $post->ID : 0;
    // $elston_id    = ( is_home() ) ? get_option( 'page_for_posts' ) : $elston_id;
    // $elston_id    = ( elston_is_woocommerce_shop() ) ? wc_get_page_id( 'shop' ) : $elston_id;
    // $elston_meta  = get_post_meta( $elston_id, 'portfolio_type_metabox', true );

    ob_start(); ?>

      <!-- Portfolio Start -->
      <div id="<?php echo esc_attr($portfolio_id); ?>" class="elstn-portfolios content_ajax <?php echo esc_attr($portfolio_core_style); ?> <?php echo esc_attr($portfolio_col); ?> <?php echo esc_attr($hover_style); ?> <?php echo esc_attr($class); ?>">
          <?php if ($style == 'wide') { ?>
          <div class="section moveDown elstn-fixed-bg" id="section1" style="background-image:url(<?php echo esc_url($banner_image);?>);">
            <div class="banner-caption">
              <div class="elstn-table-container">
                <div class="elstn-align-container">
                  <?php if ($banner_title || $banner_subtitle) { ?>
                    <h1><?php echo esc_attr__($banner_title, 'elston-core');?><br>
                    <?php echo esc_attr__($banner_subtitle, 'elston-core');?></h1>
                  <?php } ?>

                  <?php if ($banner_link_text) { ?>
                  <div class="clearfix"><a href="<?php echo esc_url($banner_link);?>"><?php echo esc_attr__($banner_link_text, 'elston-core');?></a></div>
                  <?php } ?>
                  <ul id="menu">
                    <li class="animation-arrow"><a href="#"></a></li>
                  </ul>
                </div>
              </div>
            </div>
          </div>
          <?php } ?>

          <?php
            if ($style == 'wide') {
              $args = array(
                'post_type' => 'portfolio',
                'status' => 'publish',
                'tax_query' => array(
                  array(
                    'taxonomy' => 'portfolio_category',
                    'field'    => 'term_id',
                    'terms'    => $category
                  ),
                ),
              );
            } else {
              if ( get_query_var('paged') ) {
                $paged = get_query_var('paged');
              }
              elseif ( get_query_var('page') ) {
                $paged = get_query_var('page');
              }
              else {
                $paged = 1;
              }
              if ($blog_show_category) {
                $args = array(
                  'post_type' => 'portfolio',
                  'status' => 'publish',
                  'paged' => $paged,
                  'posts_per_page' => $posts_per_page,
                  'portfolio_category' => explode(',',$blog_show_category),
                  'orderby' => $blog_orderby,
                  'order' => $blog_order
                );
              } else {
                $args = array(
                  'post_type' => 'portfolio',
                  'status' => 'publish',
                  'paged' => $paged,
                  'posts_per_page' => $posts_per_page,
                  'orderby' => $blog_orderby,
                  'order' => $blog_order
                );
              }
            }

            $portfolio = new WP_Query($args);
            /* Start the Loop */
            if ($portfolio->have_posts()) : while ($portfolio->have_posts()) : $portfolio->the_post();
          ?>

          <?php
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

            $elston_meta = get_post_meta( $post->ID, 'portfolio_type_metabox', true );

            // Featured Image
            $large_image =  wp_get_attachment_image_src( get_post_thumbnail_id(), 'fullsize', false, '' );
            $large_image = $large_image[0];
            $portfolio_img = $large_image;
            if ($style == 'wide') {
              if ($elston_meta['portfolio_wide_image']) {
                $featured_img = wp_get_attachment_url($elston_meta['portfolio_wide_image']);
              } else {
                $featured_img = ( $portfolio_img ) ? $portfolio_img : ELSTN_PLUGIN_ASTS . '/images/1920x1050.png';
              }
            } elseif($style == 'masonry'){
              if ($elston_meta['portfolio_masonry_image']) {
                $featured_img = wp_get_attachment_url($elston_meta['portfolio_masonry_image']);
              } else {
                $featured_img = ( $portfolio_img ) ? $portfolio_img : ELSTN_PLUGIN_ASTS . '/images/1000x800.jpg';
              }
            } else {
              if ($portfolio_col == 'col-item-2') {
                $featured_img = $large_image;
              } elseif ($portfolio_col == 'col-item-3') {
                $featured_img = aq_resize( $large_image, '651', '490', false );
              } elseif ($portfolio_col == 'col-item-4' || $portfolio_col == 'col-item-5') {
                $featured_img = aq_resize( $large_image, '465', '350', false );
              } else {
                $featured_img = aq_resize( $large_image, '465', '350', false );
              }
              if ($featured_img) {
                $featured_img = $featured_img;
              } else {
                $featured_img = ELSTN_PLUGIN_ASTS . '/images/660x500.png';
              }
            }
          ?>

          <?php if ($style == 'wide') {
              $elston_meta  = get_post_meta( $post->ID, 'portfolio_type_metabox', true );

              if ($elston_meta) {
                if ($elston_meta['portfolio_wide_color']) {
                  $heading_color = $elston_meta['portfolio_wide_color'];
                } else {
                  $heading_color = '';
                }
              } else {
                $heading_color = '';
              }
          ?>
          <div class="section moveDown elstn-fixed-bg" id="section<?php echo $post->ID;?>" style="background-image:url(<?php echo esc_url($featured_img); ?>);">
            <div class="portfolio-caption">
              <h2 style="color: <?php echo esc_attr($heading_color); ?>"><?php esc_html(the_title()); ?></h2>
              <div class="clearfix"><a style="color: <?php echo esc_attr($heading_color); ?>" href="<?php esc_url(the_permalink()); ?>"><?php echo esc_attr($view_case_studies_text); ?></a></div>
            </div>
          </div>
          <?php } else {
            if ($elston_meta) {
              if ($style == 'masonry' && $elston_meta['portfolio_masonry_wh'] == 'f_width') {
                $masonry_c_class = 'item-half ';
              } else {
                $masonry_c_class = '';
              }
            }
          ?>
          <div class="item <?php echo esc_attr($masonry_c_class) . esc_attr($cat_class); ?>" data-category="<?php echo esc_attr($cat_class); ?>">
            <div class="item-info">
              <div class="elstn-table-container">
                <div class="elstn-align-container">
                  <h4><a href="<?php esc_url(the_permalink()); ?>"><?php esc_html(the_title()); ?></a></h4>
                  <h6><?php echo esc_attr($term_cat); ?></h6>
                </div>
              </div>
            </div>
            <?php if ($hover_style === 'expand-hover') { ?>
            <div class="expand-hover-bg"></div>
            <?php }
            if ($featured_img) { ?>
            <img src="<?php echo esc_url($featured_img); ?>" alt="<?php echo esc_attr(get_the_title()); ?>"/>
            <?php } ?>
          </div>
          <?php } ?>
        <?php
          endwhile;
        else :
          get_template_part( 'layouts/post/content', 'none' );
        endif;
        wp_reset_postdata(); ?>

      </div><!-- Portfolios End -->

      <?php
        if ($portfolio_pagination) {
          if ($pagination) {
            if ($pagination_type == 'ajax') { elston_ajax_more_portfolio_post_init($posts_per_page);?>
              <div id="elston-load-portfolio-posts" class="elstn-load-more"><a href="#0"><?php echo esc_attr__($more_text, 'elston-core'); ?></a></div>
              <?php
            } else { ?>
              <div class="elstn-load-more">
                <?php wp_pagenavi( array( 'query' => $portfolio ) ); ?>
              </div>
              <?php

            }
          }
        }
        wp_reset_postdata();  // avoid errors further down the page
      ?>

    <?php
    $output = ob_get_clean();

    return $output;
  }
}
add_shortcode( 'elstn_portfolio', 'elstn_portfolio_function' );
