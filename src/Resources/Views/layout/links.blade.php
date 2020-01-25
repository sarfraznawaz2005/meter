<nav class="navbar fixed-top navbar-expand-lg navbar-light bg-light">

    <span class="navbar-brand">
        <strong class="logo fa fa-dashboard"></strong>
        <strong>Meter</strong>
    </span>

    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
        <span class="line"></span>
        <span class="line"></span>
        <span class="line" style="margin-bottom: 0;"></span>
    </button>

    <div class="collapse navbar-collapse" id="collapsibleNavbar">
        <ul class="navbar-nav w-100">

            <li class="nav-item">
                <a
                    class="btn btn-light {{meterActiveLink('meter_home') ? 'active' : ''}}"
                    href="{{route('meter_home')}}">
                    Dashboard
                </a>
            </li>

            @if (config('meter.monitors.' . Sarfraznawaz2005\Meter\Monitors\RequestMonitor::class . '.enabled', true))
                <li class="nav-item">
                    <a
                        class="btn btn-light {{meterActiveLink('meter_requests') ? 'active' : ''}}"
                        href="{{route('meter_requests')}}">
                        Requests
                    </a>
                </li>
            @endif

            @if (config('meter.monitors.' . Sarfraznawaz2005\Meter\Monitors\QueryMonitor::class . '.enabled', true))
                <li class="nav-item">
                    <a
                        class="btn btn-light {{meterActiveLink('meter_queries') ? 'active' : ''}}"
                        href="{{route('meter_queries')}}">
                        Queries
                    </a>
                </li>
            @endif

            @if (config('meter.monitors.' . Sarfraznawaz2005\Meter\Monitors\CommandMonitor::class . '.enabled', true))
                <li class="nav-item">
                    <a
                        class="btn btn-light {{meterActiveLink('meter_commands') ? 'active' : ''}}"
                        href="{{route('meter_commands')}}">
                        Commands
                    </a>
                </li>
            @endif

            @if (config('meter.monitors.' . Sarfraznawaz2005\Meter\Monitors\EventMonitor::class . '.enabled', true))
                <li class="nav-item">
                    <a
                        class="btn btn-light {{meterActiveLink('meter_events') ? 'active' : ''}}"
                        href="{{route('meter_events')}}">
                        Events
                    </a>
                </li>
            @endif

            @if (config('meter.monitors.' . Sarfraznawaz2005\Meter\Monitors\ScheduleMonitor::class . '.enabled', true))
                <li class="nav-item">
                    <a
                        class="btn btn-light {{meterActiveLink('meter_schedules') ? 'active' : ''}}"
                        href="{{route('meter_schedules')}}">
                        Schedule
                    </a>
                </li>
            @endif

            @if (
            config('meter.monitors.' . Sarfraznawaz2005\Meter\Monitors\CpuMonitor::class . '.enabled', true) ||
            config('meter.monitors.' . Sarfraznawaz2005\Meter\Monitors\DiskSpaceMonitor::class . '.enabled', true) ||
            config('meter.monitors.' . Sarfraznawaz2005\Meter\Monitors\MemoryMonitor::class . '.enabled', true) ||
            config('meter.monitors.' . Sarfraznawaz2005\Meter\Monitors\HttpConnectionsMonitor::class . '.enabled', true)
            )
                <li class="nav-item">
                    <a
                        class="btn btn-light {{meterActiveLink('meter_server_stats') ? 'active' : ''}}"
                        href="{{route('meter_server_stats')}}">
                        Server
                    </a>
                </li>
            @endif

            <li class="nav-item dropdown ml-auto">
                <a class="nav-link dropdown-toggle filter_name" href="#" data-toggle="dropdown">Today </a>
                <div class="dropdown-menu dropdown-menu-right">
                    @include('meter::layout.filters', ['route' => request()->route()->getName()])
                </div>
            </li>

        </ul>
    </div>
</nav>
