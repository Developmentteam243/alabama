@extends('layouts.master')

@section('title', ($product->model_name ?: $product->sku_code) . ' - Alabama Portal')

@section('content')
<div class="container my-5">
    <!-- Breadcrumbs -->
    <nav aria-label="breadcrumb" class="mb-4">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('frontend.home') }}" class="text-decoration-none">Catalog</a></li>
            <li class="breadcrumb-item active" aria-current="page">{{ $product->model_name ?: $product->sku_code }}</li>
        </ol>
    </nav>

    <div class="row g-4">
        <!-- Technical Specs & Info -->
        <div class="col-lg-8">
            <div class="card border-0 shadow-sm rounded-4 p-4 p-md-5 mb-4 bg-white">
                <div class="d-flex align-items-center justify-content-between mb-4 flex-wrap gap-2">
                    <span class="badge-brand">{{ $product->brand->name ?? 'Unknown Brand' }}</span>
                    <span class="text-muted small fw-semibold bg-light px-3 py-1 rounded-pill">SKU Code: {{ $product->sku_code }}</span>
                </div>

                <h1 class="fw-extrabold text-dark mb-2 display-6">
                    {{ $product->model_name ?: 'Model SKU: ' . $product->sku_code }}
                </h1>
                <p class="text-muted mb-4 fs-5">
                    {{ $product->subcategory->category->name ?? '' }} &raquo; {{ $product->subcategory->name ?? '' }}
                </p>

                @if($product->notes)
                    <div class="alert alert-info border-0 rounded-3 mb-4 bg-light text-dark p-3">
                        <h6 class="fw-bold m-0 mb-1 d-flex align-items-center gap-2">
                            <i class="ti ti-info-circle text-primary fs-5"></i> Product Notes
                        </h6>
                        <p class="small m-0 text-muted">{{ $product->notes }}</p>
                    </div>
                @endif

                <h4 class="fw-bold text-dark mb-4 mt-4">Technical Specifications</h4>
                <div class="table-responsive">
                    <table class="table table-hover align-middle border-light-subtle">
                        <tbody>
                            @if($product->item_code)
                            <tr>
                                <th class="text-muted fw-semibold w-50 py-3">Item Code</th>
                                <td class="text-dark fw-medium">{{ $product->item_code }}</td>
                            </tr>
                            @endif
                            @if($product->product_type)
                            <tr>
                                <th class="text-muted fw-semibold py-3">Product Type</th>
                                <td class="text-dark fw-medium">{{ $product->product_type }}</td>
                            </tr>
                            @endif
                            @if($product->product_family)
                            <tr>
                                <th class="text-muted fw-semibold py-3">Product Family</th>
                                <td class="text-dark fw-medium">{{ $product->product_family }}</td>
                            </tr>
                            @endif
                            @if($product->capacity_l)
                            <tr>
                                <th class="text-muted fw-semibold py-3">Capacity</th>
                                <td class="text-dark fw-bold text-primary">{{ $product->capacity_l }} Liters</td>
                            </tr>
                            @endif
                            @if($product->orientation_mounting)
                            <tr>
                                <th class="text-muted fw-semibold py-3">Mounting / Orientation</th>
                                <td class="text-dark fw-medium">{{ $product->orientation_mounting }}</td>
                            </tr>
                            @endif
                            @if($product->heating_power_kw)
                            <tr>
                                <th class="text-muted fw-semibold py-3">Heating Power</th>
                                <td class="text-dark fw-medium">{{ $product->heating_power_kw }} kW</td>
                            </tr>
                            @endif
                            @if($product->voltage)
                            <tr>
                                <th class="text-muted fw-semibold py-3">Voltage</th>
                                <td class="text-dark fw-medium">{{ $product->voltage }}</td>
                            </tr>
                            @endif
                            @if($product->max_working_pressure_bar)
                            <tr>
                                <th class="text-muted fw-semibold py-3">Max Working Pressure</th>
                                <td class="text-dark fw-medium">{{ $product->max_working_pressure_bar }} bar</td>
                            </tr>
                            @endif
                            @if($product->height_length_mm)
                            <tr>
                                <th class="text-muted fw-semibold py-3">Height / Length</th>
                                <td class="text-dark fw-medium">{{ $product->height_length_mm }} mm</td>
                            </tr>
                            @endif
                            @if($product->diameter_width_mm)
                            <tr>
                                <th class="text-muted fw-semibold py-3">Diameter / Width</th>
                                <td class="text-dark fw-medium">{{ $product->diameter_width_mm }} mm</td>
                            </tr>
                            @endif
                            @if($product->tank_protection_lining)
                            <tr>
                                <th class="text-muted fw-semibold py-3">Tank Protection Lining</th>
                                <td class="text-dark fw-medium">{{ $product->tank_protection_lining }}</td>
                            </tr>
                            @endif
                            @if($product->heating_element)
                            <tr>
                                <th class="text-muted fw-semibold py-3">Heating Element Type</th>
                                <td class="text-dark fw-medium">{{ $product->heating_element }}</td>
                            </tr>
                            @endif
                            @if($product->warranty_yrs)
                            <tr>
                                <th class="text-muted fw-semibold py-3">Warranty</th>
                                <td class="text-dark fw-bold text-success">{{ $product->warranty_yrs }} Years</td>
                            </tr>
                            @endif
                            @if($product->mfr_part_code)
                            <tr>
                                <th class="text-muted fw-semibold py-3">Mfr Part Code</th>
                                <td class="text-dark fw-medium">{{ $product->mfr_part_code }}</td>
                            </tr>
                            @endif
                            @if($product->source_catalogue)
                            <tr>
                                <th class="text-muted fw-semibold py-3">Source Catalog Reference</th>
                                <td class="text-dark fw-medium">{{ $product->source_catalogue }}</td>
                            </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Sidebar Actions & Related -->
        <div class="col-lg-4">
            <!-- Product Media Card -->
            @if($product->image_url || $product->brochure_url || $product->techsheet_url)
                <div class="card border-0 shadow-sm rounded-4 p-4 bg-white mb-4 text-center">
                    @if($product->image_url)
                        <div class="mb-3">
                            <img src="{{ $product->image_url }}" alt="{{ $product->model_name ?: $product->sku_code }}" class="img-fluid rounded-3" style="max-height: 300px; object-fit: contain;">
                        </div>
                    @endif
                    
                    <div class="d-flex flex-column gap-2">
                        @if($product->brochure_url)
                            <a href="{{ $product->brochure_url }}" target="_blank" class="btn btn-outline-danger w-100 rounded-3 py-2 fw-bold d-flex align-items-center justify-content-center gap-2">
                                <i class="ti ti-file-text"></i> Brochure &gt;
                            </a>
                        @endif
                        @if($product->techsheet_url)
                            <a href="{{ $product->techsheet_url }}" target="_blank" class="btn btn-dark w-100 rounded-3 py-2 fw-bold d-flex align-items-center justify-content-center gap-2">
                                <i class="ti ti-download"></i> Download Techsheet <i class="ti ti-arrow-bar-to-down"></i>
                            </a>
                        @endif
                    </div>
                </div>
            @endif

            <!-- Inquiry Form Card -->
            <div class="card border-0 shadow-sm rounded-4 p-4 bg-white mb-4">
                <h5 class="fw-bold text-dark mb-3">Product Inquiry</h5>
                <p class="small text-muted mb-4">Interested in this heating system? Send us an inquiry to get current pricing and availability details.</p>
                <form action="#" method="POST" onsubmit="event.preventDefault(); alert('Thank you! Your inquiry was successfully simulated.');">
                    <div class="mb-3">
                        <label class="form-label small fw-semibold">Your Name</label>
                        <input type="text" class="form-control rounded-3" required placeholder="John Doe">
                    </div>
                    <div class="mb-3">
                        <label class="form-label small fw-semibold">Email Address</label>
                        <input type="email" class="form-control rounded-3" required placeholder="john@example.com">
                    </div>
                    <div class="mb-3">
                        <label class="form-label small fw-semibold">Message</label>
                        <textarea class="form-control rounded-3" rows="3" required placeholder="Hi, I would like to get a quote for {{ $product->model_name ?: $product->sku_code }}."></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary w-100 rounded-pill py-2 fw-semibold">Send Inquiry</button>
                </form>
            </div>

            <!-- Related Products -->
            @if($relatedProducts->isNotEmpty())
                <div class="card border-0 shadow-sm rounded-4 p-4 bg-white">
                    <h5 class="fw-bold text-dark mb-3">Related Products</h5>
                    <div class="d-flex flex-column gap-3">
                        @foreach($relatedProducts as $rel)
                            <a href="{{ route('frontend.product.show', $rel->id) }}" class="text-decoration-none d-flex align-items-center gap-3 p-2 rounded-3 hover-bg-light border border-light-subtle">
                                <div class="bg-primary text-white rounded-3 p-2 d-flex align-items-center justify-content-center" style="width: 48px; height: 48px;">
                                    <i class="ti ti-flame fs-4"></i>
                                </div>
                                <div class="flex-grow-1 overflow-hidden">
                                    <h6 class="fw-bold text-dark text-truncate m-0" style="font-size: 0.9rem;">
                                        {{ $rel->model_name ?: $rel->sku_code }}
                                    </h6>
                                    <span class="text-muted small d-block">Brand: {{ $rel->brand->name ?? 'Unknown' }}</span>
                                </div>
                            </a>
                        @endforeach
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
