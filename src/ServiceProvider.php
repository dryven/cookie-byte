<?php

namespace DDM\CookieByte;

use DDM\CookieByte\Http\Middleware\LicenseMiddleware;
use DDM\CookieByte\Tags\CookieConsent;
use DDM\CookieByte\Tags\CookieCover;
use DDM\CookieByte\Tags\CookieModal;
use Statamic\Facades\CP\Nav;
use Statamic\Facades\File;
use Statamic\Facades\Permission;
use Statamic\Providers\AddonServiceProvider;
use Statamic\Statamic;

/**
 * The connection point between Laravel, Statamic and this addon.
 * This is where the magic begins.
 *
 * Class ServiceProvider
 * @package DDM\CookieByte
 * @author  dryven
 */
class ServiceProvider extends AddonServiceProvider
{

	protected $tags = [
		CookieConsent::class,
		CookieCover::class,
		CookieModal::class,
	];

	protected $routes = [
		'cp' => __DIR__ . '/../routes/cp.php',
	];

	protected $middlewareGroups = [
		'statamic.cp.authenticated' => [
			LicenseMiddleware::class
		]
	];

	protected $publishAfterInstall = false;

	public function boot()
	{
		parent::boot();

		Statamic::booted(function () {
			$this
				->bootPermissions()
				->bootNavigation();

			$this->loadTranslationsFrom(__DIR__ . '/../resources/lang', CookieByte::NAMESPACE);
			$this->loadViewsFrom(__DIR__ . '/../resources/views', CookieByte::NAMESPACE);
		});

		Statamic::afterInstalled(function ($command) {
			// Publish default settings, to make the first time experience easier
			$command->call('vendor:publish', ['--tag' => CookieByte::VENDOR_DEFAULT_SETTINGS_KEY]);

			// Force web resource publish, so it's overwritten on every install and update
			$command->call('vendor:publish', ['--tag' => CookieByte::VENDOR_WEB_RESOURCES_KEY, '--force' => true]);
		});
	}

	/**
	 * Creates navigation item for this addon's control panel settings.
	 *
	 * @return $this
	 */
	protected function bootNavigation(): ServiceProvider
	{
		Nav::extend(function ($nav) {
			$cookieIconData = File::disk()->get(__DIR__ . '/../resources/svg/cookie-byte.svg');

			$nav
				->create(CookieByte::getCpTranslation('navigation_item'))
				->can(CookieByte::PERMISSION_GENERAL_KEY)
				->route(CookieByte::ROUTE_SETTINGS_INDEX)
				->section('Tools')
				->icon($cookieIconData ?? 'alert');
		});

		return $this;
	}

	/**
	 * Registers the permissions. Gives the users more control who can do what.
	 *
	 * @return $this
	 */
	protected function bootPermissions(): ServiceProvider
	{
		// Add permission group for this addon
		Permission::group(
			CookieByte::PERMISSION_SETTINGS_KEY,
			CookieByte::getCpTranslation('permission_settings'),
			function () {
				// Add permission for configuring the settings
				Permission::register(CookieByte::PERMISSION_GENERAL_KEY)
					->label(CookieByte::getCpTranslation('permission_general'))
					->description(CookieByte::getCpTranslation('permission_general_description'));
			}
		);

		return $this;
	}

	/**
	 * Registers all publishables available through Artisan's vendor:publish.
	 *
	 * @return $this
	 */
	protected function bootPublishables(): ServiceProvider
	{
		parent::bootPublishables();

		$this->publishes([
			__DIR__ . '/../content/cookie_byte_en_US.default.yaml' => CookieByte::getConfigurationFile("en_US"),
			__DIR__ . '/../content/cookie_byte_de_DE.default.yaml' => CookieByte::getConfigurationFile("de_DE"),
		], CookieByte::VENDOR_DEFAULT_SETTINGS_KEY);

		$this->publishes([
			__DIR__ . '/../dist/css' => public_path(CookieByte::PATH_STYLESHEET),
			__DIR__ . '/../dist/js' => public_path(CookieByte::PATH_JAVASCRIPT),
		], CookieByte::VENDOR_WEB_RESOURCES_KEY);

		$this->publishes([
			__DIR__ . '/../resources/css/' => resource_path(CookieByte::PATH_STYLESHEET),
			__DIR__ . '/../resources/js/' => resource_path(CookieByte::PATH_JAVASCRIPT),
		], CookieByte::VENDOR_CUSTOM_RESOURCES_KEY);

		$this->publishes([
			__DIR__ . '/../resources/views' => resource_path('views/vendor/' . CookieByte::NAMESPACE),
		], CookieByte::VENDOR_VIEWS_KEY);

		$this->publishes([
			__DIR__ . '/../resources/lang' => resource_path('lang/vendor/' . CookieByte::NAMESPACE),
		], CookieByte::VENDOR_LANGUAGES_KEY);

		return $this;
	}
}
