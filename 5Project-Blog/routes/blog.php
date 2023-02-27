<?php

use App\Http\Controllers\BlogController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Product Routes
|--------------------------------------------------------------------------
|
*/

Route::controller(BlogController::class)->group(function(){
    // Route::get('/', 'index')->name('product.index');
    Route::get('/blog-create', 'create')->name('blog.create');
    Route::post('/store', 'store')->name('blog.store');
    Route::get('/show', 'show')->name('blog.show');
    Route::get('/edit/{id}', 'edit')->name('blog.edit');
    Route::post('/update', 'update')->name('blog.update');
    Route::get('/destroy/{id}', 'destroy')->name('blog.destroy');
    Route::get('/autoData', 'autoData')->name('blog.autoData');
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

Route::controller(CommentController::class)->group(function(){
    Route::post('/comment-store', 'store')->name('comment.store');
    Route::post('/comment-update', 'update')->name('comment.update');
    Route::post('/comment-destroy', 'destroy')->name('comment.destroy');
    Route::post('/comment-autoData', 'autoData')->name('comment.autoData');
});
