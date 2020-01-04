<?php

use Illuminate\Support\Facades\Route;

// pages
Route::get('/', 'PagesController@home')->name('meter_home');
Route::get('requests', 'PagesController@requests')->name('meter_requests');
Route::get('queries', 'PagesController@queries')->name('meter_queries');
Route::get('commands', 'PagesController@commands')->name('meter_commands');
Route::get('events', 'PagesController@events')->name('meter_events');

// tables
Route::get('requests_table', 'TablesController@requestsTable')->name('meter_requests_table');
Route::get('queries_table', 'TablesController@queriesTable')->name('meter_queries_table');
Route::get('commands_table', 'TablesController@commandsTable')->name('meter_commands_table');
Route::get('events_table', 'TablesController@eventsTable')->name('meter_events_table');
