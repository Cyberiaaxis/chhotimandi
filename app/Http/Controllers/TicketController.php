<?php

// app/Http/Controllers/TicketController.php

namespace App\Http\Controllers;

use App\Models\Ticket;
use App\Models\User;
use Illuminate\Http\Request;

class TicketController extends Controller
{
    // Display ticket trace (view updates and status)
    public function index(Ticket $ticket)
    {
        $staffMembers = User::all();
        $tickets = Ticket::all(); // Fetch all staff members to assign
        return view('Staff.pages.ticket.index', compact('tickets', 'staffMembers'));
    }

    public function create(Ticket $ticket)
    {
        // Fetch users, you can add conditions to filter specific roles
        $users = User::all(); // Or use a condition like ->where('role', 'staff')->get();

        // Pass the users to the view
        return view('Staff.pages.ticket.create', compact('users'));
    }
    public function store(Request $request)
    {
        // Validate the incoming request data
        $request->validate([
            'subject' => 'string|max:255', // Subject must be a string, required, and no more than 255 characters
            'description' => 'string|max:1000', // Description must be a string, required, and no more than 1000 characters
            'resolution_comment' => 'string|max:1000', // Resolution comment is optional, must be a string and no more than 1000 characters
            'priority' => 'in:low,high', // Priority must be one of 'low' or 'high'
            'status' => 'in:open,in_progress,closed', // Status must be one of 'open', 'in_progress', or 'closed'
            'assigned_to' => 'nullable|exists:users,id', // Assigned user is optional but must exist in the 'users' table
        ]);

        // If validation passes, proceed with storing the ticket
        Ticket::create([
            'subject' => $request->subject,
            'description' => $request->description,
            'resolution_comment' => $request->resolution_comment,
            'priority' => $request->priority,
            'status' => $request->status,
            'assigned_to' => $request->assigned_to,
        ]);

        return redirect()->route('admin.tickets.index')->with('success', 'Ticket created successfully!');
    }
    public function edit($id)
    {
        // Retrieve the ticket or fail if not found
        $ticket = Ticket::findOrFail($id);

        // Get all staff members assuming 'role' is a field in 'users' table
        $staffMembers = User::all();

        // Pass ticket and staff members to the view
        return view('Staff.pages.ticket.edit', compact('ticket', 'staffMembers'));
    }

    public function update(Request $request, $id)
    {
        // Validate the incoming request
        $validated = $request->validate([
            'subject' => 'required|string|max:255', // Subject is required and should not exceed 255 characters
            'description' => 'nullable|string|max:1000', // Description is optional but if provided, should not exceed 1000 characters
            'resolution_comment' => 'nullable|string|max:1000', // Optional resolution comment with 1000 character limit
            'priority' => 'required|in:low,medium,high', // Priority should be required with valid values
            'status' => 'required|in:open,in_progress,closed', // Status should be required with valid values
            'assigned_to' => 'nullable|exists:users,id', // Assigned staff should exist in the 'users' table if provided
        ]);

        // Retrieve the ticket or fail if not found
        $ticket = Ticket::findOrFail($id);

        // Update the ticket with the validated data
        $ticket->update([
            'subject' => $validated['subject'],
            'description' => $validated['description'],
            'resolution_comment' => $validated['resolution_comment'],
            'priority' => $validated['priority'],
            'status' => $validated['status'],
            'assigned_to' => $validated['assigned_to'] ?? null, // Ensure 'assigned_to' is nullable
        ]);

        // Redirect back to the ticket trace page with a success message
        return redirect()->route('admin.tickets.index')->with('success', 'Ticket updated successfully!');
    }
}
