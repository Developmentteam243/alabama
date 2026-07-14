<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Subcategory;
use App\Models\Product;
use Illuminate\Http\Request;

class FrontendController extends Controller
{
    /**
     * Show the frontend home page with search and filter functionality.
     */
    public function index(Request $request)
    {
        $query = Product::with(['brand', 'subcategory.category']);

        // Search by keyword (sku, model name, item code, etc.)
        if ($request->filled('search')) {
            $search = $request->get('search');
            $query->where(function ($q) use ($search) {
                $q->where('model_name', 'like', "%{$search}%")
                  ->orWhere('sku_code', 'like', "%{$search}%")
                  ->orWhere('item_code', 'like', "%{$search}%")
                  ->orWhere('product_family', 'like', "%{$search}%");
            });
        }

        // Filter by Brand
        if ($request->filled('brand_id')) {
            $query->where('brand_id', $request->get('brand_id'));
        }

        // Filter by Subcategory
        if ($request->filled('subcategory_id')) {
            $query->where('subcategory_id', $request->get('subcategory_id'));
        }

        // Filter by Capacity
        if ($request->filled('capacity')) {
            $query->where('capacity_l', $request->get('capacity'));
        }

        // Filter by Mounting/Orientation
        if ($request->filled('mounting')) {
            $query->where('orientation_mounting', $request->get('mounting'));
        }

        $products = $query->paginate(12)->withQueryString();

        // Get unique options for filter dropdowns
        $brands = Brand::orderBy('name')->get();
        $subcategories = Subcategory::with('category')->orderBy('name')->get();
        $capacities = Product::whereNotNull('capacity_l')->where('capacity_l', '!=', '')->distinct()->pluck('capacity_l')->sort();
        $mountings = Product::whereNotNull('orientation_mounting')->where('orientation_mounting', '!=', '')->distinct()->pluck('orientation_mounting')->sort();

        return view('frontend.index', compact(
            'products',
            'brands',
            'subcategories',
            'capacities',
            'mountings'
        ));
    }

    /**
     * Show details of a single product.
     */
    public function show(Product $product)
    {
        $product->load(['brand', 'subcategory.category']);
        
        // Find related products in the same subcategory
        $relatedProducts = Product::where('subcategory_id', $product->subcategory_id)
            ->where('id', '!=', $product->id)
            ->limit(4)
            ->get();

        return view('frontend.show', compact('product', 'relatedProducts'));
    }
}
