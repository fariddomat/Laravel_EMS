<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
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
        $payments = Payment::all();
        return view('dashboard.payments.index', compact('payments'));
    }

    /**
     * Show the form for creating a new payment.
     */
    public function create()
    {
        $users=User::all();
        $events=Event::all();
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

        $users=User::all();
        $events=Event::all();
        return view('dashboard.payments.edit', compact('payment', 'users', 'events'));
    }

    /**
     * Update the specified payment in storage.
     */
    public function update(Request $request, Payment $payment)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'event_id' => 'required|exists:events,id',
            'amount' => 'required|numeric',
            'status' => 'required|in:pending,completed,failed',
        ]);

        $payment->update($request->all());

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
