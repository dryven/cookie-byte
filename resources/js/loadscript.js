import { CookieConsent, CookieModal, CookieCovers } from './cookie-byte';

import './ie11-polyfills';

window.InitCookieByte = () => {
	window.CookieConsent = new CookieConsent();
	window.CookieModal = new CookieModal(window.CookieConsent);
	window.CookieCovers = new CookieCovers(window.CookieConsent);
};

if (document.readyState !== 'loading') {
	InitCookieByte();
} else {
	document.addEventListener('DOMContentLoaded', () => {
		InitCookieByte();
	});
}
