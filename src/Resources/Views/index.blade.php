@extends('meter::layout.layout')

@section('content')

    <div class="table-responsive-sm">
        <table class="table table-hover mx-auto w-100">
            <thead>
            <tr>
                <th>Happened</th>
                <th>Verb</th>
                <th>Path</th>
                <th>Status</th>
                <th>Time</th>
                <th>Slow</th>
                <th>Details</th>
            </tr>
            </thead>
        </table>
    </div>

@endsection

@push('js')
    <script>

        meterTable('.table', '{{ route('meter_requests_table') }}', 10, [
            {data: 'Happened'},
            {data: 'Verb'},
            {data: 'Path'},
            {data: 'Status'},
            {data: 'Time'},
            {data: 'Slow'},
            {data: 'Details'}
        ], {
            "columnDefs": [
                {"width": "1%", "targets": -1}
            ]
        });

    </script>
@endpush
