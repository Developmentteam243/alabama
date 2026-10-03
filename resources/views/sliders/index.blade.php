@extends('tablar::page')

@section('title', 'Hero Sliders')

@section('content')
<div class="page-header d-print-none">
    <div class="container-xl">
        <div class="row g-2 align-items-center">
            <div class="col">
                <div class="page-pretitle">Homepage Management</div>
                <h2 class="page-title">Hero Banner Sliders</h2>
            </div>
            <div class="col-12 col-md-auto ms-auto d-print-none">
                <div class="btn-list">
                    <a href="{{ route('sliders.create') }}" class="btn btn-primary d-inline-flex align-items-center gap-1">
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                            <path d="M12 5l0 14" />
                            <path d="M5 12l14 0" />
                        </svg>
                        Add New Slide
                    </a>
                </div>
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
            <div class="card-header d-flex justify-content-between align-items-center">
                <h3 class="card-title">All Slides ({{ $sliders->total() }})</h3>
                <span class="text-muted small">Slides are displayed in the homepage hero swiper in ascending order of Sort Order.</span>
            </div>
            <div class="table-responsive">
                <table class="table card-table table-vcenter text-nowrap datatable">
                    <thead>
                        <tr>
                            <th class="w-1">Order</th>
                            <th>Slide Preview</th>
                            <th>Title / Subtitle</th>
                            <th>Button CTA</th>
                            <th>Status</th>
                            <th class="text-end">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($sliders as $slider)
                            <tr>
                                <td>
                                    <span class="badge bg-secondary-lt">{{ $slider->sort_order }}</span>
                                </td>
                                <td>
                                    <div class="d-flex align-items-center gap-3">
                                        <div style="width: 100px; height: 56px; border-radius: 6px; overflow: hidden; background: #0f172a;" class="shadow-sm">
                                            <img src="{{ $slider->image_url }}" alt="{{ $slider->title ?? 'Slide' }}" style="width: 100%; height: 100%; object-fit: cover;">
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div class="fw-bold">{{ $slider->title ?: '— No Title —' }}</div>
                                    @if($slider->subtitle)
                                        <div class="text-muted small">{{ $slider->subtitle }}</div>
                                    @endif
                                </td>
                                <td>
                                    @if($slider->button_url)
                                        <a href="{{ $slider->button_url }}" target="_blank" class="badge bg-blue-lt text-decoration-none">
                                            {{ $slider->button_text ?: 'Explore' }} &rarr;
                                        </a>
                                    @else
                                        <span class="text-muted small">—</span>
                                    @endif
                                </td>
                                <td>
                                    @if($slider->is_active)
                                        <span class="badge bg-success-lt">Active</span>
                                    @else
                                        <span class="badge bg-danger-lt">Inactive</span>
                                    @endif
                                </td>
                                <td class="text-end">
                                    <div class="btn-list justify-content-end">
                                        <a href="{{ route('sliders.edit', $slider->id) }}" class="btn btn-sm btn-outline-warning">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                                <path d="M4 20h4l10.5 -10.5a2.828 2.828 0 1 0 -4 -4l-10.5 10.5v4" />
                                                <path d="M13.5 6.5l4 4" />
                                            </svg>
                                            Edit
                                        </a>
                                        <form action="{{ route('sliders.destroy', $slider->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this slide?');" style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-outline-danger">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                                    <path d="M4 7l16 0" />
                                                    <path d="M10 11l0 6" />
                                                    <path d="M14 11l0 6" />
                                                    <path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12" />
                                                    <path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3" />
                                                </svg>
                                                Delete
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center py-4">
                                    <p class="text-muted mb-2">No slides found in the database.</p>
                                    <a href="{{ route('sliders.create') }}" class="btn btn-sm btn-primary">Create your first slide</a>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            @if($sliders->hasPages())
                <div class="card-footer d-flex align-items-center">
                    {{ $sliders->links() }}
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
