<div class="btn-group d-flex align-items-center justify-content-center">
    <a
        class="btn btn-sm {{(request()->has('days') || request()->has('slow') || request()->has('all')) ? 'btn-outline-primary' : 'btn-primary'}}"
        href="{{route($route)}}">
        Today
    </a>

    <a
        class="btn btn-sm {{(request()->has('days') && request()->days === '7') ? 'btn-primary' : 'btn-outline-primary'}}"
        href="{{route($route, ['days' => 7])}}">
        7 Days
    </a>

    <a
        class="btn btn-sm {{(request()->has('days') && request()->days === '30') ? 'btn-primary' : 'btn-outline-primary'}}"
        href="{{route($route, ['days' => 30])}}">
        1 Month
    </a>

    <a
        class="btn btn-sm {{(request()->has('days') && request()->days === '90') ? 'btn-primary' : 'btn-outline-primary'}}"
        href="{{route($route, ['days' => 90])}}">
        3 Month
    </a>

    <a
        class="btn btn-sm {{(request()->has('days') && request()->days === '180') ? 'btn-primary' : 'btn-outline-primary'}}"
        href="{{route($route, ['days' => 180])}}">
        6 Month
    </a>

    <a
        class="btn btn-sm {{(request()->has('days') && request()->days === '365') ? 'btn-primary' : 'btn-outline-primary'}}"
        href="{{route($route, ['days' => 365])}}">
        1 Year
    </a>

    <a
        class="btn btn-sm {{request()->has('all') ? 'btn-primary' : 'btn-outline-primary'}}"
        href="{{route($route, ['all' => 1])}}">
        All
    </a>
</div>
<br>
