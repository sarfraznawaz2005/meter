<?php

namespace Sarfraznawaz2005\Meter\Charts;

use ConsoleTVs\Charts\Classes\Chartjs\Chart as BaseChart;
use Sarfraznawaz2005\Meter\Models\MeterModel;

abstract class Chart extends BaseChart
{
    protected $data = [];

    /**
     * Sets options for chart.
     *
     * @return void
     */
    abstract protected function setOptions();

    /**
     * Sets data for chart.
     *
     * @param MeterModel $model
     * @return void
     */
    abstract protected function setData(MeterModel $model);

    /**
     * Gets labels for chart.
     *
     * @return mixed
     */
    abstract protected function getLabels(): array;

    /**
     * Gets values for chart.
     *
     * @return mixed
     */
    abstract protected function getValues(): array;

    /**
     * Sets DataSet for chart.
     *
     * @return void
     */
    abstract protected function setDataSet();

    /**
     * Chart constructor.
     * @param MeterModel $model
     */
    public function __construct(MeterModel $model)
    {
        parent::__construct();

        $this->setData($model);

        $this->setOptions();

        $this->labels($this->getLabels());

        $this->setDataSet();
    }

}
