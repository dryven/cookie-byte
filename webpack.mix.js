const mix = require('laravel-mix');

let fileSuffix = '';

if (mix.inProduction()) {
	fileSuffix = '.min';
}

mix.options({
	terser: {},
	cssNano: {}
});

mix.js('resources/js/loadscript.js', 'dist/js/cookie-byte' + fileSuffix + '.js');

mix.postCss('resources/css/_cookie_byte.css', 'dist/css/cookie-byte' + fileSuffix + '.css', [
	require('postcss-import'),
	require('postcss-nested'),
	require('postcss-preset-env')({
		stage: 0,
		autoprefixer: {
			cascade: true,
			add: true,
			remove: true,
			flexbox: true
		},
		features: {
			'focus-within-pseudo-class': false
		}
	}),
]);