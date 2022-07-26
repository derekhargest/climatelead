<?php
/**
 * Footer
 *
 * @package gmmb-cli
 */

?>
<footer class="footer">
	<div class="footer__container container container--padded">
		<div class="footer__menu">
			<?php
			wp_nav_menu(
				array(
					'theme_location' => 'footer',
					'container'      => false,
					'menu_class'     => 'menu menu--footer',
					'depth'          => 1,
				)
			);
			?>
		</div>

		<div class="footer__copyright">
			<?php esc_html_e( 'Copyright', 'gmmb-cli' ); ?> &copy;
			<?php
				echo esc_html( date( 'Y' ) );
				echo sprintf( __( ' %s.  - All Rights Reserved.', 'gmmb-cli' ), get_bloginfo( 'name' ) );
			?>
		</div>
	</div>

	<?php wp_footer(); ?>
</footer>
