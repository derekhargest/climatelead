<?php
/**
 * Breadcrumbs.
 *
 * @package gmmb-cli
 */

global $post;

$the_post_type     = get_post_type( $post->ID );
$ancestors         = array_reverse( get_ancestors( $post->ID, $the_post_type ) );
$breadcrumbs       = array();
$custom_post_types = array(
	'team',
);

if ( is_search() ) {
	$breadcrumbs[] = array(
		'text' => __( 'Search', 'gmmb-cli' ),
		'link' => get_home_url() . '/?s=' . get_search_query(),
	);
} elseif ( 'team' === $the_post_type ) {
	// Team CPT. Structure: Home > Category > Page.
	$team_categories    = get_the_terms( $post->ID, 'team_category' );
	$team_category_name = isset( $team_categories ) ? $team_categories[0]->name : '';
	$team_category_slug = isset( $team_categories ) ? $team_categories[0]->slug : '';
	if ( $team_category_name ) {
		$category_page = get_field( 'team_category_listing_page', $team_categories[0] );

		if ( $category_page ) {
			$breadcrumbs[] = array(
				'text' => $team_category_name,
				'link' => get_the_permalink( $category_page ),
			);
		}
	}

	// Page.
	$breadcrumbs[] = array(
		'text' => get_the_title( $post->ID ),
		'link' => get_the_permalink( $post->ID ),
	);

	if ( $team_category_name && ! empty( $category_page ) ) {
		// Mobile - link to parent.
		$mobile_link = array(
			'text' => $team_category_name,
			'link' => get_the_permalink( $category_page['ID'] ),
		);
	} else {
		// Mobile - link to home.
		$mobile_link = array(
			'text' => 'Home',
			'link' => get_home_url(),
		);
	}
} elseif ( 'story' === $the_post_type ) {
	$parent = get_field( 'story_settings_story_listing_page', 'options' );
	// Parent.
	$breadcrumbs[] = array(
		'text' => get_the_title( $parent ),
		'link' => get_the_permalink( $parent ),
	);

	// Page.
	$breadcrumbs[] = array(
		'text' => get_the_title( $post->ID ),
		'link' => get_the_permalink( $post->ID ),
	);

	// Mobile - link to home.
	$mobile_link = array(
		'text' => get_the_title( $parent ),
		'link' => get_the_permalink( $parent ),
	);
} elseif ( empty( $ancestors ) ) {
	// Page.
	$breadcrumbs[] = array(
		'text' => get_the_title( $post->ID ),
		'link' => get_the_permalink( $post->ID ),
	);

	// Mobile - link to home.
	$mobile_link = array(
		'text' => 'Home',
		'link' => get_home_url(),
	);
} else {
	// Child page/post. Structure: Home > ... > Parent > Page.
	foreach ( $ancestors as $ancestor ) {
		$breadcrumbs[] = array(
			'text' => get_the_title( $ancestor ),
			'link' => get_the_permalink( $ancestor ),
		);
	}

	// Mobile - link to parent.
	$parent      = get_post( $ancestors[0] );
	$mobile_link = array(
		'text' => get_the_title( $parent->ID ),
		'link' => get_the_permalink( $parent->ID ),
	);
}
?>

<div class="breadcrumbs breadcrumbs--<?php echo esc_html( $args['style'] ); ?>">
	<div class="breadcrumbs__container container container--padded container--max-width">
		<div class="breadcrumbs__inner breadcrumbs__inner--desktop">
			<?php foreach ( $breadcrumbs as $key => $value ) : // phpcs:ignore
				$class  = ( 'Home' === $value['text'] ) ? esc_attr( 'breadcrumbs__breadcrumb--home' ) : '';
				$class .= count( $breadcrumbs ) === $key + 1 ? ' breadcrumbs__breadcrumb--active' : '';
				?>
				<div class="breadcrumbs__breadcrumb <?php echo esc_attr( $class ); ?>">
					<a href="<?php echo esc_url( $value['link'] ); ?>">
						<?php if ( 'Home' === $value['text'] ) : ?>
							<i class="icon icon-home" aria-hidden="true"></i><span class="sr-only"><?php esc_html_e( 'Home', 'gmmb-cli' ); ?></span>
						<?php else : ?>
							<?php echo esc_html( $value['text'] ); ?>
						<?php endif; ?>
					</a>
				</div>
			<?php endforeach; ?>
		</div>

		<div class="breadcrumbs__inner breadcrumbs__inner--mobile">
			<div class="breadcrumbs__breadcrumb breadcrumbs__breadcrumb--active">
				<a href="<?php echo esc_url( $mobile_link['link'] ); ?>">
					<?php echo esc_html( $mobile_link['text'] ); ?>
				</a>
			</div>
		</div>
	</div>
</div>
