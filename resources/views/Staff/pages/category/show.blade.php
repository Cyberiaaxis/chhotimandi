@extends('Staff.layouts.staff')

@section('title', 'Category Details') <!-- Title of the page shown in browser tab -->

@section('content')
<div class="container">
    <!-- Main Title of the Page -->
    <h1 class="mb-4">Category Details</h1>

    <!-- Category Information Card -->
    <div class="card">
        <div class="card-header">
            <!-- Category Name Header -->
            <h4>{{ $category->category_name }}</h4> <!-- Display the category name dynamically -->
        </div>
        <div class="card-body">
            <!-- Category Details -->
            <p><strong>Category Name:</strong> {{ $category->category_name }}</p> <!-- Display the category name -->
        </div>
    </div>

    <!-- Back to Categories Button -->
    <a href="{{ route('admin.categories.index') }}" class="btn btn-secondary mt-3">
        <!-- Icon for the Back Button -->
        <i class="fas fa-arrow-left"></i> Back to Categories
    </a>
</div>
@endsection