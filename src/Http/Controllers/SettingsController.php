<?php

namespace DDM\CookieByte\Http\Controllers;

use DDM\CookieByte\Configuration\CookieByteConfig;
use DDM\CookieByte\CookieByte;
use Illuminate\Http\Request;
use Statamic\Facades\User;
use Statamic\Http\Controllers\CP\CpController;
use Statamic\StaticCaching\Cacher;

/**
 * Class SettingsController
 * @package DDM\CookieByte\Http\Controllers
 * @author  dryven
 */
class SettingsController extends CpController
{
	public function index()
	{
		// No access if the user doesn't have the right permissions to show them
		abort_unless(User::current()->hasPermission('super') ||
			User::current()->hasPermission(CookieByte::PERMISSION_GENERAL_KEY), 403);

		$config = $this->getConfig();

		return view(CookieByte::getNamespacedKey('settings'), [
			'title' => CookieByte::getCpTranslation('title'),
			'action' => cp_route(CookieByte::ROUTE_SETTINGS_UPDATE),
			'blueprint' => $config->blueprint()->toPublishArray(),
			'values' => $config->values(),
			'meta' => $config->fields()->meta()
		]);
	}

	public function update(Request $request)
	{
		// No access if the user doesn't have the right permissions to edit them
		abort_unless(User::current()->hasPermission('super') ||
			User::current()->hasPermission(CookieByte::PERMISSION_GENERAL_KEY), 403);

		$config = $this->getConfig();

		$values = $config->validatedValues($request);

		$config->setValues($values)->save();

		// If static caching is enabled, invalidate all cached urls
		if ($this->isStaticCachingEnabled()) app(Cacher::class)->flush();
	}

	public function getConfig()
	{
		return new CookieByteConfig(CookieByte::getSelectedSiteIdentifier());
	}

	protected function isStaticCachingEnabled()
	{
		return config('statamic.static_caching.strategy') !== null;
	}
}
