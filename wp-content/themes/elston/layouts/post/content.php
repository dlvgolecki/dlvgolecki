<?php
/**
 * Template part for displaying posts.
 */
$large_image =  wp_get_attachment_image_src( get_post_thumbnail_id(get_the_ID()), 'fullsize', false, '' );
$large_image = $large_image[0];

$read_more_text = cs_get_option('read_more_text');
$read_text = $read_more_text ? $read_more_text : esc_html__( 'Read More', 'elston' );
$post_type = get_post_meta( get_the_ID(), 'post_type_metabox', true );
$modern_fimg = get_post_meta( get_the_ID(), 'modern_featured_image', true );
$metas_hide = (array) cs_get_option( 'theme_metas_hide' );

// Theme Options
$blog_style = cs_get_option('blog_listing_style');

?>

	<?php if ($blog_style == 'classic') { ?>

      <div id="post-<?php the_ID(); ?>" <?php post_class('item'); ?>>
        <div class="blog-item">
          <?php if($large_image){ ?>
          <div class="blog-picture">
            <a href="<?php echo esc_url( get_permalink() ); ?>"><img src="<?php echo esc_url($large_image); ?>" alt="<?php echo esc_attr(get_the_title()); ?>"></a>
          </div>
          <?php } ?>
          <div class="blog-info">
            <div class="blog-date"><?php echo get_the_date('d M Y'); ?></div>
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
      </div>

	<?php } else { ?>

      <div id="post-<?php the_ID(); ?>" <?php post_class('blog-item'); ?>>
        <div class="blog-info">
          <?php echo elston_post_metas(); ?>
          <div class="blog-name"><a href="<?php echo esc_url( get_permalink() ); ?>"><?php echo esc_attr(get_the_title()); ?></a></div>
        </div>
        <?php if ($modern_fimg) { ?>
          <div class="blog-picture" style="background-image:url(<?php echo esc_attr(wp_get_attachment_url($modern_fimg['modern_image']));?>)"></div>
        <?php } else { ?>
          <div class="blog-picture" style="background-image:url(<?php echo esc_attr($large_image);?>)"></div>
        <?php } ?>
      </div>

	<?php }
