@extends('layouts.master')

@section('title', $blog->meta_title ?: $blog->title . ' - Alabama Insights')

@if($blog->meta_description)
@section('meta_description', $blog->meta_description)
@endif

@section('content')
<!-- Hero header -->
<section class="page-hero" data-aos="fade-up">
    <div class="container">
        <nav aria-label="breadcrumb" class="mb-4">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('frontend.home') }}" class="text-decoration-none">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ route('frontend.blog') }}" class="text-decoration-none">Blog</a></li>
                <li class="breadcrumb-item active" aria-current="page">{{ Str::limit($blog->title, 40) }}</li>
            </ol>
        </nav>
        <div class="row">
            <div class="col-xl-12">
                <div data-aos="zoom-in-up">
                    @if($blog->tag)
                        <div class="eyebrow">{{ $blog->tag }}</div>
                    @endif
                    <h1 class="h-section">{{ $blog->title }}</h1>
                    <p class="lede mw-100"><i class="fa-solid fa-calendar-days me-2"></i> Published on {{ $blog->created_at->format('F d, Y') }}</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Content Area -->
<section class="cdBlogDetail section py-5">
    <div class="container">
        <div class="row g-5">
            <!-- Main Content -->
            <div class="col-lg-8" data-aos="fade-up">
                <div class="card border-0 shadow-sm rounded-4 overflow-hidden bg-white p-4 p-md-5">
                    @if($blog->image_url)
                        <div class="mb-5 rounded-4 overflow-hidden shadow-sm" style="max-height: 450px;">
                            <img src="{{ $blog->image_url }}" alt="{{ $blog->title }}" class="w-100 h-100 object-fit-cover">
                        </div>
                    @endif
                    
                    <div class="blog-post-content text-dark fs-5 lh-lg">
                        {!! nl2br(e($blog->content)) !!}
                    </div>
                    
                    <hr class="my-5 border-light-subtle">
                    
                    <div class="d-flex justify-content-between align-items-center flex-wrap gap-3">
                        <a href="{{ route('frontend.blog') }}" class="btn btn-outline-primary rounded-pill px-4">
                            <i class="fa-solid fa-arrow-left me-2"></i> Back to Blogs
                        </a>
                        <div class="share-buttons d-flex align-items-center gap-2">
                            <span class="text-muted small">Share:</span>
                            <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(request()->fullUrl()) }}" target="_blank" class="btn btn-sm btn-light rounded-circle shadow-sm" aria-label="Facebook"><i class="fa-brands fa-facebook-f text-primary"></i></a>
                            <a href="https://api.whatsapp.com/send?text={{ urlencode($blog->title . ' ' . request()->fullUrl()) }}" target="_blank" class="btn btn-sm btn-light rounded-circle shadow-sm" aria-label="WhatsApp"><i class="fa-brands fa-whatsapp text-success"></i></a>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Sidebar -->
            <div class="col-lg-4" data-aos="fade-up" data-aos-delay="100">
                <!-- Recent Posts -->
                <div class="card border-0 shadow-sm rounded-4 p-4 bg-white mb-4">
                    <h4 class="fw-bold mb-4 text-dark border-bottom pb-2">Recent Insights</h4>
                    <div class="d-flex flex-column gap-4">
                        @forelse($recentBlogs as $recent)
                            <a href="{{ route('frontend.blog.show', $recent->slug) }}" class="text-decoration-none d-flex gap-3 align-items-start text-dark hover-translate-y">
                                @if($recent->image_url)
                                    <img src="{{ $recent->image_url }}" alt="{{ $recent->title }}" class="rounded shadow-sm" style="width: 80px; height: 80px; object-fit: cover;">
                                @else
                                    <div class="rounded bg-secondary-lt d-flex align-items-center justify-content-center text-muted small fw-bold" style="width: 80px; height: 80px; min-width: 80px;">No Image</div>
                                @endif
                                <div>
                                    <h6 class="fw-bold mb-1 line-clamp-2 text-dark">{{ $recent->title }}</h6>
                                    <span class="text-muted small">{{ $recent->created_at->format('M d, Y') }}</span>
                                </div>
                            </a>
                        @empty
                            <p class="text-muted small">No other recent articles found.</p>
                        @endforelse
                    </div>
                </div>

                <!-- Call to action card -->
                <div class="card border-0 shadow-sm rounded-4 p-4 text-white bg-dark">
                    <div class="card-body p-2">
                        <h4 class="fw-bold mb-3">Need Professional Advice?</h4>
                        <p class="small text-white-50 mb-4">Contact our team of experts for plumbing, water heating, and building materials inquiries in the UAE.</p>
                        <a href="{{ route('frontend.contact') }}" class="btn btn-primary w-100 rounded-pill fw-bold">Get In Touch</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
