<?php

namespace DDM\CookieByte\Tags;

use Statamic\Tags\Tags;
use Statamic\Facades\Asset;
use DDM\CookieByte\CookieByte;
use DDM\CookieByte\Configuration\CookieByteConfig;
use DDM\CookieByte\Exceptions\CookieCoverException;
use Statamic\Contracts\Assets\Asset as StatamicAsset;

class CookieCover extends Tags
{

	protected $config;

	public function __construct()
	{
		$this->config = new CookieByteConfig(CookieByte::getCurrentSiteIdentifier());
	}

	/**
	 * {{ cookie_cover:... }}
	 *
	 * @param $handle string the cookie cover handle
	 */
	public function wildcard(string $handle)
	{
		$this->params['handle'] = $handle;

		return $this->index();
	}

	public function index()
	{
		$handle = $this->params->get('handle');

		try {
			$cover = $this->findCoverByHandle($this->config->values(), $handle);
		} catch (CookieCoverException $ex) {
			// Only throw exception if the app is in debug
			throw_if(config('app.debug'), $ex);

			return null;
		}

		// Add cover-specific variables into view data
		if (isset($cover)) {
			$this->config->addValues($cover);
			$this->config->addValue('bg_image', $this->getValidBackgroundImage($this->config->raw()));
		}

		return view(CookieByte::getNamespacedKey('cover'), collect($this->config->raw()));
	}

	/**
	 * Returns the config of a specified cookie cover.
	 *
	 * @param $configValues array the CookieByte config values
	 * @param $coverHandle string the cookie cover handle
	 * @return mixed
	 * @throws CookieCoverException
	 */
	protected function findCoverByHandle(array $configValues, string $coverHandle)
	{
		// Stop execution if there are no cookie covers or no handle was given
		if (!array_key_exists('covers', $configValues)) throw new CookieCoverException("No covers were found.");
		if (empty($coverHandle)) throw new CookieCoverException("There was no handle specified.");

		// Find cookie cover with the given handle
		$cover = null;

		foreach ($configValues['covers'] as $currentCover) {
			if ($currentCover['handle'] === $coverHandle) {
				$cover = $currentCover;
			}
		}

		// Stop execution if it wasn't found
		if ($cover === null) throw new CookieCoverException("There is no cover with the handle '$coverHandle'.");

		return $cover;
	}

	/**
	 * Gets the background image for a cookie cover from the config values and augments it.
	 *
	 * @param array $configValues
	 * @return mixed|StatamicAsset|null
	 */
	protected function getValidBackgroundImage(array $configValues)
	{
		$bgImage = !empty($configValues['bg_image']) ? $configValues['bg_image'] : null;

		// The background images is augmented to a string with the pattern
		// "[assets-Folder]::[path/image.ext] so we have to convert the asset
		// by finding the relative public path
		if (!empty($bgImage)) {
			// If there is more than one image pick the first as the background
			if (is_array($bgImage))
				$bgImage = $bgImage[0];

			$bgImage = Asset::find($bgImage);
		}

		return $bgImage;
	}
}
