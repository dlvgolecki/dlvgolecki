<?php
/*
 * All Front-End Helper Functions
 * Author & Copyright: VictorThemes
 * URL: https://victorthemes.com
 */

/* Exclude category from blog */
function elston_excludeCat($query) {
	if ( $query->is_home ) {
		$exclude_cat_ids = cs_get_option('theme_exclude_categories');
		if($exclude_cat_ids) {
			foreach( $exclude_cat_ids as $exclude_cat_id ) {
				$exclude_from_blog[] = '-'. $exclude_cat_id;
			}
			$query->set('cat', implode(',', $exclude_from_blog));
		}
	}
	return $query;
}
add_filter('pre_get_posts', 'elston_excludeCat');

/* Excerpt Length */
function elston_excerpt_length( $length ) {
  $excerpt_length = cs_get_option('theme_blog_excerpt');
  if($excerpt_length) {
    $excerpt_length = $excerpt_length;
  } else {
    $excerpt_length = '20';
  }
  return $excerpt_length;
}
add_filter( 'excerpt_length', 'elston_excerpt_length', 999 );

/* Excerpt More */
function elston_excerpt_more( $more ) {
  return '.';
}
add_filter('excerpt_more', 'elston_excerpt_more');

/* Tag Cloud Widget - Remove Inline Font Size */
function elston_tag_cloud($tag_string){
  return preg_replace("/style='font-size:.+pt;'/", '', $tag_string);
}
add_filter('wp_generate_tag_cloud', 'elston_tag_cloud', 10, 3);

/* Password Form */
if( ! function_exists( 'elston_password_form' ) ) {
  function elston_password_form( $output ) {
    $output = str_replace( 'type="submit"', 'type="submit" class=""', $output );
    return $output;
  }
  add_filter('the_password_form' , 'elston_password_form');
}

/* Maintenance Mode */
if( ! function_exists( 'elston_maintenance_mode' ) ) {
  function elston_maintenance_mode(){

    $maintenance_mode_page = cs_get_option( 'maintenance_mode_page' );
    $enable_maintenance_mode = cs_get_option( 'enable_maintenance_mode' );

    if ( isset($enable_maintenance_mode) && ! empty( $maintenance_mode_page ) && ! is_user_logged_in() ) {
      get_template_part('layouts/post/content', 'maintenance');
      exit;
    }

  }
  add_action( 'wp', 'elston_maintenance_mode', 1 );
}

/* ==============================================
  Excerpt Length Change
=============================================== */
if ( ! function_exists( 'elston_custom_excerpt_length' ) ) {
  function elston_custom_excerpt_length( $length ) {
    $excerpt_length = cs_get_option('theme_blog_excerpt');
    if($excerpt_length) {
      $excerpt_length = $excerpt_length;
    } else {
      $excerpt_length = '55';
    }
    return $excerpt_length;
  }
  add_filter( 'excerpt_length', 'elston_custom_excerpt_length', 999 );
}

if ( ! function_exists( 'elston_new_excerpt_more' ) ) {
  function elston_new_excerpt_more( $more ) {
    return '';
  }
  add_filter('excerpt_more', 'elston_new_excerpt_more');
}

/* WP Link Pages */
if ( ! function_exists( 'elston_wp_link_pages' ) ) {
  function elston_wp_link_pages() {
    $defaults = array(
      'before'           => '<div class="wp-link-pages">' . esc_html__( 'Pages:', 'elston' ),
      'after'            => '</div>',
      'link_before'      => '<span>',
      'link_after'       => '</span>',
      'next_or_number'   => 'number',
      'separator'        => ' ',
      'pagelink'         => '%',
      'echo'             => 1
    );
    wp_link_pages( $defaults );
  }
}

/* WP Next and Previous Pages Link (single-page) */
if ( ! function_exists( 'elston_wp_nxt_prev_pages' ) ) {
  function elston_wp_nxt_prev_pages() { ?>
    <div class="post-item prev-post">
    <?php
    $older_post = cs_get_option('older_post');
    $newer_post = cs_get_option('newer_post');
    $older_post = $older_post ? $older_post : esc_html__('Prev Post', 'elston');
    $newer_post = $newer_post ? $newer_post : esc_html__('Next Post', 'elston');

    $prev_post = get_previous_post();
    if (!empty( $prev_post )) {
      $prev_post_image = wp_get_attachment_image_src( get_post_thumbnail_id($prev_post->ID), 'fullsize', false, '' );
      $prev_post_image = $prev_post_image[0];
    ?>
    <div class="post-container">
      <a href="<?php echo esc_url(get_permalink($prev_post->ID)); ?>" class="post-caption"><span><?php echo esc_attr($older_post);?></span> <?php echo esc_attr($prev_post->post_title); ?></a>
    </div>
    <div class="post-picture" style="background-image:url(<?php echo esc_url($prev_post_image);?>)"></div>
    <?php } ?>
      </div>
    <div class="post-item next-post">
    <?php
    $next_post = get_next_post();
    if (!empty( $next_post )) {
      $next_post_image = wp_get_attachment_image_src( get_post_thumbnail_id($next_post->ID), 'fullsize', false, '' );
      $next_post_image = $next_post_image[0];
    ?>
    <div class="post-container">
      <a href="<?php echo esc_url(get_permalink($next_post->ID)); ?>" class="post-caption"><span><?php echo esc_attr($newer_post); ?></span> <?php echo esc_attr($next_post->post_title); ?></a>
    </div>
    <div class="post-picture" style="background-image:url(<?php echo esc_url($next_post_image); ?>)"></div>
    <?php } ?>
    </div>

  <?php
  }
}

/* Metas */
if ( ! function_exists( 'elston_post_metas' ) ) {
  function elston_post_metas() {
  $metas_hide = (array) cs_get_option( 'theme_metas_hide' );

    $output = '<div class="blog-date">';
    if ( !in_array( 'category', $metas_hide ) ) { // Category Hide
      if ( get_post_type() === 'post') {
        $category_list = get_the_category();
        if ( $category_list ) {
          $output .= '<a href="' . esc_url( get_category_link( $category_list[0]->term_id ) ) . '">' . esc_attr( $category_list[0]->name ) . '</a>';
        }
      }
    } // Category Hides

    if ( !in_array( 'date', $metas_hide ) ) { // Date Hide
      $output .= ' ' . get_the_date('d M Y');
    } // Date Hides

    $output .= '</div>';
    return $output;
  }
}

/* Share Options */
if ( ! function_exists( 'elston_wp_share_option' ) ) {
  function elston_wp_share_option() {

    global $post;
    $page_url = get_permalink($post->ID );
    $title = $post->post_title;
    $share_text = cs_get_option('share_text');
    $share_text = $share_text ? $share_text : esc_html__( 'Share', 'elston' );
    $share_on_text = cs_get_option('share_on_text');
    $share_on_text = $share_on_text ? $share_on_text : esc_html__( 'Share', 'elston' );
    ?>

    <div class="elstn-share-link">
      <div class="link-wrapper">
        <i aria-hidden="true" class="fa fa-share-alt"></i>
        <span><?php echo esc_attr($share_text); ?></span>

          <a href="http://twitter.com/home?status=<?php print(urlencode($title)); ?>+<?php print(urlencode($page_url)); ?>" class="icon-fa-twitter" data-toggle="tooltip" data-placement="top" title="<?php echo esc_attr( $share_on_text .' '); echo esc_attr('Twitter', 'elston'); ?>"><i class="fa fa-twitter"></i></a>

          <a href="http://www.facebook.com/sharer/sharer.php?u=<?php print(urlencode($page_url)); ?>&amp;t=<?php print(urlencode($title)); ?>" class="icon-fa-facebook" data-toggle="tooltip" data-placement="top" title="<?php echo esc_attr( $share_on_text .' '); echo esc_attr('Facebook', 'elston'); ?>"><i class="fa fa-facebook"></i></a>

          <a href="http://www.linkedin.com/shareArticle?mini=true&amp;url=<?php print(urlencode($page_url)); ?>&amp;title=<?php print(urlencode($title)); ?>" class="icon-fa-linkedin" data-toggle="tooltip" data-placement="top" title="<?php echo esc_attr( $share_on_text .' '); echo esc_attr('Linkedin', 'elston'); ?>"><i class="fa fa-linkedin"></i></a>

          <a href="https://plus.google.com/share?url=<?php print(urlencode($page_url)); ?>" class="icon-fa-google-plus" data-toggle="tooltip" data-placement="top" title="<?php echo esc_attr( $share_on_text .' '); echo esc_attr('Google+', 'elston'); ?>"><i class="fa fa-google-plus"></i></a>
      </div>
    </div>
<?php
  }
}

/* Author Info */
if ( ! function_exists( 'elston_author_info' ) ) {
  function elston_author_info() {
    $author_text = cs_get_option('author_text');
    $author_text = $author_text ? $author_text : esc_html__( 'By', 'elston' );
    $author_url = get_author_posts_url( get_the_author_meta( 'ID' ) );
  ?>
  <div class="author-picture"><?php echo get_avatar( get_the_author_meta( 'ID' ), 90 ); ?></div>
  <div class="author-name"><?php echo esc_attr($author_text);?> <a href="<?php echo esc_url($author_url); ?>"><?php
  if (get_the_author_meta('first_name') && get_the_author_meta('last_name')) {
    echo esc_attr(get_the_author_meta('first_name')). ' '. esc_attr(get_the_author_meta('last_name'));
  } else {
    echo esc_attr(get_the_author_meta('nickname'));
  } ?></a></div>
<?php
  }
}

/* ==============================================
   Custom Comment Area Modification
=============================================== */
if ( ! function_exists( 'elston_comment_modification' ) ) {
  function elston_comment_modification($comment, $args, $depth) {
    $GLOBALS['comment'] = $comment;
    extract($args, EXTR_SKIP);
    if ( 'div' == $args['style'] ) {
      $tag = 'div';
      $add_below = 'comment';
    } else {
      $tag = 'li';
      $add_below = 'div-comment';
    }
    $comment_class = empty( $args['has_children'] ) ? '' : 'parent';
  ?>

  <<?php echo esc_attr($tag); ?> <?php comment_class('item ' . $comment_class .' ' ); ?> id="comment-<?php comment_ID() ?>">
    <?php if ( 'div' != $args['style'] ) : ?>
    <div id="div-comment-<?php comment_ID() ?>" class="">
    <?php endif; ?>
    <div class="comment-theme">
        <div class="comment-image">
          <?php if ( $args['avatar_size'] != 0 ) {
            echo get_avatar( $comment, 80 );
          } ?>
        </div>
    </div>
    <div class="comment-main-area">
      <div class="comment-wrapper">
        <div class="elstn-comments-meta">
          <h4><?php printf( '%s', get_comment_author() ); ?></h4>
          <span class="comments-date">
            <?php echo get_comment_date('d M Y'); echo ' - '; ?>
            <span class="caps"><?php echo get_comment_time(); ?></span>
          </span>
          <div class="comments-reply">
          <?php
            comment_reply_link( array_merge( $args, array(
            'reply_text' => '<span class="comment-reply-link">'. esc_html__('Reply', 'elston') .'</span>',
            'before' => '',
            'class'  => '',
            'depth' => $depth,
            'max_depth' => $args['max_depth']
            ) ) );
          ?>
          </div>
        </div>
        <?php if ( $comment->comment_approved == '0' ) : ?>
        <em class="comment-awaiting-moderation"><?php echo esc_html__( 'Your comment is awaiting moderation.', 'elston' ); ?></em>
        <?php endif; ?>
        <div class="comment-area">
          <?php comment_text(); ?>
        </div>
      </div>
    </div>
  <?php if ( 'div' != $args['style'] ) : ?>
  </div>
  <?php endif;
  }
}

/* Comments Form - Textarea next to Normal Fields */
add_filter( 'comment_form_fields', 'elston_move_comment_field' );
function elston_move_comment_field( $fields ) {
  $comment_field = $fields['comment'];
  unset( $fields['comment'] );
  $fields['comment'] = $comment_field;
  return $fields;
}

/* Title Area */
if ( ! function_exists( 'elston_title_area' ) ) {
  function elston_title_area() {

    global $post, $wp_query;

    // Get post meta in all type of WP pages
    $elston_id    = ( isset( $post ) ) ? $post->ID : 0;
    $elston_id    = ( is_home() ) ? get_option( 'page_for_posts' ) : $elston_id;
    $elston_id    = ( elston_is_woocommerce_shop() ) ? wc_get_page_id( 'shop' ) : $elston_id;
    $elston_meta  = get_post_meta( $elston_id, 'page_type_metabox', true );
    if ($elston_meta && (!is_archive() )) {
      $custom_title = $elston_meta['page_custom_title'];
      if ($custom_title) {
        $custom_title = $custom_title;
      } elseif(post_type_archive_title()) {
        post_type_archive_title();
      } else {
        $custom_title = '';
      }
    } else { $custom_title = ''; }

    /**
     * For strings with necessary HTML, use the following:
     * Note that I'm only including the actual allowed HTML for this specific string.
     * More info: https://codex.wordpress.org/Function_Reference/wp_kses
     */
    $allowed_html_array = array(
        'a' => array(
          'href' => array(),
        ),
        'span' => array(
          'class' => array(),
        )
    );

    if( $custom_title ) {
      echo esc_attr($custom_title);
    } elseif ( is_home() ) {
      bloginfo('name');
    } elseif ( is_search() ) {
      printf( esc_html__( 'Search Results for %s', 'elston' ), '<span>' . get_search_query() . '</span>' );
    } elseif ( is_category() || is_tax() ){
      single_cat_title();
    } elseif ( is_tag() ) {
      single_tag_title(esc_html__('Posts Tagged: ', 'elston'));
    } elseif ( is_archive() ) {
      if ( is_day() ) {
        printf( wp_kses( __( 'Archive for <span>%s</span>', 'elston' ), $allowed_html_array ), get_the_date());
      } elseif ( is_month() ) {
        printf( wp_kses( __( 'Archive for <span>%s</span>', 'elston' ), $allowed_html_array ), get_the_date( 'F, Y' ));
      } elseif ( is_year() ) {
        printf( wp_kses( __( 'Archive for <span>%s</span>', 'elston' ), $allowed_html_array ), get_the_date( 'Y' ));
      } elseif ( is_author() ) {
        printf( wp_kses( __( 'Posts by: <span>%s</span>', 'elston' ), $allowed_html_array ), get_the_author_meta( 'display_name', $wp_query->post->post_author ));
      } elseif ( is_post_type_archive() ) {
        post_type_archive_title();
      } else {
        esc_html__( 'Archives', 'elston' );
      }
    } elseif( is_404() ) {
      esc_html__('404 Error', 'elston');
    } else {
      the_title();
    }

  }
}

/**
 * Pagination Function
 */
if ( ! function_exists( 'elston_paging_nav' ) ) {
  function elston_paging_nav() {
    if ( function_exists('wp_pagenavi')) {
      wp_pagenavi();
    } else {
      $older_post = cs_get_option('older_post');
      $newer_post = cs_get_option('newer_post');
      $older_post = $older_post ? $older_post : esc_html__( 'Prev Post', 'elston' );
      $newer_post = $newer_post ? $newer_post : esc_html__( 'Next Post', 'elston' );
      global $wp_query;
      $big = 999999999;
      if($wp_query->max_num_pages == '1' ) {} else {echo '';}
      echo paginate_links( array(
        'base' => str_replace( $big, '%#%', get_pagenum_link( $big ) ),
        'format' => '?paged=%#%',
        'prev_text' => $older_post,
        'next_text' => $newer_post,
        'current' => max( 1, get_query_var('paged') ),
        'total' => $wp_query->max_num_pages,
        'type' => 'list'
      ));
      if($wp_query->max_num_pages == '1' ) {} else {echo '';}
    }
  }
}

//To fetch blog data from the database
if ( ! function_exists( 'elston_ajax_more_post_init' ) ) {
  function elston_ajax_more_post_init( $blog_style = NULL, $posts_per_page = NULL, $more_text = NULL, $loading_text = NULL, $end_text = NULL ) {
    global $wp_query;

    // Queue JS and CSS
    wp_enqueue_script('elston-load-posts', ELSTON_SCRIPTS . '/load-more.js', array('jquery'), '1.0', true );
    // What page are we on? And what is the pages limit?
    $paged = ( get_query_var('paged') > 1 ) ? get_query_var('paged') : 1;

    if($blog_style || $posts_per_page){
      $posts_per_page = ( isset($posts_per_page) ) ? $posts_per_page : get_option('posts_per_page') ;
      $loop = new WP_Query(array('posts_per_page' => $posts_per_page, 'paged' => $paged ));
      $max = $loop->max_num_pages;
    } else {
      $max = $wp_query->max_num_pages;
    }

    $blog_style = ( $blog_style ) ? $blog_style : cs_get_option('blog_listing_style');
    $class_name = ($blog_style == 'modern') ? 'blog-item' : 'item';
    $more_text = ( $more_text ) ? $more_text : cs_get_option('more_text');
    $loading_text = ( $loading_text ) ? $loading_text : cs_get_option('loading_text');
    $end_text = ( $end_text ) ? $end_text : cs_get_option('end_text');
    if (is_search()) {
      $is_search = urlencode(get_search_query());
    } else {
      $is_search = '';
    }

    // Add some parameters for the JS.
    wp_localize_script(
      'elston-load-posts',
      'pbd_alp',
      array(
        'startPage'     => $paged,
        'maxPages'      => $max,
        'nextLink'      => next_posts($max, false),
        'class_name'    => $class_name,
        'more_text'     => $more_text,
        'loading_text'  => $loading_text,
        'end_text'      => $end_text,
        'is_search'     => $is_search,
        'home_url'      => esc_url( home_url( '/' ) )
      )
    );

   }
   add_action('template_redirect', 'elston_ajax_more_post_init');
}

//To fetch portfolio data from the database
if ( ! function_exists( 'elston_ajax_more_portfolio_post_init' ) ) {
  function elston_ajax_more_portfolio_post_init($posts_per_page = NULL) {
    global $wp_query;
    // Queue JS and CSS
    wp_enqueue_script('elston-load-portfolio-posts', ELSTON_SCRIPTS . '/portfolio-load-more.js', array('jquery'), '1.0', true );
    // What page are we on? And what is the pages limit?
    $paged = ( get_query_var('paged') > 1 ) ? get_query_var('paged') : 1;

    if(is_tax('portfolio_category')){
      $max = $wp_query->max_num_pages;
    } else {
      $posts_per_page = ( isset($posts_per_page) ) ? $posts_per_page : get_option('posts_per_page') ;
      $loop = new WP_Query(array('post_type' => 'portfolio', 'posts_per_page' => $posts_per_page, 'paged' => $paged ));
      $max = $loop->max_num_pages;
    }

    $more_text = cs_get_option('more_text');
    $loading_text = cs_get_option('loading_text');
    $end_text = cs_get_option('end_text');

    // Add some parameters for the JS.
    wp_localize_script(
      'elston-load-portfolio-posts',
      'pbd_alp_portfolio',
      array(
        'startPage'     => $paged,
        'maxPages'      => $max,
        'nextLink'      => next_posts($max, false),
        'more_text'     => $more_text,
        'loading_text'  => $loading_text,
        'end_text'      => $end_text
      )
    );

   }
   add_action('template_redirect', 'elston_ajax_more_portfolio_post_init');
}
