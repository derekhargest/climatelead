<?php
/**
 * Single
 *
 * @package gmmb-cli
 */

the_post();

get_template_part( 'partials/blocks/hero' );

if ( have_rows('flex_content') ) { // phpcs:ignore
	while ( have_rows( 'flex_content' ) ) {
		the_row();
		if ( 'services' === get_row_layout() ) {
			get_template_part('partials/blocks/' . get_row_layout(),null, array( // phpcs:ignore
				'instance_id' => get_row_index()
			)); // phpcs:ignore
		} else {
			get_template_part( 'partials/blocks/' . get_row_layout() );
		}
	}
}
