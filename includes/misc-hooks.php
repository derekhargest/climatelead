<?php
/**
 * Misc Hooks
 *
 * @package gmmb-cli
 */

/**
 * Override and shorten the default post/page template body class names.
 *
 * @param array|string $classes Array or space-separated list of classes.
 * @return array|string Filtered classes.
 */
function mg_shorten_template_body_classes( $classes ) {
	foreach ( $classes as $index => $class ) {
		if ( mg_str_starts_with( $class, 'page-template-page-template' ) ) {
			$classes[ $index ] = str_replace( 'page-template-page-template', 'page-template', $class );
		}
	}

	return $classes;
}
add_filter( 'body_class', 'mg_shorten_template_body_classes' );

/**
 * Override the default document title separator.
 *
 * @param string $sep Current title separator.
 * @return string New title separator.
 */
function mg_document_title_separator( $sep ) {
	return '|';
}
add_filter( 'document_title_separator', 'mg_document_title_separator' );

/**
 * Adds either GA or GTM scripts if enabled.
 */
function mg_google_add_scripts_to_head() {
	$implementation_status = get_field( 'google_status', 'options' );
	$implementation_type   = get_field( 'google_implementation_type', 'options' );

	if ( true !== $implementation_status ) {
		return;
	}

	if ( 'ga' === $implementation_type ) {
		$ga_id = get_field( 'google_analytics_id', 'options' );
		?>
		<!-- Global site tag (gtag.js) - Google Analytics -->
		<script async src="https://www.googletagmanager.com/gtag/js?id=<?php echo esc_html( $ga_id ); ?>"></script>
		<script>
			window.dataLayer = window.dataLayer || [];
			function gtag(){dataLayer.push(arguments);}
			gtag('js', new Date());

			gtag('config', '<?php echo esc_html( $ga_id ); ?>');
		</script>
		<!-- End Google Analytics -->
		<?php
	} elseif ( 'gtm' === $implementation_type ) {
		$gtm_id = get_field( 'google_tag_manager_id', 'options' );
		?>
		<!-- Google Tag Manager -->
		<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
					new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
				j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
				'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
			})(window,document,'script','dataLayer','<?php echo esc_html( $gtm_id ); ?>');</script>
		<!-- End Google Tag Manager -->
		<?php
	}
}
add_action( 'wp_head', 'mg_google_add_scripts_to_head', 1 );

/**
 * Adds the GTM noscript tag if tracking is enabled and GTM is the type.
 */
function mg_gtm_add_noscript_tag() {
	$implementation_status = get_field( 'google_status', 'options' );
	$implementation_type   = get_field( 'google_implementation_type', 'options' );
	$gtm_id                = get_field( 'google_tag_manager_id', 'options' );

	if ( true !== $implementation_status ) {
		return;
	}

	if ( 'gtm' === $implementation_type ) {
		?>
		<!-- Google Tag Manager (noscript) -->
		<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=<?php echo esc_html( $gtm_id ); ?>"
						  height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
		<!-- End Google Tag Manager (noscript) -->
		<?php
	}
}
add_action( 'get_header', 'mg_gtm_add_noscript_tag', 1 );

// Alter search posts per page
function mg_search_posts_per_page( $query ) {
	if ( $query->is_search() && $query->is_main_query() && ! is_admin() ) {
		$query->set( 'posts_per_page', '6' );
	}
}
add_filter( 'pre_get_posts', 'mg_search_posts_per_page' );

/**
 * Order posts by the last word in the post_title.
 * Activated when orderby is 'wpse_last_word'.
 *
 * @link https://wordpress.stackexchange.com/a/198624/26350
 *
 * @param string $orderby The ORDER BY clause of the query.
 * @param WP_Query $q The WP_Query instance (passed by reference).
 * @return string
 */
function mg_order_posts_by_last_word_in_title( $orderby, \WP_Query $q ) {
	if ( 'wpse_last_word' === $q->get( 'orderby' ) && $get_order =  $q->get( 'order' ) ) {
		if ( in_array( strtoupper( $get_order ), ['ASC', 'DESC'] ) ) {
			global $wpdb;
			$orderby = " SUBSTRING_INDEX( {$wpdb->posts}.post_title, ' ', -1 ) " . $get_order;
		}
	}
	return $orderby;
}
add_filter( 'posts_orderby', 'mg_order_posts_by_last_word_in_title', PHP_INT_MAX, 2 );
