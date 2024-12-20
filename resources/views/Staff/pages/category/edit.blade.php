@extends('Staff.layouts.staff')

@section('title', 'Edit Category') <!-- Page Title -->

@section('content')
<div class="container">
    <!-- Heading Section -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h4 class="text-primary">
            Edit Category
        </h4>
    </div>

    <!-- Edit Category Form -->
    <div class="card shadow-sm">
        <div class="card-body">
            <form action="{{ route('admin.categories.update', $category->id) }}" method="POST">
                @csrf
                @method('PUT')

                <!-- Category Name Input -->
                <div class="form-group mb-3">
                    <label for="category-name" class="form-label">Category Name</label>
                    <input type="text" class="form-control @error('name') is-invalid @enderror"
                        id="category-name" name="category_name" value="{{ old('name', $category->category_name) }}" required>

                    <!-- Validation Error Message -->
                    @error('name')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>

                <!-- Update Button -->
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save"></i> Update Category
                </button>

                <!-- Back Button (optional) -->
                <a href="{{ route('admin.categories.index') }}" class="btn btn-secondary ms-2">
                    <i class="fas fa-arrow-left"></i> Back to Categories
                </a>
            </form>
        </div>
    </div>
</div>
@endsection