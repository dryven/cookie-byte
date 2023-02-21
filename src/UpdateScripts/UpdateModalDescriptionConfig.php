<?php

namespace DDM\CookieByte\UpdateScripts;

use DDM\CookieByte\Configuration\CookieByteConfig;
use Statamic\Support\Arr;

class UpdateModalDescriptionConfig extends UpdateConfigScript
{

	public function shouldUpdate($newVersion, $oldVersion): bool
	{
		return $this->isUpdatingTo('1.1.4');
	}

	protected function updateForConfig(CookieByteConfig $config)
	{
		$fields = $config->blueprint()->fields()->addValues($config->values());

		$values = Arr::removeNullValues($fields->process()->values()->all());

		$config->setValues($values)->save();
	}

}