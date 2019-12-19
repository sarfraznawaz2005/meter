<?php

use Illuminate\Support\Facades\Route;

// pages
Route::get('/', 'HomeController@index')->name('meter_home');
Route::get('requests', 'TablesController@requests')->name('meter_requests');

// tables
Route::get('requests_table', 'TablesController@requestTable')->name('meter_requests_table');
