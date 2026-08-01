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
        <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data" class="card">
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
                            <label class="form-label required">Category</label>
                            <select id="category_id_select" class="form-select" required>
                                <option value="">Select Category</option>
                                @foreach($categories as $cat)
                                    <option value="{{ $cat->id }}" {{ old('category_id') == $cat->id ? 'selected' : '' }}>{{ $cat->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="mb-3">
                            <label class="form-label required">Subcategory</label>
                            <select name="subcategory_id" id="subcategory_id_select" class="form-select @error('subcategory_id') is-invalid @enderror" required disabled>
                                <option value="">Select Subcategory</option>
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

                    <!-- Media Uploads (Cloudinary) -->
                    <div class="col-md-4">
                        <div class="mb-3">
                            <label class="form-label">Product Image</label>
                            <input type="file" name="image" class="form-control @error('image') is-invalid @enderror" accept="image/*">
                            @error('image')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <span class="text-muted small">Upload to Cloudinary (image file).</span>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="mb-3">
                            <label class="form-label">Brochure File</label>
                            <input type="file" name="brochure" class="form-control @error('brochure') is-invalid @enderror" accept=".pdf,.doc,.docx">
                            @error('brochure')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <span class="text-muted small">Upload to Cloudinary (PDF, DOC).</span>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="mb-3">
                            <label class="form-label">Factsheet / Technical Datasheet</label>
                            <input type="file" name="techsheet" class="form-control @error('techsheet') is-invalid @enderror" accept=".pdf,.doc,.docx">
                            @error('techsheet')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <span class="text-muted small">Upload to Cloudinary (PDF, DOC).</span>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label">Video Link</label>
                            <input type="text" name="video_url" class="form-control @error('video_url') is-invalid @enderror" value="{{ old('video_url') }}" placeholder="e.g. https://www.youtube.com/watch?v=... or Vimeo URL">
                            @error('video_url')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <span class="text-muted small">Optional link to a YouTube, Vimeo, or direct MP4 video.</span>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label">Additional Product Pictures</label>
                            <input type="file" name="product_images[]" class="form-control @error('product_images') is-invalid @enderror" accept="image/*" multiple>
                            @error('product_images')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <span class="text-muted small">Select multiple pictures to display in the product gallery.</span>
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
                            <input type="text" name="slug" class="form-control @error('slug') is-invalid @enderror" value="{{ old('slug') }}" placeholder="e.g. electric-water-heater-100l (Auto-generated if left blank)">
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
                <a href="{{ route('products.index') }}" class="btn btn-link">Cancel</a>
                <button type="submit" class="btn btn-primary">Save Product</button>
            </div>
        </form>
    </div>
</div>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const categories = @json($categories);
        const categorySelect = document.getElementById('category_id_select');
        const subcategorySelect = document.getElementById('subcategory_id_select');
        const oldSubcategoryId = "{{ old('subcategory_id') }}";

        if (categorySelect && subcategorySelect) {
            function updateSubcategories(categoryId, selectedSubId = null) {
                subcategorySelect.innerHTML = '<option value="">Select Subcategory</option>';
                
                if (!categoryId) {
                    subcategorySelect.disabled = true;
                    return;
                }

                const selectedCategory = categories.find(cat => cat.id == categoryId);
                if (selectedCategory && selectedCategory.subcategories.length > 0) {
                    selectedCategory.subcategories.forEach(sub => {
                        const option = document.createElement('option');
                        option.value = sub.id;
                        option.textContent = sub.name;
                        if (selectedSubId && sub.id == selectedSubId) {
                            option.selected = true;
                        }
                        subcategorySelect.appendChild(option);
                    });
                    subcategorySelect.disabled = false;
                } else {
                    subcategorySelect.disabled = true;
                }
            }

            categorySelect.addEventListener('change', function () {
                updateSubcategories(this.value);
            });

            // Handle old input (validation redirect fallback)
            if (categorySelect.value) {
                updateSubcategories(categorySelect.value, oldSubcategoryId);
            }
        }
    });
</script>
@endsection
