"use strict";

import {CookieConsent} from "./cookie-consent";
import {CookieCover} from "./cookie-cover";

/**
 * Class for initializing the cookie covers on the current page.
 */
export class CookieCovers {
	/**
	 * Initializes the cookie covers if there are any on the page.
	 *
	 * @param {CookieConsent} instance the CookieConsent instance
	 */
	constructor(instance) {
		this._instance = instance;
		this._instance.cookieCovers = this;
		this.cookieCovers = [];

		// Now, there could be more than one of these, so keep that in mind
		this._covers = document.querySelectorAll(".ddmcc");
		if (this._covers.length === 0) return;

		this._covers.forEach((cover) => {
			this.cookieCovers.push(new CookieCover(this._instance, cover));
		});
	}

	/**
	 * Returns the cookie covers' elements with a given handle.
	 *
	 * @param {string} handle the handle of the cookie cover to look for
	 * @returns {Array<CookieCover>} the cookie covers' elements with a given handle
	 *
	 * @deprecated Only used by other deprecated methods. Should be removed by 1.2.
	 */
	getCoversByHandle(handle) {
		return this.cookieCovers.filter((cover) => {
			return cover.handle === handle;
		});
	}

	/**
	 * Shows the cookie cover with the given handle.
	 *
	 * @param {HTMLElement|string} cover the cookie covers' element or handle
	 *
	 * @deprecated Use the show() function of the CookieCover object itself. Should be removed by 1.2.
	 */
	show(cover) {
		let covers = this.getCoversByHandle(cover);

		covers.forEach((cover) => {
			cover.show();
		});
	}

	/**
	 * Hides the cookie cover with the given handle.
	 *
	 * @param {HTMLElement|string} cover the cookie covers' element or handle
	 *
	 * @deprecated Use the hide() function of the CookieCover object itself. Should be removed by 1.2.
	 */
	hide(cover) {
		let covers = this.getCoversByHandle(cover);

		covers.forEach((cover) => {
			cover.hide();
		});
	}

	/**
	 * Hides all cookie covers which have been consented to since the
	 * initialization.
	 */
	hideConsented() {
		if (this._covers.length === 0) return;

		this._covers.forEach((cover) => {
			if (this._instance.hasConsent(cover.dataset.categories)) this.hide(cover.dataset.handle);
		});
	}
}
