<?php
/* ==========================================================
  Social List Icon
=========================================================== */
if ( !function_exists('elstn_social_list_icons_function')) {
  function elstn_social_list_icons_function( $atts, $content = NULL ) {
    extract(shortcode_atts(array(
      'title'  => '',
      'list_items'  => '',
      'select_icon'  => '',
      'link'  => '',
      'open_link'  => '',
      'class'  => '',
      // Styling
      'text_color'  => '',
      'text_hover_color'  => '',
      'text_size'  => '',
    ), $atts));

    $list_items = (array) vc_param_group_parse_atts( $list_items );
    $get_each_list = array();
    foreach ( $list_items as $list_item ) {
      $each_list = $list_item;
      $each_list['link'] = isset( $list_item['link'] ) ? $list_item['link'] : '';
      $each_list['select_icon'] = isset( $list_item['select_icon'] ) ? $list_item['select_icon'] : '';
      $get_each_list[] = $each_list;
    }

    // Shortcode Style CSS
    $e_uniqid        = uniqid();
    $inline_style  = '';

    // Button Text Color
    if ( $text_color ) {
      $inline_style .= '.elstn-icon-'. $e_uniqid .' {';
      $inline_style .= ( $text_color ) ? 'color:'. $text_color .'!important;' : '';
      $inline_style .= '}';
    }
    // Button Text Hover Color
    if ( $text_hover_color ) {
      $inline_style .= '.elstn-icon-'. $e_uniqid .':hover, .elstn-icon-'. $e_uniqid .':focus, .elstn-icon-'. $e_uniqid .':active {';
      $inline_style .= ( $text_hover_color ) ? 'color:'. $text_hover_color .' !important;' : '';
      $inline_style .= '}';
    }
    // Text Size
    if ( $text_size ) {
      $inline_style .= '.elstn-icon-'. $e_uniqid .' {';
      $inline_style .= ( $text_size ) ? 'font-size:'. $text_size .';' : '';
      $inline_style .= '}';
    }
    // add inline style
    add_inline_style( $inline_style );
    $styled_class  = ' elstn-icon-'. $e_uniqid;
    $open_link = $open_link ? ' target="_blank"' : '';
    ob_start();
    ?>
    <div class="elstn-social-links <?php echo esc_attr( $class ); ?>">
      <?php foreach ( $get_each_list as $each_list ) { ?>
      <a class="<?php echo esc_attr( $styled_class );?>" href="<?php echo esc_attr( $each_list['link']);?>" <?php echo $open_link;?>><i aria-hidden="true" class="<?php echo esc_attr( $each_list['select_icon']);?>"></i></a>
      <?php } ?>
    </div>
    <?php
    $output = ob_get_clean();

    return $output;
  }
}
add_shortcode( 'elstn_social_list_icons', 'elstn_social_list_icons_function' );
