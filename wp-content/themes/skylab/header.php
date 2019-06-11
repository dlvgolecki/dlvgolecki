<?php
/**
 * The Header.
 *
 * @package WordPress
 * @subpackage Skylab
 * @since Skylab 1.0
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>" />
<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=yes, minimum-scale=1.0" />

<meta http-equiv="X-UA-Compatible" content="IE=Edge">

<link rel="profile" href="http://gmpg.org/xfn/11" />
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
	
<?php wp_head(); ?>
</head>


<body <?php body_class(); ?>>

	<?php $header_style = ot_get_option( 'header_style' ); ?>
	<?php if ( empty( $header_style ) ) { ?>
		<?php $header_style = 'non_fixed'; ?>
	<?php } ?>
	
	<?php if ( $header_style == 'fixed' ) { ?>
		<?php $header_style_class = 'sticky-header'; ?>
	<?php } else if ( $header_style == 'fixed-on-scroll' ) { ?>
		<?php $header_style_class = 'sticky-header-on-scroll'; ?>
	<?php } else { ?>
		<?php $header_style_class = 'non-sticky-header'; ?>
	<?php } ?>
	
	<?php $header_height_reduction_scrolling = ot_get_option( 'header_height_reduction_scrolling' ); ?>
	<?php if ( empty( $header_height_reduction_scrolling ) ) { ?>
		<?php $header_height_reduction_scrolling = 'disable'; ?>
	<?php } ?>
	
	<?php if ( $header_height_reduction_scrolling == 'disable' ) { ?>
		<?php $header_height_reduction_scrolling_class = 'no-height-reduction'; ?>
	<?php } else { ?>
		<?php $header_height_reduction_scrolling_class = ''; ?>
	<?php } ?>

	<?php $center_logo_and_menu = ot_get_option( 'center_logo_and_menu' ); ?>
	<?php if ( ! empty( $center_logo_and_menu ) ) { ?>
		<?php $center_logo_and_menu_class = 'center-logo-and-menu-enabled'; ?>
	<?php } else { ?>
		<?php $center_logo_and_menu_class = 'center-logo-and-menu-disabled'; ?>
	<?php } ?>

	<?php $enable_full_width_for_header = ot_get_option( 'enable_full_width_for_header' ); ?>
	<?php if ( ! empty( $enable_full_width_for_header ) ) { ?>
		<?php $full_width_for_header = 'full-width-header-enabled'; ?>
	<?php } else { ?>
		<?php $full_width_for_header = 'full-width-header-disabled'; ?>
	<?php } ?>
	
	<?php $header_position = ot_get_option( 'header_position' ); ?>
	<?php if ( empty( $header_position ) || $header_position == 'top' ) { ?>
		<?php $header_position_class = 'header-position-top'; ?>
	<?php } else if ( $header_position == 'left' ) { ?>
		<?php $header_position_class = 'header-position-left'; ?>
	<?php } else if ( $header_position == 'bottom' ) { ?>
		<?php $header_position_class = 'header-position-bottom'; ?>
	<?php } else if ( $header_position == 'right' ) { ?>
		<?php $header_position_class = 'header-position-right'; ?>
	<?php } ?>

	<?php $enable_full_width_for_footer = ot_get_option( 'enable_full_width_for_footer' ); ?>
	<?php if ( ! empty( $enable_full_width_for_footer ) ) { ?>
		<?php $full_width_for_footer = 'full-width-footer-enabled'; ?>
	<?php } else { ?>
		<?php $full_width_for_footer = 'full-width-footer-disabled'; ?>
	<?php } ?>

	<?php $secondary_menu_align = ot_get_option( 'secondary_menu_align' ); ?>
	<?php if ( empty( $secondary_menu_align ) ) { ?>
		<?php $secondary_menu_align = 'secondary-menu-align-right'; ?>
	<?php } else { ?>
		<?php $secondary_menu_align = 'secondary-menu-align-left'; ?>
	<?php } ?>
	
	<?php $secondary_menu_position = ot_get_option( 'secondary_menu_position' ); ?>
	<?php if ( empty( $secondary_menu_position ) ) { ?>
		<?php $secondary_menu_position = 'header'; ?>
	<?php } ?>

	<?php $center_and_enable_full_width_for_secondary_menu = ot_get_option( 'center_and_enable_full_width_for_secondary_menu' ); ?>
	<?php if ( ! empty( $center_and_enable_full_width_for_secondary_menu ) ) { ?>
		<?php $center_and_enable_full_width_for_secondary_menu = 'secondary-menu-center-and-full-width-enabled'; ?>
	<?php } else { ?>
		<?php $center_and_enable_full_width_for_secondary_menu = 'secondary-menu-center-and-full-width-disabled'; ?>
	<?php } ?>
	
	<?php $enable_top_bar = ot_get_option( 'enable_top_bar' ); ?>
	<?php if ( ! empty( $enable_top_bar ) ) { ?>
		<?php $enable_top_bar = 'top-bar-enabled'; ?>
	<?php } else { ?>
		<?php $enable_top_bar = 'top-bar-disabled'; ?>
	<?php } ?>
	
	<?php if ( is_page_template( 'page-header-tansparent.php' ) ) { ?>
		<?php $transparent_header = 'transparent-header'; ?>
	<?php } else { ?>
		<?php $transparent_header = ''; ?>
	<?php } ?>
	
	<?php $page_load_progress_bar = ot_get_option( 'page_load_progress_bar' ); ?>
	<?php if ( ! empty( $page_load_progress_bar ) ) { ?>
		<?php $page_load_progress_bar = 'hidden'; ?>
	<?php } else { ?>
		<?php $page_load_progress_bar = ''; ?>
	<?php } ?>
	
	<?php $page_classes = array(
		$page_load_progress_bar,
		$header_style_class,
		$header_height_reduction_scrolling_class,
		$full_width_for_header,
		$header_position_class,
		$full_width_for_footer,
		$secondary_menu_align,
		$center_and_enable_full_width_for_secondary_menu,
		$enable_top_bar,
		$transparent_header,
		$center_logo_and_menu_class,
		'hfeed',
		'hidden'
	);
	
	$page_classes = implode(' ', array_filter($page_classes)); ?>

<!-- Page
================================================== -->
<div id="page" class="<?php echo esc_attr( $page_classes ); ?>">

<!-- Head
================================================== -->

<?php // Top Bar ?>
<?php if ( $enable_top_bar == 'top-bar-enabled' ) { ?>
	<?php get_template_part( 'top-bar' ); ?>
<?php } ?>

<?php if ( $header_position == 'left' || $header_position == 'right' ) { ?>
<div id="header-main-wrapper">
<?php } ?>
<div id="header-wrapper" class="header-wrapper vc_column_container <?php if ( $header_style == 'fixed' && ( $enable_top_bar == 'top-bar-disabled' ) && empty( $center_logo_and_menu ) ) { ?>fixed<?php } ?>">
	
	<?php $header_height = ot_get_option( 'header_height' ); ?>
	<?php if ( empty( $header_height ) ) { ?>
		<?php $header_height = 64; ?>
	<?php } ?>
	
	<?php $header_height_on_scrolling = ot_get_option( 'header_height_on_scrolling' ); ?>
	<?php if ( empty( $header_height_on_scrolling ) ) { ?>
		<?php $header_height_on_scrolling = 54; ?>
	<?php } ?>
	
	<?php if ( has_nav_menu( 'primary' ) ) { ?>
		<div class="overlay-for-primary-menu"></div>
		<div class="overlay-for-mobile-menu"></div>
		<div class="overlay-for-post-info"></div>
	<?php } ?>
	
	<?php if ( $header_height_reduction_scrolling == 'enable' && $header_style == 'fixed' && in_array($header_position, array("top", "bottom")) ) { ?>
		<?php $header_height_reduction_scrolling_data = "data-99='height: {$header_height}px;' data-100='height: {$header_height_on_scrolling}px;' data-smooth-scrolling='off'"; ?>
	<?php } else { ?>
		<?php $header_height_reduction_scrolling_data = '';?>
	<?php } ?>
	
	<div class="vc_column-inner">
	<div id="header" class="header header-init" <?php echo $header_height_reduction_scrolling_data; ?>>
		
		<?php // Search ?>
		<?php if ( empty( $center_logo_and_menu ) ) { ?>
			<?php $search_header_position = ot_get_option( 'search_header_position' ); ?>
			<?php if ( empty( $search_header_position ) ) { ?>
				<?php $search_header_position = 'none'; ?>
			<?php } ?>
			<?php if ( $search_header_position == 'header' ) { ?>
				<div class="search-wrapper">
					<div class="search-form-wrapper">
						<?php //get_search_form(); // Search form ?>
						<form method="get" class="searchform" action="<?php echo esc_url( home_url( '/' ) ); ?>">
							<input type="text" class="s field" name="s" placeholder="<?php esc_html_e( 'Search', 'skylab' ) ?>" autocomplete="off" /> 
						</form>
					</div>
				</div>
			<?php } ?>
		<?php } ?>
		
		<?php // Secondary Menu ?>
		<?php if ( has_nav_menu( 'secondary' ) ) { ?>
			<div class="overlay-for-secondary-menu"></div>
		
			<?php $secondary_menu_align = ot_get_option( 'secondary_menu_align' ); ?>
			<?php if ( empty( $secondary_menu_align ) ) { ?>
				<?php $secondary_menu_align = 'right'; ?>
			<?php } ?>
			
			<?php $center_and_enable_full_width_for_secondary_menu = ot_get_option( 'center_and_enable_full_width_for_secondary_menu' ); ?>
			<?php if ( ! empty( $center_and_enable_full_width_for_secondary_menu ) ) { ?>
				<?php $center_and_enable_full_width_for_secondary_menu_class = 'center-and-full-width-enabled' ; ?>
			<?php } else { ?>
				<?php $center_and_enable_full_width_for_secondary_menu_class = 'center-and-full-width-disabled' ; ?>
			<?php } ?>
			
			<div id="secondary-menu-wrapper" class="clearfix align-<?php echo esc_attr( $secondary_menu_align ); ?> <?php echo esc_attr( $center_and_enable_full_width_for_secondary_menu_class ); ?>">
				<span class="close-button"></span>
				<div id="access-secondary-menu-wrapper" class="clearfix">		 
					<nav id="access-secondary-menu" class="clearfix">
						<?php wp_nav_menu( array( 'theme_location' => 'secondary', 'menu_class' => 'nav-menu secondary-menu', 'link_before' => '<span>', 'link_after' => '</span>' ) ); ?>
					</nav><!-- #access-secondary-menu -->
					
					<?php if ( is_active_sidebar( 'sidebar-10' ) ) { ?>
						<div class="secondary-menu-area-one widget-area clearfix">
							<div class="clearfix">
								<?php dynamic_sidebar( 'sidebar-10' ); ?>
							</div>
						</div><!-- .secondary-menu-area-one -->
					<?php } ?>
				</div>
			</div>
		<?php } ?>
		
		<?php // Mobile Menu ?>
		<?php if ( has_nav_menu( 'primary' ) ) { ?>
			<?php $mobile_menu_position = ot_get_option( 'mobile_menu_position' ); ?>
			<?php if ( empty( $mobile_menu_position ) ) { ?>
				<?php $mobile_menu_position = 'left'; ?>
			<?php } ?>
			<div class="mobile-menu-wrapper clearfix align-<?php echo esc_attr( $mobile_menu_position ); ?>">
				<span class="close-button"></span>
				<div class="access-mobile-menu-wrapper clearfix">		 
						<?php if ( has_nav_menu( 'primary' ) ) { ?>
							<?php wp_nav_menu( array(
								'theme_location' => 'primary',
								'menu_class' => 'nav-menu-mobile',
								'container_class' => 'nav-menu nav-menu-mobile-wrapper nav-menu-primary-header',
								'link_before' => '<span>', 'link_after' => '</span>'
							) ); ?>
						<?php } ?>
						
						<?php // Secondary menu in header ?>
						<?php if ( has_nav_menu( 'secondary_header' ) ) { ?>
							<?php wp_nav_menu( array(
								'theme_location' => 'secondary_header',
								'menu_class' => 'nav-menu-mobile',
								'container_class' => 'nav-menu nav-menu-mobile-wrapper nav-menu-secondary-header',
								'link_before' => '<span>',
								'link_after' => '</span>' )
							); ?>
						<?php } ?>
						
						<?php $social_icons_position = ot_get_option( 'social_icons_position' ); ?>
						<?php if ( $social_icons_position == 'header' || $social_icons_position == 'top_bar' || ! empty( $top_bar_info ) || has_nav_menu( 'top_bar' ) || ! empty( $header_info ) ) { ?>
						<div class="mobile-elements-wrapper">
						<?php } ?>
						
						<?php if ( $social_icons_position == 'header' || $social_icons_position == 'top_bar' ) { ?>
							<?php $social_links_style = ot_get_option( 'social_links_style' ); ?>
							<?php if ( empty( $social_links_style ) ) { ?>
								<?php $social_links_style = '1'; ?>
							<?php } ?>
							<div class="social-links-wrapper-mobile social-links-style-<?php echo esc_attr( $social_links_style ); ?>">
								<?php get_template_part( 'social-links' ); ?>
							</div>
						<?php } ?>
						
						<?php $top_bar_info = ot_get_option( 'top_bar_info' ); ?>
						<?php if ( ! empty( $top_bar_info ) ) { ?>
							<div class="info-header">
									<?php if ( function_exists( 'icl_t' ) ) { ?>
										<?php echo icl_t( 'OptionTree', 'top_bar_info', $top_bar_info ); ?>
									<?php } else { ?>
										<?php echo wpautop( $top_bar_info ); ?>
									<?php } ?>
							</div>
						<?php } ?>
						
						<?php if ( has_nav_menu( 'top_bar' ) ) { ?>
							<div class="menu-wrapper menu-wrapper-secondary">
								<?php wp_nav_menu( array( 'theme_location' => 'top_bar', 'menu_class' => 'top-bar-menu' ) ); ?>
							</div>
						<?php } ?>
						
						<?php $header_info = ot_get_option( 'header_info' ); ?>
						<?php if ( ! empty( $header_info ) ) { ?>
							<div class="info-header">
								<?php if ( function_exists( 'icl_t' ) ) { ?>
									<?php echo icl_t( 'OptionTree', 'header_info', $header_info ); ?>
								<?php } else { ?>
									<?php echo wpautop( $header_info ); ?>
								<?php } ?>
							</div>
						<?php } ?>
						
						<?php if ( $social_icons_position == 'header' || $social_icons_position == 'top_bar' || ! empty( $top_bar_info ) || has_nav_menu( 'top_bar' ) || ! empty( $header_info ) ) { ?>
						</div><!-- .mobile-elements-wrapper -->
						<?php } ?>
						
						<?php $enable_button = ot_get_option( 'enable_button' ); ?>
						<?php if ( ! empty( $enable_button ) ) { ?>
							<?php $button_text = ot_get_option( 'button_text' ); ?>
							<?php $button_url = ot_get_option( 'button_url' ); ?>
							<div class="vc_btn3-container">
								<a class="vc_general vc_btn3 vc_btn3-size-sm vc_btn3-shape-rounded vc_btn3-style-modern vc_btn3-color-green" href="<?php echo esc_url( $button_url ); ?>"><span><?php echo esc_html( $button_text ); ?></span></a>
							</div>
						<?php } ?>
				</div>
			</div>
		<?php } ?>
		
		<header id="branding" class="clearfix <?php if ( $header_style == 'fixed' && in_array($header_position, array("top", "bottom")) || $header_style == 'fixed-on-scroll' && in_array($header_position, array("top", "bottom")) ) { ?>compensate-for-scrollbar<?php } ?>">
			<div class="branding-helper">
		
				<?php if ( empty( $center_logo_and_menu ) ) { ?>
					<!-- Navbar
================================================== -->
					<nav id="access" class="clearfix">
				<?php } ?>
						
						<?php // Use logo image and logo text together ?>
						<?php $logo_image_and_logo_text_together = ot_get_option( 'logo_image_and_logo_text_together' ); ?>
						<?php if ( ! empty( $logo_image_and_logo_text_together ) ) { ?>
						
								<div id="site-title" class="clearfix logo-image-and-logo-text-together">
									<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home" id="custom-logo">
										<?php $logo = ot_get_option( 'logo' ); ?>
										<?php if ( ! empty( $logo ) ) { ?>
											<?php $id = mega_custom_get_attachment_id( $logo ); ?>
											<?php $src = wp_get_attachment_image_src( $id, 'large' ); ?>
											<?php $logo_title = get_the_title( $id ); ?>
											<?php
											// Check file type
											$type =  get_post_mime_type( $id );
											$mime_type = explode('/', $type);
											if ( ! isset($mime_type['1'])) {
											   $mime_type['1'] = null;
											}
											$type = $mime_type['1'];
											?>
										
											<?php // Logo for transparent header ?>
											<?php $logo_for_transparent_header = ot_get_option( 'logo_for_transparent_header' ); ?>
											<?php if ( ! empty( $logo_for_transparent_header ) ) { ?>
												<?php $id_transparent = mega_custom_get_attachment_id( $logo_for_transparent_header ); ?>
												<?php $src_transparent = wp_get_attachment_image_src( $id_transparent, 'large' ); ?>
												<?php if ( $type == 'svg+xml' ) { ?>
													<img class="logo logo-for-transparent-header logo-svg style-svg" src="<?php echo esc_url( $src_transparent[0] ); ?>" alt="<?php echo esc_attr( $logo_title ); ?>" />
												<?php } else { ?>
													<img class="logo logo-for-transparent-header" src="<?php echo esc_url( $src_transparent[0] ); ?>" width="<?php echo esc_attr( $src_transparent[1] ); ?>" height="<?php echo esc_attr( $src_transparent[2] ); ?>" alt="<?php echo esc_attr( $logo_title ); ?>" />
												<?php } ?>
											<?php } ?>
											
											<?php if ( $type == 'svg+xml' ) { ?>
												<img class="logo logo-default logo-svg style-svg" src="<?php echo esc_url( $src[0] ); ?>" alt="<?php echo esc_attr( $logo_title ); ?>" />
											<?php } else { ?>
												<img class="logo logo-default" src="<?php echo esc_url( $src[0] ); ?>" width="<?php echo esc_attr( $src[1] ); ?>" height="<?php echo esc_attr( $src[2] ); ?>" alt="<?php echo esc_attr( $logo_title ); ?>" />
											<?php } ?>
										
										<?php } ?>
										
										<span><?php bloginfo( 'name' ); ?></span>
									</a>
								</div>
							
						<?php } else { ?>
					
							<?php $logo = ot_get_option( 'logo' ); ?>
							<?php if ( ! empty( $logo ) ) { ?>
								<?php $id = mega_custom_get_attachment_id( $logo ); ?>
								<?php $src = wp_get_attachment_image_src( $id, 'large' ); ?>
								<?php $logo_title = get_the_title( $id ); ?>
								<?php
								// Check file type
								$type =  get_post_mime_type( $id );
								$mime_type = explode('/', $type);
								if ( ! isset($mime_type['1'])) {
								   $mime_type['1'] = null;
								}
								$type = $mime_type['1'];
								?>
								<div id="site-title" class="clearfix">
									<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home" id="custom-logo">
										<?php // Logo for transparent header ?>
										<?php $logo_for_transparent_header = ot_get_option( 'logo_for_transparent_header' ); ?>
										<?php if ( ! empty( $logo_for_transparent_header ) ) { ?>
											<?php $id_transparent = mega_custom_get_attachment_id( $logo_for_transparent_header ); ?>
											<?php $src_transparent = wp_get_attachment_image_src( $id_transparent, 'large' ); ?>
											<?php if ( $type == 'svg+xml' ) { ?>
												<img class="logo-for-transparent-header logo-svg style-svg" src="<?php echo esc_url( $src_transparent[0] ); ?>" alt="<?php echo esc_attr( $logo_title ); ?>" />
											<?php } else { ?>
												<img class="logo-for-transparent-header" src="<?php echo esc_url( $src_transparent[0] ); ?>" width="<?php echo esc_attr( $src_transparent[1] ); ?>" height="<?php echo esc_attr( $src_transparent[2] ); ?>" alt="<?php echo esc_attr( $logo_title ); ?>" />
											<?php } ?>
										<?php } ?>
										
										<?php if ( $type == 'svg+xml' ) { ?>
											<img class="logo-default logo-svg style-svg" src="<?php echo esc_url( $src[0] ); ?>" alt="<?php echo esc_attr( $logo_title ); ?>" />
										<?php } else { ?>
											<img class="logo-default" src="<?php echo esc_url( $src[0] ); ?>" width="<?php echo esc_attr( $src[1] ); ?>" height="<?php echo esc_attr( $src[2] ); ?>" alt="<?php echo esc_attr( $logo_title ); ?>" />
										<?php } ?>
										
										<?php // Logo caption ?>
										<?php $logo_caption = ot_get_option( 'logo_caption' ); ?>
										<?php if ( ! empty( $logo_caption ) ) { ?>
											<span class="logo-caption"><?php echo $logo_caption; ?></span>
										<?php } ?>
									</a>
								</div>
							<?php } else { ?>
								<div id="site-title" class="clearfix">
									<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
										<span><?php bloginfo( 'name' ); ?></span>
										
										<?php // Logo caption ?>
										<?php $logo_caption = ot_get_option( 'logo_caption' ); ?>
										<?php if ( ! empty( $logo_caption ) ) { ?>
											<span class="logo-caption"><?php echo $logo_caption; ?></span>
										<?php } ?>
									</a>
								</div>
							<?php } ?>
						
						<?php } ?>
					
						<?php // Secondary menu ?>
						<?php if ( has_nav_menu( 'secondary' ) && $secondary_menu_position == 'header' ) { ?>
							<div id="secondary-menu-dropdown-wrapper" class="clearfix">
								<span id="secondary-menu-dropdown" class="clearfix">
									<span class="menu-line"></span>
								</span>
							</div>
						<?php } ?>
					
						<?php // WPML ?>
						<?php $enable_wpml_language_switcher = ot_get_option( 'enable_wpml_language_switcher' ); ?>
						<?php if ( !empty( $enable_wpml_language_switcher ) ) { ?>
							<?php if ( function_exists('icl_object_id') ) { ?>
								<div class="lang-sel-wrapper">
									<?php $languages = icl_get_languages('skip_missing=1'); ?>
									<?php foreach($languages as $l){ ?>
										<?php if ( $l['active'] ) { ?>
											<?php $active_language_class = 'class="active"'; ?>
										<?php } else { ?>
											<?php $active_language_class = ''; ?>
										<?php } ?>
										<?php $langs[] = '<a href="'. esc_url( $l['url'] ) .'" '. $active_language_class .'>'. esc_html( $l['language_code'] ) .'</a>'; ?>
									<?php } ?>
									<?php echo join('<span>/</span> ', $langs); ?>
								</div>
							<?php } ?>
						<?php } ?>
					
						<?php // Button ?>
						<?php $enable_button = ot_get_option( 'enable_button' ); ?>
						<?php if ( ! empty( $enable_button ) ) { ?>
							<?php $button_text = ot_get_option( 'button_text' ); ?>
							<?php $button_url = ot_get_option( 'button_url' ); ?>
							<div class="vc_btn3-container">
								<a class="vc_general vc_btn3 vc_btn3-size-md vc_btn3-shape-square vc_btn3-style-modern vc_btn3-color-blue" href="<?php echo esc_url( $button_url ); ?>" target="_blank"><span><?php echo esc_html( $button_text ); ?></span></a>
							</div>
						<?php } ?>
					
						<?php // Search ?>
						<?php if ( ! empty( $center_logo_and_menu ) ) { ?>
							<?php $search_header_position = ot_get_option( 'search_header_position' ); ?>
							<?php if ( $search_header_position == 'header' ) { ?>
								<div class="search-wrapper">
									<div class="search-form-wrapper">
										<form method="get" class="searchform" action="<?php echo esc_url( home_url( '/' ) ); ?>">
											<input type="text" class="s field" name="s" placeholder="<?php esc_html_e( 'Search', 'skylab' ) ?>" autocomplete="off" /> 
										</form>
										<span id="remove-search"></span>
									</div>
								</div>
							<?php } ?>
						<?php } ?>
					
						<?php $search_header_position = ot_get_option( 'search_header_position' ); ?>
						<?php if ( $search_header_position == 'header' ) { ?>	
							<div class="search-header-wrapper">
								<span id="search-header-icon"></span>
								<span id="remove-search"><i></i></span>
							</div>
						<?php } ?>
						
						
						<?php if ( $header_position !== 'left' && $header_position !== 'right' ) { ?>
						
							<?php // Social links ?>
							<?php $social_icons_position = ot_get_option( 'social_icons_position' ); ?>
							<?php if ( $social_icons_position == 'header' ) { ?>
								<?php $social_links_style = ot_get_option( 'social_links_style' ); ?>
								<?php if ( empty( $social_links_style ) ) { ?>
								<?php $social_links_style = '1'; ?>
								<?php } ?>
								<div class="social-links-wrapper social-links-style-<?php echo esc_attr( $social_links_style ); ?>">
									<?php get_template_part( 'social-links' ); ?>
								</div>
							<?php } ?>
						
							<?php // Header info ?>
							<?php $header_info = ot_get_option( 'header_info' ); ?>
							<?php if ( ! empty( $header_info ) ) { ?>
								<div class="info-header">
									<?php if ( function_exists( 'icl_t' ) ) { ?>
										<?php echo icl_t( 'OptionTree', 'header_info', $header_info ); ?>
									<?php } else { ?>
										<?php echo wpautop( $header_info ); ?>
									<?php } ?>
								</div>
							<?php } ?>
						
						<?php } ?>
						
						<?php if ( empty( $center_logo_and_menu ) ) { ?>
						
							<?php // Mobile menu ?>
							<?php if ( has_nav_menu( 'primary' ) ) { ?>
								<?php $mobile_menu_position = ot_get_option( 'mobile_menu_position' ); ?>
								<?php if ( empty( $mobile_menu_position ) ) { ?>
									<?php $mobile_menu_position = 'left'; ?>
								<?php } ?>
								<div class="mobile-menu-dropdown-wrapper clearfix align-<?php echo esc_attr( $mobile_menu_position ); ?>">
									<div>
										<span class="mobile-menu-dropdown clearfix">
											<span class="menu-line"></span>
										</span>
									</div>
								</div>
							<?php } ?>
						
							<?php // Menu ?>
							<?php $enable_full_width_menu = ot_get_option( 'enable_full_width_menu' ); ?>
							<?php if ( empty( $enable_full_width_menu ) ) { ?>
								<?php if ( has_nav_menu( 'primary' ) ) { ?>
									<?php wp_nav_menu( array(
										'theme_location' => 'primary',
										'walker' => new mega_Sublevel_Walker,
										'menu_class' => 'sf-menu',
										'container_class' => 'nav-menu nav-menu-primary-header',
										'link_before' => '<span>',
										'link_after' => '</span>' )
									); ?>
								<?php } ?>
							<?php } ?>
							
							<?php // Secondary menu in header ?>
							<?php if ( has_nav_menu( 'secondary_header' ) ) { ?>
								<?php wp_nav_menu( array(
									'theme_location' => 'secondary_header',
									'walker' => new mega_Sublevel_Walker,
									'menu_class' => 'sf-menu',
									'container_class' => 'nav-menu nav-menu-secondary-header',
									'link_before' => '<span>',
									'link_after' => '</span>' )
								); ?>
							<?php } ?>
							
						<?php } ?>
						
						<?php // Social links and header info in left or right header ?>
						<?php if ( $header_position == 'left' || $header_position == 'right' ) { ?>
						
							<div class="header-elements-wrapper">
							
								<?php // Social links ?>
								<?php $social_icons_position = ot_get_option( 'social_icons_position' ); ?>
								<?php if ( $social_icons_position == 'header' ) { ?>
									<?php $social_links_style = ot_get_option( 'social_links_style' ); ?>
									<?php if ( empty( $social_links_style ) ) { ?>
									<?php $social_links_style = '1'; ?>
									<?php } ?>
									<div class="social-links-wrapper social-links-style-<?php echo esc_attr( $social_links_style ); ?>">
										<?php get_template_part( 'social-links' ); ?>
									</div>
								<?php } ?>
							
								<?php // Header info ?>
								<?php $header_info = ot_get_option( 'header_info' ); ?>
								<?php if ( ! empty( $header_info ) ) { ?>
									<div class="info-header">
										<?php if ( function_exists( 'icl_t' ) ) { ?>
											<?php echo icl_t( 'OptionTree', 'header_info', $header_info ); ?>
										<?php } else { ?>
											<?php echo wpautop( $header_info ); ?>
										<?php } ?>
									</div>
								<?php } ?>
							
							</div>
						
						<?php } ?>
						
						<?php // WooCommerce ?>
						<?php $woocommerce_cart_position = ot_get_option( 'woocommerce_cart_position' ); ?>
						<?php if ( $woocommerce_cart_position == 'header' ) { ?>
							<?php global $woocommerce; ?>
							<?php if ( $woocommerce ) { ?>
								<div class="woocommerce-links-area">
								<div class="woocommerce-cart-wrapper">
									<?php if ( ! $woocommerce->cart->cart_contents_count ) { ?>
										<a class="woocommerce-cart" href="<?php echo esc_url( $woocommerce->cart->get_cart_url() ); ?>"><span><i></i></span></a>
									<?php } else { ?>
										<a class="woocommerce-cart" href="<?php echo esc_url( $woocommerce->cart->get_cart_url() ); ?>"><span><i></i> <span class="cart-contents-count"><?php echo $woocommerce->cart->cart_contents_count; ?></span></span></a>
										<div class="product-list-cart">
											<em></em>
											<ul>
											<?php foreach($woocommerce->cart->cart_contents as $cart_item): //var_dump($cart_item); ?>
												<li>
													<a href="<?php echo esc_url( get_permalink( $cart_item['product_id'] ) ); ?>">
														<?php echo get_the_post_thumbnail( $cart_item['product_id'], 'shop_thumbnail' ); ?>
														<span class="product"><?php echo $cart_item['data']->post->post_title; ?></span>
													</a>
													<?php echo $cart_item['quantity']; ?> x <?php echo $woocommerce->cart->get_product_subtotal( $cart_item['data'], $cart_item['quantity'] ); ?>
												</li>
												<?php endforeach; ?>
											</ul>
											<div class="woocommerce-cart-checkout">
												<div class="woocommerce-cart-total-wrapper">
													<span class="woocommerce-cart-total-text"><?php esc_html_e( 'Total', 'skylab' ); ?></span><span class="woocommerce-cart-total-number"><?php echo WC()->cart->get_cart_total(); ?></span>
												</div>
												<a class="button alt to-checkout" href="<?php echo esc_url( get_permalink( get_option( 'woocommerce_checkout_page_id' ) ) ); ?>"><span><?php esc_html_e( 'To checkout', 'skylab' ); ?></span></a>
												<a class="button to-cart" href="<?php echo esc_url( get_permalink( get_option( 'woocommerce_cart_page_id' ) ) ); ?>"><span><?php esc_html_e( 'View cart', 'skylab' ); ?></span></a>
											</div>
										</div>
									<?php } ?>
								</div>
							<?php } // End if ( $woocommerce ) ?>
						<?php } // End if ( $woocommerce_cart_position == 'header' ) ?>
						
						<?php global $woocommerce; ?>
						<?php if ( $woocommerce ) { ?>
							<?php $enable_woocommerce_links = ot_get_option( 'enable_woocommerce_links' ); ?>
							<?php if ( $enable_woocommerce_links == 'enable' ) { ?>
								<div class="woocommerce-links-wrapper transition">
									<a href="<?php echo esc_url( get_permalink( get_option('woocommerce_myaccount_page_id') ) ); ?>" class="woocommerce-links-icon"><span><i></i></span></a>
									
									<div class="woocommerce-links">
										<em></em>
										<?php if ( is_user_logged_in() ) { ?>
											<ul>
												<li><a class="logout" href="<?php echo esc_url( get_permalink( get_option('woocommerce_logout_page_id') ) ); ?>"><span><?php esc_html_e( 'Logout', 'skylab' ); ?></span></a></li>
												<li><a class="account" href="<?php echo esc_url( get_permalink( get_option('woocommerce_myaccount_page_id') ) ); ?>"><span><?php esc_html_e( 'My Account', 'skylab' ); ?></span></a></li>
											</ul>
										<?php } else { ?>
											<ul>
												<li><a class="account" href="<?php echo esc_url( get_permalink( get_option('woocommerce_myaccount_page_id') ) ); ?>"><span><?php esc_html_e( 'Login', 'skylab' ); ?></span></a></li>
											</ul>
										<?php } ?>
									</div>
								</div>
							<?php } ?>
						<?php } ?>
						
						<?php // YITH WooCommerce Wishlist ?>
						<?php if ( class_exists( 'YITH_WCWL' ) ) { ?>
							<div class="yith-wishlist-wrapper transition">
								<a href="<?php echo esc_url( get_permalink( get_option('yith_wcwl_wishlist_page_id') ) ); ?>" class="yith-wishlist-icon"><span><i></i></span></a>
							</div>
						<?php } ?>
				
						<?php $enable_woocommerce_links = ot_get_option( 'enable_woocommerce_links' ); ?>
						<?php if ( $woocommerce_cart_position == 'header' || $enable_woocommerce_links == 'enable' || class_exists( 'YITH_WCWL' ) ) { ?>
							<?php global $woocommerce; ?>
							<?php if ( $woocommerce ) { ?>
								</div><!-- .woocommerce-links-area -->
							<?php } ?>
						<?php } ?>
					
				<?php if ( empty( $center_logo_and_menu ) ) { ?>
					</nav><!-- #access -->
				<?php } ?>
					
			</div><!-- .branding-helper -->
		</header><!-- #branding -->
		
		<?php // Center Logo and Menu ?>
		<?php if ( ! empty( $center_logo_and_menu ) ) { ?>
			<?php $menu_height = ot_get_option( 'menu_height' ); ?>
			<?php if ( empty( $menu_height ) ) { ?>
				<?php $menu_height = 73; ?>
			<?php } ?>
			<?php $menu_height_on_scrolling = ot_get_option( 'menu_height_on_scrolling' ); ?>
			<?php if ( empty( $menu_height_on_scrolling ) ) { ?>
				<?php $menu_height_on_scrolling = 50; ?>
			<?php } ?>
			<nav id="access-wrapper">
				<div id="nav-menu-wrapper">
					<nav id="access" class="clearfix">
						<?php if ( has_nav_menu( 'primary' ) ) { ?>
							<?php wp_nav_menu( array( 'theme_location' => 'primary', 'menu_class' => 'sf-menu', 'container_class' => 'nav-menu', 'link_before' => '<span>', 'link_after' => '</span>' ) ); ?>
						<?php } else { ?>
							<?php //wp_page_menu( array( 'sort_column' => 'menu_order', 'menu_class' => 'page-menu' ) ); ?>
						<?php } ?>
					</nav><!-- #access -->
				</div><!-- #nav-menu-wrapper -->
			</nav><!-- #access-wrapper -->
		<?php } ?>
		
	</div><!-- #header -->
	</div><!-- .vc_column-inner -->
</div><!-- #header-wrapper -->
