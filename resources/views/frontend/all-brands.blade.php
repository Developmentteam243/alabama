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
                    <div class="col-xl-4 col-md-6 col-lg-4 col-sm-6">
                        <a href="#product-eglasstech" class="product-card text-decoration-none">
                            <div class="product-img">
                                <img src="https://alabamauae.com/wp-content/uploads/2026/01/20.png"
                                    alt="Lamborghini CaloreClima"
                                    class="img-fluid">
                            </div>
                            <div class="product-body">
                                <h3>Lamborghini CaloreClima</h3>
                                <p class="short-desc">Italian heating engineering from Lamborghini CaloreClima.</p>
                                <span class="product-link">
                                    View brand <i class="fa-solid fa-arrow-right-long"></i>
                                </span>
                            </div>
                        </a>
                    </div>
                    <div class="col-xl-4 col-md-6 col-lg-4 col-sm-6">
                        <a href="#" class="product-card text-decoration-none">
                            <div class="product-img">
                                <span class="cdText">Zenith Water Heater</span>
                            </div>
                            <div class="product-body">                                
                                <h3>Zenith Water Heater</h3>
                                <p class="short-desc">Made in the UAE by Star Industrial Products.</p>
                                <span class="product-link">
                                    View brand <i class="fa-solid fa-arrow-right-long"></i>
                                </span>
                            </div>
                        </a>
                    </div>
                    <div class="col-xl-4 col-md-6 col-lg-4 col-sm-6">
                        <a href="#" class="product-card text-decoration-none">
                            <div class="product-img">
                                <span class="cdText">Ariston</span>
                            </div>
                            <div class="product-body">
                                <h3>Ariston</h3>
                                <p class="short-desc">Ariston Thermo's solar systems, collectors and cylinders.</p>
                                <span class="product-link">
                                    View brand <i class="fa-solid fa-arrow-right-long"></i>
                                </span>
                            </div>
                        </a>
                    </div>
                    <div class="col-xl-4 col-md-6 col-lg-4 col-sm-6">
                        <a href="#product-eglasstech" class="product-card text-decoration-none">
                            <div class="product-img">
                                <img src="https://alabamauae.com/wp-content/uploads/2026/01/13.png"
                                    alt="VERA"
                                    class="img-fluid">
                            </div>
                            <div class="product-body">                                
                                <h3>VERA</h3>
                                <p class="short-desc">Greek solar thermal engineering by Papaemmanouel SA.</p>
                                <span class="product-link">
                                    View brand <i class="fa-solid fa-arrow-right-long"></i>
                                </span>
                            </div>
                        </a>
                    </div>
                    <div class="col-xl-4 col-md-6 col-lg-4 col-sm-6">
                        <a href="#" class="product-card text-decoration-none">
                            <div class="product-img">
                                <span class="cdText">Pegler</span>
                            </div>
                            <div class="product-body">                                
                                <h3>Pegler</h3>
                                <p class="short-desc">British-engineered valves from Pegler Yorkshire.</p>
                                <span class="product-link">
                                    View brand <i class="fa-solid fa-arrow-right-long"></i>
                                </span>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>


@endsection
