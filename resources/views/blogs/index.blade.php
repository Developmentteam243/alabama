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
                            <th>Title</th>
                            <th>Tag</th>
                            <th>Status</th>
                            <th>Date Created</th>
                            <th class="w-1">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($blogs as $blog)
                            <tr>
                                <td>
                                    @if($blog->image_url)
                                        <img src="{{ $blog->image_url }}" alt="{{ $blog->title }}" class="avatar avatar-md rounded">
                                    @else
                                        <span class="avatar avatar-md rounded bg-secondary-lt">No Image</span>
                                    @endif
                                </td>
                                <td>
                                    <strong>{{ $blog->title }}</strong>
                                    <div class="text-muted small">/blog/{{ $blog->slug }}</div>
                                </td>
                                <td>
                                    @if($blog->tag)
                                        <span class="badge bg-purple-lt">{{ $blog->tag }}</span>
                                    @else
                                        -
                                    @endif
                                </td>
                                <td>
                                    @if($blog->is_active)
                                        <span class="badge bg-green text-green-fg">Active</span>
                                    @else
                                        <span class="badge bg-secondary text-secondary-fg">Inactive</span>
                                    @endif
                                </td>
                                <td>{{ $blog->created_at->format('M d, Y') }}</td>
                                <td>
                                    <div class="btn-list flex-nowrap">
                                        <a href="{{ route('blogs.edit', $blog->id) }}" class="btn btn-outline-warning btn-sm">
                                            Edit
                                        </a>
                                        <form action="{{ route('blogs.destroy', $blog->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this blog post?');" style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-outline-danger btn-sm">
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
