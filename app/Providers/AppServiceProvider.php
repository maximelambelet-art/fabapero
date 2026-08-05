<?php

namespace App\Providers;

use Illuminate\Support\Facades\URL;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        if ($this->app->environment('production')) {
            URL::forceScheme('https');

            // The hosting answers on both fabapero.ch and www.fabapero.ch, and
            // Laravel builds URLs from whichever host was requested — so the
            // www copy was declaring itself canonical and reading as a second,
            // duplicate site. Pinning the root to APP_URL makes canonical,
            // hreflang, the sitemap and Open Graph all name the same host.
            URL::forceRootUrl(config('app.url'));
        }
    }
}
