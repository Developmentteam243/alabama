<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Subcategory;
use App\Models\Product;
use App\Models\Blog;
use App\Models\Quote;
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
    public function categoryShow(Request $request, $slug) {
        $category = Category::where('slug', $slug)->firstOrFail();
        $subcategories = $category->subcategories;
        $subIds = $subcategories->pluck('id');
        
        $query = Product::whereIn('subcategory_id', $subIds)->with('brand');

        if ($request->filled('search')) {
            $search = $request->get('search');
            $query->where(function ($q) use ($search) {
                $q->where('model_name', 'like', "%{$search}%")
                  ->orWhere('sku_code', 'like', "%{$search}%")
                  ->orWhere('item_code', 'like', "%{$search}%")
                  ->orWhere('product_family', 'like', "%{$search}%");
            });
        }

        if ($request->filled('brand_id')) {
            $query->where('brand_id', $request->get('brand_id'));
        }

        if ($request->filled('capacity')) {
            $query->where('capacity_l', $request->get('capacity'));
        }

        if ($request->filled('mounting')) {
            $query->where('orientation_mounting', $request->get('mounting'));
        }

        $products = $query->paginate(12)->withQueryString();
        
        // Fetch up to 6 popular/featured products for this category
        $popularProducts = Product::whereIn('subcategory_id', $subIds)->with('brand')->latest()->limit(6)->get();

        // Get filter options specific to this category
        $brands = Brand::whereHas('products', function($q) use ($subIds) {
            $q->whereIn('subcategory_id', $subIds);
        })->orderBy('name')->get();
        
        $capacities = Product::whereIn('subcategory_id', $subIds)
            ->whereNotNull('capacity_l')
            ->where('capacity_l', '!=', '')
            ->distinct()
            ->pluck('capacity_l')
            ->sort();
            
        $mountings = Product::whereIn('subcategory_id', $subIds)
            ->whereNotNull('orientation_mounting')
            ->where('orientation_mounting', '!=', '')
            ->distinct()
            ->pluck('orientation_mounting')
            ->sort();

        return view('frontend.category-show', compact(
            'category', 
            'subcategories', 
            'products', 
            'popularProducts', 
            'brands', 
            'capacities', 
            'mountings'
        ));
    }

    public function subcategoryShow(Request $request, $categorySlug, $subcategorySlug) {
        $category = Category::where('slug', $categorySlug)->firstOrFail();
        $subcategory = Subcategory::where('category_id', $category->id)->where('slug', $subcategorySlug)->firstOrFail();
        
        $query = Product::where('subcategory_id', $subcategory->id)->with('brand');

        if ($request->filled('search')) {
            $search = $request->get('search');
            $query->where(function ($q) use ($search) {
                $q->where('model_name', 'like', "%{$search}%")
                  ->orWhere('sku_code', 'like', "%{$search}%")
                  ->orWhere('item_code', 'like', "%{$search}%")
                  ->orWhere('product_family', 'like', "%{$search}%");
            });
        }

        if ($request->filled('brand_id')) {
            $query->where('brand_id', $request->get('brand_id'));
        }

        if ($request->filled('capacity')) {
            $query->where('capacity_l', $request->get('capacity'));
        }

        if ($request->filled('mounting')) {
            $query->where('orientation_mounting', $request->get('mounting'));
        }

        $products = $query->paginate(12)->withQueryString();
        
        // Fetch up to 6 popular/featured products for this subcategory
        $popularProducts = Product::where('subcategory_id', $subcategory->id)->with('brand')->latest()->limit(6)->get();

        // Get filter options specific to this subcategory
        $brands = Brand::whereHas('products', function($q) use ($subcategory) {
            $q->where('subcategory_id', $subcategory->id);
        })->orderBy('name')->get();
        
        $capacities = Product::where('subcategory_id', $subcategory->id)
            ->whereNotNull('capacity_l')
            ->where('capacity_l', '!=', '')
            ->distinct()
            ->pluck('capacity_l')
            ->sort();
            
        $mountings = Product::where('subcategory_id', $subcategory->id)
            ->whereNotNull('orientation_mounting')
            ->where('orientation_mounting', '!=', '')
            ->distinct()
            ->pluck('orientation_mounting')
            ->sort();
        
        return view('frontend.subcategory-show', compact(
            'category', 
            'subcategory', 
            'products', 
            'popularProducts', 
            'brands', 
            'capacities', 
            'mountings'
        ));
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

    public function storeReview(Request $request, Product $product)
    {
        $validated = $request->validate([
            'customer_name' => 'required|string|max:255',
            'customer_email' => 'required|email|max:255',
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'required|string|min:3',
        ]);

        $product->allReviews()->create($validated);

        return redirect()->back()->with('success_review', 'Your review has been submitted and is awaiting approval.');
    }

    public function storeQuote(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:50',
            'requirement' => 'nullable|string',
            'boq' => 'nullable|file|mimes:pdf,xls,xlsx|max:15360',
        ]);

        $data = $validated;
        unset($data['boq']);

        if ($request->hasFile('boq')) {
            $boqUrl = \App\Services\CloudinaryService::upload($request->file('boq'));
            if ($boqUrl) {
                $data['boq_url'] = $boqUrl;
            }
        }

        Quote::create($data);

        return redirect()->back()->with('success_quote', 'Your quotation request has been submitted successfully. Our sales team will get back to you shortly.');
    }
}
