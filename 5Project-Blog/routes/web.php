<?php

use App\Http\Controllers\FrontendController;
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

Route::controller(FrontendController::class)->group(function(){

    Route::get('/', 'welcome')->name('frontend.welcome');
    Route::get('/blog', 'index')->name('frontend.index');
    Route::get('/blog/{slug}', 'blog_view')->name('frontend.blogview');

});
