<?php
/*
 * All Theme Options for Elston theme.
 * Author & Copyright: VictorThemes
 * URL: https://victorthemes.com
 */

function elston_vt_settings( $settings ) {

  $settings           = array(
    'menu_title'      => ELSTON_NAME . esc_html__(' Options', 'elston'),
    'menu_slug'       => sanitize_title(ELSTON_NAME) . '_options',
    'menu_type'       => 'menu',
    'menu_icon'       => 'dashicons-awards',
    'menu_position'   => '4',
    'ajax_save'       => false,
    'show_reset_all'  => true,
    'framework_title' => ELSTON_NAME .' <small>V-'. ELSTON_VERSION .' by <a href="'. ELSTON_BRAND_URL .'" target="_blank">'. ELSTON_BRAND_NAME .'</a></small>',
  );

  return $settings;

}
add_filter( 'cs_framework_settings', 'elston_vt_settings' );

// Theme Framework Options
function elston_framework_options( $options ) {

  $options      = array(); // remove old options

  // ------------------------------
  // Theme Brand
  // ------------------------------
  $options[]   = array(
    'name'     => 'theme_brand',
    'title'    => esc_html__('Brand', 'elston'),
    'icon'     => 'fa fa-bookmark',
    'sections' => array(

      // brand logo tab
      array(
        'name'     => 'brand_logo_title',
        'title'    => esc_html__('Logo', 'elston'),
        'icon'     => 'fa fa-star',
        'fields'   => array(

          // Site Logo
          array(
            'type'    => 'notice',
            'class'   => 'info cs-vt-heading',
            'content' => esc_html__('Site Logo', 'elston')
          ),
          array(
            'id'    => 'brand_logo_default',
            'type'  => 'image',
            'title' => esc_html__('Default Logo', 'elston'),
            'info'  => esc_html__('Upload your default logo here. If you not upload, then site title will load in this logo location.', 'elston'),
            'add_title' => esc_html__('Add Logo', 'elston'),
          ),
          array(
            'id'    => 'brand_logo_retina',
            'type'  => 'image',
            'title' => esc_html__('Retina Logo', 'elston'),
            'info'  => esc_html__('Upload your retina logo here. Recommended size is 2x from default logo.', 'elston'),
            'add_title' => esc_html__('Add Retina Logo', 'elston'),
          ),
          array(
            'id'          => 'retina_width',
            'type'        => 'text',
            'title'       => esc_html__('Retina & Normal Logo Width', 'elston'),
            'unit'        => 'px',
          ),
          array(
            'id'          => 'retina_height',
            'type'        => 'text',
            'title'       => esc_html__('Retina & Normal Logo Height', 'elston'),
            'unit'        => 'px',
          ),
          array(
            'id'          => 'brand_logo_top',
            'type'        => 'number',
            'title'       => esc_html__('Logo Top Space', 'elston'),
            'attributes'  => array( 'placeholder' => 5 ),
            'unit'        => 'px',
          ),
          array(
            'id'          => 'brand_logo_bottom',
            'type'        => 'number',
            'title'       => esc_html__('Logo Bottom Space', 'elston'),
            'attributes'  => array( 'placeholder' => 5 ),
            'unit'        => 'px',
          ),

          array(
            'type'    => 'notice',
            'class'   => 'info cs-vt-heading',
            'content' => esc_html__('Small Logo / Tiny Sidebar Logo', 'elston')
          ),
          array(
            'id'    => 'brand_logo_default_small',
            'type'  => 'image',
            'title' => esc_html__('Default Small Logo (Show left tiny bar)', 'elston'),
            'info'  => esc_html__('Upload your default small logo here. Recommended size is 150x150.', 'elston'),
            'add_title' => esc_html__('Add Small Logo', 'elston'),
          ),

          // WordPress Admin Logo
          array(
            'type'    => 'notice',
            'class'   => 'info cs-vt-heading',
            'content' => esc_html__('WordPress Admin Logo', 'elston')
          ),
          array(
            'id'    => 'brand_logo_wp',
            'type'  => 'image',
            'title' => esc_html__('Login logo', 'elston'),
            'info'  => esc_html__('Upload your WordPress login page logo here.', 'elston'),
            'add_title' => esc_html__('Add Login Logo', 'elston'),
          ),
        ) // end: fields
      ), // end: section

      // Fav
      array(
        'name'     => 'brand_fav',
        'title'    => esc_html__('Fav Icon', 'elston'),
        'icon'     => 'fa fa-anchor',
        'fields'   => array(

            // -----------------------------
            // Begin: Fav
            // -----------------------------
            array(
              'id'    => 'brand_fav_icon',
              'type'  => 'image',
              'title' => esc_html__('Fav Icon', 'elston'),
              'info'  => esc_html__('Upload your site fav icon, size should be 16x16.', 'elston'),
              'add_title' => esc_html__('Add Fav Icon', 'elston'),
            ),
            array(
              'id'    => 'iphone_icon',
              'type'  => 'image',
              'title' => esc_html__('Apple iPhone icon', 'elston'),
              'info'  => esc_html__('Icon for Apple iPhone (57px x 57px). This icon is used for Bookmark on Home screen.', 'elston'),
              'add_title' => esc_html__('Add iPhone Icon', 'elston'),
            ),
            array(
              'id'    => 'iphone_retina_icon',
              'type'  => 'image',
              'title' => esc_html__('Apple iPhone retina icon', 'elston'),
              'info'  => esc_html__('Icon for Apple iPhone retina (114px x114px). This icon is used for Bookmark on Home screen.', 'elston'),
              'add_title' => esc_html__('Add iPhone Retina Icon', 'elston'),
            ),
            array(
              'id'    => 'ipad_icon',
              'type'  => 'image',
              'title' => esc_html__('Apple iPad icon', 'elston'),
              'info'  => esc_html__('Icon for Apple iPad (72px x 72px). This icon is used for Bookmark on Home screen.', 'elston'),
              'add_title' => esc_html__('Add iPad Icon', 'elston'),
            ),
            array(
              'id'    => 'ipad_retina_icon',
              'type'  => 'image',
              'title' => esc_html__('Apple iPad retina icon', 'elston'),
              'info'  => esc_html__('Icon for Apple iPad retina (144px x 144px). This icon is used for Bookmark on Home screen.', 'elston'),
              'add_title' => esc_html__('Add iPad Retina Icon', 'elston'),
            ),

        ) // end: fields
      ), // end: section

    ),
  );

  // ------------------------------
  // Layout
  // ------------------------------
  $options[] = array(
    'name'   => 'theme_layout',
    'title'  => esc_html__('Layout', 'elston'),
    'icon'   => 'fa fa-file-text'
  );

  $options[]      = array(
    'name'        => 'theme_general',
    'title'       => esc_html__('General', 'elston'),
    'icon'        => 'fa fa-wrench',

    // begin: fields
    'fields'      => array(

      // -----------------------------
      // Begin: Responsive
      // -----------------------------
      array(
        'id'    => 'theme_responsive',
        'type'  => 'switcher',
        'title' => esc_html__('Responsive', 'elston'),
        'info' => esc_html__('Turn off if you don\'t want your site to be responsive.', 'elston'),
        'default' => true,
      ),
      array(
        'id'    => 'theme_page_comments',
        'type'  => 'switcher',
        'title' => esc_html__('Page Comments', 'elston'),
        'info' => esc_html__('Turn On if you want to show comments in your pages.', 'elston'),
        'default' => true,
      ),

      array(
        'type'    => 'notice',
        'class'   => 'info cs-vt-heading',
        'content' => esc_html__('Background Options', 'elston'),
        'dependency' => array( 'theme_layout_width_container', '==', 'true' ),
      ),
      array(
        'id'             => 'theme_layout_bg_type',
        'type'           => 'select',
        'title'          => esc_html__('Background Type', 'elston'),
        'options'        => array(
          'bg-image' => esc_html__('Image', 'elston'),
          'bg-pattern' => esc_html__('Pattern', 'elston'),
        ),
        'dependency' => array( 'theme_layout_width_container', '==', 'true' ),
      ),
      array(
        'id'    => 'theme_layout_bg_pattern',
        'type'  => 'image_select',
        'title' => esc_html__('Background Pattern', 'elston'),
        'info' => esc_html__('Select background pattern', 'elston'),
        'options'      => array(
          'pattern-1'    => ELSTON_CS_IMAGES . '/pattern-1.png',
          'pattern-2'    => ELSTON_CS_IMAGES . '/pattern-2.png',
          'pattern-3'    => ELSTON_CS_IMAGES . '/pattern-3.png',
          'pattern-4'    => ELSTON_CS_IMAGES . '/pattern-4.png',
          'custom-pattern'  => ELSTON_CS_IMAGES . '/pattern-5.png',
        ),
        'default'      => 'pattern-1',
        'radio'      => true,
        'dependency' => array( 'theme_layout_width_container|theme_layout_bg_type', '==|==', 'true|bg-pattern' ),
      ),
      array(
        'id'      => 'custom_bg_pattern',
        'type'    => 'upload',
        'title'   => esc_html__('Custom Pattern', 'elston'),
        'dependency' => array( 'theme_layout_width_container|theme_layout_bg_type|theme_layout_bg_pattern_custom-pattern', '==|==|==', 'true|bg-pattern|true' ),
        'info' => __('Select your custom background pattern. <br />Note, background pattern image will be repeat in all x and y axis. So, please consider all repeatable area will perfectly fit your custom patterns.', 'elston'),
      ),
      array(
        'id'      => 'theme_layout_bg',
        'type'    => 'background',
        'title'   => esc_html__('Background', 'elston'),
        'dependency' => array( 'theme_layout_width_container|theme_layout_bg_type', '==|==', 'true|bg-image' ),
      ),
      array(
        'id'      => 'theme_bg_parallax',
        'type'    => 'switcher',
        'title'   => esc_html__('Parallax', 'elston'),
        'dependency' => array( 'theme_layout_width_container', '==', 'true' ),
      ),
      array(
        'id'      => 'theme_bg_parallax_speed',
        'type'    => 'text',
        'title'   => esc_html__('Parallax Speed', 'elston'),
        'attributes' => array(
          'placeholder'     => '0.4',
        ),
        'dependency' => array( 'theme_layout_width_container|theme_bg_parallax', '==|!=', 'true' ),
      ),
      array(
        'id'      => 'theme_bg_overlay_color',
        'type'    => 'color_picker',
        'title'   => esc_html__('Overlay Color', 'elston'),
        'dependency' => array( 'theme_layout_width_container', '==', 'true' ),
      ),

    ), // end: fields

  );

  // ------------------------------
  // Slidebar Sections
  // ------------------------------
  $options[]   = array(
    'name'     => 'theme_slidebar_tab',
    'title'    => esc_html__('Sidebar', 'elston'),
    'icon'     => 'fa fa-bars',
    'sections' => array(

      // Slidebar design tab
      array(
        'name'     => 'siderbar_menu_tab',
        'title'    => esc_html__('Basic', 'elston'),
        'icon'     => 'fa fa-magic',
        'fields'   => array(

          // Slidebar style select
          array(
            'id'           => 'select_sidebar_design',
            'type'         => 'radio',
            'title'        => esc_html__('Select sidebar style', 'elston'),
            'options'      => array(
              'hover'      => 'Hoverable, Appear on mouse rollover',
              'click'      => 'Clickable, Appear on mouse click',
            ),
            'default'   => 'hover',
            'info' => esc_html__('Select your slidebar design, following options will may differ based on your selection of sidebar hoverable or clickable.', 'elston'),
          ),
          array(
            'id'           => 'sidebar_portfolio',
            'type'         => 'switcher',
            'title'        => esc_html__('Enable Portfolio Icon/Button', 'elston'),
            'default'   => true,
          ),
          array(
            'id'           => 'sidebar_search',
            'type'         => 'switcher',
            'title'        => esc_html__('Enable Search Icon/Button', 'elston'),
            'default'   => true,
          ),
          array(
            'id'           => 'sidebar_search_text',
            'type'         => 'text',
            'title'        => esc_html__('Search text', 'elston'),
            'default'      => 'SEARCH AND PRESS ENTER',
            'dependency'   => array( 'sidebar_search', '==', 'true' ),
            'info'         => 'Will show after the search input box',
          ),
        )
      ),
      array(
        'name'     => 'sliderbar_contact_info_tab',
        'title'    => esc_html__('Contact Info', 'elston'),
        'icon'     => 'fa fa-envelope',
        'fields'   => array(

          // Slidebar style select
          array(
            'id'            => 'contact_info',
            'type'          => 'switcher',
            'title'         => esc_html__('Enable contact information section', 'elston'),
            'default'       => true,
            'info'          => esc_html__('Visible or not the contact information in sidebar bottom.', 'elston'),
          ),
          array(
            'id'            => 'show_social_info',
            'type'          => 'switcher',
            'title'         => esc_html__('Show social icons', 'elston'),
            'default'       => true,
            'info'          => esc_html__('Visible or not the social icons.', 'elston'),
            'dependency'      => array( 'contact_info', '==', 'true' ),
          ),
          array(
            'id'              => 'social_info',
            'type'            => 'group',
            'title'           => esc_html__('Set social icons and links', 'elston'),
            'info'            => esc_html__('Add social icons and links form here.', 'elston'),
            'button_title'    => 'Add New',
            'accordion_title' => 'Social icons and links',
            'dependency'      => array( 'show_social_info|contact_info', '==|==', 'true|true' ),
            'fields'          => array(

              array(
                'id'          => 'social_icon',
                'type'        => 'icon',
                'title'       => esc_html__('Social icons', 'elston')
              ),

              array(
                'id'          => 'social_link',
                'type'        => 'text',
                'title'       => esc_html__('Social link/url', 'elston'),
                'default'     => 'http://'
              )

            )
          ),
          array(
            'id'            => 'social_info_link_target',
            'type'          => 'switcher',
            'title'         => esc_html__('Social link open it a new tab', 'elston'),
            'default'       => true,
            'info'          => esc_html__('After clicking on a social icon the link will open it a new tab in browser.', 'elston'),
            'dependency'    => array( 'show_social_info|contact_info', '==|==', 'true|true' ),
          ),
          array(
            'id'            => 'sidebar_email_address',
            'type'          => 'textarea',
            'title'         => esc_html__('Email Address (Use shortcode)', 'elston'),
            'shortcode'     => true,
            'info'          => '',
            'after'         => 'Helpful shortcodes: [elston_email before_text="E" email="info@victorthemes.com" email_link="info@victorthemes.com"]',
          ),
          array(
            'id'            => 'sidebar_phone_no',
            'type'          => 'textarea',
            'title'         => esc_html__('Phone no (Use shortcode)', 'elston'),
            'shortcode'     => true,
            'after'         => 'Helpful shortcodes: [elston_phone before_text="P" phone="+(323)432 56 3423" phone_link="+323432563423"]',
          ),
        )
      ),
    )
  );

  // ------------------------------
  // Footer Section
  // ------------------------------
  $options[]   = array(
    'name'     => 'footer_section',
    'title'    => esc_html__('Footer', 'elston'),
    'icon'     => 'fa fa-ellipsis-h',
    'fields' => array(
      // Copyright
      array(
        'type'    => 'notice',
        'class'   => 'info cs-vt-heading',
        'content' => esc_html__('Copyright Layout', 'elston'),
      ),
      array(
        'id'    => 'need_copyright',
        'type'  => 'switcher',
        'title' => esc_html__('Enable Copyright Section', 'elston'),
        'default' => true,
      ),
      array(
        'id'    => 'copyright_text',
        'type'  => 'textarea',
        'title' => esc_html__('Copyright Text', 'elston'),
        'shortcode' => true,
        'dependency' => array('need_copyright', '==', true),
        'after'       => 'Helpful shortcodes: [elston_current_year] [elston_home_url] or any shortcode.',
      ),

      // Copyright Another Text
      array(
        'type'    => 'notice',
        'class'   => 'warning cs-vt-heading',
        'content' => esc_html__('Copyright Secondary Text', 'elston'),
        'dependency'     => array('need_copyright', '==', true),
      ),
      array(
        'id'    => 'secondary_text',
        'type'  => 'textarea',
        'title' => esc_html__('Secondary Text', 'elston'),
        'shortcode' => true,
        'dependency' => array('need_copyright', '==', 'true'),
        'after'       => 'Helpful shortcodes: [elston_current_year] [elston_home_url] or any shortcode.',
      ),

    )

  );

  // ------------------------------
  // Design
  // ------------------------------
  $options[] = array(
    'name'   => 'theme_design',
    'title'  => esc_html__('Design', 'elston'),
    'icon'   => 'fa fa-magic'
  );

  // ------------------------------
  // color section
  // ------------------------------
  $options[]   = array(
    'name'     => 'theme_color_section',
    'title'    => esc_html__('Colors', 'elston'),
    'icon'     => 'fa fa-eyedropper',
    'fields' => array(

      array(
        'type'    => 'heading',
        'content' => esc_html__('Color Options', 'elston'),
      ),
      array(
        'type'    => 'subheading',
        'wrap_class' => 'color-tab-content',
        'content' => __('All color options are available in our theme customizer. The reason of we used customizer options for color section is because, you can choose each part of color from there and see the changes instantly using customizer.
          <br /><br />Highly customizable colors are in <strong>Appearance > Customize</strong>', 'elston'),
      ),

    ),
  );

  // ------------------------------
  // Typography section
  // ------------------------------
  $options[]   = array(
    'name'     => 'theme_typo_section',
    'title'    => esc_html__('Typography', 'elston'),
    'icon'     => 'fa fa-header',
    'fields' => array(

      // Start fields
      array(
        'id'                  => 'typography',
        'type'                => 'group',
        'fields'              => array(
          array(
            'id'              => 'title',
            'type'            => 'text',
            'title'           => esc_html__('Title', 'elston'),
          ),
          array(
            'id'              => 'selector',
            'type'            => 'textarea',
            'title'           => esc_html__('Selector', 'elston'),
            'info'           => __('Enter css selectors like : <strong>body, .custom-class</strong>', 'elston'),
          ),
          array(
            'id'              => 'font',
            'type'            => 'typography',
            'title'           => esc_html__('Font Family', 'elston'),
          ),
          array(
            'id'              => 'size',
            'type'            => 'text',
            'title'           => esc_html__('Font Size', 'elston'),
          ),
          array(
            'id'              => 'line_height',
            'type'            => 'text',
            'title'           => esc_html__('Line-Height', 'elston'),
          ),
          array(
            'id'              => 'css',
            'type'            => 'textarea',
            'title'           => esc_html__('Custom CSS', 'elston'),
          ),
        ),
        'button_title'        => esc_html__('Add New Typography', 'elston'),
        'accordion_title'     => esc_html__('New Typography', 'elston'),
        'default'             => array(
          array(
            'title'           => esc_html__('Body Typography', 'elston'),
            'selector'        => 'body, .details-wrapper p, .deatil-item p, .elstn-portfolio-detail .elstn-testimonials .testimonial-owner, .elstn-portfolio-detail.spacer2 .elstn-detail-wrap p, .elstn-portfolio-detail.version2 .elstn-detail-container p, .elstn-detail-wrap p, .elstn-detail-wrap p a, .target-info p, .elstn-detail-container.version2 p, .elstn-top-title p, .contact-list p, .elstn-btn, input[type="submit"], input[type="text"], input[type="email"], input[type="tel"], input[type="search"], input[type="date"], input[type="time"], input[type="datetime-local"], input[type="month"], input[type="url"], input[type="number"], textarea, select, .form-control, p, .service-info p',
            'font'            => array(
              'family'        => 'Poppins',
              'variant'       => '500',
              'font'          => 'google',
            ),
            'size'            => '14px',
            'line_height'     => '1.42857143',
          ),
          array(
            'title'           => esc_html__('Menu Typography', 'elston'),
            'selector'        => 'nav',
            'font'            => array(
              'family'        => 'Poppins',
              'variant'       => '500',
            ),
            'size'            => '12px',
            'line_height'     => '24px',
          ),
          array(
            'title'           => esc_html__('Sub Menu Typography', 'elston'),
            'selector'        => 'nav ul li.sub-menu-item ul.sub-menu',
            'font'            => array(
              'family'        => 'Poppins',
              'variant'       => '500',
            ),
            'size'            => '13px',
          ),
          array(
            'title'           => esc_html__('Headings Typography', 'elston'),
            'selector'        => 'h1, h2, h3, h4, h5, h6,.elstn-services.version2 .service-info h4,.elstn-blog-detail h4.poppins-font,.elstn-blog-detail h4,.elstn-detail-container .elstn-heading-wrap .elstn-sub-heading, .portfolio-title, .deatil-item h4, .elstn-portfolio-detail .elstn-testimonials p',
            'font'            => array(
              'family'        => 'Poppins',
              'variant'       => '700',
            ),
          ),
          array(
            'title'           => esc_html__('Post Typography', 'elston'),
            'selector'        => '.content-inner, .elstn-top-banner .banner-caption h4, .elstn-blog-detail p, .content-inner h5, .content-inner h6,.content-inner ul li, .content-inner ol li',
            'font'            => array(
              'family'        => 'Raleway',
              'variant'       => 'regular',
            ),
          ),
          array(
            'title'           => esc_html__('Post Meta Typography', 'elston'),
            'selector'        => '.blog-date, .elstn-testimonials p, .service-info h4,.elstn-about-wrap p,.mate-name .clearfix,.service-info h4,.testimonial-owner span,.elstn-top-title h1,.elstn-detail-wrap .elstn-heading-wrap span,.elstn-detail-container.version2 ul li,.portfolio-caption a,.elstn-masonry .item .item-info h6,.banner-caption a,.elstn-top-banner .banner-caption h1',
            'font'            => array(
              'family'        => 'Merriweather',
              'variant'       => 'regular',
            ),
          ),
          array(
            'title'           => esc_html__('Blockquote Typography', 'elston'),
            'selector'        => '.content-inner blockquote, blockquote, .elstn-heading-wrap span, .about-text h4',
            'font'            => array(
              'family'        => 'Lora',
              'variant'       => 'regular',
            ),
          ),
          array(
            'title'           => esc_html__('Example Usage', 'elston'),
            'selector'        => '.your-custom-class',
            'font'            => array(
              'family'        => 'Raleway',
              'variant'       => 'regular',
            ),
          ),
        ),
      ),

      // Subset
      array(
        'id'                  => 'subsets',
        'type'                => 'select',
        'title'               => esc_html__('Subsets', 'elston'),
        'class'               => 'chosen',
        'options'             => array(
          'latin'             => 'latin',
          'latin-ext'         => 'latin-ext',
          'cyrillic'          => 'cyrillic',
          'cyrillic-ext'      => 'cyrillic-ext',
          'greek'             => 'greek',
          'greek-ext'         => 'greek-ext',
          'vietnamese'        => 'vietnamese',
          'devanagari'        => 'devanagari',
          'khmer'             => 'khmer',
        ),
        'attributes'         => array(
          'data-placeholder' => 'Subsets',
          'multiple'         => 'multiple',
          'style'            => 'width: 200px;'
        ),
        'default'             => array( 'latin' ),
      ),

      array(
        'id'                  => 'font_weight',
        'type'                => 'select',
        'title'               => esc_html__('Font Weights', 'elston'),
        'class'               => 'chosen',
        'options'             => array(
          '100'   => 'Thin 100',
          '100i'  => 'Thin 100 Italic',
          '200'   => 'Extra Light 200',
          '200i'  => 'Extra Light 200 Italic',
          '300'   => 'Light 300',
          '300i'  => 'Light 300 Italic',
          '400'   => 'Regular 400',
          '400i'  => 'Regular 400 Italic',
          '500'   => 'Medium 500',
          '500i'  => 'Medium 500 Italic',
          '600'   => 'Semi Bold 600',
          '600i'  => 'Semi Bold 600 Italic',
          '700'   => 'Bold 700',
          '700i'  => 'Bold 700 Italic',
          '800'   => 'Extra Bold 800',
          '800i'  => 'Extra Bold 800 Italic',
          '900'   => 'Black 900',
          '900i'  => 'Black 900 Italic',
        ),
        'attributes'         => array(
          'data-placeholder' => 'Font Weight',
          'multiple'         => 'multiple',
          'style'            => 'width: 200px;'
        ),
        'default'             => array( '300','400','500','600','700' ),
      ),

      // Custom Fonts Upload
      array(
        'id'                 => 'font_family',
        'type'               => 'group',
        'title'              => 'Upload Custom Fonts',
        'button_title'       => 'Add New Custom Font',
        'accordion_title'    => 'Adding New Font',
        'accordion'          => true,
        'desc'               => 'It is simple. Only add your custom fonts and click to save. After you can check "Font Family" selector. Do not forget to Save!',
        'fields'             => array(

          array(
            'id'             => 'name',
            'type'           => 'text',
            'title'          => 'Font-Family Name',
            'attributes'     => array(
              'placeholder'  => 'for eg. Arial'
            ),
          ),

          array(
            'id'             => 'ttf',
            'type'           => 'upload',
            'title'          => 'Upload .ttf <small><i>(optional)</i></small>',
            'settings'       => array(
              'upload_type'  => 'font',
              'insert_title' => 'Use this Font-Format',
              'button_title' => 'Upload <i>.ttf</i>',
            ),
          ),

          array(
            'id'             => 'eot',
            'type'           => 'upload',
            'title'          => 'Upload .eot <small><i>(optional)</i></small>',
            'settings'       => array(
              'upload_type'  => 'font',
              'insert_title' => 'Use this Font-Format',
              'button_title' => 'Upload <i>.eot</i>',
            ),
          ),

          array(
            'id'             => 'svg',
            'type'           => 'upload',
            'title'          => 'Upload .svg <small><i>(optional)</i></small>',
            'settings'       => array(
              'upload_type'  => 'font',
              'insert_title' => 'Use this Font-Format',
              'button_title' => 'Upload <i>.svg</i>',
            ),
          ),

          array(
            'id'             => 'otf',
            'type'           => 'upload',
            'title'          => 'Upload .otf <small><i>(optional)</i></small>',
            'settings'       => array(
              'upload_type'  => 'font',
              'insert_title' => 'Use this Font-Format',
              'button_title' => 'Upload <i>.otf</i>',
            ),
          ),

          array(
            'id'             => 'woff',
            'type'           => 'upload',
            'title'          => 'Upload .woff <small><i>(optional)</i></small>',
            'settings'       => array(
              'upload_type'  => 'font',
              'insert_title' => 'Use this Font-Format',
              'button_title' => 'Upload <i>.woff</i>',
            ),
          ),

          array(
            'id'             => 'css',
            'type'           => 'textarea',
            'title'          => 'Extra CSS Style <small><i>(optional)</i></small>',
            'attributes'     => array(
              'placeholder'  => 'for eg. font-weight: normal;'
            ),
          ),

        ),
      ),
      // End All field

    ),
  );

  // ------------------------------
  // Pages
  // ------------------------------
  $options[] = array(
    'name'   => 'theme_pages',
    'title'  => esc_html__('Pages', 'elston'),
    'icon'   => 'fa fa-files-o'
  );

  // ------------------------------
  // Portfolio Section
  // ------------------------------
  $options[]   = array(
    'name'     => 'portfolio_section',
    'title'    => esc_html__('Portfolio', 'elston'),
    'icon'     => 'fa fa-briefcase',
    'fields' => array(
      // portfolio name change
      array(
        'type'    => 'notice',
        'class'   => 'info cs-vt-heading',
        'content' => esc_html__('Name Change', 'elston')
      ),
      array(
        'id'      => 'theme_portfolio_name',
        'type'    => 'text',
        'title'   => esc_html__('Portfolio Name', 'elston'),
        'attributes'     => array(
          'placeholder'  => 'Portfolio'
        ),
        'default'     => 'Portfolio',
      ),
      array(
        'id'      => 'theme_portfolio_slug',
        'type'    => 'text',
        'title'   => esc_html__('Portfolio Slug', 'elston'),
        'attributes'     => array(
          'placeholder'  => 'portfolio-item'
        ),
        'default'     => 'portfolio-item',
      ),
      array(
        'id'      => 'theme_portfolio_cat_slug',
        'type'    => 'text',
        'title'   => esc_html__('Portfolio Category Slug', 'elston'),
        'attributes'     => array(
          'placeholder'  => 'portfolio-category'
        ),
        'default'     => 'portfolio-category',
      ),
      array(
        'type'    => 'notice',
        'class'   => 'danger',
        'content' => __('<strong>Important</strong>: Please do not set portfolio slug and page slug as same. It\'ll not work.', 'elston')
      ),
      // Portfolio Name

      // portfolio listing
      array(
        'type'    => 'notice',
        'class'   => 'info cs-vt-heading',
        'content' => esc_html__('Portfolio Style', 'elston')
      ),
      array(
        'id'             => 'portfolio_style',
        'type'           => 'select',
        'title'          => esc_html__('Portfolio Style', 'elston'),
        'options'        => array(
          'grid'                          => esc_html__('Grid (Default)', 'elston'),
          'masonry'                       => esc_html__('Grid With Masonry', 'elston'),
          'wide'                          => esc_html__('Wide Full Screen', 'elston'),
        ),
        'default'     => 'grid',
      ),
      array(
        'id'             => 'portfolio_hover_style',
        'type'           => 'select',
        'title'          => esc_html__('Portfolio Hover Style', 'elston'),
        'options'        => array(
          'hover'                         => esc_html__('Regular', 'elston'),
          'direction-hover'               => esc_html__('Direction', 'elston'),
          'direction-hover-inverse'       => esc_html__('Direction Inverse', 'elston'),
          'expand-hover'                  => esc_html__('Expand', 'elston'),
          'replace-hover'                 => esc_html__('Replace', 'elston'),
          'shifting-hover'                => esc_html__('Shifting', 'elston'),
          'sweep-hover'                   => esc_html__('Sweep', 'elston')
        ),
        'default'     => 'hover',
        'dependency'   => array( 'portfolio_style', 'any', 'grid,masonry' ),
      ),
      array(
        'id'             => 'portfolio_col',
        'type'           => 'select',
        'title'          => esc_html__('Portfolio Grid Column', 'elston'),
        'options'        => array(
          'col-item-2'   => esc_html__('Two Column', 'elston'),
          'col-item-3'   => esc_html__('Three Column', 'elston'),
          'col-item-4'   => esc_html__('Four Column', 'elston'),
          'col-item-5'   => esc_html__('Five Column', 'elston'),
        ),
        'default'     => 'col-item-4',
        'dependency'   => array( 'portfolio_style', 'any', 'grid,masonry' ),
      ),
      array(
        'id'      => 'portfolio_wide_style_banner_title',
        'type'    => 'text',
        'title'   => esc_html__('Top Banner Title', 'elston'),
        'default' => 'Hi, Stranger!',
        'dependency'   => array( 'portfolio_style', '==', 'wide' ),
      ),
      array(
        'id'      => 'portfolio_wide_style_banner_subtitle',
        'type'    => 'text',
        'title'   => esc_html__('Top Banner Sub Title', 'elston'),
        'default' => 'we are elston studio.',
        'dependency'   => array( 'portfolio_style', '==', 'wide' ),
      ),
      array(
        'id'      => 'portfolio_wide_style_banner_link',
        'type'    => 'text',
        'title'   => esc_html__('Banner Link', 'elston'),
        'default' => '#',
        'dependency'   => array( 'portfolio_style', '==', 'wide' ),
      ),
      array(
        'id'      => 'portfolio_wide_style_banner_link_text',
        'type'    => 'text',
        'title'   => esc_html__('Banner Link Text', 'elston'),
        'default' => 'View case studies',
      ),
      array(
        'id'      => 'portfolio_wide_style_banner_image',
        'type'    => 'image',
        'title'   => esc_html__('Banner Background Image', 'elston'),
        'info'   => esc_html__('Upload high quality image.', 'elston'),
        'dependency'   => array( 'portfolio_style', '==', 'wide' ),
      ),

      array(
        'type'    => 'notice',
        'class'   => 'info cs-vt-heading',
        'content' => esc_html__('Enable/Disable Options', 'elston')
      ),
      array(
        'id'      => 'portfolio_pagination',
        'type'    => 'switcher',
        'title'   => esc_html__('Pagination', 'elston'),
        'label'   => esc_html__('If you need pagination in portfolio pages, please turn this ON.', 'elston'),
        'default'   => true,
      ),

      array(
        'type'    => 'notice',
        'class'   => 'info cs-vt-heading',
        'content' => esc_html__('Single Portfolio', 'elston')
      ),
      array(
        'id'      => 'portfolio_link',
        'options' => 'pages',
        'type'    => 'select',
        'title'   => esc_html__('Select Portfolio Page', 'elston'),
        'label'   => esc_html__('Portfolio page for grid icon in pagination.', 'elston'),
        'info'   => esc_html__('This link will available at Single Portfolio grid button.', 'elston'),
        'default_option' => 'Select a page'
      ),
      array(
        'id'      => 'portfolio_page_link',
        'type'    => 'switcher',
        'title'   => esc_html__('Next & Prev Navigation', 'elston'),
        'label'   => esc_html__('If you don\'t want next and previous navigation in portfolio single pages, please turn this OFF.', 'elston'),
        'default' => true,
      ),
      // Portfolio Listing

    ),
  );

  // ------------------------------
  // Blog Section
  // ------------------------------
  $options[]   = array(
    'name'     => 'blog_section',
    'title'    => esc_html__('Blog', 'elston'),
    'icon'     => 'fa fa-edit',
    'sections' => array(

      // blog general section
      array(
        'name'     => 'blog_general_tab',
        'title'    => esc_html__('General', 'elston'),
        'icon'     => 'fa fa-cog',
        'fields'   => array(

          // Layout
          array(
            'type'    => 'notice',
            'class'   => 'info cs-vt-heading',
            'content' => esc_html__('Layout', 'elston')
          ),
          array(
            'id'             => 'blog_listing_style',
            'type'           => 'select',
            'title'          => esc_html__('Blog Listing Style', 'elston'),
            'options'        => array(
              'classic' => esc_html__('Grid (Default)', 'elston'),
              'modern' => esc_html__('Modern', 'elston'),
            ),
            'default' => 'classic',
            'help'          => esc_html__('This style will apply, default blog pages - Like : Archive, Category, Tags, Search & Author. If this settings will not apply your blog page, please set that page as a post page in Settings > Readings.', 'elston'),
          ),
          array(
            'id'             => 'pagination_type',
            'type'           => 'select',
            'title'          => esc_html__('Blog Pagination Style', 'elston'),
            'options'        => array(
              'pagenavi'     => esc_html__('Number Pagination (Default)', 'elston'),
              'ajax'         => esc_html__('Ajax Pagination', 'elston'),
            ),
            'default' => 'pagenavi',
          ),

          // Layout
          // Global Options
          array(
            'type'    => 'notice',
            'class'   => 'info cs-vt-heading',
            'content' => esc_html__('Global Options', 'elston')
          ),
          array(
            'id'         => 'theme_exclude_categories',
            'type'       => 'checkbox',
            'title'      => esc_html__('Exclude Categories', 'elston'),
            'info'      => esc_html__('Select categories you want to exclude from blog page.', 'elston'),
            'options'    => 'categories',
          ),
          array(
            'id'      => 'theme_blog_excerpt',
            'type'    => 'text',
            'title'   => esc_html__('Excerpt Length', 'elston'),
            'info'   => esc_html__('Blog short content length, in blog listing pages.', 'elston'),
            'default' => '30',
          ),
          array(
            'id'      => 'theme_metas_hide',
            'type'    => 'checkbox',
            'title'   => esc_html__('Meta\'s to hide', 'elston'),
            'info'    => esc_html__('Check items you want to hide from blog/post meta field.', 'elston'),
            'class'      => 'horizontal',
            'options'    => array(
              'category'   => esc_html__('Category', 'elston'),
              'date'    => esc_html__('Date', 'elston'),
              'author'     => esc_html__('Author', 'elston'),
            ),
            // 'default' => '30',
          ),
          // End fields

        )
      ),

      // blog single section
      array(
        'name'     => 'blog_single_tab',
        'title'    => esc_html__('Single', 'elston'),
        'icon'     => 'fa fa-sticky-note',
        'fields'   => array(

          // Start fields
          array(
            'type'    => 'notice',
            'class'   => 'info cs-vt-heading',
            'content' => esc_html__('Enable / Disable', 'elston')
          ),
          array(
            'id'    => 'single_featured_image',
            'type'  => 'switcher',
            'title' => esc_html__('Featured Image', 'elston'),
            'info' => esc_html__('If need to hide featured image from single blog post page, please turn this OFF.', 'elston'),
            'default' => true,
          ),
          array(
            'id'    => 'single_author_info',
            'type'  => 'switcher',
            'title' => esc_html__('Author Info', 'elston'),
            'info' => esc_html__('If need to hide author info on single blog page, please turn this OFF.', 'elston'),
            'default' => true,
          ),
          array(
            'id'    => 'single_sticky_sidebar',
            'type'  => 'switcher',
            'title' => esc_html__('Sticky Sidebar', 'elston'),
            'info' => esc_html__('If you want to disable sticky sidebar, please turn this OFF.', 'elston'),
            'default' => true,
          ),
          array(
            'id'    => 'single_share_option',
            'type'  => 'switcher',
            'title' => esc_html__('Share Option', 'elston'),
            'info' => esc_html__('If need to hide share option on single blog page, please turn this OFF.', 'elston'),
            'default' => true,
          ),
          array(
            'id'    => 'single_comment_form',
            'type'  => 'switcher',
            'title' => esc_html__('Comment Area/Form', 'elston'),
            'info' => esc_html__('If need to hide comment area and that form on single blog page, please turn this OFF.', 'elston'),
            'default' => true,
          ),
          // End fields

        )
      ),

    ),
  );

  // ------------------------------
  // Extra Pages
  // ------------------------------
  $options[]   = array(
    'name'     => 'theme_extra_pages',
    'title'    => esc_html__('Extra Pages', 'elston'),
    'icon'     => 'fa fa-clone',
    'sections' => array(

      // error 404 page
      array(
        'name'     => 'error_page_section',
        'title'    => esc_html__('404 Page', 'elston'),
        'icon'     => 'fa fa-exclamation-triangle',
        'fields'   => array(

          // Start 404 Page
          array(
            'id'    => 'error_heading',
            'type'  => 'text',
            'title' => esc_html__('404 Page Heading', 'elston'),
            'info'  => esc_html__('Enter 404 page heading.', 'elston'),
          ),
          array(
            'id'    => 'error_page_content',
            'type'  => 'textarea',
            'title' => esc_html__('404 Page Content', 'elston'),
            'info'  => esc_html__('Enter 404 page content.', 'elston'),
            'shortcode' => true,
          ),
          array(
            'id'    => 'error_page_bg',
            'type'  => 'image',
            'title' => esc_html__('404 Page Background', 'elston'),
            'info'  => esc_html__('Choose 404 page background styles.', 'elston'),
            'add_title' => esc_html__('Add 404 Image', 'elston'),
          ),
          array(
            'id'    => 'error_btn_text',
            'type'  => 'text',
            'title' => esc_html__('Button Text', 'elston'),
            'info'  => esc_html__('Enter BACK TO HOME button text. If you want to change it.', 'elston'),
          ),
          // End 404 Page

        ) // end: fields
      ), // end: fields section

      // maintenance mode page
      array(
        'name'     => 'maintenance_mode_section',
        'title'    => esc_html__('Maintenance Mode', 'elston'),
        'icon'     => 'fa fa-hourglass-half',
        'fields'   => array(

          // Start Maintenance Mode
          array(
            'type'    => 'notice',
            'class'   => 'info cs-vt-heading',
            'content' => __('If you turn this ON : Only Logged in users will see your pages. All other visiters will see, selected page of : <strong>Maintenance Mode Page</strong>', 'elston')
          ),
          array(
            'id'             => 'enable_maintenance_mode',
            'type'           => 'switcher',
            'title'          => esc_html__('Maintenance Mode', 'elston'),
            'default'        => false,
          ),
          array(
            'id'             => 'maintenance_mode_page',
            'type'           => 'select',
            'title'          => esc_html__('Maintenance Mode Page', 'elston'),
            'options'        => 'pages',
            'default_option' => esc_html__('Select a page', 'elston'),
            'dependency'   => array( 'enable_maintenance_mode', '==', 'true' ),
          ),
          array(
            'id'             => 'maintenance_mode_bg',
            'type'           => 'background',
            'title'          => esc_html__('Page Background', 'elston'),
            'dependency'   => array( 'enable_maintenance_mode', '==', 'true' ),
          ),
          // End Maintenance Mode

        ) // end: fields
      ), // end: fields section

    )
  );

  // ------------------------------
  // Advanced
  // ------------------------------
  $options[] = array(
    'name'   => 'theme_advanced',
    'title'  => esc_html__('Advanced', 'elston'),
    'icon'   => 'fa fa-cog'
  );

  // ------------------------------
  // Misc Section
  // ------------------------------
  $options[]   = array(
    'name'     => 'misc_section',
    'title'    => esc_html__('Misc', 'elston'),
    'icon'     => 'fa fa-recycle',
    'sections' => array(

      // Custom CSS/JS
      array(
        'name'        => 'custom_css_js_section',
        'title'       => esc_html__('Custom Codes', 'elston'),
        'icon'        => 'fa fa-code',

        // begin: fields
        'fields'      => array(

          // Start Custom CSS/JS
          array(
            'type'    => 'notice',
            'class'   => 'info cs-vt-heading',
            'content' => esc_html__('Custom CSS', 'elston')
          ),
          array(
            'id'             => 'theme_custom_css',
            'type'           => 'textarea',
            'attributes' => array(
              'rows'     => 10,
              'placeholder'     => esc_html__('Enter your CSS code here...', 'elston'),
            ),
          ),

          array(
            'type'    => 'notice',
            'class'   => 'info cs-vt-heading',
            'content' => esc_html__('Custom JS', 'elston')
          ),
          array(
            'id'             => 'theme_custom_js',
            'type'           => 'textarea',
            'attributes' => array(
              'rows'     => 10,
              'placeholder'     => esc_html__('Enter your JS code here...', 'elston'),
            ),
          ),
          // End Custom CSS/JS

        ) // end: fields
      ),

      // Translation
      array(
        'name'        => 'theme_translation_section',
        'title'       => esc_html__('Translation', 'elston'),
        'icon'        => 'fa fa-language',

        // begin: fields
        'fields'      => array(

          // Start Translation
          array(
            'type'    => 'notice',
            'class'   => 'info cs-vt-heading',
            'content' => esc_html__('Common Texts', 'elston')
          ),
          array(
            'id'          => 'read_more_text',
            'type'        => 'text',
            'title'       => esc_html__('Read More Text', 'elston'),
          ),
          array(
            'id'          => 'share_text',
            'type'        => 'text',
            'title'       => esc_html__('Share Text', 'elston'),
          ),
          array(
            'id'          => 'author_text',
            'type'        => 'text',
            'title'       => esc_html__('Author Text', 'elston'),
          ),
          array(
            'id'          => 'post_comment_text',
            'type'        => 'text',
            'title'       => esc_html__('Post Comment Text [Submit Button]', 'elston'),
          ),

          array(
            'type'    => 'notice',
            'class'   => 'info cs-vt-heading',
            'content' => esc_html__('Pagination', 'elston')
          ),
          array(
            'id'          => 'older_post',
            'type'        => 'text',
            'title'       => esc_html__('Older Posts Text', 'elston'),
          ),
          array(
            'id'          => 'newer_post',
            'type'        => 'text',
            'title'       => esc_html__('Newer Posts Text', 'elston'),
          ),
          array(
            'id'             => 'more_text',
            'type'           => 'text',
            'title'          => esc_html__('Ajax Load More Text', 'elston'),
            'default'        => 'Load More',
          ),
          array(
            'id'             => 'loading_text',
            'type'           => 'text',
            'title'          => esc_html__('Ajax Loading Data Text', 'elston'),
            'default'        => 'Loading ....',
          ),
          array(
            'id'             => 'end_text',
            'type'           => 'text',
            'title'          => esc_html__('Text to Show End of Query', 'elston'),
            'default'        => 'No More Post',
          ),
          array(
            'type'    => 'notice',
            'class'   => 'info cs-vt-heading',
            'content' => esc_html__('Single Portfolio Pagination', 'elston')
          ),
          array(
            'id'          => 'prev_port',
            'type'        => 'text',
            'title'       => esc_html__('Prev Project Text', 'elston'),
          ),
          array(
            'id'          => 'next_port',
            'type'        => 'text',
            'title'       => esc_html__('Next Project Text', 'elston'),
          ),
          array(
            'id'          => 'project_info',
            'type'        => 'text',
            'title'       => esc_html__('See Project Info Text', 'elston'),
          ),
          // End Translation

        ) // end: fields
      ),

    ),
  );

  // ------------------------------
  // backup                       -
  // ------------------------------
  $options[]   = array(
    'name'     => 'backup_section',
    'title'    => 'Backup',
    'icon'     => 'fa fa-shield',
    'fields'   => array(

      array(
        'type'    => 'notice',
        'class'   => 'warning',
        'content' => 'You can save your current options. Download a Backup and Import.',
      ),

      array(
        'type'    => 'backup',
      ),

    )
  );

  return $options;

}
add_filter( 'cs_framework_options', 'elston_framework_options' );
