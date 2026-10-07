@extends('layouts.master')

@section('title', 'Privacy Policy - Alabama Building Materials')

@section('meta_description', 'Privacy Policy for Alabama Building Materials Trading LLC. Learn how we collect, protect and process your data.')

@section('content')

<!-- Header -->
<section class="page-hero" data-aos="fade-up">
    <div class="container">
        <div class="row">
            <div class="col-xl-12">
                <div data-aos="zoom-in-up">
                    <div class="eyebrow">{{ $siteSettings['privacy_eyebrow'] ?? 'Legal' }}</div>
                    <h1 class="h-section">{!! $siteSettings['privacy_title'] ?? 'Privacy <span class="accent-i">Policy</span>' !!}</h1>
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
                    @if(!empty($siteSettings['privacy_policy_content']))
                        {!! $siteSettings['privacy_policy_content'] !!}
                    @else
                        <h3 class="fw-bold mb-3">1. Introduction</h3>
                        <p class="text-secondary mb-4">
                            Alabama Building Materials Trading L.L.C ("Alabama", "we", "our", or "us") respects your privacy and is committed to protecting the personal information you share with us. This Privacy Policy explains how we collect, use, disclose, and safeguard your information when you visit our website or interact with our sales and customer service teams.
                        </p>

                        <h3 class="fw-bold mb-3">2. Information We Collect</h3>
                        <p class="text-secondary mb-2">We may collect personal information that you provide voluntarily when you:</p>
                        <ul class="text-secondary mb-4 ps-3" style="list-style-type: disc;">
                            <li class="mb-2">Request product quotations or BOQ price assessments.</li>
                            <li class="mb-2">Contact our team via website forms, email, phone, or WhatsApp.</li>
                            <li class="mb-2">Submit product reviews and customer inquiries.</li>
                            <li class="mb-2">Download product specifications, brochures, or catalogs.</li>
                        </ul>
                        <p class="text-secondary mb-4">
                            This information may include your name, email address, phone number, company name, project location, and uploaded architectural/engineering files.
                        </p>

                        <h3 class="fw-bold mb-3">3. How We Use Your Information</h3>
                        <p class="text-secondary mb-2">The information we collect is used to:</p>
                        <ul class="text-secondary mb-4 ps-3" style="list-style-type: disc;">
                            <li class="mb-2">Prepare, process, and deliver commercial and project quotations.</li>
                            <li class="mb-2">Communicate specifications, stock availability, and delivery updates.</li>
                            <li class="mb-2">Improve website performance, product cataloging, and client experience.</li>
                            <li class="mb-2">Comply with statutory commercial and legal requirements within the UAE.</li>
                        </ul>

                        <h3 class="fw-bold mb-3">4. Information Sharing & Protection</h3>
                        <p class="text-secondary mb-4">
                            We do not sell, trade, or rent your personal information to third parties. We implement stringent technical and organizational security measures to protect your submitted data from unauthorized access, alteration, or disclosure.
                        </p>

                        <h3 class="fw-bold mb-3">5. Cookies & Analytics</h3>
                        <p class="text-secondary mb-4">
                            Our website may use cookies and standard web analytics tools to understand traffic patterns and optimize the user browsing experience. You can adjust your browser settings to refuse cookies at any time.
                        </p>

                        <h3 class="fw-bold mb-3">6. Contact Us</h3>
                        <p class="text-secondary mb-0">
                            If you have any questions regarding this Privacy Policy or wish to request data updates, please contact us at:
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
