<div class="section">
    <table class="table-responsive-sm meter_table table table-hover mx-auto w-100">
        <thead>
        <tr>
            @foreach($columns as $column)
                <th>{{$column}}</th>
            @endforeach
        </tr>
        </thead>
    </table>
</div>

@push('js')
    <script>
        meterTable('.table', '{{ $url }}', 25, [
            @foreach($columns as $column)
                {data: '{{$column}}'},
            @endforeach
        ], {
            "columnDefs": [
                @if (isset($columnDefs))
                    @foreach($columnDefs as $columnDef)
                        {!! $columnDef !!},
                    @endforeach
                @else
                    {"width": "10%", "targets": -1}
                @endif
            ]
        }, {
            {{request()->has('days') ? 'days : ' . request()->days : ''}}
            {{request()->has('slow') ? 'slow : 1' : ''}}
            {{request()->has('all') ? 'all : 1' : ''}}
        });
    </script>
@endpush
