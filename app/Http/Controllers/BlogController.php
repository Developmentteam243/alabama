<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Services\CloudinaryService;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $blogs = Blog::latest()->paginate(15);
        return view('blogs.index', compact('blogs'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('blogs.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'tag' => 'nullable|string|max:100',
            'content' => 'required|string',
            'image' => 'nullable|image|max:10240',
            'is_active' => 'nullable|boolean',
        ]);

        $data = $validated;
        $data['slug'] = $this->generateUniqueSlug($request->title);
        $data['is_active'] = $request->has('is_active');

        if ($request->hasFile('image')) {
            $imageUrl = CloudinaryService::upload($request->file('image'));
            if ($imageUrl) {
                $data['image_url'] = $imageUrl;
            }
        }

        Blog::create($data);

        return redirect()->route('blogs.index')->with('success', 'Blog post created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Blog $blog)
    {
        return view('blogs.show', compact('blog'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Blog $blog)
    {
        return view('blogs.edit', compact('blog'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Blog $blog)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'tag' => 'nullable|string|max:100',
            'content' => 'required|string',
            'image' => 'nullable|image|max:10240',
            'is_active' => 'nullable|boolean',
        ]);

        $data = $validated;
        $data['is_active'] = $request->has('is_active');

        // Regenerate slug if title changed
        if ($blog->title !== $request->title) {
            $data['slug'] = $this->generateUniqueSlug($request->title, $blog->id);
        }

        if ($request->hasFile('image')) {
            $imageUrl = CloudinaryService::upload($request->file('image'));
            if ($imageUrl) {
                $data['image_url'] = $imageUrl;
            }
        }

        $blog->update($data);

        return redirect()->route('blogs.index')->with('success', 'Blog post updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Blog $blog)
    {
        $blog->delete();
        return redirect()->route('blogs.index')->with('success', 'Blog post deleted successfully.');
    }

    /**
     * Generate unique slug helper.
     */
    protected function generateUniqueSlug(string $title, int $exceptId = 0): string
    {
        $slug = Str::slug($title);
        $originalSlug = $slug;
        $count = 2;

        while (Blog::where('slug', $slug)->where('id', '!=', $exceptId)->exists()) {
            $slug = $originalSlug . '-' . $count;
            $count++;
        }

        return $slug;
    }
}
