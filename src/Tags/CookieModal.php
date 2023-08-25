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
		$stylesheetPath = CookieByte::PATH_STYLESHEET . basename(__DIR__ . "/../../dist/css/ddmcb.css");

		return '<link rel="stylesheet" href="' . $stylesheetPath . '">';
	}

	protected function getJavaScriptVariable()
	{
		$javascriptPath = CookieByte::PATH_JAVASCRIPT . basename(__DIR__ . "/../../dist/js/ddmcb.js");

		return '<script src="' . $javascriptPath . '" async defer></script>';
	}
}
