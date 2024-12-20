@extends('Staff.layouts.staff')

@section('title', 'Slides')

@section('content')
<div class="container">
    <h1 class="my-4">Manage Sliders</h1>

    <!-- Add New Slider Button -->
    <a href="{{ route('admin.sliders.create') }}" class="btn btn-primary mb-4">Add New Slider</a>

    <!-- Slider List -->
    <div class="table-responsive">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Order</th>
                    <th>Image</th>
                    <th>Title</th>
                    <th>Description</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($sliders as $slider)
                <tr>
                    <!-- Order -->
                    <td>
                        {{ $slider->order }}
                    </td>

                    <!-- Image -->
                    <td>
                        <img src="{{ asset($slider->image_path) }}" alt="Slider Image" class="img-fluid" style="height: 100px; object-fit: cover;">
                    </td>

                    <!-- Title -->
                    <td>{{ $slider->title }}</td>

                    <!-- Description -->
                    <td>{{ $slider->description }}</td>

                    <!-- Actions -->
                    <td>
                        <a href="{{ route('admin.sliders.edit', $slider->id) }}" class="btn btn-warning btn-sm">Edit</a>

                        <!-- Delete Slider Form -->
                        <form action="{{ route('admin.sliders.destroy', $slider->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this slider?')">Delete</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection