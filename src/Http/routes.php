<?php

use Illuminate\Support\Facades\Route;

Route::get('/', 'HomeController@index')->name('meter_home');

Route::get('requests_table', 'HomeController@requestTable')->name('meter_requests_table');
