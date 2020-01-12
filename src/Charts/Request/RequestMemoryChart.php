<?php

namespace Sarfraznawaz2005\Meter\Charts\Request;

use Balping\JsonRaw\Raw;
use Sarfraznawaz2005\Meter\Charts\Chart;
use Sarfraznawaz2005\Meter\Models\MeterModel;
use Sarfraznawaz2005\Meter\Monitors\RequestMonitor;
use Sarfraznawaz2005\Meter\Type;

class RequestMemoryChart extends Chart
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
                    'Min ' . round(collect($this->getValues())->pluck('y')->min()) . ' | ' .
                    'Avg ' . round(collect($this->getValues())->pluck('y')->average()) . ' | ' .
                    'Max ' . round(collect($this->getValues())->pluck('y')->max())
                ],
            ],
            'legend' => false,
            'scales' => [
                'yAxes' => [[
                    'ticks' => [
                        'beginAtZero' => true
                    ],
                    'scaleLabel' => [
                        'display' => true,
                        'labelString' => 'Memory (MB)'
                    ]
                ]],
                'xAxes' => [[
                    'display' => false,
                    //'type' => 'time',
                    'time' => [
                        'displayFormats' => ['hour' => 'MMM D hA'],
                    ],
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
            'tooltips' => [
                'callbacks' => [
                    'label' => new Raw('function(item, data) { return "Memory: " + data.datasets[item.datasetIndex].data[item.index].y + " (Path: " + data.datasets[item.datasetIndex].data[item.index].x + ")"}')
                ]
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
        foreach ($model->type(Type::REQUEST)->filtered()->orderBy('id', 'asc')->get() as $item) {
            if (isset($item->content['memory'])) {
                $this->data[(string)$item->created_at] = [
                    'x' => $item->content['uri'],
                    'y' => $item->content['memory'],
                ];
            }
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
        $type = config('meter.monitors.' . RequestMonitor::class . '.graph_type', 'bar');

        $this->dataset('Memory', $type, $this->getValues())
            ->color('rgb(255, 99, 132)')
            ->options([
                'pointRadius' => 2,
                'fill' => true,
                'lineTension' => 0,
                'borderWidth' => 1,
                //'minBarLength' => 50,
                'barPercentage' => 0.9
            ])
            ->backgroundcolor('rgba(255, 99, 132, 0.6)');
    }

}
