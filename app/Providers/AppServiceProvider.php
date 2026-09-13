<?php

namespace App\Providers;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Setting;
use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Schema;

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
        Paginator::useBootstrapFive();

        view()->composer('*', function ($view) {
            try {
                if (Schema::hasTable('categories')) {
                    $view->with('navCategories', Category::orderBy('name')->get());
                }
                if (Schema::hasTable('brands')) {
                    $view->with('navBrands', Brand::orderBy('name')->get());
                }
                if (Schema::hasTable('settings')) {
                    $settings = Setting::all()->pluck('value', 'key')->toArray();
                    $view->with('siteSettings', $settings);
                }
            } catch (\Exception $e) {
                // Ignore during early migrations / setup
            }
        });
    }
}
