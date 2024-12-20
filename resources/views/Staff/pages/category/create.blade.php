@extends('Staff.layouts.staff')

@section('title', 'Create Category') <!-- Page Title -->

@section('content')
<div class="container">
    <!-- Page Heading Section -->
    <h1 class="mb-4">Create New Category</h1>

    <!-- Display any validation errors -->
    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
            <!-- Loop through each error and display it -->
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <!-- Category Creation Form -->
    <form action="{{ route('admin.categories.store') }}" method="POST">
        @csrf <!-- CSRF token for security to prevent Cross-Site Request Forgery attacks -->

        <!-- Category Name Input Field -->
        <div class="mb-3">
            <label for="name" class="form-label">Category Name</label>
            <input
                type="text"
                class="form-control"
                id="name"
                name="category_name"
                value="{{ old('category_name') }}"
                required>
            <!-- Help text displayed below the input field for more user guidance -->
            <small class="form-text text-danger">
                Enter a unique and descriptive name for the category. <span class="text-danger">*</span>
            </small>
        </div>

        <!-- Submit Button to Create the Category -->
        <button type="submit" class="btn btn-primary">Create Category</button>

        <!-- Link Button to Go Back to Categories List -->
        <a href="{{ route('admin.categories.index') }}" class="btn btn-secondary ms-2">
            <i class="fas fa-arrow-left"></i> Back to Categories
        </a>
    </form>
</div>
@endsection