<?php

	namespace DDM\CookieByte\Tags;

	use DDM\CookieByte\Configuration\CookieByteConfig;
	use DDM\CookieByte\CookieByte;
	use Statamic\Facades\Site;
	use Statamic\Support\Str;
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
		 * @param $cookieClasses
		 */
		public function wildcard($cookieClasses) {
			if (isset($this->context[$cookieClasses]))
				$this->params['cookieClasses'] = $this->context[$cookieClasses];
			else
				$this->params['cookieClasses'] = $cookieClasses;

			return $this->index();
		}

		/**
		 * Checks whether the cookie class or cookie classes have already been consented to.
		 * If no parameter is given, it checks if the cookie modal has already been accepted.
		 *
		 * {{ cookie_consent cookieClasses="..." }} or {{ cookie_consent has="..." }}
		 *
		 * @return bool whether the cookie class has already been consented to
		 */
		public function index() {
			$cookieClasses = $this->params->get('cookieClasses') ?? $this->params->get('has') ?? 'showed';

			// Seperate the list by comma
			$cookieClasses = explode(',', $cookieClasses);

			$consent = false;

			foreach ($cookieClasses as $cookieClass) {
				if (array_key_exists('cookie-byte-consent-' . $cookieClass, $_COOKIE)) {
					$consent = $_COOKIE['cookie-byte-consent-' . $cookieClass] === 'true';

					// Return false if the current cookie class hasn't been consented to
					if (!$consent) {
						return false;
					}
				}
			}

			return $consent;
		}

	}