<?php

namespace App\Http\Controllers;

use App\Models\Slider;
use App\Services\CloudinaryService;
use Illuminate\Http\Request;

class SliderController extends Controller
{
    /**
     * Display a listing of slides.
     */
    public function index()
    {
        $sliders = Slider::orderBy('sort_order', 'asc')->latest()->paginate(15);
        return view('sliders.index', compact('sliders'));
    }

    /**
     * Show the form for creating a new slide.
     */
    public function create()
    {
        return view('sliders.create');
    }

    /**
     * Store a newly created slide.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'nullable|string|max:255',
            'subtitle' => 'nullable|string|max:255',
            'image' => 'nullable|image|max:10240',
            'image_url' => 'nullable|string|max:1000',
            'button_text' => 'nullable|string|max:100',
            'button_url' => 'nullable|string|max:255',
            'sort_order' => 'nullable|integer',
            'is_active' => 'nullable|boolean',
        ]);

        if (!$request->hasFile('image') && empty($validated['image_url'])) {
            return back()->withErrors(['image' => 'Please provide an image file or direct image URL.'])->withInput();
        }

        $data = $validated;
        unset($data['image']);
        $data['is_active'] = $request->has('is_active') ? (bool) $request->is_active : true;
        $data['sort_order'] = $request->input('sort_order', 0) ?? 0;
        $data['button_text'] = $request->input('button_text') ?: 'Explore Range';

        if ($request->hasFile('image')) {
            $uploadedUrl = CloudinaryService::upload($request->file('image'));
            if ($uploadedUrl) {
                $data['image_url'] = $uploadedUrl;
            }
        }

        Slider::create($data);

        return redirect()->route('sliders.index')->with('success', 'Slide created successfully.');
    }

    /**
     * Show the form for editing the slide.
     */
    public function edit(Slider $slider)
    {
        return view('sliders.edit', compact('slider'));
    }

    /**
     * Update the specified slide.
     */
    public function update(Request $request, Slider $slider)
    {
        $validated = $request->validate([
            'title' => 'nullable|string|max:255',
            'subtitle' => 'nullable|string|max:255',
            'image' => 'nullable|image|max:10240',
            'image_url' => 'nullable|string|max:1000',
            'button_text' => 'nullable|string|max:100',
            'button_url' => 'nullable|string|max:255',
            'sort_order' => 'nullable|integer',
            'is_active' => 'nullable|boolean',
        ]);

        $data = $validated;
        unset($data['image']);
        $data['is_active'] = $request->has('is_active') ? (bool) $request->is_active : false;
        $data['sort_order'] = $request->input('sort_order', 0) ?? 0;
        $data['button_text'] = $request->input('button_text') ?: 'Explore Range';

        if ($request->hasFile('image')) {
            $uploadedUrl = CloudinaryService::upload($request->file('image'));
            if ($uploadedUrl) {
                $data['image_url'] = $uploadedUrl;
            }
        }

        $slider->update($data);

        return redirect()->route('sliders.index')->with('success', 'Slide updated successfully.');
    }

    /**
     * Remove the specified slide.
     */
    public function destroy(Slider $slider)
    {
        $slider->delete();
        return redirect()->route('sliders.index')->with('success', 'Slide deleted successfully.');
    }
}
