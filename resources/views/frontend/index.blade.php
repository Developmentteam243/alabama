@extends('layouts.master')

@section('title', 'Catalog - Alabama Portal')

@section('content')
{{-- top bar --}}
<div class="mock-note">Design concept — Alabama Building Materials Trading L.L.C · prepared for review · not the live site</div>
<div class="topbar">
    <div class="wrap">
        <div class="tb-left">
            <a href="mailto:sales@alabamauae.com"><i class="fa-solid fa-envelope"></i> sales@alabamauae.com</a>
            <a href="tel:+97143526973"><span class="hide-m"><i class="fa-solid fa-phone"></i> +971 4 352 6973</span></a>
        </div>
        <div class="tb-right">
            <a href="https://alabamauae.com/wp-content/uploads/2026/01/Alabama-Brochure.pdf" target="_blank" rel="noopener">Download brochure ↓</a>
        </div>
    </div>
</div>
<!-- Hero Header -->
<div class="hero-section text-center text-md-start">
    <div class="container">
        <div class="row align-items-center g-5">
            <div class="col-lg-7">
                <span class="badge bg-primary-light text-primary px-3 py-2 rounded-pill fw-semibold mb-3">Premium Heating Systems</span>
                <h1 class="display-4 fw-extrabold text-white mb-3" style="line-height: 1.15;">
                    Find the Perfect Heating Solution
                </h1>
                <p class="lead text-white-50 mb-4">
                    Search and filter through our comprehensive catalog of geysers, water heaters, and thermal storage solutions tailored to your technical needs.
                </p>
                
                <!-- Quick Search Bar -->
                <form action="{{ route('frontend.home') }}" method="GET" class="p-2 bg-white rounded-3 shadow-lg d-flex flex-column flex-sm-row gap-2">
                    <div class="flex-grow-1 position-relative d-flex align-items-center px-3">
                        <i class="ti ti-search text-muted fs-4 me-2"></i>
                        <input type="text" name="search" class="form-control border-0 bg-transparent shadow-none" placeholder="Search by Model Name, SKU, SKU Code or Family..." value="{{ request('search') }}">
                    </div>
                    <!-- Keep existing filters in quick search -->
                    @if(request('brand_id')) <input type="hidden" name="brand_id" value="{{ request('brand_id') }}"> @endif
                    @if(request('subcategory_id')) <input type="hidden" name="subcategory_id" value="{{ request('subcategory_id') }}"> @endif
                    @if(request('capacity')) <input type="hidden" name="capacity" value="{{ request('capacity') }}"> @endif
                    @if(request('mounting')) <input type="hidden" name="mounting" value="{{ request('mounting') }}"> @endif
                    <button type="submit" class="btn btn-primary px-4 py-2 rounded-2 fw-semibold">Search</button>
                </form>
            </div>
            <div class="col-lg-5 text-center d-none d-lg-block">
                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-flame" width="200" height="200" viewBox="0 0 24 24" stroke-width="0.5" stroke="rgba(255,255,255,0.15)" fill="rgba(255,255,255,0.05)" stroke-linecap="round" stroke-linejoin="round">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                    <path d="M12 12c2 -2.96 0 -7 -1 -8c0 3.038 -1.773 4.741 -3 6c-1.226 1.26 -2 3.24 -2 5a6 6 0 1 0 12 0c0 -1.532 -1.056 -3.94 -2 -5c-1.378 1.54 -3 2.27 -4 2z" />
                </svg>
            </div>
        </div>
    </div>
</div>

<!-- Main Catalog Area -->
<div class="container my-5">
    <div class="row g-4">
        <!-- Sidebar Filters -->
        <div class="col-lg-3">
            <div class="filter-sidebar sticky-top" style="top: 100px;">
                <div class="d-flex align-items-center justify-content-between mb-4">
                    <h5 class="fw-bold m-0 d-flex align-items-center gap-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-adjustments-horizontal text-primary" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                           <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                           <path d="M14 6m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0" />
                           <path d="M4 6l8 0" />
                           <path d="M16 6l4 0" />
                           <path d="M8 12m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0" />
                           <path d="M4 12l2 0" />
                           <path d="M10 12l10 0" />
                           <path d="M17 18m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0" />
                           <path d="M4 18l11 0" />
                           <path d="M19 18l1 0" />
                        </svg>
                        Filters
                    </h5>
                    @if(request()->anyFilled(['search', 'brand_id', 'subcategory_id', 'capacity', 'mounting']))
                        <a href="{{ route('frontend.home') }}" class="btn btn-sm btn-link text-decoration-none p-0 text-danger fw-semibold">Clear All</a>
                    @endif
                </div>

                <form action="{{ route('frontend.home') }}" method="GET" class="d-flex flex-column gap-3">
                    @if(request('search'))
                        <input type="hidden" name="search" value="{{ request('search') }}">
                    @endif

                    <!-- Brand Filter -->
                    <div>
                        <label class="form-label small fw-bold text-uppercase text-muted">Brand</label>
                        <select name="brand_id" class="form-select rounded-3" onchange="this.form.submit()">
                            <option value="">All Brands</option>
                            @foreach($brands as $brand)
                                <option value="{{ $brand->id }}" {{ request('brand_id') == $brand->id ? 'selected' : '' }}>{{ $brand->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Category / Subcategory Filter -->
                    <div>
                        <label class="form-label small fw-bold text-uppercase text-muted">Category Type</label>
                        <select name="subcategory_id" class="form-select rounded-3" onchange="this.form.submit()">
                            <option value="">All Categories</option>
                            @foreach($subcategories as $sub)
                                <option value="{{ $sub->id }}" {{ request('subcategory_id') == $sub->id ? 'selected' : '' }}>
                                    {{ $sub->category->name }} &raquo; {{ $sub->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Capacity Filter -->
                    <div>
                        <label class="form-label small fw-bold text-uppercase text-muted">Capacity (Liters)</label>
                        <select name="capacity" class="form-select rounded-3" onchange="this.form.submit()">
                            <option value="">All Capacities</option>
                            @foreach($capacities as $cap)
                                <option value="{{ $cap }}" {{ request('capacity') == $cap ? 'selected' : '' }}>{{ $cap }} L</option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Mounting Filter -->
                    <div>
                        <label class="form-label small fw-bold text-uppercase text-muted">Mounting / Orientation</label>
                        <select name="mounting" class="form-select rounded-3" onchange="this.form.submit()">
                            <option value="">All Mountings</option>
                            @foreach($mountings as $mount)
                                <option value="{{ $mount }}" {{ request('mounting') == $mount ? 'selected' : '' }}>{{ $mount }}</option>
                            @endforeach
                        </select>
                    </div>
                </form>
            </div>
        </div>

        <!-- Products Listing -->
        <div class="col-lg-9">
            <div class="d-flex align-items-center justify-content-between mb-4">
                <p class="text-muted m-0">Showing <strong>{{ $products->firstItem() ?? 0 }}</strong> to <strong>{{ $products->lastItem() ?? 0 }}</strong> of <strong>{{ $products->total() }}</strong> products</p>
            </div>

            @if($products->isEmpty())
                <div class="card border-0 shadow-sm rounded-4 p-5 text-center">
                    <div class="py-4">
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-database-search text-muted mb-3" width="64" height="64" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                           <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                           <path d="M4 6c0 1.657 3.582 3 8 3s8 -1.343 8 -3s-3.582 -3 -8 -3s-8 1.343 -8 3" />
                           <path d="M4 6v6c0 1.657 3.582 3 8 3m8 -3.5v-5.5" />
                           <path d="M4 12v6c0 1.657 3.582 3 8 3" />
                           <path d="M18 18m-3 0a3 3 0 1 0 6 0a3 3 0 1 0 -6 0" />
                           <path d="M20.2 20.2l1.8 1.8" />
                        </svg>
                        <h4 class="fw-bold text-dark">No Products Found</h4>
                        <p class="text-muted">Try clearing some filters or searching for different keywords.</p>
                        <a href="{{ route('frontend.home') }}" class="btn btn-primary rounded-pill px-4 mt-2">Reset All Filters</a>
                    </div>
                </div>
            @else
                <div class="row g-4">
                    @foreach($products as $product)
                        <div class="col-md-6 col-xl-4">
                            <div class="card h-100 card-product shadow-sm d-flex flex-column">
                                <div class="card-body p-4 d-flex flex-column flex-grow-1">
                                    <div class="d-flex align-items-center justify-content-between mb-3">
                                        <span class="badge-brand">{{ $product->brand->name ?? 'Unknown Brand' }}</span>
                                        <span class="text-muted small fw-semibold">SKU: {{ $product->sku_code }}</span>
                                    </div>
                                    <h5 class="card-title fw-bold text-dark mb-2">
                                        {{ $product->model_name ?: 'Model: ' . $product->sku_code }}
                                    </h5>
                                    <p class="text-muted small mb-3">
                                        {{ $product->subcategory->category->name ?? '' }} &raquo; {{ $product->subcategory->name ?? '' }}
                                    </p>
                                    
                                    <hr class="my-3 border-light-subtle">
                                    
                                    <!-- Key Specs Snippet -->
                                    <div class="row g-2 mb-4">
                                        @if($product->capacity_l)
                                            <div class="col-6">
                                                <div class="bg-light p-2 rounded-3 text-center">
                                                    <span class="d-block text-muted style-small" style="font-size: 0.7rem; text-transform: uppercase;">Capacity</span>
                                                    <span class="fw-bold text-dark" style="font-size: 0.9rem;">{{ $product->capacity_l }} L</span>
                                                </div>
                                            </div>
                                        @endif
                                        @if($product->orientation_mounting)
                                            <div class="col-6">
                                                <div class="bg-light p-2 rounded-3 text-center">
                                                    <span class="d-block text-muted" style="font-size: 0.7rem; text-transform: uppercase;">Mounting</span>
                                                    <span class="fw-bold text-dark text-truncate d-block" style="font-size: 0.9rem;" title="{{ $product->orientation_mounting }}">{{ $product->orientation_mounting }}</span>
                                                </div>
                                            </div>
                                        @endif
                                        @if($product->heating_power_kw)
                                            <div class="col-6">
                                                <div class="bg-light p-2 rounded-3 text-center">
                                                    <span class="d-block text-muted" style="font-size: 0.7rem; text-transform: uppercase;">Power</span>
                                                    <span class="fw-bold text-dark" style="font-size: 0.9rem;">{{ $product->heating_power_kw }} kW</span>
                                                </div>
                                            </div>
                                        @endif
                                        @if($product->voltage)
                                            <div class="col-6">
                                                <div class="bg-light p-2 rounded-3 text-center">
                                                    <span class="d-block text-muted" style="font-size: 0.7rem; text-transform: uppercase;">Voltage</span>
                                                    <span class="fw-bold text-dark" style="font-size: 0.9rem;">{{ $product->voltage }}</span>
                                                </div>
                                            </div>
                                        @endif
                                    </div>
                                    
                                    <div class="mt-auto pt-2">
                                        <a href="{{ route('frontend.product.show', $product->id) }}" class="btn btn-outline-primary w-100 rounded-pill fw-semibold py-2">
                                            View Specifications
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <!-- Pagination -->
                <div class="d-flex justify-content-center mt-5">
                    {{ $products->links() }}
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
