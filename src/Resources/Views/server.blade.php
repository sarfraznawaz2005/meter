@extends('meter::layout.layout')

@section('content')
    @component('meter::components.chart', ['chart' => $cpuChart, 'title' => 'Server CPU Usage'])@endcomponent
    @component('meter::components.chart', ['chart' => $diskSpaceChart, 'title' => 'Server Disk Space Usage'])@endcomponent
    @component('meter::components.chart', ['chart' => $serverMemoryChart, 'title' => 'Server Memory Usage'])@endcomponent
    @component('meter::components.chart', ['chart' => $connectionsChart, 'title' => 'Server HTTP Connections Count'])@endcomponent
@endsection

