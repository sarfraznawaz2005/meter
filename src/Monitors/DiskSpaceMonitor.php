<?php

namespace Sarfraznawaz2005\Meter\Monitors;

use Illuminate\Contracts\Foundation\Application;
use Sarfraznawaz2005\Meter\Type;

class DiskSpaceMonitor extends Monitor
{
    /**
     * Listens to event(s) and performs actions.
     *
     * @param Application $app
     * @return void
     */
    public function register($app)
    {
        $totalSpace = disk_total_space(base_path());
        $freeSpace = disk_free_space(base_path());
        $usedSpace = $totalSpace - $freeSpace;

        $percent = round(($usedSpace / $totalSpace) * 100);

        $this->record(Type::DISK, false, ['percent' => $percent]);
    }
}
