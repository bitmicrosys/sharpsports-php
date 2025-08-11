<?php

namespace Bitmicrosys\SharpsportsPhp;

use Illuminate\Support\ServiceProvider;

class SharpsportsServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->mergeConfigFrom(
            __DIR__ . '/../config/sharpsports.php',
            'sharpsports'
        );

        $this->app->singleton(SharpSports::class, function ($app) {
            $config = $app['config']['sharpsports'];
            
            return new SharpSports(
                $config['api_key'],
                $config['options'] ?? []
            );
        });

        $this->app->alias(SharpSports::class, 'sharpsports');
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        $this->publishes([
            __DIR__ . '/../config/sharpsports.php' => config_path('sharpsports.php'),
        ], 'sharpsports-config');
    }

    /**
     * Get the services provided by the provider.
     */
    public function provides(): array
    {
        return [SharpSports::class, 'sharpsports'];
    }
}