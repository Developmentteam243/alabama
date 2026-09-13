@extends('tablar::page')

@section('title', 'Categories & Subcategories')

@section('content')
<div class="page-header d-print-none">
    <div class="container-xl">
        <div class="row g-2 align-items-center">
            <div class="col">
                <div class="page-pretitle">Catalog Management</div>
                <h2 class="page-title">Categories & Subcategories</h2>
            </div>
            <div class="col-12 col-md-auto ms-auto d-print-none">
                <div class="btn-list">
                    <a href="{{ route('categories.create') }}" class="btn btn-primary">
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                            <path d="M12 5l0 14" />
                            <path d="M5 12l14 0" />
                        </svg>
                        Add Category
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

        <div class="row row-cards">
            @forelse($categories as $category)
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <div class="d-flex align-items-center gap-2">
                                @if($category->home_image_url)
                                    <img src="{{ $category->home_image_url }}" alt="{{ $category->name }}" class="avatar rounded" style="object-fit: cover;">
                                @elseif($category->banner_url)
                                    <img src="{{ $category->banner_url }}" alt="{{ $category->name }}" class="avatar rounded" style="object-fit: cover;">
                                @endif
                                <div>
                                    <h3 class="card-title mb-0">{{ $category->name }}</h3>
                                    <div class="d-flex gap-1 mt-1">
                                        <span class="badge bg-blue-lite text-blue">Code: {{ $category->code ?: 'N/A' }}</span>
                                        @if($category->home_image_url)
                                            <span class="badge bg-green-lite text-green">Home Card</span>
                                        @endif
                                        @if($category->banner_url)
                                            <span class="badge bg-purple-lite text-purple">Page Banner</span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="btn-list">
                                <a href="{{ route('categories.edit', $category->id) }}" class="btn btn-sm btn-outline-warning d-inline-flex align-items-center gap-1">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                        <path d="M4 20h4l10.5 -10.5a2.828 2.828 0 1 0 -4 -4l-10.5 10.5v4" />
                                        <path d="M13.5 6.5l4 4" />
                                    </svg>
                                    Edit
                                </a>
                                <form action="{{ route('categories.destroy', $category->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this category and all its subcategories?');" style="display:inline;">
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
                        </div>
                        <div class="card-body">
                            <h4 class="mb-2">Subcategories:</h4>
                            @if($category->subcategories->count() > 0)
                                <ul class="list-group mb-3">
                                    @foreach($category->subcategories as $subcat)
                                        <li class="list-group-item d-flex justify-content-between align-items-center">
                                            <div class="d-flex align-items-center gap-2">
                                                @if($subcat->banner_url)
                                                    <img src="{{ $subcat->banner_url }}" alt="{{ $subcat->name }}" class="avatar avatar-sm rounded" style="object-fit: cover;">
                                                @endif
                                                <div>
                                                    <strong>{{ $subcat->name }}</strong>
                                                    <span class="badge bg-secondary-lite text-secondary ms-1">{{ $subcat->code ?: 'N/A' }}</span>
                                                    @if($subcat->banner_url)
                                                        <span class="badge bg-success-lite text-success ms-1">Banner</span>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="d-flex align-items-center gap-2">
                                                <a href="{{ route('subcategories.edit', $subcat->id) }}" class="btn btn-sm btn-outline-warning">
                                                    Edit / Banner
                                                </a>
                                                <form action="{{ route('subcategories.destroy', $subcat->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this subcategory?');" style="display:inline;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-outline-danger">
                                                        Delete
                                                    </button>
                                                </form>
                                            </div>
                                        </li>
                                    @endforeach
                                </ul>
                            @else
                                <p class="text-muted small">No subcategories defined.</p>
                            @endif

                            <!-- Form to Add Subcategory with optional banner upload -->
                            <form action="{{ route('categories.subcategories.store', $category->id) }}" method="POST" enctype="multipart/form-data" class="border-top pt-3 mt-3">
                                @csrf
                                <div class="row g-2 align-items-center">
                                    <div class="col-md-5">
                                        <input type="text" name="name" class="form-control form-control-sm" placeholder="Subcategory Name" required>
                                    </div>
                                    <div class="col-md-3">
                                        <input type="text" name="code" class="form-control form-control-sm" placeholder="Code (e.g. GB)" required>
                                    </div>
                                    <div class="col-md-4">
                                        <input type="file" name="banner" class="form-control form-control-sm" accept="image/*" title="Optional Banner Image">
                                    </div>
                                    <div class="col-12 text-end mt-2">
                                        <button type="submit" class="btn btn-sm btn-primary">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                                <path d="M12 5l0 14" />
                                                <path d="M5 12l14 0" />
                                            </svg>
                                            Add Subcategory
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12">
                    <div class="card py-5 text-center text-muted">
                        No categories found. Click "Add Category" above to create one.
                    </div>
                </div>
            @endforelse
        </div>

        @if($categories->hasPages())
            <div class="mt-4">
                {{ $categories->links('tablar::pagination') }}
            </div>
        @endif
    </div>
</div>
@endsection
