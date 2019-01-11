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
    Route::get('getFavorite', 'ApiTestController@getFavorite');
    Route::get('removeFavorite', 'ApiTestController@removeFavorite');
    Route::get('addFavorite', 'ApiTestController@addFavorite');
    Route::get('getAllTasks', 'ApiTestController@getAllTasks');
    Route::get('deleteTask', 'ApiTestController@deleteTask');
    Route::post('saveTask', 'ApiTestController@saveTask');
    Route::post('saveLike', 'ApiTestController@saveLike');
    Route::post('login', 'ApiTestController@login');
});