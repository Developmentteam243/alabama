@extends('tablar::page')

@section('title', 'Blogs')

@section('content')
<div class="page-header d-print-none">
    <div class="container-xl">
        <div class="row g-2 align-items-center">
            <div class="col">
                <div class="page-pretitle">Content Management</div>
                <h2 class="page-title">Blog Posts</h2>
            </div>
            <div class="col-12 col-md-auto ms-auto d-print-none">
                <div class="btn-list">
                    <a href="{{ route('blogs.create') }}" class="btn btn-primary">
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                            <path d="M12 5l0 14" />
                            <path d="M5 12l14 0" />
                        </svg>
                        Add Blog Post
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
            <div class="table-responsive">
                <table class="table table-vcenter card-table">
                    <thead>
                        <tr>
                            <th>Image</th>
                            <th>Title & Author</th>
                            <th>Tags</th>
                            <th>Status</th>
                            <th>Date / Schedule</th>
                            <th class="w-1">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($blogs as $blog)
                            <tr>
                                <td>
                                    @if($blog->image_url)
                                        <img src="{{ $blog->image_url }}" alt="{{ $blog->image_alt ?: $blog->title }}" class="avatar avatar-md rounded" style="object-fit: cover;">
                                    @else
                                        <span class="avatar avatar-md rounded bg-secondary-lt">No Image</span>
                                    @endif
                                </td>
                                <td>
                                    <strong>{{ $blog->title }}</strong>
                                    <div class="text-muted small">
                                        Author: {{ $blog->author_name ?: 'Alabama Team' }} · 
                                        <a href="{{ route('frontend.blog.show', $blog->slug) }}" target="_blank" class="text-secondary text-decoration-none">/blog/{{ $blog->slug }}</a>
                                    </div>
                                </td>
                                <td>
                                    @if($blog->tag)
                                        @foreach(explode(',', $blog->tag) as $t)
                                            <span class="badge bg-purple-lt me-1">{{ trim($t) }}</span>
                                        @endforeach
                                    @else
                                        <span class="text-muted small">-</span>
                                    @endif
                                </td>
                                <td>
                                    @if($blog->status === 'published' || empty($blog->status))
                                        <span class="badge bg-green text-green-fg">Published</span>
                                    @elseif($blog->status === 'scheduled')
                                        <span class="badge bg-yellow text-yellow-fg">Scheduled</span>
                                    @else
                                        <span class="badge bg-secondary text-secondary-fg">Draft</span>
                                    @endif

                                    @if(!$blog->is_active)
                                        <span class="badge bg-danger-lt ms-1">Disabled</span>
                                    @endif
                                </td>
                                <td>
                                    @if($blog->status === 'scheduled' && $blog->scheduled_at)
                                        <span class="text-warning small d-block">Scheduled:</span>
                                        {{ $blog->scheduled_at->format('M d, Y H:i') }}
                                    @else
                                        {{ $blog->created_at->format('M d, Y') }}
                                    @endif
                                </td>
                                <td>
                                    <div class="btn-list flex-nowrap">
                                        <a href="{{ route('blogs.edit', $blog->id) }}" class="btn btn-sm btn-outline-warning d-inline-flex align-items-center gap-1">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                                <path d="M4 20h4l10.5 -10.5a2.828 2.828 0 1 0 -4 -4l-10.5 10.5v4" />
                                                <path d="M13.5 6.5l4 4" />
                                            </svg>
                                            Edit
                                        </a>
                                        <form action="{{ route('blogs.destroy', $blog->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this blog post?');" style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-outline-danger d-inline-flex align-items-center gap-1">
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
                                <td colspan="6" class="text-center text-muted py-4">No blog posts found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            @if($blogs->hasPages())
                <div class="card-footer d-flex align-items-center">
                    {{ $blogs->links('tablar::pagination') }}
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
