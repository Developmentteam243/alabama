@extends('tablar::page')

@section('title', 'Edit Blog Post')

@section('content')
<div class="page-header d-print-none">
    <div class="container-xl">
        <div class="row g-2 align-items-center">
            <div class="col">
                <h2 class="page-title">Edit Blog Post</h2>
            </div>
        </div>
    </div>
</div>

<div class="page-body">
    <div class="container-xl">
        <form action="{{ route('blogs.update', $blog->id) }}" method="POST" enctype="multipart/form-data" class="card">
            @csrf
            @method('PUT')
            <div class="card-body">
                <div class="row row-cards">
                    <div class="col-md-8">
                        <div class="mb-3">
                            <label class="form-label required">Title</label>
                            <input type="text" name="title" class="form-control @error('title') is-invalid @enderror" value="{{ old('title', $blog->title) }}" placeholder="e.g. Electric vs. solar water heaters" required>
                            @error('title')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="mb-3">
                            <label class="form-label">Tag / Category</label>
                            <input type="text" name="tag" class="form-control @error('tag') is-invalid @enderror" value="{{ old('tag', $blog->tag) }}" placeholder="e.g. Hot water, Plumbing">
                            @error('tag')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-8">
                        <div class="mb-3">
                            <label class="form-label">Featured Image</label>
                            <input type="file" name="image" class="form-control @error('image') is-invalid @enderror" accept="image/*">
                            <small class="form-hint">Upload a new image to replace the current one (max 10MB).</small>
                            @error('image')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-4 d-flex align-items-center">
                        <div class="mb-3 mt-3">
                            <label class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" name="is_active" value="1" {{ old('is_active', $blog->is_active) ? 'checked' : '' }}>
                                <span class="form-check-label">Publish (Active status)</span>
                            </label>
                            <small class="form-hint">Only active blog posts are visible on the frontend.</small>
                        </div>
                    </div>

                    @if($blog->image_url)
                        <div class="col-md-12">
                            <div class="mb-3">
                                <label class="form-label">Current Image Preview</label>
                                <img src="{{ $blog->image_url }}" alt="{{ $blog->title }}" class="img-thumbnail" style="max-height: 200px;">
                            </div>
                        </div>
                    @endif

                    <div class="col-md-12">
                        <div class="mb-3">
                            <label class="form-label required">Content</label>
                            <textarea name="content" rows="12" class="form-control @error('content') is-invalid @enderror" placeholder="Write your blog post content here..." required>{{ old('content', $blog->content) }}</textarea>
                            @error('content')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <!-- SEO Fields -->
                    <div class="col-md-12">
                        <hr class="my-4" />
                        <h3 class="card-title mb-3">SEO Configuration</h3>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label">URL Slug</label>
                            <input type="text" name="slug" class="form-control @error('slug') is-invalid @enderror" value="{{ old('slug', $blog->slug) }}" placeholder="e.g. electric-vs-solar (Auto-generated if left blank)">
                            @error('slug')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label">Meta Title</label>
                            <input type="text" name="meta_title" class="form-control @error('meta_title') is-invalid @enderror" value="{{ old('meta_title', $blog->meta_title) }}" placeholder="Custom Page Title tag">
                            @error('meta_title')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="mb-3">
                            <label class="form-label">Meta Description</label>
                            <textarea name="meta_description" rows="3" class="form-control @error('meta_description') is-invalid @enderror" placeholder="Custom Meta Description tag">{{ old('meta_description', $blog->meta_description) }}</textarea>
                            @error('meta_description')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-footer text-end">
                <a href="{{ route('blogs.index') }}" class="btn btn-link">Cancel</a>
                <button type="submit" class="btn btn-primary">Update Blog Post</button>
            </div>
        </form>
    </div>
</div>
@endsection
