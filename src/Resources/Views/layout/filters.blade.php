<div class="btn-group d-flex align-items-center justify-content-center filters">

    <a
        class="btn btn-sm btnfilter {{(request()->has('days') || request()->has('slow') || request()->has('all')) ? 'btn-outline-primary' : 'btn-primary'}}"
        href="{{route($route)}}">
        Today
    </a>

    @foreach(config('meter.filters', []) as $name => $days)
        <a
            class="btn btn-sm btnfilter {{(request()->has('days') && request()->days == $days) ? 'btn-primary' : 'btn-outline-primary'}}"
            href="{{route($route, ['days' => $days])}}">
            {{$name}}
        </a>
    @endforeach

    <a
        class="btn btn-sm btnfilter {{request()->has('all') ? 'btn-primary' : 'btn-outline-primary'}}"
        href="{{route($route, ['all' => 1])}}">
        All
    </a>

</div>
<br>

@if (!request()->has('days') && !request()->has('all') && !request()->has('slow'))
    @push('js')
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                document.querySelectorAll('.filters').forEach(function (filters) {
                    filters.querySelectorAll('.btnfilter')[0].className = 'btn btnfilter btn-sm btn-primary';
                });
            });
        </script>
    @endpush
@endif
