@extends('Staff.layouts.staff')

@section('title', 'Edit Product')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-12 col-md-10 col-lg-8">
            <div class="card shadow-lg border-0 rounded-4">
                <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center rounded-top">
                    <h4 class="fw-bold mb-0">{{ __('Edit Product') }}</h4>
                    <!-- Back Button Inline -->
                    <a href="{{ route('admin.products.index') }}" class="btn btn-secondary btn-sm shadow-sm">
                        <i class="fas fa-arrow-left"></i> Back to Product Index
                    </a>
                </div>
                <div class="card-body p-4">
                    <!-- Display validation errors -->
                    @if ($errors->any())
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <strong>{{ __('Please fix the following errors:') }}</strong>
                        <ul class="mb-0 mt-2">
                            @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                    @endif

                    <!-- Edit Product Form -->
                    <form action="{{ route('admin.products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <!-- Active Status -->
                        <div class="mb-4 text-center">
                            <div class="form-check form-switch d-inline-flex align-items-center">
                                <input type="checkbox" class="form-check-input me-2" id="is_active" name="is_active" value="1" {{ old('is_active', $product->is_active) ? 'checked' : '' }}>
                                <label for="is_active" class="form-check-label fw-bold fs-5">Product is Active</label>
                            </div>
                        </div>

                        <div class="row gy-4">
                            <!-- Product Name -->
                            <div class="col-md-6">
                                <label for="name" class="form-label fw-bold">Product Name</label>
                                <input type="text" class="form-control form-control-lg rounded-3 shadow-sm" id="name" name="name" value="{{ old('name', $product->name) }}" required>
                            </div>

                            <!-- Category -->
                            <div class="col-md-6">
                                <label for="category_id" class="form-label fw-bold">Category</label>
                                <select class="form-select form-control-lg rounded-3 shadow-sm" id="category_id" name="category_id" required>
                                    <option value="" disabled>Select a category</option>
                                    @foreach ($categories as $category)
                                    <option value="{{ $category->id }}" {{ $category->id == old('category_id', $product->category_id) ? 'selected' : '' }}>
                                        {{ $category->category_name }}
                                    </option>
                                    @endforeach
                                </select>
                            </div>

                            <!-- Price -->
                            <div class="col-md-4">
                                <label for="price" class="form-label fw-bold">Price</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-light">$</span>
                                    <input type="number" step="0.01" class="form-control form-control-lg rounded-3 shadow-sm" id="price" name="price" value="{{ old('price', $product->price) }}" required>
                                </div>
                            </div>

                            <!-- Quantity -->
                            <div class="col-md-4">
                                <label for="qty" class="form-label fw-bold">Quantity</label>
                                <input type="number" class="form-control form-control-lg rounded-3 shadow-sm" id="qty" name="qty" value="{{ old('qty', $product->qty) }}" required>
                            </div>

                            <!-- Product Image -->
                            <div class="col-md-4">
                                <label for="image" class="form-label fw-bold">Product Image</label>
                                <input type="file" class="form-control form-control-lg rounded-3 shadow-sm" id="image" name="image">

                                <!-- Display existing image (if available) -->
                                @if($product->image)
                                <div class="mt-3">
                                    <img src="{{ asset('storage/images/' . $product->image) }}" alt="Product Image" class="img-fluid rounded-3 shadow-sm" width="100%">
                                    <p class="mt-2 text-center">Current Image</p>
                                </div>
                                @endif
                            </div>
                        </div>

                        <div class="mb-4">
                            <label for="description" class="form-label fw-bold">Description</label>
                            <textarea class="form-control form-control-lg rounded-3 shadow-sm" id="description" name="description" rows="5" required>{{ old('description', $product->description) }}</textarea>
                        </div>

                        <!-- Submit Button -->
                        <div class="d-flex justify-content-end">
                            <button type="submit" class="btn btn-success btn-lg shadow-lg w-auto">
                                Update Product
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection