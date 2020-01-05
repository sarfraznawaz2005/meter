@extends('meter::layout.layout')

@section('content')

    <div class="main bg-white p-4 mt-3">

        @include('meter::layout.filters', ['route' => 'meter_home'])

        <div class="text-center text-primary"><strong>Response Times</strong></div>

        <div>{!! $chart->container() !!}</div>
    </div>

@endsection

@push('js')
    {!! $chart->script() !!}
@endpush
