<?php
/**
 * Block: Text Quote
 *
 * @package gmmb-cli
 */

$heading  = get_field( 'text_quote_heading' );
$text     = get_field( 'text_quote_text' );
$quote    = get_field( 'text_quote_quote' );
$citation = get_field( 'text_quote_quote_citation' );
?>

<article class="text-quote content container container--padded container--max-width">
	<div class="text-quote__left">
		<?php if ( $heading ) : ?>
			<h2 class="text-quote__heading"><?php echo esc_html( $heading ); ?></h2>
		<?php endif; ?>

		<div class="text-quote__text wysiwyg"><?php echo wp_kses_post( $text ); ?></div>
	</div>

	<div class="text-quote__right">
		<div class="text-quote__quote"><?php echo wp_trim_words( wp_kses_post( $quote ), 50, '&hellip;' ); // phpcs:ignore ?></div>
		<p class="text-quote__citation"><?php echo esc_html( $citation ); ?></p>
	</div>
</article>

