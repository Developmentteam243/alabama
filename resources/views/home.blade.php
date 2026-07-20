@extends('tablar::page')

@section('title', 'Dashboard')

@section('content')
<!-- Page header -->
<div class="page-header d-print-none">
    <div class="container-xl">
        <div class="row g-2 align-items-center">
            <div class="col">
                <div class="page-pretitle">Overview</div>
                <h2 class="page-title">Dashboard</h2>
            </div>
        </div>
    </div>
</div>

<!-- Page body -->
<div class="page-body">
    <div class="container-xl">
        <div class="row row-cards">
            <!-- Stat Card: Products -->
            <div class="col-sm-6 col-lg-3">
                <div class="card card-sm">
                    <div class="card-body">
                        <div class="row align-items-center">
                            <div class="col-auto">
                                <span class="bg-primary text-white avatar">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                        <rect x="3" y="4" width="18" height="4" rx="2" />
                                        <path d="M5 8v10a2 2 0 0 0 2 2h10a2 2 0 0 0 2 -2v-10" />
                                        <line x1="10" y1="12" x2="14" y2="12" />
                                    </svg>
                                </span>
                            </div>
                            <div class="col">
                                <div class="font-weight-medium">
                                    {{ $productsCount }} Products
                                </div>
                                <div class="text-muted">
                                    Total Master SKUs
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Stat Card: Categories -->
            <div class="col-sm-6 col-lg-3">
                <div class="card card-sm">
                    <div class="card-body">
                        <div class="row align-items-center">
                            <div class="col-auto">
                                <span class="bg-green text-white avatar">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                        <circle cx="14" cy="6" r="2" />
                                        <line x1="4" y1="6" x2="12" y2="6" />
                                        <line x1="4" y1="12" x2="14" y2="12" />
                                        <line x1="4" y1="18" x2="18" y2="18" />
                                        <circle cx="16" cy="12" r="2" />
                                        <circle cx="20" cy="18" r="2" />
                                    </svg>
                                </span>
                            </div>
                            <div class="col">
                                <div class="font-weight-medium">
                                    {{ $categoriesCount }} Categories
                                </div>
                                <div class="text-muted">
                                    Main Taxonomies
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Stat Card: Subcategories -->
            <div class="col-sm-6 col-lg-3">
                <div class="card card-sm">
                    <div class="card-body">
                        <div class="row align-items-center">
                            <div class="col-auto">
                                <span class="bg-twitter text-white avatar">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                        <rect x="4" y="4" width="6" height="6" rx="1" />
                                        <rect x="14" y="4" width="6" height="6" rx="1" />
                                        <rect x="4" y="14" width="6" height="6" rx="1" />
                                        <rect x="14" y="14" width="6" height="6" rx="1" />
                                    </svg>
                                </span>
                            </div>
                            <div class="col">
                                <div class="font-weight-medium">
                                    {{ $subcategoriesCount }} Subcategories
                                </div>
                                <div class="text-muted">
                                    Sub-taxonomies
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Stat Card: Brands -->
            <div class="col-sm-6 col-lg-3">
                <div class="card card-sm">
                    <div class="card-body">
                        <div class="row align-items-center">
                            <div class="col-auto">
                                <span class="bg-yellow text-white avatar">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                        <path d="M12 12m-9 0a9 9 0 1 0 18 0a9 9 0 1 0 -18 0" />
                                        <path d="M12 12.5m-3 0a3 3 0 1 0 6 0a3 3 0 1 0 -6 0" />
                                        <path d="M12 12m-6 0a6 6 0 1 0 12 0a6 6 0 1 0 -12 0" />
                                    </svg>
                                </span>
                            </div>
                            <div class="col">
                                <div class="font-weight-medium">
                                    {{ $brandsCount }} Brands
                                </div>
                                <div class="text-muted">
                                    Registered Brands
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Stat Card: Blogs -->
            <div class="col-sm-6 col-lg-3">
                <div class="card card-sm">
                    <div class="card-body">
                        <div class="row align-items-center">
                            <div class="col-auto">
                                <span class="bg-red text-white avatar">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                        <path d="M16 6h3a1 1 0 0 1 1 1v11a2 2 0 0 1 -4 0v-13a1 1 0 0 0 -1 -1h-10a1 1 0 0 0 -1 1v12a3 3 0 0 0 3 3h11" />
                                        <path d="M8 8l4 0" />
                                        <path d="M8 12l4 0" />
                                        <path d="M8 16l4 0" />
                                    </svg>
                                </span>
                            </div>
                            <div class="col">
                                <div class="font-weight-medium">
                                    {{ $blogsCount }} Blogs
                                </div>
                                <div class="text-muted">
                                    Total Posts
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Welcome & Quick Actions -->
            <div class="col-md-12 mt-4">
                <div class="card">
                    <div class="card-body text-center py-4">
                        <h2 class="mb-2">Welcome to Alabama SKU Admin Panel!</h2>
                        <p class="text-secondary max-w-40 mx-auto">
                            Manage your SKU coding structure, Brands, Categories, and Products. Everything has been successfully populated from your master list.
                        </p>
                        <div class="mt-3">
                            <a href="{{ route('products.index') }}" class="btn btn-primary">
                                View Products Master
                            </a>
                            <a href="{{ route('categories.index') }}" class="btn btn-outline-success ms-2">
                                Manage Categories
                            </a>
                            <a href="{{ route('brands.index') }}" class="btn btn-outline-warning ms-2">
                                Manage Brands
                            </a>
                            <a href="{{ route('blogs.index') }}" class="btn btn-outline-danger ms-2">
                                Manage Blogs
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
