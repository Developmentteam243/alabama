@extends('tablar::page')

@section('title', 'Create Product')

@section('content')
<div class="page-header d-print-none">
    <div class="container-xl">
        <div class="row g-2 align-items-center">
            <div class="col">
                <h2 class="page-title">Create Product SKU</h2>
            </div>
        </div>
    </div>
</div>

<div class="page-body">
    <div class="container-xl">
        <form action="{{ route('products.store') }}" method="POST" class="card">
            @csrf
            <div class="card-body">
                <div class="row row-cards">
                    <!-- SKU & Identifiers -->
                    <div class="col-md-4">
                        <div class="mb-3">
                            <label class="form-label required">SKU Code</label>
                            <input type="text" name="sku_code" class="form-control @error('sku_code') is-invalid @enderror" value="{{ old('sku_code') }}" required>
                            @error('sku_code')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="mb-3">
                            <label class="form-label required">Brand</label>
                            <select name="brand_id" class="form-select @error('brand_id') is-invalid @enderror" required>
                                <option value="">Select Brand</option>
                                @foreach($brands as $brand)
                                    <option value="{{ $brand->id }}" {{ old('brand_id') == $brand->id ? 'selected' : '' }}>{{ $brand->name }}</option>
                                @endforeach
                            </select>
                            @error('brand_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="mb-3">
                            <label class="form-label required">Subcategory</label>
                            <select name="subcategory_id" class="form-select @error('subcategory_id') is-invalid @enderror" required>
                                <option value="">Select Subcategory</option>
                                @foreach($subcategories as $subcat)
                                    <option value="{{ $subcat->id }}" {{ old('subcategory_id') == $subcat->id ? 'selected' : '' }}>
                                        {{ $subcat->name }} ({{ $subcat->category->name ?? '' }})
                                    </option>
                                @endforeach
                            </select>
                            @error('subcategory_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <!-- General Info -->
                    <div class="col-md-3">
                        <div class="mb-3">
                            <label class="form-label">Item Code</label>
                            <input type="text" name="item_code" class="form-control" value="{{ old('item_code') }}">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="mb-3">
                            <label class="form-label">Product Type</label>
                            <input type="text" name="product_type" class="form-control" value="{{ old('product_type') }}">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="mb-3">
                            <label class="form-label">Product Family</label>
                            <input type="text" name="product_family" class="form-control" value="{{ old('product_family') }}">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="mb-3">
                            <label class="form-label">Model Name</label>
                            <input type="text" name="model_name" class="form-control" value="{{ old('model_name') }}">
                        </div>
                    </div>

                    <!-- Technical specs -->
                    <div class="col-md-3">
                        <div class="mb-3">
                            <label class="form-label">Capacity (L)</label>
                            <input type="text" name="capacity_l" class="form-control" value="{{ old('capacity_l') }}">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="mb-3">
                            <label class="form-label">Orientation / Mounting</label>
                            <input type="text" name="orientation_mounting" class="form-control" value="{{ old('orientation_mounting') }}">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="mb-3">
                            <label class="form-label">Heating Power (kW)</label>
                            <input type="text" name="heating_power_kw" class="form-control" value="{{ old('heating_power_kw') }}">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="mb-3">
                            <label class="form-label">Voltage</label>
                            <input type="text" name="voltage" class="form-control" value="{{ old('voltage') }}">
                        </div>
                    </div>

                    <!-- Pressure / Dims -->
                    <div class="col-md-4">
                        <div class="mb-3">
                            <label class="form-label">Max Working Pressure (bar)</label>
                            <input type="text" name="max_working_pressure_bar" class="form-control" value="{{ old('max_working_pressure_bar') }}">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="mb-3">
                            <label class="form-label">Height / Length (mm)</label>
                            <input type="text" name="height_length_mm" class="form-control" value="{{ old('height_length_mm') }}">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="mb-3">
                            <label class="form-label">Diameter / Width (mm)</label>
                            <input type="text" name="diameter_width_mm" class="form-control" value="{{ old('diameter_width_mm') }}">
                        </div>
                    </div>

                    <!-- Linings / Protection -->
                    <div class="col-md-4">
                        <div class="mb-3">
                            <label class="form-label">Tank Protection / Lining</label>
                            <input type="text" name="tank_protection_lining" class="form-control" value="{{ old('tank_protection_lining') }}">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="mb-3">
                            <label class="form-label">Heating Element</label>
                            <input type="text" name="heating_element" class="form-control" value="{{ old('heating_element') }}">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="mb-3">
                            <label class="form-label">Warranty (yrs)</label>
                            <input type="text" name="warranty_yrs" class="form-control" value="{{ old('warranty_yrs') }}">
                        </div>
                    </div>

                    <!-- Part & Catalogue -->
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label">Manufacturer Part Code</label>
                            <input type="text" name="mfr_part_code" class="form-control" value="{{ old('mfr_part_code') }}">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label">Source Catalogue</label>
                            <input type="text" name="source_catalogue" class="form-control" value="{{ old('source_catalogue') }}">
                        </div>
                    </div>

                    <!-- Notes -->
                    <div class="col-md-12">
                        <div class="mb-3">
                            <label class="form-label">Notes</label>
                            <textarea name="notes" rows="4" class="form-control">{{ old('notes') }}</textarea>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-footer text-end">
                <a href="{{ route('products.index') }}" class="btn btn-link">Cancel</a>
                <button type="submit" class="btn btn-primary">Save Product</button>
            </div>
        </form>
    </div>
</div>
@endsection
