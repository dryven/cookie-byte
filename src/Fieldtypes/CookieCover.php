<?php

namespace DDM\CookieByte\Fieldtypes;

use DDM\CookieByte\CookieByte;
use DDM\CookieByte\Configuration\CookieByteConfig;
use Illuminate\Support\Facades\File;
use Statamic\Fieldtypes\Select;

class CookieCover extends Select
{
    protected $categories = ['relationship'];

    public static function title()
    {
        return CookieByte::getCpTranslation('cookie_cover_fieldtype_title');
    }

    public function icon()
    {
        return File::get(__DIR__ . '/../../resources/svg/cookie-byte.svg');
    }

    public function preload()
    {
        $config = new CookieByteConfig(CookieByte::getCurrentSiteIdentifier());
        $config = $config->values();
        $covers = array_get($config, 'covers', []);

        $options = collect($covers)->mapWithKeys(function ($cover) {
            $handle = array_get($cover, 'handle');
            $name = array_get($cover, 'name');
            return [$handle => $name ?? $handle];
        });
        return ['options' => $options];
    }

    protected function configFieldItems(): array
    {
        return [
            'placeholder' => [
                'display' => __('Placeholder'),
                'instructions' => __('statamic::fieldtypes.select.config.placeholder'),
                'type' => 'text',
                'default' => '',
                'width' => 50,
            ],
            'multiple' => [
                'display' => __('Multiple'),
                'instructions' => __('statamic::fieldtypes.select.config.multiple'),
                'type' => 'toggle',
                'default' => false,
                'width' => 50,
            ],
            'max_items' => [
                'display' => __('Max Items'),
                'instructions' => __('statamic::messages.max_items_instructions'),
                'min' => 1,
                'type' => 'integer',
                'width' => 50,
            ],
            'default' => [
                'display' => __('Default Value'),
                'instructions' => __('statamic::messages.fields_default_instructions'),
                'type' => 'text',
                'width' => 50,
            ],
        ];
    }
}
