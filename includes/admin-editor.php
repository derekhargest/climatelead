<?php
/**
 * Admin Editor
 *
 * @package gmmb-cli
 */


/**
 * Filters the TinyMCE config before init.
 *
 * @link https://codex.wordpress.org/TinyMCE_Custom_Styles
 *
 * @param array $mce_init An array with TinyMCE config.
 *
 * @return mixed
 */
function mg_mce_before_init( $mce_init ) {
	// Custom formats.
	$style_formats = array(
		array(
			'title'   => 'Color: Teal',
			'inline'  => 'span',
			'classes' => 'font-teal',
			'wrapper' => true,
		),
		array(
			'title'   => 'Color: Dark Teal',
			'inline'  => 'span',
			'classes' => 'font-dark-teal',
			'wrapper' => true,
		),
		array(
			'title'   => 'Large Font',
			'block'   => 'span',
			'classes' => 'font-large',
		),
	);

	// Insert the array, JSON ENCODED, into 'style_formats'.
	$mce_init['style_formats'] = wp_json_encode( $style_formats );

	// Remove H1 and <pre> from the available formats.
	$mce_init['block_formats'] = 'Paragraph=p;Heading 2=h2;Heading 3=h3;Heading 4=h4;Heading 5=h5;Heading 6=h6';

	return $mce_init;

}
add_filter( 'tiny_mce_before_init', 'mg_mce_before_init' );

/* Arrange WP Editor Toolbar Buttons */
add_filter( 'mce_buttons', 'my_wpeditor_buttons', 10, 2 );

/**
 * Add Buttons To WP Editor Toolbar.
 */
function my_wpeditor_buttons( $buttons, $editor_id ){
	/* Add it as first item in the row */
	array_unshift( $buttons, 'styleselect' );
	return $buttons;
}

/**
 * Hide the default content editor on certain pages.
 */
function mg_hide_content_editor() {
	if ( is_admin() && isset( $_GET['post'] ) ) { // phpcs:ignore
		$types_to_remove_editor = array(
			'page'
		);
		$is_post_type_to_remove = in_array( get_post_type( $_GET['post'] ), $types_to_remove_editor );

		if ( $is_post_type_to_remove ) {
			remove_post_type_support( 'page', 'editor' );
		}
	}
}
add_action( 'admin_init', 'mg_hide_content_editor' );
