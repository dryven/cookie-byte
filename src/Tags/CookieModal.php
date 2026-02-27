<?php

namespace DDM\CookieByte\Tags;

use DDM\CookieByte\CookieByte;
use DDM\CookieByte\Factories\CookieByteConfigFactory;
use Statamic\Tags\Tags;

class CookieModal extends Tags
{

	protected $config;

	public function __construct()
	{
		$this->config = CookieByteConfigFactory::createConfig();
	}

	public function index()
	{
		// Add default stylesheet tag if no style customization is wanted
		if ($this->config->shouldAddStylesheet()) {
			$this->config->addValue('stylesheet', $this->getStylesheetVariable());
		}

		// Add loadscript if no JavaScript customization is wanted
		if ($this->config->shouldAddJavaScript()) {
			$this->config->addValue('loadscript', $this->getJavaScriptVariable());
		}

		return view(CookieByte::getNamespacedKey('modal'), collect($this->config->raw()));
	}

	protected function getStylesheetVariable()
	{
		$file = $this->getManifestAsset('resources/css/_cookie_byte.css');
		if ($file === null) {
			return '';
		}
		return '<link rel="stylesheet" href="' . CookieByte::PATH_BUILD . $file . '">';
	}

	protected function getJavaScriptVariable()
	{
		$file = $this->getManifestAsset('resources/js/loadscript.js');
		if ($file === null) {
			return '';
		}
		return '<script src="' . CookieByte::PATH_BUILD . $file . '" async defer></script>';
	}

	/**
	 * Resolve the built asset filename from Vite manifest by entry key.
	 *
	 * @param string $entry Key used in vite config input (e.g. "resources/css/_cookie_byte.css")
	 * @return string|null The manifest "file" value (e.g. "assets/_cookie_byte-DSiWpDG6.css") or null if missing
	 */
	protected function getManifestAsset(string $entry): ?string
	{
		$manifestPath = public_path(CookieByte::PATH_BUILD . 'manifest.json');
		if (!is_file($manifestPath)) {
			$manifestPath = dirname(__DIR__, 2) . '/dist/build/manifest.json';
		}
		if (!is_file($manifestPath)) {
			return null;
		}
		$manifest = json_decode(file_get_contents($manifestPath), true);
		if (!is_array($manifest) || !isset($manifest[$entry]['file'])) {
			return null;
		}
		return $manifest[$entry]['file'];
	}
}
