/**
 * Module: ui
 * General ui behaviors
 *
 * @package gmmb-cli
 */

/**
 * Initialize ui behaviors.
 */
function init() {
	// Smooth scroll.
	$( '.js-scroll[href*="#"]:not([href="#"])' ).click(
		function() {
			if (location.pathname.replace( /^\//,'' ) == this.pathname.replace( /^\//,'' ) && location.hostname == this.hostname) {
				var target = $( this.hash );
				target     = target.length ? target : $( '[name=' + this.hash.slice( 1 ) + ']' );
				if (target.length) {
					$( 'html, body' ).animate(
						{
							scrollTop: target.offset().top
						},
						1000
					);
					return false;
				}
			}
		}
	);

	$( '.form__clear-search' ).on( 'click', function (e) {
		$( this ).prev().val('');
		$( this ).prev().focus();
	});

	initSkipToMain();
}

/**
 * Functionality when clicking skip to main link.
 */
function initSkipToMain() {
	$( '.skip-to-main' ).on(
		'click',
		function(e) {
			e.preventDefault();

			let focusableOptions   = 'button, a, input:not([type="hidden"]), select, textarea, [tabindex]:not([tabindex="-1"])',
				$firstFocusableElement = $( '#site-main' ).find( focusableOptions ),
				$focusable             = ( $firstFocusableElement.length ) ? $firstFocusableElement.first() : $( '.footer' ).find( focusableOptions ).first();

			$focusable.focus();
			$( window ).scrollTop( $focusable.offset().top - $( '.header' ).outerHeight() - $focusable.position().top );
		}
	)

}

/**
 * Public API
 *
 * @type {Object}
 */
module.exports = {
	init: init
};
