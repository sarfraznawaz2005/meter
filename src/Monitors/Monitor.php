<?php

namespace Sarfraznawaz2005\Meter\Monitors;

use Illuminate\Contracts\Foundation\Application;
use Sarfraznawaz2005\Meter\Meter;
use Sarfraznawaz2005\Meter\Models\MeterModel;

abstract class Monitor
{
    /**
     * The configured monitor options.
     *
     * @var array
     */
    public $options = [];

    /**
     * The meter model.
     *
     * @var null|object
     */
    protected $model = null;

    /**
     * Create a new monitor instance.
     *
     * @param array $options
     * @return void
     */
    public function __construct(array $options = [])
    {
        $this->options = $options;

        $this->model = new MeterModel();
    }

    /**
     * Listens to event(s) and performs actions.
     *
     * @param Application $app
     * @return void
     */
    abstract public function register($app);

    /**
     * Saves collected data in DB.
     *
     * @param string $type
     * @param boolean $isSlow
     * @param array $content
     * @return mixed
     */
    public function record($type, $isSlow, array $content)
    {
        Meter::stopMonitoring();

        $result = true;
        $skip = false;

        if (count(config('meter.ignore_matched_string', [])) > 0) {

            foreach (config('meter.ignore_matched_string', []) as $queryType) {

                if (!is_array($queryType)) {
                    continue;
                }

                if(count($queryType) == 0) {
                    continue;
                }

                foreach ($queryType as $string) {
                    if (in_array($string, $content)) {
                        $skip = true;
                        break;
                    }
                }
            }

        }

        if ($skip === false) {

            $result = $this->model->create([
                'type' => $type,
                'is_slow' => $isSlow ? '1' : '0',
                'content' => $content,
                'created_at' => now(),
            ]);
        }

        Meter::startMonitoring();

        return $result;
    }
}
