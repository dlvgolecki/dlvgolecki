<?php
/**
 * The default template for displaying content
 *
 * @package WordPress
 * @subpackage Skylab
 * @since Skylab 1.0
 */
?>

	<article id="post-<?php the_ID(); ?>" <?php post_class('clearfix'); ?>>
		
		<div class="entry-header-wrapper clearfix">
			<header class="entry-header clearfix">
				
				<div class="entry-meta">
				
				<?php
				/* translators: used between list items, there is a space after the comma */
				$categories_list = get_the_category_list( esc_html__( ', ', 'skylab' ) );
				if ( $categories_list ) {
				?>
				<span class="cat-links">
					<span class="entry-utility-prep entry-utility-prep-cat-links"><?php echo esc_html__( 'Posted in', 'skylab' ) ?></span>
					<?php echo $categories_list; ?>
				</span>
				<?php } // End if categories ?>
				</div><!-- .entry-meta -->
				
				<?php if ( ! empty( $post->post_title ) ) { ?>
				<h1 class="entry-title">
				<?php if ( is_single() ) { ?>
					<?php the_title(); ?>
				<?php } else { ?>
					<a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a>
				<?php } ?>
				</h1>
				<?php } ?>
				
				<div class="entry-meta">
					<div class="meta-wrapper">
						<?php if ( is_single() ) { ?>
							<?php mega_posted_on(); ?>
						<?php } else { ?>
							<?php if ( ! empty( $post->post_title ) ) { ?>
								<?php mega_posted_on(); ?>
							<?php } else { ?>
								<p class="entry-date-wrapper"><a href="<?php the_permalink(); ?>" rel="bookmark"><span class="entry-date"><?php the_date(); ?></span></a></p>
							<?php } ?>
						<?php } ?>
						<span class="sep"> · </span>
						
						<span class="author vcard"><span class="by"><?php echo esc_html__( 'by', 'skylab' ); ?></span> <a class="url fn n" href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>" rel="author"><?php echo esc_html( get_the_author() ); ?></a></span>
						
						<?php if ( comments_open() ) { ?>
						<span class="comments-link"><?php comments_popup_link( '<span>'. esc_html__( 'Comment', 'skylab' ) .'</span>', '<span>1 </span> <span class="comments">'. esc_html__( 'Comment', 'skylab' ) .'</span>', '<span>%</span> <span class="comments">'. esc_html__( 'Comments', 'skylab' ) .'</span>' ); ?></span>
						<?php } // End if comments_open() ?>
						
						<?php edit_post_link( '<span>Edit</span>', '<span class="edit-link">', '</span>' ); ?>
					</div>
					
					<span class="by"><?php echo esc_html__( 'by', 'skylab' ); ?> <a class="url fn n" href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>" rel="author"><?php echo get_avatar( get_the_author_meta( 'ID' ), 64 ); ?> <span><?php echo esc_html( get_the_author() ); ?></span></a></span>
				</div><!-- .entry-meta -->
				
			</header><!-- .entry-header -->
			
			<?php if ( has_post_thumbnail() ) { ?>
				<?php $post_thumbnail_id = get_post_thumbnail_id( $post->ID ); ?>
				<?php $post_featured_img = wp_get_attachment_image_src( $post_thumbnail_id, 'large' ); ?>
				<div class="featured-image-wrapper">
					<div class="featured-image lazy" style="padding-bottom: <?php echo esc_attr( ($post_featured_img[2] / $post_featured_img[1]) * 100 ) ?>%;">
						<?php echo '<img width="'. $post_featured_img[1] .'" height="'. $post_featured_img[2] .'" data-src="'. $post_featured_img[0] .'" src="data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///yH5BAEAAAAALAAAAAABAAEAAAIBRAA7" />'; ?>
						<div class="loader">
							<svg class="circular" viewBox="25 25 50 50">
								<circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="6" stroke-miterlimit="10"/>
							</svg>
						</div>
					</div>
				</div>
			<?php } ?>
		</div>
		
		<div class="entry-content clearfix">
			<?php the_content( esc_html__( 'Read more', 'skylab' ) ); ?>
			<?php wp_link_pages( array(
				'before' => '<div class="nav-pagination">',
				'after' => '</div>',
				'link_before' => '<span>',
				'link_after' => '</span>',
				) ); ?>
		</div><!-- .entry-content -->
	</article><!-- #post-<?php the_ID(); ?> -->