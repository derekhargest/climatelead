<?php
/**
 * Template Name: Contact
 * Template Post Type: page
 *
 * @package gmmb-cli
 */

the_post();

$form = get_field( 'contact_us_gravity_form' );

get_template_part( 'partials/blocks/hero' );
get_template_part( 'partials/blocks/copy-block' );
?>

<div class="contact-form content container container--padded container--max-width">
	<?php if ( function_exists( 'gravity_form' ) ) { // phpcs:ignore
		gravity_form( $form, false, true, false, '', true );
	} // phpcs:ignore ?>
</div>
