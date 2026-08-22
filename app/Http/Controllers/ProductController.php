<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use App\Models\Subcategory;
use App\Models\Brand;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Product::with(['brand', 'subcategory.category']);

        // Filters
        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->where(function ($q) use ($search) {
                $q->where('sku_code', 'like', "%{$search}%")
                  ->orWhere('model_name', 'like', "%{$search}%")
                  ->orWhere('mfr_part_code', 'like', "%{$search}%")
                  ->orWhere('product_family', 'like', "%{$search}%");
            });
        }

        if ($request->filled('brand_id')) {
            $query->where('brand_id', $request->input('brand_id'));
        }

        if ($request->filled('category_id')) {
            $query->whereHas('subcategory', function ($q) use ($request) {
                $q->where('category_id', $request->input('category_id'));
            });
        }

        if ($request->filled('subcategory_id')) {
            $query->where('subcategory_id', $request->input('subcategory_id'));
        }

        $products = $query->latest()->paginate(15)->withQueryString();

        $brands = Brand::orderBy('name')->get();
        $categories = Category::orderBy('name')->get();
        $subcategories = Subcategory::orderBy('name')->get();

        return view('products.index', compact('products', 'brands', 'categories', 'subcategories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $brands = Brand::orderBy('name')->get();
        $categories = Category::with('subcategories')->orderBy('name')->get();
        return view('products.create', compact('brands', 'categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'sku_code' => 'required|unique:products,sku_code',
            'brand_id' => 'required|exists:brands,id',
            'subcategory_id' => 'required|exists:subcategories,id',
            'item_code' => 'nullable|string',
            'product_type' => 'nullable|string',
            'product_family' => 'nullable|string',
            'model_name' => 'nullable|string',
            'capacity_l' => 'nullable|string',
            'orientation_mounting' => 'nullable|string',
            'heating_power_kw' => 'nullable|string',
            'voltage' => 'nullable|string',
            'max_working_pressure_bar' => 'nullable|string',
            'height_length_mm' => 'nullable|string',
            'diameter_width_mm' => 'nullable|string',
            'tank_protection_lining' => 'nullable|string',
            'heating_element' => 'nullable|string',
            'warranty_yrs' => 'nullable|string',
            'mfr_part_code' => 'nullable|string',
            'source_catalogue' => 'nullable|string',
            'notes' => 'nullable|string',
            'image' => 'nullable|image|max:10240',
            'brochure' => 'nullable|file|mimes:pdf,doc,docx|max:20480',
            'techsheet' => 'nullable|file|mimes:pdf,doc,docx|max:20480',
            'slug' => 'nullable|string|max:255',
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string',
            'video_url' => 'nullable|string|max:255',
            'product_images' => 'nullable|array',
            'product_images.*' => 'image|max:10240',
        ]);

        $data = $validated;
        unset($data['product_images']);
        unset($data['image']);
        unset($data['brochure']);
        unset($data['techsheet']);

        if ($request->hasFile('image')) {
            $imageUrl = \App\Services\CloudinaryService::upload($request->file('image'));
            if ($imageUrl) {
                $data['image_url'] = $imageUrl;
            }
        }

        if ($request->hasFile('brochure')) {
            $brochureUrl = \App\Services\CloudinaryService::upload($request->file('brochure'));
            if ($brochureUrl) {
                $data['brochure_url'] = $brochureUrl;
            }
        }

        if ($request->hasFile('techsheet')) {
            $techsheetUrl = \App\Services\CloudinaryService::upload($request->file('techsheet'));
            if ($techsheetUrl) {
                $data['techsheet_url'] = $techsheetUrl;
            }
        }

        $product = Product::create($data);

        if ($request->hasFile('product_images')) {
            $images = $request->file('product_images');
            foreach ($images as $index => $image) {
                $url = \App\Services\CloudinaryService::upload($image);
                if ($url) {
                    $product->images()->create([
                        'image_url' => $url,
                        'sort_order' => $index,
                    ]);
                }
            }
        }

        return redirect()->route('products.index')->with('success', 'Product created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        return view('products.show', compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        $brands = Brand::orderBy('name')->get();
        $categories = Category::with('subcategories')->orderBy('name')->get();
        return view('products.edit', compact('product', 'brands', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        $validated = $request->validate([
            'sku_code' => 'required|unique:products,sku_code,' . $product->id,
            'brand_id' => 'required|exists:brands,id',
            'subcategory_id' => 'required|exists:subcategories,id',
            'item_code' => 'nullable|string',
            'product_type' => 'nullable|string',
            'product_family' => 'nullable|string',
            'model_name' => 'nullable|string',
            'capacity_l' => 'nullable|string',
            'orientation_mounting' => 'nullable|string',
            'heating_power_kw' => 'nullable|string',
            'voltage' => 'nullable|string',
            'max_working_pressure_bar' => 'nullable|string',
            'height_length_mm' => 'nullable|string',
            'diameter_width_mm' => 'nullable|string',
            'tank_protection_lining' => 'nullable|string',
            'heating_element' => 'nullable|string',
            'warranty_yrs' => 'nullable|string',
            'mfr_part_code' => 'nullable|string',
            'source_catalogue' => 'nullable|string',
            'notes' => 'nullable|string',
            'image' => 'nullable|image|max:10240',
            'brochure' => 'nullable|file|mimes:pdf,doc,docx|max:20480',
            'techsheet' => 'nullable|file|mimes:pdf,doc,docx|max:20480',
            'slug' => 'nullable|string|max:255',
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string',
            'video_url' => 'nullable|string|max:255',
            'product_images' => 'nullable|array',
            'product_images.*' => 'image|max:10240',
        ]);

        $data = $validated;
        unset($data['product_images']);
        unset($data['image']);
        unset($data['brochure']);
        unset($data['techsheet']);

        if ($request->hasFile('image')) {
            $imageUrl = \App\Services\CloudinaryService::upload($request->file('image'));
            if ($imageUrl) {
                $data['image_url'] = $imageUrl;
            }
        }

        if ($request->hasFile('brochure')) {
            $brochureUrl = \App\Services\CloudinaryService::upload($request->file('brochure'));
            if ($brochureUrl) {
                $data['brochure_url'] = $brochureUrl;
            }
        }

        if ($request->hasFile('techsheet')) {
            $techsheetUrl = \App\Services\CloudinaryService::upload($request->file('techsheet'));
            if ($techsheetUrl) {
                $data['techsheet_url'] = $techsheetUrl;
            }
        }

        $product->update($data);

        // Handle existing images' sort orders
        if ($request->has('sort_orders')) {
            foreach ($request->input('sort_orders') as $imageId => $order) {
                $product->images()->where('id', $imageId)->update(['sort_order' => intval($order)]);
            }
        }

        // Handle deletions of existing images
        if ($request->has('delete_images')) {
            $deleteIds = $request->input('delete_images');
            $product->images()->whereIn('id', $deleteIds)->delete();
        }

        // Handle newly uploaded images
        if ($request->hasFile('product_images')) {
            $images = $request->file('product_images');
            $maxOrder = $product->images()->max('sort_order') ?? -1;
            foreach ($images as $index => $image) {
                $url = \App\Services\CloudinaryService::upload($image);
                if ($url) {
                    $product->images()->create([
                        'image_url' => $url,
                        'sort_order' => $maxOrder + 1 + $index,
                    ]);
                }
            }
        }

        return redirect()->route('products.index')->with('success', 'Product updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        $product->delete();
        return redirect()->route('products.index')->with('success', 'Product deleted successfully.');
    }
}
