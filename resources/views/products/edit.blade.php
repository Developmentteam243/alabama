@extends('tablar::page')

@section('title', 'Edit Product')

@section('content')
<div class="page-header d-print-none">
    <div class="container-xl">
        <div class="row g-2 align-items-center">
            <div class="col">
                <h2 class="page-title">Edit Product SKU: {{ $product->sku_code }}</h2>
            </div>
        </div>
    </div>
</div>

<div class="page-body">
    <div class="container-xl">
        <form action="{{ route('products.update', $product->id) }}" method="POST" enctype="multipart/form-data" class="card">
            @csrf
            @method('PUT')
            <div class="card-body">
                <div class="row row-cards">
                    <!-- SKU & Identifiers -->
                    <div class="col-md-4">
                        <div class="mb-3">
                            <label class="form-label required">SKU Code</label>
                            <input type="text" name="sku_code" class="form-control @error('sku_code') is-invalid @enderror" value="{{ old('sku_code', $product->sku_code) }}" required>
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
                                    <option value="{{ $brand->id }}" {{ old('brand_id', $product->brand_id) == $brand->id ? 'selected' : '' }}>{{ $brand->name }}</option>
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
                                    <option value="{{ $cat->id }}" {{ old('category_id', $product->subcategory->category_id ?? '') == $cat->id ? 'selected' : '' }}>{{ $cat->name }}</option>
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
                            <input type="text" name="item_code" class="form-control" value="{{ old('item_code', $product->item_code) }}">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="mb-3">
                            <label class="form-label">Product Type</label>
                            <input type="text" name="product_type" class="form-control" value="{{ old('product_type', $product->product_type) }}">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="mb-3">
                            <label class="form-label">Product Family</label>
                            <input type="text" name="product_family" class="form-control" value="{{ old('product_family', $product->product_family) }}">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="mb-3">
                            <label class="form-label">Model Name</label>
                            <input type="text" name="model_name" class="form-control" value="{{ old('model_name', $product->model_name) }}">
                        </div>
                    </div>

                    <!-- Technical specs -->
                    <div class="col-md-3">
                        <div class="mb-3">
                            <label class="form-label">Capacity (L)</label>
                            <input type="text" name="capacity_l" class="form-control" value="{{ old('capacity_l', $product->capacity_l) }}">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="mb-3">
                            <label class="form-label">Orientation / Mounting</label>
                            <input type="text" name="orientation_mounting" class="form-control" value="{{ old('orientation_mounting', $product->orientation_mounting) }}">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="mb-3">
                            <label class="form-label">Heating Power (kW)</label>
                            <input type="text" name="heating_power_kw" class="form-control" value="{{ old('heating_power_kw', $product->heating_power_kw) }}">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="mb-3">
                            <label class="form-label">Voltage</label>
                            <input type="text" name="voltage" class="form-control" value="{{ old('voltage', $product->voltage) }}">
                        </div>
                    </div>

                    <!-- Pressure / Dims -->
                    <div class="col-md-4">
                        <div class="mb-3">
                            <label class="form-label">Max Working Pressure (bar)</label>
                            <input type="text" name="max_working_pressure_bar" class="form-control" value="{{ old('max_working_pressure_bar', $product->max_working_pressure_bar) }}">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="mb-3">
                            <label class="form-label">Height / Length (mm)</label>
                            <input type="text" name="height_length_mm" class="form-control" value="{{ old('height_length_mm', $product->height_length_mm) }}">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="mb-3">
                            <label class="form-label">Diameter / Width (mm)</label>
                            <input type="text" name="diameter_width_mm" class="form-control" value="{{ old('diameter_width_mm', $product->diameter_width_mm) }}">
                        </div>
                    </div>

                    <!-- Linings / Protection -->
                    <div class="col-md-4">
                        <div class="mb-3">
                            <label class="form-label">Tank Protection / Lining</label>
                            <input type="text" name="tank_protection_lining" class="form-control" value="{{ old('tank_protection_lining', $product->tank_protection_lining) }}">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="mb-3">
                            <label class="form-label">Heating Element</label>
                            <input type="text" name="heating_element" class="form-control" value="{{ old('heating_element', $product->heating_element) }}">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="mb-3">
                            <label class="form-label">Warranty (yrs)</label>
                            <input type="text" name="warranty_yrs" class="form-control" value="{{ old('warranty_yrs', $product->warranty_yrs) }}">
                        </div>
                    </div>

                    <!-- Part & Catalogue -->
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label">Manufacturer Part Code</label>
                            <input type="text" name="mfr_part_code" class="form-control" value="{{ old('mfr_part_code', $product->mfr_part_code) }}">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label">Source Catalogue</label>
                            <input type="text" name="source_catalogue" class="form-control" value="{{ old('source_catalogue', $product->source_catalogue) }}">
                        </div>
                    </div>

                    <!-- Notes -->
                    <div class="col-md-12">
                        <div class="mb-3">
                            <label class="form-label">Notes</label>
                            <textarea name="notes" rows="4" class="form-control">{{ old('notes', $product->notes) }}</textarea>
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
                            @if($product->image_url)
                                <div class="mt-2">
                                    <a href="{{ $product->image_url }}" target="_blank" class="text-decoration-none">
                                        <img src="{{ $product->image_url }}" alt="Product Image" class="img-thumbnail" style="max-height: 80px;">
                                    </a>
                                </div>
                            @endif
                            <span class="text-muted small">Upload new to replace existing image in Cloudinary.</span>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="mb-3">
                            <label class="form-label">Brochure File</label>
                            <input type="file" name="brochure" class="form-control @error('brochure') is-invalid @enderror" accept=".pdf,.doc,.docx">
                            @error('brochure')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            @if($product->brochure_url)
                                <div class="mt-2">
                                    <a href="{{ $product->brochure_url }}" target="_blank" class="btn btn-sm btn-outline-info">View Existing Brochure</a>
                                </div>
                            @endif
                            <span class="text-muted small">Upload new to replace existing brochure in Cloudinary.</span>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="mb-3">
                            <label class="form-label">Factsheet / Technical Datasheet</label>
                            <input type="file" name="techsheet" class="form-control @error('techsheet') is-invalid @enderror" accept=".pdf,.doc,.docx">
                            @error('techsheet')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            @if($product->techsheet_url)
                                <div class="mt-2">
                                    <a href="{{ $product->techsheet_url }}" target="_blank" class="btn btn-sm btn-outline-info">View Existing Factsheet</a>
                                </div>
                            @endif
                            <span class="text-muted small">Upload new to replace existing factsheet in Cloudinary.</span>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label">Video Link</label>
                            <input type="text" name="video_url" class="form-control @error('video_url') is-invalid @enderror" value="{{ old('video_url', $product->video_url) }}" placeholder="e.g. https://www.youtube.com/watch?v=... or Vimeo URL">
                            @error('video_url')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <span class="text-muted small">Optional link to a YouTube, Vimeo, or direct MP4 video.</span>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label">Upload Additional Pictures</label>
                            <input type="file" name="product_images[]" class="form-control @error('product_images') is-invalid @enderror" accept="image/*" multiple>
                            @error('product_images')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <span class="text-muted small">Select multiple pictures to add to the product gallery.</span>
                        </div>
                    </div>

                    <!-- Manage Multiple Images -->
                    <div class="col-md-12">
                        <div class="mb-3">
                            <label class="form-label">Product Gallery Pictures (Arrange and Manage)</label>
                            @if($product->images->count() > 0)
                                <div class="row g-3" id="gallery-container">
                                    @foreach($product->images as $img)
                                        <div class="col-6 col-sm-4 col-md-3 col-lg-2 gallery-item" data-id="{{ $img->id }}" style="transition: all 0.3s ease;">
                                            <div class="card p-2 border position-relative h-100 bg-light text-center">
                                                <div class="d-flex align-items-center justify-content-center" style="height: 100px;">
                                                    <img src="{{ $img->image_url }}" alt="Gallery Image" class="img-fluid rounded" style="max-height: 100%; object-fit: contain;">
                                                </div>
                                                <input type="hidden" name="sort_orders[{{ $img->id }}]" class="sort-order-input" value="{{ $img->sort_order }}">
                                                <div class="form-check mt-2 d-flex justify-content-center">
                                                    <label class="form-check-label text-danger small">
                                                        <input type="checkbox" name="delete_images[]" value="{{ $img->id }}" class="form-check-input">
                                                        Delete
                                                    </label>
                                                </div>
                                                <div class="btn-group mt-2">
                                                    <button type="button" class="btn btn-sm btn-outline-secondary move-prev" title="Move Left"><i class="fa fa-arrow-left"></i></button>
                                                    <button type="button" class="btn btn-sm btn-outline-secondary move-next" title="Move Right"><i class="fa fa-arrow-right"></i></button>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            @else
                                <p class="text-muted small">No gallery pictures uploaded yet. Use the field above to upload pictures.</p>
                            @endif
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
                            <input type="text" name="slug" class="form-control @error('slug') is-invalid @enderror" value="{{ old('slug', $product->slug) }}" placeholder="e.g. electric-water-heater-100l (Auto-generated if left blank)">
                            @error('slug')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label">Meta Title</label>
                            <input type="text" name="meta_title" class="form-control @error('meta_title') is-invalid @enderror" value="{{ old('meta_title', $product->meta_title) }}" placeholder="Custom Page Title tag">
                            @error('meta_title')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="mb-3">
                            <label class="form-label">Meta Description</label>
                            <textarea name="meta_description" rows="3" class="form-control @error('meta_description') is-invalid @enderror" placeholder="Custom Meta Description tag">{{ old('meta_description', $product->meta_description) }}</textarea>
                            @error('meta_description')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-footer text-end">
                <a href="{{ route('products.index') }}" class="btn btn-link">Cancel</a>
                <button type="submit" class="btn btn-primary">Update Product</button>
            </div>
        </form>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const container = document.getElementById('gallery-container');
    if (!container) return;

    function updateSortOrders() {
        const items = container.querySelectorAll('.gallery-item');
        items.forEach((item, index) => {
            const input = item.querySelector('.sort-order-input');
            if (input) input.value = index;
        });
    }

    container.addEventListener('click', function (e) {
        const btnPrev = e.target.closest('.move-prev');
        const btnNext = e.target.closest('.move-next');
        
        if (btnPrev) {
            const item = btnPrev.closest('.gallery-item');
            const prev = item.previousElementSibling;
            if (prev) {
                container.insertBefore(item, prev);
                updateSortOrders();
            }
        }
        
        if (btnNext) {
            const item = btnNext.closest('.gallery-item');
            const next = item.nextElementSibling;
            if (next) {
                container.insertBefore(next, item);
                updateSortOrders();
            }
        }
    });

    // Category -> Subcategory dynamic filtration
    const categories = @json($categories);
    const categorySelect = document.getElementById('category_id_select');
    const subcategorySelect = document.getElementById('subcategory_id_select');
    const activeSubcategoryId = "{{ old('subcategory_id', $product->subcategory_id ?? '') }}";

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

        // Initialize active selections
        if (categorySelect.value) {
            updateSubcategories(categorySelect.value, activeSubcategoryId);
        }
    }
});
</script>
@endsection
