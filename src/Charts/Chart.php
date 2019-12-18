<?php

namespace Sarfraznawaz2005\Meter\Charts;

use ConsoleTVs\Charts\Classes\Chartjs\Chart as BaseChart;
use Illuminate\Database\Eloquent\Builder;

abstract class Chart extends BaseChart
{
    /**
     * Gets data set for chart.
     *
     * @param Builder $builder
     * @return mixed
     */
    abstract public function getDataSet(Builder $builder);

    /**
     * Generates and returns chart
     *
     * @param array $dataSet
     * @return mixed
     */
    abstract public function buildChart(array $dataSet);

}
