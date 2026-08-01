@extends('tablar::page')

@section('title', 'Quote Requests')

@section('content')
<div class="page-header d-print-none">
    <div class="container-xl">
        <div class="row g-2 align-items-center">
            <div class="col">
                <div class="page-pretitle">Inbound Requests</div>
                <h2 class="page-title">Quote Requests & BOQs</h2>
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
                            <th>Contact Info</th>
                            <th>Requirement / Message</th>
                            <th>Uploaded BOQ File</th>
                            <th>Submitted At</th>
                            <th class="w-1">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($quotes as $quote)
                            <tr>
                                <td>
                                    <div class="font-weight-medium">{{ $quote->name }}</div>
                                    <div class="text-muted small">Email: {{ $quote->email }}</div>
                                    <div class="text-muted small">Phone: {{ $quote->phone }}</div>
                                </td>
                                <td>
                                    <div style="max-width: 400px; white-space: normal; word-wrap: break-word;">
                                        {{ $quote->requirement ?: 'No custom message specified.' }}
                                    </div>
                                </td>
                                <td>
                                    @if($quote->boq_url)
                                        <a href="{{ $quote->boq_url }}" target="_blank" class="btn btn-sm btn-outline-info">
                                            <i class="fa fa-download me-1"></i> Download BOQ
                                        </a>
                                    @else
                                        <span class="text-muted small">No file uploaded</span>
                                    @endif
                                </td>
                                <td>{{ $quote->created_at->format('M d, Y H:i') }}</td>
                                <td>
                                    <form action="{{ route('quotes.destroy', $quote->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this quote request?');" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-outline-danger">
                                            Delete
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center text-muted py-4">
                                    No quote requests submitted yet.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            @if($quotes->hasPages())
                <div class="card-footer d-flex align-items-center">
                    {{ $quotes->links('tablar::pagination') }}
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
