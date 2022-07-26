<?php
/**
 * Block: Team Cards
 *
 * @package gmmb-cli
 */

$sort          = get_field( 'team_cards_sort' );
$team_category = get_field( 'team_cards_category' );
$paged         = get_query_var( 'paged' );

$args = array(
	'post_type'      => 'team',
	'posts_per_page' => 12,
);

// Add category to query, if supplied.
if ( $team_category ) {
	$args['tax_query'] = array(
		array(
			'taxonomy' => 'team_category',
			'field'    => 'term_id',
			'terms'    => $team_category,
		),
	);
}

// Account for sort.
if ( 'alphabetically' === $sort ) {
	$args['orderby'] = 'wpse_last_word';
	$args['order']   = 'ASC';
} else {
	$args['orderby'] = 'menu_order';
	$args['order']   = 'DESC';
}

// Add paged.
if ( $paged ) {
	$args['paged'] = $paged;
}

$team_members = new WP_Query( $args );
?>

<article class="team-cards content container container--padded container--max-width">
	<?php if ( $team_members->have_posts() ) : ?>
		<div class="cards cards--gray cards--team">
			<?php 
			while ( $team_members->have_posts() ) :
				$team_members->the_post();
				$heading      = get_the_title();
				$title        = get_field( 'team_member_title', get_the_ID() );
				$organization = get_field( 'team_member_organization', get_the_ID() );
				?>
				<div class="card">
					<a class="card__link" href="<?php echo esc_url( get_the_permalink() ); ?>"
					   aria-label="<?php echo sprintf( __( '%s. Click to view full bio.', 'gmmb-cli' ), $heading ); ?>"></a>

					<div class="card__inner">
						<?php if ( has_post_thumbnail( get_the_ID() ) ) : ?>
							<div class="card__image">
								<?php echo get_the_post_thumbnail( get_the_ID(), 'large' ); ?>
							</div>
						<?php endif; ?>

						<div class="card__content">
							<p class="card__heading"><?php echo esc_html( $heading ); ?></p>

							<?php if ( $title ) : ?>
								<p class="card__title"><?php echo esc_html( $title ); ?></p>
							<?php endif; ?>

							<?php if ( $organization ) : ?>
								<p class="card__organization"><?php echo esc_html( $organization ); ?></p>
							<?php endif; ?>

							<div class="card__text wysiwyg">
								<?php echo wp_trim_words( get_the_excerpt(), 30 ); ?>
							</div>

							<p class="card__link-text"><?php esc_html_e( 'View Full Bio', 'gmmb-cli' ); ?></p>
						</div>
					</div>
				</div>
			<?php endwhile; ?>
		</div>

		<div class="pagination pagination--team">
			<?php echo paginate_links( // phpcs:ignore
				array(
					'base'      => str_replace( 99999999, '%#%', esc_url( get_pagenum_link( 99999999 ) ) ),
					'format'    => '?paged=%#%',
					'current'   => max( 1, get_query_var( 'paged' ) ),
					'total'     => $team_members->max_num_pages,
					'mid_size'  => 1,
					'prev_text' => '',
					'next_text' => '',
				)
			); // phpcs:ignore ?>
		</div>

		<?php wp_reset_postdata(); ?>
	<?php endif; ?>
</article>
