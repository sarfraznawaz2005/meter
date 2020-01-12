<?php

namespace Sarfraznawaz2005\Meter\Charts;

use Sarfraznawaz2005\Meter\Models\MeterModel;
use Sarfraznawaz2005\Meter\Monitors\CommandMonitor;
use Sarfraznawaz2005\Meter\Monitors\EventMonitor;
use Sarfraznawaz2005\Meter\Monitors\QueryMonitor;
use Sarfraznawaz2005\Meter\Monitors\RequestMonitor;
use Sarfraznawaz2005\Meter\Monitors\ScheduleMonitor;
use function foo\func;

class OverAllTimesChart extends Chart
{
    /**
     * Sets options for chart.
     *
     * @return void
     */
    protected function setOptions()
    {
        $this->options([
            'responsive' => true,
            'maintainAspectRatio' => false,
            'scales' => [
                'yAxes' => [[
                    'ticks' => [
                        'beginAtZero' => true
                    ],
                ]],
                'xAxes' => [[
                    'display' => false,
                ]]
            ],
        ], true);
    }

    /**
     * Sets data for chart.
     *
     * @param MeterModel $model
     * @return void
     */
    protected function setData(MeterModel $model)
    {
        foreach ($model->filtered()->orderBy('id', 'asc')->get() as $item) {
            $time = 0;

            if (isset($item->content['duration'])) {
                $time = $item->content['duration'];
            } elseif (isset($item->content['time'])) {
                $time = $item->content['time'];
            }

            $this->data[(string)$item->created_at] = [
                'type' => $item->type,
                'time' => $time
            ];
        }
    }

    /**
     * Gets labels for chart.
     *
     * @return mixed
     */
    protected function getLabels(): array
    {
        return array_keys($this->data);
    }

    /**
     * Gets values for chart.
     *
     * @return mixed
     */
    protected function getValues(): array
    {
        return array_values($this->data);
    }

    /**
     * Generates and returns chart
     *
     * @return void
     */
    protected function setDataSet()
    {
        if (config('meter.monitors.' . RequestMonitor::class . '.enabled', true)) {
            $this->dataset('Response Time', 'line', collect($this->getValues())->where('type', 'request')->pluck('time'))
                ->color('rgb(0, 123, 255)')
                ->options([
                    'pointRadius' => 2,
                    'fill' => true,
                    'lineTension' => 0,
                    'borderWidth' => 1,
                    'barPercentage' => 0.9
                ])
                ->backgroundcolor('rgba(0, 123, 255, 0.6)');
        }

        if (config('meter.monitors.' . QueryMonitor::class . '.enabled', true)) {
            $this->dataset('Query Time', 'line', collect($this->getValues())->where('type', 'query')->pluck('time'))
                ->color('rgb(40, 167, 69)')
                ->options([
                    'pointRadius' => 2,
                    'fill' => true,
                    'lineTension' => 0,
                    'borderWidth' => 1,
                    'barPercentage' => 0.9
                ])
                ->backgroundcolor('rgba(40, 167, 69, 0.6)');
        }

        if (config('meter.monitors.' . CommandMonitor::class . '.enabled', true)) {
            $this->dataset('Command Time', 'line', collect($this->getValues())->where('type', 'command')->pluck('time'))
                ->color('rgb(23, 162, 184)')
                ->options([
                    'pointRadius' => 2,
                    'fill' => true,
                    'lineTension' => 0,
                    'borderWidth' => 1,
                    'barPercentage' => 0.9
                ])
                ->backgroundcolor('rgba(23, 162, 184, 0.6)');
        }

        if (config('meter.monitors.' . EventMonitor::class . '.enabled', true)) {
            $this->dataset('Event Time', 'line', collect($this->getValues())->where('type', 'event')->pluck('time'))
                ->color('rgb(255, 193, 7)')
                ->options([
                    'pointRadius' => 2,
                    'fill' => true,
                    'lineTension' => 0,
                    'borderWidth' => 1,
                    'barPercentage' => 0.9
                ])
                ->backgroundcolor('rgba(255, 193, 7, 0.6)');
        }

        if (config('meter.monitors.' . ScheduleMonitor::class . '.enabled', true)) {
            $this->dataset('Schedule Time', 'line', collect($this->getValues())->where('type', 'schedule')->pluck('time'))
                ->color('rgb(220, 53, 69)')
                ->options([
                    'pointRadius' => 2,
                    'fill' => true,
                    'lineTension' => 0,
                    'borderWidth' => 1,
                    'barPercentage' => 0.9
                ])
                ->backgroundcolor('rgba(220, 53, 69, 0.6)');
        }
    }

}
