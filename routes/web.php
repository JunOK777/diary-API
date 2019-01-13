<?php

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

Route::group(['middleware' => ['cors'], 'prefix' => 'api'], function ($router) { 
    Route::get("test", "ApiTestController@test");
    Route::get('getAllTasks', 'ApiTestController@getAllTasks');
    Route::get('deleteTask', 'ApiTestController@deleteTask');
    Route::post('sendSlack', 'ApiTestController@sendSlack');
    Route::post('saveTask', 'ApiTestController@saveTask');
    Route::post('saveCheck', 'ApiTestController@saveCheck');
    Route::post('delTask', 'ApiTestController@delTask');
    Route::post('login', 'ApiTestController@login');
});