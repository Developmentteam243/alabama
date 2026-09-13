<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\BlogRevision;
use App\Models\Product;
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
        $allBlogs = Blog::orderBy('title')->get();
        $allProducts = Product::orderBy('model_name')->get();
        return view('blogs.create', compact('allBlogs', 'allProducts'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'tag' => 'nullable|string|max:255',
            'author_name' => 'nullable|string|max:255',
            'excerpt' => 'nullable|string',
            'content' => 'required|string',
            'image' => 'nullable|image|max:10240',
            'image_alt' => 'nullable|string|max:255',
            'is_active' => 'nullable|boolean',
            'status' => 'required|string|in:draft,published,scheduled',
            'scheduled_at' => 'nullable|date',
            'slug' => 'nullable|string|max:255',
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string',
            'primary_keyword' => 'nullable|string|max:255',
            'secondary_keywords' => 'nullable|string',
            'og_title' => 'nullable|string|max:255',
            'og_description' => 'nullable|string',
            'og_image' => 'nullable|image|max:10240',
            'twitter_title' => 'nullable|string|max:255',
            'twitter_description' => 'nullable|string',
            'schema_markup' => 'nullable|string',
            'faqs' => 'nullable|array',
            'internal_external_links' => 'nullable|array',
            'related_blog_ids' => 'nullable|array',
            'related_product_ids' => 'nullable|array',
        ]);

        $data = $validated;
        unset($data['image'], $data['og_image']);

        $data['slug'] = $this->generateUniqueSlug($request->slug ?: $request->title);
        $data['is_active'] = $request->has('is_active') ? (bool)$request->is_active : true;

        if ($data['status'] === 'published') {
            $data['published_at'] = now();
        } elseif ($data['status'] === 'scheduled' && $request->filled('scheduled_at')) {
            $data['scheduled_at'] = $request->scheduled_at;
        }

        // Process FAQs (remove empty entries)
        if (!empty($request->faqs) && is_array($request->faqs)) {
            $data['faqs'] = array_values(array_filter($request->faqs, function ($item) {
                return !empty($item['question']) && !empty($item['answer']);
            }));
        } else {
            $data['faqs'] = [];
        }

        // Process Links (remove empty entries)
        if (!empty($request->internal_external_links) && is_array($request->internal_external_links)) {
            $data['internal_external_links'] = array_values(array_filter($request->internal_external_links, function ($item) {
                return !empty($item['url']);
            }));
        } else {
            $data['internal_external_links'] = [];
        }

        if ($request->hasFile('image')) {
            $imageUrl = CloudinaryService::upload($request->file('image'));
            if ($imageUrl) {
                $data['image_url'] = $imageUrl;
            }
        }

        if ($request->hasFile('og_image')) {
            $ogImageUrl = CloudinaryService::upload($request->file('og_image'));
            if ($ogImageUrl) {
                $data['og_image_url'] = $ogImageUrl;
            }
        }

        $blog = Blog::create($data);

        // Record initial revision
        BlogRevision::create([
            'blog_id' => $blog->id,
            'user_id' => auth()->id(),
            'title' => $blog->title,
            'content' => $blog->content,
            'excerpt' => $blog->excerpt,
            'meta_title' => $blog->meta_title,
            'meta_description' => $blog->meta_description,
            'revision_notes' => 'Initial creation',
        ]);

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
        $allBlogs = Blog::where('id', '!=', $blog->id)->orderBy('title')->get();
        $allProducts = Product::orderBy('model_name')->get();
        $revisions = $blog->revisions()->with('user')->get();

        return view('blogs.edit', compact('blog', 'allBlogs', 'allProducts', 'revisions'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Blog $blog)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'tag' => 'nullable|string|max:255',
            'author_name' => 'nullable|string|max:255',
            'excerpt' => 'nullable|string',
            'content' => 'required|string',
            'image' => 'nullable|image|max:10240',
            'image_alt' => 'nullable|string|max:255',
            'is_active' => 'nullable|boolean',
            'status' => 'required|string|in:draft,published,scheduled',
            'scheduled_at' => 'nullable|date',
            'slug' => 'nullable|string|max:255',
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string',
            'primary_keyword' => 'nullable|string|max:255',
            'secondary_keywords' => 'nullable|string',
            'og_title' => 'nullable|string|max:255',
            'og_description' => 'nullable|string',
            'og_image' => 'nullable|image|max:10240',
            'twitter_title' => 'nullable|string|max:255',
            'twitter_description' => 'nullable|string',
            'schema_markup' => 'nullable|string',
            'faqs' => 'nullable|array',
            'internal_external_links' => 'nullable|array',
            'related_blog_ids' => 'nullable|array',
            'related_product_ids' => 'nullable|array',
            'revision_notes' => 'nullable|string|max:255',
        ]);

        // Save current version into revisions before updating
        BlogRevision::create([
            'blog_id' => $blog->id,
            'user_id' => auth()->id(),
            'title' => $blog->title,
            'content' => $blog->content,
            'excerpt' => $blog->excerpt,
            'meta_title' => $blog->meta_title,
            'meta_description' => $blog->meta_description,
            'revision_notes' => $request->input('revision_notes', 'Revision before update at ' . now()->toDateTimeString()),
        ]);

        $data = $validated;
        unset($data['image'], $data['og_image'], $data['revision_notes']);

        $data['is_active'] = $request->has('is_active') ? (bool)$request->is_active : true;
        $data['slug'] = $this->generateUniqueSlug($request->slug ?: $request->title, $blog->id);

        if ($data['status'] === 'published' && empty($blog->published_at)) {
            $data['published_at'] = now();
        } elseif ($data['status'] === 'scheduled') {
            $data['scheduled_at'] = $request->scheduled_at;
        }

        // Process FAQs
        if (!empty($request->faqs) && is_array($request->faqs)) {
            $data['faqs'] = array_values(array_filter($request->faqs, function ($item) {
                return !empty($item['question']) && !empty($item['answer']);
            }));
        } else {
            $data['faqs'] = [];
        }

        // Process Links
        if (!empty($request->internal_external_links) && is_array($request->internal_external_links)) {
            $data['internal_external_links'] = array_values(array_filter($request->internal_external_links, function ($item) {
                return !empty($item['url']);
            }));
        } else {
            $data['internal_external_links'] = [];
        }

        if ($request->hasFile('image')) {
            $imageUrl = CloudinaryService::upload($request->file('image'));
            if ($imageUrl) {
                $data['image_url'] = $imageUrl;
            }
        }

        if ($request->hasFile('og_image')) {
            $ogImageUrl = CloudinaryService::upload($request->file('og_image'));
            if ($ogImageUrl) {
                $data['og_image_url'] = $ogImageUrl;
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
