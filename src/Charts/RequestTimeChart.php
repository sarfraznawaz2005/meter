<?php

namespace Sarfraznawaz2005\Meter\Charts;

use Sarfraznawaz2005\Meter\Models\MeterModel;
use Sarfraznawaz2005\Meter\Type;

class RequestTimeChart extends Chart
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
                'text' => ['Average: ' . round(collect($this->getValues())->average()) . 'ms'],
            ],
            'legend' => false,
            'scales' => [
                'yAxes' => [[
                    'ticks' => [
                        'beginAtZero' => true
                    ],
                    'scaleLabel' => [
                        'display' => true,
                        'labelString' => 'Response Time (ms)'
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
        foreach ($model->type(Type::REQUEST)->orderBy('id', 'asc')->get() as $item) {
            $this->data[(string)$item->created_at] = $item->content['duration'];
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
        $this->dataset('Response Time', 'bar', $this->getValues())
            ->color('rgb(255, 99, 132)')
            ->options([
                'pointRadius' => 1,
                'fill' => true,
                'lineTension' => 0,
                'borderWidth' => 1
            ])
            ->backgroundcolor('rgba(255, 99, 132, 0.7)');
    }

}
