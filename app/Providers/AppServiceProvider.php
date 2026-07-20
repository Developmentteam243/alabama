<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        view()->composer('layouts.master', function ($view) {
            $view->with('navCategories', \App\Models\Category::orderBy('name')->get());
            $view->with('navBrands', \App\Models\Brand::orderBy('name')->get());
        });
    }
}
