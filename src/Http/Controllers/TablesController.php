<?php

namespace Sarfraznawaz2005\Meter\Http\Controllers;

use Illuminate\Routing\Controller;
use Sarfraznawaz2005\Meter\Tables\CommandsTable;
use Sarfraznawaz2005\Meter\Tables\EventsTable;
use Sarfraznawaz2005\Meter\Tables\QueriesTable;
use Sarfraznawaz2005\Meter\Tables\RequestsTable;
use Sarfraznawaz2005\Meter\Tables\SchedulesTable;

class TablesController extends Controller
{
    public function requestsTable(RequestsTable $table): array
    {
        return $table->getData();
    }

    public function queriesTable(QueriesTable $table): array
    {
        return $table->getData();
    }

    public function commandsTable(CommandsTable $table): array
    {
        return $table->getData();
    }

    public function eventsTable(EventsTable $table): array
    {
        return $table->getData();
    }

    public function schedulesTable(SchedulesTable $table): array
    {
        return $table->getData();
    }
}
