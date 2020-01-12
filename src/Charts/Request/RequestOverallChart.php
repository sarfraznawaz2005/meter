<?php

namespace Sarfraznawaz2005\Meter\Charts\Request;

use Illuminate\Support\Collection;
use Sarfraznawaz2005\Meter\Charts\Chart;
use Sarfraznawaz2005\Meter\Models\MeterModel;
use Sarfraznawaz2005\Meter\Type;

class RequestOverallChart extends Chart
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
        $data = new Collection();
        foreach ($model->type(Type::REQUEST)->filtered()->orderBy('id', 'asc')->get() as $item) {
            if (isset($item->content['duration'])) {
                $data->push($item->content['duration']);
            }
        }

        $this->data['Min'] = round($data->min());
        $this->data['Average'] = round($data->average());
        $this->data['Max'] = round($data->max());
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
        $this->dataset('Response Times', 'doughnut', $this->getValues())
            ->backgroundcolor(['rgb(67, 211, 70)', 'rgb(54, 162, 235)', 'rgb(255, 99, 132)']);
    }

}
