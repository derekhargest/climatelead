<?php
/**
 * Block: Copy Block
 *
 * @package gmmb-cli
 */
$template = get_page_template_slug();

if ( ( is_page() && ! is_front_page() && empty( $template ) ) || is_single() ) {
	$background = get_sub_field( 'copy_block_background_color' );
	$text       = get_sub_field( 'copy_block_text' );
} else {
	$background = get_field( 'copy_block_background_color' );
	$text       = get_field( 'copy_block_text' );
}

if ( 'page-template-contact.php' === $template ) {
	$container_class  = 'container--max-width';
	$container_class .= ' content--pb-0';
} else {
	$container_class = 'container--narrow-width';
}
?>

<article class="copy-block copy-block--<?php echo esc_attr( $background ); ?>">
	<div class="content container container--padded <?php echo esc_attr( $container_class ); ?> wysiwyg wysiwyg--large-font">
		<?php echo wp_kses_post( $text ); ?>
	</div>
</article>
