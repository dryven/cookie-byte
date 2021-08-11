'use strict';

const DISPLAY_SLEEP_TIME = 300;

/**
 * Class for initializing the cookie modal and its actions.
 */
export class CookieModal {
	/**
	 * Initializes the cookie modal if it is found on the page.
	 *
	 * @param {CookieConsent} instance the CookieConsent instance
	 */
	constructor(instance) {
		this._instance = instance;
		this._instance.cookieModal = this;

		// We assume that there should only exist one modal per page
		this._modal = document.querySelector('.ddmcm');
		if (this._modal === null) return;

		// Find all cookie category checkboxes
		this._modalCheckboxes = this._modal.querySelectorAll('.ddmcm-categories input[type=\"checkbox\"]');
		if (this._modalCheckboxes.length === 0) return;

		// Select all checkboxes which already have consent
		this._getUncheckedModals().forEach((check) => {
			check.checked = this._instance.hasConsent(check.name);
		});

		// Find the two buttons necessary in the modal and add their listeners
		this._buttonSelectAll = this._modal.querySelector('#ddmcm-button-all');
		this._buttonConfirm = this._modal.querySelector('#ddmcm-button-selected');
		if (this._buttonSelectAll === null || this._buttonConfirm == null) return;

		this._buttonSelectAll.addEventListener('click', (event) => {
			event.preventDefault();

			this.checkAll();

			this._finalize();
		});

		this._buttonConfirm.addEventListener('click', (event) => {
			event.preventDefault();

			this._finalize();
		});

		// Show the cookie notice if it hasn't already been interacted with
		if (!this._instance.hasConsent('showed')) this.show();
	}

	/**
	 * Shows the cookie modal.
	 */
	show() {
		this._modal.style.display = 'block';

		// Cancel the race condition for a smooth animation
		setTimeout(() => {
			this._modal.style.opacity = '1';
		}, 0);
	}

	/**
	 * Hides the cookie modal.
	 */
	hide() {
		this._modal.style.opacity = '0';

		setTimeout(() => {
			this._modal.style.display = 'none';
		}, DISPLAY_SLEEP_TIME);
	}

	/**
	 * Hides the cookie modal if all cookie categories have been consented to.
	 */
	hideIfConsented() {
		let allConsented = Array.prototype.every.call(this._modalCheckboxes, check => this._instance.hasConsent(check.name));

		if (allConsented) this._finalize();
	}

	/**
	 * Selects all the cookie category checkboxes.
	 */
	checkAll() {
		this._getUncheckedModals().forEach((check) => check.click());
	}

	/**
	 * Consents for all selected cookie category checkboxes.
	 *
	 * @private
	 */
	_pushSettings() {
		this._modalCheckboxes.forEach((check) => {
			if (check.checked) {
				this._instance.consent(check.name);
			}
		});

		this._instance.consent('showed');
	}

	/**
	 * Consents for all selected cookie category checkboxes and hides the cookie modal.
	 *
	 * @private
	 */
	_finalize() {
		this._pushSettings();

		this.hide();

		if (this._instance.cookieCover !== null) {
			this._instance.cookieCover.hideConsented();
		}
	}

	/**
	 * Returns all currenty unselected checkboxes.
	 *
	 * @returns {NodeListOf<Element>}
	 * @private
	 */
	_getUncheckedModals() {
		return this._modal.querySelectorAll('.ddmcm-categories input[type=\"checkbox\"]:not(:checked)');
	}
}
