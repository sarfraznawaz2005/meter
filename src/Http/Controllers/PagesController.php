<?php

namespace Sarfraznawaz2005\Meter\Http\Controllers;

use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Sarfraznawaz2005\Meter\Charts\CommandsTimeChart;
use Sarfraznawaz2005\Meter\Charts\EventsTimeChart;
use Sarfraznawaz2005\Meter\Charts\QueriesTimeChart;
use Sarfraznawaz2005\Meter\Charts\Request\RequestMemoryChart;
use Sarfraznawaz2005\Meter\Charts\Request\RequestTimeChart;
use Sarfraznawaz2005\Meter\Charts\SchedulesTimeChart;
use Sarfraznawaz2005\Meter\Models\MeterModel;

class PagesController extends Controller
{
    public function home(
        RequestTimeChart $requestTimeChart,
        RequestMemoryChart $memoryChart,
        QueriesTimeChart $queriesTimeChart,
        CommandsTimeChart $commandsTimeChart,
        EventsTimeChart $eventsTimeChart,
        SchedulesTimeChart $schedulesTimeChart
    )
    {
        $totals = MeterModel::select(
            DB::raw('count(*) as total'),
            DB::raw("count(case when type = 'command' then 1 end) as commands"),
            DB::raw("count(case when type = 'event' then 1 end) as events"),
            DB::raw("count(case when type = 'query' then 1 end) as queries"),
            DB::raw("count(case when type = 'request' then 1 end) as requests"),
            DB::raw("count(case when type = 'schedule' then 1 end) as schedules")
        )->filtered()->first();

        return view(
            'meter::dashboard', compact(
                'totals',
                'requestTimeChart',
                'memoryChart',
                'queriesTimeChart',
                'commandsTimeChart',
                'eventsTimeChart',
                'schedulesTimeChart'
            )
        );
    }

    public function queries(QueriesTimeChart $queriesTimeChart)
    {
        return view('meter::queries', compact('queriesTimeChart'));
    }

    public function requests(
        RequestTimeChart $timeChart,
        RequestMemoryChart $memoryChart
    )
    {
        return view('meter::requests', compact('timeChart', 'memoryChart'));
    }

    public function commands(CommandsTimeChart $chart)
    {
        return view('meter::commands', compact('chart'));
    }

    public function events(EventsTimeChart $chart)
    {
        return view('meter::events', compact('chart'));
    }

    public function schedules(SchedulesTimeChart $chart)
    {
        return view('meter::schedules', compact('chart'));
    }
}
