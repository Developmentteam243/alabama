@extends('tablar::page')

@section('title', 'Products Master SKU')

@section('content')
<div class="page-header d-print-none">
    <div class="container-xl">
        <div class="row g-2 align-items-center">
            <div class="col">
                <div class="page-pretitle">SKU Management</div>
                <h2 class="page-title">Products Master List</h2>
            </div>
            <div class="col-12 col-md-auto ms-auto d-print-none">
                <div class="btn-list">
                    <a href="{{ route('products.create') }}" class="btn btn-primary d-none d-sm-inline-block">
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                            <line x1="12" y1="5" x2="12" y2="19"/>
                            <line x1="5" y1="12" x2="19" y2="12"/>
                        </svg>
                        Create Product
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="page-body">
    <div class="container-xl">
        <!-- Alert message -->
        @if(session('success'))
            <div class="alert alert-success alert-dismissible" role="alert">
                <div class="d-flex">
                    <div>
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon alert-icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><circle cx="12" cy="12" r="9" /><path d="M9 12l2 2l4 -4" /></svg>
                    </div>
                    <div>{{ session('success') }}</div>
                </div>
                <a class="btn-close" data-bs-dismiss="alert" aria-label="close"></a>
            </div>
        @endif

        <!-- Filter Form -->
        <div class="card mb-3">
            <div class="card-header">
                <h3 class="card-title">Filters</h3>
            </div>
            <div class="card-body">
                <form action="{{ route('products.index') }}" method="GET">
                    <div class="row g-3">
                        <div class="col-md-3">
                            <label class="form-label">Search</label>
                            <input type="text" name="search" class="form-control" placeholder="SKU, model, part code..." value="{{ request('search') }}">
                        </div>
                        <div class="col-md-3">
                            <label class="form-label">Category</label>
                            <select name="category_id" class="form-select">
                                <option value="">All Categories</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}" {{ request('category_id') == $category->id ? 'selected' : '' }}>
                                        {{ $category->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-3">
                            <label class="form-label">Subcategory</label>
                            <select name="subcategory_id" class="form-select">
                                <option value="">All Subcategories</option>
                                @foreach($subcategories as $subcat)
                                    <option value="{{ $subcat->id }}" {{ request('subcategory_id') == $subcat->id ? 'selected' : '' }}>
                                        {{ $subcat->name }} ({{ $subcat->category->name ?? '' }})
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-2">
                            <label class="form-label">Brand</label>
                            <select name="brand_id" class="form-select">
                                <option value="">All Brands</option>
                                @foreach($brands as $brand)
                                    <option value="{{ $brand->id }}" {{ request('brand_id') == $brand->id ? 'selected' : '' }}>
                                        {{ $brand->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-1 d-flex align-items-end">
                            <button type="submit" class="btn btn-primary w-100">Filter</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <!-- Products Table -->
        <div class="card">
            <div class="table-responsive">
                <table class="table table-vcenter table-mobile-md card-table">
                    <thead>
                        <tr>
                            <th>SKU Code</th>
                            <th>Model Name</th>
                            <th>Brand</th>
                            <th>Subcategory</th>
                            <th>Capacity (L)</th>
                            <th>Orientation</th>
                            <th>Power / Voltage</th>
                            <th class="w-1">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($products as $product)
                            <tr>
                                <td data-label="SKU Code">
                                    <span class="font-weight-bold text-dark">{{ $product->sku_code }}</span>
                                    @if($product->item_code)
                                        <div class="text-muted small">Item: {{ $product->item_code }}</div>
                                    @endif
                                </td>
                                <td data-label="Model Name">
                                    {{ $product->model_name ?: 'N/A' }}
                                    @if($product->product_family)
                                        <div class="text-muted small">Family: {{ $product->product_family }}</div>
                                    @endif
                                </td>
                                <td data-label="Brand">
                                    {{ $product->brand->name ?? 'N/A' }}
                                </td>
                                <td data-label="Subcategory">
                                    {{ $product->subcategory->name ?? 'N/A' }}
                                </td>
                                <td data-label="Capacity">
                                    {{ $product->capacity_l ?: '-' }}
                                </td>
                                <td data-label="Orientation">
                                    {{ $product->orientation_mounting ?: '-' }}
                                </td>
                                <td data-label="Power / Voltage">
                                    {{ $product->heating_power_kw ?: '-' }} kW / {{ $product->voltage ?: '-' }}
                                </td>
                                <td>
                                    <div class="btn-list flex-nowrap">
                                        <a href="{{ route('products.show', $product->id) }}" class="btn btn-outline-info btn-icon btn-sm">
                                            View
                                        </a>
                                        <a href="{{ route('products.edit', $product->id) }}" class="btn btn-outline-warning btn-icon btn-sm">
                                            Edit
                                        </a>
                                        <form action="{{ route('products.destroy', $product->id) }}" method="POST" onsubmit="return confirm('Are you sure?');" style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-outline-danger btn-icon btn-sm">
                                                Delete
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="text-center text-muted py-4">No products found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            @if($products->hasPages())
                <div class="card-footer d-flex align-items-center">
                    {{ $products->links('tablar::pagination') }}
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
