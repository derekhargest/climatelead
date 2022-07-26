<?php
/**
 * Block: Icon List
 *
 * @package gmmb-cli
 */

$heading      = get_field( 'outcome_cards_heading' );
$intro_text   = get_field( 'outcome_cards_intro_text' );
$wrap_up_text = get_field( 'outcome_cards_wrap_up_text' );
?>

<article class="outcome-cards">
	<div class="outcome-cards__inner content container container--padded container--max-width">
		<h2 class="outcome-cards__heading"><?php echo esc_html( $heading ); ?></h2>

		<?php if ( $intro_text ) : ?>
			<div class="outcome-cards__intro wysiwyg"><?php echo wp_kses_post( $intro_text ); ?></div>
		<?php endif; ?>

		<div class="outcome-cards__cards cards cards--outcome">
			<?php
			while ( have_rows( 'outcome_cards_cards' ) ) :
				the_row();
				$heading = get_sub_field( 'outcome_cards_card_heading' );
				$text    = get_sub_field( 'outcome_cards_card_description' );
				?>
				<div class="card">
					<div class="card__inner">
						<p class="card__heading"><?php echo esc_html( $heading ); ?></p>
						<div class="card__text wysiwyg"><?php echo wp_trim_words( wp_kses_post( $text ), 50, '&hellip;' ); ?></div>
					</div>
				</div>
			<?php endwhile; ?>
		</div>

		<?php if ( $wrap_up_text ) : ?>
			<div class="outcome-cards__wrap wysiwyg"><?php echo wp_kses_post( $wrap_up_text ); ?></div>
		<?php endif; ?>
	</div>
</article>
