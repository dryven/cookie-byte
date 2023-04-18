<?php

namespace DDM\CookieByte\Http\Controllers;

use DDM\CookieByte\Factories\CookieByteConfigFactory;
use Statamic\Facades\User;
use Illuminate\Http\Request;
use DDM\CookieByte\CookieByte;
use Statamic\StaticCaching\Cacher;
use Statamic\Http\Controllers\CP\CpController;
use DDM\CookieByte\Configuration\CookieByteConfig;

class SettingsController extends CpController
{
	public function index()
	{
		// No access if the user doesn't have the right permissions to show them
		abort_unless(User::current()->hasPermission('super') ||
			User::current()->hasPermission(CookieByte::PERMISSION_GENERAL_KEY), 403);

		$config = $this->getConfig();

		$variables = [
			'title' => CookieByte::getCpTranslation('title'),
			'action' => cp_route(CookieByte::ROUTE_SETTINGS_UPDATE),
			'blueprint' => $config->blueprint()->toPublishArray(),
			'values' => $config->values(),
			'meta' => $config->fields()->meta()
		];

		return view(CookieByte::getNamespacedKey('settings'), $variables);
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

	public function getConfig(): CookieByteConfig
	{
		return CookieByteConfigFactory::createConfigWithIdentifier(CookieByte::getSelectedSiteIdentifier());
	}

	protected function isStaticCachingEnabled(): bool
	{
		return config('statamic.static_caching.strategy') !== null;
	}
}
