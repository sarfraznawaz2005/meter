<?php

namespace Sarfraznawaz2005\Meter\Charts;

use Sarfraznawaz2005\Meter\Models\MeterModel;
use Sarfraznawaz2005\Meter\Monitors\DiskSpaceMonitor;
use Sarfraznawaz2005\Meter\Type;

class DiskSpaceChart extends Chart
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
            'title' => [
                'display' => true,
                'text' => [
                    'Min ' . round(collect($this->getValues())->min()) . ' | ' .
                    'Avg ' . round(collect($this->getValues())->average()) . ' | ' .
                    'Max ' . round(collect($this->getValues())->max())
                ],
            ],
            'legend' => false,
            'scales' => [
                'yAxes' => [[
                    'ticks' => [
                        'beginAtZero' => true
                    ],
                ]],
                'xAxes' => [[
                    'display' => false,
                    'ticks' => [
                        'beginAtZero' => true,
                        'autoSkip' => true,
                        'autoSkipPadding' => 30,
                        'maxRotation' => 0,
                    ],
                    'gridLines' => ['offsetGridLines' => true],
                    'offset' => true,
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
        foreach ($model->type(Type::DISK)->filtered()->orderBy('id', 'asc')->get() as $item) {
            $this->data[(string)$item->created_at] = $item->content['percent'];
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
        $type = config('meter.monitors.' . DiskSpaceMonitor::class . '.graph_type', 'bar');

        $this->dataset('Percent', $type, $this->getValues())
            ->color('rgb(' . static::COLOR_RED . ')')
            ->options([
                'pointRadius' => 2,
                'fill' => true,
                'lineTension' => 0,
                'borderWidth' => 1,
                //'minBarLength' => 50,
                'barPercentage' => 0.9
            ])
            ->backgroundcolor('rgba(' . static::COLOR_RED . ', 0.6)');
    }

}
