"use strict";

const DISPLAY_SLEEP_TIME = 300;

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
		this._instance.cookieCover = this;

		// Now, there could be more than one of these, so keep that in mind
		this._covers = document.querySelectorAll(".ddmcc");
		if (this._covers.length === 0) return;

		this._covers.forEach((cover) => {
			// Add a event listener to consent and hide the cover
			const cover_button = cover.querySelector(".ddmcc-button-accept");
			if (cover_button === null) return;

			cover_button.addEventListener("click", (event) => {
				event.preventDefault();

				this._instance.consent(cover.dataset.categories);

				this.hideConsented();

				if (this._instance.cookieModal) this._instance.cookieModal.hideIfConsented();
			});
		});
	}

	/**
	 * Returns the cookie covers with a specific handle.
	 *
	 * @param {string} handle
	 * @returns {NodeList} the node element  list
	 */
	getCoversByHandle(handle) {
		const covers = document.querySelectorAll(`.ddmcc[data-handle="${handle}"]`);
		return covers.length === 0 ? false : covers;
	}

	show(handle) {
		let covers = this.getCoversByHandle(handle);

		if (covers) {
			covers.forEach((cover) => {
				cover.style.display = "block";

				setTimeout(() => {
					cover.style.opacity = "1";
				}, 10);
			});
		}
	}

	hide(handle) {
		let covers = this.getCoversByHandle(handle);

		if (covers) {
			covers.forEach((cover) => {
				cover.style.opacity = "0";

				setTimeout(() => {
					cover.style.display = "none";
				}, DISPLAY_SLEEP_TIME);
			});
		}
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
