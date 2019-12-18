<?php

namespace Sarfraznawaz2005\Meter\Http\Controllers;

use Illuminate\Routing\Controller;
use Sarfraznawaz2005\Meter\Charts\Request\RequestTimeChart;
use Sarfraznawaz2005\Meter\Tables\Request\RequestsTable;

class HomeController extends Controller
{
    public function index()
    {
        $chart = new RequestTimeChart;

        $chart->labels(['One', 'Two', 'Three', 'Four']);
        $chart->dataset('My dataset', 'line', [1, 2, 3, 4]);
        //$chart->minimalist(false);
        //$chart->displayLegend(true);
        //$chart->displayAxes(true);

        return view('meter::index', compact('chart'));
    }

    public function requestTable(RequestsTable $table)
    {
        return $table->getData();
    }
}
