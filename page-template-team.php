<?php
/**
 * Template Name: Team
 * Template Post Type: page
 *
 * @package gmmb-cli
 */

the_post();

get_template_part( 'partials/blocks/hero' );
get_template_part( 'partials/blocks/copy-block' );
get_template_part( 'partials/blocks/team-cards' );
