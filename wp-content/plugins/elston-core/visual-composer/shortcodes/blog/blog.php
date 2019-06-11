<?php
/* ==========================================================
  Blog
=========================================================== */
if ( !function_exists('elstn_blog_function')) {
  function elstn_blog_function( $atts, $content = NULL ) {

    extract(shortcode_atts(array(
      'blog_style'  => '',
      'blog_limit'  => '',
      // Enable & Disable
      'blog_category'  => '',
      'blog_date'  => '',
      'blog_pagination'  => '',
      'more_text'  => '',
      'loading_text'  => '',
      'end_text'  => '',
      // Listing
      'blog_order'  => '',
      'blog_orderby'  => '',
      'blog_show_category'  => '',
      'class'  => '',
      // Read More Text
      'read_more_txt'  => '',
    ), $atts));

    // Theme Options
    $pagination_type = ($blog_pagination) ? $blog_pagination : cs_get_option('pagination_type');
    $more_text = ($more_text) ? $more_text : cs_get_option('more_text');
    $blog_style = ($blog_style) ? $blog_style : cs_get_option('blog_listing_style');
    if($blog_style == 'modern'){
      $blog_version = 'version2';
      $blog_container = 'clearfix';
      $blog_col = 'content_ajax';
      $load_more_class = '';
    } else {
      $blog_version = 'version1';
      $blog_container = 'container';
      $blog_col = 'content_ajax elstn-masonry col-item-3';
      $load_more_class = 'space2';
    }
    $read_more_txt = ($read_more_txt) ? $read_more_txt : cs_get_option('read_more_text');
    $read_text = $read_more_txt ? $read_more_txt : __( 'Read More', 'elston-core' );

    $metas_hide = (array) cs_get_option( 'theme_metas_hide' );

    $title = get_bloginfo( 'name', 'display' );
    $description = get_bloginfo( 'description', 'display' );

    // Turn output buffer on
    ob_start();

    // Pagination
    global $paged;
    if( get_query_var( 'paged' ) )
      $my_page = get_query_var( 'paged' );
    else {
      if( get_query_var( 'page' ) )
        $my_page = get_query_var( 'page' );
      else
        $my_page = 1;
      set_query_var( 'paged', $my_page );
      $paged = $my_page;
    }

    $args = array(
      // other query params here,
      'paged' => $my_page,
      'post_type' => 'post',
      'posts_per_page' => (int)$blog_limit,
      'category_name' => esc_attr($blog_show_category),
      'orderby' => $blog_orderby,
      'order' => $blog_order
    );

    $elstn_post = new WP_Query( $args ); ?>

    <!-- Blog Start -->
    <div class="elstn-blogs <?php echo esc_attr($blog_version); ?>" style="">
      <div id="container" class="<?php echo esc_attr($blog_container); ?>">

        <div class="<?php echo esc_attr($blog_col); ?>">
        <?php
        if ( $elstn_post->have_posts() ) :
          /* Start the Loop */
          while ( $elstn_post->have_posts() ) : $elstn_post->the_post();
            $large_image = wp_get_attachment_image_src( get_post_thumbnail_id(), 'fullsize', false, '' );
            $large_image = $large_image[0];
            $modern_fimg = get_post_meta( get_the_ID(), 'modern_featured_image', true );

            if ($blog_style == 'classic') { ?>

            <div id="post-<?php the_ID(); ?>" <?php post_class('item'); ?>>
              <div class="blog-item">
                <div class="blog-picture">
                  <a href="<?php echo esc_url( get_permalink() ); ?>"><img src="<?php echo esc_url(aq_resize( $large_image, '370', '230', true )); ?>" alt="<?php echo esc_attr(get_the_title()); ?>"></a>
                </div>
                <div class="blog-info">
                  <?php if( $blog_date ){ ?>
                    <div class="blog-date"><?php echo get_the_date('d M Y'); ?></div>
                  <?php } ?>
                  <div class="blog-name"><a href="<?php echo esc_url( get_permalink() ); ?>"><?php echo esc_attr(get_the_title()); ?></a></div>
                  <p style="line-height:1.6;">
                      <?php
                        the_excerpt();
                        echo elston_wp_link_pages();
                      ?>
                  </p>
                  <div class="clearfix"><a href="<?php echo esc_url( get_permalink() ); ?>"><?php echo esc_attr($read_text); ?></a></div>
                </div>
              </div>
            </div><!-- #post-## -->

          <?php } else { ?>

            <div id="post-<?php the_ID(); ?>" <?php post_class('blog-item'); ?>>
              <div class="blog-info">
                <?php if( !$blog_category || !$blog_date ){
                  if ($blog_category) {
                     $hide_metas_class = 'date-only';
                   } else {
                     $hide_metas_class = '';
                    } ?>
                  <div class="blog-date <?php echo esc_attr($hide_metas_class); ?>">
                    <?php if( !$blog_category ){ $category_list = get_the_category(); ?>
                      <a href="<?php echo esc_url( get_category_link( $category_list[0]->term_id ) );?>"><?php echo esc_html( $category_list[0]->name );?></a>
                    <?php } ?>
                    <?php
                      if ( !$blog_date ) {
                        echo '<span>'. get_the_date('d M Y') .'</span>';
                      }
                    ?>
                  </div>
                <?php } ?>
                <div class="blog-name"><a href="<?php echo esc_url( get_permalink() ); ?>"><?php echo esc_attr(get_the_title()); ?></a></div>
              </div>
              <?php if ($modern_fimg) { ?>
                <div class="blog-picture" style="background-image:url(<?php echo esc_attr(wp_get_attachment_url($modern_fimg['modern_image']));?>)"></div>
              <?php } else { ?>
                <div class="blog-picture" style="background-image:url(<?php echo esc_attr($large_image);?>)"></div>
              <?php } ?>
            </div><!-- #post-## -->
          <?php }
          endwhile;
        else :
          get_template_part( 'layouts/post/content', 'none' );
        endif; ?>
        </div>
        <?php
        if($blog_pagination){
          if ($pagination_type == 'ajax') { elston_ajax_more_post_init($blog_style, $blog_limit, $more_text, $loading_text, $end_text) ?>
            <div id="elston-load-posts" class="elstn-load-more <?php echo esc_attr($load_more_class); ?>"><a href="#0"><?php echo esc_attr__($more_text, 'elston-core'); ?></a></div>
            <?php
          } else { ?>
            <div class="elstn-load-more <?php echo esc_attr($load_more_class); ?>">
              <?php
                if ( function_exists('wp_pagenavi')) {
                  wp_pagenavi(array( 'query' => $elstn_post ) );
                }
              ?>
            </div>
            <?php

          }
          wp_reset_postdata();  // avoid errors further down the page
        }
        ?>
      </div>
    </div>

    <?php
    return ob_get_clean();

  }
}
add_shortcode( 'elstn_blog', 'elstn_blog_function' );
