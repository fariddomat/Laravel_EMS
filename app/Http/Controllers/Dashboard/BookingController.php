<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BookingController extends Controller
{
     /**
     * Store a new booking.
     */
    public function store(Request $request)
    {
        $request->validate([
            'event_id' => 'required|exists:events,id',
            'booking_date' => 'required|date',
            'status' => 'required|in:confirmed,pending,cancelled',
        ]);

        $booking = Booking::create([
            'event_id' => $request->event_id,
            'user_id' => Auth::id(),
            'booking_date' => $request->booking_date,
            'status' => $request->status,
        ]);

        return redirect()->route('dashboard.events.show', $request->event_id);
    }


    public function edit(Booking $booking){
        return view('dashboard.bookings.edit', compact('booking'));

}
    /**
     * Update the status of a booking.
     */
    public function update(Request $request, Booking $booking)
    {
        $request->validate([
            'status' => 'required|in:confirmed,pending,cancelled',
        ]);

        $booking->update([
            'status' => $request->status,
        ]);

        return redirect()->route('dashboard.bookings.index');
    }

    /**
     * Display a list of bookings.
     */
    public function index()
    {
        // Check if the user has the 'owner' role
        if (auth()->user()->hasRole('company')) {
            // Get the companies owned by the user
            $ownerCompanies = auth()->user()->companies;

            // Get the bookings for events that belong to the owner's companies
            $bookings = Booking::whereHas('event', function ($query) use ($ownerCompanies) {
                $query->whereIn('company_id', $ownerCompanies->pluck('id'));
            })->with(['event', 'user'])->get();
        } else {
            // For other roles, return all bookings
            $bookings = Booking::with(['event', 'user'])->get();
        }

        return view('dashboard.bookings.index', compact('bookings'));
    }

}
