@extends('layouts.master')

@section('title', 'Terms & Conditions - Alabama Building Materials')

@section('meta_description', 'Terms and Conditions for Alabama Building Materials Trading LLC. Read our terms of service and commercial policies.')

@section('content')

<!-- Header -->
<section class="page-hero" data-aos="fade-up">
    <div class="container">
        <div class="row">
            <div class="col-xl-12">
                <div data-aos="zoom-in-up">
                    <div class="eyebrow">{{ $siteSettings['terms_eyebrow'] ?? 'Legal' }}</div>
                    <h1 class="h-section">{!! $siteSettings['terms_title'] ?? 'Terms &amp; <span class="accent-i">Conditions</span>' !!}</h1>
                    <p class="lede mw-100">Last updated: {{ date('F Y') }}</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Content Section -->
<section class="section">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <div class="bg-white p-4 p-md-5 rounded-4 border shadow-sm policy-content">
                    @if(!empty($siteSettings['terms_conditions_content']))
                        {!! $siteSettings['terms_conditions_content'] !!}
                    @else
                        <h3 class="fw-bold mb-3">1. Agreement to Terms</h3>
                        <p class="text-secondary mb-4">
                            By accessing or using the Alabama Building Materials Trading L.L.C website and related services, you agree to comply with and be bound by these Terms and Conditions. If you do not agree with these terms, please do not use our website.
                        </p>

                        <h3 class="fw-bold mb-3">2. Quotations & Pricing</h3>
                        <p class="text-secondary mb-4">
                            All product pricing, estimates, and quotations provided online or through digital forms are subject to formal confirmation, stock availability, and manufacturer price revisions. Official commercial invoices and delivery agreements shall govern final transactions.
                        </p>

                        <h3 class="fw-bold mb-3">3. Product Specifications & Technical Data</h3>
                        <p class="text-secondary mb-4">
                            While Alabama makes every effort to ensure that product images, dimensions, technical data sheets, and specifications are accurate and up-to-date, manufacturers reserve the right to alter product specifications without prior notice. Consult our technical sales team for certified submittals.
                        </p>

                        <h3 class="fw-bold mb-3">4. Intellectual Property</h3>
                        <p class="text-secondary mb-4">
                            All brand names, trademarks, logos, photographs, and media displayed on this website are the property of Alabama Building Materials Trading L.L.C or their respective manufacturer partners and may not be reproduced without prior written permission.
                        </p>

                        <h3 class="fw-bold mb-3">5. Delivery & Project Supply</h3>
                        <p class="text-secondary mb-4">
                            Delivery schedules and site logistics across the UAE are coordinated per mutual agreement on confirmed purchase orders. Force majeure and external carrier disruptions are governed by applicable UAE commercial laws.
                        </p>

                        <h3 class="fw-bold mb-3">6. Governing Law</h3>
                        <p class="text-secondary mb-4">
                            These Terms and Conditions shall be governed by and construed in accordance with the federal laws of the United Arab Emirates and the local laws of the Emirate of Dubai.
                        </p>

                        <h3 class="fw-bold mb-3">7. Contact Information</h3>
                        <p class="text-secondary mb-0">
                            For inquiries regarding these terms, please reach out to our legal and commercial team:
                            <br><br>
                            <strong>Alabama Building Materials Trading L.L.C</strong><br>
                            Dubai Investments Park 2, Dubai, UAE<br>
                            Email: <a href="mailto:sales@alabamauae.com" class="text-danger fw-semibold">sales@alabamauae.com</a><br>
                            Phone: <a href="tel:+97143526973" class="text-danger fw-semibold">+971 4 352 6973</a>
                        </p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</section>

@endsection
