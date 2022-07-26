<?php
/**
 * Block: Hero
 *
 * @package gmmb-cli
 */

$background = get_field( 'hero_background_image' );
$heading    = get_field( 'hero_heading' );
?>

<article class="hero" style="background-image: url('<?php echo esc_url( $background ); ?>')">
	<?php 
	if ( 'story' === get_post_type() ) {
		get_template_part( 'partials/breadcrumbs', null, array( 'style' => 'transparent' ) );
	} 
	?>

	<div class="content container container--padded container--max-width">
		<h1 class="hero__heading"><?php echo esc_html( $heading ); ?></h1>
	</div>
</article>
