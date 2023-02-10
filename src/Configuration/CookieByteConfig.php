<?php

namespace DDM\CookieByte\Configuration;

use DDM\CookieByte\CookieByte;
use Statamic\Support\Arr;
use Statamic\Facades\File;
use Statamic\Facades\YAML;
use Statamic\Fields\Fields;
use Illuminate\Http\Request;
use Statamic\Fields\Blueprint;

class CookieByteConfig
{

	protected $currentIdentifier;
	protected $blueprint;
	protected $configPath;
	protected $configData;

	public function __construct($identifier)
	{
		$this->currentIdentifier = $identifier;
		$this->blueprint = \Statamic\Facades\Blueprint::make()->setContents(ConfigBlueprint::getBlueprint());
		$this->configPath = CookieByte::getConfigurationPath($this->currentIdentifier);
		$this->configData = CookieByte::getConfigurationData($this->currentIdentifier);
	}

	/**
	 * Returns the blueprint.
	 *
	 * @return Blueprint
	 */
	public function blueprint(): Blueprint
	{
		return $this->blueprint;
	}

	/**
	 * Returns the path to the configuration file.
	 *
	 * @return string
	 */
	public function path(): string
	{
		return $this->configPath;
	}

	/**
	 * Returns the raw array data.
	 *
	 * @return array
	 */
	public function raw(): array
	{
		return $this->configData;
	}

	/**
	 * Get the raw value of a config item using dot notation.
	 *
	 * @param string $key
	 * @param mixed $default
	 * @return mixed
	 */
	public function getValue(string $key, $default = null)
	{
		return array_get($this->raw(), $key, $default);
	}

	/**
	 * Returns the values augmented by the blueprint.
	 */
	public function values(): array
	{
		return $this->fields()->values()->all();
	}

	/**
	 * Returns the current blueprint fields.
	 *
	 * @return Fields
	 */
	public function fields(): Fields
	{
		return $this->blueprint->fields()->addValues($this->raw())->preProcess();
	}

	/**
	 * Validates and returns the values without fields equal to null.
	 *
	 * @param Request $request
	 *
	 * @return array
	 */
	public function validatedValues(Request $request): array
	{
		$fields = $this->blueprint->fields()->addValues($request->all());

		$fields->validate();

		return Arr::removeNullValues($fields->process()->values()->all());
	}

	/**
	 * Sets the configuration data / values array.
	 *
	 * @param array $values
	 *
	 * @return $this
	 */
	public function setValues(array $values): CookieByteConfig
	{
		$this->configData = $values;

		return $this;
	}

	/**
	 * Adds data / values to the existing configuration.
	 *
	 * @param array $values
	 * @return $this
	 */
	public function addValues(array $values): CookieByteConfig
	{
		$this->configData = array_merge($this->configData, $values);

		return $this;
	}

	/**
	 * Adds a keyed value to the existing configuration.
	 *
	 * @param $key
	 * @param $value
	 * @return $this
	 */
	public function addValue($key, $value): CookieByteConfig
	{
		$this->addValues([$key => $value]);

		return $this;
	}

	/**
	 * Returns whether the default stylesheet should be added.
	 *
	 * @return bool
	 */
	public function shouldAddStylesheet(): bool
	{
		return !(array_key_exists('custom_style', $this->configData) && $this->configData['custom_style']);
	}

	/**
	 * Returns whether the default JavaScript code should be added.
	 *
	 * @return bool
	 */
	public function shouldAddJavaScript(): bool
	{
		return !(array_key_exists('custom_code', $this->configData) && $this->configData['custom_code']);
	}

	/**
	 * Saves the configuration to disk.
	 */
	public function save()
	{
		File::disk()->put($this->configPath, YAML::dump($this->configData));
	}
}
