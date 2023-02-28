<?php

use App\Http\Controllers\TaskController;
use App\Http\Controllers\User\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Product Routes
|--------------------------------------------------------------------------
|
*/

Route::middleware('auth')->controller(UserController::class)->prefix('users')->group(function(){
    Route::get('/', 'index')->name('users.index');
    Route::get('/create', 'create')->name('users.create');
    Route::post('/store', 'store')->name('users.store');
    Route::get('/edit/{id}', 'edit')->name('users.edit');
    Route::post('/update', 'update')->name('users.update');
    Route::post('/destroy', 'destroy')->name('users.destroy');
    Route::get('/autoData', 'autoData')->name('users.autoData');
});


Route::middleware('auth')->controller(TaskController::class)->prefix('tasks')->group(function(){
    Route::get('/', 'index')->name('tasks.index');
    Route::get('/create', 'create')->name('tasks.create');
    Route::post('/store', 'store')->name('tasks.store');
    Route::get('/edit/{id}', 'edit')->name('tasks.edit');
    Route::post('/update', 'update')->name('tasks.update');
    Route::post('/status', 'status')->name('tasks.status');
    Route::get('/destroy/{id}', 'destroy')->name('tasks.destroy');
    Route::get('/assign/{id}', 'assign')->name('tasks.assign');
    Route::post('/assign/users', 'assigntousers')->name('tasks.assignto.users');
});
