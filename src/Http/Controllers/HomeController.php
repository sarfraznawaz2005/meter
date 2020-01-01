<?php

namespace Sarfraznawaz2005\Meter\Http\Controllers;

use Illuminate\Routing\Controller;
use Sarfraznawaz2005\Meter\Charts\RequestTimeChart;

class HomeController extends Controller
{
    public function index(RequestTimeChart $chart)
    {
        return view('meter::dashboard', compact('chart'));
    }
}
