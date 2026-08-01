<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ProductController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\CategoryController;

use App\Http\Controllers\FrontendController;

use App\Http\Controllers\BlogController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\QuoteController;

Route::get('/', [FrontendController::class, 'index'])->name('frontend.home');
Route::get('/about', [FrontendController::class, 'about'])->name('frontend.about');
Route::get('/blog', [FrontendController::class, 'blog'])->name('frontend.blog');
Route::get('/blog/{slug}', [FrontendController::class, 'blogDetail'])->name('frontend.blog.show');
Route::get('/contact', [FrontendController::class, 'contact'])->name('frontend.contact');
Route::get('/category/{slug}', [FrontendController::class, 'categoryShow'])->name('frontend.category.show');
Route::get('/category/{category:slug}/{subcategory:slug}', [FrontendController::class, 'subcategoryShow'])->name('frontend.subcategory.show');
Route::get('/brand/{slug}', [FrontendController::class, 'brandShow'])->name('frontend.brand.show');
Route::get('/all-brands', [FrontendController::class, 'all_brands'])->name('frontend.all-brands');
Route::get('/product/{product:slug}', [FrontendController::class, 'show'])->name('frontend.product.show');
Route::post('/product/{product}/reviews', [FrontendController::class, 'storeReview'])->name('frontend.reviews.store');
Route::post('/get-quote', [FrontendController::class, 'storeQuote'])->name('frontend.quote.store');

require __DIR__.'/auth.php';

Route::middleware('auth')->group(function () {
    Route::get('/home', [\App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::resource('products', ProductController::class);
    Route::resource('brands', BrandController::class);
    Route::resource('categories', CategoryController::class);
    Route::resource('blogs', BlogController::class);
    Route::post('categories/{category}/subcategories', [CategoryController::class, 'storeSubcategory'])->name('categories.subcategories.store');
    Route::get('subcategories/{subcategory}/edit', [CategoryController::class, 'editSubcategory'])->name('subcategories.edit');
    Route::put('subcategories/{subcategory}', [CategoryController::class, 'updateSubcategory'])->name('subcategories.update');
    Route::delete('subcategories/{subcategory}', [CategoryController::class, 'destroySubcategory'])->name('subcategories.destroy');
    Route::resource('reviews', ReviewController::class)->only(['index', 'update', 'destroy']);
    Route::resource('quotes', QuoteController::class)->only(['index', 'destroy']);
});

