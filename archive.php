<?php
/**
 * Archive template
 *
 * @package gmmb-cli
 */

?>
<section class="content container container--padded container--max-width">
	<header class="page-header">
		<h1 class="page-header__title"><?php the_archive_title(); ?></h1>
	</header>

	<ol class="posts">
		<?php
		while ( have_posts() ) :
			the_post();
			?>
			<?php get_template_part( 'partials/loop-post' ); ?>
		<?php endwhile; ?>
	</ol>

	<?php get_template_part( 'partials/pagination' ); ?>
</section>
