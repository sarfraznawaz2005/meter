<?php

namespace Sarfraznawaz2005\Meter\Http\Controllers;

use Illuminate\Routing\Controller;
use Sarfraznawaz2005\Meter\Charts\Request\RequestTimeChart;
use Sarfraznawaz2005\Meter\Tables\Request\RequestsTable;

class HomeController extends Controller
{
    public function index(RequestTimeChart $chart)
    {
        return view('meter::index', compact('chart'));
    }

    public function requestTable(RequestsTable $table)
    {
        return $table->getData();
    }
}
