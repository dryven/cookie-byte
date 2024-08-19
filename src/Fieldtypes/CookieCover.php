<?php

namespace DDM\CookieByte\Fieldtypes;

use DDM\CookieByte\CookieByte;

class CookieCover extends CookieHandleSelect
{
	protected $categories = ['relationship'];

	public static function title()
	{
		return CookieByte::getCpTranslation('cookie_cover_fieldtype_title');
	}

	public function preload(): array
	{
		$covers = $this->config->rawValue('covers', []);

		return [
			'options' => collect($covers)->mapWithKeys(function ($cover) {
				$handle = array_get($cover, 'handle');
				$name = array_get($cover, 'name');

				return [$handle => $name ?? $handle];
			})
		];
	}
}
