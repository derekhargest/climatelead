<?php
/**
 * Team Category.
 *
 * @package gmmb-cli
 */

$singular      = 'Team Category';
$plural        = 'Team Categories';
$taxonomy_name = 'team_category';

$labels = array(
	'name'                       => $plural,
	'singular_name'              => $singular,
	'search_terms'               => 'Search ' . $plural,
	'popular_terms'              => 'Popular ' . $plural,
	'all_items'                  => 'All ' . $plural,
	'parent_item'                => 'Parent ' . $singular,
	'parent_item_colon'          => 'Parent ' . $singular . ':',
	'edit_item'                  => 'Edit ' . $singular,
	'update_item'                => 'Update ' . $singular,
	'add_new_item'               => 'Add New ' . $singular,
	'new_item_name'              => 'New ' . $singular . ' Name',
	'separate_items_with_commas' => 'Separate ' . $plural . ' with commas',
	'add_or_remove_items'        => 'Add or remove ' . $plural,
	'choose_from_most_used'      => 'Choose from the most used ' . $plural,
	'menu_name'                  => $plural,
);

$args = array(
	'labels'             => $labels,
	'public'             => false,
	'publicly_queryable' => true,
	'show_in_nav_menus'  => true,
	'show_ui'            => true,
	'hierarchical'       => true,
	'rewrite'            => array( 'slug' => $taxonomy_name ),
);

register_taxonomy( $taxonomy_name, 'team', $args );
