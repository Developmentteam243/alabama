<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Water Heaters & Geysers Portal')</title>

    
    <!-- CSS & JS Assets via Vite -->
    @vite(['resources/js/app.js'])
    
    {{-- CSS --}}
    <link href="{{url('assets/css/aos.css?v='.mt_rand()) }}" rel="stylesheet" />
    <link href="{{url('assets/css/FA.min.css?v='.mt_rand()) }}" rel="stylesheet" />
    <link href="{{url('assets/css/style.css?v='.mt_rand()) }}" rel="stylesheet" />
    <style>
        .navbar-brand-custom {
            font-weight: 800;
            font-size: 1.5rem;
            letter-spacing: -0.5px;
            color: #0f172a;
            text-decoration: none;
            display: flex;
            align-items: center;
            gap: 8px;
        }
        .navbar-custom {
            background: rgba(255, 255, 255, 0.8);
            backdrop-filter: blur(12px);
            border-bottom: 1px solid rgba(226, 232, 240, 0.8);
            position: sticky;
            top: 0;
            z-index: 1030;
        }  
        .filter-sidebar {
            background: #ffffff;
            border: 1px solid rgba(226, 232, 240, 0.8);
            border-radius: 16px;
            padding: 24px;
        }
    </style>
</head>
<body>
    {{--Go to top--}}
    <div id="return-to-top"><i class="fa fa-angle-up"></i></div>

    {{-- top bar --}}
    <div class="mock-note">Design concept — Alabama Building Materials Trading L.L.C · prepared for review · not the live site</div>
    <div class="topbar">
        <div class="wrap">
            <div class="tb-left">
                <a href="mailto:sales@alabamauae.com"><i class="fa-solid fa-envelope"></i> sales@alabamauae.com</a>
                <a href="tel:+97143526973"><span class="hide-m"><i class="fa-solid fa-phone"></i> +971 4 352 6973</span></a>
            </div>
            <div class="tb-right">
                <a href="https://alabamauae.com/wp-content/uploads/2026/01/Alabama-Brochure.pdf" target="_blank" rel="noopener">Download brochure <i class="fa-solid fa-download"></i></a>
            </div>
        </div>
    </div>

    <!-- Header / Navbar -->
    <nav class="navbar navbar-expand-lg navbar-custom py-3 cd-mainmenu">
        <div class="container">
            <a class="navbar-brand-custom" href="{{ route('frontend.home') }}">
                <img src="{{url('assets/images/logo.webp') }}" title="Alabama" alt="Alabama" class="img-fluid cd-logo" />
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto align-items-lg-center">
                    <li class="nav-item">
                        <a class="nav-link cdLine" href="{{ route('frontend.home') }}">
                            Home
                        </a>
                    </li>
                    <!-- Categories Dropdown -->
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle cdLine"
                        href="javascript:;"
                        id="categoriesDropdown"
                        role="button"
                        data-bs-toggle="dropdown">
                            Categories
                        </a>
                        <ul class="dropdown-menu">
                            @foreach($navCategories as $cat)
                                <li><a class="dropdown-item" href="{{ route('frontend.category.show', $cat->slug) }}">{{ $cat->name }}</a></li>
                            @endforeach
                        </ul>
                    </li>

                    <!-- Brands Dropdown -->
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle cdLine"
                        href="javascript:;"
                        id="brandsDropdown"
                        role="button"
                        data-bs-toggle="dropdown">
                            Brands
                        </a>
                        <ul class="dropdown-menu">
                            @foreach($navBrands as $brand)
                                <li><a class="dropdown-item" href="{{ route('frontend.brand.show', $brand->slug) }}">{{ $brand->name }}</a></li>
                            @endforeach
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item" href="{{ route('frontend.all-brands') }}">All Brands</a></li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link cdLine" href="{{ route('frontend.about') }}">About</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link cdLine" href="{{ route('frontend.blog') }}">Blog</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link cdLine" href="{{ route('frontend.contact') }}">Contact</a>
                    </li>
                </ul>
                {{--<ul class="navbar-nav ms-auto align-items-center gap-2">
                    <li class="nav-item">
                        <a class="nav-link px-3 fw-medium" href="{{ route('frontend.home') }}">Products Catalog</a>
                    </li>
                    @auth
                        <li class="nav-item">
                            <a class="btn btn-outline-primary px-4 rounded-pill fw-semibold" href="{{ route('home') }}">
                                <i class="ti ti-dashboard me-1"></i> Admin Dashboard
                            </a>
                        </li>
                    @else
                        <li class="nav-item">
                            <a class="nav-link px-3 fw-medium" href="{{ route('login') }}">Login</a>
                        </li>
                        @if (Route::has('register'))
                            <li class="nav-item">
                                <a class="btn btn-primary px-4 rounded-pill fw-semibold" href="{{ route('register') }}">Register</a>
                            </li>
                        @endif
                    @endauth
                </ul>--}}

                <!-- menu-btn -->
                <div class="nav-cta">
                    <a class="btn solid" href="#contact">Get a quote</a>
                </div>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main>
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="cdFooter py-5">
        <div class="container">
            <div class="row g-4">
                <div class="col-lg-4 col-md-6">
                    <img src="{{url('assets/images/white-logo.webp') }}" title="Alabama" alt="Alabama" class="img-fluid cd-footlogo" />
                    <p class="small my-4">Alabama is a trusted UAE supplier of high-quality plumbing and building materials, offering durable and cost-effective solutions for residential, commercial, and industrial projects. We provide reliable construction supplies designed to meet the highest standards of quality and performance.</p>
                    <div class="f-social">
                        <a href="https://www.facebook.com/alabamauae/" target="_blank" rel="noopener" aria-label="Facebook"><i class="fa-brands fa-facebook-f"></i></a>
                        <a href="https://www.linkedin.com/company/alabama-building-materials-trading/" target="_blank" rel="noopener" aria-label="LinkedIn"><i class="fa-brands fa-linkedin-in"></i></a>
                        <a href="https://www.instagram.com/alabamauae/" target="_blank" rel="noopener" aria-label="Instagram"><i class="fa-brands fa-instagram"></i></a>
                        <a href="https://wa.me/971559138047" target="_blank" rel="noopener" aria-label="WhatsApp"><i class="fa-brands fa-whatsapp"></i></a>
                    </div>
                </div>
                <div class="col-lg-2 col-md-6 col-sm-4">
                    <h6 class="text-white mb-3 fw-bold">Quick Links</h6>
                    <ul class="list-unstyled small d-flex flex-column gap-2">
                        <li><a href="{{ route('frontend.home') }}">Home</a></li>
                        <li><a href="{{ route('frontend.about') }}">About us</a></li>
                        <li><a href="{{ route('frontend.all-brands') }}">Brands</a></li>
                        <li><a href="{{ route('frontend.blog') }}">Blog</a></li>
                        <li><a href="{{ route('frontend.contact') }}">Contact us</a></li>
                    </ul>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-4">
                    <h6 class="text-white mb-3 fw-bold">Products</h6>
                    <ul class="list-unstyled small d-flex flex-column gap-2">
                        <li><a href="{{ route('frontend.home') }}">Water heaters</a></li>
                        <li><a href="{{ route('frontend.home') }}">Solar heaters</a></li>
                        <li><a href="{{ route('frontend.home') }}">Water pumps</a></li>
                        <li><a href="{{ route('frontend.home') }}">Valves &amp; fittings</a></li>
                        <li><a href="{{ route('frontend.home') }}">Sanitaryware</a></li>
                        <li><a href="{{ route('frontend.home') }}">Bathroomware</a></li>
                        <li><a href="{{ route('frontend.home') }}">Kitchen</a></li>
                    </ul>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-4">
                    <h6 class="text-white mb-3 fw-bold">Contact</h6>
                    <p class="small mb-1"><i class="fa-solid fa-location-dot me-2"></i> Dubai Investments Park 2, Dubai, UAE</p>
                    <p class="small mb-1"><i class="fa-solid fa-envelope me-2"></i><a href="mailto:sales@alabamauae.com">sales@alabamauae.com</a></p>
                    <p class="small"><i class="fa-solid fa-phone me-2"></i><a href="tel:+97143526973">+971 4 352 6973</a></p>
                </div>
            </div>
            <hr class="border-secondary my-4">
            <div class="row align-items-center">
                <div class="col-md-6 text-center text-md-start small">
                    &copy; {{ date('Y') }} Alabama Building Materials Trading L.L.C. All rights reserved.
                </div>
                <div class="col-md-6 text-center text-md-end small">
                    <a href="#" class="cd-link">Privacy</a>
                     · 
                    <a href="#" class="cd-link">Terms</a>
                </div>
            </div>
        </div>
    </footer>

    {{-- WA --}}
    <a class="wa-float" href="https://wa.me/971559138047?text=Hello%20Alabama%2C%20I%20am%20interested%20in%20your%20products." target="_blank" rel="noopener" aria-label="WhatsApp">
        <svg viewBox="0 0 32 32"><path d="M16 3C9.4 3 4 8.3 4 14.9c0 2.6.8 5 2.3 7L4 29l7.3-2.3c1.9 1 4 1.6 6.2 1.6h.5c6.6 0 12-5.3 12-11.9C30 8.3 24.6 3 16 3h0zm7 16.9c-.3.8-1.7 1.6-2.4 1.7-.6.1-1.4.1-2.2-.1-.5-.2-1.2-.4-2-.8-3.6-1.5-5.9-5.1-6.1-5.4-.2-.2-1.4-1.9-1.4-3.6s.9-2.5 1.2-2.9c.3-.3.7-.4.9-.4h.7c.2 0 .5-.1.8.6.3.8 1.1 2.6 1.2 2.8.1.2.2.4 0 .7-.1.2-.2.4-.4.6l-.6.7c-.2.2-.4.4-.2.8.2.4 1 1.7 2.2 2.7 1.5 1.4 2.8 1.8 3.2 2 .4.2.6.2.9-.1.2-.3 1-1.2 1.3-1.6.3-.4.5-.3.9-.2.4.1 2.4 1.1 2.8 1.3.4.2.7.3.8.5.1.1.1.9-.2 1.7z"/></svg>
    </a>

    {{-- JS --}}
    <script src="{{ url('assets/js/aos.js?v='.mt_rand()) }}"></script>
    <script src="{{ url('assets/js/script.js?v='.mt_rand()) }}"></script>
</body>
</html>
