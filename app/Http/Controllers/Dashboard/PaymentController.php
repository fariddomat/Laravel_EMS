<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\Event;
use App\Models\Payment;
use App\Models\User;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    /**
     * Display a listing of the payments.
     */
    public function index()
    {
        // Check if the authenticated user has the 'owner' role
        if (auth()->user()->hasRole('company')) {
            // Retrieve payments for events owned by the authenticated user's companies
            $payments = Payment::whereHas('event', function ($query) {
                $query->whereHas('company', function ($companyQuery) {
                    $companyQuery->where('user_id', auth()->user()->id);  // Assuming 'owner_id' is the user ID in the companies table
                });
            })->get();
        } else {
            // If the user is not an 'owner', retrieve all payments
            $payments = Payment::all();
        }

        return view('dashboard.payments.index', compact('payments'));
    }


    /**
     * Show the form for creating a new payment.
     */
    public function create()
    {
        $users = User::all();
        if (auth()->user()->hasRole('company')) {
            // Get the companies owned by the user
            $ownerCompanies = auth()->user()->companies;

            // Get the events that belong to the owner's companies
            $events = Event::whereIn('company_id', $ownerCompanies->pluck('id'))->get();
        } else {
            // For other roles, return all events
            $events = Event::all();
        }
        return view('dashboard.payments.create', compact('users', 'events'));
    }

    /**
     * Store a newly created payment in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'event_id' => 'required|exists:events,id',
            'amount' => 'required|numeric',
            'status' => 'required|in:pending,completed,failed',
        ]);

        Payment::create($request->all());

        return redirect()->route('dashboard.payments.index');
    }

    /**
     * Display the specified payment.
     */
    public function show(Payment $payment)
    {
        return view('dashboard.payments.show', compact('payment'));
    }

    /**
     * Show the form for editing the specified payment.
     */
    public function edit(Payment $payment)
    {

        $users = User::all();
        if (auth()->user()->hasRole('company')) {
            // Get the companies owned by the user
            $ownerCompanies = auth()->user()->companies;

            // Get the events that belong to the owner's companies
            $events = Event::whereIn('company_id', $ownerCompanies->pluck('id'))->get();
        } else {
            // For other roles, return all events
            $events = Event::all();
        }

        return view('dashboard.payments.edit', compact('payment', 'users', 'events'));
    }

    /**
     * Update the specified payment in storage.
     */
    public function update(Request $request, Payment $payment)
    {

        $old = $payment->status;
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'event_id' => 'required|exists:events,id',
            'amount' => 'required|numeric',
            'status' => 'required|in:pending,completed,failed',
        ]);

        $payment->update($request->all());

        if ($old != $request->status) {

            if ($request->status == 'completed') {
                // Automatically update the corresponding booking status to 'confirmed'
                Booking::where('user_id', $payment->user_id)
                    ->where('event_id', $payment->event_id)
                    ->update(['status' => 'confirmed']);
            }
        }
        return redirect()->route('dashboard.payments.index');
    }

    /**
     * Remove the specified payment from storage.
     */
    public function destroy(Payment $payment)
    {
        $payment->delete();
        return redirect()->route('dashboard.payments.index');
    }
}
