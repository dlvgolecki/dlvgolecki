<?php
// Contact info
$contact_info = cs_get_option('contact_info');
$show_social_info = cs_get_option('show_social_info');
$social_info_link_target = cs_get_option('social_info_link_target');
$has_social_info_link_target = $social_info_link_target ? 'target="_blank"' : '';
$social_info = cs_get_option('social_info');
$sidebar_email_address = cs_get_option('sidebar_email_address');
$sidebar_phone_no = cs_get_option('sidebar_phone_no');
$sidebar_portfolio = cs_get_option('sidebar_portfolio');
$sidebar_search = cs_get_option('sidebar_search');
$brand_logo_default_small = cs_get_option('brand_logo_default_small');

// Search
$sidebar_search = cs_get_option('sidebar_search');
$sidebar_search_text = cs_get_option('sidebar_search_text');
$sidebar_search_text = ($sidebar_search_text) ? $sidebar_search_text : esc_html__('SEARCH AND PRESS ENTER', 'elston');

// Metabox
$elston_id    = ( isset( $post ) ) ? $post->ID : 0;
$elston_id    = ( is_home() ) ? get_option( 'page_for_posts' ) : $elston_id;
$elston_meta  = get_post_meta( $elston_id, 'portfolio_page_selection_section', true );

if ($elston_meta) {
  $portfolio_page_selection = $elston_meta['portfolio_page_selection'];
} else {
  $portfolio_page_selection = '';
}

$portfolio_link = cs_get_option('portfolio_link');
$portfolio_link = ($portfolio_page_selection) ? 'javascript:void(0);' : get_permalink($portfolio_link) ;

?>
  <div class="elstn-sidebar">
    <div class="sidebar-part1">
      <div class="menu-wrapper">
        <?php get_template_part( 'layouts/sidebar/logo' ); ?>
        <nav>
          <?php get_template_part( 'layouts/sidebar/menu', 'bar' ); ?>
          <?php if($sidebar_portfolio){ ?>
          <ul id="portfolio-nav" class="filter-buttons">
            <?php
              $terms = get_terms( 'portfolio_category' );
              if ( ! empty( $terms ) && ! is_wp_error( $terms ) ){
                  echo '<li><a href="'.$portfolio_link.'" data-filter="*">All</a></li>';
                  foreach ( $terms as $term ) {
                      $link = ($portfolio_page_selection) ? 'javascript:void(0);' : get_term_link($term->slug, 'portfolio_category') ;
                      echo '<li><a href="' . $link . '" data-filter=".cat-' . $term->slug . '">' . $term->name . '</a></li>';
                  }
              }
            ?>
          </ul>
          <?php } ?>
        </nav>
      </div>
      <?php
        if ( $contact_info ) {
      ?>
      <div class="contact-links">
        <?php if ( $show_social_info ) { ?>
        <div class="elstn-social-links">
          <?php if (isset($social_info)){ ?>
            <?php foreach ( $social_info as $social_item ) { ?>
            <a href="<?php echo esc_url( $social_item['social_link'] ); ?>" <?php echo esc_attr( $has_social_info_link_target ); ?>><i aria-hidden="true" class="fa <?php echo esc_attr( $social_item['social_icon'] ); ?>"></i></a>
            <?php } ?>
          <?php } ?>
        </div>
        <?php }

          if ($sidebar_email_address) {
            echo do_shortcode( $sidebar_email_address );
          }
          if ($sidebar_phone_no) {
            echo do_shortcode( $sidebar_phone_no );
          }
        ?>
      </div>
      <?php } ?>
    </div>
    <div class="sidebar-part2">
      <?php if ($brand_logo_default_small) { ?>
      <div class="logo2">
        <a href="<?php echo esc_url(home_url('/')); ?>"><img src="<?php echo esc_attr(wp_get_attachment_url($brand_logo_default_small))?>" alt="<?php get_bloginfo( 'name' );?>"/></a>
      </div>
      <?php } else { ?>
      <div class="logo2">
        <a href="<?php echo esc_url(home_url('/')); ?>"><img src="<?php echo esc_url(ELSTON_IMAGES) . '/logo/logo2.png' ?>" alt="<?php get_bloginfo( 'name' );?>"/></a>
      </div>
      <?php } ?>

      <div class="elstn-table-container">
        <div class="elstn-align-container">
          <div class="action-links">
            <a href="javascript:void(0);" class="toggle-link"><span></span></a>
            <?php if($sidebar_portfolio){ ?>
              <a href="javascript:void(0);" class="grid-link"><span></span> <span></span> <span></span></a>
            <?php } ?>
            <?php if($sidebar_search){ ?>
              <a href="javascript:void(0);" class="search-link"><i class="icons icon-magnifier"></i></a>
            <?php } ?>
          </div>
        </div>
      </div>

    </div>
  </div>

  <!-- elstn toggle button -->
  <div class="elstn-toggle-btn"><a href="javascript:void(0);"><span></span> <span></span> <span></span></a></div>

<?php if($sidebar_search){ ?>
  <!-- elstn search wrapper -->
  <div class="elstn-search-wrap">
    <div class="elstn-table-container">
      <div class="elstn-align-container">
        <div class="search-closer"></div>
        <div class="search-container">
          <form method="get" id="searchform" action="<?php echo esc_url(home_url('/')); ?>">
            <input type="text" name="s" id="s" placeholder="<?php esc_html_e('Start Searching', 'elston'); ?>" class="search-input"/>
          </form>
          <span><?php echo esc_attr($sidebar_search_text); ?></span>
        </div>
      </div>
    </div>
  </div>
<?php }
