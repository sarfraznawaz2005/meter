<?php

namespace Sarfraznawaz2005\Meter\Monitors;

use Illuminate\Contracts\Foundation\Application;
use Illuminate\Database\Events\QueryExecuted;
use Sarfraznawaz2005\Meter\Meter;
use Sarfraznawaz2005\Meter\Traits\FetchesStackTrace;
use Sarfraznawaz2005\Meter\Type;

class QueryMonitor extends Monitor
{
    use FetchesStackTrace;

    /**
     * Listens to event(s) and performs actions.
     *
     * @param Application $app
     * @return mixed
     */
    public function register($app)
    {
        return $app->events->listen(QueryExecuted::class, [$this, 'collect']);
    }

    /**
     * Collect entry data and save in $data variable.
     *
     * @param QueryExecuted $event
     */
    public function collect(QueryExecuted $event)
    {
        if (!Meter::isMonitoring()) {
            return;
        }

        $time = $event->time;

        $isSlow = isset($this->options['slow']) && $time >= $this->options['slow'];

        $caller = $this->getCallerFromStackTrace();

        $content = [
            'connection' => $event->connectionName,
            'sql' => $this->replaceBindings($event),
            'time' => number_format($time, 2),
            'file' => $caller['file'],
            'line' => $caller['line'],
        ];

        $this->record(Type::QUERY, $isSlow, $content);
    }

    /**
     * Replace the placeholders with the actual bindings.
     *
     * @param QueryExecuted $event
     * @return string
     */
    public function replaceBindings($event): string
    {
        $sql = $event->sql;

        foreach ($this->formatBindings($event) as $key => $binding) {
            $regex = is_numeric($key)
                ? "/\?(?=(?:[^'\\\']*'[^'\\\']*')*[^'\\\']*$)/"
                : "/:{$key}(?=(?:[^'\\\']*'[^'\\\']*')*[^'\\\']*$)/";

            if ($binding === null) {
                $binding = 'null';
            } elseif (!is_int($binding) && !is_float($binding)) {
                $binding = $event->connection->getPdo()->quote($binding);
            }

            $sql = preg_replace($regex, $binding, $sql, 1);
        }

        return $sql;
    }

    /**
     * Format the given bindings to strings.
     *
     * @param QueryExecuted $event
     * @return array
     */
    protected function formatBindings($event): array
    {
        return $event->connection->prepareBindings($event->bindings);
    }
}
