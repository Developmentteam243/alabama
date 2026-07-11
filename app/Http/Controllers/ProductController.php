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
        $subcategories = Subcategory::with('category')->orderBy('name')->get();
        return view('products.create', compact('brands', 'subcategories'));
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
        ]);

        Product::create($validated);

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
        $subcategories = Subcategory::with('category')->orderBy('name')->get();
        return view('products.edit', compact('product', 'brands', 'subcategories'));
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
        ]);

        $product->update($validated);

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
