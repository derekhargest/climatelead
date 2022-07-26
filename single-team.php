<?php
/**
 * Single Team
 *
 * @package gmmb-cli
 */

the_post();
$title = get_field( 'team_member_title' );
$organization = get_field( 'team_member_organization' );

get_template_part('partials/breadcrumbs', null, array( 'style' => 'gray' ) );
?>
<article class="team-bio content container container--padded container--max-width">
	<div class="team-bio__content">
		<div class="team-bio__top">
			<h1 class="team-bio__heading"><?php echo esc_html( get_the_title() ); ?></h1>
			<?php if ( $title ) : ?>
				<p class="team-bio__title"><?php echo esc_html( $title ); ?></p>
			<?php endif; ?>
		</div>

		<?php if ( $organization ) : ?>
			<p class="team-bio__organization"><?php echo esc_html( $organization ); ?></p>
		<?php endif; ?>

		<?php if ( has_post_thumbnail( get_the_ID() ) ) : ?>
			<div class="team-bio__image team-bio__image--mobile">
				<?php echo get_the_post_thumbnail( get_the_ID(), 'large' ); ?>
			</div>
		<?php endif; ?>

		<div class="team-bio__copy wysiwyg"><?php echo wp_kses_post( wpautop( get_the_content() ) ); ?></div>
	</div>

	<?php if ( has_post_thumbnail( get_the_ID() ) ) : ?>
		<div class="team-bio__image team-bio__image--desktop">
			<?php echo get_the_post_thumbnail( get_the_ID(), 'large' ); ?>
		</div>
	<?php endif; ?>

</article>

<?php get_template_part( 'partials/blocks/link-cards' ); ?>
