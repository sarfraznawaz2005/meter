<?php

namespace Sarfraznawaz2005\Meter\Traits;

use Illuminate\Contracts\Foundation\Application;

trait RegistersMonitors
{
    /**
     * The class names of the registered monitors.
     *
     * @var array
     */
    protected static $monitors = [];

    /**
     * Determine if a given monitor has been registered.
     *
     * @param string $class
     * @return bool
     */
    public static function hasMonitor($class): bool
    {
        return in_array($class, static::$monitors, true);
    }

    /**
     * Register the configured Meter monitors.
     *
     * @param Application $app
     * @return void
     */
    protected static function registerMonitors($app)
    {
        foreach (config('meter.monitors') as $key => $monitor) {

            if (is_string($key) && $monitor === false) {
                continue;
            }

            if (is_array($monitor) && !($monitor['enabled'] ?? true)) {
                continue;
            }

            $monitor = $app->make(is_string($key) ? $key : $monitor, [
                'options' => is_array($monitor) ? $monitor : [],
            ]);

            static::$monitors[] = get_class($monitor);

            $monitor->register($app);
        }
    }

    /**
     * Returns all registered monitors.
     *
     * @return array
     */
    protected static function getMonitors(): array
    {
        return static::$monitors;
    }
}
