<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Subcategory;
use App\Services\CloudinaryService;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::with('subcategories')->latest()->paginate(15);
        return view('categories.index', compact('categories'));
    }

    public function create()
    {
        return view('categories.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'code' => 'required|string|max:50|unique:categories,code',
            'description' => 'nullable|string',
            'slug' => 'nullable|string|max:255|unique:categories,slug',
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string',
            'banner' => 'nullable|image|max:10240',
            'home_image' => 'nullable|image|max:10240',
        ]);

        $data = $validated;
        unset($data['banner'], $data['home_image']);

        if ($request->hasFile('banner')) {
            $bannerUrl = CloudinaryService::upload($request->file('banner'));
            if ($bannerUrl) {
                $data['banner_url'] = $bannerUrl;
            }
        }

        if ($request->hasFile('home_image')) {
            $homeImageUrl = CloudinaryService::upload($request->file('home_image'));
            if ($homeImageUrl) {
                $data['home_image_url'] = $homeImageUrl;
            }
        }

        Category::create($data);

        return redirect()->route('categories.index')->with('success', 'Category created successfully.');
    }

    public function show(Category $category)
    {
        return view('categories.show', compact('category'));
    }

    public function edit(Category $category)
    {
        return view('categories.edit', compact('category'));
    }

    public function update(Request $request, Category $category)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'code' => 'required|string|max:50|unique:categories,code,' . $category->id,
            'description' => 'nullable|string',
            'slug' => 'nullable|string|max:255|unique:categories,slug,' . $category->id,
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string',
            'banner' => 'nullable|image|max:10240',
            'home_image' => 'nullable|image|max:10240',
        ]);

        $data = $validated;
        unset($data['banner'], $data['home_image']);

        if ($request->hasFile('banner')) {
            $bannerUrl = CloudinaryService::upload($request->file('banner'));
            if ($bannerUrl) {
                $data['banner_url'] = $bannerUrl;
            }
        }

        if ($request->hasFile('home_image')) {
            $homeImageUrl = CloudinaryService::upload($request->file('home_image'));
            if ($homeImageUrl) {
                $data['home_image_url'] = $homeImageUrl;
            }
        }

        $category->update($data);

        return redirect()->route('categories.index')->with('success', 'Category updated successfully.');
    }

    public function destroy(Category $category)
    {
        $category->delete();
        return redirect()->route('categories.index')->with('success', 'Category deleted successfully.');
    }

    // Subcategory methods
    public function storeSubcategory(Request $request, Category $category)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'code' => 'required|string|max:50|unique:subcategories,code',
            'slug' => 'nullable|string|max:255|unique:subcategories,slug',
            'banner' => 'nullable|image|max:10240',
        ]);

        $data = $validated;
        unset($data['banner']);

        if ($request->hasFile('banner')) {
            $bannerUrl = CloudinaryService::upload($request->file('banner'));
            if ($bannerUrl) {
                $data['banner_url'] = $bannerUrl;
            }
        }

        $category->subcategories()->create($data);

        return redirect()->route('categories.index')->with('success', 'Subcategory added successfully.');
    }

    public function destroySubcategory(Subcategory $subcategory)
    {
        $subcategory->delete();
        return redirect()->route('categories.index')->with('success', 'Subcategory deleted successfully.');
    }

    public function editSubcategory(Subcategory $subcategory)
    {
        return view('subcategories.edit', compact('subcategory'));
    }

    public function updateSubcategory(Request $request, Subcategory $subcategory)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'code' => 'required|string|max:50|unique:subcategories,code,' . $subcategory->id,
            'slug' => 'nullable|string|max:255|unique:subcategories,slug,' . $subcategory->id,
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string',
            'banner' => 'nullable|image|max:10240',
        ]);

        $data = $validated;
        unset($data['banner']);

        if ($request->hasFile('banner')) {
            $bannerUrl = CloudinaryService::upload($request->file('banner'));
            if ($bannerUrl) {
                $data['banner_url'] = $bannerUrl;
            }
        }

        $subcategory->update($data);

        return redirect()->route('categories.index')->with('success', 'Subcategory updated successfully.');
    }
}
