<section class="page-not-found content container container--padded container--max-width">
	<header class="page-header">
		<h1 class="page-header__title"><?php esc_html_e( 'Page Not Found', 'gmmb-cli' ); ?></h1>
	</header>

	<div class="wysiwyg">
		<p><?php esc_html_e( "Looks like the page you're looking for isn't here anymore.", 'gmmb-cli' ); ?></p>
	</div>

	<div class="search__form">
		<?php get_template_part( 'partials/form-search', null, array( 'type' => '404', 'location' => 'desktop' ) ); ?>
	</div>
</section>
