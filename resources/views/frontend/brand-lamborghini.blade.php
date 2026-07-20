@extends('layouts.master')

@section('title', 'Catalog - Alabama Portal')

@section('content')

<!-- Header -->
<section class="page-hero cdBrandHeader" data-aos="fade-up">
    <div class="container">
        <div class="row">
            <div class="col-xl-12">
                <div data-aos="zoom-in-up">
                    <div class="eyebrow">Brand · Lamborghini CaloreClima · Italy</div>
                    <div class="cdBrandImg">
                        <img src="https://alabamauae.com/wp-content/uploads/2026/01/20.png" alt="Lamborghini CaloreClima" class="img-fluid cdBrandImg"/>
                    </div>
                    <h1 class="h-section">Lamborghini CaloreClima</h1>
                    <p class="lede mw-100">Italian heating engineering from Lamborghini CaloreClima — glasslined electric storage water heaters across the TAURUS, E-Glasstech and Glass Thermal families, with tank warranties up to 7 years.</p>
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
                    <div class="col-xl-6 col-md-6 col-lg-6">
                        <div class="category-card">
                            <div class="category-label">Category</div>
                            <h2 class="category-title">Hot Water System</h2>
                            <div class="chips">
                                <span class="chip">Solar Water Heater · 14 SKUs</span>
                                <span class="chip">Electric Water Heater · 13 SKUs</span>
                                <span class="chip">Calorifiers · 16 SKUs</span>
                            </div>
                            <a class="link-arrow" href="#cat-hotwater">Browse Hot Water System <i class="fa-solid fa-arrow-right-long"></i></a>
                        </div>
                    </div>
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
                    <div class="col-xl-4 col-md-6 col-lg-4 col-sm-6">
                        <a href="#product-eglasstech" class="product-card text-decoration-none">
                            <div class="product-img">
                                <img src="https://alabamauae.com/wp-content/uploads/2026/01/E-GLASSTECH-1.webp"
                                    alt="E-Glasstech Electric Water Heater"
                                    class="img-fluid">
                            </div>
                            <div class="product-body">
                                <small>LAMBORGHINI</small>
                                <h3>E-Glasstech Electric Water Heater</h3>
                                <span class="product-link">
                                    View product <i class="fa-solid fa-arrow-right-long"></i>
                                </span>
                            </div>
                        </a>
                    </div>
                    <div class="col-xl-4 col-md-6 col-lg-4 col-sm-6">
                        <a href="#" class="product-card text-decoration-none">
                            <div class="product-img">
                                <span class="ghost">T</span>
                            </div>
                            <div class="product-body">
                                <small>LAMBORGHINI</small>
                                <h3>E-Glasstech Electric Water Heater</h3>
                                <span class="product-link">
                                    View product <i class="fa-solid fa-arrow-right-long"></i>
                                </span>
                            </div>
                        </a>
                    </div>
                    <div class="col-xl-4 col-md-6 col-lg-4 col-sm-6">
                        <a href="#" class="product-card text-decoration-none">
                            <div class="product-img">
                                <span class="ghost">Z</span>
                            </div>
                            <div class="product-body">
                                <small>LAMBORGHINI</small>
                                <h3>E-Glasstech Electric Water Heater</h3>
                                <span class="product-link">
                                    View product <i class="fa-solid fa-arrow-right-long"></i>
                                </span>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- CTA -->
<section class="cta-section">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-xl-8 col-md-6 col-lg-8">
                <h2 class="h-section text-center text-md-start">Ask about the Lamborghini CaloreClima <span class="accent-i">range.</span></h2>                
            </div>
            <div class="col-xl-4 col-md-6 col-lg-4 text-lg-end text-center mt-2 mt-lg-0">
                <a class="btn solid" href="https://wa.me/971559138047?text=Hello%20Alabama%2C%20I%20need%20help%20with%20a%20product%20specification." target="_self" rel="noopener">WhatsApp sales</a>
            </div>
        </div>
    </div>
</section>


@endsection
