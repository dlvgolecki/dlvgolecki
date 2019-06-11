<?php
/**
 * The template for displaying 404 pages (Not Found).
 *
 * @package WordPress
 * @subpackage Skylab
 * @since Skylab 1.0
 */

get_header(); ?>

	<div id="main-wrapper" class="clearfix">
	<div class="vc_column-inner">
	<div id="main" class="clearfix">
	
	<div id="primary">
	<div id="content">
	<div class="entry-content clearfix">
	<div class="vc_row wpb_row vc_row-fluid"><div class="wrapper clearfix"><div class="inner-wrapper clearfix"><div class="wpb_column vc_column_container vc_col-sm-12"><div class="vc_column-inner "><div class="wpb_wrapper">
	<div class="wpb_text_column wpb_content_element ">
		<div class="wpb_wrapper">
			<h1><?php esc_html_e( 'Not Found', 'skylab' ); ?></h1>
			<p class="error404 not-found"><?php esc_html_e( 'It looks like nothing was found at this location.', 'skylab' ); ?></p>

		</div>
	</div>
	
	</div></div></div></div></div></div>
	</div>
	</div><!-- #content -->
	</div><!-- #primary -->
	
	<?php
		$header_position = ot_get_option( 'header_position' );
		if ( empty( $header_position ) ) {
			$header_position = 'top';
		}
		if ( $header_position == 'left' || $header_position == 'right' ) {
		?>
		<?php get_footer(); ?>
		<?php } ?>
	
	</div><!-- #main -->
	</div><!-- .vc_column-inner -->
	</div><!-- #main-wrapper -->
	
<?php if ( $header_position == 'top' || $header_position == 'bottom' ) { ?>
<?php get_footer(); ?>
<?php } ?>