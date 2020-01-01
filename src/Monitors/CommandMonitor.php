<?php

namespace Sarfraznawaz2005\Meter\Monitors;

use Illuminate\Console\Events\CommandFinished;
use Illuminate\Contracts\Foundation\Application;
use Sarfraznawaz2005\Meter\Meter;
use Sarfraznawaz2005\Meter\Type;

class CommandMonitor extends Monitor
{
    /**
     * Listens to event(s) and performs actions.
     *
     * @param Application $app
     * @return mixed
     */
    public function register($app)
    {
        return $app->events->listen(CommandFinished::class, [$this, 'collect']);
    }

    /**
     * Collect entry data and save in $data variable.
     *
     * @param CommandFinished $event
     */
    public function collect(CommandFinished $event)
    {
        if (!Meter::isMonitoring() || $this->shouldIgnore($event)) {
            return;
        }

        $content = [
            'command' => $event->command ?? $event->input->getArguments()['command'] ?? 'default',
            'exit_code' => $event->exitCode,
            'arguments' => $event->input->getArguments(),
            'options' => $event->input->getOptions(),
        ];

        $this->record(Type::COMMAND, false, $content);
    }

    /**
     * Determine if the event should be ignored.
     *
     * @param mixed $event
     * @return bool
     */
    private function shouldIgnore($event): bool
    {
        return in_array($event->command, array_merge($this->options['ignore'] ?? [], [
            'schedule:run',
            'schedule:finish',
            'package:discover',
            'meter:prune',
            'meter:publish',
        ]), true);
    }
}
