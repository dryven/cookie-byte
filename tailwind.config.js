const colors = require('tailwindcss/colors');

module.exports = {
	purge: false,
	theme: {
		/** Opinionated screen breakpoints, for more information on rem usage:
		 * https://zellwk.com/blog/media-query-units/ */
		screens: {
			sm: '40rem',        // equals 640 px
			md: '48rem',        // equals 768 px
			lg: '64rem',        // equals 1024 px
			xl: '80rem',        // equals 1280 px
			'2xl': '96rem',     // equals 1536 px
		},
		/** Minimal set of colors needed */
		colors: {
			transparent: 'transparent',
			current: 'currentColor',
			black: colors.black,
			white: colors.white,
			gray: colors.trueGray,
			primary: '#000000',
			secondary: '#ffffff',
		},
		/** Setting a higher default transition duration */
		transitionDuration: {
			DEFAULT: '300ms',
		},
	},
	variants: {},
	plugins: []
};
