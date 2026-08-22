@extends('tablar::page')

@section('title', 'Product Reviews')

@section('content')
<div class="page-header d-print-none">
    <div class="container-xl">
        <div class="row g-2 align-items-center">
            <div class="col">
                <div class="page-pretitle">Moderation</div>
                <h2 class="page-title">Product Reviews</h2>
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
                            <th>Reviewer</th>
                            <th>Product</th>
                            <th>Rating</th>
                            <th>Comment</th>
                            <th>Status</th>
                            <th>Submitted At</th>
                            <th class="w-1">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($reviews as $review)
                            <tr>
                                <td>
                                    <div class="font-weight-medium">{{ $review->customer_name }}</div>
                                    <div class="text-muted small">{{ $review->customer_email }}</div>
                                </td>
                                <td>
                                    @if($review->product)
                                        <a href="{{ route('products.edit', $review->product->id) }}" target="_blank">
                                            {{ $review->product->model_name ?: $review->product->sku_code }}
                                        </a>
                                    @else
                                        <span class="text-muted">Deleted Product</span>
                                    @endif
                                </td>
                                <td>
                                    <div class="text-warning">
                                        @for($i = 1; $i <= 5; $i++)
                                            @if($i <= $review->rating)
                                                <i class="fa fa-star"></i>
                                            @else
                                                <i class="fa-regular fa-star"></i>
                                            @endif
                                        @endfor
                                    </div>
                                    <span class="text-muted small">({{ $review->rating }}/5)</span>
                                </td>
                                <td>
                                    <div style="max-width: 300px; white-space: normal; word-wrap: break-word;">
                                        {{ $review->comment }}
                                    </div>
                                </td>
                                <td>
                                    @if($review->is_approved)
                                        <span class="badge bg-success-lite text-success">Approved</span>
                                    @else
                                        <span class="badge bg-warning-lite text-warning">Pending</span>
                                    @endif
                                </td>
                                <td>{{ $review->created_at->format('M d, Y H:i') }}</td>
                                <td>
                                    <div class="btn-list flex-nowrap">
                                        <form action="{{ route('reviews.update', $review->id) }}" method="POST" style="display:inline;">
                                            @csrf
                                            @method('PUT')
                                            <input type="hidden" name="is_approved" value="{{ $review->is_approved ? 0 : 1 }}">
                                            @if($review->is_approved)
                                                <button type="submit" class="btn btn-sm btn-outline-warning d-inline-flex align-items-center gap-1">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                        <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                                        <path d="M12 12m-9 0a9 9 0 1 0 18 0a9 9 0 1 0 -18 0" />
                                                        <path d="M9 12l6 0" />
                                                    </svg>
                                                    Disapprove
                                                </button>
                                            @else
                                                <button type="submit" class="btn btn-sm btn-outline-success d-inline-flex align-items-center gap-1">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                        <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                                        <path d="M5 12l5 5l10 -10" />
                                                    </svg>
                                                    Approve
                                                </button>
                                            @endif
                                        </form>
                                        
                                        <form action="{{ route('reviews.destroy', $review->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this review?');" style="display:inline;">
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
                                <td colspan="7" class="text-center text-muted py-4">
                                    No product reviews submitted yet.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            @if($reviews->hasPages())
                <div class="card-footer d-flex align-items-center">
                    {{ $reviews->links('tablar::pagination') }}
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
