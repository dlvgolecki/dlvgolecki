<?php
/*
 * All Custom Shortcode for Elston theme.
 * Author & Copyright: VictorThemes
 * URL: https://victorthemes.com
 */

if( ! function_exists( 'elston_framework_shortcodes' ) ) {
  function elston_framework_shortcodes( $options ) {

    $options       = array();

    /* Sidebar Shortcodes */
    $options[]     = array(
      'title'      => __('Sidebar Shortcodes', 'elston-core'),
      'shortcodes' => array(

        // Address Info
        array(
          'name'          => 'elston_email',
          'title'         => __('Email Address', 'elston-core'),
          'fields'        => array(

            array(
              'id'        => 'custom_class',
              'type'      => 'text',
              'title'     => __('Custom Class', 'elston-core'),
            ),
            array(
              'id'        => 'before_text',
              'type'      => 'text',
              'title'     => __('Before Email Address Text', 'elston-core'),
            ),
            array(
              'id'        => 'email',
              'type'      => 'text',
              'title'     => __('Email Address', 'elston-core'),
            ),
            array(
              'id'        => 'email_link',
              'type'      => 'text',
              'title'     => __('Email Address to Link Up', 'elston-core'),
            ),

          ),

        ),
        // Email Info

        // Phone Info
        array(
          'name'          => 'elston_phone',
          'title'         => __('Phone No', 'elston-core'),
          'fields'        => array(

            array(
              'id'        => 'custom_class',
              'type'      => 'text',
              'title'     => __('Custom Class', 'elston-core'),
            ),
            array(
              'id'        => 'before_text',
              'type'      => 'text',
              'title'     => __('Before Phone No Text', 'elston-core'),
            ),
            array(
              'id'        => 'phone',
              'type'      => 'text',
              'title'     => __('Phone No', 'elston-core'),
            ),
            array(
              'id'        => 'phone_link',
              'type'      => 'text',
              'title'     => __('Phone No to Link Up', 'elston-core'),
            ),

          ),

        ),
        // Phone Info

      ),
    );

    /* Content Shortcodes */
    $options[]     = array(
      'title'      => __('Content Shortcodes', 'elston-core'),
      'shortcodes' => array(

        // Spacer
        array(
          'name'          => 'vc_empty_space',
          'title'         => __('Spacer', 'elston-core'),
          'fields'        => array(

            array(
              'id'        => 'height',
              'type'      => 'text',
              'title'     => __('Height', 'elston-core'),
              'attributes' => array(
                'placeholder'     => '20px',
              ),
            ),

          ),
        ),
        // Spacer

        // Social Icons
        array(
          'name'          => 'elston_social',
          'title'         => __('Social Share Icon', 'elston-core'),
          'fields'        => array(
            array(
              'id'        => 'custom_class',
              'type'      => 'text',
              'title'     => __('Custom Class', 'elston-core'),
            ),
            array(
              'id'        => 'position',
              'type'      => 'select',
              'title'     => __('Icon Position', 'elston-core'),
              'options'  => array(
                'left'  => 'Left',
                'right'   => 'Right',
                'center' => 'Center',
              ),
              'default'  => 'left',
            ),
            array(
              'id'        => 'margin_top',
              'type'      => 'text',
              'title'     => __('Custom Margin Top', 'elston-core'),
            ),
            array(
              'id'        => 'margin_bottom',
              'type'      => 'text',
              'title'     => __('Custom Margin Bottom', 'elston-core'),
            ),

          ),

        ),
        // Social Icons

        // Useful Links
        array(
          'name'          => 'elston_useful_links',
          'title'         => __('Useful Links', 'elston-core'),
          'view'          => 'clone',
          'clone_id'      => 'elston_useful_link',
          'clone_title'   => __('Add New', 'elston-core'),
          'fields'        => array(

            array(
              'id'        => 'column_width',
              'type'      => 'select',
              'title'     => __('Column Width', 'elston-core'),
              'options'        => array(
                'full-width' => __('One Column', 'elston-core'),
                'half-width' => __('Two Column', 'elston-core'),
                'third-width' => __('Three Column', 'elston-core'),
              ),
            ),
            array(
              'id'        => 'custom_class',
              'type'      => 'text',
              'title'     => __('Custom Class', 'elston-core'),
            ),

          ),
          'clone_fields'  => array(

            array(
              'id'        => 'title_link',
              'type'      => 'text',
              'title'     => __('Link', 'elston-core')
            ),
            array(
              'id'        => 'target_tab',
              'type'      => 'switcher',
              'title'     => __('Open New Tab?', 'elston-core'),
              'on_text'     => __('Yes', 'elston-core'),
              'off_text'     => __('No', 'elston-core'),
            ),
            array(
              'id'        => 'link_title',
              'type'      => 'text',
              'title'     => __('Title', 'elston-core')
            ),

          ),

        ),
        // Useful Links

        // Simple Image List
        array(
          'name'          => 'elston_image_lists',
          'title'         => __('Simple Image List', 'elston-core'),
          'view'          => 'clone',
          'clone_id'      => 'elston_image_list',
          'clone_title'   => __('Add New', 'elston-core'),
          'fields'        => array(

            array(
              'id'        => 'custom_class',
              'type'      => 'text',
              'title'     => __('Custom Class', 'elston-core'),
            ),

          ),
          'clone_fields'  => array(

            array(
              'id'        => 'get_image',
              'type'      => 'upload',
              'title'     => __('Image', 'elston-core')
            ),
            array(
              'id'        => 'link',
              'type'      => 'text',
              'attributes' => array(
                'placeholder'     => 'http://',
              ),
              'title'     => __('Link', 'elston-core')
            ),
            array(
              'id'    => 'open_tab',
              'type'  => 'switcher',
              'std'   => false,
              'title' => __('Open link to new tab?', 'elston-core')
            ),

          ),

        ),
        // Simple Image List

        // Simple Link
        array(
          'name'          => 'elston_simple_link',
          'title'         => __('Simple Link', 'elston-core'),
          'fields'        => array(

            array(
              'id'        => 'link_style',
              'type'      => 'select',
              'title'     => __('Link Style', 'elston-core'),
              'options'        => array(
                'link-underline' => __('Link Underline', 'elston-core'),
                'link-arrow-right' => __('Link Arrow (Right)', 'elston-core'),
                'link-arrow-left' => __('Link Arrow (Left)', 'elston-core'),
              ),
            ),
            array(
              'id'        => 'link_icon',
              'type'      => 'icon',
              'title'     => __('Icon', 'elston-core'),
              'value'      => 'fa fa-caret-right',
              'dependency'  => array('link_style', '!=', 'link-underline'),
            ),
            array(
              'id'        => 'link_text',
              'type'      => 'text',
              'title'     => __('Link Text', 'elston-core'),
            ),
            array(
              'id'        => 'link',
              'type'      => 'text',
              'title'     => __('Link', 'elston-core'),
              'attributes' => array(
                'placeholder'     => 'http://',
              ),
            ),
            array(
              'id'        => 'target_tab',
              'type'      => 'switcher',
              'title'     => __('Open New Tab?', 'elston-core'),
              'on_text'     => __('Yes', 'elston-core'),
              'off_text'     => __('No', 'elston-core'),
            ),
            array(
              'id'        => 'custom_class',
              'type'      => 'text',
              'title'     => __('Custom Class', 'elston-core'),
            ),

            // Normal Mode
            array(
              'type'    => 'notice',
              'class'   => 'info',
              'content' => __('Normal Mode', 'elston-core')
            ),
            array(
              'id'        => 'text_color',
              'type'      => 'color_picker',
              'title'     => __('Text Color', 'elston-core'),
              'wrap_class' => 'column_half el-hav-border',
            ),
            array(
              'id'        => 'border_color',
              'type'      => 'color_picker',
              'title'     => __('Border Color', 'elston-core'),
              'wrap_class' => 'column_half el-hav-border',
              'dependency'  => array('link_style', '==', 'link-underline'),
            ),
            // Hover Mode
            array(
              'type'    => 'notice',
              'class'   => 'info',
              'content' => __('Hover Mode', 'elston-core')
            ),
            array(
              'id'        => 'text_hover_color',
              'type'      => 'color_picker',
              'title'     => __('Text Hover Color', 'elston-core'),
              'wrap_class' => 'column_half el-hav-border',
            ),
            array(
              'id'        => 'border_hover_color',
              'type'      => 'color_picker',
              'title'     => __('Border Hover Color', 'elston-core'),
              'wrap_class' => 'column_half el-hav-border',
              'dependency'  => array('link_style', '==', 'link-underline'),
            ),

            // Size
            array(
              'type'    => 'notice',
              'class'   => 'info',
              'content' => __('Font Sizes', 'elston-core')
            ),
            array(
              'id'        => 'text_size',
              'type'      => 'text',
              'title'     => __('Text Size', 'elston-core'),
              'attributes' => array(
                'placeholder'     => 'Eg: 14px',
              ),
            ),

          ),
        ),
        // Simple Link

        // Button
        array(
          'name'          => 'elston_button',
          'title'         => __('Simple Button', 'elston-core'),
          'fields'        => array(

            array(
              'id'        => 'button_type',
              'type'      => 'select',
              'title'     => __('Button Type', 'elston-core'),
              'options'        => array(
                'btn-one' => __('Button One', 'elston-core'),
                'btn-two' => __('Button Two', 'elston-core'),
              ),
              'default'   => 'btn-one',
            ),
            array(
              'id'        => 'button_style',
              'type'      => 'select',
              'title'     => __('Button Style', 'elston-core'),
              'options'        => array(
                'rounded'  => __('Rounded', 'elston-core'),
                'squired'   => __('Squired', 'elston-core'),
              ),
              'default'   => 'rounded',
            ),
            array(
              'id'        => 'button_size',
              'type'      => 'select',
              'title'     => __('Button Size', 'elston-core'),
              'options'        => array(
                'medium'  => __('Medium', 'elston-core'),
                'large'   => __('Large', 'elston-core'),
              ),
              'default'   => 'medium',
            ),
            array(
              'id'        => 'button_text',
              'type'      => 'text',
              'title'     => __('Button Text', 'elston-core'),
            ),
            array(
              'id'        => 'button_link',
              'type'      => 'text',
              'title'     => __('Link', 'elston-core'),
              'attributes' => array(
                'placeholder'     => 'http://',
              ),
            ),
            array(
              'id'        => 'open_link',
              'type'      => 'switcher',
              'title'     => __('Open New Tab?', 'elston-core'),
              'on_text'     => __('Yes', 'elston-core'),
              'off_text'     => __('No', 'elston-core'),
            ),
            array(
              'id'        => 'custom_class',
              'type'      => 'text',
              'title'     => __('Custom Class', 'elston-core'),
            ),

            // Normal Mode
            array(
              'type'    => 'notice',
              'class'   => 'info',
              'content' => __('Normal Mode', 'elston-core')
            ),
            array(
              'id'        => 'text_color',
              'type'      => 'color_picker',
              'title'     => __('Text Color', 'elston-core'),
              'wrap_class' => 'column_half el-hav-border',
            ),
            array(
              'id'        => 'border_color',
              'type'      => 'color_picker',
              'title'     => __('Border Color', 'elston-core'),
              'wrap_class' => 'column_half el-hav-border',
            ),
            // Hover Mode
            array(
              'type'    => 'notice',
              'class'   => 'info',
              'content' => __('Hover Mode', 'elston-core')
            ),
            array(
              'id'        => 'text_hover_color',
              'type'      => 'color_picker',
              'title'     => __('Text Hover Color', 'elston-core'),
              'wrap_class' => 'column_half el-hav-border',
            ),
            array(
              'id'        => 'border_hover_color',
              'type'      => 'color_picker',
              'title'     => __('Border Hover Color', 'elston-core'),
              'wrap_class' => 'column_half el-hav-border',
            ),
            array(
              'id'        => 'bg_hover_color',
              'type'      => 'color_picker',
              'title'     => __('Background Hover Color', 'elston-core'),
              'wrap_class' => 'column_half el-hav-border',
            ),

            // Size
            array(
              'type'    => 'notice',
              'class'   => 'info',
              'content' => __('Font Sizes', 'elston-core')
            ),
            array(
              'id'        => 'text_size',
              'type'      => 'text',
              'title'     => __('Text Size', 'elston-core'),
              'attributes' => array(
                'placeholder'     => 'Eg: 14px',
              ),
            ),

          ),
        ),
        // Button

        // Blockquotes
        array(
          'name'          => 'elston_blockquote',
          'title'         => __('Blockquote', 'elston-core'),
          'fields'        => array(
            array(
              'id'        => 'text_size',
              'type'      => 'text',
              'title'     => __('Text Size', 'elston-core'),
            ),
            array(
              'id'        => 'custom_class',
              'type'      => 'text',
              'title'     => __('Custom Class', 'elston-core'),
            ),
            array(
              'id'        => 'content_color',
              'type'      => 'color_picker',
              'title'     => __('Content Color', 'elston-core'),
            ),
            array(
              'id'        => 'left_color',
              'type'      => 'color_picker',
              'title'     => __('Left Border Color', 'elston-core'),
            ),
            array(
              'id'        => 'border_color',
              'type'      => 'color_picker',
              'title'     => __('Border Color', 'elston-core'),
            ),
            array(
              'id'        => 'bg_color',
              'type'      => 'color_picker',
              'title'     => __('Background Color', 'elston-core'),
            ),
            // Content
            array(
              'id'        => 'content',
              'type'      => 'textarea',
              'title'     => __('Content', 'elston-core'),
            ),

          ),

        ),
        // Blockquotes

        // List Styles
        array(
          'name'          => 'elston_address_lists',
          'title'         => __('Address Lists', 'elston-core'),
          'view'          => 'clone',
          'clone_id'      => 'elston_address_list',
          'clone_title'   => __('Add New', 'elston-core'),
          'fields'        => array(

            array(
              'id'        => 'custom_class',
              'type'      => 'text',
              'title'     => __('Custom Class', 'elston-core'),
            ),

            // Colors
            array(
              'type'    => 'notice',
              'class'   => 'info',
              'content' => __('Colors', 'elston-core')
            ),
            array(
              'id'        => 'text_color',
              'type'      => 'color_picker',
              'title'     => __('Text Color', 'elston-core'),
              'wrap_class' => 'column_half el-hav-border',
            ),
            array(
              'id'        => 'title_color',
              'type'      => 'color_picker',
              'title'     => __('Title Color', 'elston-core'),
              'wrap_class' => 'column_half el-hav-border',
            ),

            // Size
            array(
              'id'        => 'text_size',
              'type'      => 'text',
              'title'     => __('Text Size', 'elston-core'),
              'wrap_class' => 'column_half el-hav-border',
            ),
            array(
              'id'        => 'title_size',
              'type'      => 'text',
              'title'     => __('Title Size', 'elston-core'),
              'wrap_class' => 'column_half el-hav-border',
            ),

          ),
          'clone_fields'  => array(

            array(
              'id'        => 'list_title',
              'type'      => 'text',
              'title'     => __('Title', 'elston-core')
            ),
            array(
              'id'        => 'list_text',
              'type'      => 'textarea',
              'title'     => __('Text', 'elston-core')
            ),

          ),

        ),
        // List Styles

      ),
    );

    /* Testimonial Shortcodes */
    $options[]     = array(
      'title'      => __('Testimonial Shortcodes', 'elston-core'),
      'shortcodes' => array(

        // Testimonial
        array(
          'name'          => 'elston_single_testimonial',
          'title'         => __('Single Testimonial', 'elston-core'),
          'fields'        => array(

            array(
              'id'        => 'custom_class',
              'type'      => 'text',
              'title'     => __('Custom Class', 'elston-core'),
            ),

            array(
              'id'        => 'testimonial',
              'type'      => 'textarea',
              'title'     => __('Testimonial Text', 'elston-core'),
            ),

            array(
              'id'        => 'client',
              'type'      => 'text',
              'title'     => __('Client Name', 'elston-core'),
            ),

          ),

        ),
        // Testimonial

      ),
    );

  return $options;

  }
  add_filter( 'cs_shortcode_options', 'elston_framework_shortcodes' );
}
