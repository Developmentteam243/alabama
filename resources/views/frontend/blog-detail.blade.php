@extends('layouts.master')

@section('title', $blog->meta_title ?: $blog->title . ' - Alabama Insights')

@if($blog->meta_description)
@section('meta_description', $blog->meta_description)
@endif

@section('meta_tags')
    <!-- OpenGraph Meta Tags -->
    <meta property="og:type" content="article">
    <meta property="og:title" content="{{ $blog->og_title ?: ($blog->meta_title ?: $blog->title) }}">
    <meta property="og:description" content="{{ $blog->og_description ?: ($blog->meta_description ?: ($blog->excerpt ?: Str::limit(strip_tags($blog->content), 150))) }}">
    <meta property="og:url" content="{{ request()->fullUrl() }}">
    <meta property="og:image" content="{{ $blog->og_image_url ?: ($blog->image_url ?: url('assets/images/logo.webp')) }}">
    <meta property="article:published_time" content="{{ $blog->published_at ? $blog->published_at->toIso8601String() : $blog->created_at->toIso8601String() }}">
    <meta property="article:author" content="{{ $blog->author_name ?: 'Alabama Building Materials' }}">
    @if($blog->primary_keyword)
        <meta name="keywords" content="{{ $blog->primary_keyword }}{{ $blog->secondary_keywords ? ', ' . $blog->secondary_keywords : '' }}">
    @endif

    <!-- Twitter Card Meta Tags -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="{{ $blog->twitter_title ?: ($blog->og_title ?: $blog->title) }}">
    <meta name="twitter:description" content="{{ $blog->twitter_description ?: ($blog->og_description ?: ($blog->meta_description ?: $blog->excerpt)) }}">
    <meta name="twitter:image" content="{{ $blog->og_image_url ?: ($blog->image_url ?: url('assets/images/logo.webp')) }}">
@endsection

@section('schema_markup')
    @if(!empty($blog->schema_markup))
        <script type="application/ld+json">
            {!! $blog->schema_markup !!}
        </script>
    @else
        <!-- Automated Article Schema -->
        <script type="application/ld+json">
        {
            "@context": "https://schema.org",
            "@type": "Article",
            "headline": {{ json_encode($blog->title) }},
            "description": {{ json_encode($blog->meta_description ?: ($blog->excerpt ?: Str::limit(strip_tags($blog->content), 150))) }},
            "image": [{{ json_encode($blog->image_url ?: url('assets/images/logo.webp')) }}],
            "datePublished": "{{ $blog->published_at ? $blog->published_at->toIso8601String() : $blog->created_at->toIso8601String() }}",
            "dateModified": "{{ $blog->updated_at->toIso8601String() }}",
            "author": {
                "@type": "Person",
                "name": {{ json_encode($blog->author_name ?: 'Alabama Team') }}
            },
            "publisher": {
                "@type": "Organization",
                "name": "Alabama Building Materials Trading L.L.C.",
                "logo": {
                    "@type": "ImageObject",
                    "url": "{{ url('assets/images/logo.webp') }}"
                }
            },
            "mainEntityOfPage": {
                "@type": "WebPage",
                "@id": "{{ request()->fullUrl() }}"
            }
        }
        </script>

        @if(!empty($blog->faqs) && is_array($blog->faqs) && count($blog->faqs) > 0)
        <!-- Automated FAQPage Schema -->
        <script type="application/ld+json">
        {
            "@context": "https://schema.org",
            "@type": "FAQPage",
            "mainEntity": [
                @foreach($blog->faqs as $fIndex => $faq)
                {
                    "@type": "Question",
                    "name": {{ json_encode($faq['question'] ?? '') }},
                    "acceptedAnswer": {
                        "@type": "Answer",
                        "text": {{ json_encode($faq['answer'] ?? '') }}
                    }
                }{{ !$loop->last ? ',' : '' }}
                @endforeach
            ]
        }
        </script>
        @endif
    @endif
@endsection

@section('content')
<!-- Hero header -->
<section class="page-hero" data-aos="fade-up">
    <div class="container">
        <nav aria-label="breadcrumb" class="mb-4">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('frontend.home') }}" class="text-decoration-none">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ route('frontend.blog') }}" class="text-decoration-none">Insights</a></li>
                <li class="breadcrumb-item active" aria-current="page">{{ Str::limit($blog->title, 40) }}</li>
            </ol>
        </nav>
        <div class="row">
            <div class="col-xl-12">
                <div data-aos="zoom-in-up">
                    @if($blog->tag)
                        <div class="d-flex flex-wrap gap-2 mb-2">
                            @foreach(explode(',', $blog->tag) as $tag)
                                <span class="badge bg-danger px-3 py-2 text-white" style="letter-spacing: 0.5px;">{{ trim($tag) }}</span>
                            @endforeach
                        </div>
                    @endif
                    <h1 class="h-section">{{ $blog->title }}</h1>
                    <div class="d-flex flex-wrap align-items-center gap-3 text-muted mt-3">
                        <span><i class="fa-solid fa-user me-1 text-danger"></i> {{ $blog->author_name ?: 'Alabama Team' }}</span>
                        <span>·</span>
                        <span><i class="fa-solid fa-calendar-days me-1 text-danger"></i> {{ $blog->published_at ? $blog->published_at->format('F d, Y') : $blog->created_at->format('F d, Y') }}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Content Area -->
<section class="cdBlogDetail section py-5">
    <div class="container">
        <div class="row g-5">
            <!-- Main Article Column -->
            <div class="col-lg-8" data-aos="fade-up">
                <article class="card border-0 shadow-sm rounded-4 overflow-hidden bg-white p-4 p-md-5">
                    @if($blog->image_url)
                        <div class="mb-4 rounded-4 overflow-hidden shadow-sm" style="max-height: 480px;">
                            <img src="{{ $blog->image_url }}" alt="{{ $blog->image_alt ?: $blog->title }}" class="w-100 h-100 object-fit-cover" loading="eager">
                        </div>
                    @endif

                    @if($blog->excerpt)
                        <div class="p-3 mb-4 rounded-3 bg-light border-start border-4 border-danger">
                            <p class="mb-0 fs-6 fw-semibold text-secondary fst-italic">{{ $blog->excerpt }}</p>
                        </div>
                    @endif
                    
                    <!-- Blog Body (Formatted HTML) -->
                    <div class="blog-post-content text-dark fs-5 lh-lg article-body">
                        {!! $blog->content !!}
                    </div>

                    <!-- FAQs Section if available -->
                    @if(!empty($blog->faqs) && is_array($blog->faqs) && count($blog->faqs) > 0)
                        <div class="mt-5 pt-4 border-top">
                            <h3 class="fw-bold mb-4 text-dark"><i class="fa-solid fa-circle-question text-danger me-2"></i> Frequently Asked Questions</h3>
                            <div class="accordion" id="blogFaqAccordion">
                                @foreach($blog->faqs as $fIndex => $faq)
                                    <div class="accordion-item mb-2 border rounded-3 overflow-hidden shadow-sm">
                                        <h2 class="accordion-header" id="faqHeading{{ $fIndex }}">
                                            <button class="accordion-button {{ $fIndex !== 0 ? 'collapsed' : '' }} fw-bold" type="button" data-bs-toggle="collapse" data-bs-target="#faqCollapse{{ $fIndex }}" aria-expanded="{{ $fIndex === 0 ? 'true' : 'false' }}" aria-controls="faqCollapse{{ $fIndex }}">
                                                {{ $faq['question'] ?? '' }}
                                            </button>
                                        </h2>
                                        <div id="faqCollapse{{ $fIndex }}" class="accordion-collapse collapse {{ $fIndex === 0 ? 'show' : '' }}" aria-labelledby="faqHeading{{ $fIndex }}" data-bs-parent="#blogFaqAccordion">
                                            <div class="accordion-body text-secondary fs-6">
                                                {!! nl2br(e($faq['answer'] ?? '')) !!}
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endif

                    <!-- Related Products Widget if available -->
                    @if($blog->related_products->isNotEmpty())
                        <div class="mt-5 pt-4 border-top">
                            <h3 class="fw-bold mb-4 text-dark"><i class="fa-solid fa-boxes-stacked text-danger me-2"></i> Featured Products in this Guide</h3>
                            <div class="row g-3">
                                @foreach($blog->related_products as $product)
                                    <div class="col-md-6">
                                        <div class="card h-100 border p-3 rounded-3 shadow-sm d-flex flex-column justify-content-between">
                                            <div class="d-flex gap-3 align-items-center mb-3">
                                                @if($product->image_url)
                                                    <img src="{{ $product->image_url }}" alt="{{ $product->model_name ?: $product->sku_code }}" style="width: 70px; height: 70px; object-fit: contain;">
                                                @else
                                                    <div class="bg-light rounded d-flex align-items-center justify-content-center text-muted fw-bold" style="width: 70px; height: 70px;">Item</div>
                                                @endif
                                                <div>
                                                    <span class="badge bg-secondary-lite text-secondary small">{{ $product->brand->name ?? 'Alabama' }}</span>
                                                    <h5 class="mb-0 mt-1 fw-bold text-dark">{{ $product->model_name ?: $product->sku_code }}</h5>
                                                </div>
                                            </div>
                                            <div class="d-flex justify-content-between align-items-center mt-2">
                                                <a href="{{ route('frontend.product.show', $product->slug) }}" class="btn btn-sm btn-outline-dark">View Details</a>
                                                <a href="{{ route('frontend.contact') }}?product={{ urlencode($product->model_name ?: $product->sku_code) }}" class="btn btn-sm btn-danger">Get Quote</a>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endif
                    
                    <hr class="my-5 border-light-subtle">
                    
                    <!-- Share & Back Actions -->
                    <div class="d-flex justify-content-between align-items-center flex-wrap gap-3">
                        <a href="{{ route('frontend.blog') }}" class="btn btn-outline-primary rounded-pill px-4">
                            <i class="fa-solid fa-arrow-left me-2"></i> Back to Insights
                        </a>
                        <div class="share-buttons d-flex align-items-center gap-2">
                            <span class="text-muted small fw-bold">Share:</span>
                            <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(request()->fullUrl()) }}" target="_blank" rel="noopener" class="btn btn-sm btn-light rounded-circle shadow-sm" aria-label="Facebook"><i class="fa-brands fa-facebook-f text-primary"></i></a>
                            <a href="https://api.whatsapp.com/send?text={{ urlencode($blog->title . ' ' . request()->fullUrl()) }}" target="_blank" rel="noopener" class="btn btn-sm btn-light rounded-circle shadow-sm" aria-label="WhatsApp"><i class="fa-brands fa-whatsapp text-success"></i></a>
                            <a href="https://www.linkedin.com/sharing/share-offsite/?url={{ urlencode(request()->fullUrl()) }}" target="_blank" rel="noopener" class="btn btn-sm btn-light rounded-circle shadow-sm" aria-label="LinkedIn"><i class="fa-brands fa-linkedin-in text-info"></i></a>
                        </div>
                    </div>
                </article>
            </div>
            
            <!-- Sidebar -->
            <div class="col-lg-4" data-aos="fade-up" data-aos-delay="100">
                <!-- Related / Recommended Insights -->
                <div class="card border-0 shadow-sm rounded-4 p-4 bg-white mb-4">
                    <h4 class="fw-bold mb-4 text-dark border-bottom pb-2">Related Insights</h4>
                    <div class="d-flex flex-column gap-4">
                        @php
                            $relatedOrRecent = $blog->related_blogs->isNotEmpty() ? $blog->related_blogs : $recentBlogs;
                        @endphp
                        @forelse($relatedOrRecent as $recent)
                            <a href="{{ route('frontend.blog.show', $recent->slug) }}" class="text-decoration-none d-flex gap-3 align-items-start text-dark hover-translate-y">
                                @if($recent->image_url)
                                    <img src="{{ $recent->image_url }}" alt="{{ $recent->image_alt ?: $recent->title }}" class="rounded shadow-sm" style="width: 80px; height: 80px; object-fit: cover;">
                                @else
                                    <div class="rounded bg-secondary-lt d-flex align-items-center justify-content-center text-muted small fw-bold" style="width: 80px; height: 80px; min-width: 80px;">No Image</div>
                                @endif
                                <div>
                                    <h6 class="fw-bold mb-1 line-clamp-2 text-dark">{{ $recent->title }}</h6>
                                    <span class="text-muted small">{{ $recent->published_at ? $recent->published_at->format('M d, Y') : $recent->created_at->format('M d, Y') }}</span>
                                </div>
                            </a>
                        @empty
                            <p class="text-muted small">No related articles found.</p>
                        @endforelse
                    </div>
                </div>

                <!-- Call to action card -->
                <div class="card border-0 shadow-sm rounded-4 p-4 text-white bg-dark">
                    <div class="card-body p-2">
                        <h4 class="fw-bold mb-3">Looking for Project Supply?</h4>
                        <p class="small text-white-50 mb-4">Talk with Alabama specialists for commercial rates on project-approved water heaters, valves, pumps, and sanitaryware in Dubai &amp; UAE.</p>
                        <a href="{{ route('frontend.contact') }}" class="btn btn-danger w-100 rounded-pill fw-bold">Get In Touch</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
