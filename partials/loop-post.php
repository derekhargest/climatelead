<?php
/**
 * Loop Post
 *
 * @package gmmb-cli
 */

?>
<li class="post" id="post-<?php echo esc_attr( the_ID() ); ?>">
	<h2 class="post__title"><?php echo esc_html( get_the_title() ); ?></h2>
	<a class="post__link" href="<?php echo esc_url( get_the_permalink() ) ?>" aria-label="<?php echo sprintf( __( '%s. Click to read more.', 'gmmb-cli' ), get_the_title() ) ?>">
		<?php echo esc_url( get_the_permalink() ) ?>
	</a>
	<?php if ( has_excerpt() ) : ?>
		<div class="post__excerpt wysiwyg"><?php echo wp_kses_post( get_the_excerpt() ); ?></div>
	<?php endif; ?>
</li>
