<?php

/**
 * Visual Composer Norebro Image shortcode params
 */

vc_map( array(
    'name' => __( 'Image', 'norebro-extra' ),
    'description' => __( 'Simple block with image', 'norebro-extra' ),
    'base' => 'norebro_image',
    'category' => __( 'Norebro', 'norebro-extra' ),
    'icon' => plugin_dir_url( __FILE__ ) . 'images/icon.svg',
    'params' => array(

        // General
        array(
            'type' => 'attach_image',
            'group' => __( 'General', 'norebro-extra' ),
            'heading' => __( 'Image', 'norebro-extra' ),
            'param_name' => 'image_url',
            'description' => __( 'Choose your image.', 'norebro-extra' ),
        ),
        array(
            'type' => 'norebro_choose_box',
            'group' => __( 'General', 'norebro-extra' ),
            'heading' => __( 'Alignment', 'norebro-extra' ),
            'param_name' => 'alignment',
            'value' => array(
                array(
                    'icon' => plugin_dir_url( __FILE__ ) . 'images/param_alignment_left.png',
                    'key' => 'left',
                    'title' => __( 'Left', 'norebro-extra' ),
                ),
                array(
                    'icon' => plugin_dir_url( __FILE__ ) . 'images/param_alignment_center.png',
                    'key' => 'center',
                    'title' => __( 'Center', 'norebro-extra' ),
                ),
                array(
                    'icon' => plugin_dir_url( __FILE__ ) . 'images/param_alignment_right.png',
                    'key' => 'right',
                    'title' => __( 'Right', 'norebro-extra' ),
                )
            )
        ),
        /*array(
            'type' => 'norebro_choose_box',
            'group' => __( 'General', 'norebro-extra' ),
            'heading' => __( 'Floating', 'norebro-extra' ),
            'param_name' => 'float',
            'value' => array(
                array(
                    'icon' => plugin_dir_url( __FILE__ ) . 'images/vs_settings_icon75.png',
                    'key' => 'left',
                    'title' => __( 'Left', 'norebro-extra' ),
                ),
                array(
                    'icon' => plugin_dir_url( __FILE__ ) . 'images/vs_settings_icon73.png',
                    'key' => 'both',
                    'title' => __( 'Both', 'norebro-extra' ),
                ),
                array(
                    'icon' => plugin_dir_url( __FILE__ ) . 'images/vs_settings_icon73.png',
                    'key' => 'right',
                    'title' => __( 'Right', 'norebro-extra' ),
                )
            ),
        ),*/
        array(
            'type' => 'textfield',
            'group' => __( 'General', 'norebro-extra' ),
            'heading' => __( 'Title', 'norebro-extra' ),
            'param_name' => 'title',
            'description' => __( 'Used for <em>title</em> and <em>alt</em> attributs.', 'norebro-extra' ),
        ),
        array(
            'type' => 'dropdown',
            'group' => __( 'Styles and Colors', 'norebro-extra' ),
            'heading' => __( 'Appearance effect', 'norebro-extra' ),
            'param_name' => 'appearance_effect',
            'value' => array(
                __( 'None', 'norebro-extra' ) => 'none',
                __( 'Fade up', 'norebro-extra' ) => 'fade-up',
                __( 'Fade down', 'norebro-extra' ) => 'fade-down',
                __( 'Fade right', 'norebro-extra' ) => 'fade-right',
                __( 'Fade left', 'norebro-extra' ) => 'fade-left',
                __( 'Flip up', 'norebro-extra' ) => 'flip-up',
                __( 'Flip down', 'norebro-extra' ) => 'flip-down',
                __( 'Zoom in', 'norebro-extra' ) => 'zoom-in',
                __( 'Zoom out', 'norebro-extra' ) => 'zoom-out'
            )
        ),
        array(
            'type' => 'textfield',
            'group' => __( 'Styles and Colors', 'norebro-extra' ),
            'heading' => __( 'Appearance effect duration', 'norebro-extra' ),
            'param_name' => 'appearance_duration',
            'description' => __( 'Duration accept values from 50 to 3000(ms), with step 50.', 'norebro-extra' ),
        ),
        array(
            'type' => 'textfield',
            'group' => __( 'Styles and Colors', 'norebro-extra' ),
            'heading' => __( 'Custom CSS class', 'norebro-extra' ),
            'param_name' => 'css_class',
            'description' => __( 'If you want to add styles to a specific unit, use this field to add CSS class.', 'norebro-extra' )
        )
    )
) );