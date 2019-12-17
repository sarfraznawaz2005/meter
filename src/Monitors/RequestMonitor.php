<?php

namespace Sarfraznawaz2005\Meter\Monitors;

use Illuminate\Contracts\Foundation\Application;
use Illuminate\Foundation\Http\Events\RequestHandled;
use Sarfraznawaz2005\Meter\Meter;
use Sarfraznawaz2005\Meter\Type;

class RequestMonitor extends Monitor
{
    /**
     * Listens to event(s) and performs actions.
     *
     * @param Application $app
     * @return mixed
     */
    public function register($app)
    {
        return $app->events->listen(RequestHandled::class, [$this, 'collect']);
    }

    /**
     * Collect entry data and save in $data variable.
     *
     * @param RequestHandled $event
     */
    public function collect(RequestHandled $event)
    {
        if (!Meter::isMonitoring()) {
            return;
        }

        $isSlow = false;

        $startTime = defined('LARAVEL_START') ? LARAVEL_START : $event->request->server('REQUEST_TIME_FLOAT');
        $duration = $startTime ? floor((microtime(true) - $startTime) * 1000) : null;

        if (isset($this->options['slow']) && $duration) {
            $isSlow = $duration >= $this->options['slow'];
        }

        $content = [
            'uri' => str_replace($event->request->root(), '', $event->request->fullUrl()) ?: '/',
            'method' => $event->request->method(),
            'controller_action' => optional($event->request->route())->getActionName(),
            'middleware' => array_values(optional($event->request->route())->gatherMiddleware() ?? []),
            'response_status' => $event->response->getStatusCode(),
            'duration' => $duration,
            'memory' => round(memory_get_peak_usage(true) / 1024 / 1025, 1),
            'ip' => $event->request->ip(),
        ];

        $this->record(Type::REQUEST, $isSlow, $content);
    }
}
