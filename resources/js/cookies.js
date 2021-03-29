'use strict';

const SECONDS_IN_A_YEAR = 864e+5;

export class Cookies {
	static get(key, fallback = '') {
		return document.cookie.match('(^|;)\\s*' + key + '\\s*=\\s*([^;]+)')?.pop() || fallback;
	}

	static set(key, value, expires = 365, path = '/') {
		let expirationDate = new Date(new Date * 1 + expires * SECONDS_IN_A_YEAR);

		key = encodeURIComponent(String(key))
			.replace(/%(23|24|26|2B|5E|60|7C)/g, decodeURIComponent)
			.replace(/[()]/g, escape);

		value = encodeURIComponent(String(value))
			.replace(/%(23|24|26|2B|3A|3C|3E|3D|2F|3F|40|5B|5D|5E|60|7B|7D|7C)/g, decodeURIComponent);

		return (document.cookie = key + '=' + value + '; expires=' + expirationDate.toUTCString() + '; path=/');
	}
}