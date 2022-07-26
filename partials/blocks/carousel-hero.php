<?php
/**
 * Block: Carousel Hero
 *
 * @package gmmb-cli
 */

$images = get_field( 'carousel_hero_images' );
$text   = get_field( 'carousel_hero_text' );

?>

<article class="carousel-hero">
	<div class="carousel-hero__slider">
		<?php foreach ( $images as $image_id ) : ?>
			<div class="carousel-hero__slide">
				<?php echo wp_get_attachment_image( $image_id, 'carousel-hero' ); ?>
			</div>
		<?php endforeach; ?>
	</div>
	<h1 class="carousel-hero__heading content container container--padded"><?php echo esc_html( $text ); ?></h1>
	<button class="carousel-hero__toggle carousel-hero__toggle--pause" aria-label="<?php esc_attr_e( 'Pause Carousel', 'gmmb-cli' ); ?>"></button>
</article>

