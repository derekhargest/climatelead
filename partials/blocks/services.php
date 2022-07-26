<?php
/**
 * Block: Services
 *
 * @package gmmb-cli
 */

$heading = get_sub_field( 'services_heading' );
?>

<article class="services">
	<?php if ( $heading ) : ?>
		<h2 class="services__heading container container--padded container--max-width"><?php echo esc_html( $heading ); ?></h2>
	<?php endif; ?>

	<div class="services__items">
		<?php 
		while ( have_rows( 'services_items' ) ) :
			the_row();
			$background       = get_sub_field( 'services_service_background_color' );
			$alignment        = get_sub_field( 'services_service_alignment' );
			$type             = get_sub_field( 'services_service_type' );
			$image            = get_sub_field( 'services_service_image' );
			$video            = get_sub_field( 'services_service_video' );
			$text             = get_sub_field( 'services_service_text' );
			$heading          = get_sub_field( 'services_service_heading' );
			$link             = get_sub_field( 'services_service_link' );
			$form             = get_sub_field( 'services_service_form' );
			$button_text      = get_sub_field( 'services_service_download_button' );
			$link_url         = $link['url'];
			$link_title       = $link['title'];
			$link_target      = $link['target'] ? $link['target'] : '_self';
			$service_classes  = 'services__service--' . $background;
			$service_classes .= ' services__service--' . $type;
			$service_classes .= ' services__service--' . $alignment;
			?>
			<div class="services__service <?php echo esc_attr( $service_classes ); ?>">
				<div class="services__inner content services__inner--<?php echo esc_attr( $alignment ); ?> container container--padded container--max-width">
					<div class="services__media">
						<?php if ( 'video' === $type ) : ?>
							<?php echo $video; ?>
						<?php else : ?>
							<img src="<?php echo esc_url( $image['url'] ); ?>" alt="<?php echo esc_attr( $image['alt'] ); ?>" />
						<?php endif; ?>
					</div>
					<div class="services__content">
						<h3><?php echo esc_html( $heading ); ?></h3>
						<div class="wysiwyg"><?php echo wp_kses_post( $text ); ?></div>
						<?php if ( 'download' === $type ) : ?>
							<button role="button" class="btn btn--primary services__download-trigger" data-modal-id="services__modal_<?php echo esc_attr( $args['instance_id'] . '_' . get_row_index() ); ?>">
								<?php echo wp_trim_words( esc_html( $button_text ), 3 ); ?>
							</button>
						<?php else : ?>
							<a class="btn btn--primary" href="<?php echo esc_url( $link_url ); ?>" target="<?php echo esc_attr( $link_target ); ?>"><?php echo esc_html( $link_title ); ?></a>
						<?php endif; ?>
					</div>
				</div>

				<div id="services__modal_<?php echo esc_attr( $args['instance_id'] . '_' . get_row_index() ); ?>" class="services__modal modal">
					<div class="services__form">
						<?php if ( function_exists( 'gravity_form' ) ) { // phpcs:ignore
							gravity_form( $form, false, false, false, '', true );
						} // phpcs:ignore ?>
					</div>
				</div>
			</div>
		<?php endwhile; ?>
	</div>
</article>
