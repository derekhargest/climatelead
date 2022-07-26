/**
 * Module: modals
 * General Modaal behaviors
 *
 * @link https://github.com/humaan/Modaal
 * @package gmmb-cli
 */

import 'modaal/dist/js/modaal.min.js';

/**
 * Initialize slick behaviors.
 */
function init() {
	initServicesModals();
	initModalA11y();
}

/**
 * Initializes modal accessibility functionality.
 */
function initModalA11y() {
	let focusableOptions = 'button, a, input:not([type="hidden"]), select, textarea, [tabindex]:not([tabindex="-1"])',
		$submitButton = $( '.form--modal_wrapper input[type="submit"]' );

	// Focus modal close when tabbing past submit button.
	$submitButton.on( 'keydown', function (e) {
		if ( 9 === e.keyCode && false === e.shiftKey ) {
			e.preventDefault();
			$( this ).parents( '.modaal-container' ).find( '.modaal-close' ).focus();
		}
	});

	// Focus first input when tabbing forward on modal close..
	$( document ).on( 'keydown', '.modaal-close', function (e) {
		if ( 9 === e.keyCode && false === e.shiftKey ) {
			e.preventDefault();
			$( this ).prev( '.modaal-content' ).find( focusableOptions ).first().focus();
		}
	});

	// Focus modal close when tabbing backward from first input.
	$('.form--modal_wrapper').find( focusableOptions ).first().on( 'keydown', function (e) {
		if ( 9 === e.keyCode && true === e.shiftKey ) {
			e.preventDefault();
			$( this ).parents( '.modaal-container' ).find( '.modaal-close' ).focus();
		}
	});

	// If there are errors when trying to submit, do nothing.
	$submitButton.on( 'click', function ( e ) {
		if ( $( this ).parents( '.services__form' ).find( '.gform_validation_errors' ).length ) {
			e.preventDefault();
		}
	});

	// Click the link to open document to download in new window.
	$( document ).on('gform_confirmation_loaded', function(event, formId){
		if ( $.inArray( formId.toString(), gform_new_tab.forms) !== -1 ) {
			let $documentLink = $( '.modaal-wrapper .gform_confirmation_message a' );
			if ( $documentLink.length ) {
				window.open($documentLink[0].href, '_blank');
			}
		}
	});
}

/**
 * Initializes services modal(s).
 */
function initServicesModals() {
	let $modalTriggers = $( '.services__download-trigger' );
	if ( $modalTriggers.length ) {
		$modalTriggers.each( function (e) {
			$( this ).modaal({
				content_source: '#' + $( this ).data( 'modal-id' ),
			});
		});
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
