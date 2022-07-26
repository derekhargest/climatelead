<?php
/**
 * Header
 *
 * @package gmmb-cli
 */

?>
<a class="sr-only sr-only-focusable skip-to-main" href="#site-main"><?php esc_html_e( 'Skip to main content', 'gmmb-cli' ); ?></a>

<header class="header">
	<div class="header__container container">
		<div class="header__main">
			<h1 class="header__logo">
				<a href="<?php echo esc_url( get_bloginfo( 'wpurl' ) ); ?>" aria-label="<?php echo esc_attr( get_bloginfo( 'name' ) ); ?>">
					<img alt="<?php esc_attr_e( 'Climate Leadership Initiative Logo', 'gmmb-cli' ); ?>>" src="<?php echo esc_url( get_stylesheet_directory_uri() . '/images/logo.png' ); ?>">
				</a>
			</h1>

			<button class="header__toggle" data-toggle-active="#header-nav"
					aria-hidden="true" aria-expanded="false"
					aria-haspopup="true" aria-label="<?php esc_html_e( 'Toggle Menu', 'gmmb-cli' ); ?>"></button>

			<nav class="header__nav" id="header-nav">
				<div class="header__menu">
					<?php
					wp_nav_menu(
						array(
							'theme_location' => 'header',
							'container'      => false,
							'menu_class'     => 'menu menu--header',
							'depth'			 => 2,
						)
					);
					?>
				</div>

				<div class="header__search header__search--mobile">
					<?php get_template_part( 'partials/form-search', null, array( 'type' => 'nav', 'location' => 'mobile' ) ); ?>
				</div>

				<button class="header__toggle-search" aria-expanded="false" aria-haspopup="true" aria-label="<?php esc_attr_e( 'Toggle Search', 'gmmb-cli' ); ?>"></button>
			</nav>
		</div>
	</div>

	<div class="header__search header__search--desktop header__search--collapsed">
		<?php get_template_part( 'partials/form-search', null, array( 'type' => 'nav', 'location' => 'desktop' ) ); ?>
	</div>
</header>
