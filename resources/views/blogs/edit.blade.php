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
