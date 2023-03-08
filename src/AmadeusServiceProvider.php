<?php

namespace Jeff\Amadeus;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\File;

class AmadeusServiceProvider extends ServiceProvider
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
        if (!File::exists(config_path('amadeus.php'))) {
            File::ensureDirectoryExists(config_path());

            $this->publishes([
                __DIR__ . '/config/amadeus.php' => config_path('amadeus.php')
            ], 'config');
        }

        $this->app->singleton('amadeus', function () {
            return new Amadeus;
        });
        
        return $this->app->make('amadeus');
    }
}