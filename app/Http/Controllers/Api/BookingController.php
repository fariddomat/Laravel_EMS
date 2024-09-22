<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\Package;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class BookingController extends Controller
{

    // Function to create a new booking
    public function store(Request $request)
    {
        $request->validate([
            'event_id' => 'required|exists:events,id',
        ]);

        // Create booking with status 'pending' by default and get the logged-in user ID
        $booking = Booking::create([
            'event_id' => $request->event_id,
            'user_id' => Auth::id(),
            'booking_date' => $request->booking_date,
            'status' => 'pending', // default status
        ]);

        return response()->json(['message' => 'Booking created successfully', 'booking' => $booking], 201);
    }

    // Function to retrieve all bookings for the logged-in user
    public function userBookings()
    {
        $bookings = Booking::with('event')->where('user_id', Auth::id())->get();

        return response()->json($bookings);
    }

    public function cancelBooking($id)
    {
        $booking = Booking::find($id);

        // Ensure the booking exists and is not approved yet
        if (!$booking || $booking->status === 'approved') {
            return response()->json(['error' => 'Cannot cancel this booking.'], 403);
        }

        // If booking is cancellable, update the status
        $booking->status = 'cancelled';
        $booking->save();

        return response()->json(['message' => 'Booking cancelled successfully.', 'booking' => $booking]);
    }

    // In your Laravel controller (or whichever framework you're using)
    public function bookPackage(Request $request)
    {
        $validated = $request->validate([
            'package_id' => 'required|exists:packages,id',
            'booking_date' => 'required|date'
        ]);

        // Process the booking logic
        // Create the booking in the database


        $package = Package::findOrFail($validated['package_id']);
        foreach ($package->events as $event) {

            $booking = Booking::create([
                'user_id' => auth()->id(),
                'event_id' => $event->id,
                'booking_date' => $validated['booking_date'],
                'status' => 'pending'  // Default status
            ]);
        }

        return response()->json(['message' => 'Booking successful', 'booking' => $booking]);
    }
}
