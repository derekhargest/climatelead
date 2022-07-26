<?php
/**
 * Block: Logo Grid
 *
 * @package gmmb-cli
 */

if ( ( is_page() && ! is_front_page() ) || is_single() ) {
	$heading = get_sub_field( 'logo_grid_heading' );
} else {
	$heading = get_field( 'logo_grid_heading' );
}
?>

<article class="logo-grid content container container--padded container--max-width">
	<h2 class="logo-grid__heading"><?php echo esc_html( $heading ); ?></h2>
	<div class="logo-grid__grid">
		<?php 
		while ( have_rows( 'logo_grid_logos' ) ) :
			the_row();
			$image       = get_sub_field( 'logo_grid_logo' );
			$link        = get_sub_field( 'logo_grid_link' );
			$link_url    = $link['url'];
			$link_target = $link['target'] ? $link['target'] : '_self';
			?>
			<a class="logo-grid__logo" href="<?php echo esc_url( $link_url ); ?>" target="<?php echo esc_attr( $link_target ); ?>"
			aria-label="<?php echo sprintf( __( '%s. Click to learn more.', 'gmmb-cli' ), $image['alt'] ); ?>">
				<img src="<?php echo esc_url( $image['url'] ); ?>" alt="<?php echo esc_attr( $image['alt'] ); ?>" />
			</a>
		<?php endwhile; ?>
	</div>
</article>

