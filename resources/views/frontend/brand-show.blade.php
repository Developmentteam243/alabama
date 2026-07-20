@extends('layouts.master')

@section('title', $brand->name . ' - Alabama Portal')

@section('content')

<!-- Header -->
<section class="page-hero cdBrandHeader" data-aos="fade-up">
    <div class="container">
        <div class="row">
            <div class="col-xl-12">
                <div data-aos="zoom-in-up">
                    <div class="eyebrow">Brand · {{ $brand->name }} · {{ $brand->country_of_origin ?: 'Imported' }}</div>
                    @if($brand->logo_url)
                        <div class="cdBrandImg my-3">
                            <img src="{{ $brand->logo_url }}" alt="{{ $brand->name }}" class="img-fluid cdBrandImg" style="max-height: 80px;"/>
                        </div>
                    @endif
                    <h1 class="h-section">{{ $brand->name }}</h1>
                    <p class="lede mw-100">{{ $brand->description ?: 'Premium products from ' . $brand->name . ' supplied across the UAE.' }}</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- brand cat-range list -->
<section class="cdBrandRange section">
    <div class="container">
        <div class="row">
            <div class="col-xl-12">
                <div class="sec-head split">
                    <div>
                        <div class="eyebrow">Where you'll find it</div>
                        <h2 class="h-section">Categories &amp; <span class="accent-i">ranges</span></h2>
                    </div>
                </div>
            </div>
            <div class="col-xl-12">
                <div class="row g-4">
                    @forelse($categories as $cat)
                        <div class="col-xl-6 col-md-6 col-lg-6">
                            <div class="category-card">
                                <div class="category-label">Category</div>
                                <h2 class="category-title">{{ $cat->name }}</h2>
                                <div class="chips mb-3">
                                    @foreach($cat->subcategories as $sub)
                                        <span class="chip">{{ $sub->name }} · {{ $sub->products_count }} SKUs</span>
                                    @endforeach
                                </div>
                                <a class="link-arrow" href="{{ route('frontend.category.show', $cat->slug) }}">Browse {{ $cat->name }} <i class="fa-solid fa-arrow-right-long"></i></a>
                            </div>
                        </div>
                    @empty
                        <div class="col-12 text-muted">No associated categories found for this brand.</div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</section>

<!-- detaile-prod list -->
<section class="cdcollections cdBrandDetaile section pt-0">
    <div class="container">
        <div class="row">
            <div class="col-xl-12">
                <div class="sec-head split">
                    <div>
                        <div class="eyebrow">In the catalogue</div>
                        <h2 class="h-section">Detailed <span class="accent-i">products</span></h2>
                    </div>
                </div>
            </div>
            <div class="col-xl-12">
                <div class="row g-4">
                    @forelse($products as $prod)
                        <div class="col-xl-4 col-md-6 col-lg-4 col-sm-6">
                            <a href="{{ route('frontend.product.show', $prod->slug) }}" class="product-card text-decoration-none">
                                <div class="product-img">
                                    @if($prod->image_url)
                                        <img src="{{ $prod->image_url }}" alt="{{ $prod->model_name ?: $prod->sku_code }}" class="img-fluid">
                                    @else
                                        <span class="ghost">{{ strtoupper(substr($prod->model_name ?: $prod->sku_code, 0, 1)) }}</span>
                                    @endif
                                </div>
                                <div class="product-body">
                                    <small>{{ $brand->name }}</small>
                                    <h3>{{ $prod->model_name ?: $prod->sku_code }}</h3>
                                    <span class="product-link">
                                        View Product <i class="fa-solid fa-arrow-right-long"></i>
                                    </span>
                                </div>
                            </a>
                        </div>
                    @empty
                        <div class="col-xl-12 text-center py-4">
                            <p class="text-muted">No products found for this brand.</p>
                        </div>
                    @endforelse
                </div>

                @if($products->hasPages())
                    <div class="d-flex justify-content-center mt-5">
                        {{ $products->links() }}
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
                <h2 class="h-section text-center text-md-start">Looking for {{ $brand->name }} products? <span class="accent-i">Get a custom quote.</span></h2>                
            </div>
            <div class="col-xl-4 col-md-6 col-lg-4 text-lg-end text-center mt-2 mt-lg-0">
                <a class="btn solid" href="https://wa.me/971559138047?text=Hello%20Alabama%2C%20I%20need%20a%20quote%20for%20{{ urlencode($brand->name) }}%20products." target="_blank" rel="noopener">WhatsApp sales</a>
            </div>
        </div>
    </div>
</section>

@endsection
