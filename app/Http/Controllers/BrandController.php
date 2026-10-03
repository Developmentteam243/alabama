<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use Illuminate\Http\Request;

class BrandController extends Controller
{
    public function index()
    {
        $brands = Brand::latest()->paginate(15);
        return view('brands.index', compact('brands'));
    }

    public function create()
    {
        return view('brands.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'code' => 'required|string|unique:brands,code|max:50',
            'manufacturer' => 'nullable|string|max:255',
            'country_of_origin' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'logo' => 'nullable|image|max:10240',
            'poster' => 'nullable|image|max:10240',
            'is_active' => 'nullable|boolean',
        ]);

        $data = $validated;
        unset($data['logo'], $data['poster']);
        $data['is_active'] = $request->has('is_active') ? (bool) $request->is_active : true;

        if ($request->hasFile('logo')) {
            $logoUrl = \App\Services\CloudinaryService::upload($request->file('logo'));
            if ($logoUrl) {
                $data['logo_url'] = $logoUrl;
            }
        }

        if ($request->hasFile('poster')) {
            $posterUrl = \App\Services\CloudinaryService::upload($request->file('poster'));
            if ($posterUrl) {
                $data['poster_url'] = $posterUrl;
            }
        }

        Brand::create($data);

        return redirect()->route('brands.index')->with('success', 'Brand created successfully.');
    }

    public function show(Brand $brand)
    {
        return view('brands.show', compact('brand'));
    }

    public function edit(Brand $brand)
    {
        return view('brands.edit', compact('brand'));
    }

    public function update(Request $request, Brand $brand)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'code' => 'required|string|max:50|unique:brands,code,' . $brand->id,
            'manufacturer' => 'nullable|string|max:255',
            'country_of_origin' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'logo' => 'nullable|image|max:10240',
            'poster' => 'nullable|image|max:10240',
            'is_active' => 'nullable|boolean',
        ]);

        $data = $validated;
        unset($data['logo'], $data['poster']);
        $data['is_active'] = $request->has('is_active') ? (bool) $request->is_active : false;

        if ($request->hasFile('logo')) {
            $logoUrl = \App\Services\CloudinaryService::upload($request->file('logo'));
            if ($logoUrl) {
                $data['logo_url'] = $logoUrl;
            }
        }

        if ($request->hasFile('poster')) {
            $posterUrl = \App\Services\CloudinaryService::upload($request->file('poster'));
            if ($posterUrl) {
                $data['poster_url'] = $posterUrl;
            }
        }

        $brand->update($data);

        return redirect()->route('brands.index')->with('success', 'Brand updated successfully.');
    }

    public function destroy(Brand $brand)
    {
        $brand->delete();
        return redirect()->route('brands.index')->with('success', 'Brand deleted successfully.');
    }
}
