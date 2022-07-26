<?php
/**
 * Wrapper
 *
 * @package gmmb-cli
 */

get_template_part( 'partials/head' ); ?>
<body <?php body_class(); ?>>
	<?php
		do_action( 'get_header' );
		mg_get_header();
	?>

	<main id="site-main" class="main">
		<?php mg_get_template(); ?>
	</main>

	<?php
		do_action( 'get_footer' );
		mg_get_footer();
	?>
</body>
</html>
