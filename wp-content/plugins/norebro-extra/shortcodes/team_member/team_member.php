<?php

/**
* Visual Composer Norebro Team member shortcode
*/

add_shortcode( 'norebro_team_member', 'norebro_team_member_func' );

function norebro_team_member_func( $atts ) {
	if ( isset( $atts ) && is_array( $atts ) ) extract( $atts );

	// Default values, parsing and filtering
	$block_type_layout = isset( $block_type_layout ) ? NorExtraFilter::string( $block_type_layout, 'string', 'full' ) : 'full';
	$name = isset( $name ) ? NorExtraFilter::string( $name, 'string', '' ) : '';
	$position = isset( $position ) ? NorExtraFilter::string( $position, 'string', '' ) : '';
	$description = isset( $description ) ? NorExtraFilter::string( $description, 'textarea', '' ) : '';
	$photo = isset( $photo ) ? NorExtraFilter::string( wp_get_attachment_url( NorExtraFilter::string( $photo ) ), 'attr' ) : false;
	$member_link = isset( $member_link ) ? NorExtraFilter::string( $member_link ) : false;

	$facebook_link = isset( $facebook_link ) ? NorExtraFilter::string( $facebook_link ) : false;
	$twitter_link = isset( $twitter_link ) ? NorExtraFilter::string( $twitter_link ) : false;
	$dribbble_link = isset( $dribbble_link ) ? NorExtraFilter::string( $dribbble_link ) : false;
	$pinterest_link = isset( $pinterest_link ) ? NorExtraFilter::string( $pinterest_link ) : false;
	$github_link = isset( $github_link ) ? NorExtraFilter::string( $github_link ) : false;
	$instagram_link = isset( $instagram_link ) ? NorExtraFilter::string( $instagram_link ) : false;
	$linkedin_link = isset( $linkedin_link ) ? NorExtraFilter::string( $linkedin_link ) : false;
	$vk_link = isset( $vk_link ) ? NorExtraFilter::string( $vk_link ) : false;
	$wechat_link = isset( $wechat_link ) ? NorExtraFilter::string( $wechat_link ) : false;

	$name_typo = isset( $name_typo ) ? NorExtraFilter::string( $name_typo ) : false;
	$position_typo = isset( $position_typo ) ? NorExtraFilter::string( $position_typo ) : false;
	$desription_typo = isset( $desription_typo ) ? NorExtraFilter::string( $desription_typo ) : false;

	$overlay_color = isset( $overlay_color ) ? NorExtraFilter::string( $overlay_color ) : false;
	$name_color = isset( $name_color ) ? NorExtraFilter::string( $name_color ) : false;
	$position_color = isset( $position_color ) ? NorExtraFilter::string( $position_color ) : false;
	$description_color = isset( $description_color ) ? NorExtraFilter::string( $description_color ) : false;
	$social_color = isset( $social_color ) ? NorExtraFilter::string( $social_color ) : false;
	$social_hover_color = isset( $social_hover_color ) ? NorExtraFilter::string( $social_hover_color ) : false;

	$appearance_effect = isset( $appearance_effect ) ? NorExtraFilter::string( $appearance_effect, 'attr', 'none' ) : 'none';
	$appearance_duration = isset( $appearance_duration ) ? NorExtraFilter::string( $appearance_duration, 'attr', false ) : false;
	if ( $appearance_duration ) $appearance_duration = intval( str_replace( 'ms', '', $appearance_duration ) );

	$css_class = isset( $css_class ) ? ' ' . NorExtraFilter::string( $css_class, 'attr', '' )  : '';

	// Styling
	$team_member_uniqid = uniqid( 'norebro-custom-' );

	if ( $block_type_layout == 'inner' ) {
		$css_class .= ' inner';
	}

	if ( $block_type_layout == 'full' ) {
		$overlay_settings = NorExtraParser::VC_color_to_CSS( $overlay_color, 'box-shadow:0 -190px 145px -145px {{color}} inset;' );
	} else {
		$overlay_settings = NorExtraParser::VC_color_to_CSS( $overlay_color, 'background-color:{{color}};' );
	}
	$name_settings = NorExtraParser::VC_color_to_CSS( $name_color, 'color:{{color}};' );
	$position_settings = NorExtraParser::VC_color_to_CSS( $position_color, 'color:{{color}};' );
	$description_settings = NorExtraParser::VC_color_to_CSS( $description_color, 'color:{{color}};' );
	$social_settings = NorExtraParser::VC_color_to_CSS( $social_color, 'background-color:{{color}};border-color:{{color}};' );
	$social_hover_settings = NorExtraParser::VC_color_to_CSS( $social_hover_color, 'color:{{color}};border-color:{{color}}; background:transparent;' );

	if( !$social_hover_settings && $name_color ) {
		$social_hover_settings = ' background:transparent;';
	}

	$social_settings_class = '';
	if ( !$social_color ) {
		$social_settings_class .= ' default';
	}

	$name_settings .= NorExtraParser::VC_typo_to_CSS( $name_typo );
	$position_settings .= NorExtraParser::VC_typo_to_CSS( $position_typo );
	$description_settings .= NorExtraParser::VC_typo_to_CSS( $desription_typo );

	NorExtraParser::VC_typo_custom_font( $name_typo );
	NorExtraParser::VC_typo_custom_font( $position_typo );
	NorExtraParser::VC_typo_custom_font( $desription_typo );

	// Assembling
	ob_start();
	include( plugin_dir_path( __FILE__ ) . 'team_member__style.php' );
	include( plugin_dir_path( __FILE__ ) . 'team_member__view.php' );
	return ob_get_clean();
}
