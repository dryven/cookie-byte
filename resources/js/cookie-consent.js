"use strict";

import { Cookies } from "./cookies";

/**
 * Class for handling cookie requests, changes and callbacks
 */
export class CookieConsent {
	/**
	 * Creates the instance for handling cookie requests, changes and callbacks.
	 *
	 * Available options:
	 *  - callbacks: object with arrays of functions, which are called when a cookie category has been consented to
	 *  - autorun: if the cookie categories' callbacks / code snippets should be immediately be run at CookieByte's init
	 *  - prefix: the prefix for the consent cookie key names
	 *
	 * @param {{
	 *     autorun: boolean,
	 *     callbacks: Array<function>,
	 *     prefix: string
	 * }} options
	 */
	constructor(options = {}) {
		this._defaults = {
			autorun: true,
			callbacks: {},
			prefix: "cookie-byte-consent-"
		};

		this._options = Object.assign({}, this._defaults, options);

		// Add trailing dash to prefix if none exists
		if (!this._options.prefix.endsWith("-")) {
			this._options.prefix += "-";
		}

		this._registerCPCallbacks();

		if (this._options.autorun) {
			this.runCallbacks();
		}

		// Add linkers to the dependent categories
		this.cookieModal = null;
		this.cookieCovers = null;
	}

	/**
	 * Adds a callback function to a cookie category
	 *
	 * @param {string} cookieCategory the cookie category
	 * @param {function} callback the callback function to be called when the cookie category has been consented to
	 */
	registerCallback(cookieCategory, callback) {
		// Create callback array if it doesn't exist already
		if (!Array.isArray(this._options.callbacks[cookieCategory])) {
			this._options.callbacks[cookieCategory] = [];
		}

		this._options.callbacks[cookieCategory].push(callback);
	}

	/**
	 * Removes the callbacks added to a cookie category or a list of cookie categories.
	 *
	 * @param {string} cookieCategories the cookie categories
	 */
	unregisterCallback(cookieCategories) {
		this._runSplitList(cookieCategories, (cookieCategory) => {
			delete this._options.callbacks[cookieCategory];
		});
	}

	/**
	 * Runs the callback function of a cookie category if it has been consented to.
	 *
	 * @param {string} cookieCategory the cookie category
	 */
	runCallback(cookieCategory) {
		// Don't bother if the cookie category has no consent or callback function
		if (!this.hasConsent(cookieCategory)) return;
		if (!(cookieCategory in this._options.callbacks)) return;

		this._options.callbacks[cookieCategory].forEach((callback) => {
			if (typeof callback === "function") callback();
		});

		delete this._options.callbacks[cookieCategory];
	}

	/**
	 * Runs all the callback functions which cookie categories have been consented to.
	 */
	runCallbacks() {
		Object.keys(this._options.callbacks).forEach((cookieCategory) => {
			this.runCallback(cookieCategory);
		});
	}

	/**
	 * Checks whether the cookie category or cookie categories have already been consented to.
	 *
	 * @param {string} cookieCategories a comma-separated list of the cookie categories to check for
	 * @returns {boolean} whether the cookie categories have been consented to
	 */
	hasConsent(cookieCategories) {
		let consent = false;

		const arr = String(cookieCategories).split(",");

		for (const cookieCategory of arr) {
			consent = Cookies.get(this._options.prefix + cookieCategory) === "true";

			// Return false if the current cookie category hasn't been consented to
			if (!consent) {
				return false;
			}
		}

		return consent;
	}

	/**
	 * Consents to the cookie categories.
	 *
	 * @param {string} cookieCategories a comma-separated list of the cookie category to consent to
	 */
	consent(cookieCategories) {
		this.setConsent(cookieCategories, true);
	}

	/**
	 * Sets the consent for a list of cookie categories.
	 *
	 * @param {string} cookieCategories a comma-separated list of the cookie categories to set
	 * @param {boolean, string} value
	 */
	setConsent(cookieCategories, value) {
		this._runSplitList(cookieCategories, (cookieType) => {
			Cookies.set(this._options.prefix + cookieType, value === true || value === "true");

			this.runCallback(cookieType);
		});
	}

	/**
	 * Register all JavaScript snippets that were found on the page.
	 *
	 * @private
	 */
	_registerCPCallbacks() {
		const snippets = document.querySelectorAll('script[type="text/snippetscript"]');

		if (snippets.length === 0) return;

		snippets.forEach((snippet) => {
			const cookieCategory = snippet.dataset.category;
			const snippetCode = snippet.text.trim();

			this.registerCallback(String(cookieCategory), Function(snippetCode));
		});
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
		let arr = String(str).split(",");

		arr.forEach(func);
	}
}
