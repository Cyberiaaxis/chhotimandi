@extends('Staff.layouts.staff')

@section('title', 'Reassign Roles')

@section('content')
<div class="container py-5">
    <h1 class="mb-4">Edit Roles for {{ $user->name }}</h1>

    <!-- Success and Error Messages -->
    @if (session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif

    @if ($errors->any())
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif

    <!-- Form to Reassign Roles -->
    <form action="{{ route('admin.assignRole.update', $user->id) }}" method="POST">
        @csrf
        @method('PUT')

        <!-- Select Roles -->
        <div class="mb-4">
            <label for="roles" class="form-label">Assign Roles</label>
            <select name="roles[]" id="roles" class="form-select @error('roles') is-invalid @enderror" multiple required>
                @foreach ($roles as $role)
                <option value="{{ $role->name }}"
                    {{ $user->roles->pluck('name')->contains($role->name) ? 'selected' : '' }}>
                    {{ ucfirst($role->name) }}
                </option>
                @endforeach
            </select>
            @error('roles')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
            <small class="form-text text-muted">Hold down Ctrl (Windows) or Command (Mac) to select multiple roles.</small>
        </div>

        <!-- Action Buttons -->
        <div class="d-flex justify-content-between">
            <button type="submit" class="btn btn-success">
                <i class="fas fa-check-circle"></i> Update Roles
            </button>
            <a href="{{ route('admin.assignRole.index') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left"></i> Back
            </a>
        </div>
    </form>
</div>
@endsection