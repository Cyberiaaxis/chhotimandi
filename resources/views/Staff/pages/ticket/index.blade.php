@extends('Staff.layouts.staff')

@section('title', 'Ticket Trace')

@section('content')
<div class="container py-4">
    <!-- Section Header with Raise Ticket Button -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="text-primary">Ticket Trace</h2>
            <p class="lead">Manage and track your support tickets with ease.</p>
        </div>
        <a href="{{ route('admin.tickets.create') }}" class="btn btn-outline-success w-100">
            <i class="fas fa-plus-circle"></i> Raise Ticket
        </a>
    </div>

    <div class="row">
        <!-- Loop through tickets and display them in a responsive grid -->
        @foreach ($tickets as $ticket)
        <div class="col-lg-3 col-md-4 col-sm-6 mb-4">
            <div class="card shadow-lg rounded-3 border-0">
                <div class="card-header bg-gradient-primary text-white d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Ticket #{{ $ticket->id }}</h5>
                    <span class="badge 
                        @if($ticket->priority == 'high') bg-danger 
                        @elseif($ticket->priority == 'medium') bg-warning 
                        @else bg-success @endif">
                        {{ ucfirst($ticket->priority) }}
                    </span>
                </div>
                <div class="card-body">
                    <!-- Ticket details -->
                    <div class="mb-2">
                        <strong>Created At:</strong>
                        <span class="text-muted">{{ $ticket->created_at->format('d M, Y h:i A') }}</span>
                    </div>

                    <div class="mb-2">
                        <strong>Description:</strong>
                        <p>{{ $ticket->description ?? 'No description provided' }}</p>
                    </div>

                    <div class="mb-2">
                        <strong>Resolution Comment:</strong>
                        <p>{{ $ticket->resolution_comment ?? 'No resolution comment provided' }}</p>
                    </div>

                    <div class="mb-2">
                        <strong>Assigned Staff:</strong>
                        <div class="d-flex align-items-center">
                            @if($ticket->assignedStaff)
                            <i class="fas fa-user-circle mr-2"></i> {{ $ticket->assignedStaff->name }}
                            @else
                            <span class="text-muted">Not Assigned</span>
                            @endif
                        </div>
                    </div>

                    <!-- Ticket Status -->
                    <div class="mt-3">
                        <strong>Status:</strong>
                        <p class="badge 
                            @if($ticket->status == 'open') bg-success 
                            @elseif($ticket->status == 'in_progress') bg-warning 
                            @else bg-danger @endif">
                            {{ ucfirst($ticket->status) }}
                        </p>
                    </div>

                    <!-- Edit button for open tickets -->
                    <div class="mt-3">
                        <a href="{{ route('admin.tickets.edit', $ticket->id) }}" class="btn btn-primary btn-sm">Edit Ticket</a>
                    </div>
                </div>
                <!-- End of Card Body -->
            </div>
        </div>
        @endforeach
    </div>

    <!-- Fallback if no tickets -->
    @if ($tickets->isEmpty())
    <div class="alert alert-warning text-center">No tickets available.</div>
    @endif
</div>
@endsection