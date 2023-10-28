<?php

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

Route::get('/', function(){
    return redirect('/home');
});
Route::get('/home', 'App\Http\Controllers\HomeController@index')->name('home');
Route::get('/cliente', 'App\Http\Controllers\ClientesController@index');
Route::put('/cliente/edit/{id}', 'App\Http\Controllers\ClientesController@update');
Route::get('/cliente/edit/{id}', 'App\Http\Controllers\ClientesController@edit');
Route::post('/cliente/create', 'App\Http\Controllers\ClientesController@store');
Route::delete('/cliente/delete/{id}', 'App\Http\Controllers\ClientesController@destroy');