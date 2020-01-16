<a
    class="dropdown-item btnfilter {{(request()->has('days') || request()->has('slow') || request()->has('all')) ? '' : 'active'}}"
    href="{{route($route)}}">
    Today
</a>

@foreach(config('meter.filters', []) as $name => $days)
    <a
        class="dropdown-item btnfilter {{(request()->has('days') && request()->days == $days) ? 'active' : ''}}"
        href="{{route($route, ['days' => $days])}}"
    >
        {{$name}}
    </a>
@endforeach

<a
    class="dropdown-item btnfilter {{request()->has('all') ? 'active' : ''}}"
    href="{{route($route, ['all' => 1])}}">
    All
</a>

@push('js')
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            document.querySelector('.filter_name').innerHTML = document.querySelector('.dropdown-item.btnfilter.active').innerHTML;
        });
    </script>
@endpush

