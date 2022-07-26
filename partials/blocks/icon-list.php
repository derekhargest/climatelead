<?php
/**
 * Block: Icon List
 *
 * @package gmmb-cli
 */

$heading    = get_field( 'icon_list_heading' );
$subheading = get_field( 'icon_list_subheading' );
?>

<article class="icon-list">
	<div class="icon-list__inner content container container--padded container--narrow-width">
		<h2 class="icon-list__heading"><?php echo esc_html( $heading ); ?></h2>
		<h3 class="icon-list__subheading"><?php echo esc_html( $subheading ); ?></h3>

		<div class="icon-list__items">
			<?php 
			while ( have_rows( 'icon_list_list' ) ) :
				the_row();
				$image = get_sub_field( 'icon_list_icon' );
				$text  = get_sub_field( 'icon_list_text' );
				?>
				<div class="icon-list__item">
					<div class="icon-list__icon">
						<img src="<?php echo esc_url( $image['url'] ); ?>" alt="<?php echo esc_attr( $image['alt'] ); ?>" />
					</div>

					<div class="icon-list__text wysiwyg"><?php echo wp_kses_post( $text ); ?></div>
				</div>
			<?php endwhile; ?>
		</div>
	</div>
</article>
