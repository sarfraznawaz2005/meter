@extends('meter::layout.layout')

@section('content')

    <div class="table-responsive-sm">
        <table class="table table-hover mx-auto w-100">
            <thead>
            <tr>
                <th>Created</th>
                <th>Verb</th>
                <th>Path</th>
                <th>Controller</th>
                <th>Status</th>
                <th>Time</th>
                <th>Slow</th>
            </tr>
            </thead>
        </table>
    </div>

@endsection

@push('js')
    <script>

        meterTable('.table', '{{ route('meter_requests_table') }}', 10, [
            {data: 'created'},
            {data: 'verb'},
            {data: 'path'},
            {data: 'controller'},
            {data: 'status'},
            {data: 'time'},
            {data: 'slow'}
        ], {
            "columnDefs": [
                {"width": "1%", "targets": -1}
            ]
        });

    </script>
@endpush
