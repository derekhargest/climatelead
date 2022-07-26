/**
 * Module: menu
 * General menu behaviors
 *
 * @package gmmb-cli
 */

/**
 * Initialize menu behaviors.
 */
function init() {
	// Toggle active state.
	$( '[data-toggle-active]' ).on(
		'click',
		function(e) {
			e.preventDefault();
			var target = $( this ).data( 'toggle-active' );
			$( this ).toggleClass( 'active' );
			$( target ).toggleClass( 'active' );
			if ( $( this ).hasClass( 'active' ) ) {
				$( this ).attr( 'aria-expanded', 'true' );
				$( target ).slideDown();
			} else {
				$( this ).attr( 'aria-expanded', 'false' );
				$( target ).slideUp();
			}
		}
	);

	// Toggle search.
	$( '.header__toggle-search' ).on('click', function (e) {
		let $desktopSearch = $( '.header__search--desktop' );
		$desktopSearch.toggleClass( 'header__search--collapsed' );

		if ( $desktopSearch.hasClass( 'header__search--collapsed' ) ) {
			$( this ).attr( 'aria-expanded', 'false' );
		} else {
			$( this ).attr( 'aria-expanded', 'true' );
		}
	});

	$( window ).resize( function() {
		resetMobileMenu();
	});

	initDesktopMenuA11y();
	initMobileMenuFunctionality();
	initMobileMenuA11y();
}


function initDesktopMenuA11y() {
	let $topLevelItems = $( '.menu--header .menu-item-has-children > a' ),
		$topLevelSubMenuLastItem = $( '.menu--header .menu-item-has-children > ul.sub-menu > li:last-of-type a' );

	$topLevelItems.on( 'focus', function(e) {
		if ( 992 < window.innerWidth ) {
			let $focused = $( '.menu-item--focus' );

			// When focusing on a top level item, if another is open, close it.
			if ( $focused.length ) {
				$focused.removeClass( 'menu-item--focus' );
			}

			// Add class to current parent element.
			$( this ).parent().addClass( 'menu-item--focus' );
		}
	});

	$topLevelSubMenuLastItem.on( 'blur', function(e) {
		if ( 992 < window.innerWidth ) {
			let $parent = $( this ).closest( '.menu-item-has-children' ),
				parentID = $parent.attr( 'id' ),
				targetParentID = $( e.relatedTarget ).closest( '.menu-item-has-children' ).attr( 'id' );

			// If parentID === targetID, this implies the user is tabbing backwards, and therefore we don't want to close the submenu.
			if ( parentID !== targetParentID && $parent.hasClass( 'menu-item--focus' ) ) {
				$parent.removeClass( 'menu-item--focus' );
			}
		}
	});

	// Remove focus class when focus changes from a nav menu item to anything else.
	$('.menu--header .menu-item a').on('blur', function(e) {
		if ( 992 < window.innerWidth ) {
			if ( null === e.relatedTarget || 1 !== $( e.relatedTarget ).closest( '.menu-item-has-children' ).length ) {
				$( '.menu-item--focus' ).removeClass( 'menu-item--focus' );
			}
		}
	});
}

/**
 * Initializes mobile menu a11y.
 */
function initMobileMenuA11y() {
	if ( 992 > window.innerWidth ) {
		let $menuToggle = $( '.header__toggle' ),
			$searchSubmit = $( '.header__search--mobile button' ),
			$navLogo = $( '.header__logo a' );

		// Set all parent nav items aria-expanded = false.
		$( '.menu-item-has-children a' ).attr( 'aria-expanded', 'false' );

		// If tabbing backward on logo, set focus to last nav item.
		$navLogo.on( 'keydown', function (e) {
			if ( 9 !== e.keyCode || $menuToggle.attr( 'aria-expanded' ) !== 'true') {
				return;
			}
			e.preventDefault();

			// Focus menu toggle button when tabbing forward; focus last menu item when tabbing backwards.
			if ( true === e.shiftKey ) {
				$searchSubmit.focus();
			} else {
				$menuToggle.focus();
			}
		});

		// Keydown events for the search button.
		$searchSubmit.on( 'keydown', function (e) {
			// Focus logo when tabbing forward.
			if ( 9 === e.keyCode &&  true !== e.shiftKey) {
				e.preventDefault();
				$navLogo.focus();
			}
		});
	}
}

/**
 * Initializes mobile menu functionality.
 */
function initMobileMenuFunctionality() {
	let $items = $( '.menu-item-has-children > a' );

	$items.on( 'click', function(e) {
		if ( 992 > window.innerWidth ) {
			e.preventDefault();

			if ( 'false' === $( this ).attr( 'aria-expanded' ) ) {
				$( this ).attr( 'aria-expanded', 'true' );
				$( this ).next( '.sub-menu' ).slideDown({
					start: function () {
						$(this).css({
							display: "flex"
						})
					}
				});
			} else {
				$( this ).attr( 'aria-expanded', 'false' );
				$( this ).next( '.sub-menu' ).slideUp();
			}
		}
	});
}

/**
 * Reset the mobile menu to its initial state.
 */
function resetMobileMenu() {
	let $menuToggle = $( '.header__toggle' ),
		$menuNav = $( '.header__nav' );

	if ( $menuToggle.hasClass( 'active' ) ) {
		$menuToggle.click();
		$( '.menu-item a' ).attr( 'aria-expanded', 'false' );
		$( '.sub-menu' ).removeAttr( 'style' );
	}


	if ( $menuNav.attr( 'style' ) !== undefined ) {
		$menuNav.removeAttr( 'style' );
	}

}

/**
 * Public API
 *
 * @type {Object}
 */
module.exports = {
	init: init
};
