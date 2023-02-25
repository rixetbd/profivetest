<?php

use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Product Routes
|--------------------------------------------------------------------------
|
*/

Route::controller(ProductController::class)->group(function(){
    Route::get('/app', 'app')->name('product.index');
});
