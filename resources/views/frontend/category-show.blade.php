@extends('layouts.master')

@section('title', $category->name . ' - Alabama Portal')

@section('content')

<!-- Header -->
<section class="page-hero" data-aos="fade-up">
    <div class="container">
        <div class="row">
            <div class="col-xl-12">
                <div data-aos="zoom-in-up">
                    <div class="eyebrow">Category — {{ $category->code ?: 'Alabama' }}</div>
                    <h1 class="h-section">{{ $category->name }}</h1>
                    <p class="lede mw-100">{{ $category->description }}</p>
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
                <div class="row g-4">
                    @forelse($subcategories as $idx => $sub)
                        <div class="col-xl-4 col-md-6 col-lg-4 col-sm-6" data-aos="fade-up">
                            <a href="{{ route('frontend.home', ['subcategory_id' => $sub->id]) }}" class="product-card text-decoration-none">
                                <div class="product-img">
                                    <span class="ghost">{{ strtoupper(substr($sub->name, 0, 1)) }}</span>
                                </div>
                                <div class="product-body">
                                    <small>{{ sprintf('%02d', $idx + 1) }} — {{ $category->name }}</small>
                                    <h3>{{ $sub->name }}</h3>
                                    <span class="product-link">
                                        Explore Range <i class="fa-solid fa-arrow-right-long"></i>
                                    </span>
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
                <div class="sec-head split">
                    <div>
                        <div class="eyebrow">Featured in this category</div>
                        <h2 class="h-section">Popular <span class="accent-i">products</span></h2>
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
                <h2 class="h-section text-center text-md-start">Can't find a spec? <span class="accent-i">Ask our team.</span></h2>                
            </div>
            <div class="col-xl-4 col-md-6 col-lg-4 text-lg-end text-center mt-2 mt-lg-0">
                <a class="btn solid" href="https://wa.me/971559138047?text=Hello%20Alabama%2C%20I%20need%20help%20with%20a%20product%20specification." target="_blank" rel="noopener">WhatsApp sales</a>
            </div>
        </div>
    </div>
</section>

@endsection
