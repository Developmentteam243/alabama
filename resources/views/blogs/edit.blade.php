@extends('tablar::page')

@section('title', 'Edit Blog Post')

@section('content')
<!-- Summernote CSS CDN -->
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.css" rel="stylesheet">
<style>
    .note-editor.note-frame {
        border: 1px solid #dce1e7;
        border-radius: 8px;
    }
    .note-toolbar {
        background: #f8fafc !important;
        border-bottom: 1px solid #e2e8f0 !important;
    }
    .note-editable {
        min-height: 320px;
        font-family: inherit;
        font-size: 15px;
        line-height: 1.6;
    }
    .repeater-card {
        background: #f8fafc;
        border: 1px dashed #cbd5e1;
        border-radius: 8px;
        padding: 16px;
        margin-bottom: 12px;
    }
</style>

<div class="page-header d-print-none">
    <div class="container-xl">
        <div class="row g-2 align-items-center">
            <div class="col">
                <div class="page-pretitle">Blog Management</div>
                <h2 class="page-title">Edit Blog Post: {{ $blog->title }}</h2>
            </div>
            <div class="col-auto ms-auto d-print-none">
                <div class="btn-list">
                    <a href="{{ route('frontend.blog.show', $blog->slug) }}" target="_blank" class="btn btn-outline-secondary">
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                            <path d="M12 6h-6a2 2 0 0 0 -2 2v10a2 2 0 0 0 2 2h10a2 2 0 0 0 2 -2v-6" />
                            <path d="M11 13l9 -9" />
                            <path d="M15 4h5v5" />
                        </svg>
                        Preview on Live Site
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="page-body">
    <div class="container-xl">
        <form action="{{ route('blogs.update', $blog->id) }}" method="POST" enctype="multipart/form-data" id="blogForm">
            @csrf
            @method('PUT')
            
            <div class="row row-cards">
                <!-- Main Content Column -->
                <div class="col-lg-8">
                    <!-- Basic Information Card -->
                    <div class="card mb-3">
                        <div class="card-header">
                            <h3 class="card-title">Article Content</h3>
                        </div>
                        <div class="card-body">
                            <div class="mb-3">
                                <label class="form-label required">Blog Title</label>
                                <input type="text" name="title" id="blogTitle" class="form-control form-control-lg @error('title') is-invalid @enderror" value="{{ old('title', $blog->title) }}" required>
                                @error('title')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label class="form-label">URL Slug</label>
                                <div class="input-group">
                                    <span class="input-group-text">{{ url('/blog') }}/</span>
                                    <input type="text" name="slug" id="blogSlug" class="form-control @error('slug') is-invalid @enderror" value="{{ old('slug', $blog->slug) }}">
                                </div>
                                @error('slug')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Excerpt / Summary</label>
                                <textarea name="excerpt" rows="3" class="form-control @error('excerpt') is-invalid @enderror" placeholder="A concise summary of the article displayed on blog cards and search listings">{{ old('excerpt', $blog->excerpt) }}</textarea>
                                @error('excerpt')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label class="form-label required">Content (Rich Text Editor)</label>
                                <textarea name="content" id="blogContentEditor" class="form-control @error('content') is-invalid @enderror" required>{{ old('content', $blog->content) }}</textarea>
                                @error('content')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                <small class="form-hint mt-1">Use the toolbar to insert H1, H2, H3, H4 headings, bold text, internal/external links with custom targets, and tables.</small>
                            </div>
                        </div>
                    </div>

                    <!-- FAQs Section -->
                    <div class="card mb-3">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <div>
                                <h3 class="card-title">Frequently Asked Questions (FAQ)</h3>
                                <p class="card-subtitle text-muted mb-0">Add Q&A pairs for this blog post. These are automatically converted into FAQ Accordions and Schema Markup.</p>
                            </div>
                            <button type="button" class="btn btn-sm btn-outline-primary" id="addFaqBtn">
                                + Add FAQ
                            </button>
                        </div>
                        <div class="card-body" id="faqContainer">
                            @php
                                $faqs = old('faqs', $blog->faqs ?? []);
                            @endphp
                            @if(empty($faqs))
                                <div class="text-muted small text-center py-2" id="noFaqMsg">No FAQs added yet. Click "+ Add FAQ" above.</div>
                            @else
                                <div class="text-muted small text-center py-2" id="noFaqMsg" style="display: none;">No FAQs added yet. Click "+ Add FAQ" above.</div>
                                @foreach($faqs as $fIndex => $faq)
                                    <div class="repeater-card" id="faqItem_{{ $fIndex }}">
                                        <div class="d-flex justify-content-between align-items-center mb-2">
                                            <strong class="text-primary small">FAQ Item #{{ $loop->iteration }}</strong>
                                            <button type="button" class="btn btn-sm btn-outline-danger py-0 px-2 remove-faq" data-target="#faqItem_{{ $fIndex }}">Remove</button>
                                        </div>
                                        <div class="mb-2">
                                            <input type="text" name="faqs[{{ $fIndex }}][question]" class="form-control form-control-sm" value="{{ $faq['question'] ?? '' }}" placeholder="Question: e.g. What is the warranty period for electric water heaters?" required>
                                        </div>
                                        <div>
                                            <textarea name="faqs[{{ $fIndex }}][answer]" rows="2" class="form-control form-control-sm" placeholder="Answer: e.g. All Alabama water heaters come with a minimum 5-year warranty." required>{{ $faq['answer'] ?? '' }}</textarea>
                                        </div>
                                    </div>
                                @endforeach
                            @endif
                        </div>
                    </div>

                    <!-- Structured Links & Backlinks Manager -->
                    <div class="card mb-3">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <div>
                                <h3 class="card-title">Internal / External Links & Backlinks</h3>
                                <p class="card-subtitle text-muted mb-0">Record and manage key internal links, reference links, and target backlinks for this post.</p>
                            </div>
                            <button type="button" class="btn btn-sm btn-outline-primary" id="addLinkBtn">
                                + Add Link
                            </button>
                        </div>
                        <div class="card-body" id="linksContainer">
                            @php
                                $links = old('internal_external_links', $blog->internal_external_links ?? []);
                            @endphp
                            @if(empty($links))
                                <div class="text-muted small text-center py-2" id="noLinksMsg">No link references added yet. Click "+ Add Link" above.</div>
                            @else
                                <div class="text-muted small text-center py-2" id="noLinksMsg" style="display: none;">No link references added yet. Click "+ Add Link" above.</div>
                                @foreach($links as $lIndex => $lnk)
                                    <div class="repeater-card" id="linkItem_{{ $lIndex }}">
                                        <div class="d-flex justify-content-between align-items-center mb-2">
                                            <strong class="text-primary small">Link / Backlink Reference #{{ $loop->iteration }}</strong>
                                            <button type="button" class="btn btn-sm btn-outline-danger py-0 px-2 remove-link" data-target="#linkItem_{{ $lIndex }}">Remove</button>
                                        </div>
                                        <div class="row g-2">
                                            <div class="col-md-4">
                                                <input type="text" name="internal_external_links[{{ $lIndex }}][anchor]" class="form-control form-control-sm" value="{{ $lnk['anchor'] ?? '' }}" placeholder="Anchor Text">
                                            </div>
                                            <div class="col-md-4">
                                                <input type="url" name="internal_external_links[{{ $lIndex }}][url]" class="form-control form-control-sm" value="{{ $lnk['url'] ?? '' }}" placeholder="Target URL" required>
                                            </div>
                                            <div class="col-md-2">
                                                <select name="internal_external_links[{{ $lIndex }}][type]" class="form-select form-select-sm">
                                                    <option value="internal" {{ ($lnk['type'] ?? '') === 'internal' ? 'selected' : '' }}>Internal</option>
                                                    <option value="external" {{ ($lnk['type'] ?? '') === 'external' ? 'selected' : '' }}>External</option>
                                                    <option value="backlink" {{ ($lnk['type'] ?? '') === 'backlink' ? 'selected' : '' }}>Backlink</option>
                                                </select>
                                            </div>
                                            <div class="col-md-2">
                                                <select name="internal_external_links[{{ $lIndex }}][rel]" class="form-select form-select-sm">
                                                    <option value="dofollow" {{ ($lnk['rel'] ?? '') === 'dofollow' ? 'selected' : '' }}>dofollow</option>
                                                    <option value="nofollow" {{ ($lnk['rel'] ?? '') === 'nofollow' ? 'selected' : '' }}>nofollow</option>
                                                    <option value="sponsored" {{ ($lnk['rel'] ?? '') === 'sponsored' ? 'selected' : '' }}>sponsored</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            @endif
                        </div>
                    </div>

                    <!-- SEO & Structured Data Card -->
                    <div class="card mb-3">
                        <div class="card-header">
                            <h3 class="card-title">SEO & Schema Configuration</h3>
                        </div>
                        <div class="card-body">
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label class="form-label">Meta Title</label>
                                    <input type="text" name="meta_title" class="form-control" value="{{ old('meta_title', $blog->meta_title) }}" placeholder="Custom Title tag (defaults to blog title)">
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Primary Target Keyword</label>
                                    <input type="text" name="primary_keyword" class="form-control" value="{{ old('primary_keyword', $blog->primary_keyword) }}" placeholder="e.g. water heater dubai">
                                </div>
                                <div class="col-md-12">
                                    <label class="form-label">Secondary Keywords (comma separated)</label>
                                    <input type="text" name="secondary_keywords" class="form-control" value="{{ old('secondary_keywords', $blog->secondary_keywords) }}" placeholder="e.g. storage geyser, plumbing fittings, commercial water heaters">
                                </div>
                                <div class="col-md-12">
                                    <label class="form-label">Meta Description</label>
                                    <textarea name="meta_description" rows="3" class="form-control" placeholder="Meta description for search engines">{{ old('meta_description', $blog->meta_description) }}</textarea>
                                </div>
                                <div class="col-md-12">
                                    <label class="form-label">Custom Schema Markup (JSON-LD - Optional)</label>
                                    <textarea name="schema_markup" rows="4" class="form-control font-monospace small" placeholder='{ "@context": "https://schema.org", "@type": "Article", ... }'>{{ old('schema_markup', $blog->schema_markup) }}</textarea>
                                    <small class="form-hint">Leave blank to automatically generate Schema.org <strong>Article</strong> and <strong>FAQPage</strong> JSON-LD markup on the frontend.</small>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Social Meta (OpenGraph & Twitter) -->
                    <div class="card mb-3">
                        <div class="card-header">
                            <h3 class="card-title">Social Meta (OpenGraph & Twitter Cards)</h3>
                        </div>
                        <div class="card-body">
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label class="form-label">OG Title</label>
                                    <input type="text" name="og_title" class="form-control" value="{{ old('og_title', $blog->og_title) }}" placeholder="Facebook / LinkedIn Share Title">
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">OG Image (Upload custom social banner)</label>
                                    <input type="file" name="og_image" class="form-control" accept="image/*">
                                    @if($blog->og_image_url)
                                        <div class="mt-2">
                                            <img src="{{ $blog->og_image_url }}" alt="OG Image" class="img-thumbnail" style="max-height: 80px;">
                                        </div>
                                    @endif
                                </div>
                                <div class="col-md-12">
                                    <label class="form-label">OG Description</label>
                                    <textarea name="og_description" rows="2" class="form-control" placeholder="Description for social shares">{{ old('og_description', $blog->og_description) }}</textarea>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Twitter Card Title</label>
                                    <input type="text" name="twitter_title" class="form-control" value="{{ old('twitter_title', $blog->twitter_title) }}" placeholder="Twitter Share Title">
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Twitter Description</label>
                                    <input type="text" name="twitter_description" class="form-control" value="{{ old('twitter_description', $blog->twitter_description) }}" placeholder="Twitter Description">
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Revision History Card -->
                    <div class="card mb-3">
                        <div class="card-header">
                            <h3 class="card-title">Revision History ({{ $revisions->count() }} versions)</h3>
                        </div>
                        <div class="card-body p-0">
                            <div class="table-responsive">
                                <table class="table table-vcenter card-table">
                                    <thead>
                                        <tr>
                                            <th>Timestamp</th>
                                            <th>Author / User</th>
                                            <th>Revision Notes</th>
                                            <th>Title at Version</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($revisions as $rev)
                                            <tr>
                                                <td><span class="badge bg-light text-dark">{{ $rev->created_at->format('M d, Y H:i') }}</span></td>
                                                <td>{{ $rev->user->name ?? 'System / Author' }}</td>
                                                <td><span class="text-muted small">{{ $rev->revision_notes ?: 'Auto-saved update' }}</span></td>
                                                <td class="text-truncate" style="max-width: 200px;">{{ $rev->title }}</td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="4" class="text-center text-muted py-3">No revisions recorded yet.</td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Sidebar Column -->
                <div class="col-lg-4">
                    <!-- Publishing & Status Card -->
                    <div class="card mb-3">
                        <div class="card-header">
                            <h3 class="card-title">Publishing & Status</h3>
                        </div>
                        <div class="card-body">
                            <div class="mb-3">
                                <label class="form-label required">Post Status</label>
                                <select name="status" id="postStatus" class="form-select" required>
                                    <option value="published" {{ old('status', $blog->status) === 'published' ? 'selected' : '' }}>Published (Live immediately)</option>
                                    <option value="draft" {{ old('status', $blog->status) === 'draft' ? 'selected' : '' }}>Draft (Hidden from public)</option>
                                    <option value="scheduled" {{ old('status', $blog->status) === 'scheduled' ? 'selected' : '' }}>Schedule (Publish at future date)</option>
                                </select>
                            </div>

                            <div class="mb-3" id="scheduledAtGroup" style="display: {{ old('status', $blog->status) === 'scheduled' ? 'block' : 'none' }};">
                                <label class="form-label">Scheduled Publish Date & Time</label>
                                <input type="datetime-local" name="scheduled_at" class="form-control" value="{{ old('scheduled_at', $blog->scheduled_at ? $blog->scheduled_at->format('Y-m-d\TH:i') : '') }}">
                                <small class="form-hint">The post will automatically become active after this timestamp.</small>
                            </div>

                            <div class="mb-3">
                                <label class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" name="is_active" value="1" {{ old('is_active', $blog->is_active) ? 'checked' : '' }}>
                                    <span class="form-check-label fw-bold">Active Status</span>
                                </label>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Author Name</label>
                                <input type="text" name="author_name" class="form-control" value="{{ old('author_name', $blog->author_name) }}" placeholder="e.g. John Doe, Alabama Team">
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Tags / Categories (comma separated)</label>
                                <input type="text" name="tag" class="form-control" value="{{ old('tag', $blog->tag) }}" placeholder="e.g. Water Heaters, Plumbing, Guides">
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Revision Note for this update</label>
                                <input type="text" name="revision_notes" class="form-control" placeholder="e.g. Updated heading structure and added FAQ section">
                                <small class="form-hint">Optional note saved in revision history.</small>
                            </div>
                        </div>
                        <div class="card-footer text-end">
                            <a href="{{ route('blogs.index') }}" class="btn btn-link link-secondary">Cancel</a>
                            <button type="submit" class="btn btn-primary">Update Blog Post</button>
                        </div>
                    </div>

                    <!-- Featured Image Card -->
                    <div class="card mb-3">
                        <div class="card-header">
                            <h3 class="card-title">Featured Image & Alt Text</h3>
                        </div>
                        <div class="card-body">
                            <div class="mb-3">
                                <label class="form-label">Replace Featured Image</label>
                                <input type="file" name="image" class="form-control @error('image') is-invalid @enderror" accept="image/*">
                                @error('image')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                @if($blog->image_url)
                                    <div class="mt-2">
                                        <label class="form-label small">Current Image:</label>
                                        <img src="{{ $blog->image_url }}" alt="{{ $blog->image_alt ?: $blog->title }}" class="img-thumbnail" style="max-height: 140px;">
                                    </div>
                                @endif
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Image Alt Text (SEO & Accessibility)</label>
                                <input type="text" name="image_alt" class="form-control" value="{{ old('image_alt', $blog->image_alt) }}" placeholder="e.g. Commercial water heater installation in Dubai project">
                                <small class="form-hint">Descriptive alternative text for screen readers and Google image indexing.</small>
                            </div>
                        </div>
                    </div>

                    <!-- Related Blogs Selection -->
                    <div class="card mb-3">
                        <div class="card-header">
                            <h3 class="card-title">Related Blogs</h3>
                        </div>
                        <div class="card-body" style="max-height: 250px; overflow-y: auto;">
                            @php
                                $selectedBlogIds = old('related_blog_ids', $blog->related_blog_ids ?? []);
                            @endphp
                            @forelse($allBlogs as $b)
                                <label class="form-check mb-2">
                                    <input class="form-check-input" type="checkbox" name="related_blog_ids[]" value="{{ $b->id }}" {{ is_array($selectedBlogIds) && in_array($b->id, $selectedBlogIds) ? 'checked' : '' }}>
                                    <span class="form-check-label">{{ $b->title }}</span>
                                </label>
                            @empty
                                <p class="text-muted small mb-0">No other blogs available.</p>
                            @endforelse
                        </div>
                    </div>

                    <!-- Related Products Selection -->
                    <div class="card mb-3">
                        <div class="card-header">
                            <h3 class="card-title">Related Products</h3>
                        </div>
                        <div class="card-body" style="max-height: 250px; overflow-y: auto;">
                            @php
                                $selectedProdIds = old('related_product_ids', $blog->related_product_ids ?? []);
                            @endphp
                            @forelse($allProducts as $p)
                                <label class="form-check mb-2">
                                    <input class="form-check-input" type="checkbox" name="related_product_ids[]" value="{{ $p->id }}" {{ is_array($selectedProdIds) && in_array($p->id, $selectedProdIds) ? 'checked' : '' }}>
                                    <span class="form-check-label">{{ $p->model_name ?: $p->sku_code }} <small class="text-muted">({{ $p->brand->name ?? 'Brand' }})</small></span>
                                </label>
                            @empty
                                <p class="text-muted small mb-0">No products available.</p>
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>

<!-- jQuery and Summernote JS CDN -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.js"></script>

<script>
$(document).ready(function() {
    // Initialize Summernote Rich Text Editor
    $('#blogContentEditor').summernote({
        placeholder: 'Write your comprehensive blog post content here...',
        tabsize: 2,
        height: 380,
        toolbar: [
            ['style', ['style']],
            ['font', ['bold', 'italic', 'underline', 'clear']],
            ['fontsize', ['fontsize']],
            ['color', ['color']],
            ['para', ['ul', 'ol', 'paragraph']],
            ['table', ['table']],
            ['insert', ['link', 'picture', 'hr']],
            ['view', ['fullscreen', 'codeview', 'help']]
        ],
        styleTags: [
            'p',
            { title: 'Heading 1', tag: 'h1', className: 'h1-custom', value: 'h1' },
            { title: 'Heading 2', tag: 'h2', className: 'h2-custom', value: 'h2' },
            { title: 'Heading 3', tag: 'h3', className: 'h3-custom', value: 'h3' },
            { title: 'Heading 4', tag: 'h4', className: 'h4-custom', value: 'h4' },
            'blockquote', 'pre'
        ]
    });

    // Schedule visibility toggle
    $('#postStatus').on('change', function() {
        if ($(this).val() === 'scheduled') {
            $('#scheduledAtGroup').slideDown();
        } else {
            $('#scheduledAtGroup').slideUp();
        }
    });

    // FAQ Repeater
    let faqCount = {{ count($faqs) }};
    $('#addFaqBtn').on('click', function() {
        $('#noFaqMsg').hide();
        const html = `
            <div class="repeater-card" id="faqItem_${faqCount}">
                <div class="d-flex justify-content-between align-items-center mb-2">
                    <strong class="text-primary small">FAQ Item #${faqCount + 1}</strong>
                    <button type="button" class="btn btn-sm btn-outline-danger py-0 px-2 remove-faq" data-target="#faqItem_${faqCount}">Remove</button>
                </div>
                <div class="mb-2">
                    <input type="text" name="faqs[${faqCount}][question]" class="form-control form-control-sm" placeholder="Question: e.g. What is the warranty period for electric water heaters?" required>
                </div>
                <div>
                    <textarea name="faqs[${faqCount}][answer]" rows="2" class="form-control form-control-sm" placeholder="Answer: e.g. All Alabama water heaters come with a minimum 5-year warranty." required></textarea>
                </div>
            </div>
        `;
        $('#faqContainer').append(html);
        faqCount++;
    });

    $(document).on('click', '.remove-faq', function() {
        $($(this).data('target')).remove();
        if ($('#faqContainer').children('.repeater-card').length === 0) {
            $('#noFaqMsg').show();
        }
    });

    // Links Repeater
    let linkCount = {{ count($links) }};
    $('#addLinkBtn').on('click', function() {
        $('#noLinksMsg').hide();
        const html = `
            <div class="repeater-card" id="linkItem_${linkCount}">
                <div class="d-flex justify-content-between align-items-center mb-2">
                    <strong class="text-primary small">Link / Backlink Reference #${linkCount + 1}</strong>
                    <button type="button" class="btn btn-sm btn-outline-danger py-0 px-2 remove-link" data-target="#linkItem_${linkCount}">Remove</button>
                </div>
                <div class="row g-2">
                    <div class="col-md-4">
                        <input type="text" name="internal_external_links[${linkCount}][anchor]" class="form-control form-control-sm" placeholder="Anchor Text (e.g. Electric Geysers)">
                    </div>
                    <div class="col-md-4">
                        <input type="url" name="internal_external_links[${linkCount}][url]" class="form-control form-control-sm" placeholder="Target URL" required>
                    </div>
                    <div class="col-md-2">
                        <select name="internal_external_links[${linkCount}][type]" class="form-select form-select-sm">
                            <option value="internal">Internal</option>
                            <option value="external">External</option>
                            <option value="backlink">Backlink</option>
                        </select>
                    </div>
                    <div class="col-md-2">
                        <select name="internal_external_links[${linkCount}][rel]" class="form-select form-select-sm">
                            <option value="dofollow">dofollow</option>
                            <option value="nofollow">nofollow</option>
                            <option value="sponsored">sponsored</option>
                        </select>
                    </div>
                </div>
            </div>
        `;
        $('#linksContainer').append(html);
        linkCount++;
    });

    $(document).on('click', '.remove-link', function() {
        $($(this).data('target')).remove();
        if ($('#linksContainer').children('.repeater-card').length === 0) {
            $('#noLinksMsg').show();
        }
    });
});
</script>
@endsection
