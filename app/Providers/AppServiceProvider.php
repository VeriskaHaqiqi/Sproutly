<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Number;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        // MATIKAN PENGGUNAAN INTL
        if (!extension_loaded('intl')) {
            Number::useLocale('en');
        }
         // FORCE DEBUG MODE
        config(['app.debug' => true]);
    }
}