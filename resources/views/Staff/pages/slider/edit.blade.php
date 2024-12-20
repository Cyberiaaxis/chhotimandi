@extends('Staff.layouts.staff')

@section('title', 'Edit Slider')

@section('content')
<div class="container">
    <h1 class="my-4">Edit Slider</h1>

    <!-- Form for editing the slider -->
    <form action="{{ route('admin.sliders.update', $slider->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT') <!-- This tells Laravel we are updating an existing resource -->

        <div class="mb-3">
            <label for="image" class="form-label">Image</label>
            <input type="file" name="image" class="form-control">
            <div class="mt-2">
                <img src="{{ asset($slider->image_path) }}" alt="Current Slider Image" class="img-fluid" style="max-height: 200px; object-fit: cover;">
            </div>
            @error('image')
            <div class="text-danger mt-2">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="title" class="form-label">Title</label>
            <input type="text" name="title" class="form-control" value="{{ old('title', $slider->title) }}">
            @error('title')
            <div class="text-danger mt-2">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="description" class="form-label">Description</label>
            <textarea name="description" class="form-control" rows="4">{{ old('description', $slider->description) }}</textarea>
            @error('description')
            <div class="text-danger mt-2">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="order" class="form-label">Order Number</label>
            <input type="number" name="order" class="form-control" value="{{ old('order', $slider->order) }}">
            @error('order')
            <div class="text-danger mt-2">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary">Update Slider</button>
    </form>
</div>
@endsection