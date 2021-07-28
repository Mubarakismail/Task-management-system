<?php

use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('frontend.leader.tasks.index');
});

Auth::routes();

Route::get('/home', 'App\Http\Controllers\HomeController@index')->name('home');

Route::namespace('\app\Http\Controllers')->prefix('leader')->group(function(){

    Route::get('/task/create','TaskController@store')->name('task_create');
    Route::get('/get/developer','UserController@getDevelopers')->name('get_developers');
});
