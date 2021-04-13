<?php

	namespace DDM\CookieByte\Tags;

	use Statamic\Tags\Tags;

	/**
	 * Class CookieConsent
	 * @package DDM\CookieByte\Tags
	 * @author  DDM Studio
	 */
	class CookieConsent extends Tags {

		/**
		 * {{ cookie_consent:... }}
		 *
		 * @param $cookieCategories
		 */
		public function wildcard($cookieCategories) {
			if (isset($this->context[$cookieCategories]))
				$this->params['cookieCategories'] = $this->context[$cookieCategories];
			else
				$this->params['cookieCategories'] = $cookieCategories;

			return $this->index();
		}

		/**
		 * Checks whether the cookie category or cookie categories have already been consented to.
		 * If no parameter is given, it checks if the cookie modal has already been accepted.
		 *
		 * {{ cookie_consent cookieCategories="..." }} or {{ cookie_consent has="..." }}
		 *
		 * @return bool whether the cookie categories have already been consented to
		 */
		public function index() {
			$cookieCategories = $this->params->get('cookieCategories') ?? $this->params->get('has') ?? 'showed';

			// Seperate the list by comma
			$cookieCategories = explode(',', $cookieCategories);

			$consent = false;

			foreach ($cookieCategories as &$cookieCategory) {
				$cookieFound = isset($_COOKIE['cookie-byte-consent-' . $cookieCategory]);
				$consent = false;

				if ($cookieFound) $consent = $_COOKIE['cookie-byte-consent-' . $cookieCategory] === 'true';

				// Return false if the current cookie category hasn't been consented to
				if (!($cookieFound || $consent)) return false;
			}

			return $consent;
		}

	}