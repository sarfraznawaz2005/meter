@extends('meter::layout.layout')

@section('content')

    <ul class="nav nav-tabs justify-content-center">
        <li class="nav-item">
            <a class="nav-item nav-link active" data-toggle="tab" href="#graph">Graph</a>
        </li>
        <li class="nav-item">
            <a class="nav-item nav-link" data-toggle="tab" href="#index">Events</a>
        </li>
    </ul>

    <div class="tab-content bg-white p-4">

        <div class="tab-pane fade show active" role="tabpanel" id="graph">
            <div>{!! $chart->container() !!}</div>
        </div>

        <div class="tab-pane fade" role="tabpanel" id="index">
            <div class="table-responsive-sm">
                <table class="meter_table table table-hover mx-auto w-100">
                    <thead>
                    <tr>
                        <th>Happened</th>
                        <th>Event</th>
                        <th>Listeners</th>
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

        meterTable('.table', '{{ route('meter_events_table') }}', 25, [
            {data: 'Happened'},
            {data: 'Event'},
            {data: 'Listeners'},
            {data: 'More'}
        ], {
            "columnDefs": [
                {"width": "10%", "targets": -1}
            ]
        });

    </script>
@endpush
