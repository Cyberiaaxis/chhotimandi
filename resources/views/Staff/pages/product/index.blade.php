@extends('Staff.layouts.staff')

@section('title', 'Products')

@section('content')

<!-- Display the success message -->
@if(session('success'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
    <strong>Success!</strong> {{ session('success') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif

<div class="container-fluid m-0 p-0">

    <!-- Row for Title and Button (Responsive) -->
    <div class="row mb-4">
        <div class="col-12 col-md-6 d-flex justify-content-start mb-2 mb-md-0">
            <h4>Products</h4>
        </div>

        <div class="col-12 col-md-6 d-flex justify-content-end">
            <a href="{{ route('admin.products.create') }}" class="btn btn-lg btn-primary rounded-pill">
                <i class="fas fa-plus-circle me-2"></i> Add Product
            </a>
        </div>
    </div>

    <!-- Product Table -->
    <div class="row">
        <div class="col-12">
            <div class="card shadow-sm border-0">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-hover">
                            <thead class="table-light">
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Product Name</th>
                                    <th scope="col">Image</th>
                                    <th scope="col">Category</th>
                                    <th scope="col">Price</th>
                                    <th scope="col">Quantity</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($products as $product)
                                <tr class="{{ session('lastInsertedProduct') == $product->id ? 'bg-info text-white' : '' }}">
                                    <th scope="row">{{ $product->id }}</th>
                                    <td>{{ $product->name }}</td>
                                    <td>
                                        @if($product->image)
                                        <img src="{{ asset('storage/images/' . $product->image) }}" alt="Product Image" class="img-fluid" style="width: 50px; height: 50px; object-fit: cover;">
                                        @else
                                        <span class="text-muted">No image</span>
                                        @endif
                                    </td>
                                    <td>{{ $product->category->category_name }}</td>
                                    <td>${{ number_format($product->price, 2) }}</td>
                                    <td>{{ $product->qty }}</td>
                                    <td>
                                        <span class="badge {{ $product->is_active ? 'bg-success' : 'bg-danger' }}" data-bs-toggle="tooltip"
                                            title="{{ $product->is_active ? 'Product is Active' : 'Product is Disabled' }}">
                                            {{ $product->is_active ? 'Active' : 'Disabled' }}
                                        </span>
                                    </td>
                                    <td>
                                        <!-- Show Button -->
                                        <button type="button" class="btn btn-info btn-sm rounded-circle" data-bs-toggle="modal" data-bs-target="#showModal{{ $product->id }}"
                                            data-bs-toggle="tooltip" title="View Product" data-bs-placement="top">
                                            <i class="fas fa-eye"></i>
                                        </button>

                                        <!-- Edit Button -->
                                        <a href="{{ route('admin.products.edit', $product->id) }}" class="btn btn-warning btn-sm rounded-circle"
                                            data-bs-toggle="tooltip" title="Edit Product" data-bs-placement="top">
                                            <i class="fas fa-edit"></i>
                                        </a>

                                        <!-- Delete Button -->
                                        <button type="button" class="btn btn-danger btn-sm rounded-circle" data-bs-toggle="modal"
                                            data-bs-target="#deleteModal{{ $product->id }}" data-bs-toggle="tooltip" title="Delete Product" data-bs-placement="top">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </td>
                                </tr>

                                <!-- Show Product Modal -->
                                <div class="modal fade" id="showModal{{ $product->id }}" tabindex="-1" aria-labelledby="showModalLabel{{ $product->id }}" aria-hidden="true">
                                    <div class="modal-dialog modal-lg">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="showModalLabel{{ $product->id }}">Product Details</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="row">
                                                    <!-- Product Image -->
                                                    <div class="col-12 text-center mb-4">
                                                        @if($product->image)
                                                        <img src="{{ asset('storage/images/' . $product->image) }}" alt="Product Image" class="img-fluid rounded shadow-sm" style="max-width: 100%; height: auto; max-height: 300px;">
                                                        @else
                                                        <span class="text-muted">No image available</span>
                                                        @endif
                                                    </div>
                                                </div>

                                                <div class="row gy-3">
                                                    <!-- Product Details -->
                                                    <div class="col-12 col-md-6">
                                                        <p><strong>Product Name:</strong> {{ $product->name }}</p>
                                                    </div>
                                                    <div class="col-12 col-md-6">
                                                        <p><strong>Category:</strong> {{ $product->category->category_name }}</p>
                                                    </div>
                                                    <div class="col-12">
                                                        <p><strong>Description:</strong> {{ $product->description ?? 'No description available' }}</p>
                                                    </div>
                                                    <div class="col-12 col-md-6">
                                                        <p><strong>Price:</strong> ${{ number_format($product->price, 2) }}</p>
                                                    </div>
                                                    <div class="col-12 col-md-6">
                                                        <p><strong>Status:</strong>
                                                            <span class="badge {{ $product->is_active ? 'bg-success' : 'bg-danger' }}">
                                                                {{ $product->is_active ? 'Active' : 'Disabled' }}
                                                            </span>
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Delete Confirmation Modal -->
                                <div class="modal fade" id="deleteModal{{ $product->id }}" tabindex="-1" aria-labelledby="deleteModalLabel{{ $product->id }}" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="deleteModalLabel{{ $product->id }}">Confirm Deletion</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                Are you sure you want to delete this product? This action cannot be undone.
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                                <!-- Delete Form -->
                                                <form action="{{ route('admin.products.destroy', $product->id) }}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger">Delete</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection