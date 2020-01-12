<?php

namespace Sarfraznawaz2005\Meter\Charts;

use Balping\JsonRaw\Raw;
use Illuminate\Support\Str;
use Sarfraznawaz2005\Meter\Models\MeterModel;
use Sarfraznawaz2005\Meter\Monitors\QueryMonitor;
use Sarfraznawaz2005\Meter\Type;

class QueriesTimeChart extends Chart
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
                'text' => ['Average: ' . round(collect($this->getValues())->pluck('y')->average()) . 'ms'],
            ],
            'legend' => false,
            'scales' => [
                'yAxes' => [[
                    'ticks' => [
                        'beginAtZero' => true
                    ],
                    'scaleLabel' => [
                        'display' => true,
                        'labelString' => 'Time (ms)'
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
                    'label' => new Raw('function(item, data) { return "Time: " + data.datasets[item.datasetIndex].data[item.index].y + " (Query: " + data.datasets[item.datasetIndex].data[item.index].x + ")"}')
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
        foreach ($model->type(Type::QUERY)->filtered()->orderBy('id', 'asc')->get() as $item) {
            if (isset($item->content['time'])) {
                $this->data[(string)$item->created_at] = [
                    'x' => Str::limit($item->content['sql'], 120),
                    'y' => $item->content['time'],
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
        $type = config('meter.monitors.' . QueryMonitor::class . '.graph_type', 'bar');

        $this->dataset('Query Time', $type, $this->getValues())
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
