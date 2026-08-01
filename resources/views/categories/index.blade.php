@extends('tablar::page')

@section('title', 'Categories & Subcategories')

@section('content')
<div class="page-header d-print-none">
    <div class="container-xl">
        <div class="row g-2 align-items-center">
            <div class="col">
                <div class="page-pretitle">SKU Management</div>
                <h2 class="page-title">Categories & Subcategories</h2>
            </div>
            <div class="col-12 col-md-auto ms-auto d-print-none">
                <div class="btn-list">
                    <a href="{{ route('categories.create') }}" class="btn btn-primary">
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
                            <div>
                                <h3 class="card-title">{{ $category->name }}</h3>
                                <span class="badge bg-blue-lite text-blue mt-1">Code: {{ $category->code ?: 'N/A' }}</span>
                            </div>
                            <div class="btn-list">
                                <a href="{{ route('categories.edit', $category->id) }}" class="btn btn-sm btn-outline-warning">
                                    Edit
                                </a>
                                <form action="{{ route('categories.destroy', $category->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this category and all its subcategories?');" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-outline-danger">
                                        Delete
                                    </button>
                                </form>
                            </div>
                        </div>
                        <div class="card-body">
                            <h4>Subcategories:</h4>
                            @if($category->subcategories->count() > 0)
                                <ul class="list-group mb-3">
                                    @foreach($category->subcategories as $subcat)
                                        <li class="list-group-item d-flex justify-content-between align-items-center">
                                            <div>
                                                <strong>{{ $subcat->name }}</strong>
                                                <span class="badge bg-secondary-lite text-secondary ms-2">{{ $subcat->code ?: 'N/A' }}</span>
                                            </div>
                                            <div class="d-flex align-items-center gap-2">
                                                <a href="{{ route('subcategories.edit', $subcat->id) }}" class="btn btn-sm text-warning p-0 border-0 bg-transparent">
                                                    Edit
                                                </a>
                                                <span class="text-muted small">|</span>
                                                <form action="{{ route('subcategories.destroy', $subcat->id) }}" method="POST" onsubmit="return confirm('Are you sure?');" style="display:inline;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm text-danger border-0 bg-transparent p-0">
                                                        Remove
                                                    </button>
                                                </form>
                                            </div>
                                        </li>
                                    @endforeach
                                </ul>
                            @else
                                <p class="text-muted small">No subcategories defined.</p>
                            @endif

                            <!-- Form to Add Subcategory -->
                            <form action="{{ route('categories.subcategories.store', $category->id) }}" method="POST" class="border-top pt-3 mt-3">
                                @csrf
                                <div class="row g-2">
                                    <div class="col-7">
                                        <input type="text" name="name" class="form-control form-control-sm" placeholder="New Subcategory Name" required>
                                    </div>
                                    <div class="col-3">
                                        <input type="text" name="code" class="form-control form-control-sm" placeholder="Code (e.g. GB)" required>
                                    </div>
                                    <div class="col-2">
                                        <button type="submit" class="btn btn-sm btn-primary w-100">Add</button>
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
