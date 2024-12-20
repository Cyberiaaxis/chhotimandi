<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use Illuminate\Http\Request;
use Carbon\Carbon;

class ReservationController extends Controller
{
    /**
     * Display a listing of reservations.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Fetch all reservations from the database
        $reservations = Reservation::all();

        // Return a view with reservations
        return view('reservations.index', compact('reservations'));
    }

    /**
     * Show the form for creating a new reservation.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('reservations.create');
    }

    /**
     * Store a newly created reservation in the database.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Validate the form data
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'phone' => 'required|string|max:15',
            'table_number' => 'required|integer|between:1,10',
            'number_guests' => 'required|integer|between:1,12',
            'date' => 'required|date_format:d.m.Y',  // Ensure that the date is in dd.mm.yyyy format
            'time' => 'required|in:Breakfast,Lunch,Dinner',
            'message' => 'nullable|string',
        ]);

        try {
            // Convert the date to the correct format (YYYY-MM-DD)
            $formattedDate = Carbon::createFromFormat('d.m.Y', $request->date)->format('Y-m-d');

            // Use firstOrCreate to check if the reservation exists or create a new one
            $reservation = Reservation::firstOrCreate(
                [
                    'table_number' => $request->table_number,
                    'date' => $formattedDate,
                    'time' => $request->time,
                ],
                [
                    'name' => $request->name,
                    'email' => $request->email,
                    'phone' => $request->phone,
                    'number_guests' => $request->number_guests,
                    'message' => $request->message,
                ]
            );

            // Check if the reservation was created or was just fetched
            if ($reservation->wasRecentlyCreated) {
                // Flash success message
                return back()->with('success', 'Reservation made successfully!');
            } else {
                // If reservation already exists, return with an error message
                return back()->with('error', 'This table is already reserved for the selected time.');
            }
        } catch (\Exception $e) {
            // Flash error message in case of failure
            return back()->with('error', 'There was an issue making the reservation. Please try again.');
        }
    }

    /**
     * Display the specified reservation.
     *
     * @param  \App\Models\Reservation  $reservation
     * @return \Illuminate\Http\Response
     */
    public function show(Reservation $reservation)
    {
        return view('reservations.show', compact('reservation'));
    }

    /**
     * Show the form for editing the specified reservation.
     *
     * @param  \App\Models\Reservation  $reservation
     * @return \Illuminate\Http\Response
     */
    public function edit(Reservation $reservation)
    {
        return view('reservations.edit', compact('reservation'));
    }

    /**
     * Update the specified reservation in the database.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Reservation  $reservation
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Reservation $reservation)
    {
        // Validate the incoming request data
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'phone' => 'required|string|max:15',
            'table_number' => 'required|integer|between:1,10',
            'number_guests' => 'required|integer|between:1,12',
            'date' => 'required|date',
            'time' => 'required|in:Breakfast,Lunch,Dinner',
            'message' => 'nullable|string',
        ]);

        // Update the reservation with new data
        $reservation->update($request->all());

        // Redirect back with success message
        return redirect()->route('reservations.index')->with('success', 'Reservation updated successfully!');
    }

    /**
     * Remove the specified reservation from the database.
     *
     * @param  \App\Models\Reservation  $reservation
     * @return \Illuminate\Http\Response
     */
    public function destroy(Reservation $reservation)
    {
        // Delete the reservation
        $reservation->delete();

        // Redirect back with success message
        return redirect()->route('reservations.index')->with('success', 'Reservation deleted successfully!');
    }
}
