@extends('Staff.layouts.staff')

@section('title', 'User to roles')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h1>Assigned Roles</h1>
        <!-- Create Role Button -->
        <a href="{{ route('admin.assignRole.create') }}" class="btn btn-primary">Assign Role</a>
    </div>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>#</th>
                <th>User Name</th>
                <th>Email</th>
                <th>Roles</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($users as $user)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
                <td>
                    @if ($user->roles->isNotEmpty())
                    @foreach ($user->roles as $role)
                    <span class="badge bg-primary">{{ $role->name }}</span>
                    @endforeach
                    @else
                    <span class="text-muted">No roles assigned</span>
                    @endif
                </td>
                <td>
                    <!-- Edit Button -->
                    <a href="{{ route('admin.assignRole.edit', $user->id) }}" class="btn btn-sm btn-warning"> <i class="fas fa-edit"></i></a>

                    <!-- Delete Button -->
                    <form action="{{ route('admin.assignRole.destroy', $user->id) }}" method="POST" style="display:inline-block;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')"> <i class="fas fa-trash-alt"></i></button>
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="5" class="text-center">No users found</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection