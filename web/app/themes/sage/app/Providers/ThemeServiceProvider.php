<?php

namespace App\Providers;

use Roots\Acorn\ServiceProvider;

class ThemeServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // Register the asset manifest
        $this->app->singleton('assets', function () {
            return new \Roots\Acorn\Assets\Manifest(
                get_theme_file_path('public/manifest.json'),
                get_theme_file_uri('public')
            );
        });
    }
}