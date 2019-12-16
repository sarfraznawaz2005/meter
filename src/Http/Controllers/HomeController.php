<?php

namespace Sarfraznawaz2005\Meter\Http\Controllers;

use Illuminate\Routing\Controller;
use Sarfraznawaz2005\Meter\Tables\RequestsTable;

class HomeController extends Controller
{
    public function index()
    {
        $title = 'Dashboard';

        return view('meter::index', compact('title'));
    }

    public function requestTable(RequestsTable $table)
    {
        return $table->getData();
    }
}
