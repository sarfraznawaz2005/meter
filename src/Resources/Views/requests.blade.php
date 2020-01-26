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
            @component('meter::components.chart', ['chart' => $timeChart, 'title' => 'Response Times'])@endcomponent
            @component('meter::components.chart', ['chart' => $memoryChart, 'title' => 'Memory Usage'])@endcomponent
        </div>

        <div class="tab-pane fade" role="tabpanel" id="index">
            @component('meter::components.table',[
                'url' => route('meter_requests_table'),
                'columns' => ['Happened', 'Verb', 'Path', 'Status', 'Time', 'Memory', 'Slow', 'More'],
            ])
            @endcomponent
        </div>
    </div>

@endsection
