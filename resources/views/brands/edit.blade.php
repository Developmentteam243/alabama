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
                    <div class="col-md-12">
                        <div class="mb-3">
                            <label class="form-label">Logo Image</label>
                            @if($brand->logo_url)
                                <div class="mb-2">
                                    <img src="{{ $brand->logo_url }}" alt="{{ $brand->name }}" style="max-height: 80px; border: 1px solid #ddd; padding: 4px; border-radius: 4px;">
                                </div>
                            @endif
                            <input type="file" name="logo" class="form-control @error('logo') is-invalid @enderror" accept="image/*">
                            @error('logo')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="mb-3">
                            <label class="form-label">Description</label>
                            <textarea name="description" class="form-control" rows="4">{{ old('description', $brand->description) }}</textarea>
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
