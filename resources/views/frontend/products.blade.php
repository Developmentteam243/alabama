@extends('layouts.master')

@section('title', 'Products Catalogue - Alabama Building Materials')
@section('meta_description', 'Explore Alabama\'s full range of project-approved water heaters, plumbing materials, valves, pumps and sanitaryware across the UAE.')

@section('content')

<!-- Hero Header -->
<section class="page-hero" data-aos="fade-up" style="background: linear-gradient(135deg, #0f172a 0%, #1e293b 100%); padding: 80px 0 60px 0; color: white;">
    <div class="container">
        <div class="row">
            <div class="col-xl-12">
                <nav aria-label="breadcrumb" class="mb-3">
                    <ol class="breadcrumb m-0" style="background: transparent; padding: 0;">
                        <li class="breadcrumb-item"><a href="{{ route('frontend.home') }}" style="color: rgba(255, 255, 255, 0.7); text-decoration: none;">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page" style="color: #ffffff;">Products</li>
                    </ol>
                </nav>
                <div class="eyebrow" style="color: var(--accent, #e11d48) !important;">Full Range Catalogue</div>
                <h1 class="h-section text-white mb-2">Explore All <span class="accent-i">Products</span></h1>
                <p class="lede text-white-50 mw-100 mb-0">Browse and filter our comprehensive inventory of certified water heaters, plumbing systems, and project supplies.</p>
            </div>
        </div>
    </div>
</section>

<!-- Products Catalogue & Filters -->
<section class="cdcollections section pt-4">
    <div class="container">
        <!-- Search & Filters Bar -->
        <div class="row mb-4">
            <div class="col-12">
                <form action="{{ route('frontend.products.index') }}" method="GET" class="p-4 bg-light border rounded-3 shadow-sm">
                    <div class="row g-3 align-items-end">
                        <div class="col-xl-3 col-lg-4 col-md-6">
                            <label class="form-label fw-bold small text-secondary">SEARCH KEYWORD</label>
                            <div class="input-group">
                                <span class="input-group-text bg-white border-end-0"><i class="fa-solid fa-magnifying-glass text-muted"></i></span>
                                <input type="text" name="search" class="form-control border-start-0" value="{{ request('search') }}" placeholder="Model, SKU, Part Code...">
                            </div>
                        </div>
                        <div class="col-xl-2 col-lg-4 col-md-6">
                            <label class="form-label fw-bold small text-secondary">CATEGORY</label>
                            <select name="category_id" id="catFilterSelect" class="form-select">
                                <option value="">All Categories</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}" {{ request('category_id') == $category->id ? 'selected' : '' }}>
                                        {{ $category->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-xl-2 col-lg-4 col-md-6">
                            <label class="form-label fw-bold small text-secondary">SUBCATEGORY</label>
                            <select name="subcategory_id" id="subcatFilterSelect" class="form-select">
                                <option value="">All Subcategories</option>
                                @foreach($subcategories as $subcat)
                                    <option value="{{ $subcat->id }}" data-category="{{ $subcat->category_id }}" {{ request('subcategory_id') == $subcat->id ? 'selected' : '' }}>
                                        {{ $subcat->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-xl-2 col-lg-4 col-md-6">
                            <label class="form-label fw-bold small text-secondary">BRAND</label>
                            <select name="brand_id" class="form-select">
                                <option value="">All Brands</option>
                                @foreach($brands as $brand)
                                    <option value="{{ $brand->id }}" {{ request('brand_id') == $brand->id ? 'selected' : '' }}>
                                        {{ $brand->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-xl-1 col-lg-2 col-md-3">
                            <label class="form-label fw-bold small text-secondary">CAPACITY</label>
                            <select name="capacity" class="form-select">
                                <option value="">All</option>
                                @foreach($capacities as $cap)
                                    <option value="{{ $cap }}" {{ request('capacity') == $cap ? 'selected' : '' }}>
                                        {{ $cap }}L
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-xl-2 col-lg-4 col-md-6 d-flex gap-2">
                            <button type="submit" class="btn btn-danger w-100 fw-bold">
                                <i class="fa-solid fa-filter me-1"></i> Filter
                            </button>
                            @if(request()->anyFilled(['search', 'category_id', 'subcategory_id', 'brand_id', 'capacity', 'mounting', 'sort', 'featured']))
                                <a href="{{ route('frontend.products.index') }}" class="btn btn-secondary fw-bold" title="Reset Filters">
                                    Reset
                                </a>
                            @endif
                        </div>
                    </div>

                    <!-- Secondary filter controls (Mounting, Featured, Sorting) -->
                    <div class="row g-3 align-items-center mt-2 pt-3 border-top">
                        <div class="col-lg-3 col-md-6">
                            <label class="form-label fw-bold small text-secondary mb-1">MOUNTING / ORIENTATION</label>
                            <select name="mounting" class="form-select form-select-sm">
                                <option value="">All Orientations</option>
                                @foreach($mountings as $mount)
                                    <option value="{{ $mount }}" {{ request('mounting') == $mount ? 'selected' : '' }}>{{ $mount }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-lg-3 col-md-6">
                            <label class="form-label fw-bold small text-secondary mb-1">SORT BY</label>
                            <select name="sort" class="form-select form-select-sm" onchange="this.form.submit()">
                                <option value="latest" {{ request('sort', 'latest') == 'latest' ? 'selected' : '' }}>Newest First</option>
                                <option value="featured" {{ request('sort') == 'featured' ? 'selected' : '' }}>Featured First</option>
                                <option value="name_asc" {{ request('sort') == 'name_asc' ? 'selected' : '' }}>Model Name (A - Z)</option>
                                <option value="name_desc" {{ request('sort') == 'name_desc' ? 'selected' : '' }}>Model Name (Z - A)</option>
                            </select>
                        </div>
                        <div class="col-lg-3 col-md-6 pt-md-3">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="featured" id="featuredOnlyCheck" value="1" {{ request('featured') == '1' ? 'checked' : '' }} onchange="this.form.submit()">
                                <label class="form-check-label fw-bold text-dark small" for="featuredOnlyCheck">
                                    ⭐ Show Featured Products Only
                                </label>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6 text-lg-end text-muted small pt-md-3">
                            Showing <strong>{{ $products->firstItem() ?? 0 }} - {{ $products->lastItem() ?? 0 }}</strong> of <strong>{{ $products->total() }}</strong> products
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <!-- Products Grid -->
        <div class="row">
            <div class="col-12">
                <div class="row g-4">
                    @forelse($products as $prod)
                        <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6" data-aos="fade-up">
                            <a href="{{ route('frontend.product.show', $prod->slug) }}" class="product-card text-decoration-none position-relative">
                                @if($prod->is_featured)
                                    <span class="position-absolute top-0 end-0 m-2 badge bg-danger text-white fw-bold shadow-sm" style="z-index: 5; font-size: 0.75rem; letter-spacing: 0.5px;">
                                        ⭐ FEATURED
                                    </span>
                                @endif
                                <div class="product-img">
                                    @if($prod->image_url)
                                        <img src="{{ $prod->image_url }}" alt="{{ $prod->model_name ?: $prod->sku_code }}" class="img-fluid" loading="lazy">
                                    @else
                                        <span class="ghost">{{ strtoupper(substr($prod->model_name ?: $prod->sku_code, 0, 1)) }}</span>
                                    @endif
                                </div>
                                <div class="product-body">
                                    <div class="d-flex justify-content-between align-items-center mb-1">
                                        <small class="text-danger fw-bold">{{ $prod->brand->name ?? 'Alabama' }}</small>
                                        @if($prod->capacity_l)
                                            <span class="badge bg-light text-dark border">{{ $prod->capacity_l }}L</span>
                                        @endif
                                    </div>
                                    <h3 class="mb-2">{{ $prod->model_name ?: $prod->sku_code }}</h3>
                                    @if($prod->subcategory)
                                        <p class="text-muted small mb-2">{{ $prod->subcategory->category->name ?? '' }} &bull; {{ $prod->subcategory->name }}</p>
                                    @endif
                                    <span class="product-link">
                                        View Specifications <i class="fa-solid fa-arrow-right-long"></i>
                                    </span>
                                </div>
                            </a>
                        </div>
                    @empty
                        <div class="col-12 text-center py-5">
                            <div class="p-5 bg-light rounded-3 border">
                                <i class="fa-solid fa-box-open fa-3x text-muted mb-3"></i>
                                <h3>No Products Found</h3>
                                <p class="text-muted">We couldn't find any products matching your selected search or filter criteria.</p>
                                <a href="{{ route('frontend.products.index') }}" class="btn btn-danger mt-2 fw-bold">View All Products</a>
                            </div>
                        </div>
                    @endforelse
                </div>

                <!-- Pagination -->
                @if($products->hasPages())
                    <div class="d-flex justify-content-center mt-5">
                        {{ $products->appends(request()->query())->links() }}
                    </div>
                @endif
            </div>
        </div>
    </div>
</section>

<!-- Need Help / Quote CTA -->
<section class="cta-section my-5">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-xl-8 col-md-6 col-lg-8">
                <h2 class="h-section text-center text-md-start">Need custom specifications or bulk supply? <span class="accent-i">Get in touch.</span></h2>                
            </div>
            <div class="col-xl-4 col-md-6 col-lg-4 text-lg-end text-center mt-2 mt-lg-0">
                <a class="btn solid" href="https://wa.me/971559138047?text=Hello%20Alabama%2C%20I%20need%20a%20quotation%20for%20project%20supplies." target="_blank" rel="noopener">
                    <i class="fa-brands fa-whatsapp me-1"></i> WhatsApp Sales
                </a>
            </div>
        </div>
    </div>
</section>

@endsection
