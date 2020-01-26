<div class="section">
    @if (isset($title))
        <div class="text-center text-primary"><strong>{{$title}}</strong></div>
    @endif

    <div>{!! $chart->container() !!}</div>
</div>

@push('js')
    {!! $chart->script() !!}
@endpush
