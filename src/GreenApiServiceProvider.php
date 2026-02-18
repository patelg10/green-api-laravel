<?php

namespace PatelG10\GreenApi;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Route;

class GreenApiServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        // 1. Merge the default config so the app can use it even if not published
        $this->mergeConfigFrom(__DIR__ . '/../config/greenapi.php', 'greenapi');

        // 2. Bind the main service class into the container as a singleton
        $this->app->singleton('greenapi', function ($app) {
            return new GreenApiService(config('greenapi'));
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // 3. Allow users to publish the config file using: 
        // php artisan vendor:publish --tag=greenapi-config
        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__ . '/../config/greenapi.php' => config_path('greenapi.php'),
            ], 'greenapi-config');
        }

        Route::group([
            'prefix' => 'greenapi',
            'middleware' => ['api'], // Standard API middleware
        ], function () {
            Route::post('webhook', \YourName\GreenApi\Http\Controllers\GreenApiWebhookController::class);
        });
    }
}
