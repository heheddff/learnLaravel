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
Route::get('hello',function(){
   return 'hello world' ;
});
Route::get('about',function(){
    return view('about');
});
Route::prefix('es')->group(function () {
    Route::get('/list', 'EsController@list');   
    Route::get('/sethosts', 'EsController@setHosts');   
    Route::get('/setRetries', 'EsController@setRetries');   
});
