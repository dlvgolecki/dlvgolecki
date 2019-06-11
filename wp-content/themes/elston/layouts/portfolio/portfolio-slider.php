<?php
/*
 * The template for displaying full page slider for single portfolios.
 * Author & Copyright: VictorThemes
 * URL: https://victorthemes.com
 */

// Metabox
$elston_id    = ( isset( $post ) ) ? $post->ID : 0;
$elston_id    = ( is_home() ) ? get_option( 'page_for_posts' ) : $elston_id;
$elston_meta  = get_post_meta( $elston_id, 'portfolio_type_metabox', true );

if ($elston_meta) {
	$sliders = $elston_meta['portfolio_slider'];
  $hide_navigation = $elston_meta['hide_navigation'];
} else {
	$sliders = '';
  $hide_navigation = '';
}

// Pagination Active
$single_pagination = cs_get_option('portfolio_page_link');
$portfolio_link = cs_get_option('portfolio_link');
$project_info = cs_get_option('project_info');

$project_info = ($project_info) ? $project_info : esc_html__( 'See Project info', 'elston' );

?>
    <div id="post-<?php the_ID(); ?>" <?php post_class('elstn-project-slider'); ?>>
      <div class="elstn-default-slider" data-items="1" data-margin="0" data-loop="true" data-nav="false">
      	<?php
      	if( !empty( $sliders ) ) {
      		$images = explode( ',', $sliders );
      		foreach($images as $image){
      			$large_image =  wp_get_attachment_image_src( $image, 'full' );
      			$large_image =  $large_image[0];
  			  ?>
        	<div class="item"><img src="<?php echo esc_url($large_image);?>" alt=""/></div>
        	<?php } ?>
        <?php } ?>
      </div>
      <div class="portfolio-title"><?php echo esc_attr( get_the_title() ); ?></div>
  	  <?php
  		if (have_posts()) : while (have_posts()) : the_post();
  			the_content();
  		endwhile;
  		endif;
  	  ?>
      <div class="see-project"><a href="javascript:void(0);"><img src="<?php echo esc_url(ELSTON_IMAGES); ?>/icons/arrow1.png" alt=""/> <?php echo esc_attr($project_info); ?></a></div>
      <?php if ( $single_pagination ) { ?>
        <?php if ( $hide_navigation == false ) { ?>
        <div class="project-controls">
          <div class="elstn-table-container">
            <div class="elstn-align-container">
              <div class="action-links">
    		      <?php
        				$prev_post = get_previous_post();
        				$next_post = get_next_post();?>
                <?php
                if ($next_post) { ?>
                <a href="<?php echo esc_url(get_permalink($next_post->ID)); ?>" class="prev-item"><i class="fa fa-angle-right"></i></a>
                <?php } ?>
                <a href="<?php echo esc_url(get_permalink($portfolio_link)); ?>" class="portfolio-link"><span></span> <span></span> <span></span> <span></span></a>
                <?php
                if ($prev_post) {
                ?>
                <a href="<?php echo esc_url(get_permalink($prev_post->ID)); ?>" class="next-item"><i class="fa fa-angle-left"></i></a>
                <?php } ?>
              </div>
            </div>
          </div>
        </div>
        <?php } ?>
      <?php } ?>
    </div>

<?php get_footer('none');