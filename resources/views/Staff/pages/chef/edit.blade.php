@extends('Staff.layouts.staff')

@section('title', 'Modify chef')

@section('content')
<div class="container">
    <h2 class="mb-4">Edit Chef</h2>

    <form action="{{ route('admin.chefs.update', $chef->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="name">Chef Name</label>
            <input type="text" class="form-control" name="name" value="{{ $chef->name }}" required>
        </div>
        <div class="form-group">
            <label for="specialty">Specialty</label>
            <input type="text" class="form-control" name="specialty" value="{{ $chef->specialty }}" required>
        </div>
        <div class="form-group">
            <label for="image">Image</label>
            <input type="file" class="form-control" name="image">
            @if($chef->image)
            <img src="{{ asset('storage/' . $chef->image) }}" alt="{{ $chef->name }}" width="100" class="mt-2">
            @endif
        </div>
        <button type="submit" class="btn btn-primary mt-3">Update</button>
    </form>
</div>
@endsection