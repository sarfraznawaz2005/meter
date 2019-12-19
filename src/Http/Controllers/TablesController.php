<?php

namespace Sarfraznawaz2005\Meter\Http\Controllers;

use Illuminate\Routing\Controller;
use Sarfraznawaz2005\Meter\Charts\Request\RequestTimeChart;
use Sarfraznawaz2005\Meter\Tables\Request\RequestsTable;

class TablesController extends Controller
{
    public function requests(RequestTimeChart $chart)
    {
        return view('meter::requests', compact('chart'));
    }

    public function requestTable(RequestsTable $table): array
    {
        return $table->getData();
    }
}
