@extends('layouts.master')

@section('title', 'Catalog - Alabama Portal')

@section('content')

<!-- Header -->
<section class="page-hero" data-aos="fade-up">
    <div class="container">
        <div class="row">
            <div class="col-xl-12">
                <div data-aos="zoom-in-up">
                    <div class="eyebrow">Insights</div>
                    <h1 class="h-section">Guides from the <span class="accent-i">supply line.</span></h1>
                    <p class="lede mw-100">Practical advice on heating, plumbing and sanitaryware for UAE homes, contractors and consultants.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- blog -->
<section class="cdBlog section">
    <div class="container">
        <div class="row">
            <div class="col-xl-12">
                <div class="blog-grid" data-aos="fade-up" data-aos-duration="2000">
                    @forelse($blogs as $post)
                        <a class="post" href="{{ route('frontend.blog.show', $post->slug) }}">
                            <div class="pi">
                                <img src="{{ $post->image_url ?: 'https://alabamauae.com/wp-content/uploads/2026/01/hot-water-system.webp' }}" alt="{{ $post->title }}" />
                            </div>
                            <div class="pc">
                                <div class="meta">
                                    @if($post->tag)
                                        <span class="tagpill">{{ $post->tag }}</span>
                                    @endif
                                    <span class="date">{{ $post->created_at->format('F d, Y') }}</span>
                                </div>
                                <h3>{{ $post->title }}</h3>
                                <p>{{ Str::limit(strip_tags($post->content), 150) }}</p>
                                <span class="link-arrow">Read more <i class="fa-solid fa-arrow-right-long"></i></span>
                            </div>
                        </a>
                    @empty
                        <div class="w-100 text-center py-5">
                            <h3 class="text-muted">No articles found.</h3>
                            <p>Stay tuned! Our experts are preparing updates from the supply line.</p>
                        </div>
                    @endforelse
                </div>

                @if($blogs->hasPages())
                    <div class="d-flex justify-content-center mt-5">
                        {{ $blogs->links() }}
                    </div>
                @endif
            </div>
        </div>
    </div>
</section>

@endsection
