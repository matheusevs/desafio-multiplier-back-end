<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/cliente', 'App\Http\Controllers\ClientesController@index');
    Route::put('/cliente/edit/{id}', 'App\Http\Controllers\ClientesController@update');
    Route::get('/cliente/edit/{id}', 'App\Http\Controllers\ClientesController@edit');
    Route::post('/cliente/create', 'App\Http\Controllers\ClientesController@store');
    Route::delete('/cliente/delete/{id}', 'App\Http\Controllers\ClientesController@destroy');
});
