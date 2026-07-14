<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ProductController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\CategoryController;

use App\Http\Controllers\FrontendController;

Route::get('/', [FrontendController::class, 'index'])->name('frontend.home');
Route::get('/product/{product}', [FrontendController::class, 'show'])->name('frontend.product.show');

require __DIR__.'/auth.php';

Route::middleware('auth')->group(function () {
    Route::get('/home', [\App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::resource('products', ProductController::class);
    Route::resource('brands', BrandController::class);
    Route::resource('categories', CategoryController::class);
    Route::post('categories/{category}/subcategories', [CategoryController::class, 'storeSubcategory'])->name('categories.subcategories.store');
    Route::delete('subcategories/{subcategory}', [CategoryController::class, 'destroySubcategory'])->name('subcategories.destroy');
});

