@extends('tablar::page')

@section('title', 'Add Blog Post')

@section('content')
<!-- CKEditor 4 WYSIWYG Editor CDN -->
<script src="https://cdn.ckeditor.com/4.22.1/standard/ckeditor.js"></script>
<style>
    .cke_chrome {
        border: 1px solid #dce1e7 !important;
        border-radius: 8px !important;
        box-shadow: 0 1px 3px rgba(0,0,0,0.05) !important;
    }
    .cke_inner {
        border-radius: 8px !important;
    }
    .cke_top {
        background: #f8fafc !important;
        border-bottom: 1px solid #e2e8f0 !important;
        border-top-left-radius: 7px !important;
        border-top-right-radius: 7px !important;
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
                <h2 class="page-title">Add New Blog Post</h2>
            </div>
        </div>
    </div>
</div>

<div class="page-body">
    <div class="container-xl">
        <form action="{{ route('blogs.store') }}" method="POST" enctype="multipart/form-data" id="blogForm">
            @csrf
            
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
                                <input type="text" name="title" id="blogTitle" class="form-control form-control-lg @error('title') is-invalid @enderror" value="{{ old('title') }}" placeholder="e.g. Complete Guide to Choosing Water Heaters in UAE" required>
                                @error('title')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label class="form-label">URL Slug</label>
                                <div class="input-group">
                                    <span class="input-group-text">{{ url('/blog') }}/</span>
                                    <input type="text" name="slug" id="blogSlug" class="form-control @error('slug') is-invalid @enderror" value="{{ old('slug') }}" placeholder="auto-generated-from-title">
                                </div>
                                <small class="form-hint">Leave blank to auto-generate from title.</small>
                                @error('slug')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Excerpt / Short Description (Rich Text Editor)</label>
                                <textarea name="excerpt" id="blogExcerptEditor" rows="3" class="form-control @error('excerpt') is-invalid @enderror" placeholder="A concise summary of the article displayed on blog cards and search listings">{{ old('excerpt') }}</textarea>
                                @error('excerpt')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                <small class="form-hint mt-1">Use editor to make text bold, highlight, add links, or adjust font sizing.</small>
                            </div>

                            <div class="mb-3">
                                <label class="form-label required">Content (Rich Text Editor)</label>
                                <textarea name="content" id="blogContentEditor" class="form-control @error('content') is-invalid @enderror" required>{{ old('content') }}</textarea>
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
                            <div class="text-muted small text-center py-2" id="noFaqMsg">No FAQs added yet. Click "+ Add FAQ" above.</div>
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
                            <div class="text-muted small text-center py-2" id="noLinksMsg">No link references added yet. Click "+ Add Link" above.</div>
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
                                    <input type="text" name="meta_title" class="form-control" value="{{ old('meta_title') }}" placeholder="Custom Title tag (defaults to blog title)">
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Primary Target Keyword</label>
                                    <input type="text" name="primary_keyword" class="form-control" value="{{ old('primary_keyword') }}" placeholder="e.g. water heater dubai">
                                </div>
                                <div class="col-md-12">
                                    <label class="form-label">Secondary Keywords (comma separated)</label>
                                    <input type="text" name="secondary_keywords" class="form-control" value="{{ old('secondary_keywords') }}" placeholder="e.g. storage geyser, plumbing fittings, commercial water heaters">
                                </div>
                                <div class="col-md-12">
                                    <label class="form-label">Meta Description</label>
                                    <textarea name="meta_description" rows="3" class="form-control" placeholder="Meta description for search engines (approx 150-160 characters)">{{ old('meta_description') }}</textarea>
                                </div>
                                <div class="col-md-12">
                                    <label class="form-label">Custom Schema Markup (JSON-LD - Optional)</label>
                                    <textarea name="schema_markup" rows="4" class="form-control font-monospace small" placeholder='{ "@@context": "https://schema.org", "@@type": "Article", ... }'>{{ old('schema_markup') }}</textarea>
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
                                    <input type="text" name="og_title" class="form-control" value="{{ old('og_title') }}" placeholder="Facebook / LinkedIn Share Title">
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">OG Image (Upload custom social banner)</label>
                                    <input type="file" name="og_image" class="form-control" accept="image/*">
                                </div>
                                <div class="col-md-12">
                                    <label class="form-label">OG Description</label>
                                    <textarea name="og_description" rows="2" class="form-control" placeholder="Description for social shares">{{ old('og_description') }}</textarea>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Twitter Card Title</label>
                                    <input type="text" name="twitter_title" class="form-control" value="{{ old('twitter_title') }}" placeholder="Twitter Share Title">
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Twitter Description</label>
                                    <input type="text" name="twitter_description" class="form-control" value="{{ old('twitter_description') }}" placeholder="Twitter Description">
                                </div>
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
                                    <option value="published" {{ old('status', 'published') === 'published' ? 'selected' : '' }}>Published (Live immediately)</option>
                                    <option value="draft" {{ old('status') === 'draft' ? 'selected' : '' }}>Draft (Hidden from public)</option>
                                    <option value="scheduled" {{ old('status') === 'scheduled' ? 'selected' : '' }}>Schedule (Publish at future date)</option>
                                </select>
                            </div>

                            <div class="mb-3" id="scheduledAtGroup" style="display: {{ old('status') === 'scheduled' ? 'block' : 'none' }};">
                                <label class="form-label">Scheduled Publish Date & Time</label>
                                <input type="datetime-local" name="scheduled_at" class="form-control" value="{{ old('scheduled_at') }}">
                                <small class="form-hint">The post will automatically become active after this timestamp.</small>
                            </div>

                            <div class="mb-3">
                                <label class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" name="is_active" value="1" {{ old('is_active', '1') ? 'checked' : '' }}>
                                    <span class="form-check-label fw-bold">Active Status</span>
                                </label>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Author Name</label>
                                <input type="text" name="author_name" class="form-control" value="{{ old('author_name', auth()->user()->name ?? 'Alabama Editorial Team') }}" placeholder="e.g. John Doe, Alabama Team">
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Tags / Categories (comma separated)</label>
                                <input type="text" name="tag" class="form-control" value="{{ old('tag') }}" placeholder="e.g. Water Heaters, Plumbing, Guides">
                            </div>
                        </div>
                        <div class="card-footer text-end">
                            <a href="{{ route('blogs.index') }}" class="btn btn-link link-secondary">Cancel</a>
                            <button type="submit" class="btn btn-primary">Save & Publish Post</button>
                        </div>
                    </div>

                    <!-- Featured Image Card -->
                    <div class="card mb-3">
                        <div class="card-header">
                            <h3 class="card-title">Featured Image & Alt Text</h3>
                        </div>
                        <div class="card-body">
                            <div class="mb-3">
                                <label class="form-label">Upload Featured Image</label>
                                <input type="file" name="image" class="form-control @error('image') is-invalid @enderror" accept="image/*">
                                <small class="form-hint">Recommended ~1200x630px for high-res cards and social sharing.</small>
                                @error('image')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Image Alt Text (SEO & Accessibility)</label>
                                <input type="text" name="image_alt" class="form-control" value="{{ old('image_alt') }}" placeholder="e.g. Commercial water heater installation in Dubai project">
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
                            @forelse($allBlogs as $b)
                                <label class="form-check mb-2">
                                    <input class="form-check-input" type="checkbox" name="related_blog_ids[]" value="{{ $b->id }}" {{ is_array(old('related_blog_ids')) && in_array($b->id, old('related_blog_ids')) ? 'checked' : '' }}>
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
                            @forelse($allProducts as $p)
                                <label class="form-check mb-2">
                                    <input class="form-check-input" type="checkbox" name="related_product_ids[]" value="{{ $p->id }}" {{ is_array(old('related_product_ids')) && in_array($p->id, old('related_product_ids')) ? 'checked' : '' }}>
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
<!-- CKEditor Initialization & Form Handling -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Replace textareas with CKEditor (handles hyperlinks, formatting, bold, headers, tables)
    if (document.getElementById('blogExcerptEditor')) {
        CKEDITOR.replace('blogExcerptEditor', {
            height: 140,
            toolbar: [
                { name: 'basicstyles', items: [ 'Bold', 'Italic', 'Underline', 'Strike', '-', 'RemoveFormat' ] },
                { name: 'paragraph', items: [ 'NumberedList', 'BulletedList', '-', 'Blockquote' ] },
                { name: 'links', items: [ 'Link', 'Unlink' ] },
                { name: 'styles', items: [ 'Format', 'FontSize' ] },
                { name: 'colors', items: [ 'TextColor', 'BGColor' ] },
                { name: 'tools', items: [ 'Maximize', 'Source' ] }
            ]
        });
    }

    if (document.getElementById('blogContentEditor')) {
        CKEDITOR.replace('blogContentEditor', {
            height: 380,
            toolbar: [
                { name: 'document', items: [ 'Source' ] },
                { name: 'clipboard', items: [ 'Cut', 'Copy', 'Paste', 'PasteText', 'PasteFromWord', '-', 'Undo', 'Redo' ] },
                { name: 'editing', items: [ 'Find', 'Replace', '-', 'SelectAll' ] },
                { name: 'basicstyles', items: [ 'Bold', 'Italic', 'Underline', 'Strike', 'Subscript', 'Superscript', '-', 'CopyFormatting', 'RemoveFormat' ] },
                { name: 'paragraph', items: [ 'NumberedList', 'BulletedList', '-', 'Outdent', 'Indent', '-', 'Blockquote', 'CreateDiv', '-', 'JustifyLeft', 'JustifyCenter', 'JustifyRight', 'JustifyBlock' ] },
                { name: 'links', items: [ 'Link', 'Unlink', 'Anchor' ] },
                { name: 'insert', items: [ 'Image', 'Table', 'HorizontalRule', 'SpecialChar' ] },
                '/',
                { name: 'styles', items: [ 'Styles', 'Format', 'Font', 'FontSize' ] },
                { name: 'colors', items: [ 'TextColor', 'BGColor' ] },
                { name: 'tools', items: [ 'Maximize', 'ShowBlocks' ] }
            ]
        });
    }

    // Schedule visibility toggle
    var postStatus = document.getElementById('postStatus');
    if (postStatus) {
        postStatus.addEventListener('change', function() {
            var group = document.getElementById('scheduledAtGroup');
            if (group) {
                group.style.display = this.value === 'scheduled' ? 'block' : 'none';
            }
        });
    }

    // FAQ Repeater
    var faqIndex = 0;
    var addFaqBtn = document.getElementById('addFaqBtn');
    if (addFaqBtn) {
        addFaqBtn.addEventListener('click', function() {
            var noMsg = document.getElementById('noFaqMsg');
            if (noMsg) noMsg.style.display = 'none';
            var html = `
                <div class="repeater-card" id="faqItem_${faqIndex}">
                    <div class="d-flex justify-content-between align-items-center mb-2">
                        <strong class="text-primary small">FAQ Item #${faqIndex + 1}</strong>
                        <button type="button" class="btn btn-sm btn-outline-danger py-0 px-2 remove-faq" onclick="document.getElementById('faqItem_${faqIndex}').remove()">Remove</button>
                    </div>
                    <div class="mb-2">
                        <input type="text" name="faqs[${faqIndex}][question]" class="form-control form-control-sm" placeholder="Question: e.g. What is the warranty period for electric water heaters?" required>
                    </div>
                    <div>
                        <textarea name="faqs[${faqIndex}][answer]" rows="2" class="form-control form-control-sm" placeholder="Answer: e.g. All Alabama water heaters come with a minimum 5-year tank warranty." required></textarea>
                    </div>
                </div>
            `;
            document.getElementById('faqContainer').insertAdjacentHTML('beforeend', html);
            faqIndex++;
        });
    }

    // Links Repeater
    var linkIndex = 0;
    var addLinkBtn = document.getElementById('addLinkBtn');
    if (addLinkBtn) {
        addLinkBtn.addEventListener('click', function() {
            var noMsg = document.getElementById('noLinksMsg');
            if (noMsg) noMsg.style.display = 'none';
            var html = `
                <div class="repeater-card" id="linkItem_${linkIndex}">
                    <div class="d-flex justify-content-between align-items-center mb-2">
                        <strong class="text-primary small">Link / Backlink Reference #${linkIndex + 1}</strong>
                        <button type="button" class="btn btn-sm btn-outline-danger py-0 px-2 remove-link" onclick="document.getElementById('linkItem_${linkIndex}').remove()">Remove</button>
                    </div>
                    <div class="row g-2">
                        <div class="col-md-4">
                            <input type="text" name="internal_external_links[${linkIndex}][anchor]" class="form-control form-control-sm" placeholder="Anchor Text (e.g. Electric Geysers)">
                        </div>
                        <div class="col-md-4">
                            <input type="url" name="internal_external_links[${linkIndex}][url]" class="form-control form-control-sm" placeholder="Target URL (e.g. /category/water-heaters)" required>
                        </div>
                        <div class="col-md-2">
                            <select name="internal_external_links[${linkIndex}][type]" class="form-select form-select-sm">
                                <option value="internal">Internal</option>
                                <option value="external">External</option>
                                <option value="backlink">Backlink</option>
                            </select>
                        </div>
                        <div class="col-md-2">
                            <select name="internal_external_links[${linkIndex}][rel]" class="form-select form-select-sm">
                                <option value="dofollow">dofollow</option>
                                <option value="nofollow">nofollow</option>
                                <option value="sponsored">sponsored</option>
                            </select>
                        </div>
                    </div>
                </div>
            `;
            document.getElementById('linksContainer').insertAdjacentHTML('beforeend', html);
            linkIndex++;
        });
    }
});
</script>
@endsection
