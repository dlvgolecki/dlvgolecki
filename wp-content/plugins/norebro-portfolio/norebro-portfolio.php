<?php
/*
	Plugin Name: Norebro Portfolio
	Plugin URI: http://norebro.colabr.io/
	Description: Create and add personal portfolio to your website with Norebro theme.
	Version: 1.0.5
	Author: colabrio
	Author URI: http://norebro.colabr.io/
*/

/*  Copyright 2017 colabrio (email: team@colabr.io)

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation; either version 2 of the License, or
    (at your option) any later version.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/

add_action( 'plugins_loaded', 'norebro_portfolio_load_plugin_textdomain' );

function norebro_portfolio_load_plugin_textdomain() {
	load_plugin_textdomain( 'norebro_portfolio', false, dirname( plugin_basename( __FILE__ ) ) . '/languages/' );
}


add_action( 'init', 'norebro_portfolio_register_my_cpts' );

function norebro_portfolio_register_my_cpts() {
	$labels = array(
		"name" => __( 'Portfolio', 'norebro_portfolio' ),
		"singular_name" => __( 'Portfolio', 'norebro_portfolio' ),
		"menu_name" => __( 'Portfolio', 'norebro_portfolio' ),
		"all_items" => __( 'All Projects', 'norebro_portfolio' ),
		"add_new" => __( 'Add New', 'norebro_portfolio' ),
		"add_new_item" => __( 'Add New Portfolio Project', 'norebro_portfolio' ),
		"edit_item" => __( 'Edit Project', 'norebro_portfolio' ),
		"new_item" => __( 'New Portfolio Project', 'norebro_portfolio' ),
		"view_item" => __( 'View Project', 'norebro_portfolio' ),
		"search_items" => __( 'Search Projects', 'norebro_portfolio' ),
		"not_found" => __( 'No projects found', 'norebro_portfolio' ),
		"not_found_in_trash" => __( 'No projects found in Trash', 'norebro_portfolio' ),
		"parent_item_colon" => __( 'Parent Portfolio:', 'norebro_portfolio' ),
		"featured_image" => __( 'Featured image for this project', 'norebro_portfolio' ),
		"set_featured_image" => __( 'Set featured image for this project', 'norebro_portfolio' ),
		"remove_featured_image" => __( 'Remove featured image for this project', 'norebro_portfolio' ),
		"use_featured_image" => __( 'Use featured image for this project', 'norebro_portfolio' ),
		"archives" => __( 'Portfolio projects archive', 'norebro_portfolio' ),
		"insert_into_item" => __( 'Insert into project', 'norebro_portfolio' ),
		"uploaded_to_this_item" => __( 'Upload to this project', 'norebro_portfolio' ),
		"filter_items_list" => __( 'Filter projects', 'norebro_portfolio' ),
		"items_list_navigation" => __( 'Portfolio projects list navigation', 'norebro_portfolio' ),
		"items_list" => __( 'Portfolio projects list', 'norebro_portfolio' ),
		"parent_item_colon" => __( 'Parent Portfolio:', 'norebro_portfolio' ),
	);

	$args = array(
		"label" => __( 'Portfolio', 'norebro_portfolio' ),
		"labels" => $labels,
		"description" => __( "Portfolio post type for Norebro theme.", "norebro_portfolio" ),
		"public" => true,
		"publicly_queryable" => true,
		"show_ui" => true,
		"show_in_rest" => true,
		"rest_base" => "",
		"has_archive" => false,
		"show_in_menu" => true,
		"exclude_from_search" => false,
		"capability_type" => "post",
		"map_meta_cap" => true,
		"hierarchical" => false,
		"rewrite" => array( "slug" => "project", "with_front" => true ),
		"query_var" => true,
		"menu_position" => 5,
		"menu_icon" => "dashicons-portfolio",
		"supports" => array( "title", "editor", "thumbnail", "comments" ),
	);

	register_post_type( "norebro_portfolio", $args );
}

function norebro_portfolio_category_init() {
	$labels = array(
		'name' => _x( 'Categories', 'taxonomy general name', 'norebro_portfolio' ),
		'singular_name' => _x( 'Category', 'taxonomy singular name', 'norebro_portfolio' ),
		'search_items' => __( 'Search Categories', 'norebro_portfolio' ),
		'popular_items' => __( 'Popular Categories', 'norebro_portfolio' ),
		'all_items' => __( 'Categories', 'norebro_portfolio' ),
		'parent_item' => null,
		'parent_item_colon' => null,
		'edit_item' => __( 'Edit Category', 'norebro_portfolio' ),
		'update_item' => __( 'Update Category', 'norebro_portfolio' ),
		'add_new_item' => __( 'Add New Category', 'norebro_portfolio' ),
		'new_item_name' => __( 'New Portfolio Category', 'norebro_portfolio' ),
		'separate_items_with_commas' => __( 'Separate categories with commas', 'norebro_portfolio' ),
		'add_or_remove_items' => __( 'Add or remove categories', 'norebro_portfolio' ),
		'choose_from_most_used' => __( 'Choose from the most used categories', 'norebro_portfolio' ),
		'not_found' => __( 'No categories found.', 'norebro_portfolio' ),
		'menu_name' => __( 'Categories', 'norebro_portfolio' ),
	);

	$args = array(
		'hierarchical' => true,
		'labels' => $labels,
		'show_ui' => true,
		'show_admin_column' => true,
		'update_count_callback' => '_update_post_term_count',
		'query_var' => true,
		'rewrite' => array( 'slug' => 'portfolio_category' ),
	);

	register_taxonomy( 'norebro_portfolio_category', array( 'norebro_portfolio' ), $args );

	$labels = array(
		'name' => _x( 'Tags', 'taxonomy general name', 'norebro_portfolio' ),
		'singular_name' => _x( 'Tag', 'taxonomy singular name', 'norebro_portfolio' ),
		'search_items' => __( 'Search Tags', 'norebro_portfolio' ),
		'popular_items' => __( 'Popular Tags', 'norebro_portfolio' ),
		'all_items' => __( 'Tags', 'norebro_portfolio' ),
		'parent_item' => null,
		'parent_item_colon' => null,
		'edit_item' => __( 'Edit Tag', 'norebro_portfolio' ),
		'update_item' => __( 'Update Tag', 'norebro_portfolio' ),
		'add_new_item' => __( 'Add New Tag', 'norebro_portfolio' ),
		'new_item_name' => __( 'New Portfolio Tag', 'norebro_portfolio' ),
		'separate_items_with_commas' => __( 'Separate tags with commas', 'norebro_portfolio' ),
		'add_or_remove_items' => __( 'Add or remove tags', 'norebro_portfolio' ),
		'choose_from_most_used' => __( 'Choose from the most used tags', 'norebro_portfolio' ),
		'not_found' => __( 'No tags found.', 'norebro_portfolio' ),
		'menu_name' => __( 'Tags', 'norebro_portfolio' ),
	);

	$args = array(
		'hierarchical' => false,
		'labels' => $labels,
		'show_ui' => true,
		'show_admin_column' => true,
		'update_count_callback' => '_update_post_term_count',
		'query_var' => true,
		'rewrite' => array( 'slug' => 'portfolio_tags' ),
	);

	register_taxonomy( 'norebro_portfolio_tags', array( 'norebro_portfolio' ), $args );
}

add_action( 'init', 'norebro_portfolio_category_init' );


function norebro_portfolio_flush() {
	flush_rewrite_rules(); // Fix 404 page on projects. Flush rules
}

register_activation_hook( __FILE__, 'norebro_portfolio_flush' );


function norebro_portfolio_template_redirect()
{
    if (is_singular('norebro_portfolio')) {
        global $wp_query;
        $page = (int)$wp_query->get('page');
        if ($page > 1) {
            $query->set('page', 1);
            $query->set('paged', $page);
        }
        remove_action('template_redirect', 'redirect_canonical');
    }
}

add_action('template_redirect', 'norebro_portfolio_template_redirect', 0);


?>
