@extends('tablar::page')

@section('title', 'Add Category')

@section('content')
<div class="page-header d-print-none">
    <div class="container-xl">
        <div class="row g-2 align-items-center">
            <div class="col">
                <h2 class="page-title">Add Category</h2>
            </div>
        </div>
    </div>
</div>

<div class="page-body">
    <div class="container-xl">
        <form action="{{ route('categories.store') }}" method="POST" enctype="multipart/form-data" class="card">
            @csrf
            <div class="card-body">
                <div class="row row-cards">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label required">Category Name</label>
                            <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}" required>
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label required">Category Code</label>
                            <input type="text" name="code" class="form-control @error('code') is-invalid @enderror" value="{{ old('code') }}" placeholder="e.g. HWS" required>
                            @error('code')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="mb-3">
                            <label class="form-label">Category Description</label>
                            <textarea name="description" rows="3" class="form-control @error('description') is-invalid @enderror" placeholder="Short summary of this category">{{ old('description') }}</textarea>
                            @error('description')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <!-- Images: Homepage Card Image vs Category Page Banner Image -->
                    <div class="col-md-12">
                        <hr class="my-3" />
                        <h3 class="card-title mb-3">Category Imagery (Independent Dimensions)</h3>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label fw-bold">Homepage Category Card Image</label>
                            <input type="file" name="home_image" class="form-control @error('home_image') is-invalid @enderror" accept="image/*">
                            @error('home_image')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <small class="form-hint">Displayed on the <strong>Homepage showcase card</strong> (Recommended aspect ratio ~4:5 or portrait card, e.g. 600x750px).</small>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label fw-bold">Category Page Top Banner</label>
                            <input type="file" name="banner" class="form-control @error('banner') is-invalid @enderror" accept="image/*">
                            @error('banner')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <small class="form-hint">Displayed as the <strong>Hero header banner</strong> on the Category page (Recommended panorama banner, e.g. 1920x450px).</small>
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
                            <input type="text" name="slug" class="form-control @error('slug') is-invalid @enderror" value="{{ old('slug') }}" placeholder="e.g. water-heaters (Auto-generated if left blank)">
                            @error('slug')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label">Meta Title</label>
                            <input type="text" name="meta_title" class="form-control @error('meta_title') is-invalid @enderror" value="{{ old('meta_title') }}" placeholder="Custom Page Title tag">
                            @error('meta_title')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="mb-3">
                            <label class="form-label">Meta Description</label>
                            <textarea name="meta_description" rows="3" class="form-control @error('meta_description') is-invalid @enderror" placeholder="Custom Meta Description tag">{{ old('meta_description') }}</textarea>
                            @error('meta_description')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-footer text-end">
                <a href="{{ route('categories.index') }}" class="btn btn-link">Cancel</a>
                <button type="submit" class="btn btn-primary">Save Category</button>
            </div>
        </form>
    </div>
</div>
@endsection
