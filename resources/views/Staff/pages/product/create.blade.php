@extends('Staff.layouts.staff')

@section('title', 'Create Product')

@section('content')
<div class="container-fluid"> <!-- Full-width container with padding -->
    <div class="row justify-content-center">
        <div class="col-12 col-xl-10"> <!-- Full width on small screens, limited width on larger screens -->
            <div class="card shadow-lg border-0 rounded-4 mx-auto animate__animated animate__fadeInUp"> <!-- Fancy card with animation -->
                <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center py-3 rounded-top">
                    <h3 class="mb-0"><i class="fas fa-box"></i> {{ __('Create Product') }}</h3> <!-- Slightly larger header with icon -->
                    <!-- Back Button Inline -->
                    <a href="{{ route('admin.products.index') }}" class="btn btn-secondary btn-sm shadow-sm">
                        <i class="fas fa-arrow-left"></i> Back to Product Index
                    </a>
                </div>
                <div class="card-body p-4">
                    <!-- Display validation errors -->
                    @if ($errors->any())
                    <div class="alert alert-danger alert-dismissible fade show animate__animated animate__shakeX" role="alert">
                        <strong><i class="fas fa-exclamation-circle"></i> {{ __('Errors detected:') }}</strong>
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                    @endif

                    <!-- Product creation form -->
                    <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data" class="animate__animated animate__fadeIn">
                        @csrf

                        <div class="row g-4"> <!-- Added gap between form fields -->
                            <!-- Product Name -->
                            <div class="col-md-6">
                                <label for="name" class="form-label fw-bold">Product Name</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-light"><i class="fas fa-box"></i></span>
                                    <input type="text" class="form-control form-control-lg rounded-end hover-effect" id="name" name="name" value="{{ old('name') }}" required placeholder="Enter product name">
                                </div>
                            </div>

                            <!-- Category -->
                            <div class="col-md-6">
                                <label for="category_id" class="form-label fw-bold">Category</label>
                                <select class="form-select form-control-lg rounded-3 shadow-sm hover-effect" id="category_id" name="category_id" required>
                                    <option value="" disabled selected>Select a category</option>
                                    @foreach ($categories as $category)
                                    <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                        {{ $category->category_name }}
                                    </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <!-- Price and Quantity -->
                        <div class="row g-4 mt-3">
                            <div class="col-md-6">
                                <label for="price" class="form-label fw-bold">Price</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-light"><i class="fas fa-dollar-sign"></i></span>
                                    <input type="number" step="0.01" class="form-control form-control-lg rounded-end hover-effect" id="price" name="price" value="{{ old('price') }}" required placeholder="Enter product price">
                                </div>
                            </div>

                            <div class="col-md-6">
                                <label for="qty" class="form-label fw-bold">Quantity</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-light"><i class="fas fa-layer-group"></i></span>
                                    <input type="number" class="form-control form-control-lg rounded-end hover-effect" id="qty" name="qty" value="{{ old('quantity') }}" required placeholder="Enter product quantity">
                                </div>
                            </div>
                        </div>

                        <!-- Image Upload -->
                        <div class="row g-4 mt-3">
                            <div class="col-12">
                                <label for="image" class="form-label fw-bold">Product Image</label>
                                <input type="file" class="form-control form-control-lg rounded-3 shadow-sm hover-effect" id="image" name="image">
                            </div>
                        </div>

                        <!-- Description -->
                        <div class="row g-4 mt-3">
                            <div class="col-12">
                                <label for="description" class="form-label fw-bold">Description</label>
                                <textarea class="form-control form-control-lg rounded-3 shadow-sm hover-effect" id="description" name="description" rows="5" required placeholder="Enter product description">{{ old('description') }}</textarea>
                            </div>
                        </div>

                        <!-- Submit Button -->
                        <div class="d-grid gap-2 mt-4">
                            <button type="submit" class="btn btn-success btn-lg shadow-lg rounded-3 hover-effect">
                                <i class="fas fa-check-circle"></i> Create Product
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Hover Effect Styling -->
<style>
    .hover-effect:hover {
        transform: scale(1.05);
        transition: transform 0.3s ease-in-out;
    }
</style>
@endsection