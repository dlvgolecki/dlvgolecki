<?php
/*
 * The template for displaying the footer.
 * Author & Copyright: VictorThemes
 * URL: https://victorthemes.com
 */

$elston_id    = ( isset( $post ) ) ? $post->ID : 0;
$elston_id    = ( is_home() ) ? get_option( 'page_for_posts' ) : $elston_id;
$elston_id    = ( elston_is_woocommerce_shop() ) ? wc_get_page_id( 'shop' ) : $elston_id;
$elston_meta  = get_post_meta( $elston_id, 'post_type_metabox', true );
$elston_meta_page  = get_post_meta( $elston_id, 'page_type_metabox', true );

if ($elston_meta) {
	$hide_footer  = $elston_meta['hide_footer'];
} else { $hide_footer = ''; }
if ($elston_meta_page) {
	$hide_footer  = $elston_meta_page['hide_footer'];
} else { $hide_footer = ''; }
if (!$hide_footer) { // Hide Footer Metabox
?>
	<!-- Footer -->
	<footer class="elstn-footer">
		<?php
		  $need_copyright = cs_get_option('need_copyright');
			if (isset($need_copyright)) {
	    	// Copyright Block
				get_template_part( 'layouts/footer/footer', 'copyright' );
	    }
		?>
	</footer>
	<!-- Footer -->
<?php } // Hide Footer Metabox ?>
	  </div>
	</div>

	<!-- elstn back top -->
	<div class="elstn-back-top">
	  <a href="#0"><i class="fa fa-angle-up" aria-hidden="true"></i></a>
	</div>
</div><!-- #elston-wrapper -->
<?php wp_footer(); ?>
</body>
</html><?php
