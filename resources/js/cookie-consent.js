'use strict';

import {Cookies} from './cookies';

/**
 * Class for handling cookie requests, changes and callbacks
 */
export class CookieConsent {
	/**
	 * Creates the instance for handling cookie requests, changes and callbacks.
	 *
	 * Available options:
	 *  - callbacks: object with arrays of functions, which are called when a cookie class has been consented to
	 *
	 * @param {Object} options
	 */
	constructor(options = {}) {
		this._defaults = {
			callbacks: {}
		};

		this._options = Object.assign({}, this._defaults, options);

		// Nevertheless, overwrite prefix, because it can't be customized yet
		this._options.prefix = 'cookie-byte-consent';

		// Add trailing dash to prefix if none exists
		if (!this._options.prefix.endsWith('-')) {
			this._options.prefix += '-';
		}

		this._registerCPCallbacksAndRun();

		// Add linkers to the dependent classes
		this.cookieModal = null;
		this.cookieCover = null;
	}

	/**
	 * Adds a callback function to a cookie class
	 *
	 * @param {string} cookieClass the cookie class
	 * @param {function} callback the callback function to be called when the cookie class has been consented to
	 */
	registerCallback(cookieClass, callback) {
		// Create callback array if it doesn't exist already
		if (!Array.isArray(this._options.callbacks[cookieClass])) {
			this._options.callbacks[cookieClass] = [];
		}

		this._options.callbacks[cookieClass].push(callback);
	}

	/**
	 * Removes the callbacks added to a cookie class or a list of cookie classes.
	 *
	 * @param {string} cookieClasses the cookie classes
	 */
	unregisterCallback(cookieClasses) {
		this._runSplitList(cookieClasses, (cookieClass) => {
			delete this._options.callbacks[cookieClass];
		});
	}

	/**
	 * Runs the callback function of a cookie class if it has been consented to.
	 * TODO: Prevention of running callbacks multiple times
	 *
	 * @param {string} cookieClass the cookie class
	 */
	runCallback(cookieClass) {
		// Don't bother if the cookie class has no consent or callback function
		if (!this.hasConsent(cookieClass)) return;
		if (!(cookieClass in this._options.callbacks)) return;

		this._options.callbacks[cookieClass].forEach((callback) => {
			if (typeof callback === 'function') callback();
		});
	}

	/**
	 * Runs all the callback functions which cookie classes have been consented to.
	 */
	runCallbacks() {
		Object.keys(this._options.callbacks).forEach((cookieClass) => {
			this.runCallback(cookieClass);
		});
	}

	/**
	 * Checks whether the cookie class or cookie classes have already been consented to.
	 *
	 * @param cookieClasses the cookie classes to check for
	 * @returns {boolean} whether the cookie classes have been consented to
	 */
	hasConsent(cookieClasses) {
		let consent = false;

		const arr = cookieClasses.toString().split(',');

		for (const cookieClass of arr) {
			consent = Cookies.get(this._options.prefix + cookieClass) === 'true';

			// Return false if the current cookie class hasn't been consented to
			if (!consent) {
				return false;
			}
		}

		return consent;
	}

	/**
	 * Consents to the cookie class.
	 *
	 * @param cookieClass the cookie class to consent to
	 */
	consent(cookieClass) {
		this.setConsent(cookieClass, true);
	}

	/**
	 * Sets the consent for a list of cookie classes.
	 *
	 * @param cookieClasses the cookie classes to set
	 * @param {boolean, string} value
	 */
	setConsent(cookieClasses, value) {
		this._runSplitList(cookieClasses, (cookieType) => {
			Cookies.set(this._options.prefix + cookieType, (value === true || value === 'true'), {expires: 365});

			this.runCallback(cookieType);
		});
	}

	_registerCPCallbacksAndRun() {
		const snippets = document.querySelectorAll('script[type="text/snippetscript"]');

		if (snippets.length === 0) return;

		snippets.forEach((snippet) => {
			const cookieClass = snippet.dataset.class;
			const snippetCode = snippet.text;

			this.registerCallback(cookieClass.toString(), Function(snippetCode));
		});

		this.runCallbacks();
	}

	/**
	 * Runs a function on a comma-seperated list of strings.
	 *
	 * @param {string} str the comma-seperated list
	 * @param {function} func the function to iterate over
	 * @private
	 */
	_runSplitList(str, func) {
		// First split the string into pieces
		let arr = str.toString().split(',');

		arr.forEach(func);
	}
}
