/**
 * Theme main entry point.
 *
 * @package gmmb-cli
 */

import ui from './components/ui.js';
import menu from './components/menu.js';
import slick from './components/slick.js';
import modals from './components/modals.js';

/**
 * Initialize the app on DOM ready
 */
$(
	function() {
		ui.init();
		menu.init();
		slick.init();
		modals.init();
	}
);
