@extends('tablar::page')

@section('title', 'Add Slide')

@section('content')
<div class="page-header d-print-none">
    <div class="container-xl">
        <div class="row g-2 align-items-center">
            <div class="col">
                <div class="page-pretitle">Homepage Management</div>
                <h2 class="page-title">Add Hero Banner Slide</h2>
            </div>
            <div class="col-12 col-md-auto ms-auto d-print-none">
                <a href="{{ route('sliders.index') }}" class="btn btn-secondary">
                    &larr; Back to Sliders
                </a>
            </div>
        </div>
    </div>
</div>

<div class="page-body">
    <div class="container-xl">
        <form action="{{ route('sliders.store') }}" method="POST" enctype="multipart/form-data" class="card">
            @csrf
            <div class="card-body">
                <div class="row row-cards">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label">Slide Title</label>
                            <input type="text" name="title" class="form-control @error('title') is-invalid @enderror" value="{{ old('title') }}" placeholder="e.g. Plumbing & Valves">
                            @error('title')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <small class="form-hint">Heading text overlaid on the bottom of the slide card.</small>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label">Slide Subtitle / Badge</label>
                            <input type="text" name="subtitle" class="form-control @error('subtitle') is-invalid @enderror" value="{{ old('subtitle', 'Alabama Range') }}" placeholder="e.g. Alabama Range">
                            @error('subtitle')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <small class="form-hint">Small badge shown above the slide title.</small>
                        </div>
                    </div>

                    <!-- Media Section -->
                    <div class="col-md-12">
                        <hr class="my-2" />
                        <h4 class="card-title mb-3">Slide Media (Required)</h4>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label fw-bold">Upload Slide Image</label>
                            <input type="file" name="image" class="form-control @error('image') is-invalid @enderror" accept="image/*">
                            @error('image')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <small class="form-hint">Upload high-res JPG, PNG, or WEBP (Recommended: ~1200x800px or landscape).</small>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label fw-bold">OR Direct Image URL</label>
                            <input type="text" name="image_url" class="form-control @error('image_url') is-invalid @enderror" value="{{ old('image_url') }}" placeholder="https://...">
                            @error('image_url')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <small class="form-hint">Direct CDN/Cloudinary URL if not uploading a new file.</small>
                        </div>
                    </div>

                    <!-- Button Action & Link -->
                    <div class="col-md-12">
                        <hr class="my-2" />
                        <h4 class="card-title mb-3">Call to Action (Button)</h4>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label">Button Label</label>
                            <input type="text" name="button_text" class="form-control @error('button_text') is-invalid @enderror" value="{{ old('button_text', 'Explore Range') }}" placeholder="e.g. Explore Range">
                            @error('button_text')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label">Button Link URL</label>
                            <input type="text" name="button_url" class="form-control @error('button_url') is-invalid @enderror" value="{{ old('button_url') }}" placeholder="e.g. /category/plumbing or /products">
                            @error('button_url')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <!-- Display Control -->
                    <div class="col-md-12">
                        <hr class="my-2" />
                        <h4 class="card-title mb-3">Ordering & Visibility</h4>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label">Sort Order</label>
                            <input type="number" name="sort_order" class="form-control @error('sort_order') is-invalid @enderror" value="{{ old('sort_order', 0) }}" min="0">
                            @error('sort_order')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <small class="form-hint">Lower numbers display first (0, 1, 2...).</small>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label">Active Status</label>
                            <div class="mt-2">
                                <label class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" name="is_active" value="1" {{ old('is_active', true) ? 'checked' : '' }}>
                                    <span class="form-check-label">Display this slide on homepage</span>
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-footer text-end">
                <a href="{{ route('sliders.index') }}" class="btn btn-link link-secondary me-auto">Cancel</a>
                <button type="submit" class="btn btn-primary">Save Slide</button>
            </div>
        </form>
    </div>
</div>
@endsection
