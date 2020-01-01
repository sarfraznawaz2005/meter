<nav class="navbar navbar-expand-md bg-light">

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
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="btn btn-light {{meterActiveLink('meter_home') ? 'active' : ''}}" href="{{route('meter_home')}}">Dashboard</a>
            </li>
            <li class="nav-item">
                <a class="btn btn-light {{meterActiveLink('meter_requests') ? 'active' : ''}}" href="{{route('meter_requests')}}">Requests</a>
            </li>
            <li class="nav-item">
                <a class="btn btn-light" href="#">Queries</a>
            </li>
            <li class="nav-item">
                <a class="btn btn-light" href="#">Commands</a>
            </li>
            <li class="nav-item">
                <a class="btn btn-light" href="#">Jobs</a>
            </li>
        </ul>
    </div>
</nav>
