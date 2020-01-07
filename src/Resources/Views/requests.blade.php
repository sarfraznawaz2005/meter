@extends('meter::layout.layout')

@section('content')

    <ul class="nav nav-tabs justify-content-center">
        <li class="nav-item">
            <a class="nav-item nav-link active" data-toggle="tab" href="#graph">
                <i class="fa fa-bar-chart"></i> Graph
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-item nav-link" data-toggle="tab" href="#index">
                <i class="fa fa-table"></i> Requests
            </a>
        </li>
    </ul>

    <div class="tab-content">
        <div class="tab-pane fade show active" role="tabpanel" id="graph">
            <div class="section">
                @include('meter::layout.filters', ['route' => 'meter_requests'])

                <div class="text-center text-primary"><strong>All Response Times</strong></div>
                <div>{!! $timeChart->container() !!}</div>
            </div>

            <div class="section">
                <div class="text-center text-primary"><strong>Slow Responses Times</strong></div>
                <div>{!! $requestSlowChart->container() !!}</div>
            </div>

            <div class="section">
                <div class="text-center text-primary"><strong>Memory Usage</strong></div>
                <div>{!! $memoryChart->container() !!}</div>
            </div>
        </div>

        <div class="tab-pane fade" role="tabpanel" id="index">
            <div class="section">
                @include('meter::layout.filters', ['route' => 'meter_requests'])

                <div class="table-responsive-sm">
                    <table class="meter_table table table-hover mx-auto w-100">
                        <thead>
                        <tr>
                            <th>Happened</th>
                            <th>Verb</th>
                            <th>Path</th>
                            <th>Status</th>
                            <th>Time</th>
                            <th>Memory</th>
                            <th>Slow</th>
                            <th>More</th>
                        </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>

@endsection

@push('js')

    {!! $timeChart->script() !!}
    {!! $requestSlowChart->script() !!}
    {!! $memoryChart->script() !!}

    <script>

        meterTable('.table', '{{ route('meter_requests_table') }}', 25, [
            {data: 'Happened'},
            {data: 'Verb'},
            {data: 'Path'},
            {data: 'Status'},
            {data: 'Time'},
            {data: 'Memory'},
            {data: 'Slow'},
            {data: 'More'}
        ], {
            "columnDefs": [
                {"width": "5%", "targets": -1}
            ]
        }, {
            {{request()->has('days') ? 'days : ' . request()->days : ''}}
            {{request()->has('slow') ? 'slow : 1' : ''}}
            {{request()->has('all') ? 'all : 1' : ''}}
        });

    </script>
@endpush
