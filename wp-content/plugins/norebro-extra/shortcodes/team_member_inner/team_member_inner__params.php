<?php

/**
* Visual Composer Norebro Team Members Group Inner shortcode params
*/

vc_map( array(
	'name' => __( 'Team Member', 'norebro-extra' ),
	'description' => __( 'Team member module', 'norebro-extra' ),
	'base' => 'norebro_team_member_inner',
	'category' => __( 'Norebro', 'norebro-extra' ),
	'icon' => plugin_dir_url( __FILE__ ) . 'images/icon.svg',
	'content_element' => true,
	'as_child' => array(
		'only' => 'norebro_team_member_group'
	),
	'js_view' => 'VcNorebroTeamMemberInnerView',
	'custom_markup' => '{{title}}<div class="vc_norebro_team_member_inner-container">
			<div class="_contain">
				<div class="photo" style="background-image: url(\'' . plugin_dir_url( __FILE__ ) . 'images/view_user_gap.png\');"></div>
				<div class="right">
					<div class="name">%%name%%</div>
					<div class="position"></div>
					<div class="lines"><div class="line"></div><div class="line"></div><div class="line"></div><div class="line"></div></div>
				</div>
			</div>
		</div>',
	'params' => array(
		// General
		array(
			'type' => 'attach_image',
			'group' => __( 'General', 'norebro-extra' ),
			'heading' => __( 'Photo', 'norebro-extra' ),
			'param_name' => 'photo',
			'description' => __( 'Choose member photo.', 'norebro-extra' ),
		),
		array(
			'type' => 'textfield',
			'holder' => 'em',
			'group' => __( 'General', 'norebro-extra' ),
			'heading' => __( 'Name', 'norebro-extra' ),
			'param_name' => 'name',
			'description' => __( 'Team member name.', 'norebro-extra' ),
		),
		array(
			'type' => 'textfield',
			'group' => __( 'General', 'norebro-extra' ),
			'heading' => __( 'Position', 'norebro-extra' ),
			'param_name' => 'position',
			'description' => __( 'For example, <strong>Product manager at Colabr.io</strong>.', 'norebro-extra' ),
		),
		array(
			'type' => 'textarea',
			'group' => __( 'General', 'norebro-extra' ),
			'heading' => __( 'Description', 'norebro-extra' ),
			'param_name' => 'description',
			'description' => __( 'Tell what this remarkable team member in your team.', 'norebro-extra' ),
		),
		array(
			'type' => 'textfield',
			'group' => __( 'General', 'norebro-extra' ),
			'heading' => __( 'Link', 'norebro-extra' ),
			'param_name' => 'member_link',
			'description' => __( 'Enter team member link.', 'norebro-extra' ),
		),

		// Soc links
		array(
			'type' => 'textfield',
			'group' => __( 'Social links', 'norebro-extra' ),
			'heading' => '<em class="norebro_is fa fa-facebook"></em>' . __( 'Facebook link', 'norebro-extra' ),
			'param_name' => 'facebook_link'
		),
		array(
			'type' => 'textfield',
			'group' => __( 'Social links', 'norebro-extra' ),
			'heading' => '<em class="norebro_is fa fa-twitter"></em>' . __( 'Twitter link', 'norebro-extra' ),
			'param_name' => 'twitter_link'
		),
		array(
			'type' => 'textfield',
			'group' => __( 'Social links', 'norebro-extra' ),
			'heading' => '<em class="norebro_is fa fa-dribbble"></em>' . __( 'Dribbble link', 'norebro-extra' ),
			'param_name' => 'dribbble_link'
		),
		array(
			'type' => 'textfield',
			'group' => __( 'Social links', 'norebro-extra' ),
			'heading' => '<em class="norebro_is fa fa-pinterest-p"></em>' . __( 'Pinterest link', 'norebro-extra' ),
			'param_name' => 'pinterest_link'
		),
		array(
			'type' => 'textfield',
			'group' => __( 'Social links', 'norebro-extra' ),
			'heading' => '<em class="norebro_is fa fa-github"></em>' . __( 'Github link', 'norebro-extra' ),
			'param_name' => 'github_link'
		),
		array(
			'type' => 'textfield',
			'group' => __( 'Social links', 'norebro-extra' ),
			'heading' => '<em class="norebro_is fa fa-instagram"></em>' . __( 'Instagram link', 'norebro-extra' ),
			'param_name' => 'instagram_link'
		),
		array(
			'type' => 'textfield',
			'group' => __( 'Social links', 'norebro-extra' ),
			'heading' => '<em class="norebro_is fa fa-linkedin"></em>' . __( 'LinkedIn link', 'norebro-extra' ),
			'param_name' => 'linkedin_link'
		),
		array(
			'type' => 'textfield',
			'group' => __( 'Social links', 'norebro-extra' ),
			'heading' => '<em class="norebro_is fa fa-vk"></em>' . __( 'Vkontakte link', 'norebro-extra' ),
			'param_name' => 'vk_link'
		),

		/* Typography */
		array(
			'type' => 'norebro_divider',
			'group' => __( 'Typography', 'norebro-extra' ),
			'param_name' => 'typo_tab_divider_name',
			'value' => __( 'Name', 'norebro-extra' ),
		),
		array(
			'type' => 'norebro_typography',
			'group' => __( 'Typography', 'norebro-extra' ),
			'param_name' => 'name_typo',
		),
		array(
			'type' => 'norebro_divider',
			'group' => __( 'Typography', 'norebro-extra' ),
			'param_name' => 'typo_tab_divider_position',
			'value' => __( 'Position', 'norebro-extra' ),
		),
		array(
			'type' => 'norebro_typography',
			'group' => __( 'Typography', 'norebro-extra' ),
			'param_name' => 'position_typo',
		),
		array(
			'type' => 'norebro_divider',
			'group' => __( 'Typography', 'norebro-extra' ),
			'param_name' => 'typo_tab_divider_description',
			'value' => __( 'Description', 'norebro-extra' ),
		),
		array(
			'type' => 'norebro_typography',
			'group' => __( 'Typography', 'norebro-extra' ),
			'param_name' => 'desription_typo',
		),

		/* Styles */
		array(
			'type' => 'norebro_divider',
			'group' => __( 'Styles and Colors', 'norebro-extra' ),
			'param_name' => 'style_tab_divider_content',
			'value' => __( 'Content', 'norebro-extra' ),
		),
		array(
			'type' => 'norebro_colorpicker',
			'group' => __( 'Styles and Colors', 'norebro-extra' ),
			'heading' => __( 'Overlay color', 'norebro-extra' ),
			'param_name' => 'overlay_color',
		),
		array(
			'type' => 'norebro_colorpicker',
			'group' => __( 'Styles and Colors', 'norebro-extra' ),
			'heading' => __( 'Name color', 'norebro-extra' ),
			'param_name' => 'name_color',
		),
		array(
			'type' => 'norebro_colorpicker',
			'group' => __( 'Styles and Colors', 'norebro-extra' ),
			'heading' => __( 'Position text color', 'norebro-extra' ),
			'param_name' => 'position_color',
		),
		array(
			'type' => 'norebro_colorpicker',
			'group' => __( 'Styles and Colors', 'norebro-extra' ),
			'heading' => __( 'Description color', 'norebro-extra' ),
			'param_name' => 'description_color',
		),
		array(
			'type' => 'norebro_colorpicker',
			'group' => __( 'Styles and Colors', 'norebro-extra' ),
			'heading' => __( 'Social buttons color', 'norebro-extra' ),
			'param_name' => 'social_color',
		),
		array(
			'type' => 'norebro_colorpicker',
			'group' => __( 'Styles and Colors', 'norebro-extra' ),
			'heading' => __( 'Social buttons hover color', 'norebro-extra' ),
			'param_name' => 'social_hover_color',
		),
		array(
			'type' => 'norebro_divider',
			'group' => __( 'Styles and Colors', 'norebro-extra' ),
			'param_name' => 'style_tab_divider_other',
			'value' => __( 'Other', 'norebro-extra' ),
		),
		array(
			'type' => 'textfield',
			'group' => __( 'Styles and Colors', 'norebro-extra' ),
			'heading' => __( 'Custom CSS class', 'norebro-extra' ),
			'param_name' => 'css_class',
			'description' => __( 'If you want to add styles to a specific unit, use this field to add CSS class.', 'norebro-extra' )
		),
	)
) );