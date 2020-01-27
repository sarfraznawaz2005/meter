<?php

namespace Sarfraznawaz2005\Meter\Console;

use Illuminate\Console\Command;
use Sarfraznawaz2005\Meter\Meter;
use Sarfraznawaz2005\Meter\Monitors\CpuMonitor;
use Sarfraznawaz2005\Meter\Monitors\DiskSpaceMonitor;
use Sarfraznawaz2005\Meter\Monitors\HttpConnectionsMonitor;
use Sarfraznawaz2005\Meter\Monitors\MemoryMonitor;

class ServerMonitorCommand extends Command
{
    protected $signature = 'meter:servermonitor';
    protected $description = 'Checks server stuff such as disk space, cpu usage, memory, etc';

    public static $serverMonitors = [
        CpuMonitor::class,
        DiskSpaceMonitor::class,
        MemoryMonitor::class,
        HttpConnectionsMonitor::class,
    ];

    public function handle()
    {
        if (Meter::isMonitoring()) {
            $app = app();

            foreach (static::$serverMonitors as $monitor) {
                if (config('meter.monitors.' . $monitor . '.enabled', true)) {
                    $monitor = $app->make($monitor);

                    $monitor->register($app);
                }
            }
        }
    }
}
