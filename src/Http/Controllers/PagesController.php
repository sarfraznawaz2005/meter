<?php

namespace Sarfraznawaz2005\Meter\Http\Controllers;

use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Sarfraznawaz2005\Meter\Charts\CommandsByDayChart;
use Sarfraznawaz2005\Meter\Charts\EventsByDayChart;
use Sarfraznawaz2005\Meter\Charts\Query\QueriesSlowChart;
use Sarfraznawaz2005\Meter\Charts\Query\QueriesTimeChart;
use Sarfraznawaz2005\Meter\Charts\Request\RequestMemoryChart;
use Sarfraznawaz2005\Meter\Charts\Request\RequestSlowChart;
use Sarfraznawaz2005\Meter\Charts\Request\RequestTimeChart;
use Sarfraznawaz2005\Meter\Charts\SchedulesByDayChart;

class PagesController extends Controller
{
    public function home(
        RequestTimeChart $requestTimeChart,
        RequestMemoryChart $memoryChart,
        QueriesTimeChart $queriesTimeChart,
        CommandsByDayChart $commandsByDayChart,
        EventsByDayChart $eventsByDayChart,
        SchedulesByDayChart $schedulesByDayChart
    )
    {
        $totals = DB::table('meter_entries')
            ->selectRaw('count(*) as total')
            ->selectRaw("count(case when type = 'command' then 1 end) as commands")
            ->selectRaw("count(case when type = 'event' then 1 end) as events")
            ->selectRaw("count(case when type = 'query' then 1 end) as queries")
            ->selectRaw("count(case when type = 'request' then 1 end) as requests")
            ->selectRaw("count(case when type = 'schedule' then 1 end) as schedules")
            ->first();

        return view(
            'meter::dashboard', compact(
                'totals',
                'requestTimeChart',
                'memoryChart',
                'queriesTimeChart',
                'commandsByDayChart',
                'eventsByDayChart',
                'schedulesByDayChart'
            )
        );
    }

    public function queries(QueriesTimeChart $queriesTimeChart, QueriesSlowChart $queriesSlowChart)
    {
        return view('meter::queries', compact('queriesTimeChart', 'queriesSlowChart'));
    }

    public function requests(
        RequestTimeChart $timeChart,
        RequestSlowChart $requestSlowChart,
        RequestMemoryChart $memoryChart
    )
    {
        return view('meter::requests', compact('timeChart', 'requestSlowChart', 'memoryChart'));
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
