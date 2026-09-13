@extends('layouts.master')

@section('title', 'Insights & Guides - Alabama Building Materials')
@section('meta_description', 'Practical advice, guides and technical insights on water heaters, piping, valves, and plumbing supplies in the UAE.')

@section('content')

<!-- Header -->
<section class="page-hero" data-aos="fade-up">
    <div class="container">
        <div class="row">
            <div class="col-xl-12">
                <div data-aos="zoom-in-up">
                    <div class="eyebrow">Insights &amp; Knowledge</div>
                    <h1 class="h-section">Guides from the <span class="accent-i">supply line.</span></h1>
                    <p class="lede mw-100">Practical advice on water heating, plumbing systems and sanitaryware for UAE homeowners, MEP contractors, and consultants.</p>
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
                <div class="blog-grid">
                    @forelse($blogs as $post)
                        <a class="post rv" href="{{ route('frontend.blog.show', $post->slug) }}">
                            <div class="pi">
                                <img src="{{ $post->image_url ?: 'https://alabamauae.com/wp-content/uploads/2026/01/hot-water-system.webp' }}" alt="{{ $post->image_alt ?: $post->title }}" loading="lazy" />
                            </div>
                            <div class="pc">
                                <div class="meta">
                                    @if($post->tag)
                                        <span class="tagpill">{{ explode(',', $post->tag)[0] }}</span>
                                    @endif
                                    <span class="date">{{ $post->published_at ? $post->published_at->format('M d, Y') : $post->created_at->format('M d, Y') }}</span>
                                </div>
                                <h3>{{ $post->title }}</h3>
                                <p>{{ $post->excerpt ?: Str::limit(strip_tags($post->content), 140) }}</p>
                                <span class="link-arrow">Read more <i class="fa-solid fa-arrow-right-long"></i></span>
                            </div>
                        </a>
                    @empty
                        <div class="w-100 text-center py-5">
                            <h3 class="text-muted">No articles published yet.</h3>
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

{{-- GSAP Animations --}}
<script src="{{ url('assets/js/gsap.min.js') }}"></script>
<script src="{{ url('assets/js/ScrollTrigger.min.js') }}"></script>
<script>
    if (typeof gsap !== 'undefined' && typeof ScrollTrigger !== 'undefined') {
        gsap.registerPlugin(ScrollTrigger);
        gsap.utils.toArray(".post.rv").forEach((card) => {
            const tl = gsap.timeline({
                scrollTrigger: {
                    trigger: card,
                    start: "top 85%",
                    toggleActions: "play none none reverse",
                },
            });

            tl.from(card.querySelector(".pi img"), {
                scale: 1.15,
                opacity: 0,
                duration: 0.8,
                ease: "power3.out",
            })
            .from(card.querySelector(".meta"), { y: 20, opacity: 0, duration: 0.3 }, "-=0.4")
            .from(card.querySelector("h3"), { y: 20, opacity: 0, duration: 0.4 }, "-=0.2")
            .from(card.querySelector("p"), { y: 15, opacity: 0, duration: 0.4 }, "-=0.2")
            .from(card.querySelector(".link-arrow"), { x: -15, opacity: 0, duration: 0.3 }, "-=0.2");
        });
    }
</script>
@endsection
