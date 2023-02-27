<?php

use App\Http\Controllers\API\CategoryController;
use Illuminate\Http\Request;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::controller(CategoryController::class)->group(function(){
    Route::get('/categories', 'index')->name('category.index');
    Route::post('/store', 'store')->name('category.store');
    Route::get('/edit/{id}', 'edit')->name('category.edit');
    Route::get('/show/{id}', 'show')->name('category.show');
    Route::post('/update/{id}', 'update')->name('category.update');
    Route::delete('/destroy/{id}', 'destroy')->name('category.destroy');
});
