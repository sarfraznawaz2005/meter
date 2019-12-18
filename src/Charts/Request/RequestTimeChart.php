<?php

namespace Sarfraznawaz2005\Meter\Charts\Request;

use Illuminate\Database\Eloquent\Builder;
use Sarfraznawaz2005\Meter\Charts\Chart;
use Sarfraznawaz2005\Meter\Models\MeterModel;
use Sarfraznawaz2005\Meter\Type;

class RequestTimeChart extends Chart
{
    public function __construct(MeterModel $model)
    {
        parent::__construct();

        // fixme
        $this->buildChart($this->getDataSet($model->type(Type::REQUEST)->orderBy('id', 'asc')));
    }

    /**
     * Gets data set for chart.
     *
     * @param Builder $builder
     * @return array|mixed
     */
    public function getDataSet(Builder $builder)
    {
        $dataSet = [];

        foreach ($builder->get() as $item) {
            $dataSet[(string)$item->created_at] = $item->content['duration'];
        }

        return $dataSet;
    }

    /**
     * Generates and returns chart
     *
     * @param array $dataSet
     * @return mixed
     */
    public function buildChart(array $dataSet)
    {
        $this->options([
            'responsive' => true,
            'maintainAspectRatio' => false,
            'legend' => false,
            'scales' => [
                'yAxes' => [[
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

        $this->labels(array_keys($dataSet));

        $this->dataset('Response Time', 'bar', array_values($dataSet))
            ->color('rgb(255, 99, 132)')
            ->options([
                'pointRadius' => 0,
                'fill' => true,
                'lineTension' => 0,
                'borderWidth' => 1,
            ])
            ->backgroundcolor('rgba(255, 99, 132, 0.7)');
    }
}
