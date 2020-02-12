<?php

namespace Sarfraznawaz2005\Meter;

use Illuminate\Contracts\Foundation\Application;
use Sarfraznawaz2005\Meter\Traits\RegistersMonitors;

class Meter
{
    use RegistersMonitors;

    /**
     * Indicates if Meter should monitor entries.
     *
     * @var bool
     */
    public static $shouldMonitor = false;

    /**
     * Starts Meter.
     *
     * @param Application $app
     */
    public static function start($app)
    {
        if (!config('meter.enabled')) {
            return;
        }

        if (static::runningApprovedArtisanCommand($app) || static::handlingApprovedRequest($app)) {
            static::registerMonitors($app);
            static::startMonitoring();
        }
    }

    /**
     * Determine if the application is running an approved command.
     *
     * @param $app
     * @return bool
     */
    protected static function runningApprovedArtisanCommand($app): bool
    {
        $ignoredCommands = array_merge([
            'migrate',
            'migrate:rollback',
            'migrate:fresh',
            'migrate:refresh',
            'migrate:reset',
            'migrate:install',
            'package:discover',
            'queue:listen',
            'queue:work',
            'horizon',
            'horizon:work',
            'horizon:supervisor',
        ], config('meter.ignore_commands', []));

        return $app->runningInConsole() && !in_array($_SERVER['argv'][1] ?? null, $ignoredCommands, true);
    }

    /**
     * Determine if the application is handling an approved request.
     *
     * @param $app
     * @return bool
     */
    protected static function handlingApprovedRequest($app): bool
    {
        $ignoredPaths = array_merge([
            config('meter.path') . '*',
            'meter*',
            'debugbar*',
            '_debugbar*',
            'clockwork*',
            '_clockwork*',
            'telescope*',
            'vendor/meter*',
            'horizon*',
            'vendor/horizon*',
            'nova-api*',
        ], config('meter.ignore_paths', []));

        return !$app->runningInConsole() && !$app['request']->is($ignoredPaths);
    }

    /**
     * Start monitoring.
     *
     * @return void
     */
    public static function startMonitoring()
    {
        static::$shouldMonitor = true;
    }

    /**
     * Stop monitoring.
     *
     * @return void
     */
    public static function stopMonitoring()
    {
        static::$shouldMonitor = false;
    }

    /**
     * Determine if Meter is monitoring.
     *
     * @return bool
     */
    public static function isMonitoring(): bool
    {
        return static::$shouldMonitor;
    }
}
