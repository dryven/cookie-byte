<?php

namespace DDM\CookieByte\UpdateScripts;

use DDM\CookieByte\Configuration\CookieByteConfig;
use DDM\CookieByte\Factories\CookieByteConfigFactory;
use Illuminate\Support\Collection;
use Statamic\Sites\Site;
use Statamic\UpdateScripts\UpdateScript;

abstract class UpdateConfigScript extends UpdateScript
{

    /**
     * @inheritDoc
     */
    abstract public function shouldUpdate($newVersion, $oldVersion): bool;

    /**
     * @inheritDoc
     */
	public function update()
	{
		$sites = Collection::make(\Statamic\Facades\Site::all());

		$sites->each(function (Site $site) {
			$this->updateForConfigIdentifier($site->handle());
			$this->updateForConfigIdentifier($site->locale());
		});

		$this->console()->info("Successfully updated Cookie Byte configs.");
	}

	protected function updateForConfigIdentifier($identifier)
	{
		try {
			$config = CookieByteConfigFactory::createConfigWithIdentifier($identifier);

			if (file_exists($config->path())) {
				$this->updateForConfig($config);
				$this->console()->info("Successfully updated Cookie Byte config for identifier '$identifier'.");
			}
		} catch (Throwable $th) {
			// Ignore
		}
	}

	abstract protected function updateForConfig(CookieByteConfig $config);
}