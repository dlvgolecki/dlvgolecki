<?php
/*
	Plugin Name: Norebro Shortcodes and Widgets
	Plugin URI: http://norebro.colabr.io/
	Description: Supercharge Norebro theme with pack of shortcodes, custom VC settings types and sidebar widgets
	Version: 1.2.6
	Author: colabrio
	Author URI: http://norebro.colabr.io/

	Copyright 2019 colabrio (email: support@colabr.io)

	This program is free software; you can redistribute it and/or modify
	it under the terms of the GNU General Public License as published by
	the Free Software Foundation; either version 2 of the License, or
	(at your option) any later version.

	This program is distributed in the hope that it will be useful,
	but WITHOUT ANY WARRANTY; without even the implied warranty of
	MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
	GNU General Public License for more details.

	You should have received a copy of the GNU General Public License
	along with this program; if not, write to the Free Software
	Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/

$norebro_extra_get_theme = wp_get_theme();

if ( in_array( $norebro_extra_get_theme->get( 'TextDomain' ), array( 'norebro', 'norebro-child' ) ) ) {

	add_action( 'plugins_loaded', 'norebro_extra_load_plugin_textdomain' );

	function norebro_extra_load_plugin_textdomain() {
		load_plugin_textdomain( 'norebro-extra', false, dirname( plugin_basename( __FILE__ ) ) . '/languages/' );
	}

	add_action( 'vc_before_init', 'norebro_extra_vc_init_plugin' );

	if ( function_exists( 'vc_set_shortcodes_templates_dir' ) ) {
		$vc_template_dir = plugin_dir_path( __FILE__ ) . 'vc_templates';
		vc_set_shortcodes_templates_dir( $vc_template_dir );
	}


	// Norebro social shortcodes
	function norebro_share_woo_func( ) {		
		global $post;

		$social_networks = NorebroSettings::get( 'woocommerce_sharing_networks', 'global' );

		if ( !$social_networks ) {
			return false;
		}

		$facebook_link = 'https://www.facebook.com/sharer/sharer.php?u=' . rawurlencode( get_permalink() );
		$twitter_link = 'https://twitter.com/intent/tweet?text=' . urlencode( $post->post_title ) . ',+' . rawurlencode( get_permalink() );
		$google_link = 'https://plus.google.com/share?url=' . rawurlencode( get_permalink() );
		$linkedin_link = 'https://www.linkedin.com/shareArticle?mini=true&url=' . rawurlencode( get_permalink() ) . '&title=' . urlencode( $post->post_title ) . '&source=' . urlencode( get_bloginfo( 'name' ) );
		$pinterest_link = 'http://pinterest.com/pin/create/button/?url=' . rawurlencode( get_permalink() ) . '&description=' . urlencode( $post->post_title );
		$vk_link = 'http://vk.com/share.php?url=' . rawurlencode( get_permalink() );
		?>

		<div class="woocommerce-share">
			<div class="wrap">
				<?php _e( 'Share this product', 'norebro' ); ?>:
				<div class="socialbar flat">
				<?php
					foreach ( $social_networks as $link ) {
						switch ( $link ) {
							case 'facebook':
								echo '<a href="' . $facebook_link . '"><span class="fa fa-facebook"></span></a>';
								break;
							case 'twitter':
								echo '<a href="' . $twitter_link . '"><span class="fa fa-twitter"></span></a>';
								break;
							case 'googleplus':
								echo '<a href="' . $google_link . '"><span class="fa fa-google"></span></a>';
								break;
							case 'linkedin':
								echo '<a href="' . $linkedin_link . '"><span class="fa fa-linkedin"></span></a>';
								break;
							case 'pinterest':
								echo '<a href="' . $pinterest_link . '"><span class="fa fa-pinterest-p"></span></a>';
								break;
							case 'vk':
								echo '<a href="' . $vk_link . '"><span class="fa fa-vk"></span></a>';
								break;
						}
					}
				?>
				</div>
			</div>
		</div>
		<?php return "";
	}
	add_shortcode( 'norebro_share_woo', 'norebro_share_woo_func' );

	function norebro_share_blog_func( ) {
		global $post;

		$social_networks = NorebroSettings::get( 'post_sharing_networks', 'global' );

		if ( !$social_networks ) {
			return false;
		}

		$facebook_link = 'https://www.facebook.com/sharer/sharer.php?u=' . rawurlencode( get_permalink() );
		$twitter_link = 'https://twitter.com/intent/tweet?text=' . urlencode( $post->post_title ) . ',+' . rawurlencode( get_permalink() );
		$google_link = 'https://plus.google.com/share?url=' . rawurlencode( get_permalink() );
		$linkedin_link = 'https://www.linkedin.com/shareArticle?mini=true&url=' . rawurlencode( get_permalink() ) . '&title=' . urlencode( $post->post_title ) . '&source=' . urlencode( get_bloginfo( 'name' ) );
		$pinterest_link = 'http://pinterest.com/pin/create/button/?url=' . rawurlencode( get_permalink() ) . '&description=' . urlencode( $post->post_title );
		$vk_link = 'http://vk.com/share.php?url=' . rawurlencode( get_permalink() );
		?>

		<div class="share" data-blog-share="true">
			<div class="title"><?php echo esc_html__( 'Share story', 'norebro' ); ?></div>
			<div class="socialbar small outline default">
			<?php
				foreach ( $social_networks as $link ) {
					switch ( $link ) {
						case 'facebook':
							echo '<a href="' . $facebook_link . '" class="facebook"><span class="fa fa-facebook"></span></a>';
							break;
						case 'twitter':
							echo '<a href="' . $twitter_link . '" class="twitter"><span class="fa fa-twitter"></span></a>';
							break;
						case 'googleplus':
							echo '<a href="' . $google_link . '" class="googleplus"><span class="fa fa-google"></span></a>';
							break;
						case 'linkedin':
							echo '<a href="' . $linkedin_link . '" class="linkedin"><span class="fa fa-linkedin"></span></a>';
							break;
						case 'pinterest':
							echo '<a href="' . $pinterest_link . '" class="pinterest"><span class="fa fa-pinterest-p"></span></a>';
							break;
						case 'vk':
							echo '<a href="' . $vk_link . '" class="vk"><span class="fa fa-vk"></span></a>';
							break;
					}
				}
			?>
			</div>
		</div>
		<?php return "";
	}
	add_shortcode( 'norebro_share_blog', 'norebro_share_blog_func' );



	function norebro_extra_vc_init_plugin() {
        $shortcodes_path = plugin_dir_path( __FILE__ ) . 'shortcodes/';
        $helpers_path 	= plugin_dir_path( __FILE__ ) . 'helpers/';
        $types_path 	= plugin_dir_path( __FILE__ ) . 'types/';

        // Helpers
        require_once $helpers_path . 'parsing.php';
        require_once $helpers_path . 'filtering.php';
        require_once $helpers_path . 'google_fonts.php';
        require_once $helpers_path . 'adobe_fonts.php';

        // VC param types
        require_once $types_path . 'input.php'; // Fully HTML allowed input
        require_once $types_path . 'button.php'; // Button settings
        require_once $types_path . 'columns.php'; // Columns settings
        require_once $types_path . 'colorpicker.php'; // Color picker settings
        require_once $types_path . 'choose_box.php'; // Radio select with images
        require_once $types_path . 'check.php'; // Pretty checkboxes
        require_once $types_path . 'divider.php'; // Simple titled divider
        require_once $types_path . 'typography.php'; // Powerfull typography module
        //require_once $types_path . 'icon_selector.php'; // Old extended icon selector
        require_once $types_path . 'icon_picker.php'; // Extended icon picker
        require_once $types_path . 'datetime.php'; // JQuery datetime selector
        require_once $types_path . 'portfolio_types.php'; // Dropdown with portfolio categories
        require_once $types_path . 'post_types.php'; // Dropdown with post categories
        require_once $types_path . 'woo_cats_types.php'; // Dropdown with WooCommerce categories

        // VC shortcodes
        $dh = opendir( $shortcodes_path );
        while ( false !== ( $filename = readdir( $dh ) ) ) {
          if ( substr( $filename, 0, 1) != '_' && strrpos( $filename, '.' ) === false ) {
            include_once $shortcodes_path . $filename . '/' . $filename . '.php';
            include_once $shortcodes_path . $filename . '/' . $filename . '__params.php';
          }
        }

        add_action('vc_after_init', function() {
        		// Custom setting for default row
				$useLinesData = array(
					'type' => 'norebro_check',
					'heading' => __( 'Use through lines under background?', 'norebro-extra' ),
					'param_name' => 'use_through_lines',
					'description' => __( '...', 'norebro-extra' ),
					'value' => array(
						__( 'Yes, use lines for this row', 'norebro-extra' ) => '0'
					)
				);
				vc_update_shortcode_param( 'vc_row', $useLinesData );

				$linesStyleData = array(
					'type' => 'dropdown',
					'heading' => __( 'Through lines background style', 'norebro-extra' ),
					'param_name' => 'through_lines_style',
					'description' => __( '...', 'norebro-extra' ),
					'value' => array(
						__( 'Dark', 'norebro-extra' ) => 'dark',
						__( 'Light', 'norebro-extra' ) => 'light'
					),
					'dependency' => array(
						'element' => 'use_through_lines',
						'value' => array(
							'1'
						)
					)
				);
				vc_update_shortcode_param( 'vc_row', $linesStyleData );

				$sideTitleData = array(
					'type' => 'textfield',
					'group' => __( 'Side Background Title', 'norebro-extra' ),
					'heading' => __( 'Background title text', 'norebro-extra' ),
					'param_name' => 'side_background_title',
					'description' => __( 'Recommended to use short headers.', 'norebro-extra' ),
				);
				vc_update_shortcode_param( 'vc_row', $sideTitleData );

				$sideTitleAlignmentData = array(
					'type' => 'dropdown',
					'group' => __( 'Side Background Title', 'norebro-extra' ),
					'heading' => __( 'Background title alignment', 'norebro-extra' ),
					'param_name' => 'side_background_title_alignment',
					'value' => array(
						__( 'Left', 'norebro-extra' ) => 'left',
						__( 'Right', 'norebro-extra' ) => 'right'
					)
				);
				vc_update_shortcode_param( 'vc_row', $sideTitleAlignmentData );

				$sideTitleColorData = array(
					'type' => 'norebro_colorpicker',
					'group' => __( 'Side Background Title', 'norebro-extra' ),
					'heading' => __( 'Background title color', 'norebro-extra' ),
					'param_name' => 'side_background_title_color',
					'description' => __( 'Recommended to use transparent or non-contrast colors.', 'norebro-extra' ),
				);
				vc_update_shortcode_param( 'vc_row', $sideTitleColorData );

				$sideTitleTypoData = array(
					'type' => 'norebro_typography',
					'group' => __( 'Side Background Title', 'norebro-extra' ),
					'heading' => __( 'Background title typography', 'norebro-extra' ),
					'param_name' => 'side_background_title_typo'
				);
				vc_update_shortcode_param( 'vc_row', $sideTitleTypoData );
			});
	}


	add_action( 'widgets_init', 'norebro_extra_widgets_init_plugin' );

	function norebro_extra_widgets_init_plugin() {
		$widgets_path = plugin_dir_path( __FILE__ ) . 'widgets/';

		require_once $widgets_path . 'widget.php';

		require_once $widgets_path . 'widget-about-author.php'; // About author. Multicontext widget
		require_once $widgets_path . 'widget-contacts.php'; // Contacts block widget
		require_once $widgets_path . 'widget-login.php'; // Login into Wordpress
		require_once $widgets_path . 'widget-logo.php'; // Show logo in sidebar
		require_once $widgets_path . 'widget-menu.php'; // Navigation widget
		require_once $widgets_path . 'widget-recent.php'; // Recent posts widget
		require_once $widgets_path . 'widget-socialbar-subscribe.php'; // ?
		require_once $widgets_path . 'widget-socialbar.php'; // Social bar icons with
		require_once $widgets_path . 'widget-subscribe.php'; // Subscribe by Feedburner feed
	}

	// ACF Norebro fields extention
	require plugin_dir_path( __FILE__ ) . 'acf_ext/acf-fields.php';

} else {
	add_action( 'admin_notices', 'norebro_extra_admin_notice' );

	function norebro_extra_admin_notice() {
?>
	<div class="notice notice-error">
		<p>
			<strong><?php esc_html_e( '"Norebro Shortcodes and Widgets" plugin is not supported by this theme', 'norebro-extra' ); ?></strong>
			<br>
			<?php esc_html_e( 'Please use this plugin with Norebro theme, or deactivate it.', 'norebro' ); ?>
		</p>
	</div>
<?php
	}
}