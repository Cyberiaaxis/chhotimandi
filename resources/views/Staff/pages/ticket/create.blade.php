@extends('Staff.layouts.staff')

@section('title', 'Create a Ticket')

@section('content')
<div class="container">
    <div class="mb-3">
        <h3>Create a Support Ticket</h3>
    </div>
    <!-- Display errors if any -->
    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif
    <!-- Ticket Creation Form -->
    <form action="{{ route('admin.tickets.store') }}" method="POST">
        @csrf

        <!-- Subject -->
        <div class="form-group mb-3">
            <label for="subject" class="mr-2">Subject</label>
            <select class="form-control" id="subject" name="subject" required>
                <option value="subject1">subject 1</option>
                <option value="subject2">subject 2</option>
                <option value="subject3">subject 3</option>
            </select>
        </div>

        <!-- Description -->
        <div class="form-group mb-3">
            <label for="description">Description</label>
            <textarea class="form-control" id="description" name="description" rows="4" placeholder="Enter ticket description" required></textarea>
        </div>

        <!-- Resolution Comment -->
        <div class="form-group mb-3">
            <label for="resolution_comment">Resolution Comment</label>
            <textarea class="form-control" id="resolution_comment" name="resolution_comment" rows="3" placeholder="Enter resolution comment"></textarea>
        </div>

        <!-- Priority, Status, Assigned To -->
        <div class="row mb-3">
            <div class="col-sm">
                <div class="form-group">
                    <label for="priority" class="mr-2">Priority</label>
                    <select class="form-control" id="priority" name="priority" required>
                        <option value="low">Low</option>
                        <option value="high">High</option>
                    </select>
                </div>
            </div>
            <div class="col-sm">
                <div class="form-group">
                    <label for="status" class="mr-2">Status</label>
                    <select class="form-control" id="status" name="status" required>
                        <option value="open">Open</option>
                        <option value="in_progress">In Progress</option>
                        <option value="closed">Closed</option>
                    </select>
                </div>
            </div>
            <div class="col-sm">
                <div class="form-group">
                    <label for="assigned_to" class="mr-2">Assigned To</label>
                    <select class="form-control" id="assigned_to" name="assigned_to">
                        <option value="">Unassigned</option>
                        @foreach ($users as $user)
                        <option value="{{ $user->id }}">{{ $user->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>

        <!-- Submit Button -->
        <div class="row">
            <div class="col-12">
                <div class="form-group">
                    <button type="submit" class="btn btn-primary w-100 py-2" style="border: 2px solid black;">
                        <i class="fas fa-save mr-2"></i> <span>Ticket Create</span>
                    </button>
                </div>
            </div>
        </div>

    </form>
</div>
@endsection