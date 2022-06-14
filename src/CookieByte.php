<?php

	namespace DDM\CookieByte;

	use Statamic\Facades\YAML;
	use Statamic\Licensing\LicenseManager;

	/**
	 * Global definitions and routines.
	 *
	 * Class CookieByte
	 * @package DDM\CookieByte
	 * @author  DDM Studio
	 */
	class CookieByte {

		public const NAMESPACE = "cookie-byte";

		public const PATH_STYLESHEET = "/vendor/" . self::NAMESPACE . "/css/";
		public const PATH_JAVASCRIPT = "/vendor/" . self::NAMESPACE . "/js/";

		public const NAVIGATION_ITEM_KEY = "cookie_byte_settings";

		public const ROUTE_SETTINGS_INDEX = self::NAMESPACE . ".settings.index";
		public const ROUTE_SETTINGS_UPDATE = self::NAMESPACE . ".settings.update";

		public const PERMISSION_SETTINGS_KEY = "cookie_byte_settings";
		public const PERMISSION_GENERAL_KEY = "cookie_byte_general";

		public const VENDOR_DEFAULT_SETTINGS_KEY = self::NAMESPACE . '-settings';
		public const VENDOR_WEB_RESOURCES_KEY = self::NAMESPACE . '-resources-web';
		public const VENDOR_CUSTOM_RESOURCES_KEY = self::NAMESPACE . '-resources-custom';
		public const VENDOR_VIEWS_KEY = self::NAMESPACE . '-views';
		public const VENDOR_LANGUAGES_KEY = self::NAMESPACE . '-lang';

		/**
		 * Returns the configuration file data as an array.
		 *
		 * @param $locale configuration's locale
		 *
		 * @return array
		 */
		public static function getConfigurationData($locale): array {
			return YAML::file(base_path(self::getConfigurationFile($locale)))->parse();
		}

		/**
		 * Returns the configuration file path.
		 *
		 * @param $locale configuration's locale
		 *
		 * @return string
		 */
		public static function getConfigurationFile($locale): string {
			return base_path("content/cookie_byte_" . $locale . ".yaml");
		}

		/**
		 * Returns a namespaced key, e.g. for views, etc.
		 *
		 * @param $key
		 *
		 * @return string
		 */
		public static function getNamespacedKey($key): string {
			return CookieByte::NAMESPACE . '::' . $key;
		}

		/**
		 * Returns the control panel translation with the addon's namespace.
		 *
		 * @param $translationKey
		 *
		 * @return string
		 */
		public static function getCpTranslation($translationKey): string {
			return __(CookieByte::NAMESPACE . '::cp.' . $translationKey);
		}

		/**
		 * Returns if Cookie Byte has a valid license.
		 */
		public static function isLicenseValid() {
			$licenses = app(LicenseManager::class);
			$addons = $licenses->addons();
	
			if (!$addons->has('ddm-studio/cookie-byte') || $licenses->isOnTestDomain()) {
				return true;
			}
	
			$cookieByteLicense = $addons->get('ddm-studio/cookie-byte');
	
			return $cookieByteLicense->valid();
		}

	}