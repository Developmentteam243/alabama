@extends('layouts.master')

@section('title', $product->meta_title ?: ($product->model_name ?: $product->sku_code) . ' - Alabama Portal')

@if($product->meta_description)
@section('meta_description', $product->meta_description)
@endif

@section('content')

@php
    $galleryItems = collect();
    
    // Add primary image if it exists
    if ($product->image_url) {
        $galleryItems->push([
            'type' => 'image',
            'url' => $product->image_url,
            'thumb' => $product->image_url
        ]);
    }

    // Add additional gallery images
    foreach ($product->images as $img) {
        $galleryItems->push([
            'type' => 'image',
            'url' => $img->image_url,
            'thumb' => $img->image_url
        ]);
    }

    // Add video if it exists
    if ($product->video_url) {
        $galleryItems->push([
            'type' => 'video',
            'url' => $product->getVideoEmbedUrl(),
            'raw_url' => $product->video_url,
            'thumb' => 'video' 
        ]);
    }
@endphp

<main id="page-product" class="page current">
  <section class="section" style="padding-top:70px">
    <div class="container">
      <!-- Breadcrumbs -->
      <nav aria-label="breadcrumb" class="mb-4">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="{{ route('frontend.home') }}" class="text-danger text-decoration-none">Home</a></li>
          @if($product->subcategory && $product->subcategory->category)
            <li class="breadcrumb-item"><a href="{{ route('frontend.category.show', $product->subcategory->category->slug) }}" class="text-danger text-decoration-none">{{ $product->subcategory->category->name }}</a></li>
            <li class="breadcrumb-item"><a href="{{ route('frontend.subcategory.show', [$product->subcategory->category->slug, $product->subcategory->slug]) }}" class="text-danger text-decoration-none">{{ $product->subcategory->name }}</a></li>
          @endif
          <li class="breadcrumb-item active" aria-current="page">{{ $product->model_name ?: $product->sku_code }}</li>
        </ol>
      </nav>

      <div class="pd-top row">
        <!-- Media / Image column -->
        <div class="col-lg-5 mb-4 mb-lg-0">
          <div id="main-media-viewer" class="pd-media border border-light-subtle rounded-3 p-4 bg-light d-flex align-items-center justify-content-center position-relative" style="height: 480px; overflow: hidden;">
            @if($galleryItems->isNotEmpty())
              @if($galleryItems->first()['type'] == 'image')
                <img id="main-image" src="{{ $galleryItems->first()['url'] }}" alt="{{ $product->model_name ?: $product->sku_code }}" class="img-fluid" style="max-height: 100%; width: auto; object-fit: contain;">
                <iframe id="main-video" src="" class="d-none w-100 h-100 border-0" allow="autoplay; encrypted-media" allowfullscreen></iframe>
                <video id="main-html-video" src="" controls class="d-none w-100 h-100" style="object-fit: contain;"></video>
              @else
                <img id="main-image" src="" alt="{{ $product->model_name ?: $product->sku_code }}" class="img-fluid d-none" style="max-height: 100%; width: auto; object-fit: contain;">
                @if(Str::contains($galleryItems->first()['url'], ['youtube.com', 'vimeo.com', 'youtube-nocookie.com', 'embed']))
                  <iframe id="main-video" src="{{ $galleryItems->first()['url'] }}" class="w-100 h-100 border-0" allow="autoplay; encrypted-media" allowfullscreen></iframe>
                  <video id="main-html-video" src="" controls class="d-none w-100 h-100" style="object-fit: contain;"></video>
                @else
                  <iframe id="main-video" src="" class="d-none w-100 h-100 border-0" allow="autoplay; encrypted-media" allowfullscreen></iframe>
                  <video id="main-html-video" src="{{ $galleryItems->first()['url'] }}" controls autoplay class="w-100 h-100" style="object-fit: contain;"></video>
                @endif
              @endif
            @else
              <span class="ghost display-1 text-muted fw-bold">{{ strtoupper(substr($product->model_name ?: $product->sku_code, 0, 1)) }}</span>
            @endif
          </div>

          <!-- Thumbnails Row -->
          @if($galleryItems->count() > 1)
            <div class="row g-2 mt-2" id="gallery-thumbnails">
              @foreach($galleryItems as $index => $item)
                <div class="col-3">
                  <div class="ratio ratio-1x1 border rounded-2 p-1 bg-light thumbnail-item {{ $index === 0 ? 'border-danger' : 'border-light-subtle' }}" 
                       style="cursor: pointer; overflow: hidden; transition: all 0.2s;"
                       data-type="{{ $item['type'] }}"
                       data-url="{{ $item['url'] }}">
                    @if($item['type'] == 'image')
                      <img src="{{ $item['thumb'] }}" alt="thumbnail" class="img-fluid rounded" style="object-fit: contain; max-height: 100%; width: 100%;">
                    @else
                      <div class="d-flex align-items-center justify-content-center bg-dark text-white rounded h-100 w-100">
                        <i class="fa fa-play-circle fa-2x"></i>
                      </div>
                    @endif
                  </div>
                </div>
              @endforeach
            </div>
          @endif
        </div>

        <!-- Info column -->
        <div class="col-lg-7 pd-info">
          <div class="eyebrow text-danger mb-2 fw-bold">{{ $product->brand->name ?? '' }} · {{ $product->subcategory->name ?? '' }} · {{ $product->brand->country_of_origin ?? 'Imported' }}</div>
          <h1 class="fw-bold mb-1">{{ $product->model_name ?: $product->sku_code }}</h1>
          
          @if($product->review_count > 0)
            <div class="d-flex align-items-center gap-2 mb-3">
              <div class="text-warning small">
                @for($i = 1; $i <= 5; $i++)
                  @if($i <= round($product->average_rating))
                    <i class="fa fa-star"></i>
                  @else
                    <i class="fa-regular fa-star"></i>
                  @endif
                @endfor
              </div>
              <span class="text-secondary small fw-bold">{{ $product->average_rating }} / 5 ({{ $product->review_count }} {{ Str::plural('review', $product->review_count) }})</span>
            </div>
          @endif

          <div class="pd-sku text-muted mb-4">SKU Family: {{ $product->product_family ?: $product->sku_code }}</div>
          
          <p class="pd-desc text-secondary mb-4">
            {{ $product->notes ?: 'Premium ' . ($product->model_name ?: $product->sku_code) . ' supplied by Alabama Building Materials Trading across the UAE.' }}
          </p>

          <h5 class="fw-bold mb-3">Key Features</h5>
          <ul class="pd-feats list-unstyled mb-4">
            @if($product->tank_protection_lining)
              <li class="py-2 border-bottom position-relative ps-4"><i class="fa-solid fa-check text-danger position-absolute start-0 top-50 translate-y-middle" style="transform: translateY(-50%);"></i> Tank protection: {{ $product->tank_protection_lining }}</li>
            @endif
            @if($product->heating_element)
              <li class="py-2 border-bottom position-relative ps-4"><i class="fa-solid fa-check text-danger position-absolute start-0 top-50 translate-y-middle" style="transform: translateY(-50%);"></i> Heating element: {{ $product->heating_element }}</li>
            @endif
            @if($product->warranty_yrs)
              <li class="py-2 border-bottom position-relative ps-4"><i class="fa-solid fa-check text-danger position-absolute start-0 top-50 translate-y-middle" style="transform: translateY(-50%);"></i> {{ $product->warranty_yrs }} years tank / element warranty</li>
            @endif
            @if($product->heating_power_kw)
              <li class="py-2 border-bottom position-relative ps-4"><i class="fa-solid fa-check text-danger position-absolute start-0 top-50 translate-y-middle" style="transform: translateY(-50%);"></i> Heating power: {{ $product->heating_power_kw }} kW</li>
            @endif
          </ul>

          <div class="pd-ctas d-flex gap-3 mb-5">
            <a class="btn btn-dark solid px-4 py-3" id="pd-quote" href="https://wa.me/971559138047?text=Hello%20Alabama%2C%20I%20am%20interested%20in%20{{ urlencode($product->model_name ?: $product->sku_code) }}%20(SKU:%20{{ $product->sku_code }})." target="_blank" rel="noopener">Get a quote</a>
            @if($product->brochure_url)
              <a class="btn btn-outline-secondary px-4 py-3" href="{{ $product->brochure_url }}" target="_blank" rel="noopener">Brochure ↓</a>
            @endif
            @if($product->techsheet_url)
              <a class="btn btn-outline-secondary px-4 py-3" href="{{ $product->techsheet_url }}" target="_blank" rel="noopener">Factsheet ↓</a>
            @endif
          </div>

          <div class="pd-section-label mb-3">
            <div class="eyebrow text-danger fw-bold">Specifications</div>
          </div>
          <table class="table spec-table table-bordered">
            <tbody>
              @if($product->heating_power_kw)
                <tr><td class="fw-semibold text-secondary">Heating Power</td><td>{{ $product->heating_power_kw }} kW</td></tr>
              @endif
              @if($product->voltage)
                <tr><td class="fw-semibold text-secondary">Voltage</td><td>{{ $product->voltage }}</td></tr>
              @endif
              @if($product->max_working_pressure_bar)
                <tr><td class="fw-semibold text-secondary">Max Working Pressure</td><td>{{ $product->max_working_pressure_bar }} bar</td></tr>
              @endif
              @if($product->tank_protection_lining)
                <tr><td class="fw-semibold text-secondary">Tank Protection</td><td>{{ $product->tank_protection_lining }}</td></tr>
              @endif
              @if($product->heating_element)
                <tr><td class="fw-semibold text-secondary">Heating Element</td><td>{{ $product->heating_element }}</td></tr>
              @endif
              @if($product->warranty_yrs)
                <tr><td class="fw-semibold text-secondary">Warranty</td><td>{{ $product->warranty_yrs }} Years</td></tr>
              @endif
            </tbody>
          </table>
        </div>
      </div>

      <!-- Variants block -->
      @if($variants->count() > 1)
        <div class="pd-section-label mt-5 mb-4">
          <div class="eyebrow text-danger fw-bold">Models &amp; sizes</div>
          <h2 class="h-section fw-bold mt-2">Choose your <span class="accent-i text-danger">model</span></h2>
        </div>
        
        <div class="variants-wrap vp card border-0 p-4 bg-light mb-5">
          <div class="mb-4">
            <label for="pd-vselect" class="form-label fw-semibold">Select a model</label>
            <div class="vp-row d-flex gap-3 align-items-center">
              <select id="pd-vselect" class="form-select" onchange="selectVariant(this.value)">
                @foreach($variants as $index => $variant)
                  <option value="{{ $index }}">{{ $variant->model_name ?: $variant->sku_code }} — {{ $variant->capacity_l ? $variant->capacity_l . ' L' : ($variant->orientation_mounting ?: 'Standard') }}</option>
                @endforeach
              </select>
              <a class="btn btn-danger px-4 py-2" id="pd-venquire" href="#" target="_blank" rel="noopener">Enquire</a>
            </div>
          </div>
          <table class="table spec-table table-bordered bg-white" id="pd-vdetail">
            <!-- Dynamic via JavaScript -->
          </table>
        </div>
      @endif

      <!-- Related Products Section -->
      @if($relatedProducts->isNotEmpty())
        <div class="pd-section-label mt-5 mb-4">
          <div class="eyebrow text-danger fw-bold">Recommended</div>
          <h2 class="h-section fw-bold mt-2">Related <span class="accent-i text-danger">Products</span></h2>
        </div>
        <div class="row g-4 mb-5">
          @foreach($relatedProducts as $rel)
            <div class="col-xl-3 col-md-6 col-lg-3 col-sm-6">
              <a href="{{ route('frontend.product.show', $rel->slug) }}" class="product-card text-decoration-none border rounded-3 p-3 d-block bg-white hover-shadow transition">
                <div class="product-img mb-3 text-center d-flex align-items-center justify-content-center bg-light rounded" style="height: 200px;">
                  @if($rel->image_url)
                    <img src="{{ $rel->image_url }}" alt="{{ $rel->model_name ?: $rel->sku_code }}" class="img-fluid" style="max-height: 100%; object-fit: contain;">
                  @else
                    <span class="ghost text-muted display-4">{{ strtoupper(substr($rel->model_name ?: $rel->sku_code, 0, 1)) }}</span>
                  @endif
                </div>
                <div class="product-body">
                  <small class="text-danger fw-bold uppercase" style="font-size: 0.8rem;">{{ $rel->brand->name ?? '' }}</small>
                  <h3 class="h6 text-dark fw-bold text-truncate mt-1">{{ $rel->model_name ?: $rel->sku_code }}</h3>
                  <span class="product-link text-danger fw-semibold d-inline-block mt-2" style="font-size: 0.9rem;">
                    View product <i class="fa-solid fa-arrow-right-long"></i>
                  </span>
                </div>
              </a>
            </div>
          @endforeach
        </div>
      @endif

      <!-- Reviews Section -->
      <div class="row mt-5 border-top pt-5" id="customer-reviews">
        <div class="col-lg-12 mb-4">
          <div class="pd-section-label">
            <div class="eyebrow text-danger fw-bold">Feedback</div>
            <h2 class="h-section fw-bold mt-2">Customer <span class="accent-i text-danger">Reviews</span></h2>
          </div>
        </div>

        @if(session('success_review'))
          <div class="col-12">
            <div class="alert alert-success alert-dismissible fade show" role="alert">
              {{ session('success_review') }}
              <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
          </div>
        @endif

        <!-- Summary & Write Review Form -->
        <div class="col-lg-5 mb-5 mb-lg-0">
          <div class="card border-0 bg-light p-4 rounded-3">
            <div class="mb-4">
              <h3 class="fw-bold mb-1">Average Rating</h3>
              <div class="d-flex align-items-center gap-3">
                <span class="display-3 fw-bold text-dark m-0">{{ $product->average_rating }}</span>
                <div>
                  <div class="text-warning">
                    @for($i = 1; $i <= 5; $i++)
                      @if($i <= round($product->average_rating))
                        <i class="fa fa-star"></i>
                      @else
                        <i class="fa-regular fa-star"></i>
                      @endif
                    @endfor
                  </div>
                  <span class="text-muted small">Based on {{ $product->review_count }} {{ Str::plural('review', $product->review_count) }}</span>
                </div>
              </div>
            </div>

            <!-- Submit Review Form -->
            <form action="{{ route('frontend.reviews.store', $product->id) }}" method="POST" class="mt-3">
              @csrf
              <h4 class="fw-bold mb-3">Write a Review</h4>
              
              <div class="mb-3">
                <label class="form-label fw-semibold">Your Rating</label>
                <div class="star-rating d-flex gap-2 fs-3 text-secondary" style="cursor:pointer;">
                  <span class="star-select" data-rating="1"><i class="fa fa-star"></i></span>
                  <span class="star-select" data-rating="2"><i class="fa fa-star"></i></span>
                  <span class="star-select" data-rating="3"><i class="fa fa-star"></i></span>
                  <span class="star-select" data-rating="4"><i class="fa fa-star"></i></span>
                  <span class="star-select" data-rating="5"><i class="fa fa-star"></i></span>
                </div>
                <input type="hidden" name="rating" id="review-rating-val" value="" required>
                @error('rating')
                  <small class="text-danger d-block mt-1">{{ $message }}</small>
                @enderror
              </div>

              <div class="mb-3">
                <label for="review-name" class="form-label fw-semibold">Your Name</label>
                <input type="text" name="customer_name" id="review-name" class="form-control" placeholder="e.g. John Doe" required>
              </div>

              <div class="mb-3">
                <label for="review-email" class="form-label fw-semibold">Your Email</label>
                <input type="email" name="customer_email" id="review-email" class="form-control" placeholder="e.g. john@example.com" required>
              </div>

              <div class="mb-3">
                <label for="review-comment" class="form-label fw-semibold">Your Review</label>
                <textarea name="comment" id="review-comment" rows="4" class="form-control" placeholder="Share your experience with this product..." required></textarea>
              </div>

              <button type="submit" class="btn btn-danger px-4 py-2 w-100 fw-bold">Submit Review</button>
            </form>
          </div>
        </div>

        <!-- Reviews List -->
        <div class="col-lg-7">
          <div class="ps-lg-4">
            <h3 class="fw-bold mb-4">Reviews ({{ $product->review_count }})</h3>
            
            @forelse($product->reviews as $rev)
              <div class="mb-4 pb-4 border-bottom">
                <div class="d-flex justify-content-between align-items-start">
                  <div>
                    <h5 class="fw-bold mb-1">{{ $rev->customer_name }}</h5>
                    <div class="text-warning small mb-2">
                      @for($i = 1; $i <= 5; $i++)
                        @if($i <= $rev->rating)
                          <i class="fa fa-star"></i>
                        @else
                          <i class="fa-regular fa-star"></i>
                        @endif
                      @endfor
                    </div>
                  </div>
                  <span class="text-muted small">{{ $rev->created_at->format('M d, Y') }}</span>
                </div>
                <p class="text-secondary mb-0" style="white-space: pre-line;">{{ $rev->comment }}</p>
              </div>
            @empty
              <div class="text-center py-5 text-muted">
                <i class="fa-solid fa-comments fa-3x mb-3 text-secondary opacity-50"></i>
                <p class="mb-0">No reviews yet for this product. Be the first to share your thoughts!</p>
              </div>
            @endforelse
          </div>
        </div>

      </div>

    </div>
  </section>

  <!-- CTA section -->
  <section class="section tint bg-light py-5">
    <div class="container d-flex justify-content-between align-items-center gap-3 flex-wrap">
      <h2 class="h-section fw-bold m-0" style="max-width:560px">Need a spec sheet or project pricing? <span class="accent-i text-danger">Ask our team.</span></h2>
      <a class="btn btn-dark px-4 py-3 solid" id="pd-quote2" href="https://wa.me/971559138047?text=Hello%20Alabama%2C%20I%20need%20assistance%20with%20{{ urlencode($product->model_name ?: $product->sku_code) }}." target="_blank" rel="noopener">WhatsApp sales</a>
    </div>
  </section>
</main>

<script>
    const VARIANTS = @json($variants);
    function selectVariant(index) {
        const variant = VARIANTS[index];
        if (!variant) return;
        
        let detailHtml = '';
        if (variant.capacity_l) detailHtml += `<tr><td class="fw-semibold text-secondary">Capacity</td><td>${variant.capacity_l} L</td></tr>`;
        if (variant.orientation_mounting) detailHtml += `<tr><td class="fw-semibold text-secondary">Mounting</td><td>${variant.orientation_mounting}</td></tr>`;
        if (variant.height_length_mm || variant.diameter_width_mm) {
            detailHtml += `<tr><td class="fw-semibold text-secondary">Dimensions (H × Ø)</td><td>${variant.height_length_mm || '—'} × ${variant.diameter_width_mm || '—'} mm</td></tr>`;
        }
        detailHtml += `<tr><td class="fw-semibold text-secondary">SKU Reference</td><td class="text-danger fw-bold">${variant.sku_code}</td></tr>`;
        
        document.getElementById('pd-vdetail').innerHTML = detailHtml;
        
        const message = `Hello Alabama, I am interested in ${variant.model_name || variant.sku_code} (SKU: ${variant.sku_code}). Please share pricing and details.`;
        document.getElementById('pd-venquire').href = `https://wa.me/971559138047?text=${encodeURIComponent(message)}`;
    }
    
    document.addEventListener('DOMContentLoaded', () => {
        if (VARIANTS.length > 0) {
            selectVariant(0);
        }

        // Gallery thumbnail switcher logic
        const mainImg = document.getElementById('main-image');
        const mainVid = document.getElementById('main-video');
        const mainHtmlVid = document.getElementById('main-html-video');
        const thumbnails = document.querySelectorAll('.thumbnail-item');

        thumbnails.forEach(thumb => {
            thumb.addEventListener('click', function () {
                // Remove active border from all thumbnails
                thumbnails.forEach(t => {
                    t.classList.remove('border-danger');
                    t.classList.add('border-light-subtle');
                });
                
                // Add active border to clicked thumbnail
                this.classList.remove('border-light-subtle');
                this.classList.add('border-danger');

                const type = this.getAttribute('data-type');
                const url = this.getAttribute('data-url');

                if (type === 'image') {
                    if (mainImg) {
                        mainImg.src = url;
                        mainImg.classList.remove('d-none');
                    }
                    if (mainVid) {
                        mainVid.classList.add('d-none');
                        mainVid.src = '';
                    }
                    if (mainHtmlVid) {
                        mainHtmlVid.classList.add('d-none');
                        mainHtmlVid.src = '';
                    }
                } else if (type === 'video') {
                    if (mainImg) mainImg.classList.add('d-none');
                    
                    const isEmbed = url.includes('youtube.com') || url.includes('vimeo.com') || url.includes('youtube-nocookie.com') || url.includes('embed');
                    if (isEmbed) {
                        if (mainVid) {
                            mainVid.src = url;
                            mainVid.classList.remove('d-none');
                        }
                        if (mainHtmlVid) {
                            mainHtmlVid.classList.add('d-none');
                            mainHtmlVid.src = '';
                        }
                    } else {
                        if (mainHtmlVid) {
                            mainHtmlVid.src = url;
                            mainHtmlVid.classList.remove('d-none');
                        }
                    }
                }
            });
        });
        // Star rating selector logic
        const stars = document.querySelectorAll('.star-select');
        const ratingInput = document.getElementById('review-rating-val');
        if (stars.length > 0 && ratingInput) {
            stars.forEach(star => {
                star.addEventListener('click', function () {
                    const rating = this.getAttribute('data-rating');
                    ratingInput.value = rating;
                    
                    // Highlight selected stars
                    stars.forEach(s => {
                        const sVal = s.getAttribute('data-rating');
                        if (sVal <= rating) {
                            s.classList.remove('text-secondary');
                            s.classList.add('text-warning');
                        } else {
                            s.classList.remove('text-warning');
                            s.classList.add('text-secondary');
                        }
                    });
                });
            });
        }
    });
</script>

@endsection
