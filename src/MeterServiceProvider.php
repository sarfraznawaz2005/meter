<?php

namespace Sarfraznawaz2005\Meter;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;
use Sarfraznawaz2005\Meter\Console\PruneCommand;
use Sarfraznawaz2005\Meter\Console\PublishCommand;

class MeterServiceProvider extends ServiceProvider
{
    public function boot()
    {
        if (!config('meter.enabled')) {
            return;
        }

        Meter::start($this->app);

        Route::middlewareGroup('meter', array_merge(config('meter.middleware', []), ['web']));

        $this->loadViewsFrom(__DIR__ . '/Resources/Views', 'meter');

        $this->loadMigrationsFrom(__DIR__ . '/Migrations');

        Route::group([
            'domain' => config('meter.domain', null),
            'namespace' => 'Sarfraznawaz2005\Meter\Http\Controllers',
            'prefix' => config('meter.path'),
            'middleware' => 'meter',
        ], function () {
            $this->loadRoutesFrom(__DIR__ . '/Http/routes.php');
        });

        if ($this->app->runningInConsole()) {
            $this->publishes([__DIR__ . '/Config/config.php' => config_path('meter.php')], 'meter-config');
            $this->publishes([__DIR__ . '/Migrations' => database_path('migrations')], 'meter-migration');
            $this->publishes([__DIR__ . '/Resources/Views' => resource_path('views/vendor/meter')], 'meter-views');
            $this->publishes([__DIR__ . '/Resources/Assets' => public_path('vendor/meter')], 'meter-assets');
        }
    }

    /**
     * Register the application services.
     */
    public function register()
    {
        $this->mergeConfigFrom(__DIR__ . '/Config/config.php', 'meter');

        $this->commands([
            PruneCommand::class,
            PublishCommand::class,
        ]);

        $this->app->singleton('meter', static function () {
            return new Meter;
        });
    }
}
