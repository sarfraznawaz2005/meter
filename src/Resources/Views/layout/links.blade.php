<nav class="navbar navbar-expand-md bg-light">

    <span class="navbar-brand">
        <svg class="logo" width="24" height="24" viewBox="0 0 1792 1792" xmlns="http://www.w3.org/2000/svg">
            <path
                d="M384 1152q0-53-37.5-90.5t-90.5-37.5-90.5 37.5-37.5 90.5 37.5 90.5 90.5 37.5 90.5-37.5 37.5-90.5zm192-448q0-53-37.5-90.5t-90.5-37.5-90.5 37.5-37.5 90.5 37.5 90.5 90.5 37.5 90.5-37.5 37.5-90.5zm428 481l101-382q6-26-7.5-48.5t-38.5-29.5-48 6.5-30 39.5l-101 382q-60 5-107 43.5t-63 98.5q-20 77 20 146t117 89 146-20 89-117q16-60-6-117t-72-91zm660-33q0-53-37.5-90.5t-90.5-37.5-90.5 37.5-37.5 90.5 37.5 90.5 90.5 37.5 90.5-37.5 37.5-90.5zm-640-640q0-53-37.5-90.5t-90.5-37.5-90.5 37.5-37.5 90.5 37.5 90.5 90.5 37.5 90.5-37.5 37.5-90.5zm448 192q0-53-37.5-90.5t-90.5-37.5-90.5 37.5-37.5 90.5 37.5 90.5 90.5 37.5 90.5-37.5 37.5-90.5zm320 448q0 261-141 483-19 29-54 29h-1402q-35 0-54-29-141-221-141-483 0-182 71-348t191-286 286-191 348-71 348 71 286 191 191 286 71 348z"/>
        </svg>

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
                <a class="btn btn-light {{active_link('meter_home') ? 'active' : ''}}" href="{{route('meter_home')}}">Dashboard</a>
            </li>
            <li class="nav-item">
                <a class="btn btn-light" href="#">Requests</a>
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
