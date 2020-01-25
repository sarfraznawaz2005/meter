@extends('meter::layout.layout')

@section('content')

    <div class="section">
        <div class="text-center text-primary"><strong>Server CPU Usage</strong></div>
        <div>{!! $cpuChart->container() !!}</div>
    </div>

    <div class="section">
        <div class="text-center text-primary"><strong>Server Disk Space Usage</strong></div>
        <div>{!! $diskSpaceChart->container() !!}</div>
    </div>

    <div class="section">
        <div class="text-center text-primary"><strong>Server Memory Usage</strong></div>
        <div>{!! $serverMemoryChart->container() !!}</div>
    </div>

    <div class="section">
        <div class="text-center text-primary"><strong>Server HTTP Connections Count</strong></div>
        <div>{!! $connectionsChart->container() !!}</div>
    </div>

@endsection

@push('js')
    {!! $cpuChart->script() !!}
    {!! $diskSpaceChart->script() !!}
    {!! $serverMemoryChart->script() !!}
    {!! $connectionsChart->script() !!}
@endpush
