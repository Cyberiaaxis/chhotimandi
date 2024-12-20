@extends('Staff.layouts.staff')

@section('title', 'Chefs')

@section('content')
<div class="container">
    <h2 class="mb-4">Chefs</h2>
    <a href="{{ route('admin.chefs.create') }}" class="btn btn-primary mb-3">Add New Chef</a>

    @if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table">
        <thead>
            <tr>
                <th>Name</th>
                <th>Specialty</th>
                <th>Image</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($chefs as $chef)
            <tr>
                <td>{{ $chef->name }}</td>
                <td>{{ $chef->specialty }}</td>
                <td><img src="{{ asset('storage/' . $chef->image) }}" alt="{{ $chef->name }}" width="50"></td>
                <td>
                    <a href="{{ route('admin.chefs.edit', $chef->id) }}" class="btn btn-warning">Edit</a>
                    <form action="{{ route('admin.chefs.destroy', $chef->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection