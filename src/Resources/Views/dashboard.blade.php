@extends('meter::layout.layout')

@section('content')

    <div class="section p-0">
        <div class="card-group totals">

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
        @if (config('meter.monitors.' . Sarfraznawaz2005\Meter\Monitors\RequestMonitor::class . '.enabled', true))
            <div class="col-md-6 col-lg-6 col-sm-12 p-0 border-0">
                <div class="section">
                    <div class="text-center text-primary"><strong>Response Times</strong></div>
                    <div>{!! $requestTimeChart->container() !!}</div>
                </div>
            </div>
            <div class="col-md-6 col-lg-6 col-sm-12 p-0 border-0">
                <div class="section">
                    <div class="text-center text-primary"><strong>Request Memory Usage</strong></div>
                    <div>{!! $memoryChart->container() !!}</div>
                </div>
            </div>
        @endif

        @if (config('meter.monitors.' . Sarfraznawaz2005\Meter\Monitors\QueryMonitor::class . '.enabled', true))
            <div class="col-md-6 col-lg-6 col-sm-12 p-0 border-0">
                <div class="section">
                    <div class="text-center text-primary"><strong>Query Times</strong></div>
                    <div>{!! $queriesTimeChart->container() !!}</div>
                </div>
            </div>
        @endif

        @if (config('meter.monitors.' . Sarfraznawaz2005\Meter\Monitors\CommandMonitor::class . '.enabled', true))
            <div class="col-md-6 col-lg-6 col-sm-12 p-0 border-0">
                <div class="section">
                    <div class="text-center text-primary"><strong>Command Times</strong></div>
                    <div>{!! $commandsTimeChart->container() !!}</div>
                </div>
            </div>
        @endif

        @if (config('meter.monitors.' . Sarfraznawaz2005\Meter\Monitors\EventMonitor::class . '.enabled', true))
            <div class="col-md-6 col-lg-6 col-sm-12 p-0 border-0">
                <div class="section">
                    <div class="text-center text-primary"><strong>Event Times</strong></div>
                    <div>{!! $eventsTimeChart->container() !!}</div>
                </div>
            </div>
        @endif

        @if (config('meter.monitors.' . Sarfraznawaz2005\Meter\Monitors\ScheduleMonitor::class . '.enabled', true))
            <div class="col-md-6 col-lg-6 col-sm-12 p-0 border-0">
                <div class="section">
                    <div class="text-center text-primary"><strong>Schedule Times</strong></div>
                    <div>{!! $schedulesTimeChart->container() !!}</div>
                </div>
            </div>
        @endif
    </div>


@endsection

@push('js')
    {!! $requestTimeChart->script() !!}
    {!! $memoryChart->script() !!}
    {!! $queriesTimeChart->script() !!}
    {!! $commandsTimeChart->script() !!}
    {!! $eventsTimeChart->script() !!}
    {!! $schedulesTimeChart->script() !!}
@endpush
