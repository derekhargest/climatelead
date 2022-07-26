<?php
/**
 * Search
 *
 * @package gmmb-cli
 */

global $wp_query;
$background = get_field( 'search_options_hero_image', 'options' );
?>

<article class="hero" style="background-image: url('<?php echo esc_url( $background ); ?>')">
	<div class="content container container--padded container--max-width">
		<h1 class="hero__heading"><?php esc_html_e( 'Search', 'gmmb-cli' ); ?></h1>
	</div>
</article>

<section class="content container container--padded container--narrow-width">
	<div class="search__form">
		<?php get_template_part( 'partials/form-search', null, array( 'type' => 'search', 'location' => 'desktop' ) ); ?>
	</div>

	<h2 class="search__results">
		<?php echo sprintf( __( 'Showing %s result%s for "%s"', 'gmmb-cli' ), esc_html( $wp_query->found_posts ), esc_html( 1 != $wp_query->found_posts ? 's' : '' ), get_search_query() ); ?>
	</h2>

	<ol class="posts">
		<?php while ( have_posts() ) : the_post(); // phpcs:ignore ?>
			<?php get_template_part( 'partials/loop-post' ); ?>
		<?php endwhile; ?>
	</ol>

	<?php get_template_part( 'partials/pagination' ); ?>
</section>
