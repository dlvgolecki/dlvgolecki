<?php
/* ==========================================================
  Portfolio Details Block
=========================================================== */
if ( !function_exists('elstn_portfolio_details_function')) {
  function elstn_portfolio_details_function( $atts, $content = NULL ) {

    extract(shortcode_atts(array(
      'version'  => 'one',
      'heading_text'  => '',
      'custom_heading'  => '',
      'sub_heading'  => '',
      'link'  => '',
      'open_link'  => '',
      'link_text'  => '',
      'link_before_text'  => '',
      'client'  => '',
      'client_link'  => '',
      'year'  => '',
      'share_on'  => '',
      'share_alignment'  => '',
      'sidebar_style'  => 'sticky',
      'detail_lists'  => '',
      'class'  => '',
    ), $atts));

    $heading_text = ($heading_text == 'custom') ? $custom_heading : get_the_title();
    $open_link = $open_link ? ' target="_blank"' : '';
    $sidebar_style = ( $sidebar_style == 'sticky' ) ? 'sticky' : 'floting';
    $sidebar_id = ( $version == 'three' ) ? 'primary' : '';
    $share_alignment = $share_alignment ? $share_alignment : 'share-default';

  // Group Field
  $detail_lists = (array) vc_param_group_parse_atts( $detail_lists );

	// Category
	global $post;
	$terms = wp_get_post_terms($post->ID,'portfolio_category');

	$cat_name = array();
	foreach ($terms as $term) {
		$cat_name[] = '<span><a href="' . get_term_link( $term ) . '">' . $term->name . '</a></span>';
	}
	$term_cat = implode( ' ', $cat_name);

	//Translate
	$client_text = cs_get_option('client_text');
	$services_text = cs_get_option('services_text');
	$year_text = cs_get_option('year_text');

	$client_text = ($client_text) ? $client_text : esc_html__('Client', 'elston-core');
	$services_text = ($services_text) ? $services_text : esc_html__('Services', 'elston-core');
	$year_text = ($year_text) ? $year_text : esc_html__('Year', 'elston-core');

    ob_start();

    if( $version == 'one' ) { ?>
		    <div class="elstn-detail-wrap elstn-detail-one <?php echo esc_attr( $class );?>">
          <div class="wrapper">
            <div class="elstn-heading-wrap">
              <h2 class="elstn-heading"><?php echo esc_html( $heading_text ); ?></h2>
              <span class="elstn-sub-heading"><?php echo esc_html( $sub_heading ); ?></span>
            </div>
            <p style="line-height:1.9;"><?php echo $content; ?></p>
            <p style="line-height:1.9;"><?php echo esc_html( $link_before_text ); ?> <a href="<?php echo esc_url( $link ); ?>" <?php echo esc_attr( $open_link ); ?>><?php echo esc_attr( $link_text); ?></a></p>
          </div>
          <?php
          if($share_on){
            echo '<div class="'. $share_alignment .'">';
            echo elston_wp_share_option();
            echo '</div>';
          } ?>
        </div>
        <?php }

        if( $version == 'two') { ?>
	      <div class="elstn-detail-container version2 <?php echo esc_attr( $class );?>">
          <h2><?php echo esc_html( $heading_text ); ?></h2>
          <?php if ($detail_lists) { ?>
          <ul>
          <?php
          // Group Param Output
          foreach( $detail_lists as $each_list ) {
            $title = isset( $each_list['title'] ) ? '<strong>'. $each_list['title'] .'</strong>' : '';
            $text_one = isset( $each_list['text_one'] ) ? '<span>'. $each_list['text_one'] .'</span>' : '';
            $text_two = isset( $each_list['text_two'] ) ? ' <span>'. $each_list['text_two'] .'</span>' : '';
            $text_one_link = isset( $each_list['text_one_link'] ) ? '<span><a href="'. $each_list['text_one_link'] .'" '. $open_link .'>'. $text_one .'</a></span>' : $text_one;
            $text_two_link = isset( $each_list['text_two_link'] ) ? ' <span><a href="'. $each_list['text_two_link'] .'" '. $open_link .'>'. $text_two .'</a></span>' : $text_two;
            echo '<li>'. $title .' '. $text_one_link . $text_two_link .'</li>';
          }
          ?>
          </ul>
          <?php } ?>
          <p style="line-height:1.6;"><?php echo $content; ?></p>
          <div class="action-link"><span><?php echo esc_html( $link_before_text ); ?></span> <a href="<?php echo esc_url( $link ); ?>" <?php echo esc_attr( $open_link ); ?>><?php echo esc_attr( $link_text); ?></a></div>
        </div>
        <?php }

        if( $version == 'three' || $version == 'four' ) { ?>
        <div class="elstn-target <?php echo esc_attr( $sidebar_style); ?> <?php echo esc_attr( $class );?>" id="<?php echo esc_attr( $sidebar_id); ?>">
	        <div class="sidebar-container">
	          <div class="elstn-detail-container">
	            <div class="elstn-heading-wrap">
	              <h2 class="elstn-heading"><?php echo esc_html( $heading_text ); ?></h2>
	              <span class="elstn-sub-heading"><?php echo esc_html( $sub_heading ); ?></span>
	            </div>
	            <p style="line-height:1.7;"><?php echo $content; ?></p>
	            <?php if ($detail_lists) { ?>
              <ul>
              <?php
              // Group Param Output
              foreach( $detail_lists as $each_list ) {
                $title = isset( $each_list['title'] ) ? '<strong>'. $each_list['title'] .'</strong>' : '';
                $text_one = isset( $each_list['text_one'] ) ? '<span>'. $each_list['text_one'] .'</span>' : '';
                $text_two = isset( $each_list['text_two'] ) ? ' <span>'. $each_list['text_two'] .'</span>' : '';
                $text_one_link = isset( $each_list['text_one_link'] ) ? '<span><a href="'. $each_list['text_one_link'] .'" '. $open_link .'>'. $text_one .'</a></span>' : $text_one;
                $text_two_link = isset( $each_list['text_two_link'] ) ? ' <span><a href="'. $each_list['text_two_link'] .'" '. $open_link .'>'. $text_two .'</a></span>' : $text_two;
                echo '<li>'. $title .' '. $text_one_link . $text_two_link .'</li>';
              }
              ?>
              </ul>
              <?php } ?>
	            <div class="action-link"><span><?php echo esc_html( $link_before_text ); ?></span> <a href="<?php echo esc_url( $link ); ?>" <?php echo esc_attr( $open_link ); ?>><?php echo esc_attr( $link_text); ?></a></div>
	            <?php if($share_on){
	            	echo '<div class="'. $share_alignment .'">';
                echo elston_wp_share_option();
                echo '</div>';
	            }?>
	          </div>
	        </div>
        </div>
        <?php }

        if( $version == 'five' ) { ?>
	      <div class="elstn-project-wrap <?php echo esc_attr( $class );?>">
	        <div class="action-arrow"><a href="javascript:void(0);"><img src="<?php echo ELSTN_PLUGIN_ASTS; ?>/images/arrow2.png" alt=""/></a></div>
	        <div class="row">
	          <div class="col-md-6">
	            <div class="portfolio-title"><?php echo esc_html( $heading_text ); ?></div>
	            <?php if ($detail_lists) { ?>
              <ul>
              <?php
              // Group Param Output
              foreach( $detail_lists as $each_list ) {
                $title = isset( $each_list['title'] ) ? '<strong>'. $each_list['title'] .'</strong>' : '';
                $text_one = isset( $each_list['text_one'] ) ? '<span>'. $each_list['text_one'] .'</span>' : '';
                $text_two = isset( $each_list['text_two'] ) ? ' <span>'. $each_list['text_two'] .'</span>' : '';
                $text_one_link = isset( $each_list['text_one_link'] ) ? '<span><a href="'. $each_list['text_one_link'] .'" '. $open_link .'>'. $text_one .'</a></span>' : $text_one;
                $text_two_link = isset( $each_list['text_two_link'] ) ? ' <span><a href="'. $each_list['text_two_link'] .'" '. $open_link .'>'. $text_two .'</a></span>' : $text_two;
                echo '<li>'. $title .' '. $text_one_link . $text_two_link .'</li>';
              }
              ?>
              </ul>
              <?php }
              if($share_on){
	            	echo '<div class="'. $share_alignment .'">';
                echo elston_wp_share_option();
                echo '</div>';
	            } ?>
	          </div>
	          <div class="col-md-6">
	            <div class="details-wrapper">
	              <div class="details-inner">
	                <p style="line-height:1.7;"><?php echo $content; ?></p>
	              </div>
	              <div class="action-link"><span><?php echo esc_html( $link_before_text ); ?></span> <a href="<?php echo esc_url( $link ); ?>" <?php echo esc_attr( $open_link ); ?>><?php echo esc_attr( $link_text); ?></a></div>
	            </div>
	          </div>
	        </div>
	      </div>
        <?php }

        if( $version == 'six' ) { ?>
        <div class="elstn-detail-container <?php echo esc_attr( $class );?>">
          <div class="row">
            <div class="col-md-4">
              <h2><?php echo esc_html( $heading_text ); ?></h2>
              <?php if ($detail_lists) { ?>
              <ul>
              <?php
              // Group Param Output
              foreach( $detail_lists as $each_list ) {
                $title = isset( $each_list['title'] ) ? '<strong>'. $each_list['title'] .'</strong>' : '';
                $text_one = isset( $each_list['text_one'] ) ? '<span>'. $each_list['text_one'] .'</span>' : '';
                $text_two = isset( $each_list['text_two'] ) ? ' <span>'. $each_list['text_two'] .'</span>' : '';
                $text_one_link = isset( $each_list['text_one_link'] ) ? '<span><a href="'. $each_list['text_one_link'] .'" '. $open_link .'>'. $text_one .'</a></span>' : $text_one;
                $text_two_link = isset( $each_list['text_two_link'] ) ? ' <span><a href="'. $each_list['text_two_link'] .'" '. $open_link .'>'. $text_two .'</a></span>' : $text_two;
                echo '<li>'. $title .' '. $text_one_link . $text_two_link .'</li>';
              }
              ?>
              </ul>
              <?php } ?>
            </div>
            <div class="col-md-8">
              <div class="deatil-item">
                <?php echo $content; ?>
              </div>
            </div>
          </div>
        </div>
        <?php }

    $output = ob_get_clean();

    return $output;
  }
}
add_shortcode( 'elstn_portfolio_details', 'elstn_portfolio_details_function' );
