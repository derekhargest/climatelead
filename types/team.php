<?php
/**
 * Team Custom Post Type.
 *
 * @package gmmb-cli
 */

$singular         = 'Team Member';
$plural           = 'Team Members';
$custom_post_type = 'team';
$lower_plural     = 'team members';

$labels = array(
	'name'               => $plural,
	'singular_name'      => $singular,
	'add_new'            => 'Add ' . $singular,
	'add_new_item'       => 'Add New ' . $singular,
	'edit_item'          => 'Edit ' . $singular,
	'new_item'           => 'New ' . $singular,
	'view_item'          => 'View ' . $singular,
	'search_items'       => 'Search for ' . $plural,
	'not_found'          => 'No ' . $plural . ' Found',
	'not_found_in_trash' => 'No ' . $plural . ' Found in Trash',
	'menu_name'          => $plural,
	'back_to_items'      => 'Back to ' . $lower_plural,
);

$args = array(
	'labels'              => $labels,
	'description'         => 'Custom post type for ' . $lower_plural,
	'public'              => true,
	'exclude_from_search' => false,
	'publicly_queryable'  => true,
	'show_ui'             => true,
	'show_in_nav_menus'   => false,
	'show_in_menu'        => true,
	'show_in_admin_bar'   => true,
	'menu_position'       => 10,
	'menu_icon'           => 'dashicons-groups', // https://developer.wordpress.org/resource/dashicons/.
	'capability_type'     => 'post',
	'hierarchical'        => false,
	'supports'            => array( 'title', 'editor', 'thumbnail', 'page-attributes', 'excerpt' ),
	'taxonomies'          => array(),
	'has_archive'         => false,
);

register_post_type( $custom_post_type, $args );
