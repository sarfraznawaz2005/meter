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
                <i class="fa fa-table"></i> Events
            </a>
        </li>
    </ul>

    <div class="tab-content">

        <div class="tab-pane fade show active" role="tabpanel" id="graph">
            <div class="section">
                @include('meter::layout.filters', ['route' => 'meter_events'])

                <div class="text-center text-primary"><strong>Event Times</strong></div>
                <div>{!! $chart->container() !!}</div>
            </div>
        </div>

        <div class="tab-pane fade" role="tabpanel" id="index">
            <div class="section">
                @include('meter::layout.filters', ['route' => 'meter_events'])

                <div class="table-responsive-sm">
                    <table class="meter_table table table-hover mx-auto w-100">
                        <thead>
                        <tr>
                            <th>Happened</th>
                            <th>Event</th>
                            <th>Time</th>
                            <th>Listeners</th>
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

    {!! $chart->script() !!}

    <script>

        meterTable('.table', '{{ route('meter_events_table') }}', 25, [
            {data: 'Happened'},
            {data: 'Event'},
            {data: 'Time'},
            {data: 'Listeners'},
            {data: 'More'}
        ], {
            "columnDefs": [
                {"width": "10%", "targets": -1}
            ]
        }, {
            {{request()->has('days') ? 'days : ' . request()->days : ''}}
            {{request()->has('slow') ? 'slow : 1' : ''}}
            {{request()->has('all') ? 'all : 1' : ''}}
        });

    </script>
@endpush
