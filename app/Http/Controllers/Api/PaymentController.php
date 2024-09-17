<?php
// app/Http/Controllers/Api/PaymentController.php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Payment;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function index()
    {
        return response()->json(Payment::all());
    }

    public function show(Payment $payment)
    {
        return response()->json($payment);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'user_id' => 'required|integer',
            'event_id' => 'required|integer',
            'amount' => 'required|string',
            'status' => 'required|string',
        ]);

        $payment = Payment::create($validatedData);

        return response()->json($payment, 201);
    }

    public function update(Request $request, Payment $payment)
    {
        $validatedData = $request->validate([
            'user_id' => 'sometimes|integer',
            'event_id' => 'sometimes|integer',
            'amount' => 'sometimes|string',
            'status' => 'sometimes|string',
        ]);

        $payment->update($validatedData);

        return response()->json($payment);
    }

    public function destroy(Payment $payment)
    {
        $payment->delete();

        return response()->json(null, 204);
    }
}
