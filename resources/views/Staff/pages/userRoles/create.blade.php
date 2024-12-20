@extends('Staff.layouts.staff')

@section('title', 'Assign Role to User')

@section('content')
<div class="container py-4">
    <h1 class="mb-4">Assign Roles to User</h1>

    <!-- Success Message -->
    @if (session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif

    <!-- Error Messages -->
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

    <!-- Form to Assign Roles -->
    <form action="{{ route('admin.assignRole.store') }}" method="POST">
        @csrf

        <!-- Select User -->
        <div class="form-group mb-3">
            <label for="user_id" class="form-label">Select User</label>
            <select name="user_id" id="user_id" class="form-select @error('user_id') is-invalid @enderror" required>
                <option value="" disabled selected>Select a user</option>
                @foreach ($users as $user)
                <option value="{{ $user->id }}" {{ old('user_id') == $user->id ? 'selected' : '' }}>{{ $user->name }}</option>
                @endforeach
            </select>
            @error('user_id')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <!-- Select Roles -->
        <div class="form-group mb-4">
            <label for="roles" class="form-label">Select Roles</label>
            <select name="roles[]" id="roles" class="form-select @error('roles') is-invalid @enderror" multiple required>
                @foreach ($roles as $role)
                <option value="{{ $role->name }}" {{ in_array($role->name, old('roles', [])) ? 'selected' : '' }}>
                    {{ ucfirst($role->name) }}
                </option>
                @endforeach
            </select>
            <small class="form-text text-muted">Hold down Ctrl (Windows) or Command (Mac) to select multiple roles.</small>
            @error('roles')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <!-- Action Buttons -->
        <div class="d-flex justify-content-between">
            <button type="submit" class="btn btn-primary">
                <i class="fas fa-check-circle"></i> Assign Roles
            </button>
            <a href="{{ route('admin.assignRole.index') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left"></i> Back
            </a>
        </div>
    </form>
</div>
@endsection