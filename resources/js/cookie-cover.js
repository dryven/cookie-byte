"use strict";

import {CookieConsent} from "./cookie-consent";

const DISPLAY_SLEEP_TIME = 300;

/**
 * Class for initializing a cookie cover.
 */
export class CookieCover {
	/**
	 * Initialize the cookie cover.
	 *
	 * @param {CookieConsent} instance the CookieConsent instance
	 * @param {HTMLElement} element the cookie cover's element
	 */
	constructor(instance, element) {
		this._instance = instance;
		this.element = element;
		this.handle = element.dataset.handle;
		this.categories = element.dataset.categories;
		this.htmlSnippet = this._fetchHTMLSnippet();

		if (this.hasConsent()) this.hide();
		else this.show();

		// Make a button consent the cookie cover's categories
		this._initButton(".ddmcc-button-accept");
	}

	/**
	 * Shows the cookie cover.
	 */
	show() {
		this.element.style.display = "block";

		setTimeout(() => {
			this.element.style.opacity = "1";
		}, 0);
	}

	/**
	 * Hides the cookie cover by removing it and optionally add the html snippet.
	 */
	hide() {
		this._insertHTMLSnippet();

		this.element.style.opacity = "0";

		setTimeout(() => {
			this.element.style.display = "none";
		}, DISPLAY_SLEEP_TIME);
	}

	/**
	 * Checks whether the cookie cover's categories have consent.
	 *
	 * @returns {boolean}
	 */
	hasConsent() {
		return this._instance.hasConsent(this.categories);
	}

	/**
	 * Try to get the HTML snippet as a string.
	 *
	 * @returns {string|null} either the snippet code or null if none could be found
	 * @private
	 */
	_fetchHTMLSnippet() {
		const snippetElement = this.element.querySelector('script[type="text/htmlsnippet"]');
		if (snippetElement === null) return null;

		return snippetElement.text.trim();
	}

	/**
	 * Inserts the HTML snippet above the cookie cover in the DOM and sets the property to null afterwards.
	 *
	 * @private
	 */
	_insertHTMLSnippet() {
		if (this.htmlSnippet === null) return;
		const wrapper = this.element.parentNode;

		const htmlNode = document.createElement("div");
		htmlNode.innerHTML = this.htmlSnippet;

		// Set htmlSnippet to null, so it won't be inserted again when calling this method
		this.htmlSnippet = null;

		// Insert the snippet before the cookie cover
		wrapper.insertBefore(htmlNode, this.element);
	}

	/**
	 * Initializes a button in the cookie cover for consenting to their categories.
	 *
	 * @param {HTMLButtonElement|string} element the button element or a selector
	 * @private
	 */
	_initButton(element) {
		if (typeof element === "string") {
			element = this.element.querySelector(element);
		}

		if (element === null) return;

		element.addEventListener("click", (event) => {
			event.preventDefault();

			this._instance.consent(this.categories);

			// Hide all cookie covers that now can be shown
			this._instance.cookieCovers.hideConsented();

			// Try to hide the cookie modal if this cookie cover ended up accepting all cookie categories
			if (this._instance.cookieModal) {
				this._instance.cookieModal.hideIfConsented();
			}
		});
	}
}