<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="author" content="Sarfraz Ahmed (sarfraznawaz2005@gmail.com)">

    <title>Meter</title>

    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('vendor/meter/bootstrap/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/meter/datatable/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/meter/meter.css') }}">

    @stack('css')
</head>
<body>

@include('meter::layout.links')

<div class="card wrapper">
    <div class="card-body">
        @yield('content')
    </div>
</div>

@include('meter::layout.modal')

<script src="{{ asset('vendor/meter/jquery.min.js') }}"></script>
<script src="{{ asset('vendor/meter/bootstrap/popper.min.js') }}"></script>
<script src="{{ asset('vendor/meter/bootstrap/bootstrap.min.js') }}"></script>
<script src="{{ asset('vendor/meter/datatable/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('vendor/meter/datatable/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('vendor/meter/moment.min.js') }}"></script>
<script src="{{ asset('vendor/meter/Chart.min.js') }}"></script>
<script src="{{ asset('vendor/meter/meter.js') }}"></script>

@stack('js')

</body>
</html>
