<?php

use App\Http\Controllers\XMLToJSONResponseController;
use App\Models\DBConnection;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

// task 1
Route::get('/xml-to-json', 'XMLToJSONResponseController@xmlToJson');
// task 2.1
Route::get('/threshold-filter', 'TasksController@thresholdFilter');
// task 2.2   
Route::get('/sum-filtered', 'TasksController@sumFiltered');
// task 3
Route::post('/check-connection', 'TasksController@checkConn');