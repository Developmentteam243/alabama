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
<section class="cdContact section" id="quote-section">
    <div class="container">
        <div class="row g-5">
            <!-- Left Side -->
            <div class="col-xl-6 col-md-6 col-lg-6 mt-0">
                <div class="contact-info p-lg-5 p-4">
                    <div data-aos="fade-up">
                        <div class="info-item">
                            <h6>SHOWROOM & WAREHOUSE</h6>
                            <p>
                                <a href="https://maps.google.com/?q=Dubai+Investments+Park+2,+Dubai,+UAE" target="_blank" rel="noopener" class="text-decoration-none text-reset d-inline-flex align-items-center gap-2">
                                    <span>Dubai Investments Park 2, Dubai, UAE</span>
                                    <i class="fa-solid fa-arrow-up-right-from-square text-danger small"></i>
                                </a>
                            </p>
                        </div>
                        <div class="info-item">
                            <h6>EMAIL</h6>
                            <p><a href="mailto:sales@alabamauae.com" class="text-decoration-none text-reset">sales@alabamauae.com</a></p>
                        </div>
                        <div class="info-item">
                            <h6>PHONE</h6>
                            <p><a href="tel:+97143526973" class="text-decoration-none text-reset">+971 4 352 6973</a></p>
                        </div>
                        <div class="info-item">
                            <h6>WHATSAPP</h6>
                            <p><a href="https://wa.me/971559138047" target="_blank" rel="noopener" class="text-decoration-none text-reset">+971 55 913 8047</a></p>
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
                <div class="contact-form" id="quote-form">
                    <div data-aos="fade-up">
                        @if(session('success_quote'))
                            <div class="alert alert-success alert-dismissible fade show mb-4" role="alert" id="quote-alert">
                                {{ session('success_quote') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @endif

                        @if($errors->any())
                            <div class="alert alert-danger mb-4" id="quote-errors">
                                <ul class="mb-0">
                                    @foreach($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <form action="{{ route('frontend.quote.store') }}" method="POST" enctype="multipart/form-data" id="quote-request-form">
                            @csrf
                            <div class="mb-4">
                                <label class="form-label required">NAME</label>
                                <input type="text" name="name" id="quote_name" class="form-control" placeholder="Your name" value="{{ old('name') }}" required>
                            </div>

                            <div class="mb-4">
                                <label class="form-label required">EMAIL</label>
                                <input type="email" name="email" id="quote_email" class="form-control" placeholder="you@company.com" value="{{ old('email') }}" required>
                            </div>

                            <div class="mb-4">
                                <label class="form-label required">PHONE</label>
                                <input type="text" name="phone" id="quote_phone" class="form-control" placeholder="e.g. +971 50 123 4567" value="{{ old('phone') }}" required>
                            </div>

                            <div class="mb-4">
                                <label class="form-label">REQUIREMENT (OPTIONAL)</label>
                                <textarea name="requirement" id="quote_requirement" rows="4" class="form-control" placeholder="Products, quantities, project details...">{{ old('requirement', request('product') ? 'I would like to request a quote for: ' . request('product') : '') }}</textarea>
                            </div>

                            <div class="mb-4">
                                <label class="form-label">UPLOAD BOQ (PDF OR EXCEL)</label>
                                <input type="file" name="boq" class="form-control" accept=".pdf,.xls,.xlsx">
                                <small class="text-muted">Accepts PDF, XLS, XLSX formats (Max 15MB).</small>
                            </div>

                            <button type="submit" class="btn solid w-100">
                                SUBMIT QUOTE REQUEST
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Google Map Section -->
<section class="cdMap section pt-0" data-aos="fade-up">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="rounded-4 overflow-hidden shadow-sm border" style="height: 450px; background: #e2e8f0;">
                    <iframe 
                        src="https://maps.google.com/maps?q=Dubai%20Investments%20Park%202,%20Dubai,%20UAE&t=&z=14&ie=UTF8&iwloc=&output=embed" 
                        width="100%" 
                        height="100%" 
                        style="border:0;" 
                        allowfullscreen="" 
                        loading="lazy" 
                        referrerpolicy="no-referrer-when-downgrade"
                        title="Alabama Building Materials Location Map">
                    </iframe>
                </div>
            </div>
        </div>
    </div>
</section>

<style>
    #quote-section, #quote-form {
        scroll-margin-top: 110px;
    }
</style>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        function scrollToForm() {
            var target = document.getElementById("quote-form") || document.getElementById("quote-section");
            if (target) {
                target.scrollIntoView({ behavior: "smooth", block: "start" });
                var nameInput = document.getElementById("quote_name");
                if (nameInput && !nameInput.value) {
                    setTimeout(function() {
                        nameInput.focus();
                    }, 500);
                }
            }
        }

        var hash = window.location.hash;
        var urlParams = new URLSearchParams(window.location.search);
        var hasErrors = document.getElementById("quote-errors");
        var hasSuccess = document.getElementById("quote-alert");

        if (hash === "#quote-form" || hash === "#quote-section" || hash === "#quote" || urlParams.has("product") || urlParams.has("quote") || hasErrors || hasSuccess) {
            setTimeout(scrollToForm, 250);
        }

        // Handle on-page quote button clicks smoothly
        document.querySelectorAll('a[href*="#quote-form"], a[href*="#quote-section"]').forEach(function(anchor) {
            anchor.addEventListener('click', function(e) {
                var currentPath = window.location.pathname.replace(/\/$/, '');
                var linkHref = anchor.getAttribute('href');
                if (linkHref.includes('#quote-form') || linkHref.includes('#quote-section')) {
                    if (window.location.pathname.includes('/contact')) {
                        e.preventDefault();
                        scrollToForm();
                        history.pushState(null, null, '#quote-form');
                    }
                }
            });
        });
    });
</script>

@endsection

