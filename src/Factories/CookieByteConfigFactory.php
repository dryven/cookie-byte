<?php

namespace DDM\CookieByte\Factories;

use DDM\CookieByte\Configuration\CookieByteConfig;
use DDM\CookieByte\CookieByte;
use DDM\CookieByte\Exceptions\CookieByteException;
use Statamic\Facades\YAML;

class CookieByteConfigFactory
{

	/**
	 * Creates a config.
	 *
	 * @return CookieByteConfig
	 * @throws CookieByteException
	 */
	public static function createConfig(): CookieByteConfig
	{
		return self::createConfigWithIdentifier(CookieByte::getCurrentSiteIdentifier());
	}

	/**
	 * Create a config with a given config path.
	 *
	 * @param string $configPath
	 * @return CookieByteConfig
	 * @throws CookieByteException
	 */
	public static function createConfigWithPath(string $configPath): CookieByteConfig
	{
		$configData =  YAML::file($configPath)->parse();
		return new CookieByteConfig($configData, $configPath);
	}

	/**
	 * Create a config with a given identifier.
	 *
	 * @param string $identifier
	 * @return CookieByteConfig
	 * @throws CookieByteException
	 */
	public static function createConfigWithIdentifier(string $identifier): CookieByteConfig
	{
		$configPath = CookieByte::getConfigurationPath($identifier);
		$configData = CookieByte::getConfigurationData($identifier);

		return new CookieByteConfig($configData, $configPath);
	}

}