<?php
/*
 * The template for displaying 404 pages (not found).
 * Author & Copyright: VictorThemes
 * URL: https://victorthemes.com
 */

// Theme Options
$error_heading = cs_get_option('error_heading');
$error_page_content = cs_get_option('error_page_content');
$error_page_bg = cs_get_option('error_page_bg');
$error_btn_text = cs_get_option('error_btn_text');

$error_heading = ( $error_heading ) ? $error_heading : esc_html__( 'Sorry! The Page Not Found', 'elston' );
$error_page_content = ( $error_page_content ) ? $error_page_content : esc_html__( 'The Link You Followed Probably Broken, Or The Page Has Been Removed From Website.', 'elston' );
$error_page_bg = ( $error_page_bg ) ? wp_get_attachment_url($error_page_bg) : esc_url(ELSTON_IMAGES) . '/404.png';
$error_btn_text = ( $error_btn_text ) ? $error_btn_text : esc_html__( 'BACK TO HOME', 'elston' );

get_header(); ?>

	<!-- Content -->
	<div class="blog-single-page">
		<div class="blog-single-page-inner">
			<div class="container">

				<div class="elstn-top-title error-content">
					<img src="<?php echo esc_url($error_page_bg); ?>" alt="<?php _e('404 Error', 'elston'); ?>">
					<h1><?php echo esc_attr($error_heading); ?></h1>
					<p><?php echo esc_attr($error_page_content); ?></p>
					<div class="contact-button"><a href="<?php echo esc_url(home_url( '/' )); ?>" class="elstn-btn elstn-btn-one elstn-btn-large"><?php echo esc_attr($error_btn_text); ?></a></div>
				</div>

			</div>
		</div>
	</div>
	<!-- Content -->

<?php
get_footer();
