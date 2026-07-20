@extends('layouts.master')

@section('title', ($product->model_name ?: $product->sku_code) . ' - Alabama Portal')

@section('content')

<main id="page-product" class="page current">
  <section class="section" style="padding-top:70px">
    <div class="container">
      <div class="pd-top row">
        <!-- Media / Image column -->
        <div class="col-lg-5 mb-4 mb-lg-0">
          <div class="pd-media border border-light-subtle rounded-3 p-4 bg-light d-flex align-items-center justify-content-center" style="height: 480px;">
            @if($product->image_url)
              <img src="{{ $product->image_url }}" alt="{{ $product->model_name ?: $product->sku_code }}" class="img-fluid" style="max-height: 100%; width: auto; object-fit: contain;">
            @else
              <span class="ghost display-1 text-muted fw-bold">{{ strtoupper(substr($product->model_name ?: $product->sku_code, 0, 1)) }}</span>
            @endif
          </div>
        </div>

        <!-- Info column -->
        <div class="col-lg-7 pd-info">
          <div class="eyebrow text-danger mb-2 fw-bold">{{ $product->brand->name ?? '' }} · {{ $product->subcategory->name ?? '' }} · {{ $product->brand->country_of_origin ?? 'Imported' }}</div>
          <h1 class="fw-bold mb-2">{{ $product->model_name ?: $product->sku_code }}</h1>
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
    });
</script>

@endsection
