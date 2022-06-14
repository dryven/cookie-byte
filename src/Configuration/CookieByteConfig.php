<?php

namespace DDM\CookieByte\Configuration;

use Illuminate\Http\Request;
use Statamic\Facades\File;
use Statamic\Facades\Site;
use Statamic\Facades\YAML;
use Statamic\Fields\Blueprint;
use Statamic\Fields\Fields;
use Statamic\Support\Arr;

/**
 * Class CookieByteConfig
 * @package DDM\CookieByte\Configuration
 * @author  DDM Studiio
 */
class CookieByteConfig
{

	protected $currentLocale;
	protected $blueprint;
	protected $configPath;
	protected $configData;

	public function __construct($locale)
	{
		$this->currentLocale = $locale;
		$this->blueprint = \Statamic\Facades\Blueprint::make()->setContents(ConfigBlueprint::getBlueprint());
		$this->configPath = base_path("content/cookie_byte_" . $this->currentLocale . ".yaml");
		$this->configData = YAML::parse(File::disk()->get($this->configPath));
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
	 * Returns the blueprint.
	 *
	 * @return Blueprint
	 */
	public function blueprint(): Blueprint
	{
		return $this->blueprint;
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
	 * Returns the raw array data.
	 *
	 * @return array
	 */
	public function raw(): array
	{
		return $this->configData;
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
	 * Saves the configuration to disk.
	 */
	public function save()
	{
		File::disk()->put($this->configPath, YAML::dump($this->configData));
	}
}
