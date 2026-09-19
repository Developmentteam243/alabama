@extends('tablar::page')

@section('title', 'Site & Tracking Settings')

@section('content')
<div class="page-header d-print-none">
    <div class="container-xl">
        <div class="row g-2 align-items-center">
            <div class="col">
                <div class="page-pretitle">Administration</div>
                <h2 class="page-title">Site & Tracking Settings</h2>
            </div>
        </div>
    </div>
</div>

<div class="page-body">
    <div class="container-xl">
        @if(session('success'))
            <div class="alert alert-success alert-dismissible" role="alert">
                <div>{{ session('success') }}</div>
                <a class="btn-close" data-bs-dismiss="alert" aria-label="close"></a>
            </div>
        @endif

        <div class="card">
            <div class="card-header">
                <ul class="nav nav-tabs card-header-tabs" data-bs-toggle="tabs">
                    <li class="nav-item">
                        <a href="#tabs-banner" class="nav-link active" data-bs-toggle="tab">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon me-2" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                <path d="M3 19l18 0" />
                                <path d="M5 6m0 1a1 1 0 0 1 1 -1h12a1 1 0 0 1 1 1v8a1 1 0 0 1 -1 1h-12a1 1 0 0 1 -1 -1z" />
                            </svg>
                            Homepage Hero Banner
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#tabs-whoweare" class="nav-link" data-bs-toggle="tab">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon me-2" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                <path d="M12 12m-9 0a9 9 0 1 0 18 0a9 9 0 1 0 -18 0" />
                                <path d="M9 12l2 2l4 -4" />
                            </svg>
                            Who We Are (Built on Quality)
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#tabs-tracking" class="nav-link" data-bs-toggle="tab">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon me-2" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                <path d="M3 12a9 9 0 1 0 18 0a9 9 0 0 0 -18 0" />
                                <path d="M12 9h.01" />
                                <path d="M11 12h1v4h1" />
                            </svg>
                            Server-Side Tracking (ServerGTM, GA4, Clarity, Pixel)
                        </a>
                    </li>
                </ul>
            </div>
            
            <form action="{{ route('settings.update') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="card-body">
                    <div class="tab-content">
                        <!-- Homepage Hero Banner Tab -->
                        <div class="tab-pane active show" id="tabs-banner">
                            <h3 class="card-title mb-3">Homepage Hero Banner Content</h3>
                            <div class="row row-cards">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label">Hero Eyebrow Text</label>
                                        <input type="text" name="hero_eyebrow" class="form-control" value="{{ $settings['hero_eyebrow'] ?? 'Plumbing & building materials — Dubai, UAE' }}" placeholder="e.g. Plumbing & building materials — Dubai, UAE">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label">Background Watermark / Ghost Text</label>
                                        <input type="text" name="hero_ghost_text" class="form-control" value="{{ $settings['hero_ghost_text'] ?? 'ALABAMA' }}" placeholder="e.g. ALABAMA">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <label class="form-label">Hero Headline (HTML/Accent allowed)</label>
                                        <input type="text" name="hero_title" class="form-control" value="{{ $settings['hero_title'] ?? 'Every build runs on what\'s <span class=\'accent-i\'>behind the wall.</span>' }}" placeholder="e.g. Every build runs on what's <span class='accent-i'>behind the wall.</span>">
                                        <small class="form-hint">Tip: Wrap highlighted words in <code>&lt;span class="accent-i"&gt;...&lt;/span&gt;</code> for the signature red accent italic style.</small>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <label class="form-label">Hero Description / Lede</label>
                                        <textarea name="hero_description" rows="3" class="form-control">{{ $settings['hero_description'] ?? 'Water heaters, pipes and fittings, valves, pumps and sanitaryware — sourced, stocked and delivered for residential, commercial and industrial projects across the Emirates.' }}</textarea>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label">CTA Button 1 Text</label>
                                        <input type="text" name="hero_btn1_text" class="form-control" value="{{ $settings['hero_btn1_text'] ?? 'Get a quote' }}">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label">CTA Button 1 Link</label>
                                        <input type="text" name="hero_btn1_link" class="form-control" value="{{ $settings['hero_btn1_link'] ?? '/contact' }}" placeholder="e.g. /contact or full URL">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label">CTA Button 2 Text</label>
                                        <input type="text" name="hero_btn2_text" class="form-control" value="{{ $settings['hero_btn2_text'] ?? 'Browse categories' }}">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label">CTA Button 2 Link</label>
                                        <input type="text" name="hero_btn2_link" class="form-control" value="{{ $settings['hero_btn2_link'] ?? '#cat-hotwater' }}" placeholder="e.g. #cat-hotwater or /products">
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <hr class="my-3" />
                                    <h4 class="card-title mb-3">Hero Media Image & Badge Card</h4>
                                </div>

                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label">Hero Banner Image (Upload new)</label>
                                        <input type="file" name="hero_image" class="form-control" accept="image/*">
                                        @if(!empty($settings['hero_image_url']))
                                            <div class="mt-2">
                                                <label class="form-label small">Current Banner Image:</label>
                                                <img src="{{ $settings['hero_image_url'] }}" alt="Hero Banner" class="img-thumbnail" style="max-height: 150px;">
                                            </div>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label">Hero Banner Image Direct URL (Alternative)</label>
                                        <input type="text" name="hero_image_url" class="form-control" value="{{ $settings['hero_image_url'] ?? 'https://alabamauae.com/wp-content/uploads/2026/01/sanitary-ware.webp' }}" placeholder="https://...">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label">Floating Tag Badge Title</label>
                                        <input type="text" name="hero_tag_title" class="form-control" value="{{ $settings['hero_tag_title'] ?? 'Dubai Investments Park 2' }}">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label">Floating Tag Badge Subtext</label>
                                        <input type="text" name="hero_tag_desc" class="form-control" value="{{ $settings['hero_tag_desc'] ?? 'Warehouse & sales — supplying trade and projects UAE-wide.' }}">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Who We Are / Built on Quality Section Tab -->
                        <div class="tab-pane" id="tabs-whoweare">
                            <h3 class="card-title mb-3">Who We Are ("Built on Quality") Content & Image</h3>
                            <p class="text-muted mb-4">Manage the image and copy for the "Built on quality. Trusted for excellence." section shown across the Homepage and About Us page.</p>

                            <div class="row row-cards">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label fw-bold">Section Image (Upload new image)</label>
                                        <input type="file" name="who_we_are_image" class="form-control" accept="image/*">
                                        @php
                                            $currentWhoImg = $settings['who_we_are_image_url'] ?? 'https://alabamauae.com/wp-content/uploads/2026/01/plumbing-materials.webp';
                                        @endphp
                                        @if(!empty($currentWhoImg))
                                            <div class="mt-2">
                                                <label class="form-label small">Current Section Image:</label>
                                                <img src="{{ $currentWhoImg }}" alt="Built on quality image" class="img-thumbnail" style="max-height: 150px;">
                                            </div>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label fw-bold">Section Image URL (Alternative/External)</label>
                                        <input type="text" name="who_we_are_image_url" class="form-control" value="{{ $settings['who_we_are_image_url'] ?? 'https://alabamauae.com/wp-content/uploads/2026/01/plumbing-materials.webp' }}" placeholder="https://...">
                                        <small class="form-hint">Direct image URL fallback if not uploading a new file.</small>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label class="form-label">Eyebrow Subtitle</label>
                                        <input type="text" name="who_we_are_eyebrow" class="form-control" value="{{ $settings['who_we_are_eyebrow'] ?? 'Who we are' }}" placeholder="e.g. Who we are">
                                    </div>
                                </div>
                                <div class="col-md-8">
                                    <div class="mb-3">
                                        <label class="form-label">Headline Title</label>
                                        <input type="text" name="who_we_are_title" class="form-control" value="{{ $settings['who_we_are_title'] ?? 'Built on quality. <span class=\'accent-i\'>Trusted for excellence.</span>' }}" placeholder="e.g. Built on quality. <span class='accent-i'>Trusted for excellence.</span>">
                                        <small class="form-hint">Wrap highlighted words in <code>&lt;span class="accent-i"&gt;...&lt;/span&gt;</code> for the red italic styling.</small>
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <label class="form-label">Paragraph 1 (Experience / Introduction)</label>
                                        <textarea name="who_we_are_p1" rows="3" class="form-control">{{ $settings['who_we_are_p1'] ?? 'Alabama Building Materials Trading LLC is one of the UAE’s trusted building materials suppliers, backed by a team of industry veterans with over <strong>40 years of combined expertise</strong> in delivering reliable, high-quality construction and plumbing solutions.' }}</textarea>
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <label class="form-label">Paragraph 2 (Products & Portfolio)</label>
                                        <textarea name="who_we_are_p2" rows="3" class="form-control">{{ $settings['who_we_are_p2'] ?? 'We specialize in supplying everything required for residential, commercial, hospitality, industrial, and infrastructure projects across the UAE. Our extensive portfolio includes premium plumbing systems, sanitary ware, water heaters, pumps, valves, pipes, fittings, bathroom solutions, and other essential building materials from globally recognized manufacturers.' }}</textarea>
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <label class="form-label">Paragraph 3 (Logistics & Delivery)</label>
                                        <textarea name="who_we_are_p3" rows="2" class="form-control">{{ $settings['who_we_are_p3'] ?? 'With strategically located warehouses and an efficient logistics network, we ensure <strong>fast and dependable delivery across all Emirates</strong>, helping contractors, developers, consultants, retailers, and MEP professionals keep their projects on schedule.' }}</textarea>
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <label class="form-label">Paragraph 4 (Quality & Approval Standards)</label>
                                        <textarea name="who_we_are_p4" rows="2" class="form-control">{{ $settings['who_we_are_p4'] ?? 'Our product portfolio consists of <strong>project-approved brands</strong> that meet the stringent quality and compliance standards required by leading consultants, developers, and government authorities across the UAE.' }}</textarea>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Server-Side Tracking Tab -->
                        <div class="tab-pane" id="tabs-tracking">
                            <h3 class="card-title mb-3">Server-Side Tracking Configuration (ServerGTM, GA4, Clarity, Meta Pixel)</h3>
                            <p class="text-muted mb-4">Configure tracking IDs and Server-Side GTM endpoints. When Server GTM endpoint is provided, data is routed through your custom first-party tagging server for improved privacy, tracking reliability, and cookie lifetime.</p>
                            
                            <div class="row row-cards">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label fw-bold">Server GTM Web Container ID</label>
                                        <input type="text" name="server_gtm_container_id" class="form-control" value="{{ $settings['server_gtm_container_id'] ?? env('SERVER_GTM_CONTAINER_ID', '') }}" placeholder="e.g. GTM-XXXXXXX">
                                        <small class="form-hint">Google Tag Manager Container ID.</small>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label fw-bold">Server-Side GTM Endpoint URL (Custom Tagging Server)</label>
                                        <input type="text" name="server_gtm_url" class="form-control" value="{{ $settings['server_gtm_url'] ?? env('SERVER_GTM_URL', '') }}" placeholder="e.g. https://sgtm.alabamauae.com">
                                        <small class="form-hint">Custom server domain routing (leave blank to use default <code>https://www.googletagmanager.com</code>).</small>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label fw-bold">Google Analytics 4 (GA4) Measurement ID</label>
                                        <input type="text" name="ga4_measurement_id" class="form-control" value="{{ $settings['ga4_measurement_id'] ?? env('GA4_MEASUREMENT_ID', '') }}" placeholder="e.g. G-XXXXXXXXXX">
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label fw-bold">Microsoft Clarity Project ID</label>
                                        <input type="text" name="clarity_project_id" class="form-control" value="{{ $settings['clarity_project_id'] ?? env('CLARITY_PROJECT_ID', '') }}" placeholder="e.g. k5xxxxxx">
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label fw-bold">Meta (Facebook) Pixel ID</label>
                                        <input type="text" name="meta_pixel_id" class="form-control" value="{{ $settings['meta_pixel_id'] ?? env('META_PIXEL_ID', '') }}" placeholder="e.g. 123456789012345">
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label fw-bold">Meta Conversions API (CAPI) Access Token</label>
                                        <input type="password" name="meta_capi_token" class="form-control" value="{{ $settings['meta_capi_token'] ?? env('META_CONVERSION_API_TOKEN', '') }}" placeholder="EAA...">
                                        <small class="form-hint">Server-to-server token for Meta Conversions API (optional).</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer text-end">
                    <button type="submit" class="btn btn-primary">
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                            <path d="M5 12l5 5l10 -10" />
                        </svg>
                        Save Settings
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
