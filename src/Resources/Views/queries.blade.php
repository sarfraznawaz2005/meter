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
                <i class="fa fa-table"></i> Queries
            </a>
        </li>
    </ul>

    <div class="tab-content">

        <div class="tab-pane fade show active" role="tabpanel" id="graph">
            @component('meter::components.chart', ['chart' => $queriesTimeChart, 'title' => 'Query Times'])@endcomponent
        </div>

        <div class="tab-pane fade" role="tabpanel" id="index">
            @component('meter::components.table',[
                'url' => route('meter_queries_table'),
                'columns' => ['Happened', 'Query', 'Time', 'Slow', 'More'],
                'columnDefs' => ['{"width": "10%", "targets": 0}', '{"width": "5%", "targets": -1}', '{"width": "10%", "targets": -2}', '{"width": "10%", "targets": -3}']
            ])
            @endcomponent
        </div>
    </div>

@endsection
