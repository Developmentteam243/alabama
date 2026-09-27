@extends('layouts.master')

@section('title', 'Water Heaters, Plumbing & Building Materials Dubai - Alabama')

@section('content')

<!-- Hero Header -->
<div class="hero cdhero-section">
    <div class="container">
        <div class="row align-items-center py-4 py-lg-5">
            <!-- Text Content: order-2 on mobile, order-lg-1 on desktop -->
            <div class="col-lg-6 order-2 order-lg-1 mt-4 mt-lg-0">
                <div class="rv" data-aos="fade-right">
                    <div class="eyebrow">{{ $siteSettings['hero_eyebrow'] ?? 'Plumbing & building materials — Dubai, UAE' }}</div>
                    <h1 class="h-display">{!! $siteSettings['hero_title'] ?? 'Every build runs on what\'s <span class="accent-i">behind the wall.</span>' !!}</h1>
                    <p class="lede">
                        {{ $siteSettings['hero_description'] ?? 'Water heaters, pipes and fittings, valves, pumps and sanitaryware — sourced, stocked and delivered for residential, commercial and industrial projects across the Emirates.' }}
                    </p>
                    <div class="hero-ctas">
                        <a class="btn solid" href="{{ $siteSettings['hero_btn1_link'] ?? route('frontend.contact') }}">{{ $siteSettings['hero_btn1_text'] ?? 'Get a quote' }}</a>
                        <a class="btn" href="{{ route('frontend.products.index') }}">{{ $siteSettings['hero_btn2_text'] ?? 'Browse Catalogue' }}</a>
                    </div>
                </div>
            </div>

            <!-- Carousel Banner Media: order-1 on mobile, order-lg-2 on desktop -->
            <div class="col-lg-6 order-1 order-lg-2">
                <div class="hero-media" data-aos="fade-left">
                    <div class="swiper heroSwiper rounded-4 shadow-sm overflow-hidden position-relative">
                        <div class="swiper-wrapper">
                            @foreach($categories as $cat)
                                @php
                                    $slideImg = $cat->banner_url ?: ($cat->home_image_url ?: 'https://alabamauae.com/wp-content/uploads/2026/01/sanitary-ware.webp');
                                @endphp
                                <div class="swiper-slide position-relative">
                                    <div class="hero-slide-card" style="height: 440px; position: relative; overflow: hidden; border-radius: 12px; background: #0f172a;">
                                        <img src="{{ $slideImg }}" alt="{{ $cat->name }}" style="width: 100%; height: 100%; object-fit: cover;" />
                                        <div class="hero-slide-overlay" style="position: absolute; inset: 0; background: linear-gradient(180deg, rgba(0,0,0,0.1) 40%, rgba(15,23,42,0.85) 100%); display: flex; align-items: flex-end; padding: 24px;">
                                            <div class="w-100 d-flex justify-content-between align-items-center flex-wrap gap-2">
                                                <div>
                                                    <span class="badge bg-danger text-white small text-uppercase mb-1">Alabama Range</span>
                                                    <h4 class="text-white fw-bold mb-0">{{ $cat->name }}</h4>
                                                </div>
                                                <a href="{{ route('frontend.category.show', $cat->slug) }}" class="btn btn-sm btn-danger rounded-pill fw-bold px-4 py-2 text-uppercase shadow" style="background-color: #e11d48; border-color: #e11d48;">
                                                    Explore {{ $cat->name }} &rarr;
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <!-- Swiper Controls -->
                        <div class="swiper-pagination hero-pagination"></div>
                        <div class="swiper-button-next hero-next text-white"></div>
                        <div class="swiper-button-prev hero-prev text-white"></div>
                    </div>
                </div>
            </div>

            <div class="col-12">
                <div class="hero-ghost">{{ $siteSettings['hero_ghost_text'] ?? 'ALABAMA' }}</div>
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

<!-- cdproducts / Categories Carousel -->
<section class="cdproducts section">
    <div class="container">
        <div class="row">
            <div class="col-xl-12">
                <div class="sec-head split rv mb-4">
                    <div>
                        <div class="eyebrow">What we supply</div>
                        <h2 class="h-section">From boiler room to bathroom. <span class="accent-i">One supplier.</span></h2>
                    </div>
                    <div class="d-flex align-items-center gap-3">
                        <a class="link-arrow" href="{{ route('frontend.products.index') }}">View all products <i class="fa-solid fa-angles-right"></i></a>
                        <div class="category-carousel-nav d-none d-md-flex gap-2">
                            <button class="btn btn-sm btn-outline-dark rounded-circle cat-prev" style="width: 40px; height: 40px;" aria-label="Previous"><i class="fa-solid fa-arrow-left"></i></button>
                            <button class="btn btn-sm btn-outline-dark rounded-circle cat-next" style="width: 40px; height: 40px;" aria-label="Next"><i class="fa-solid fa-arrow-right"></i></button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-12">
                <div class="swiper categorySwiper pb-4">
                    <div class="swiper-wrapper">
                        @forelse($categories as $index => $category)
                            <div class="swiper-slide h-auto">
                                <a class="cat-card rv d-block h-100" href="{{ route('frontend.category.show', $category->slug) }}" data-aos="fade-up" data-aos-duration="800">
                                    @php
                                        $catImg = $category->home_image_url ?: $category->banner_url;
                                    @endphp
                                    @if($catImg)
                                        <img src="{{ $catImg }}" alt="{{ $category->name }}" />
                                    @else
                                        <div class="d-flex align-items-center justify-content-center bg-light text-dark" style="height: 100%; min-height: 480px; font-size: 2rem; font-weight: bold;">
                                            {{ $category->name }}
                                        </div>
                                    @endif
                                    <div class="cat-body">
                                        <small>{{ sprintf('%02d', $index + 1) }} — {{ $category->name }}</small>
                                        <h3>{{ $category->name }}</h3>
                                        <p>{{ $category->description ?: 'High quality plumbing, fixtures and equipment for residential and commercial applications.' }}</p>
                                        <span class="link-arrow">Explore Range <i class="fa-solid fa-arrow-right-long"></i></span>
                                    </div>
                                </a>
                            </div>
                        @empty
                            <div class="col-12 text-center py-4">
                                <p class="text-muted">No categories available at the moment.</p>
                            </div>
                        @endforelse
                    </div>
                    <div class="swiper-pagination cat-pagination mt-2"></div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- who we are -->
<section class="cdwhoweare section">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-xl-6 col-md-6 col-lg-6">
                <div data-aos="flip-left">
                    <div class="eyebrow">{{ $siteSettings['who_we_are_eyebrow'] ?? 'Who we are' }}</div>
                    <h2 class="h-section mt-3 pe-md-4">{!! $siteSettings['who_we_are_title'] ?? 'Built on quality. <span class="accent-i">Trusted for excellence.</span>' !!}</h2>
                    <p class="lede">{!! $siteSettings['who_we_are_p1'] ?? 'Alabama Building Materials Trading LLC is one of the UAE’s trusted building materials suppliers, backed by a team of industry veterans with over <strong>40 years of combined expertise</strong> in delivering reliable, high-quality construction and plumbing solutions.' !!}</p>
                    <p class="lede">{!! $siteSettings['who_we_are_p2'] ?? 'We specialize in supplying everything required for residential, commercial, hospitality, industrial, and infrastructure projects across the UAE. Our extensive portfolio includes premium plumbing systems, sanitary ware, water heaters, pumps, valves, pipes, fittings, bathroom solutions, and other essential building materials from globally recognized manufacturers.' !!}</p>
                    <p class="lede">{!! $siteSettings['who_we_are_p3'] ?? 'With strategically located warehouses and an efficient logistics network, we ensure <strong>fast and dependable delivery across all Emirates</strong>, helping contractors, developers, consultants, retailers, and MEP professionals keep their projects on schedule.' !!}</p>
                    <p class="lede">{!! $siteSettings['who_we_are_p4'] ?? 'Our product portfolio consists of <strong>project-approved brands</strong> that meet the stringent quality and compliance standards required by leading consultants, developers, and government authorities across the UAE.' !!}</p>
                    <a class="btn mt-2" href="{{ route('frontend.about') }}">More about Alabama</a>
                </div>
            </div>
            <div class="col-xl-6 col-md-6 col-lg-6">
                <div class="media" data-aos="flip-up">
                    <img src="{{ $siteSettings['who_we_are_image_url'] ?? 'https://alabamauae.com/wp-content/uploads/2026/01/plumbing-materials.webp' }}" alt="Alabama product range" class="img-fluid cdqulity" />
                </div>
            </div>            
        </div>        
    </div>
</section>

<!-- brand spotlight -->
@if($spotlightBrand)
<section class="cdbrand section">
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

<!-- Featured Collections Carousel -->
<section class="cdcollections section" id="products">
    <div class="container">
        <div class="row">
            <div class="col-xl-12">
                <div class="sec-head split rv mb-4">
                    <div>
                        <div class="eyebrow">Featured collections</div>
                        <h2 class="h-section">Specified by engineers. <span class="accent-i">Chosen by homes.</span></h2>
                    </div>
                    <div class="d-flex align-items-center gap-3">
                        <a class="link-arrow" href="{{ route('frontend.products.index') }}?featured=1">All Featured <i class="fa-solid fa-angles-right"></i></a>
                        <div class="product-carousel-nav d-none d-md-flex gap-2">
                            <button class="btn btn-sm btn-outline-dark rounded-circle prod-prev" style="width: 40px; height: 40px;" aria-label="Previous"><i class="fa-solid fa-arrow-left"></i></button>
                            <button class="btn btn-sm btn-outline-dark rounded-circle prod-next" style="width: 40px; height: 40px;" aria-label="Next"><i class="fa-solid fa-arrow-right"></i></button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-12">
                <div class="swiper productSwiper pb-4">
                    <div class="swiper-wrapper">
                        @forelse($featuredProducts as $product)
                            <div class="swiper-slide h-auto">
                                <a href="{{ route('frontend.product.show', $product->slug) }}" class="product-card text-decoration-none d-flex flex-column h-100 position-relative">
                                    <span class="position-absolute top-0 end-0 m-2 badge bg-danger text-white fw-bold shadow-sm" style="z-index: 5; font-size: 0.7rem;">⭐ FEATURED</span>
                                    <div class="product-img">
                                        @if($product->image_url)
                                            <img src="{{ $product->image_url }}"
                                                alt="{{ $product->model_name ?: $product->sku_code }}"
                                                class="img-fluid" loading="lazy">
                                        @else
                                            <span class="ghost">{{ strtoupper(substr($product->model_name ?: $product->sku_code, 0, 1)) }}</span>
                                        @endif
                                    </div>
                                    <div class="product-body flex-grow-1 d-flex flex-column justify-content-between">
                                        <div>
                                            <small>{{ $product->brand->name ?? 'Alabama' }}</small>
                                            <h3>{{ $product->model_name ?: $product->sku_code }}</h3>
                                        </div>
                                        <span class="product-link mt-2">
                                            View Product <i class="fa-solid fa-arrow-right-long"></i>
                                        </span>
                                    </div>
                                </a>
                            </div>
                        @empty
                            <div class="col-xl-12 text-center py-4">
                                <p class="text-muted">No featured products found in the collection.</p>
                            </div>
                        @endforelse
                    </div>
                    <div class="swiper-pagination prod-pagination mt-2"></div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Certified -->
<section class="cdCertified section">
    <div class="container">
        <div class="row">
            <div class="col-xl-12">
                <div class="sec-head centered mb-4">
                    <div class="eyebrow centered">Assurance of quality</div>
                    <h2 class="h-section">Certified. Tested. <span class="accent-i">Trusted on site.</span></h2>
                </div>
                <div class="brand-strip" style="background: transparent; border: none; padding: 0.5rem 0;">
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
<section class="cdCta section py-4">
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
                <div class="sec-head split mb-4">
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

{{-- GSAP & Swiper Scripts --}}
<script src="{{ url('assets/js/gsap.min.js') }}"></script>
<script src="{{ url('assets/js/ScrollTrigger.min.js') }}"></script>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        // Hero Carousel
        new Swiper(".heroSwiper", {
            slidesPerView: 1,
            loop: true,
            autoplay: {
                delay: 4500,
                disableOnInteraction: false,
            },
            pagination: {
                el: ".hero-pagination",
                clickable: true,
            },
            navigation: {
                nextEl: ".hero-next",
                prevEl: ".hero-prev",
            },
            effect: "fade",
            fadeEffect: {
                crossFade: true
            }
        });

        // Category Showcase Carousel
        new Swiper(".categorySwiper", {
            slidesPerView: 1.15,
            spaceBetween: 20,
            loop: false,
            navigation: {
                nextEl: ".cat-next",
                prevEl: ".cat-prev",
            },
            pagination: {
                el: ".cat-pagination",
                clickable: true,
            },
            breakpoints: {
                640: {
                    slidesPerView: 2,
                    spaceBetween: 20,
                },
                1024: {
                    slidesPerView: 3,
                    spaceBetween: 24,
                }
            }
        });

        // Featured Products Carousel
        new Swiper(".productSwiper", {
            slidesPerView: 1.15,
            spaceBetween: 20,
            loop: false,
            navigation: {
                nextEl: ".prod-next",
                prevEl: ".prod-prev",
            },
            pagination: {
                el: ".prod-pagination",
                clickable: true,
            },
            breakpoints: {
                576: {
                    slidesPerView: 2,
                    spaceBetween: 20,
                },
                992: {
                    slidesPerView: 3,
                    spaceBetween: 24,
                },
                1200: {
                    slidesPerView: 4,
                    spaceBetween: 24,
                }
            }
        });
    });

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

