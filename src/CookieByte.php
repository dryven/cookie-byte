<?php

namespace DDM\CookieByte;

use Statamic\Facades\Site;
use Statamic\Facades\YAML;
use Illuminate\Support\Str;
use Statamic\Licensing\LicenseManager;
use function config;

/**
 * Global definitions and routines.
 *
 * Class CookieByte
 * @package DDM\CookieByte
 * @author  dryven
 */
class CookieByte
{

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

	public const LOCALE_IDENTIFIER = 'locale';
	public const HANDLE_IDENTIFIER = 'handle';

	/**
	 * Returns the configuration file data as an array.
	 *
	 * @param $identifier configuration's identifier
	 *
	 * @return array
	 */
	public static function getConfigurationData($identifier): array
	{
        return YAML::file(self::getConfigurationPath($identifier))->parse();
	}

	/**
	 * Returns the configuration file path.
	 *
	 * @param $identifier configuration's identifier
	 *
	 * @return string
	 */
	public static function getConfigurationPath($identifier): string
	{
		return self::getConfigurationDirname() . "cookie_byte_$identifier.yaml";
	}

	/**
	 * Returns the configuration directory path.
	 *
	 * @return string
	 */
	public static function getConfigurationDirname(): string
	{
		return Str::finish(config('cookie-byte.config_dirname', base_path("content")), '/');
	}

	/**
	 * Returns a namespaced key, e.g. for views, etc.
	 *
	 * @param $key
	 *
	 * @return string
	 */
	public static function getNamespacedKey($key): string
	{
		return CookieByte::NAMESPACE . '::' . $key;
	}

	/**
	 * Returns the control panel translation with the addon's namespace.
	 *
	 * @param $translationKey
	 *
	 * @return string
	 */
	public static function getCpTranslation($translationKey): string
	{
		return __(CookieByte::NAMESPACE . '::cp.' . $translationKey);
	}

	public static function getCurrentSiteIdentifier(): string
	{
		switch (config('cookie-byte.site_identifier_type', self::LOCALE_IDENTIFIER)) {
			case self::HANDLE_IDENTIFIER:
				return Site::selected()->handle();
			case self::LOCALE_IDENTIFIER:
			default:
				return Site::selected()->locale();
		}
	}

	public static function getSelectedSiteIdentifier(): string
	{
		switch (config('cookie-byte.site_identifier_type', self::LOCALE_IDENTIFIER)) {
			case self::HANDLE_IDENTIFIER:
				return Site::selected()->handle();
			case self::LOCALE_IDENTIFIER:
			default:
				return Site::selected()->locale();
		}
	}

	/**
	 * Returns if Cookie Byte has a valid license.
	 */
	public static function isLicenseValid()
	{
		$licenses = app(LicenseManager::class);
		$addons = $licenses->addons();

		if (!$addons->has('ddm-studio/cookie-byte') || $licenses->isOnTestDomain()) {
			return true;
		}

		$cookieByteLicense = $addons->get('ddm-studio/cookie-byte');

		return $cookieByteLicense->valid();
	}
}
