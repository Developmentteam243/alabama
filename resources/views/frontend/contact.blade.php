@extends('layouts.master')

@section('title', 'Catalog - Alabama Portal')

@section('content')

<!-- Header -->
<section class="page-hero" data-aos="fade-up">
    <div class="container">
        <div class="row">
            <div class="col-xl-12">
                <div data-aos="zoom-in-up">
                    <div class="eyebrow">Contact us</div>
                    <h1 class="h-section">Reliable Building Materials Supplier <span class="accent-i">in the UAE</span></h1>
                    <p class="lede mw-100">Looking for high-quality building materials you can rely on? Alabama provides a comprehensive range of durable and industry-approved building supplies trusted by contractors, developers, engineers, and project managers across the UAE.</p>
                    <p class="lede mw-100">From premium plumbing materials and sanitary solutions to water heaters, fittings, and essential construction products, we deliver reliable solutions designed for superior performance, durability, and long-term value. Our expert team helps you choose the right products to meet your project requirements.</p>
                    <p class="lede mw-100">Contact Alabama today for competitive pricing, product availability, and professional guidance for your residential, commercial, or industrial projects.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- cotact form -->
<section class="cdContact section">
    <div class="container">
        <div class="row g-5">
            <!-- Left Side -->
            <div class="col-xl-6 col-md-6 col-lg-6 mt-0">
                <div class="contact-info p-lg-5 p-4">
                    <div data-aos="fade-up">
                        <div class="info-item">
                            <h6>SHOWROOM & WAREHOUSE</h6>
                            <p>Dubai Investments Park 2, Dubai, UAE</p>
                        </div>
                        <div class="info-item">
                            <h6>EMAIL</h6>
                            <p>sales@alabamauae.com</p>
                        </div>
                        <div class="info-item">
                            <h6>PHONE</h6>
                            <p>+971 4 352 6973</p>
                        </div>
                        <div class="info-item">
                            <h6>WHATSAPP</h6>
                            <p>+971 55 913 8047</p>
                        </div>
                        <div class="info-item border-0 pb-0">
                            <h6>HOURS</h6>
                            <p>Mon–Sat, 8:30am – 6:30pm</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Right Side -->
            <div class="col-xl-6 col-md-6 col-lg-6 mt-0">
                <div class="contact-form">
                    <div data-aos="fade-up">
                        <form>
                            <div class="mb-4">
                                <label class="form-label">NAME</label>
                                <input type="text" class="form-control" placeholder="Your name">
                            </div>

                            <div class="mb-4">
                                <label class="form-label">EMAIL</label>
                                <input type="email" class="form-control" placeholder="you@company.com">
                            </div>

                            <div class="mb-4">
                                <label class="form-label">PHONE</label>
                                <input type="text" class="form-control" placeholder="+971">
                            </div>

                            <div class="mb-4">
                                <label class="form-label">HOW CAN WE HELP?</label>
                                <select class="form-select">
                                    <option>Product inquiry</option>
                                    <option>Request a quotation</option>
                                    <option>Customer support</option>
                                    <option>Other</option>
                                </select>
                            </div>

                            <div class="mb-4">
                                <label class="form-label">MESSAGE</label>
                                <textarea rows="5" class="form-control" placeholder="Products, quantities, project details..."></textarea>
                            </div>

                            <button class="btn solid w-100">
                                SEND MESSAGE
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>


@endsection
