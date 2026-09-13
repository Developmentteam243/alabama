@extends('layouts.master')

@section('title', $category->meta_title ?: $category->name . ' - Alabama Portal')

@if($category->meta_description)
@section('meta_description', $category->meta_description)
@endif

@section('content')

<!-- Header -->
<section class="page-hero" data-aos="fade-up" style="background: @if($category->banner_url) url('{{ $category->banner_url }}') no-repeat center center / cover @else #f8f9fa @endif; padding: 100px 0; position: relative; min-height: 300px; display: flex; align-items: center;">
    @if($category->banner_url)
        <!-- Overlay to ensure text readability -->
        <div style="position: absolute; top: 0; left: 0; right: 0; bottom: 0; background: rgba(15, 23, 42, 0.55); z-index: 1;"></div>
    @endif
    <div class="container" style="position: relative; z-index: 2; @if($category->banner_url) color: white; @endif">
        <div class="row">
            <div class="col-xl-12">
                <div data-aos="zoom-in-up">
                    <nav aria-label="breadcrumb" class="mb-3">
                        <ol class="breadcrumb m-0" style="background: transparent; padding: 0;">
                            <li class="breadcrumb-item"><a href="{{ route('frontend.home') }}" style="color: @if($category->banner_url) rgba(255, 255, 255, 0.8) @else #dc3545 @endif; text-decoration: none;">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page" style="color: @if($category->banner_url) #ffffff @else #6c757d @endif;">{{ $category->name }}</li>
                        </ol>
                    </nav>
                    <div class="eyebrow" style="@if($category->banner_url) color: rgba(255, 255, 255, 0.8) !important; @endif">Category — {{ $category->code ?: 'Alabama' }}</div>
                    <h1 class="h-section" style="@if($category->banner_url) color: #ffffff !important; @endif">{{ $category->name }}</h1>
                    <p class="lede mw-100" style="@if($category->banner_url) color: rgba(255, 255, 255, 0.9) !important; @endif">{{ $category->description }}</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- sub cat-prod list -->
<section class="cdcollections section">
    <div class="container">
        <div class="row">
            <div class="col-xl-12">
                <div class="sec-head split">
                    <div>
                        <div class="eyebrow">Browse the range</div>
                        <h2 class="h-section">Subcategories</h2>
                    </div>
                </div>
            </div>
            <div class="col-xl-12">
                <div class="row g-3">
                    @forelse($subcategories as $idx => $sub)
                        <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6" data-aos="fade-up">
                            <a href="{{ route('frontend.subcategory.show', [$category->slug, $sub->slug]) }}" class="subcat-card">
                                <div class="subcat-img-wrap">
                                    @if($sub->banner_url)
                                        <img src="{{ $sub->banner_url }}" alt="{{ $sub->name }}" loading="lazy" />
                                    @else
                                        <div class="subcat-placeholder">
                                            {{ strtoupper(substr($sub->name, 0, 1)) }}
                                        </div>
                                    @endif
                                </div>
                                <div class="subcat-body">
                                    <div>
                                        <small>{{ sprintf('%02d', $idx + 1) }} · {{ $category->name }}</small>
                                        <h3>{{ $sub->name }}</h3>
                                    </div>
                                    <div>
                                        <span class="subcat-link">
                                            Explore Range <i class="fa-solid fa-arrow-right-long"></i>
                                        </span>
                                    </div>
                                </div>
                            </a>
                        </div>
                    @empty
                        <div class="col-12 text-center py-4">
                            <p class="text-muted">No subcategories found.</p>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</section>

<!-- popular-prod list -->
<section class="cdcollections section pt-0">
    <div class="container">
        <div class="row">
            <div class="col-xl-12">
                <div class="sec-head split mb-3">
                    <div>
                        <div class="eyebrow">Featured in this category</div>
                        <h2 class="h-section">Popular <span class="accent-i">products</span></h2>
                    </div>
                </div>
            </div>

            <!-- Search & Filters -->
            <div class="col-xl-12 mb-4">
                <form action="{{ request()->url() }}" method="GET" class="row g-3 align-items-end p-4 bg-light border rounded-3">
                    <div class="col-lg-3 col-md-6">
                        <label class="form-label fw-bold small text-secondary">SEARCH KEYWORD</label>
                        <input type="text" name="search" class="form-control" value="{{ request('search') }}" placeholder="e.g. Model, SKU, Code...">
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <label class="form-label fw-bold small text-secondary">BRAND</label>
                        <select name="brand_id" class="form-select">
                            <option value="">All Brands</option>
                            @foreach($brands as $brand)
                                <option value="{{ $brand->id }}" {{ request('brand_id') == $brand->id ? 'selected' : '' }}>{{ $brand->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-lg-2 col-md-6">
                        <label class="form-label fw-bold small text-secondary">CAPACITY (L)</label>
                        <select name="capacity" class="form-select">
                            <option value="">All Capacities</option>
                            @foreach($capacities as $cap)
                                <option value="{{ $cap }}" {{ request('capacity') == $cap ? 'selected' : '' }}>{{ $cap }} L</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-lg-2 col-md-6">
                        <label class="form-label fw-bold small text-secondary">MOUNTING</label>
                        <select name="mounting" class="form-select">
                            <option value="">All Mountings</option>
                            @foreach($mountings as $mount)
                                <option value="{{ $mount }}" {{ request('mounting') == $mount ? 'selected' : '' }}>{{ $mount }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-lg-2 col-md-12 d-flex gap-2">
                        <button type="submit" class="btn btn-danger w-100 fw-bold">Search</button>
                        @if(request()->anyFilled(['search', 'brand_id', 'capacity', 'mounting']))
                            <a href="{{ request()->url() }}" class="btn btn-secondary fw-bold">Reset</a>
                        @endif
                    </div>
                </form>
            </div>

            <div class="col-xl-12">
                <div class="row g-4">
                    @forelse($products as $prod)
                        <div class="col-xl-4 col-md-6 col-lg-4 col-sm-6" data-aos="fade-up">
                            <a href="{{ route('frontend.product.show', $prod->slug) }}" class="product-card text-decoration-none">
                                <div class="product-img">
                                    @if($prod->image_url)
                                        <img src="{{ $prod->image_url }}" alt="{{ $prod->model_name ?: $prod->sku_code }}" class="img-fluid">
                                    @else
                                        <span class="ghost">{{ strtoupper(substr($prod->model_name ?: $prod->sku_code, 0, 1)) }}</span>
                                    @endif
                                </div>
                                <div class="product-body">
                                    <small>{{ $prod->brand->name ?? '' }}</small>
                                    <h3>{{ $prod->model_name ?: $prod->sku_code }}</h3>
                                    <span class="product-link">
                                        View Product <i class="fa-solid fa-arrow-right-long"></i>
                                    </span>
                                </div>
                            </a>
                        </div>
                    @empty
                        <div class="col-xl-12 text-center py-4">
                            <p class="text-muted">No products found in this category.</p>
                        </div>
                    @endforelse
                </div>

                @if($products->hasPages())
                    <div class="d-flex justify-content-center mt-5">
                        {{ $products->appends(request()->query())->links() }}
                    </div>
                @endif
            </div>
        </div>
    </div>
</section>

<!-- CTA -->
<section class="cta-section">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-xl-8 col-md-6 col-lg-8">
                <h2 class="h-section text-center text-md-start">Can't find a spec? <span class="accent-i">Ask our team.</span></h2>                
            </div>
            <div class="col-xl-4 col-md-6 col-lg-4 text-lg-end text-center mt-2 mt-lg-0">
                <a class="btn solid" href="https://wa.me/971559138047?text=Hello%20Alabama%2C%20I%20need%20help%20with%20a%20product%20specification." target="_blank" rel="noopener">WhatsApp sales</a>
            </div>
        </div>
    </div>
</section>

@endsection
