<?php

namespace Sarfraznawaz2005\Meter\Monitors;

use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use ReflectionClass;
use ReflectionFunction;
use Sarfraznawaz2005\Meter\Meter;
use Sarfraznawaz2005\Meter\Traits\FormatsClosure;
use Sarfraznawaz2005\Meter\Type;

class EventMonitor extends Monitor
{
    use FormatsClosure;

    /**
     * Listens to event(s) and performs actions.
     *
     * @param Application $app
     * @return mixed
     */
    public function register($app)
    {
        return $app->events->listen('*', [$this, 'collect']);
    }

    /**
     * Collect entry data and save in $data variable.
     *
     * @param $eventName
     * @param $payload
     * @throws \ReflectionException
     */
    public function collect($eventName, $payload)
    {
        if (!Meter::isMonitoring() || $this->shouldIgnore($eventName)) {
            return;
        }

        $formattedPayload = $this->extractPayload($eventName, $payload);

        $content = [
            'name' => $eventName,
            'payload' => empty($formattedPayload) ? null : $formattedPayload,
            'listeners' => $this->formatListeners($eventName),
            'broadcast' => class_exists($eventName)
                ? in_array(ShouldBroadcast::class, (array)class_implements($eventName), true)
                : false,
        ];

        $this->record(Type::EVENT, false, $content);
    }

    /**
     * Extract the payload and tags from the event.
     *
     * @param string $eventName
     * @param array $payload
     * @return array
     * @throws \ReflectionException
     */
    protected function extractPayload($eventName, $payload): array
    {
        if (is_object($payload[0]) && isset($payload[0]) && class_exists($eventName)) {
            return $this->extractProperties($payload[0]);
        }

        return collect($payload)->map(static function ($value) {
            return is_object($value) ? [
                'class' => get_class($value),
                'properties' => json_decode(json_encode($value), true),
            ] : $value;
        })->toArray();
    }

    /**
     * Extract the properties for the given object in array form.
     *
     * The given array is ready for storage.
     *
     * @param mixed $target
     * @return array
     * @throws \ReflectionException
     */
    protected function extractProperties($target): array
    {
        return collect((new ReflectionClass($target))->getProperties())
            ->mapWithKeys(static function ($property) use ($target) {
                $property->setAccessible(true);

                if (($value = $property->getValue($target)) instanceof Model) {
                    return [$property->getName() => meterFormatModel($value)];
                }

                if (is_object($value)) {
                    return [
                        $property->getName() => [
                            'class' => get_class($value),
                            'properties' => json_decode(json_encode($value), true),
                        ],
                    ];
                }

                return [$property->getName() => json_decode(json_encode($value), true)];
            })->toArray();
    }

    /**
     * Format list of event listeners.
     *
     * @param string $eventName
     * @return array
     */
    protected function formatListeners($eventName): array
    {
        return collect(app('events')->getListeners($eventName))
            ->map(function ($listener) {
                $listener = (new ReflectionFunction($listener))->getStaticVariables()['listener'];

                if (is_string($listener)) {
                    return Str::contains($listener, '@') ? $listener : $listener . '@handle';
                }

                if (is_array($listener)) {
                    return get_class($listener[0]) . '@' . $listener[1];
                }

                return $this->formatClosureListener($listener);

            })->reject(static function ($listener) {
                return Str::contains($listener, 'Laravel\\Telescope');
            })->map(static function ($listener) {

                if (Str::contains($listener, '@')) {
                    $queued = in_array(ShouldQueue::class, class_implements(explode('@', $listener)[0]), true);
                }

                return [
                    'name' => $listener,
                    'queued' => $queued ?? false,
                ];

            })->values()->toArray();
    }

    /**
     * Determine if the event should be ignored.
     *
     * @param string $eventName
     * @return bool
     */
    protected function shouldIgnore($eventName): bool
    {
        return $this->eventIsIgnored($eventName) || $this->eventIsFiredByTheFramework($eventName);
    }

    /**
     * Determine if the event was fired internally by Laravel.
     *
     * @param string $eventName
     * @return bool
     */
    protected function eventIsFiredByTheFramework($eventName): bool
    {
        return Str::is(
            ['Illuminate\*', 'eloquent*', 'bootstrapped*', 'bootstrapping*', 'creating*', 'composing*'],
            $eventName
        );
    }

    /**
     * Determine if the event is ignored manually.
     *
     * @param string $eventName
     * @return bool
     */
    protected function eventIsIgnored($eventName): bool
    {
        return Str::is($this->options['ignore'] ?? [], $eventName);
    }
}
