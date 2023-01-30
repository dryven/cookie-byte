<?php

    return [

        /**
         * This specifies the asset container, which is used for all asset fields in the Cookie Byte config.
         */
        'asset_container' => 'assets',

        /**
         * This specifies the directory, in which the addon will save its Control Panel configuration file.
         */
        'config_dirname' => base_path("content"),

        /**
         * This specifies the value to save the configuration under.
		 *
		 * Allowed options:
		 * - \DDM\CookieByte\CookieByte::HANDLE_IDENTIFIER | Uses the site handle to save. Useful if you have multiple domains.
		 * - \DDM\CookieByte\CookieByte::LOCALE_IDENTIFIER | Uses the site locale. Recommended if you only translate the text.
         */
        'site_identifier_type' => \DDM\CookieByte\CookieByte::LOCALE_IDENTIFIER,
    ];