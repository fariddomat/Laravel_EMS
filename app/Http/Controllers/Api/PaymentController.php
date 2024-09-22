<?php
// app/Http/Controllers/Api/PaymentController.php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PaymentController extends Controller
{

    public function getUserPayments()
    {
        // Get the authenticated user
        $user = Auth::user();

        // Fetch payments for the user
        $payments = Payment::where('user_id', $user->id)
                           ->with('event')  // Include the event details
                           ->get();

        return response()->json($payments);
    }
}
