import { CookieConsent, CookieCovers, CookieModal } from "./cookie-byte";

import "./ie11-polyfills";

// Define the method on the global window root for the best support
window.InitCookieByte = () => {
	window.CookieConsent = new CookieConsent();
	window.CookieModal = new CookieModal(window.CookieConsent);
	window.CookieCovers = new CookieCovers(window.CookieConsent);
};

// Run the initialization process only if the document is fully loaded
if (document.readyState !== "loading") {
	window.InitCookieByte();
} else {
	document.addEventListener("DOMContentLoaded", () => {
		window.InitCookieByte();
	});
}
