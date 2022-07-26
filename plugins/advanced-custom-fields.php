<?php
/**
 * Advanced Custom Fields plugin modifications
 *
 * @package gmmb-cli
 */

/**
 * Retrieves the url of an image uploaded via an ACF image field
 * TODO: Add support for return types other than array
 *
 * @param (string) $name The name of the ACF field - assume default return of image array is used.
 * @param (string) $size The size of the image to be retrieved.
 * @return (string) The image url ( defaults to original size )
 */
function mg_get_acf_image_src( $name, $size = 'thumbnail' ) {
	// Return false if ACF is not active.
	if ( ! function_exists( 'get_field' ) ) {
		return false;
	}

	$image_type  = get_field_object( $name )['return_format'];
	$image_value = ( get_row() ) ? get_sub_field( $name ) : get_field( $name );

	switch ( $image_type ) {
		case 'array':
			$image_url = mg_get_image_src_from_array( $image_value, $size );
			break;
		case 'id':
			$image_url = wp_get_attachment_image_url( $image_value, $size );
			break;
		case 'url':
			$image_url = wp_get_attachment_image_url( attachment_url_to_postid( $image_value ), $size );
			break;
		default:
			return false;
	}
	return $image_url;
}

/**
 * Echos the url of an image uploaded via an ACF image field
 *
 * @param (string) $name The name of the ACF field - assume default return of image object is used.
 * @param (string) $size The size of the image to be retrieved.
 */
function mg_the_acf_image_src( $name, $size = 'thumbnail' ) {
	echo esc_url( mg_get_acf_image_src( $name, $size ) );
}

/**
 * Adds ACF options pages.
 */
function mg_add_acf_options_page() {
	if ( function_exists( 'acf_add_options_page' ) ) {

		// Main parent menu entry.
		$parent = acf_add_options_page(
			array(
				'page_title' => 'Theme Options',
				'menu_title' => 'Theme Options',
				'menu_slug'  => 'theme-options',
				'capability' => 'edit_posts',
				'redirect'   => false,
			)
		);

		// Contact Us block settings.
		acf_add_options_sub_page(
			array(
				'page_title'  => 'Tracking Scripts',
				'menu_title'  => 'Tracking Scripts',
				'capability'  => 'edit_posts',
				'parent_slug' => $parent['menu_slug'],
			)
		);
	}
}
add_action( 'acf/init', 'mg_add_acf_options_page' );

/**
 * Add or alter existing toolbars for ACF WYSIWYG.
 *
 * @param array $toolbars ACF WYSIWYG toolbars.
 *
 * @return mixed
 */
function mg_acf_wysiwyg_toolbars( $toolbars ) {
	$toolbars['Basic'][1] = array( 'styleselect', 'formatselect', 'bold', 'italic', 'underline', 'link', 'bullist', 'numlist' );

	return $toolbars;
}
add_filter( 'acf/fields/wysiwyg/toolbars', 'mg_acf_wysiwyg_toolbars' );

/**
 * Dynamically populate the service form field.
 *
 * @link https://www.advancedcustomfields.com/resources/dynamically-populate-a-select-fields-choices/
 *
 * @param array $field The current field array.
 *
 * @return mixed
 */
function mg_load_gform_field_choices( $field ) {
	// Ensure the gravity form api class exists.
	if ( ! class_exists( 'GFAPI' ) ) {
		return $field;
	}

	// Reset choices.
	$field['choices'] = array();

	// Get all gravity forms.
	$forms = GFAPI::get_forms();

	// Add each form to choices array.
	if ( is_array( $forms ) ) {
		foreach( $forms as $form ) {
			$field['choices'][ $form['id'] ] = $form['title'];
		}
	}

	return $field;
}

add_filter('acf/load_field/name=services_service_form', 'mg_load_gform_field_choices');
add_filter('acf/load_field/name=contact_us_gravity_form', 'mg_load_gform_field_choices');
add_filter('acf/load_field/name=form_settings_new_tab', 'mg_load_gform_field_choices');
