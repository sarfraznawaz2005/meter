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
                <i class="fa fa-table"></i> Schedules
            </a>
        </li>
    </ul>

    <div class="tab-content">

        <div class="tab-pane fade show active" role="tabpanel" id="graph">
            @component('meter::components.chart', ['chart' => $chart, 'title' => 'Schedule Times'])@endcomponent
        </div>

        <div class="tab-pane fade" role="tabpanel" id="index">
            <div class="section">
                <table class="table-responsive-sm meter_table table table-hover mx-auto w-100">
                    <thead>
                    <tr>
                        <th>Happened</th>
                        <th>Command</th>
                        <th>Expression</th>
                        <th>Time</th>
                        <th>More</th>
                    </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>

@endsection

@push('js')
    <script>

        meterTable('.table', '{{ route('meter_schedules_table') }}', 25, [
            {data: 'Happened'},
            {data: 'Command'},
            {data: 'Expression'},
            {data: 'Time'},
            {data: 'More'},
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
