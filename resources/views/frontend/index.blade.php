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
                            <a class="btn solid" href="#contact">Get a quote</a>
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
            <div class="col-xl-3 col-md-3 col-lg-3 col-sm-6"><div class="stat" data-aos="fade-up" data-aos-duration="800"> <b>300+</b><span>Products in the catalogue</span></div></div>
            <div class="col-xl-3 col-md-3 col-lg-3 col-sm-6"><div class="stat" data-aos="fade-up" data-aos-duration="1000"> <b>5</b><span>Exclusive brand lines</span></div></div>
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
                    <a class="link-arrow" href="#cat-hotwater">View all products <i class="fa-solid fa-angles-right"></i></a>
                </div>
            </div>
            <div class="col-xl-12">
                <div class="row">
                    <div class="col-xl-4 col-md-6 col-lg-4 col-sm-6">
                        <a class="cat-card rv" href="{{ route('frontend.category.show', 'hot-water-system') }}" data-aos="fade-up" data-aos-duration="800">
                            <img
                                src="https://alabamauae.com/wp-content/uploads/2026/01/hot-water-system.webp"
                                alt="Hot water systems"
                            />
                            <div class="cat-body">
                                <small>01 — Heating</small>
                                <h3>Hot Water Systems</h3>
                                <p>Electric, solar and heat-pump water heaters, boilers and calorifiers.</p>
                                <span class="link-arrow">Explore <i class="fa-solid fa-arrow-right-long"></i></span>
                            </div>
                        </a>
                    </div>
                    <div class="col-xl-4 col-md-6 col-lg-4 col-sm-6">
                        <a class="cat-card rv" href="{{ route('frontend.category.show', 'plumbing-materials') }}" data-aos="fade-up" data-aos-duration="800">
                            <img
                                src="https://alabamauae.com/wp-content/uploads/2026/01/plumbing-materials.webp"
                                alt="Plumbing materials"
                            />
                            <div class="cat-body">
                                <small>02 — Flow</small>
                                <h3>Plumbing Materials</h3>
                                <p>Pipes, fittings, valves, pumps and pressure control for every system.</p>
                                <span class="link-arrow">Explore <i class="fa-solid fa-arrow-right-long"></i></span>
                            </div>
                        </a>
                    </div>
                    <div class="col-xl-4 col-md-6 col-lg-4 col-sm-6">
                        <a class="cat-card rv" href="{{ route('frontend.category.show', 'sanitaryware') }}" data-aos="fade-up" data-aos-duration="800">
                            <img src="https://alabamauae.com/wp-content/uploads/2026/01/sanitary-ware.webp" alt="Sanitaryware" />
                            <div class="cat-body">
                                <small>03 — Sanitary</small>
                                <h3>Sanitaryware</h3>
                                <p>WCs, wash basins and shattafs for residential and commercial washrooms.</p>
                                <span class="link-arrow">Explore <i class="fa-solid fa-arrow-right-long"></i></span>
                            </div>
                        </a>
                    </div>
                    <div class="col-xl-4 col-md-6 col-lg-4 col-sm-6">
                        <a class="cat-card rv" href="{{ route('frontend.category.show', 'bathroomware') }}" data-aos="fade-up" data-aos-duration="800">
                            <img src="https://alabamauae.com/wp-content/uploads/2026/01/12-1.webp" alt="Bathroomware" />
                            <div class="cat-body">
                                <small>04 — Finish</small>
                                <h3>Bathroomware</h3>
                                <p>Shower mixers, taps and accessories that finish the bathroom right.</p>
                                <span class="link-arrow">Explore <i class="fa-solid fa-arrow-right-long"></i></span>
                            </div>
                        </a>
                    </div>
                    <div class="col-xl-4 col-md-6 col-lg-4 col-sm-6">
                        <a class="cat-card rv" href="{{ route('frontend.category.show', 'kitchen') }}" data-aos="fade-up" data-aos-duration="800">
                            <img src="https://alabamauae.com/wp-content/uploads/2026/01/15-1.webp" alt="Kitchen" />
                            <div class="cat-body">
                                <small>05 — Kitchen</small>
                                <h3>Kitchen</h3>
                                <p>Sinks and sink taps built for daily use in UAE homes and facilities.</p>
                                <span class="link-arrow">Explore <i class="fa-solid fa-arrow-right-long"></i></span>
                            </div>
                        </a>
                    </div>
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
                    <p class="lede">Alabama is a leading supplier of premium plumbing and building materials in the UAE, providing reliable, high-performance solutions for residential, commercial, and industrial construction projects. We offer an extensive range of quality products, including water heaters, pipes and fittings, valves, pumps, sanitary ware, and plumbing accessories sourced from trusted manufacturers to ensure long-lasting durability, efficiency, and compliance with industry standards.</p>
                    <p class="lede">With a strong commitment to quality, competitive pricing, and exceptional customer service, Alabama serves contractors, developers, engineers, and homeowners across the UAE with dependable building materials that support projects of every size. Whether you're constructing a new property, upgrading an existing system, or managing a large-scale development, we provide the products and expertise you need to complete your project with confidence.</p>
                    <a class="btn  mt-2" href="#about">More about Alabama</a>
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
<section class="cdbrand">
    <div class="container">            
        <div class="spot">
            <div class="spot-media" data-aos="zoom-in"><img src="https://alabamauae.com/wp-content/uploads/2026/01/E-GLASSTECH-1.webp" alt="Lamborghini E-Glasstech water heater" class="img-fluid cd-brand"/></div>
            <div class="spot-copy on-dark" data-aos="zoom-out" data-aos-duration="1400">
                <div class="eyebrow">Brand spotlight</div>
                <h2 class="h-section">Lamborghini CaloreClima. Italian engineering, <span class="accent-i">7-year tanks.</span></h2>
                <p>76 electric water heater SKUs across the TAURUS, E-Glasstech and Glass Thermal families — glasslined tanks, serviceable flanged elements, warranties up to 7 years.</p>
                <div class="spot-ctas">
                    <a class="btn brass" href="{{ route('frontend.brand.show', 'lamborghini-caloreclima') }}">View brand</a>
                    <a class="btn ghost-invert" href="{{ route('frontend.all-brands') }}">All brands</a>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- brand-strip -->
<section class="brand-strip">
    <div class="marquee-wrap">
        <div class="marquee">
            <!-- First Set -->
            <img src="https://alabamauae.com/wp-content/uploads/2026/01/20.png" alt="Lamborghini CaloreClima" class="img-fluid" />
            <span class="wm">Zenith Water Heater</span>
            <span class="wm">Ariston</span>
            <img src="https://alabamauae.com/wp-content/uploads/2026/01/13.png" alt="VERA" class="img-fluid" />
            <span class="wm">Pegler</span>

            <!-- Duplicate Set -->
            <img src="https://alabamauae.com/wp-content/uploads/2026/01/20.png" alt="Lamborghini CaloreClima" class="img-fluid" />
            <span class="wm">Zenith Water Heater</span>
            <span class="wm">Ariston</span>
            <img src="https://alabamauae.com/wp-content/uploads/2026/01/13.png" alt="VERA" class="img-fluid" />
            <span class="wm">Pegler</span>
        </div>
    </div>
</section>

<!-- collections -->
<section class="cdcollections">
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
                <div class="assure">
                    <div class="cell" data-aos="flip-up">                        
                        <img src="{{url('assets/images/certification/1.webp') }}" alt="Certification" class="img-fluid" />
                    </div>
                    <div class="cell" data-aos="flip-up">                        
                        <img src="{{url('assets/images/certification/2.webp') }}" alt="Certification" class="img-fluid" />
                    </div>
                    <div class="cell" data-aos="flip-up">                        
                        <img src="{{url('assets/images/certification/3.webp') }}" alt="Certification" class="img-fluid" />
                    </div>
                    <div class="cell" data-aos="flip-up">                        
                        <img src="{{url('assets/images/certification/4.webp') }}" alt="Certification" class="img-fluid" />
                    </div>
                    <div class="cell" data-aos="flip-up">                        
                        <img src="{{url('assets/images/certification/5.webp') }}" alt="Certification" class="img-fluid" />
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
                            href="https://wa.me/971559138047?text=Hello%20Alabama%2C%20I%20would%20like%20a%20free%20quote."
                            target="_blank"
                            rel="noopener"
                            >Get Free Quote Now</a
                        >
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- blog -->
<section class="cdBlog section">
    <div class="container">
        <div class="row">
            <div class="col-xl-12">
                <div class="sec-head split">
                    <div>
                        <div class="eyebrow">Insights</div>
                        <h2 class="h-section">From our <span class="accent-i">blog</span></h2>
                    </div>
                    <a class="link-arrow" href="#blog">All articles <i class="fa-solid fa-angles-right"></i></a>
                </div>
                <div class="blog-grid">
                    <a class="post rv" href="#blog">
                        <div class="pi">
                            <img src="https://alabamauae.com/wp-content/uploads/2026/01/hot-water-system.webp" alt="" />
                        </div>
                        <div class="pc">
                            <div class="meta"><span class="tagpill">Hot water</span><span class="date">June 2026</span></div>
                            <h3>Electric vs. solar water heaters: what UAE villas actually need</h3>
                            <p>A practical comparison of running costs, capacity and lifespan for the Gulf climate.</p>
                            <span class="link-arrow">Read more <i class="fa-solid fa-arrow-right-long"></i></span>
                        </div>
                    </a>
                    <a class="post rv" href="#blog">
                        <div class="pi">
                            <img src="https://alabamauae.com/wp-content/uploads/2026/01/plumbing-materials.webp" alt="" />
                        </div>
                        <div class="pc">
                            <div class="meta"><span class="tagpill">Plumbing</span><span class="date">May 2026</span></div>
                            <h3>How to choose the right pump for multi-storey buildings</h3>
                            <p>Multistage, self-priming or booster — matching pump type to head and flow requirements.</p>
                            <span class="link-arrow">Read more <i class="fa-solid fa-arrow-right-long"></i></span>
                        </div>
                    </a>
                    <a class="post rv" href="#blog">
                        <div class="pi">
                            <img src="https://alabamauae.com/wp-content/uploads/2026/01/sanitary-ware.webp" alt="" />
                        </div>
                        <div class="pc">
                            <div class="meta">
                                <span class="tagpill">Sanitaryware</span><span class="date">April 2026</span>
                            </div>
                            <h3>Brass vs. zinc fittings: why the material behind the finish matters</h3>
                            <p>What separates a mixer that lasts fifteen years from one that fails in two.</p>
                            <span class="link-arrow">Read more <i class="fa-solid fa-arrow-right-long"></i></span>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

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
