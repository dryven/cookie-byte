<?php

namespace DDM\CookieByte\Fieldtypes;

use DDM\CookieByte\CookieByte;

class CookieCategory extends CookieHandleSelect
{
	protected $categories = ['relationship'];

	public static function title()
	{
		return CookieByte::getCpTranslation('cookie_category_fieldtype_title');
	}

	/**
	 * Pre-process the data before it gets sent to the publish page.
	 *
	 * @param mixed $value
	 * @return array|mixed
	 */
	public function preProcess($value)
	{
		if (is_string($value)) {
			$value = explode(',', $value);
		}

		return $value;
	}

	public function preload()
	{
		$categories = $this->config->rawValue('categories', []);

		return [
			'options' => collect($categories)->mapWithKeys(function ($category) {
				$handle = array_get($category, 'handle');
				$title = array_get($category, 'title');

				return [$handle => $title ?? $handle];
			})
		];
	}
}
