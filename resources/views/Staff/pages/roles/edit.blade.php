@extends('Staff.layouts.staff')

@section('title', 'Edit Role')

@section('content')
<div class="container-fluid py-4">
    <div class="row">
        <!-- Main Content -->
        <div class="col-md-8 offset-md-2">
            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                    <h3 class="mb-0">Edit Role</h3>
                    <!-- Back Button -->
                    <a href="{{ route('admin.roles.index') }}" class="btn btn-outline-light" title="Back to Roles">
                        <i class="fas fa-arrow-left"></i> Back
                    </a>
                </div>
                <div class="card-body">
                    <!-- Form to Edit Role -->
                    <form action="{{ route('admin.roles.update', $role->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <!-- Role Name Field -->
                        <div class="mb-3">
                            <label for="name" class="form-label">Role Name:</label>
                            <input type="text" name="name" id="name" class="form-control" value="{{ $role->name }}" required>
                        </div>

                        <!-- Permissions Section -->
                        <div class="mb-3">
                            <h5>Modify Permissions:</h5>
                            <div class="row">
                                @foreach ($permissions as $permission)
                                <div class="col-md-6">
                                    <div class="form-check">
                                        <input type="checkbox" class="form-check-input" name="permissions[]" value="{{ $permission->id }}"
                                            @if (in_array($permission->id, $rolePermissions)) checked @endif>
                                        <label class="form-check-label" for="permission{{ $permission->id }}">
                                            {{ $permission->name }}
                                        </label>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>

                        <!-- Submit and Cancel Buttons -->
                        <div class="d-flex justify-content-between mt-4">
                            <button type="submit" class="btn btn-primary btn-lg" data-bs-toggle="tooltip" data-bs-placement="top" title="Update Role">
                                <i class="fas fa-save"></i>
                            </button>
                            <a href="{{ route('admin.roles.index') }}" class="btn btn-secondary btn-lg" data-bs-toggle="tooltip" data-bs-placement="top" title="Cancel">
                                <i class="fas fa-times"></i>
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
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