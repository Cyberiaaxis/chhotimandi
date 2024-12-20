@extends('Staff.layouts.staff')

@section('title', 'Permissions')

@section('content')
<div class="container-fluid py-5">
    <div class="row">
        <!-- Main Content Section -->
        <div class="col-12">
            <!-- Flex Container for Inline Elements -->
            <div class="d-flex justify-content-between align-items-center mb-4">
                <!-- Create Permission Button (on the left) -->
                <a href="{{ route('admin.permissions.create') }}" class="btn btn-primary btn-lg" data-bs-toggle="tooltip" title="Create a new permission">
                    <i class="fas fa-plus-circle"></i>
                </a>

                <!-- Permissions List Header (on the right) -->
                <h5 class="mb-0">Permissions List</h5>
            </div>

            <!-- Permissions Table -->
            <div class="card shadow-sm">
                <div class="card-body">
                    <table class="table table-bordered table-hover">
                        <thead class="table-light">
                            <tr>
                                <th>Permission Name</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($permissions as $permission)
                            <tr>
                                <td>{{ $permission->name }}</td>
                                <td>
                                    <!-- Edit Button with Icon -->
                                    <a href="{{ route('admin.permissions.edit', $permission) }}" class="btn btn-warning btn-sm rounded-pill" title="Edit Permission">
                                        <i class="fas fa-edit"></i>
                                    </a>

                                    <!-- Delete Button (Triggers Modal) -->
                                    <button class="btn btn-danger btn-sm rounded-pill" data-bs-toggle="modal" data-bs-target="#deleteModal{{ $permission->id }}" title="Delete Permission">
                                        <i class="fas fa-trash-alt"></i>
                                    </button>

                                    <!-- Delete Confirmation Modal -->
                                    <div class="modal fade" id="deleteModal{{ $permission->id }}" tabindex="-1" aria-labelledby="deleteModalLabel{{ $permission->id }}" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="deleteModalLabel{{ $permission->id }}">Confirm Deletion</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    Are you sure you want to delete this permission? This action cannot be undone.
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                                        <i class="fas fa-times-circle"></i> Cancel
                                                    </button>
                                                    <form action="{{ route('admin.permissions.destroy', $permission) }}" method="POST" class="d-inline">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger">
                                                            <i class="fas fa-trash-alt"></i> Confirm Deletion
                                                        </button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

@section('scripts')
<script>
    // Initialize Bootstrap tooltips
    var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
    var tooltipList = tooltipTriggerList.map(function(tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl);
    });
</script>
@endsection

@endsection