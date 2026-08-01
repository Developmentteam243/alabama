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
                        @if(session('success_quote'))
                            <div class="alert alert-success alert-dismissible fade show mb-4" role="alert">
                                {{ session('success_quote') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @endif

                        @if($errors->any())
                            <div class="alert alert-danger mb-4">
                                <ul class="mb-0">
                                    @foreach($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <form action="{{ route('frontend.quote.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="mb-4">
                                <label class="form-label required">NAME</label>
                                <input type="text" name="name" class="form-control" placeholder="Your name" value="{{ old('name') }}" required>
                            </div>

                            <div class="mb-4">
                                <label class="form-label required">EMAIL</label>
                                <input type="email" name="email" class="form-control" placeholder="you@company.com" value="{{ old('email') }}" required>
                            </div>

                            <div class="mb-4">
                                <label class="form-label required">PHONE</label>
                                <input type="text" name="phone" class="form-control" placeholder="e.g. +971 50 123 4567" value="{{ old('phone') }}" required>
                            </div>

                            <div class="mb-4">
                                <label class="form-label">REQUIREMENT (OPTIONAL)</label>
                                <textarea name="requirement" rows="4" class="form-control" placeholder="Products, quantities, project details...">{{ old('requirement') }}</textarea>
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


@endsection
