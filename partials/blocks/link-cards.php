<?php
/**
 * Block: Link Cards
 *
 * @package gmmb-cli
 */

if ( ( is_page() && ! is_front_page() ) || ( is_single() && ! is_singular( 'team' ) ) ) {
	$background = get_sub_field( 'link_cards_background_color' );
	$style      = get_sub_field( 'link_cards_style' );
	$heading    = get_sub_field( 'link_cards_heading' );
	$status     = get_sub_field( 'link_cards_status' );
} else {
	$background = get_field( 'link_cards_background_color' );
	$style      = get_field( 'link_cards_style' );
	$heading    = get_field( 'link_cards_heading' );
	$status     = get_field( 'link_cards_status' );
}
$cards_classes  = 'cards--' . $style;
$cards_classes .= ( 'white' === $background ) ? ' cards--gray' : '';
?>

<?php if ( $status ) : ?>
	<article class="link-cards link-cards--<?php echo esc_attr( $background ); ?>">
		<div class="content container container--padded container--max-width">
			<?php if ( $heading ) : ?>
				<h2 class="link-cards__heading"><?php echo esc_html( $heading ); ?></h2>
			<?php endif; ?>

			<div class="cards <?php echo esc_attr( $cards_classes ); ?>">
				<?php 
				while ( have_rows( 'link_cards_cards' ) ) :
					the_row();
					$image       = get_sub_field( 'link_cards_image' );
					$heading     = get_sub_field( 'link_cards_card_heading' );
					$text        = get_sub_field( 'link_cards_card_text' );
					$link        = get_sub_field( 'link_cards_card_link' );
					$link_url    = $link['url'];
					$link_title  = $link['title'];
					$link_target = $link['target'] ? $link['target'] : '_self';
					?>
					<div class="card">
						<?php if ( $link ) : ?>
							<a class="card__link" href="<?php echo esc_url( $link_url ); ?>" target="<?php echo esc_attr( $link_target ); ?>"
							aria-label="<?php echo sprintf( __( '%s. Click to learn more.', 'gmmb-cli' ), $heading ); ?>"></a>
						<?php endif; ?>

						<?php if ( 'images' === $style ) : ?>
							<div class="card__image">
								<?php echo wp_get_attachment_image( $image, 'full' ); ?>
							</div>
						<?php else : ?>
							<div class="card__banner"></div>
						<?php endif; ?>

						<div class="card__inner">
							<?php if ( $heading ) : ?>
								<p class="card__heading"><?php echo esc_html( $heading ); ?></p>
							<?php endif; ?>

							<div class="card__text wysiwyg">
								<?php echo wp_kses_post( $text ); ?>
							</div>

							<?php if ( $link ) : ?>
								<p class="card__link-text"><?php echo esc_html( $link_title ); ?></p>
							<?php endif; ?>
						</div>
					</div>
				<?php endwhile; ?>
			</div>
		</div>
	</article>
<?php endif; ?>
