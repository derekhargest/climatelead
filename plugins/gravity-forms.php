<?php
/**
 * Gravity Forms plugin modifications
 *
 * @package gmmb-cli
 */

/**
 * Changes the default Gravity Forms AJAX spinner
 *
 * @since 1.0.0
 *
 * @param string $src  The default spinner URL.
 * @return string $src The new spinner URL.
 */
function mg_custom_gforms_spinner( $src ) {
	return get_stylesheet_directory_uri() . '/dist/images/loading.gif';
}
add_filter( 'gform_ajax_spinner_url', 'mg_custom_gforms_spinner' );

/**
 * Remove default Gravity Forms styles and scripts
 */
function mg_remove_gforms_styles_and_scripts() {
	// CSS stylesheets.
	wp_deregister_style( 'gforms_formsmain_css' );
	wp_deregister_style( 'gforms_reset_css' );
	wp_deregister_style( 'gforms_ready_class_css' );
	wp_deregister_style( 'gforms_browsers_css' );

	// These are the scripts.
	// NOTE: Gravity forms automatically includes only the scripts it needs, so be careful here.
	// wp_deregister_script("gforms_conditional_logic_lib");.
	// wp_deregister_script("gforms_ui_datepicker");.
	// wp_deregister_script("gforms_gravityforms");.
	// wp_deregister_script("gforms_character_counter");.
	// wp_deregister_script("gforms_json");.
	// wp_deregister_script("jquery");.
}
add_action( 'gform_enqueue_scripts', 'mg_remove_gforms_styles_and_scripts' );

/**
 * Adds custom classes to gform submit buttons.
 *
 * @param $button
 * @param $form
 * @return false|string
 */
function mg_custom_css_classes( $button, $form ) {
	$dom = new DOMDocument();
	$dom->loadHTML( '<?xml encoding="utf-8" ?>' . $button );
	$input = $dom->getElementsByTagName( 'input' )->item(0);
	$classes = $input->getAttribute( 'class' );
	$classes .= " btn btn--primary";
	$input->setAttribute( 'class', $classes );
	return $dom->saveHtml( $input );
}
add_filter( 'gform_submit_button', 'mg_custom_css_classes', 10, 2 );
