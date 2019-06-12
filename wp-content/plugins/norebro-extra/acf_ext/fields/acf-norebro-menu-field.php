<?php

// exit if accessed directly
if( ! defined( 'ABSPATH' ) ) exit;


// check if class already exists
if( !class_exists('norebro_acf_field_menu') ) :


    class norebro_acf_field_menu extends acf_field
    {
        function __construct()
        {
            $this->name = 'norebro_menu';
            $this->label = __('Norebro Menu');
            $this->category = __("Basic", 'acf');

            parent::__construct();
        }

        function render_field( $field ) {

            echo '<select id="' . $field['name'] . '" name="' . $field['name'] . '">';
            echo '<option value="">' . __('Choose menu', 'norebro-extra') . '</option>';

            foreach ( wp_get_nav_menus() as $menu )
            {
                echo '<option value="' . $menu->term_id . ( $menu->term_id == $field['value'] ? '" selected="selected">' : '">' ) . $menu->name . '</option>';
            }
            echo '</select>';
        }

    }

// initialize
    new norebro_acf_field_menu();

// class_exists check
endif;