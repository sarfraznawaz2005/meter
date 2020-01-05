<?php

namespace Sarfraznawaz2005\Meter\Http\Controllers;

use Illuminate\Routing\Controller;
use Sarfraznawaz2005\Meter\Charts\CommandsByDayChart;
use Sarfraznawaz2005\Meter\Charts\EventsByDayChart;
use Sarfraznawaz2005\Meter\Charts\QueriesTimeChart;
use Sarfraznawaz2005\Meter\Charts\RequestMemoryChart;
use Sarfraznawaz2005\Meter\Charts\RequestTimeChart;
use Sarfraznawaz2005\Meter\Charts\SchedulesByDayChart;

class PagesController extends Controller
{
    public function home(RequestTimeChart $chart)
    {
        return view('meter::dashboard', compact('chart'));
    }

    public function queries(QueriesTimeChart $chart)
    {
        return view('meter::queries', compact('chart'));
    }

    public function requests(RequestTimeChart $timeChart, RequestMemoryChart $memoryChart)
    {
        return view('meter::requests', compact('timeChart', 'memoryChart'));
    }

    public function commands(CommandsByDayChart $chart)
    {
        return view('meter::commands', compact('chart'));
    }

    public function events(EventsByDayChart $chart)
    {
        return view('meter::events', compact('chart'));
    }

    public function schedules(SchedulesByDayChart $chart)
    {
        return view('meter::schedules', compact('chart'));
    }
}
