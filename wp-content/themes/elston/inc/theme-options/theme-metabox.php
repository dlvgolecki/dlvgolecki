<?php
/*
 * All Metabox related options for Elston theme.
 * Author & Copyright: VictorThemes
 * URL: https://victorthemes.com
 */

function elston_metabox_options( $options ) {

  $options      = array();

  // -----------------------------------------
  // Post Metabox Options                    -
  // -----------------------------------------
  $options[]    = array(
    'id'        => 'post_type_metabox',
    'title'     => esc_html__('Post Custom Options', 'elston'),
    'post_type' => array('post'),
    'context'   => 'normal',
    'priority'  => 'default',
    'sections'  => array(

      // Content Section
      array(
        'name'  => 'page_content_options',
        'title' => esc_html__('Content Options', 'elston'),
        'icon'  => 'fa fa-file',

        'fields' => array(

          array(
            'id'        => 'post_featured_image',
            'type'      => 'select',
            'title'     => esc_html__('Featured Image - Single Post', 'elston'),
            'options'   => array(
              'featured-image' => esc_html__('Featured Image', 'elston'),
              'modern-featured-image' => esc_html__('Modern Featured Image', 'elston')
            ),
            'desc' => esc_html__('Which featured image you want to show in single post page?', 'elston'),
          ),
          array(
            'id'        => 'content_spacings',
            'type'      => 'select',
            'title'     => esc_html__('Content Area Spacings', 'elston'),
            'options'   => array(
              'padding-none' => esc_html__('Default Spacing', 'elston'),
              'padding-custom' => esc_html__('Custom Padding', 'elston')
            ),
            'desc' => esc_html__('Content area top and bottom spacings.', 'elston'),
          ),
          array(
            'id'    => 'content_top_spacings',
            'type'  => 'text',
            'title' => esc_html__('Top Spacing', 'elston'),
            'attributes'  => array( 'placeholder' => '100px' ),
            'dependency'  => array('content_spacings', '==', 'padding-custom'),
          ),
          array(
            'id'    => 'content_bottom_spacings',
            'type'  => 'text',
            'title' => esc_html__('Bottom Spacing', 'elston'),
            'attributes'  => array( 'placeholder' => '100px' ),
            'dependency'  => array('content_spacings', '==', 'padding-custom'),
          ),
          array(
            'id'             => 'choose_menu',
            'type'           => 'select',
            'title'          => esc_html__('Choose Menu', 'elston'),
            'desc'          => esc_html__('Choose custom menus for this page.', 'elston'),
            'options'        => 'menus',
            'default_option' => esc_html__('Select your menu', 'elston'),
          ),

        ), // End Fields
      ), // Content Section

      // Enable & Disable
      array(
        'name'  => 'hide_show_section',
        'title' => esc_html__('Enable & Disable', 'elston'),
        'icon'  => 'fa fa-toggle-on',
        'fields' => array(
          array(
            'id'    => 'hide_featured_image',
            'type'  => 'switcher',
            'title' => esc_html__('Hide Featured Image', 'elston'),
            'label' => esc_html__('Yes, Please do it.', 'elston'),
          ),
          array(
            'id'    => 'hide_footer',
            'type'  => 'switcher',
            'title' => esc_html__('Hide Footer', 'elston'),
            'label' => esc_html__('Yes, Please do it.', 'elston'),
          ),

        ),
      ),
      // Enable & Disable

    ),
  );

  // -----------------------------------------
  // Post Metabox Options                    -
  // -----------------------------------------
  $options[]    = array(
    'id'        => 'modern_featured_image',
    'title'     => esc_html__('Modern Featured Image', 'elston'),
    'post_type' => array('post'),
    'context'   => 'side',
    'priority'  => 'default',
    'sections'  => array(
      array(
        'name'   => 'featured_image_modern',
        'fields' => array(

          array(
            'id'    => 'modern_image',
            'type'  => 'image',
            'title' => '',
            'info' => esc_html__('This featured image is applicable for Blog Style as Modern.', 'elston'),
          ),

        ),
      ),
    ),
  );

  // -----------------------------------------
  // Post, Page Metabox Options              -
  // -----------------------------------------
  $options[]    = array(
    'id'        => 'page_type_metabox',
    'title'     => esc_html__('Page Custom Options', 'elston'),
    'post_type' => array('page', 'product'),
    'context'   => 'normal',
    'priority'  => 'default',
    'sections'  => array(

      // Title Area
      array(
        'name'  => 'banner_title_section',
        'title' => esc_html__('Title Area', 'elston'),
        'icon'  => 'fa fa-bullhorn',
        'fields' => array(

          array(
            'id'        => 'banner_type',
            'type'      => 'select',
            'title'     => esc_html__('Choose Banner Type', 'elston'),
            'options'   => array(
              'default-title'    => 'Default Title',
              'hide-title-area'   => 'Hide Title Area',
            ),
            'default'      => 'hide-title-area',
          ),
          array(
            'id'    => 'page_custom_title',
            'type'  => 'text',
            'title' => esc_html__('Custom Title', 'elston'),
            'attributes' => array(
              'placeholder' => esc_html__('Enter your custom title...', 'elston'),
            ),
            'dependency'   => array('banner_type', '==', 'default-title'),
          ),
          array(
            'id'    => 'page_custom_subtitle',
            'type'  => 'text',
            'title' => esc_html__('Custom Sub Title', 'elston'),
            'attributes' => array(
              'placeholder' => esc_html__('Enter your custom sub title...', 'elston'),
            ),
            'dependency'   => array('banner_type', '==', 'default-title'),
          ),
          array(
            'id'             => 'choose_menu',
            'type'           => 'select',
            'title'          => esc_html__('Choose Menu', 'elston'),
            'desc'          => esc_html__('Choose custom menus for this page.', 'elston'),
            'options'        => 'menus',
            'default_option' => esc_html__('Select your menu', 'elston'),
          ),

        ),
      ),
      // Banner & Title Area

      // Content Section
      array(
        'name'  => 'page_content_options',
        'title' => esc_html__('Content Options', 'elston'),
        'icon'  => 'fa fa-file',

        'fields' => array(

          array(
            'id'        => 'content_spacings',
            'type'      => 'select',
            'title'     => esc_html__('Content Area Spacings', 'elston'),
            'options'   => array(
              'padding-none' => esc_html__('Default Spacing', 'elston'),
              'padding-custom' => esc_html__('Custom Padding', 'elston')
            ),
            'desc' => esc_html__('Content area top and bottom spacings.', 'elston'),
          ),
          array(
            'id'    => 'content_top_spacings',
            'type'  => 'text',
            'title' => esc_html__('Top Spacing', 'elston'),
            'attributes'  => array( 'placeholder' => '100px' ),
            'dependency'  => array('content_spacings', '==', 'padding-custom'),
          ),
          array(
            'id'    => 'content_bottom_spacings',
            'type'  => 'text',
            'title' => esc_html__('Bottom Spacing', 'elston'),
            'attributes'  => array( 'placeholder' => '100px' ),
            'dependency'  => array('content_spacings', '==', 'padding-custom'),
          ),

        ), // End Fields
      ), // Content Section

      // Enable & Disable
      array(
        'name'  => 'hide_show_section',
        'title' => esc_html__('Enable & Disable', 'elston'),
        'icon'  => 'fa fa-toggle-on',
        'fields' => array(
          array(
            'id'    => 'hide_footer',
            'type'  => 'switcher',
            'title' => esc_html__('Hide Footer', 'elston'),
            'label' => esc_html__('Yes, Please do it.', 'elston'),
          ),

        ),
      ),
      // Enable & Disable

    ),
  );

  // -----------------------------------------
  // Portfolio Page Selection
  // -----------------------------------------
  $options[]    = array(
    'id'        => 'portfolio_page_selection_section',
    'title'     => esc_html__('Enable portfolio sorting for this page?', 'elston'),
    'post_type' => 'page',
    'context'   => 'side',
    'priority'  => 'default',
    'sections'  => array(

      array(
        'name'   => 'portfolio_layout_section',
        'fields' => array(
          array(
            'id'        => 'portfolio_page_selection',
            'type'      => 'switcher',
            'default'    => false
          ),
          array(
            'type'    => 'notice',
            'class'   => 'info',
            'content' => 'Select ON to set this page as portfolio. It will enable the sorting menu instead of category link in the left sidebar area',
          ),
        ),
      ),

    ),
  );

  // -----------------------------------------
  // Page Layout
  // -----------------------------------------
  $options[]    = array(
    'id'        => 'page_layout_options',
    'title'     => esc_html__('Page Layout', 'elston'),
    'post_type' => 'page',
    'context'   => 'side',
    'priority'  => 'default',
    'sections'  => array(

      array(
        'name'   => 'page_layout_section',
        'fields' => array(

          array(
            'id'        => 'page_layout',
            'type'      => 'image_select',
            'options'   => array(
              'container-width'    => ELSTON_CS_IMAGES . '/page-9.png',
              'extra-width'   => ELSTON_CS_IMAGES . '/page-2.png',
            ),
            'default'    => 'container-width',
            'radio'      => true,
            'wrap_class' => 'text-center',
          ),

        ),
      ),

    ),
  );

  // -----------------------------------------
  // Testimonial
  // -----------------------------------------
  $options[]    = array(
    'id'        => 'testimonial_options',
    'title'     => esc_html__('Testimonial Client', 'elston'),
    'post_type' => 'testimonial',
    'context'   => 'side',
    'priority'  => 'default',
    'sections'  => array(

      array(
        'name'   => 'testimonial_option_section',
        'fields' => array(

          array(
            'id'      => 'testi_name',
            'type'    => 'text',
            'title'   => esc_html__('Name', 'elston'),
            'info'    => esc_html__('Enter client name', 'elston'),
          ),
          array(
            'id'      => 'testi_pro',
            'type'    => 'text',
            'title'   => esc_html__('Company Name', 'elston'),
            'info'    => esc_html__('Enter company name', 'elston'),
          ),

        ),
      ),

    ),
  );

  // -----------------------------------------
  // Team
  // -----------------------------------------
  $options[]    = array(
    'id'        => 'team_options',
    'title'     => esc_html__('Team Member Info', 'elston'),
    'post_type' => 'team',
    'context'   => 'normal',
    'priority'  => 'default',
    'sections'  => array(

      array(
        'name'   => 'team_option_section',
        'fields' => array(

          array(
            'id'      => 'team_job_position',
            'type'    => 'text',
            'title'    => esc_html__('Job Position', 'elston'),
            'attributes' => array(
              'placeholder' => esc_html__('Eg : Financial Manager', 'elston'),
            ),
            'info'    => esc_html__('Enter this employee job position, in your company.', 'elston'),
          ),
          array(
            'id'              => 'team_social_profiles',
            'type'            => 'group',
            'title'           => 'Social Profiles',
            'button_title'    => 'Add New',
            'accordion_title' => 'team_social_title',
            'fields'          => array(
              array(
                'id'    => 'team_social_title',
                'type'  => 'text',
                'title' => 'Profile Title',
              ),
              array(
                'id'    => 'team_social_link',
                'type'  => 'text',
                'title' => 'Enter Profile Link',
                'attributes' => array(
                  'placeholder' => esc_html__('http://', 'elston'),
                ),
              ),
            ),
            'default'             => array(
              array(
                'team_social_title'  => esc_html__('Facebook', 'elston'),
                'team_social_link'   => 'http://fb.com',
              ),
              array(
                'team_social_title'  => esc_html__('Twitter', 'elston'),
                'team_social_link'   => 'http://twitter.com',
              ),
            ),
          ),
          array(
            'id'      => 'team_email_link',
            'type'    => 'text',
            'title'    => esc_html__('Email Address', 'elston'),
            'attributes' => array(
              'placeholder' => esc_html__('team@sitename.com', 'elston'),
            ),
            'info'    => esc_html__('Enter email address, leave empty if you don\'t want to show in the page.', 'elston'),
          ),

        ),
      ),

    ),
  );


  // -----------------------------------------
  // Portfolio Metabox                    -
  // -----------------------------------------
  $options[]    = array(
    'id'        => 'portfolio_type_metabox',
    'title'     => esc_html__('Portfolio Custom Options', 'elston'),
    'post_type' => array('portfolio'),
    'context'   => 'normal',
    'priority'  => 'default',
    'sections'  => array(

      // Title Section
      array(
        'name'  => 'portfolio_page_section',
        'title' => esc_html__('Layouts', 'elston'),
        'icon'  => 'fa fa-minus',

        // Fields Start
        'fields' => array(

          array(
            'id'           => 'portfolio_layout_options',
            'type'         => 'image_select',
            'title'        => esc_html__('Select Layouts', 'elston'),
            'options'      => array(
              'default'     => ELSTON_CS_IMAGES .'/page-1.png',
              'sidebar'    => ELSTON_CS_IMAGES .'/page-5.png',
              'slider'      => ELSTON_CS_IMAGES .'/page-6.png',
              'carousel'    => ELSTON_CS_IMAGES .'/page-7.png',
            ),
            'attributes' => array(
              'data-depend-id' => 'portfolio_layout_select',
            ),
            'radio'     => true,
            'default'   => 'default',
          ),
          array(
            'id'          => 'portfolio_slider',
            'type'        => 'gallery',
            'title'       => esc_html__('Portfolio Slider', 'elston'),
            'dependency'  => array('portfolio_layout_select', '==', 'slider'),
          ),
          array(
            'id'          => 'portfolio_carousel',
            'type'        => 'gallery',
            'title'       => esc_html__('Portfolio Carousel', 'elston'),
            'dependency'  => array('portfolio_layout_select', '==', 'carousel'),
          ),
          array(
            'id'    => 'portfolio_sidebar_full',
            'type'  => 'switcher',
            'title' => esc_html__('Container in full width?', 'elston'),
            'label' => esc_html__('Yes, Please do it.', 'elston'),
            'dependency'  => array('portfolio_layout_select', '==', 'sidebar'),
          ),
          array(
            'id'          => 'portfolio_popup',
            'type'        => 'select',
            'title'       => esc_html__('Image Popup/Lightbox Style', 'elston'),
            'options'   => array(
              'popup_default'   => esc_html__('Default Popup', 'elston'),
              'popup_modern'  => esc_html__('Modern Popup', 'elston'),
            ),
            'default'   => 'popup_default',
          ),
          array(
            'id'          => 'portfolio_masonry_wh',
            'type'        => 'select',
            'title'       => esc_html__('Layout Featured Images', 'elston'),
            'options'   => array(
              'default_width'   => esc_html__('Default Width', 'elston'),
              'f_width'  => esc_html__('2x Width', 'elston'),
              'f_height'  => esc_html__('2x Height', 'elston'),
              'wide_layout'  => esc_html__('Wide Layout', 'elston'),
            ),
            'default'   => 'default_width',
            'info' => esc_html__('This option is only for masonary grid portfolio lists. Featured images height and width can be controled', 'elston'),
          ),
          array(
            'id'          => 'portfolio_masonry_image',
            'type'        => 'image',
            'title'       => esc_html__('Upload Masonry Layout Image', 'elston'),
            'info' => esc_html__('2x width => 930x350, 2x height => 465x700, Default => 651x490. Upload more than above sizes.', 'elston'),
            'dependency'  => array('portfolio_masonry_wh', 'any', 'f_width,f_height'),
          ),
          array(
            'id'          => 'portfolio_wide_image',
            'type'        => 'image',
            'title'       => esc_html__('Upload Wide Layout Image', 'elston'),
            'info' => esc_html__('Wide Layout Image Size : 1920x1050. Upload more than above sizes.', 'elston'),
            'dependency'  => array('portfolio_masonry_wh', '==', 'wide_layout'),
          ),
          array(
            'id'          => 'choose_banner_image',
            'type'        => 'select',
            'title'       => esc_html__('Choose Banner Image', 'elston'),
            'options'   => array(
              'default_image'   => esc_html__('Default Featuread Image', 'elston'),
              'masonry_image'  => esc_html__('Masonry Image', 'elston'),
              'wide_image'  => esc_html__('Wide Image', 'elston'),
            ),
            'info' => esc_html__('You can choose banner image as above formats', 'elston'),
          ),
          array(
            'id'             => 'choose_menu',
            'type'           => 'select',
            'title'          => esc_html__('Choose Menu', 'elston'),
            'info'          => esc_html__('Choose custom menus for this page.', 'elston'),
            'options'        => 'menus',
            'default_option' => esc_html__('Select your menu', 'elston'),
          ),

        ), // End : Fields

      ), // Title Section

      // Content Section
      array(
        'name'  => 'portfolio_content_options',
        'title' => esc_html__('Content Options', 'elston'),
        'icon'  => 'fa fa-file',

        'fields' => array(

          array(
            'id'        => 'content_spacings',
            'type'      => 'select',
            'title'     => esc_html__('Content Spacings', 'elston'),
            'options'   => array(
              'padding-default'   => esc_html__('Default Spacing', 'elston'),
              'padding-standard'  => esc_html__('Standard Padding', 'elston'),
              'padding-modern'    => esc_html__('Modern Padding', 'elston'),
              'padding-narrow'    => esc_html__('Narrow Padding', 'elston'),
            ),
            'desc' => esc_html__('Content area top and bottom spacings.', 'elston'),
            'default'   => 'padding-default',
          ),
          array(
            'id'    => 'content_top_spacings',
            'type'  => 'text',
            'title' => esc_html__('Top Spacing', 'elston'),
            'attributes'  => array( 'placeholder' => '100px' ),
            'dependency'  => array('content_spacings', '==', 'padding-custom'),
          ),
          array(
            'id'    => 'portfolio_wide_color',
            'type'  => 'color_picker',
            'title' => esc_html__('Heading Color (Optional)', 'elston'),
            'desc' => esc_html__('Applicable for portfolio wide style. Heading color can be modified according to background image', 'elston'),
          ),
          array(
            'id'    => 'portfolio_wide_nav_color',
            'type'  => 'color_picker',
            'title' => esc_html__('Navigation Dot Color', 'elston'),
            'desc' => esc_html__('Pick navigation dot color for this portfolio section particularly. Applicable for portfolio wide style.', 'elston'),
          ),

        ), // End Fields
      ), // Content Section

      // Enable & Disable
      array(
        'name'  => 'hide_show_section',
        'title' => esc_html__('Enable & Disable', 'elston'),
        'icon'  => 'fa fa-toggle-on',
        'fields' => array(

          array(
            'id'    => 'hide_featured_image',
            'type'  => 'switcher',
            'title' => esc_html__('Hide Featured Image', 'elston'),
            'label' => esc_html__('Yes, Please do it.', 'elston'),
          ),
          array(
            'id'    => 'hide_navigation',
            'type'  => 'switcher',
            'title' => esc_html__('Hide Navigation', 'elston'),
            'label' => esc_html__('Yes, Please do it.', 'elston'),
          ),
          array(
            'id'    => 'hide_footer',
            'type'  => 'switcher',
            'title' => esc_html__('Hide Footer', 'elston'),
            'label' => esc_html__('Yes, Please do it.', 'elston'),
          ),

        ),
      ),
      // Enable & Disable

    ),
  );

  return $options;

}
add_filter( 'cs_metabox_options', 'elston_metabox_options' );
