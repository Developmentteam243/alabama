<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Category;
use App\Models\Subcategory;
use App\Models\Brand;
use App\Models\Product;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categoriesCount = Category::count();
        $subcategoriesCount = Subcategory::count();
        $brandsCount = Brand::count();
        $productsCount = Product::count();

        return view('home', compact('categoriesCount', 'subcategoriesCount', 'brandsCount', 'productsCount'));
    }
}
