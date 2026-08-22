@extends('layouts.master')

@section('title', 'Catalog - Alabama Portal')

@section('content')

<!-- Header -->
<section class="page-hero" data-aos="fade-up">
    <div class="container">
        <div class="row">
            <div class="col-xl-12">
                <div data-aos="zoom-in-up">
                    <div class="eyebrow">Our brands</div>
                    <h1 class="h-section">Names you know. <span class="accent-i">Lines we stand behind.</span></h1>
                    <p class="lede mw-100">Exclusive and partner brands across heating, plumbing and sanitaryware — every line selected for performance, durability and efficiency.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- allBrand list -->
<section class="cdcollections cdAllBrand section">
    <div class="container">
        <div class="row">
            <div class="col-xl-12">
                <div class="row g-4">
                    @foreach($brands as $brand)
                    <div class="col-xl-4 col-md-6 col-lg-4 col-sm-6" data-aos="fade-up">
                        <a href="{{ route('frontend.brand.show', $brand->slug) }}" class="product-card text-decoration-none">
                            <div class="product-img">
                                @if($brand->logo_url)
                                    <img src="{{ $brand->logo_url }}" alt="{{ $brand->name }}" class="img-fluid">
                                @else
                                    <span class="cdText">{{ $brand->name }}</span>
                                @endif
                            </div>
                            <div class="product-body">
                                <h3>{{ $brand->name }}</h3>
                                <p class="short-desc">{{ \Illuminate\Support\Str::limit($brand->description ?: 'Partner brand', 120) }}</p>
                                <span class="product-link">
                                    View brand <i class="fa-solid fa-arrow-right-long"></i>
                                </span>
                            </div>
                        </a>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</section>


@endsection
