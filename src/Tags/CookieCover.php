<?php

	namespace DDM\CookieByte\Tags;

	use DDM\CookieByte\Configuration\CookieByteConfig;
	use DDM\CookieByte\CookieByte;
	use DDM\CookieByte\Exceptions\CookieCoverException;
	use Statamic\Facades\Asset;
	use Statamic\Tags\Tags;

	/**
	 * Class CookieCover
	 * @package DDM\CookieByte\Tags
	 * @author  DDM Studio
	 */
	class CookieCover extends Tags {

		protected $config;

		public function __construct() {
			$this->config = new CookieByteConfig();
		}

		/**
		 * {{ cookie_cover:... }}
		 *
		 * @param $handle
		 */
		public function wildcard($handle) {
			$this->params['handle'] = $handle;

			return $this->index();
		}

		public function index() {
			$handle = $this->params->get('handle');
			$values = $this->config->values();
			$cover = null;

			try {
				$cover = $this->findCoverByHandle($values, $handle);
			} catch (CookieCoverException $ex) {
				// Only throw exception if the app is in debug
				if (config('app.debug'))
					throw $ex;
				else return false;
			}

			// Add cover-specific variables into view data
			if (isset($cover))
				$this->config->setValues(array_merge($values, $cover));

			$this->findBackgroundImage();

			return view(CookieByte::getNamespacedKey('cover'), collect($this->config->raw()));
		}

		private function findCoverByHandle($values, $handle) {
			// Stop execution if there are no cookie covers or no handle was given
			if (!array_key_exists('covers', $values)) throw new CookieCoverException("No covers were found.");
			if (empty($handle)) throw new CookieCoverException("There was no handle specified.");

			// Find cookie cover with the given handle
			$cover = null;

			foreach ($values['covers'] as $currentCover) {
				if ($currentCover['handle'] === $handle) {
					$cover = $currentCover;
				}
			}

			// Stop execution if it wasn't found
			if ($cover === null) throw new CookieCoverException("There is no cover with the handle '$handle'.");

			return $cover;
		}

		private function findBackgroundImage() {
			$values = $this->config->raw();

			// The background images is augmented to a string with the pattern
			// "[assets-Folder]::[path/image.ext] so we have to convert the asset
			// by finding the relative public path
			if (isset($values['bg_image'])) {
				// If there is more than one image pick the first as the background
				if (is_array($values['bg_image']))
					$values['bg_image'] = $values['bg_image'][0];

				$values['bg_image'] = Asset::find($values['bg_image']);
			}

			$this->config->setValues($values);
		}

	}