@extends('Staff.layouts.staff')

@section('title', 'Add chef')

@section('content')
<div class="container">
    <h2 class="mb-4">Add New Chef</h2>

    <form action="{{ route('admin.chefs.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="name">Chef Name</label>
            <input type="text" class="form-control" name="name" required>
        </div>
        <div class="form-group">
            <label for="specialty">Specialty</label>
            <input type="text" class="form-control" name="specialty" required>
        </div>
        <div class="form-group">
            <label for="image">Image</label>
            <input type="file" class="form-control" name="image">
        </div>
        <button type="submit" class="btn btn-primary mt-3">Save</button>
    </form>
</div>
@endsection