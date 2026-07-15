<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Water Heaters & Geysers Portal')</title>

    {{-- CSS --}}
    <link href="{{url('assets/css/style.css?v='.mt_rand()) }}" rel="stylesheet" />

    <!-- CSS & JS Assets via Vite -->
    @vite(['resources/js/app.js'])

    <style>
        body {
            font-family: 'Outfit', sans-serif;
            background-color: #f8fafc;
            color: #1e293b;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

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

        .hero-section {
            background: linear-gradient(135deg, #0f172a 0%, #1e293b 100%);
            color: #ffffff;
            padding: 80px 0;
            position: relative;
            overflow: hidden;
        }

        .hero-section::before {
            content: '';
            position: absolute;
            top: -50%;
            right: -20%;
            width: 600px;
            height: 600px;
            background: radial-gradient(circle, rgba(59, 130, 246, 0.15) 0%, rgba(0, 0, 0, 0) 70%);
            border-radius: 50%;
        }

        .card-product {
            border: 1px solid rgba(226, 232, 240, 0.8);
            border-radius: 16px;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            background: #ffffff;
            overflow: hidden;
        }

        .card-product:hover {
            transform: translateY(-4px);
            box-shadow: 0 12px 20px -8px rgba(0, 0, 0, 0.08);
            border-color: #cbd5e1;
        }

        .badge-brand {
            background-color: #f1f5f9;
            color: #475569;
            font-weight: 600;
            font-size: 0.75rem;
            padding: 6px 12px;
            border-radius: 9999px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .footer-custom {
            margin-top: auto;
            background-color: #0f172a;
            color: #94a3b8;
            border-top: 1px solid #1e293b;
        }

        .footer-custom a {
            color: #cbd5e1;
            text-decoration: none;
            transition: color 0.2s;
        }

        .footer-custom a:hover {
            color: #ffffff;
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

    <!-- Header / Navbar -->
    <nav class="navbar navbar-expand-lg navbar-custom py-3">
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
                        <a class="nav-link" href="{{ route('frontend.home') }}">
                            Home
                        </a>
                    </li>
                    <!-- Categories Dropdown -->
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle"
                        href="#"
                        id="categoriesDropdown"
                        role="button"
                        data-bs-toggle="dropdown">
                            Categories
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="#cat-hotwater">Hot Water Systems</a></li>
                            <li><a class="dropdown-item" href="#cat-plumbing">Plumbing Materials</a></li>
                            <li><a class="dropdown-item" href="#cat-sanitary">Sanitaryware</a></li>
                            <li><a class="dropdown-item" href="#cat-bathroom">Bathroomware</a></li>
                            <li><a class="dropdown-item" href="#cat-kitchen">Kitchen</a></li>
                        </ul>
                    </li>

                    <!-- Brands Dropdown -->
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle"
                        href="#"
                        id="brandsDropdown"
                        role="button"
                        data-bs-toggle="dropdown">
                            Brands
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="#brand-lamborghini">Lamborghini CaloreClima</a></li>
                            <li><a class="dropdown-item" href="#brand-zenith">Zenith Water Heater</a></li>
                            <li><a class="dropdown-item" href="#brand-ariston">Ariston</a></li>
                            <li><a class="dropdown-item" href="#brand-vera">VERA</a></li>
                            <li><a class="dropdown-item" href="#brand-pegler">Pegler</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item" href="#brands">All Brands</a></li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#about">About</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#blog">Blog</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#contact">Contact</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link fw-medium"
                        href="{{ route('frontend.home') }}">
                            Products Catalog
                        </a>
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
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main>
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="footer-custom py-5 mt-5">
        <div class="container">
            <div class="row g-4">
                <div class="col-lg-4 col-md-6">
                    <h5 class="text-white mb-3 fw-bold">Alabama Heaters</h5>
                    <p class="small">Explore our catalog of high-efficiency residential and industrial geysers, water heaters, and heating solutions.</p>
                </div>
                <div class="col-lg-2 col-md-6">
                    <h6 class="text-white mb-3 fw-bold">Quick Links</h6>
                    <ul class="list-unstyled small d-flex flex-column gap-2">
                        <li><a href="{{ route('frontend.home') }}">Home</a></li>
                        <li><a href="{{ route('login') }}">Admin Login</a></li>
                    </ul>
                </div>
                <div class="col-lg-3 col-md-6">
                    <h6 class="text-white mb-3 fw-bold">Product Brands</h6>
                    <p class="small">Top-tier brands offering unparalleled warranty, heating efficiency, and mounting capabilities.</p>
                </div>
                <div class="col-lg-3 col-md-6">
                    <h6 class="text-white mb-3 fw-bold">Contact Support</h6>
                    <p class="small mb-1"><i class="ti ti-mail me-2"></i>support@alabamaportal.com</p>
                    <p class="small"><i class="ti ti-phone me-2"></i>+1 (555) 019-2834</p>
                </div>
            </div>
            <hr class="border-secondary my-4">
            <div class="row align-items-center">
                <div class="col-md-6 text-center text-md-start small">
                    &copy; {{ date('Y') }} Alabama Portal. All rights reserved.
                </div>
                <div class="col-md-6 text-center text-md-end small">
                    Designed for visual excellence and responsive performance.
                </div>
            </div>
        </div>
    </footer>

</body>
</html>
