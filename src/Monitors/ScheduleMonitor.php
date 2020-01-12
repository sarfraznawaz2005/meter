<?php

namespace Sarfraznawaz2005\Meter\Monitors;

use Cron\CronExpression;
use Illuminate\Console\Events\CommandStarting;
use Illuminate\Console\Scheduling\CallbackEvent;
use Illuminate\Console\Scheduling\Event;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Contracts\Foundation\Application;
use Sarfraznawaz2005\Meter\Meter;
use Sarfraznawaz2005\Meter\Type;

class ScheduleMonitor extends Monitor
{
    protected $startTime = 0;

    /**
     * Listens to event(s) and performs actions.
     *
     * @param Application $app
     * @return mixed
     */
    public function register($app)
    {
        return $app->events->listen(CommandStarting::class, [$this, 'collect']);
    }

    /**
     * Collect entry data and save in $data variable.
     *
     * @param CommandStarting $event
     */
    public function collect(CommandStarting $event)
    {
        if (($event->command !== 'schedule:run' && $event->command !== 'schedule:finish') || !Meter::isMonitoring()) {
            return;
        }

        $this->startTime = microtime(true);

        collect(app(Schedule::class)->events())->each(function ($event) {
            $event->then(function () use ($event) {

                $expression = CronExpression::factory($event->expression);

                $content = [
                    'time' => floor((microtime(true) - $this->startTime) * 1000),
                    'command' => $event instanceof CallbackEvent ? 'Closure' : $this->fixupCommand($event->command),
                    'description' => $event->description,
                    'expression' => $event->expression,
                    'timezone' => $event->timezone,
                    'user' => $event->user,
                    'output' => $this->getEventOutput($event),
                    'next_run' => $expression->getNextRunDate(),
                ];

                $this->record(Type::SCHEDULE, false, $content);
            });
        });
    }

    /**
     * Get the output for the scheduled event.
     *
     * @param Event $event
     * @return string|null
     */
    protected function getEventOutput(Event $event)
    {
        if ($event->shouldAppendOutput || !$event->output || $event->output === $event->getDefaultOutput() || !file_exists($event->output)) {
            return '';
        }

        return trim(file_get_contents($event->output));
    }

    /**
     * Removes PHP path from command name.
     *
     * @param $command
     * @return string
     */
    protected function fixupCommand($command)
    {
        $parts = explode(' ', $command);

        if (count($parts) > 2 && ($parts[1] === "'artisan'" || $parts[1] === '"artisan"')) {
            array_shift($parts);
        }

        $command = implode(' ', $parts);

        return trim(str_ireplace(["'artisan'", '"artisan"'], '', $command));
    }
}
