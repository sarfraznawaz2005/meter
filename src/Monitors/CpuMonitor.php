<?php

namespace Sarfraznawaz2005\Meter\Monitors;

use Illuminate\Contracts\Foundation\Application;
use Sarfraznawaz2005\Meter\Type;

class CpuMonitor extends Monitor
{
    /**
     * Listens to event(s) and performs actions.
     *
     * @param Application $app
     * @return void
     */
    public function register($app)
    {
        $cpuPercent = shell_exec("grep 'cpu ' /proc/stat | awk '{usage=($2+$4)*100/($2+$4+$5)} END {print usage}'");

        $this->record(Type::CPU, false, ['percent' => round($cpuPercent)]);
    }
}
