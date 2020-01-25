<?php

namespace Sarfraznawaz2005\Meter\Monitors;

use Illuminate\Contracts\Foundation\Application;
use Sarfraznawaz2005\Meter\Type;

class HttpConnectionsMonitor extends Monitor
{
    /**
     * Listens to event(s) and performs actions.
     *
     * @param Application $app
     * @return void
     */
    public function register($app)
    {
        $count = 0;

        // connections on port 80
        $connections = shell_exec('netstat -an | grep :80 2>&1');

        if (trim($connections)) {
            $count = count(array_filter(explode("\n", $connections)));
        }

        $this->record(Type::CONNECTIONS, false, ['count' => $count]);
    }
}
