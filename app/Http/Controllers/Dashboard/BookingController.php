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
        $bookings = Booking::with(['event', 'user'])->get();
        return view('dashboard.bookings.index', compact('bookings'));
    }
}
