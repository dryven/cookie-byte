<?php

namespace DDM\CookieByte\Fieldtypes;

use DDM\CookieByte\CookieByte;
use DDM\CookieByte\Configuration\CookieByteConfig;
use Illuminate\Support\Facades\File;
use Statamic\Fieldtypes\Select;

class CookieCategory extends Select
{
    protected $categories = ['relationship'];

    public static function title()
    {
        return CookieByte::getCpTranslation('cookie_category_fieldtype_title');
    }

    public function icon()
    {
        return File::get(__DIR__ . '/../../resources/svg/cookie-byte.svg');
    }

    /**
     * Pre-process the data before it gets sent to the publish page.
     *
     * @param mixed $data
     * @return array|mixed
     */
    public function preProcess($data)
    {
        if (is_string($data))
            $data = explode(',', $data);
        return $data;
    }

    public function preload()
    {
        $config = new CookieByteConfig(CookieByte::getCurrentSiteIdentifier());
        $config = $config->values();
        $covers = array_get($config, 'categories', []);

        $options = collect($covers)->mapWithKeys(function ($cover) {
            $handle = array_get($cover, 'handle');
            $title = array_get($cover, 'title');
            return [$handle => $title];
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
