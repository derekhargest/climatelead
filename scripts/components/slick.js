/**
 * Module: slick
 * General slick carousel behaviors
 *
 * @package gmmb-cli
 */

import 'slick-carousel';

/**
 * Initialize slick behaviors.
 */
function init() {
	initCarouselHeroSlider();
}

function initCarouselHeroSlider() {
	let $carouselSlider = $( '.carousel-hero__slider' );
	if ( $carouselSlider.length ) {
		$carouselSlider.slick({
			arrows:			false,
			autoplay: 		true,
			autoplaySpeed: 	4000,
			cssEase: 		'ease-in-out',
			dots: 			false,
			fade: 			true,
			infinite: 		true,
			slidesToShow: 	1,
			speed: 			1000,
			swipe: 			false,
		});

		$('.carousel-hero__toggle').on('click', function (e) {
			e.preventDefault();
			if ( $( this ).hasClass( 'carousel-hero__toggle--pause' ) ) {
				$carouselSlider.slick('slickPause');
				$( this ).attr( 'aria-label', 'Play Carousel' );
			} else {
				$carouselSlider.slick('slickPlay');
				$( this ).attr( 'aria-label', 'Pause Carousel' );
			}
			$( this ).toggleClass( 'carousel-hero__toggle--pause' );
		})
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
