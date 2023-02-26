<?php

use App\Http\Controllers\BlogController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Product Routes
|--------------------------------------------------------------------------
|
*/

Route::controller(BlogController::class)->prefix('product')->group(function(){
    Route::get('/', 'index')->name('product.index');
    Route::get('/create', 'create')->name('product.create');
    Route::post('/store', 'store')->name('product.store');
    Route::get('/edit/{id}', 'edit')->name('product.edit');
    Route::post('/update', 'update')->name('product.update');
    Route::post('/destroy', 'destroy')->name('product.destroy');
    Route::get('/autoData', 'autoData')->name('product.autoData');
});


Route::controller(CategoryController::class)->prefix('category')->group(function(){
    Route::get('/', 'index')->name('category.index');
    Route::get('/create', 'create')->name('category.create');
    Route::post('/store', 'store')->name('category.store');
    Route::get('/edit/{id}', 'edit')->name('category.edit');
    Route::post('/update', 'update')->name('category.update');
    Route::post('/destroy', 'destroy')->name('category.destroy');
    Route::get('/autoData', 'autoData')->name('category.autoData');
});
