<?php

namespace Sarfraznawaz2005\Meter\Monitors;

use Illuminate\Contracts\Foundation\Application;
use Sarfraznawaz2005\Meter\Type;

class MemoryMonitor extends Monitor
{
    /**
     * Listens to event(s) and performs actions.
     *
     * @param Application $app
     * @return void
     */
    public function register($app)
    {
        try {
            if (stripos(PHP_OS, 'win') !== 0 && stripos(PHP_OS, 'mac') !== 0) {
                $free = shell_exec('free');
                $free = (string)trim($free);
                $freeArr = explode("\n", $free);
                $mem = explode(' ', $freeArr[1]);
                $mem = array_filter($mem);
                $mem = array_merge($mem);
                $percent = round($mem[2] / $mem[1] * 100);

                $this->record(Type::MEMORY, false, ['percent' => $percent]);
            }
        } catch (\Exception $e) {
        }

    }
}
