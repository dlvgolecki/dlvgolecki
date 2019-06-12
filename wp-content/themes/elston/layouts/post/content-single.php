<?php
/**
 * Single Post.
 */

// Metabox
$elston_id    = ( isset( $post ) ) ? $post->ID : 0;
$elston_id    = ( is_home() ) ? get_option( 'page_for_posts' ) : $elston_id;
$elston_id    = ( elston_is_woocommerce_shop() ) ? wc_get_page_id( 'shop' ) : $elston_id;
$elston_meta  = get_post_meta( $elston_id, 'post_type_metabox', true );

// Metabox - Modern Featured Image
$modern_featured_id = ( isset( $post ) ) ? $post->ID : 0;
$modern_featured = get_post_meta( $modern_featured_id, 'modern_featured_image', true );

if ($elston_meta) {
	$content_padding = $elston_meta['content_spacings'];
} else { $content_padding = ''; }
// Padding - Metabox
if ($content_padding && $content_padding !== 'padding-none') {
	$content_top_spacings = $elston_meta['content_top_spacings'];
	$content_bottom_spacings = $elston_meta['content_bottom_spacings'];
	if ($content_padding === 'padding-custom') {
		$content_top_spacings = $content_top_spacings ? 'padding-top:'. elston_check_px($content_top_spacings) .';' : '';
		$content_bottom_spacings = $content_bottom_spacings ? 'padding-bottom:'. elston_check_px($content_bottom_spacings) .';' : '';
		$custom_padding = $content_top_spacings . $content_bottom_spacings;
	} else {
		$custom_padding = '';
	}
} else {
	$custom_padding = '';
}

if ($elston_meta) {
	$hide_featured_image = $elston_meta['hide_featured_image'];
} else { $hide_featured_image = ''; }

$blog_style = cs_get_option('blog_listing_style');
$single_sticky_sidebar = cs_get_option('single_sticky_sidebar');
if ($single_sticky_sidebar) {
	$single_sticky_sidebar = ' elstn-blog-sticky';
} else {
	$single_sticky_sidebar = '';
}

// Single Theme Option
$single_featured_image = cs_get_option('single_featured_image');
$single_author_info = cs_get_option('single_author_info');
$single_share_option = cs_get_option('single_share_option');
$single_comment = cs_get_option('single_comment_form');

$large_image = wp_get_attachment_image_src( get_post_thumbnail_id(get_the_ID()), 'fullsize', false, '' );
$large_image = $large_image[0];
if ($elston_meta && $elston_meta['post_featured_image'] === 'modern-featured-image') {
	if (isset($modern_featured['modern_image'])) {
		$large_image = wp_get_attachment_url($modern_featured['modern_image']);
	} else {
		$large_image = $large_image;
	}
} else {
	$large_image = $large_image;
}
?>

<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<?php
	if ($single_featured_image) {
		if (!$hide_featured_image) {
		if ($large_image) { ?>
		<div class="elstn-blog-banner" style="background-image: url(<?php echo esc_url($large_image); ?>)"></div>
	<?php } }
	} // Featured Image
	?>

    <div class="elstn-blog-detail <?php echo esc_attr($content_padding); echo esc_attr($single_sticky_sidebar); ?>" style="<?php echo esc_attr($custom_padding); ?>">
      <div class="wrapper">
        <div class="row">
          <div class="col-md-4">
            <div class="blog-author">
							<!-- Author Info -->
							<?php if ( $single_author_info ) {
								echo elston_author_info();
							}?><!-- Author Info -->

							<?php
							if($single_share_option) { ?>
							<div class="share-post">
								<?php
									global $post;
									$page_url = get_permalink($post->ID );
									$title = $post->post_title;
									$share_text = cs_get_option('share_text');
									$share_text = $share_text ? $share_text : esc_html__( 'Share', 'elston' );
									$share_on_text = cs_get_option('share_on_text');
									$share_on_text = $share_on_text ? $share_on_text : esc_html__( 'Share This Post', 'elston' );

								?>
								<h6><a href="javascript:void(0);" class="active"><?php echo esc_attr($share_on_text);?> <i class="fa fa-angle-right" aria-hidden="true"></i></a></h6>
								<ul>
									<li>
										<a href="http://www.facebook.com/sharer/sharer.php?u=<?php print(urlencode($page_url)); ?>&amp;t=<?php print(urlencode($title)); ?>" class="icon-fa-facebook" data-toggle="tooltip" data-placement="top" title="<?php echo esc_attr( $share_on_text .' '); echo esc_attr__('Facebook', 'elston'); ?>"><i class="fa fa-facebook-official"></i> <?php echo esc_attr__('Facebook', 'elston'); ?></a>
									</li>
									<li>
										<a href="http://twitter.com/home?status=<?php print(urlencode($title)); ?>+<?php print(urlencode($page_url)); ?>" class="icon-fa-twitter" data-toggle="tooltip" data-placement="top" title="<?php echo esc_attr( $share_on_text .' '); echo esc_attr__('Twitter', 'elston'); ?>"><i class="fa fa-twitter-square"></i> <?php echo esc_attr__('Twitter', 'elston'); ?></a>
									</li>
									<li>
										<a href="https://plus.google.com/share?url=<?php print(urlencode($page_url)); ?>" class="icon-fa-google-plus" data-toggle="tooltip" data-placement="top" title="<?php echo esc_attr( $share_on_text .' '); echo esc_attr__('Google+', 'elston'); ?>"><i class="fa fa-google-plus-square"></i> <?php echo esc_attr__('Google+', 'elston'); ?></a>
									</li>
									<li>
										<a href="http://www.linkedin.com/shareArticle?mini=true&amp;url=<?php print(urlencode($page_url)); ?>&amp;title=<?php print(urlencode($title)); ?>" class="icon-fa-linkedin" data-toggle="tooltip" data-placement="top" title="<?php echo esc_attr( $share_on_text .' '); echo esc_attr('Linkedin', 'elston'); ?>"><i class="fa fa-linkedin-square"></i> <?php echo esc_attr__('Linkedin', 'elston'); ?></a>
									</li>

								</ul>

							</div><!-- Share -->
							<?php } ?>
            </div>
            <div class="sidebar-widgets">
            	<?php if (is_active_sidebar('main-widget')) {
            		dynamic_sidebar('main-widget');
            	} ?>
            </div>
          </div>

          <!-- Content -->
          <div class="col-md-8 content-inner" id="secondary">
            <div class="blog-date">
            <?php
				$categories = get_the_category();
				$separator = ', ';
				$output = '';
				if ( ! empty( $categories ) ) {
				    foreach( $categories as $category ) {
				        $output .= '<a href="' . esc_url( get_category_link( $category->term_id ) ) . '">' . esc_attr( $category->name ) . '</a>' . $separator;
				    }
				    echo trim( $output, $separator );
				}
            ?> / <?php echo get_the_date('d M Y');?></div>
            <div class="blog-name"><?php echo esc_attr(get_the_title()); ?></div>
			<?php
				the_content();
				echo elston_wp_link_pages();
			?>

			<!-- Tags -->
			<?php
			$tag_list = get_the_tags();
		  	if($tag_list) { ?>
			<div class="bp-bottom-meta">
				<div class="bp-tags">
					<?php echo the_tags( '<ul><li><span>' . esc_html__('Tags', 'elston') . ': </span></li><li>', '</li><li>', '</li></ul>' ); ?>
				</div>
			</div>
			<?php } ?><!-- Tags -->

          </div><!-- Content -->
        </div>
      </div>
    </div>

    <?php $single_comment = $single_comment ? comments_template() : ''; ?>

    <div class="elstn-more-post">
		<?php echo elston_wp_nxt_prev_pages(); ?>
    </div>

	<div style="clear: both"></div>

</div><?php
