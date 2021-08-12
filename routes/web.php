<?php

use Illuminate\Support\Facades\Route;


Auth::routes();

Route::get('/home', 'App\Http\Controllers\HomeController@index')->name('home');

Route::prefix('leader')->group(function(){
    Route::get('/', 'TaskController@index');
    Route::post('/task/create','TaskController@store')->name('task_create');
    Route::post('/task/edit/{id}','TaskController@edit')->name('tasks_edit');
    Route::delete('/task/delete/{id}','TaskController@destroy')->name('tasks_destroy');
    Route::get('get/developer','UserController@getDevelopers')->name('get_developers');
});
