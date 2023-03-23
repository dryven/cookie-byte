"use strict";

import {CookieConsent} from "./cookie-consent";

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

		// We assume that there only exists one modal per page
		this._modal = document.querySelector(".ddmcm");
		if (this._modal === null) return;

		// Find all cookie category checkboxes
		this._modalCheckboxes = this._modal.querySelectorAll('.ddmcm-categories input[data-ddmcm-category][type="checkbox"]');
		if (this._modalCheckboxes.length === 0) return;

		// Select all checkboxes which already have consent
		this._getUncheckedModals().forEach((check) => {
			check.checked = this._instance.hasConsent(check.name);
		});

		// Make a button select all options and therefore consent to all categories
		this._initButton("#ddmcm-button-all", () => {
			this.checkAll();
		});

		// Make a button just consent the selected categories
		this._initButton("#ddmcm-button-selected");

		// Init cookie category accordion
		this._initAccordion();

		// Show the cookie notice if it hasn't already been interacted with
		if (!this._instance.hasConsent("showed")) this.show();
	}

	/**
	 * Shows the cookie modal.
	 */
	show() {
		this._modal.style.display = "block";

		// Cancel the race condition for a smooth animation
		setTimeout(() => {
			this._modal.style.opacity = "1";
		}, 0);
	}

	/**
	 * Hides the cookie modal.
	 */
	hide() {
		this._modal.style.opacity = "0";

		setTimeout(() => {
			this._modal.style.display = "none";
		}, DISPLAY_SLEEP_TIME);
	}

	/**
	 * Hides the cookie modal if all cookie categories have been consented to.
	 */
	hideIfConsented() {
		const allConsented = Array.prototype.every.call(this._modalCheckboxes, (check) =>
			this._instance.hasConsent(check.name)
		);

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
			this._instance.setConsent(check.name, check.checked);
		});
	}

	/**
	 * Consents for all selected cookie category checkboxes and hides the cookie modal.
	 *
	 * @private
	 */
	_finalize() {
		this.hide();
		this._instance.consent("showed");

		// Try to hide the cookie covers' that have their cookie categories' consent
		if (this._instance.cookieCovers !== null) {
			this._instance.cookieCovers.hideConsented();
		}
	}

	/**
	 * Returns all currently unselected checkboxes.
	 *
	 * @returns {NodeListOf<HTMLInputElement>}
	 * @private
	 */
	_getUncheckedModals() {
		return this._modal.querySelectorAll('.ddmcm-categories input[data-ddmcm-category][type="checkbox"]:not(:checked)');
	}

	/**
	 * Initializes a button in the cookie modal for saving and consenting to the selected categories.
	 *
	 * @param {HTMLButtonElement|string} element the button element or a selector
	 * @param {function|null} prepare the callback that is run before the settings are saved
	 * @private
	 */
	_initButton(element, prepare = null) {
		if (typeof element === "string") {
			element = this._modal.querySelector(element);
		}

		if (element === null) return;

		element.addEventListener("click", (event) => {
			event.preventDefault();

			if (typeof prepare === "function") {
				prepare();
			}

			this._pushSettings();
			this._finalize();
		});
	}

	/**
	 * Initializes the functionality to expand and collapse each cookie category like an accordion
	 * 
	 * @private 
	 */
	_initAccordion() {
		const accordion = this._modal.querySelector('.ddmcm-accordion');

		if (!accordion)
			return;
	
		const accordionItems = accordion.querySelectorAll('.ddmcm-accordion-item');

		accordionItems.forEach((accordionItem) => {
			const accordionToggle = accordionItem.querySelector('.ddmcm-accordion-toggle input[type="checkbox"]');

			if (!accordionToggle)
				return;

			accordionToggle.addEventListener('change', () => {
				accordionItems.forEach((item) => {
					this._toggleAccordionItem(item, accordionItem === item && accordionToggle.checked);
				});
			});
		});
	}

	/**
	 * Opens or closes passed accordion item
	 * @param {Element} accordionItem Accordion item container of a single accordion item ('.accordion-item')
	 * @param {Boolean} open Open/Close
	 */
	_toggleAccordionItem(accordionItem, open) {
		let checkbox = accordionItem.querySelector('.ddmcm-accordion-toggle input[type="checkbox"]');
		let accordionContent = accordionItem.querySelector('.ddmcm-accordion-content');

		if (!checkbox | !accordionContent)
			return;

		checkbox.checked = open;
		accordionContent.style.height = (open ? accordionContent.scrollHeight : 0) + 'px';

		// set it again after transition end, so that nothing is cut off
		// sometimes there are issues in the scrollHeight calculation
		setTimeout(() => {
			accordionContent.style.height = (open ? accordionContent.scrollHeight : 0) + 'px';
		}, 500);
	}
}
