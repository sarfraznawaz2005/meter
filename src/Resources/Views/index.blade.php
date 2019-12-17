@extends('meter::layout.layout')

@section('title', $title)

@section('content')

    <div class="table-responsive-sm">
        <table class="table table-hover table-bordered table-condensed mx-auto small w-100 text-dark">
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

@push('scripts')
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
