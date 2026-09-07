@extends('layouts.master')

@section('title', 'Catalog - Alabama Portal')

@section('content')

<!-- Hero Header -->
<div class="hero cdhero-section">
    <div class="container">
        <div class="row">
            <div class="col-xl-12">
                <div class="content">
                    <div class="rv" data-aos="fade-right">
                        <div class="eyebrow">Plumbing &amp; building materials — Dubai, UAE</div>
                        <h1 class="h-display">Every build runs on what's <span class="accent-i">behind the wall.</span></h1>
                        <p class="lede">
                            Water heaters, pipes and fittings, valves, pumps and sanitaryware — sourced, stocked and delivered for
                            residential, commercial and industrial projects across the Emirates.
                        </p>
                        <div class="hero-ctas">
                            <a class="btn solid" href="{{ route('frontend.contact') }}">Get a quote</a>
                            <a class="btn" href="#cat-hotwater">Browse categories</a>
                        </div>
                    </div>
                    <div class="hero-media" data-aos="fade-left">
                        <div class="frame">
                            <img src="https://alabamauae.com/wp-content/uploads/2026/01/sanitary-ware.webp" class="img-fluid" alt="Premium sanitaryware" />
                        </div>
                        <div class="cdtag">
                            <strong>Dubai Investments Park 2</strong>
                            <span>Warehouse &amp; sales — supplying trade and projects UAE-wide.</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-12">
                <div class="hero-ghost">ALABAMA</div>
            </div>
        </div>
    </div>
</div>

<!-- status -->
<section class="stats">
    <div class="container">
        <div class="row">
            <div class="col-xl-3 col-md-3 col-lg-3 col-sm-6"><div class="stat" data-aos="fade-up" data-aos-duration="800"> <b>{{ $totalProductsCount > 0 ? $totalProductsCount . '+' : '300+' }}</b><span>Products in the catalogue</span></div></div>
            <div class="col-xl-3 col-md-3 col-lg-3 col-sm-6"><div class="stat" data-aos="fade-up" data-aos-duration="1000"> <b>{{ $totalBrandsCount > 0 ? $totalBrandsCount : '5' }}</b><span>Exclusive brand lines</span></div></div>
            <div class="col-xl-3 col-md-3 col-lg-3 col-sm-6"><div class="stat" data-aos="fade-up" data-aos-duration="1200"> <b>7</b><span>Emirates delivery coverage</span></div></div>
            <div class="col-xl-3 col-md-3 col-lg-3 col-sm-6"><div class="stat" data-aos="fade-up" data-aos-duration="1400"> <b>1:1</b><span>Direct sales support on WhatsApp</span></div></div>
        </div>
    </div>
</section>

<!-- cdproducts -->
<section class="cdproducts">
    <div class="container">
        <div class="row">
            <div class="col-xl-12">
                <div class="sec-head split rv">
                    <div>
                        <div class="eyebrow">What we supply</div>
                        <h2 class="h-section">From boiler room to bathroom. <span class="accent-i">One supplier.</span></h2>
                    </div>
                    <a class="link-arrow" href="#products">View all products <i class="fa-solid fa-angles-right"></i></a>
                </div>
            </div>
            <div class="col-xl-12">
                <div class="row">
                    @forelse($categories as $index => $category)
                        <div class="col-xl-4 col-md-6 col-lg-4 col-sm-6">
                            <a class="cat-card rv" href="{{ route('frontend.category.show', $category->slug) }}" data-aos="fade-up" data-aos-duration="800">
                                @if($category->banner_url)
                                    <img src="{{ $category->banner_url }}" alt="{{ $category->name }}" />
                                @else
                                    <div class="d-flex align-items-center justify-content-center bg-light" style="height: 220px; font-size: 2rem; color: #94a3b8; font-weight: bold;">
                                        {{ $category->name }}
                                    </div>
                                @endif
                                <div class="cat-body">
                                    <small>{{ sprintf('%02d', $index + 1) }} — {{ $category->name }}</small>
                                    <h3>{{ $category->name }}</h3>
                                    <p>{{ $category->description ?: 'High quality plumbing, fixtures and equipment for residential and commercial applications.' }}</p>
                                    <span class="link-arrow">Explore <i class="fa-solid fa-arrow-right-long"></i></span>
                                </div>
                            </a>
                        </div>
                    @empty
                        <div class="col-12 text-center py-4">
                            <p class="text-muted">No categories available at the moment.</p>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</section>

<!-- qulity -->
<section class="cdwhoweare">
    <div class="container">
        <div class="row">
            <div class="col-xl-6 col-md-6 col-lg-6">
                <div data-aos="flip-left">
                    <div class="eyebrow">Who we are</div>
                    <h2 class="h-section mt-3 pe-md-4">Built on quality. <span class="accent-i">Trusted for excellence.</span></h2>
                    <p class="lede">Alabama Building Materials Trading LLC is one of the UAE’s trusted building materials suppliers, backed by a team of industry veterans with over <strong>40 years of combined expertise</strong> in delivering reliable, high-quality construction and plumbing solutions.</p>
                    <p class="lede">We specialize in supplying everything required for residential, commercial, hospitality, industrial, and infrastructure projects across the UAE. Our extensive portfolio includes premium plumbing systems, sanitary ware, water heaters, pumps, valves, pipes, fittings, bathroom solutions, and other essential building materials from globally recognized manufacturers.</p>
                    <p class="lede">With strategically located warehouses and an efficient logistics network, we ensure <strong>fast and dependable delivery across all Emirates</strong>, helping contractors, developers, consultants, retailers, and MEP professionals keep their projects on schedule.</p>
                    <p class="lede">Our product portfolio consists of <strong>project-approved brands</strong> that meet the stringent quality and compliance standards required by leading consultants, developers, and government authorities across the UAE.</p>
                    <a class="btn  mt-2" href="{{ route('frontend.about') }}">More about Alabama</a>
                </div>
            </div>
            <div class="col-xl-6 col-md-6 col-lg-6">
                <div class="media" data-aos="flip-up">
                    <img src="https://alabamauae.com/wp-content/uploads/2026/01/plumbing-materials.webp" alt="Alabama product range" class="img-fluid cdqulity" />
                </div>
            </div>            
        </div>        
    </div>
</section>

<!-- brand -->
@if($spotlightBrand)
<section class="cdbrand">
    <div class="container">            
        <div class="spot">
            <div class="spot-media" data-aos="zoom-in">
                @if($spotlightBrand->logo_url)
                    <img src="{{ $spotlightBrand->logo_url }}" alt="{{ $spotlightBrand->name }}" class="img-fluid cd-brand"/>
                @else
                    <div class="d-flex align-items-center justify-content-center h-100 bg-secondary text-white fw-bold fs-2 p-4">
                        {{ $spotlightBrand->name }}
                    </div>
                @endif
            </div>
            <div class="spot-copy on-dark" data-aos="zoom-out" data-aos-duration="1400">
                <div class="eyebrow">Brand spotlight</div>
                <h2 class="h-section">{{ $spotlightBrand->name }}. <span class="accent-i">Trusted Quality.</span></h2>
                <p>{{ $spotlightBrand->description ?: 'Premium manufacturer engineered with precision and industry-leading performance.' }}</p>
                <div class="spot-ctas">
                    <a class="btn brass" href="{{ route('frontend.brand.show', $spotlightBrand->slug) }}">View brand</a>
                    <a class="btn ghost-invert" href="{{ route('frontend.all-brands') }}">All brands</a>
                </div>
            </div>
        </div>
    </div>
</section>
@endif

<!-- brand-strip -->
@if($brands->isNotEmpty())
<section class="brand-strip">
    <div class="marquee-wrap">
        <div class="marquee">
            <!-- First Set -->
            @foreach($brands as $brand)
                @if($brand->logo_url)
                    <a href="{{ route('frontend.brand.show', $brand->slug) }}" title="{{ $brand->name }}" class="d-inline-flex align-items-center">
                        <img src="{{ $brand->logo_url }}" alt="{{ $brand->name }}" class="img-fluid" style="max-height: 50px; object-fit: contain;" />
                    </a>
                @else
                    <a href="{{ route('frontend.brand.show', $brand->slug) }}" class="d-inline-flex align-items-center text-decoration-none px-3 text-dark fw-bold">
                        {{ $brand->name }}
                    </a>
                @endif
            @endforeach

            <!-- Duplicate Set for smooth infinite marquee loop -->
            @foreach($brands as $brand)
                @if($brand->logo_url)
                    <a href="{{ route('frontend.brand.show', $brand->slug) }}" title="{{ $brand->name }}" class="d-inline-flex align-items-center">
                        <img src="{{ $brand->logo_url }}" alt="{{ $brand->name }}" class="img-fluid" style="max-height: 50px; object-fit: contain;" />
                    </a>
                @else
                    <a href="{{ route('frontend.brand.show', $brand->slug) }}" class="d-inline-flex align-items-center text-decoration-none px-3 text-dark fw-bold">
                        {{ $brand->name }}
                    </a>
                @endif
            @endforeach
        </div>
    </div>
</section>
@endif

<!-- collections -->
<section class="cdcollections" id="products">
    <div class="container">
        <div class="row">
            <div class="col-xl-12">
                <div class="sec-head split rv">
                    <div>
                        <div class="eyebrow">Featured collections</div>
                        <h2 class="h-section">Specified by engineers. <span class="accent-i">Chosen by homes.</span></h2>
                    </div>
                    <a class="link-arrow" href="https://wa.me/971559138047?text=Hello%20Alabama%2C%20please%20share%20your%20latest%20price%20list." target="_blank" rel="noopener">Request price list <i class="fa-solid fa-angles-right"></i></a>
                </div>
            </div>
            <div class="col-xl-12">
                <div class="row g-4">
                    @forelse($featuredProducts as $product)
                        <div class="col-xl-4 col-md-6 col-lg-4 col-sm-6" data-aos="fade-up">
                            <a href="{{ route('frontend.product.show', $product->slug) }}" class="product-card text-decoration-none" data-aos="fade-up">
                                <div class="product-img">
                                    @if($product->image_url)
                                        <img src="{{ $product->image_url }}"
                                            alt="{{ $product->model_name ?: $product->sku_code }}"
                                            class="img-fluid">
                                    @else
                                        <span class="ghost">{{ strtoupper(substr($product->model_name ?: $product->sku_code, 0, 1)) }}</span>
                                    @endif
                                </div>
                                <div class="product-body">
                                    <small>{{ $product->brand->name ?? '' }}</small>
                                    <h3>{{ $product->model_name ?: $product->sku_code }}</h3>
                                    <span class="product-link">
                                        View Product <i class="fa-solid fa-arrow-right-long"></i>
                                    </span>
                                </div>
                            </a>
                        </div>
                    @empty
                        <div class="col-xl-12 text-center py-4">
                            <p class="text-muted">No products found in the collection.</p>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Certified -->
<section class="cdCertified">
    <div class="container">
        <div class="row">
            <div class="col-xl-12">
                <div class="sec-head centered">
                    <div class="eyebrow centered">Assurance of quality</div>
                    <h2 class="h-section">Certified. Tested. <span class="accent-i">Trusted on site.</span></h2>
                </div>
                <div class="brand-strip" style="background: transparent; border: none; padding: 1rem 0;">
                    <div class="marquee-wrap">
                        <div class="marquee" style="animation-duration: 25s; gap: 0;">
                            @php
                                $certFiles = glob(public_path('assets/images/certification/*.{webp,png,jpg,jpeg}'), GLOB_BRACE);
                            @endphp
                            <!-- First Set -->
                            @foreach($certFiles as $certFile)
                                <div class="cell" style="display: inline-flex; width: 220px; border: 1px solid var(--line); border-radius: var(--radius); height: 160px; align-items: center; justify-content: center; padding: 20px; background: var(--paper); flex-shrink: 0; margin-right: 20px;">
                                    <img src="{{ asset('assets/images/certification/' . basename($certFile)) }}" alt="Certification" style="max-height: 120px; width: auto; object-fit: contain;" />
                                </div>
                            @endforeach
                            
                            <!-- Duplicate Set -->
                            @foreach($certFiles as $certFile)
                                <div class="cell" style="display: inline-flex; width: 220px; border: 1px solid var(--line); border-radius: var(--radius); height: 160px; align-items: center; justify-content: center; padding: 20px; background: var(--paper); flex-shrink: 0; margin-right: 20px;">
                                    <img src="{{ asset('assets/images/certification/' . basename($certFile)) }}" alt="Certification" style="max-height: 120px; width: auto; object-fit: contain;" />
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- cta -->
<section class="cdCta section">
    <div class="container">
        <div class="row">
            <div class="col-xl-12">
                <div class="cta-band on-dark" data-aos="fade-up" data-aos-anchor-placement="top-bottom">
                    <div>
                        <div class="eyebrow">Talk to sales</div>
                        <h2 class="h-section">Looking for Quality Plumbing Solutions? <span class="accent-i">Let's Talk.</span></h2>
                    </div>
                    <div class="actions">
                        <a
                            class="btn brass"
                            href="{{ route('frontend.contact') }}"
                            >GET QUOTE</a
                        >
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- blog -->
@if($blogs->isNotEmpty())
<section class="cdBlog section">
    <div class="container">
        <div class="row">
            <div class="col-xl-12">
                <div class="sec-head split">
                    <div>
                        <div class="eyebrow">Insights</div>
                        <h2 class="h-section">From our <span class="accent-i">blog</span></h2>
                    </div>
                    <a class="link-arrow" href="{{ route('frontend.blog') }}">All articles <i class="fa-solid fa-angles-right"></i></a>
                </div>
                <div class="blog-grid">
                    @foreach($blogs as $blog)
                        <a class="post rv" href="{{ route('frontend.blog.show', $blog->slug) }}">
                            <div class="pi">
                                @if($blog->image_url)
                                    <img src="{{ $blog->image_url }}" alt="{{ $blog->title }}" />
                                @else
                                    <div class="d-flex align-items-center justify-content-center bg-light text-muted fw-bold" style="height: 200px;">
                                        {{ $blog->tag ?: 'Alabama' }}
                                    </div>
                                @endif
                            </div>
                            <div class="pc">
                                <div class="meta">
                                    <span class="tagpill">{{ $blog->tag ?: 'Insights' }}</span>
                                    <span class="date">{{ $blog->created_at ? $blog->created_at->format('F Y') : '' }}</span>
                                </div>
                                <h3>{{ $blog->title }}</h3>
                                <p>{{ \Illuminate\Support\Str::limit(strip_tags($blog->content), 120) }}</p>
                                <span class="link-arrow">Read more <i class="fa-solid fa-arrow-right-long"></i></span>
                            </div>
                        </a>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</section>
@endif

{{-- JS --}}
<script src="{{ url('assets/js/gsap.min.js') }}"></script>
<script src="{{ url('assets/js/ScrollTrigger.min.js') }}"></script>
<script>
    gsap.registerPlugin(ScrollTrigger);
    gsap.utils.toArray(".post.rv").forEach((card) => {
        const tl = gsap.timeline({
            scrollTrigger: {
                trigger: card,
                start: "top 80%",
                toggleActions: "play none none reverse",
            },
        });

        tl.from(card.querySelector(".pi img"), {
            scale: 1.2,
            opacity: 0,
            duration: 1,
            ease: "power4.out",
        })

            .from(
                card.querySelector(".meta"),
                {
                    y: 25,
                    opacity: 0,
                    duration: 0.4,
                },
                "-=0.6"
            )

            .from(
                card.querySelector("h3"),
                {
                    y: 30,
                    opacity: 0,
                    duration: 0.5,
                },
                "-=0.25"
            )

            .from(
                card.querySelector("p"),
                {
                    y: 25,
                    opacity: 0,
                    duration: 0.5,
                },
                "-=0.25"
            )

            .from(
                card.querySelector(".link-arrow"),
                {
                    x: -20,
                    opacity: 0,
                    duration: 0.4,
                },
                "-=0.2"
            );
    });
</script>
@endsection
