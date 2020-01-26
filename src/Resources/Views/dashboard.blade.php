@extends('meter::layout.layout')

@section('content')

    <div class="section p-0">
        <div class="shadow card-group totals">

            @if (config('meter.monitors.' . Sarfraznawaz2005\Meter\Monitors\RequestMonitor::class . '.enabled', true))
                <div class="card text-center text-white bg-primary border-primary">
                    <a href="{{route('meter_requests')}}" class="text-white">
                        <div class="card-header">
                            <span class="h5"><i class="fa fa-random"></i> Requests</span>
                        </div>
                        <div class="card-body p-3">
                            <strong class="h1">{{$totals->requests}}</strong>
                        </div>
                    </a>
                </div>
            @endif

            @if (config('meter.monitors.' . Sarfraznawaz2005\Meter\Monitors\QueryMonitor::class . '.enabled', true))
                <div class="card text-center text-white bg-success border-success">
                    <a href="{{route('meter_queries')}}" class="text-white">
                        <div class="card-header">
                            <span class="h5"><i class="fa fa-database"></i> Queries</span>
                        </div>
                        <div class="card-body p-3">
                            <strong class="h1">{{$totals->queries}}</strong>
                        </div>
                    </a>
                </div>
            @endif

            @if (config('meter.monitors.' . Sarfraznawaz2005\Meter\Monitors\CommandMonitor::class . '.enabled', true))
                <div class="card text-center text-white bg-info border-info">
                    <a href="{{route('meter_commands')}}" class="text-white">
                        <div class="card-header">
                            <span class="h5"><i class="fa fa-terminal"></i> Commands</span>
                        </div>
                        <div class="card-body p-3">
                            <strong class="h1">{{$totals->commands}}</strong>
                        </div>
                    </a>
                </div>
            @endif

            @if (config('meter.monitors.' . Sarfraznawaz2005\Meter\Monitors\EventMonitor::class . '.enabled', true))
                <div class="card text-center text-white bg-warning border-warning">
                    <a href="{{route('meter_events')}}" class="text-white">
                        <div class="card-header">
                            <span class="h5"><i class="fa fa-clock-o"></i> Events</span>
                        </div>
                        <div class="card-body p-3">
                            <strong class="h1">{{$totals->events}}</strong>
                        </div>
                    </a>
                </div>
            @endif

            @if (config('meter.monitors.' . Sarfraznawaz2005\Meter\Monitors\ScheduleMonitor::class . '.enabled', true))
                <div class="card text-center text-white bg-danger border-danger">
                    <a href="{{route('meter_schedules')}}" class="text-white">
                        <div class="card-header">
                            <span class="h5"><i class="fa fa-calendar"></i> Schedule</span>
                        </div>
                        <div class="card-body p-3">
                            <strong class="h1">{{$totals->schedules}}</strong>
                        </div>
                    </a>
                </div>
            @endif

        </div>
    </div>

    <div class="d-flex flex-wrap w-100">

        @if (
            config('meter.monitors.' . Sarfraznawaz2005\Meter\Monitors\RequestMonitor::class . '.enabled', true) &&
            config('meter.monitors.' . Sarfraznawaz2005\Meter\Monitors\RequestMonitor::class . '.show_on_dashboard', true)
        )
            <div class="col-md-6 col-lg-6 col-sm-12 p-0 border-0">
                @component('meter::components.chart', ['chart' => $requestTimeChart, 'title' => 'Response Times'])@endcomponent
            </div>
            <div class="col-md-6 col-lg-6 col-sm-12 p-0 border-0">
                @component('meter::components.chart', ['chart' => $requestMemoryChart, 'title' => 'Request Memory Usage'])@endcomponent
            </div>
        @endif

        @if (
            config('meter.monitors.' . Sarfraznawaz2005\Meter\Monitors\QueryMonitor::class . '.enabled', true) &&
            config('meter.monitors.' . Sarfraznawaz2005\Meter\Monitors\QueryMonitor::class . '.show_on_dashboard', true)
        )
            <div class="col-md-6 col-lg-6 col-sm-12 p-0 border-0">
                @component('meter::components.chart', ['chart' => $queriesTimeChart, 'title' => 'Query Times'])@endcomponent
            </div>
        @endif

        @if (
            config('meter.monitors.' . Sarfraznawaz2005\Meter\Monitors\CommandMonitor::class . '.enabled', true) &&
            config('meter.monitors.' . Sarfraznawaz2005\Meter\Monitors\CommandMonitor::class . '.show_on_dashboard', true)
        )
            <div class="col-md-6 col-lg-6 col-sm-12 p-0 border-0">
                @component('meter::components.chart', ['chart' => $commandsTimeChart, 'title' => 'Command Times'])@endcomponent
            </div>
        @endif

        @if (
            config('meter.monitors.' . Sarfraznawaz2005\Meter\Monitors\EventMonitor::class . '.enabled', true) &&
            config('meter.monitors.' . Sarfraznawaz2005\Meter\Monitors\EventMonitor::class . '.show_on_dashboard', true)
        )
            <div class="col-md-6 col-lg-6 col-sm-12 p-0 border-0">
                @component('meter::components.chart', ['chart' => $eventsTimeChart, 'title' => 'Event Times'])@endcomponent
            </div>
        @endif

        @if (
            config('meter.monitors.' . Sarfraznawaz2005\Meter\Monitors\ScheduleMonitor::class . '.enabled', true) &&
            config('meter.monitors.' . Sarfraznawaz2005\Meter\Monitors\ScheduleMonitor::class . '.show_on_dashboard', true)
        )
            <div class="col-md-6 col-lg-6 col-sm-12 p-0 border-0">
                @component('meter::components.chart', ['chart' => $schedulesTimeChart, 'title' => 'Schedule Times'])@endcomponent
            </div>
        @endif

        @if (
            config('meter.monitors.' . Sarfraznawaz2005\Meter\Monitors\CpuMonitor::class . '.enabled', true) &&
            config('meter.monitors.' . Sarfraznawaz2005\Meter\Monitors\CpuMonitor::class . '.show_on_dashboard', true)
        )
            <div class="col-md-6 col-lg-6 col-sm-12 p-0 border-0">
                @component('meter::components.chart', ['chart' => $cpuChart, 'title' => 'Server CPU Usage'])@endcomponent
            </div>
        @endif

        @if (
            config('meter.monitors.' . Sarfraznawaz2005\Meter\Monitors\DiskSpaceMonitor::class . '.enabled', true) &&
            config('meter.monitors.' . Sarfraznawaz2005\Meter\Monitors\DiskSpaceMonitor::class . '.show_on_dashboard', true)
        )
            <div class="col-md-6 col-lg-6 col-sm-12 p-0 border-0">
                @component('meter::components.chart', ['chart' => $diskSpaceChart, 'title' => 'Server Disk Space Usage'])@endcomponent
            </div>
        @endif

        @if (
            config('meter.monitors.' . Sarfraznawaz2005\Meter\Monitors\MemoryMonitor::class . '.enabled', true) &&
            config('meter.monitors.' . Sarfraznawaz2005\Meter\Monitors\MemoryMonitor::class . '.show_on_dashboard', true)
        )
            <div class="col-md-6 col-lg-6 col-sm-12 p-0 border-0">
                @component('meter::components.chart', ['chart' => $serverMemoryChart, 'title' => 'Server Memory Usage'])@endcomponent
            </div>
        @endif

        @if (
            config('meter.monitors.' . Sarfraznawaz2005\Meter\Monitors\HttpConnectionsMonitor::class . '.enabled', true) &&
            config('meter.monitors.' . Sarfraznawaz2005\Meter\Monitors\HttpConnectionsMonitor::class . '.show_on_dashboard', true)
        )
            <div class="col-md-6 col-lg-6 col-sm-12 p-0 border-0">
                @component('meter::components.chart', ['chart' => $connectionsChart, 'title' => 'Server HTTP Connections Count'])@endcomponent
            </div>
        @endif

    </div>

@endsection
