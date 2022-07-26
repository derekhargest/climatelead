<?php
/**
 * Block: Image Text
 *
 * @package gmmb-cli
 */

$alignment = get_sub_field( 'image_text_alignment' );
$image     = get_sub_field( 'image_text_image' );
$heading   = get_sub_field( 'image_text_heading' );
$copy      = get_sub_field( 'image_text_copy' );
?>

<article class="image-text image-text--<?php echo esc_attr( $alignment ); ?>">
	<div class="image-text__inner content container container--padded container--max-width">
		<div class="image-text__image">
			<img src="<?php echo esc_url( $image['url'] ); ?>" alt="<?php echo esc_attr( $image['alt'] ); ?>" />
		</div>
		<div class="image-text__content">
			<?php if ( $heading ) : ?>
				<h2 class="image-text__heading"><?php echo esc_html( $heading ); ?></h2>
			<?php endif; ?>
			<div class="image-text__copy wysiwyg"><?php echo wp_kses_post( $copy ); ?></div>
		</div>
	</div>
</article>
