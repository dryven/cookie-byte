<?php

namespace DDM\CookieByte\Fieldtypes;

use DDM\CookieByte\Configuration\CookieByteConfig;
use DDM\CookieByte\CookieByte;
use Statamic\Support\Arr;
use Statamic\Fieldtypes\Select;
use Illuminate\Support\Facades\File;

class CookieHandleSelect extends Select
{

	protected $categories = ['relationship'];
	protected $selectableInForms = false;
	protected $indexComponent = 'relationship';

	/** @var CookieByteConfig */
	protected $config;

	public function __construct()
	{
		$this->config = new CookieByteConfig(CookieByte::getCurrentSiteIdentifier());
	}


	public function icon()
	{
		return File::get(__DIR__ . '/../../resources/svg/cookie-byte.svg');
	}

	protected function configFieldItems(): array
	{
		$inheritableFieldKeys = ['placeholder', 'multiple', 'max_items', 'default'];

		return Arr::only(parent::configFieldItems(), $inheritableFieldKeys);
	}
}