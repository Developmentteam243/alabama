@extends('tablar::page')

@section('title', 'Product Details')

@section('content')
<div class="page-header d-print-none">
    <div class="container-xl">
        <div class="row g-2 align-items-center">
            <div class="col">
                <h2 class="page-title">Product Details: {{ $product->sku_code }}</h2>
            </div>
            <div class="col-12 col-md-auto ms-auto d-print-none">
                <div class="btn-list">
                    <a href="{{ route('products.edit', $product->id) }}" class="btn btn-warning">
                        Edit Product
                    </a>
                    <a href="{{ route('products.index') }}" class="btn btn-outline-secondary">
                        Back to List
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="page-body">
    <div class="container-xl">
        <div class="row row-cards">
            <!-- Basic Details Card -->
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">General Specifications</h3>
                    </div>
                    <div class="card-body">
                        <table class="table table-striped table-bordered">
                            <tr>
                                <th>SKU Code</th>
                                <td><span class="badge bg-blue text-blue-fg">{{ $product->sku_code }}</span></td>
                            </tr>
                            <tr>
                                <th>Item Code</th>
                                <td>{{ $product->item_code ?: 'N/A' }}</td>
                            </tr>
                            <tr>
                                <th>Brand</th>
                                <td>{{ $product->brand->name ?? 'N/A' }} ({{ $product->brand->code ?? '' }})</td>
                            </tr>
                            <tr>
                                <th>Category</th>
                                <td>{{ $product->subcategory->category->name ?? 'N/A' }}</td>
                            </tr>
                            <tr>
                                <th>Subcategory</th>
                                <td>{{ $product->subcategory->name ?? 'N/A' }}</td>
                            </tr>
                            <tr>
                                <th>Model Name</th>
                                <td>{{ $product->model_name ?: 'N/A' }}</td>
                            </tr>
                            <tr>
                                <th>Product Family</th>
                                <td>{{ $product->product_family ?: 'N/A' }}</td>
                            </tr>
                            <tr>
                                <th>Product Type</th>
                                <td>{{ $product->product_type ?: 'N/A' }}</td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>

            <!-- Technical specs -->
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Technical Specifications</h3>
                    </div>
                    <div class="card-body">
                        <table class="table table-striped table-bordered">
                            <tr>
                                <th>Capacity (L)</th>
                                <td>{{ $product->capacity_l ?: 'N/A' }}</td>
                            </tr>
                            <tr>
                                <th>Orientation / Mounting</th>
                                <td>{{ $product->orientation_mounting ?: 'N/A' }}</td>
                            </tr>
                            <tr>
                                <th>Heating Power (kW)</th>
                                <td>{{ $product->heating_power_kw ?: 'N/A' }}</td>
                            </tr>
                            <tr>
                                <th>Voltage</th>
                                <td>{{ $product->voltage ?: 'N/A' }}</td>
                            </tr>
                            <tr>
                                <th>Max Working Pressure (bar)</th>
                                <td>{{ $product->max_working_pressure_bar ?: 'N/A' }}</td>
                            </tr>
                            <tr>
                                <th>Dimensions (H x W / L x D)</th>
                                <td>
                                    Height/Length: {{ $product->height_length_mm ?: 'N/A' }} mm <br>
                                    Diameter/Width: {{ $product->diameter_width_mm ?: 'N/A' }} mm
                                </td>
                            </tr>
                            <tr>
                                <th>Tank Protection / Lining</th>
                                <td>{{ $product->tank_protection_lining ?: 'N/A' }}</td>
                            </tr>
                            <tr>
                                <th>Heating Element</th>
                                <td>{{ $product->heating_element ?: 'N/A' }}</td>
                            </tr>
                            <tr>
                                <th>Warranty (yrs)</th>
                                <td>{{ $product->warranty_yrs ?: 'N/A' }} years</td>
                            </tr>
                            <tr>
                                <th>Mfr Part Code</th>
                                <td>{{ $product->mfr_part_code ?: 'N/A' }}</td>
                            </tr>
                            <tr>
                                <th>Source Catalogue</th>
                                <td>{{ $product->source_catalogue ?: 'N/A' }}</td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>

            <!-- Notes -->
            @if($product->notes)
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Notes / Warranty Details</h3>
                        </div>
                        <div class="card-body text-secondary">
                            {{ $product->notes }}
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
