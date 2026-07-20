<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Subcategory;
use App\Models\Product;
use App\Models\Blog;
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

        // Filter by Category (via Subcategory)
        if ($request->filled('category_id')) {
            $query->whereHas('subcategory', function ($q) use ($request) {
                $q->where('category_id', $request->get('category_id'));
            });
        }

        $products = $query->paginate(12)->withQueryString();

        // Get 6 featured products for homepage collections
        $featuredProducts = Product::with('brand')->latest()->limit(6)->get();

        // Get unique options for filter dropdowns
        $brands = Brand::orderBy('name')->get();
        $subcategories = Subcategory::with('category')->orderBy('name')->get();
        $capacities = Product::whereNotNull('capacity_l')->where('capacity_l', '!=', '')->distinct()->pluck('capacity_l')->sort();
        $mountings = Product::whereNotNull('orientation_mounting')->where('orientation_mounting', '!=', '')->distinct()->pluck('orientation_mounting')->sort();

        return view('frontend.index', compact(
            'products',
            'featuredProducts',
            'brands',
            'subcategories',
            'capacities',
            'mountings'
        ));
    }

    public function show(Product $product)
    {
        $product->load(['brand', 'subcategory.category']);
        
        // Find variants in the same product family
        $variants = collect();
        if ($product->product_family) {
            $variants = Product::where('product_family', $product->product_family)
                ->where('brand_id', $product->brand_id)
                ->get();
        }
        if ($variants->isEmpty()) {
            $variants = collect([$product]);
        }
        
        // Find related products in the same subcategory (excluding same family)
        $relatedQuery = Product::where('subcategory_id', $product->subcategory_id)
            ->where('id', '!=', $product->id);
            
        if ($product->product_family) {
            $relatedQuery->where('product_family', '!=', $product->product_family);
        }
        
        $relatedProducts = $relatedQuery->with('brand')->limit(4)->get();

        return view('frontend.show', compact('product', 'variants', 'relatedProducts'));
    }

    public function about()  {
        return view('frontend.about');
    }
    public function blog()  {
        $blogs = Blog::active()->latest()->paginate(9);
        return view('frontend.blog', compact('blogs'));
    }

    public function blogDetail($slug) {
        $blog = Blog::active()->where('slug', $slug)->firstOrFail();
        
        // Fetch 3 other latest active blogs as recommendations
        $recentBlogs = Blog::active()
            ->where('id', '!=', $blog->id)
            ->latest()
            ->limit(3)
            ->get();

        return view('frontend.blog-detail', compact('blog', 'recentBlogs'));
    }
    public function contact()  {
        return view('frontend.contact');
    }
    public function categoryShow($slug) {
        $category = Category::where('slug', $slug)->firstOrFail();
        $subcategories = $category->subcategories;
        
        // Fetch products belonging to this category's subcategories
        $subIds = $subcategories->pluck('id');
        $products = Product::whereIn('subcategory_id', $subIds)->with('brand')->paginate(12);
        
        // Fetch up to 6 popular/featured products for this category
        $popularProducts = Product::whereIn('subcategory_id', $subIds)->with('brand')->latest()->limit(6)->get();

        return view('frontend.category-show', compact('category', 'subcategories', 'products', 'popularProducts'));
    }
    public function brandShow($slug) {
        $brand = Brand::where('slug', $slug)->firstOrFail();
        
        // Fetch products belonging to this brand
        $products = Product::where('brand_id', $brand->id)->with(['subcategory.category'])->paginate(12);

        // Fetch categories and subcategories associated with this brand
        $categories = Category::whereHas('subcategories.products', function ($q) use ($brand) {
            $q->where('brand_id', $brand->id);
        })->with(['subcategories' => function ($q) use ($brand) {
            $q->whereHas('products', function ($pq) use ($brand) {
                $pq->where('brand_id', $brand->id);
            })->withCount(['products' => function ($pq) use ($brand) {
                $pq->where('brand_id', $brand->id);
            }]);
        }])->get();

        return view('frontend.brand-show', compact('brand', 'products', 'categories'));
    }
    public function all_brands()  {
        return view('frontend.all-brands');
    }
}
