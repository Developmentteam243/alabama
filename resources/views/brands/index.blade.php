@extends('tablar::page')

@section('title', 'Brands')

@section('content')
<div class="page-header d-print-none">
    <div class="container-xl">
        <div class="row g-2 align-items-center">
            <div class="col">
                <div class="page-pretitle">SKU Management</div>
                <h2 class="page-title">Brands</h2>
            </div>
            <div class="col-12 col-md-auto ms-auto d-print-none">
                <div class="btn-list">
                    <a href="{{ route('brands.create') }}" class="btn btn-primary">
                        Add Brand
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
                            <th>Brand Code</th>
                            <th>Brand Name</th>
                            <th>Manufacturer / Principal</th>
                            <th>Country of Origin</th>
                            <th class="w-1">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($brands as $brand)
                            <tr>
                                <td><span class="badge bg-blue text-blue-fg">{{ $brand->code }}</span></td>
                                <td><strong>{{ $brand->name }}</strong></td>
                                <td>{{ $brand->manufacturer ?: '-' }}</td>
                                <td>{{ $brand->country_of_origin ?: '-' }}</td>
                                <td>
                                    <div class="btn-list flex-nowrap">
                                        <a href="{{ route('brands.edit', $brand->id) }}" class="btn btn-outline-warning btn-sm">
                                            Edit
                                        </a>
                                        <form action="{{ route('brands.destroy', $brand->id) }}" method="POST" onsubmit="return confirm('Are you sure? This will delete all associated products!');" style="display:inline;">
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
                                <td colspan="5" class="text-center text-muted py-4">No brands found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            @if($brands->hasPages())
                <div class="card-footer d-flex align-items-center">
                    {{ $brands->links('tablar::pagination') }}
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
