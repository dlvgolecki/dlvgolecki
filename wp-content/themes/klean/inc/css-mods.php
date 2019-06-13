<?php
/* 
**   Custom Modifcations in CSS depending on user settings.
*/

function klean_custom_css_mods() {

    echo "<style id='custom-css-mods'>";
	
	//If Highlighting Nav active item is disabled
	if ( get_theme_mod('klean_disable_active_nav') ) :
		echo "#site-navigation ul .current_page_item > a, #site-navigation ul .current-menu-item > a, #site-navigation ul .current_page_ancestor > a { border:none; background: inherit; }"; 
	endif;

	if ( get_theme_mod('klean_title_font','Source Sans Pro') ) :
		echo "h1.site-title, h2 { font-family: ".esc_html(get_theme_mod('klean_title_font'))."; }";
	endif;
	
	if ( get_theme_mod('klean_body_font','Source Sans Pro') ) :
		echo "body { font-family: ".esc_html(get_theme_mod('klean_body_font'))."; }";
	endif;

	if (!display_header_text()):
        echo "#masthead .site-branding #text-title-desc { display: none; }";
	endif;

	if ( get_header_textcolor() ) :
		echo "#masthead h1.site-title a { color: #".get_header_textcolor()."; }";
	endif;


    if ( get_theme_mod('klean-desc-color','#555555') ) :
		echo "#masthead h2.site-description { color: ".esc_html(get_theme_mod('klean-desc-color','#555555'))."; }";
	endif;

    if(!is_home() && is_front_page()):
        if( get_theme_mod('klean_page_title', true)):
            echo "#primary-mono .entry-header { display:none; }";
        endif;
    endif;

    if (!is_home() && is_front_page()) :
        if ( get_theme_mod('klean_content_font_size') ) :
            $size = (get_theme_mod('klean_content_font_size'));
            echo "#primary-mono .entry-content { font-size:".$size.";}";
        endif;
    endif;

    if (get_theme_mod('klean_hero_background_image') != '') :
        $image = get_theme_mod('klean_hero_background_image');
        echo "#hero {
                    	background-image: url('" . $image . "');
                        background-size: cover;
                }";
    endif;

    if (get_theme_mod('klean_hero_background_image')) :
        $image1 = get_theme_mod('klean_hero2_background_image');
        echo "#hero2 {
                    background-image: url('" . $image1 . "');
                    background-size: cover;
                }";
    endif;

    if ( get_theme_mod( 'klean-post-sidebar' ) == false ) {
        echo "#secondary:not(.left-sidebar):not(.right-sidebar) {display: none;}
			  #primary {width: 100%;}";
    }

    echo "#social-icons span i.fa-circle{color: " . esc_attr( get_theme_mod( 'klean-social-color','black' ) ) . ";}
		  .fa-inverse {color: " . esc_attr( get_theme_mod( 'klean-social-icon-color','white' ) ) . ";}";

    echo "</style>";
}

add_action('wp_head', 'klean_custom_css_mods');