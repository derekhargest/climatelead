<?php
/**
 * Admin Cleanup
 *
 * @package gmmb-cli
 */

/**
 * Remove unnecessary dashboard meta boxes
 */
function mg_remove_dashboard_widgets() {
	// remove_meta_box('dashboard_right_now', 'dashboard', 'normal');       // Right Now.
	remove_meta_box( 'dashboard_recent_comments', 'dashboard', 'normal' );    // Recent Comments.
	remove_meta_box( 'dashboard_incoming_links', 'dashboard', 'normal' );     // Incoming Links.
	remove_meta_box( 'dashboard_plugins', 'dashboard', 'normal' );            // Plugins.
	remove_meta_box( 'dashboard_quick_press', 'dashboard', 'side' );          // Quick Press.
	remove_meta_box( 'dashboard_recent_drafts', 'dashboard', 'side' );        // Recent Drafts.
	remove_meta_box( 'dashboard_primary', 'dashboard', 'side' );              // WordPress blog.
	remove_meta_box( 'dashboard_secondary', 'dashboard', 'side' );            // Other WordPress News.
}
add_action( 'wp_dashboard_setup', 'mg_remove_dashboard_widgets' );

/**
 * Unregisters unnecesary default widgets
 */
function mg_unregister_default_widgets() {
	unregister_widget( 'WP_Widget_Calendar' );
	unregister_widget( 'WP_Widget_Search' );
	unregister_widget( 'WP_Widget_Recent_Comments' );
	unregister_widget( 'WP_Widget_Meta' );
	unregister_widget( 'WP_Widget_Links' );
	unregister_widget( 'WP_Widget_Pages' );
	unregister_widget( 'WP_Widget_Archives' );
	unregister_widget( 'WP_Widget_Recent_Posts' );
	unregister_widget( 'WP_Widget_Tag_Cloud' );
	unregister_widget( 'WP_Widget_RSS' );
	unregister_widget( 'WP_Widget_Categories' );
	// unregister_widget('WP_Widget_Text');.
	unregister_widget( 'WP_Nav_Menu_Widget' );
	unregister_widget( 'GFWidget' );
}
add_action( 'widgets_init', 'mg_unregister_default_widgets' );

/**
 * Hide admin pages that are not used
 */
function mg_remove_menu_pages() {
	remove_menu_page( 'edit-comments.php' );    // Comments.
	remove_menu_page( 'edit.php' );             // Posts.
}
 add_action('admin_menu', 'mg_remove_menu_pages');

/**
 * Alters post types.
 */
function mg_alter_post_types() {
	add_post_type_support( 'page', 'excerpt' );
}
add_action( 'init', 'mg_alter_post_types' );

/**
 * Makes the excerpt field required.
 *
 * @param array $data An array of slashed, sanitized, and processed post data.
 *
 * @return array $data An array of slashed, sanitized, and processed post data.
 */
function mg_require_excerpt($data) {

	/** Run excerpts only on certain post types */
	if ( ( isset($data['post_type'] ) ) && ( isset($_REQUEST['action'] ) ) ) {
		$post_action = $_REQUEST['action'];

		if ( ( 'editpost' === $post_action ) ) {
			if ( empty( $data['post_excerpt'] ) ) {
				// No excerpt!
				if ( 'publish' === $data['post_status'] ) {
					add_filter( 'redirect_post_location', 'mg_excerpt_error_message_redirect', '99' );
				}
				// Change to draft
				$data['post_status'] = 'draft';
			}
		}
	}
	return $data;
}
add_filter( 'wp_insert_post_data', 'mg_require_excerpt' );

/**
 * Filters the post redirect destination URL.
 *
 * @param string $location The destination URL.
 *
 * @return string
 */
function mg_excerpt_error_message_redirect($location) {
	remove_filter( 'redirect_post_location', 'mg_excerpt_error_message_redirect', '99' );
	return add_query_arg( 'excerpt_required', 1, $location );
}

/**
 * Prints admin screen notices.
 */
function excerpt_admin_notice() {
	if ( ! isset( $_GET['excerpt_required'] ) ) {
		return;
	}

	switch ( $_GET['excerpt_required'] ) {
		case 1:
			$message = 'Excerpt is required to publish a post.';
			break;
		default:
			$message = 'Unexpected error.';
	}

	echo '<div id="notice" class="error"><p>' . $message . '</p></div>';
}
add_action( 'admin_notices', 'excerpt_admin_notice' );

/**
 * Filters the post updated messages.
 *
 * @param array $messages Post updated messages.
 *
 * @return array
 *
 * @link https://developer.wordpress.org/reference/hooks/post_updated_messages/
 */
function mg_filter_post_update_messages($messages) {
	// Unset certain notices that could be triggered  to not confuse users if we've set our error for missing excerpt.
	if ( $_GET['excerpt_required'] ) {
		// Post settings.
		unset( $messages['post'][6]) ;
		unset( $messages['post'][10] );
		// Page settings.
		unset( $messages['page'][6]) ;
		unset( $messages['page'][10] );
	}
	return $messages;
}
add_filter('post_updated_messages', 'mg_filter_post_update_messages');


