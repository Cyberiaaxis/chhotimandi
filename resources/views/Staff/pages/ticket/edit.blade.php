@extends('Staff.layouts.staff')

@section('title', 'Update Ticket - #{{ $ticket->id }}')

@section('content')
<div class="container py-4">
    <!-- Section Header -->
    <div class="text-center mb-4">
        <h2 class="text-primary">Update Ticket #{{ $ticket->id }}</h2>
        <p class="lead">Modify the details of this ticket and update the status as necessary.</p>
    </div>

    <!-- Ticket Update Form -->
    <form action="{{ route('admin.tickets.update', $ticket->id) }}" method="POST">
        @csrf
        @method('PUT')

        <!-- Display validation errors -->
        @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        <!-- Ticket Details Form -->
        <div class="card shadow-sm">
            <div class="card-header bg-gradient-primary text-white">
                <h4>Ticket Details</h4>
            </div>
            <div class="card-body">
                <div class="mb-3">
                    <label for="subject" class="form-label">Subject</label>
                    <select id="subject" name="subject" class="form-select" required>
                        <!-- Make sure the values here match what is stored in the database -->
                        <option value="issue_1" {{ old('subject', $ticket->subject) == 'issue_1' ? 'selected' : '' }}>Issue 1</option>
                        <option value="issue_2" {{ old('subject', $ticket->subject) == 'issue_2' ? 'selected' : '' }}>Issue 2</option>
                        <option value="issue_3" {{ old('subject', $ticket->subject) == 'issue_3' ? 'selected' : '' }}>Issue 3</option>
                        <option value="other" {{ old('subject', $ticket->subject) == 'other' ? 'selected' : '' }}>Other</option>
                    </select>
                </div>


                <!-- Description -->
                <div class="mb-3">
                    <label for="description" class="form-label">Description</label>
                    <textarea id="description" name="description" class="form-control" rows="4" value>{{ old('description', $ticket->description) }}</textarea>
                </div>

                <!-- Resolution Comment -->
                <div class="mb-3">
                    <label for="resolution_comment" class="form-label">Resolution Comment</label>
                    <textarea id="resolution_comment" name="resolution_comment" class="form-control" rows="4">{{ old('resolution_comment', $ticket->resolution_comment) }}</textarea>
                </div>

                <!-- Status -->
                <div class="mb-3">
                    <label for="status" class="form-label">Ticket Status</label>
                    <select id="status" name="status" class="form-select" required>
                        <option value="open" {{ $ticket->status == 'open' ? 'selected' : '' }}>Open</option>
                        <option value="in_progress" {{ $ticket->status == 'in_progress' ? 'selected' : '' }}>In Progress</option>
                        <option value="resolved" {{ $ticket->status == 'resolved' ? 'selected' : '' }}>Resolved</option>
                        <option value="closed" {{ $ticket->status == 'closed' ? 'selected' : '' }}>Closed</option>
                    </select>
                </div>

                <!-- Priority -->
                <div class="mb-3">
                    <label for="priority" class="form-label">Priority</label>
                    <select id="priority" name="priority" class="form-select" required>
                        <option value="low" {{ $ticket->priority == 'low' ? 'selected' : '' }}>Low</option>
                        <option value="high" {{ $ticket->priority == 'high' ? 'selected' : '' }}>High</option>
                    </select>
                </div>

                <!-- Assign Staff -->
                <div class="mb-3">
                    <label for="assigned_to" class="form-label">Assign Staff</label>
                    <select id="assigned_to" name="assigned_to" class="form-select">
                        <option value="">Select Staff</option>
                        @foreach($staffMembers as $staff)
                        <option value="{{ $staff->id }}" {{ $ticket->assigned_to == $staff->id ? 'selected' : '' }}>
                            {{ $staff->name }}
                        </option>
                        @endforeach
                    </select>
                </div>
                <div class="d-flex justify-content-between">
                    <a href="{{ route('admin.tickets.index') }}" class="btn btn-secondary">Back to Tickets</a>
                    <button type="submit" class="btn btn-success">Update Ticket</button>
                </div>
            </div>
        </div>
    </form>
</div>
@endsection