@extends('Staff.layouts.staff')

@section('title', 'Create Role')

@section('content')
<div class="container mt-5">
    <div class="card shadow-lg p-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <!-- Back Button -->
            <a href="{{ route('admin.roles.index') }}" class="btn btn-outline-dark" title="Back to Roles">
                <i class="fas fa-arrow-left"></i> Back
            </a>
            <h3 class="text-center">Create Role</h3>
        </div>
        <form action="{{ route('admin.roles.store') }}" method="POST">
            @csrf

            <!-- Role Name -->
            <div class="form-group">
                <label for="name" class="font-weight-bold">Role Name:</label>
                <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}" placeholder="Enter role name" required>
                @error('name')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <!-- Permissions -->
            <div class="form-group mt-4">
                <h5 class="font-weight-bold">Assign Permissions:</h5>
                <div class="permissions-list">
                    @foreach ($permissions as $permission)
                    <div class="form-check custom-checkbox">
                        <input class="form-check-input" type="checkbox" name="permissions[]" value="{{ $permission->id }}" id="permission_{{ $permission->id }}">
                        <label class="form-check-label" for="permission_{{ $permission->id }}">
                            <i class="fa fa-check-circle"></i> {{ $permission->name }}
                        </label>
                    </div>
                    @endforeach
                </div>
            </div>

            <!-- Submit Button -->
            <div class="form-group text-center mt-4">
                <button type="submit" class="btn btn-primary btn-lg px-4 py-2" data-bs-toggle="tooltip" data-bs-placement="top" title="Create Role">
                    <i class="fas fa-save"></i>
                </button>
            </div>
        </form>
    </div>
</div>

@section('scripts')
<script>
    // Enable tooltips on page load
    var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
    var tooltipList = tooltipTriggerList.map(function(tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl);
    });
</script>
@endsection

@endsection