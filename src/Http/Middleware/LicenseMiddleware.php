<?php

namespace DDM\CookieByte\Http\Middleware;

use Closure;
use DDM\CookieByte\CookieByte;
use Statamic\Facades\CP\Toast;

class LicenseMiddleware
{
    public function handle($request, Closure $next)
    {
        $shouldShow = random_int(0, 99) < 16;

        if (!CookieByte::isLicenseValid() && $shouldShow) {
            $messageNumber = random_int(0, 2);
            Toast::clear();
            Toast::error(CookieByte::getCpTranslation("license_warning_toast_$messageNumber"));
        }

        return $next($request);
    }
}
