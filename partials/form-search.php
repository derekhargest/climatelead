<?php
/**
 * Form Search
 *
 * @package gmmb-cli
 */

if ( 'search' === $args['type'] ) {
	$class = 'form--search-page';
} else {
	$class = 'form--' . $args['type'];
}
?>
<form class="form form--search <?php echo esc_attr( $class ); ?>" method="get" action="<?php bloginfo( 'url' ); ?>/">
	<?php if ( 'search' === $args['type'] || '404' === $args['type'] ) : ?>
		<?php if ( 'search' === $args['type'] ) : ?>
			<label for="search_input"><?php esc_html_e( 'Search Site', 'gmmb-cli' ); ?></label>
		<?php endif; ?>

		<div class="form__input-container">
			<input id="search_input" type="text" value="<?php echo esc_html( get_search_query() ); ?>" name="s" placeholder="<?php esc_html_e( 'Enter search terms', 'gmmb-cli' ); ?>">
			<button class="form__clear-search" type="button" aria-label="<?php esc_html_e( 'Clear search input.', 'gmmb-cli' ); ?>">&#10005;</button>
		</div>
	<?php else : ?>
		<input type="text" value="" name="s" placeholder="<?php esc_html_e( 'Enter search terms', 'gmmb-cli' ); ?>">
		<?php if ( $args['location'] === 'mobile' ) : ?>
				<button type="submit" aria-label="<?php esc_html_e( 'Submit', 'gmmb-cli' ); ?>"></button>
		<?php else : ?>
				<button class="btn btn--tertiary" type="submit"><?php esc_html_e( 'Submit', 'gmmb-cli' ); ?></button>
		<?php endif; ?>
	<?php endif; ?>

	<?php if ( 'search' === $args['type'] || '404' === $args['type'] ) : ?>
		<button class="btn btn--tertiary" type="submit"><?php esc_html_e( 'Submit', 'gmmb-cli' ); ?></button>
	<?php endif; ?>
</form>
