@extends('tablar::page')

@section('title', 'Edit Brand')

@section('content')
<div class="page-header d-print-none">
    <div class="container-xl">
        <div class="row g-2 align-items-center">
            <div class="col">
                <h2 class="page-title">Edit Brand: {{ $brand->name }}</h2>
            </div>
        </div>
    </div>
</div>

<div class="page-body">
    <div class="container-xl">
        <form action="{{ route('brands.update', $brand->id) }}" method="POST" enctype="multipart/form-data" class="card">
            @csrf
            @method('PUT')
            <div class="card-body">
                <div class="row row-cards">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label required">Brand Name</label>
                            <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name', $brand->name) }}" required>
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label required">Brand Code</label>
                            <input type="text" name="code" class="form-control @error('code') is-invalid @enderror" value="{{ old('code', $brand->code) }}" required>
                            @error('code')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label">Manufacturer / Principal</label>
                            <input type="text" name="manufacturer" class="form-control" value="{{ old('manufacturer', $brand->manufacturer) }}">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label">Country of Origin</label>
                            <input type="text" name="country_of_origin" class="form-control" value="{{ old('country_of_origin', $brand->country_of_origin) }}">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label fw-bold">Brand Logo (for Marquee Strip & Catalogue)</label>
                            @if($brand->logo_url)
                                <div class="mb-2 p-2 bg-light rounded d-inline-block border">
                                    <img src="{{ $brand->logo_url }}" alt="{{ $brand->name }} Logo" style="max-height: 60px; max-width: 140px; object-fit: contain;">
                                </div>
                            @endif
                            <input type="file" name="logo" class="form-control @error('logo') is-invalid @enderror" accept="image/*">
                            @error('logo')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <small class="form-hint">Used in brand strip marquee and product cards (~200x80px).</small>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label fw-bold">Homepage Spotlight Poster (Optional)</label>
                            @if($brand->poster_url)
                                <div class="mb-2 p-2 bg-light rounded d-inline-block border">
                                    <img src="{{ $brand->poster_url }}" alt="{{ $brand->name }} Poster" style="max-height: 60px; max-width: 140px; object-fit: cover;">
                                </div>
                            @endif
                            <input type="file" name="poster" class="form-control @error('poster') is-invalid @enderror" accept="image/*">
                            @error('poster')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <small class="form-hint">Hero poster or lifestyle shot shown when this brand is spotlighted on homepage (~800x600px).</small>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="mb-3">
                            <label class="form-label">Description</label>
                            <textarea name="description" class="form-control" rows="4">{{ old('description', $brand->description) }}</textarea>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="mb-3">
                            <label class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" name="is_active" value="1" {{ old('is_active', $brand->is_active) ? 'checked' : '' }}>
                                <span class="form-check-label fw-bold">Active Status (Visible on Website)</span>
                            </label>
                            <small class="form-hint">Inactive brands will be hidden from the website catalogue, brand strip, and spotlight.</small>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-footer text-end">
                <a href="{{ route('brands.index') }}" class="btn btn-link">Cancel</a>
                <button type="submit" class="btn btn-primary">Update Brand</button>
            </div>
        </form>
    </div>
</div>
@endsection
