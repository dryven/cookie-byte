<?php

namespace DDM\CookieByte\Tags;

use DDM\CookieByte\Configuration\CookieByteConfig;
use DDM\CookieByte\CookieByte;
use Statamic\Tags\Tags;

/**
 * Class CookieModal
 * @package DDM\CookieByte\Tags
 * @author  DDM Studio
 */
class CookieModal extends Tags
{

	protected $config;

	public function __construct()
	{
		$this->config = new CookieByteConfig(CookieByte::getCurrentSiteIdentifier());
	}

	public function index()
	{
		$values = $this->config->values();

		// Add default stylesheet tag if no style customization is wanted
		if (!(array_key_exists('custom_style', $values) && $values['custom_style']))
			$this->addStylesheetVariable($values);

		// Add loadscript if no JavaScript customization is wanted
		if (!(array_key_exists('custom_code', $values) && $values['custom_code']))
			$this->addJavaScriptVariable($values);

		$this->config->setValues($values);

		return view(CookieByte::getNamespacedKey('modal'), collect($this->config->raw()));
	}

	private function addStylesheetVariable(&$values): CookieModal
	{
		$stylesheetPath = CookieByte::PATH_STYLESHEET . basename(__DIR__ . "/../../dist/css/ddmcb.min.css");

		$values['stylesheet'] = '<link rel="stylesheet" href="' . $stylesheetPath . '">';

		return $this;
	}

	private function addJavaScriptVariable(&$values): CookieModal
	{
		$javascriptPath = CookieByte::PATH_JAVASCRIPT . basename(__DIR__ . "/../../dist/js/ddmcb.min.js");

		$values['loadscript'] = '<script src="' . $javascriptPath . '" async defer></script>';

		return $this;
	}
}
