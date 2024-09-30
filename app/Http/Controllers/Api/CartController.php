<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\Cart;
use App\Models\Event;
use App\Models\Order;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function addToCart(Request $request) {
        $event=Event::findOrFail($request->event_id);
        $cartItem = Cart::create([
            'user_id' => auth()->id(),
            'event_id' => $request->event_id,
            'quantity' => $request->quantity ?? '1',
            'price' => $event->price,
        ]);
        return response()->json($cartItem, 201);
    }

    public function getCart() {
        $cartItems = Cart::where('user_id', auth()->id())->with('event')->get();
        return response()->json($cartItems);
    }

    public function removeFromCart(Request $request) {
        Cart::where('user_id', auth()->id())->where('event_id', $request->event_id)->delete();
        return response()->json(['message' => 'Item removed from cart']);
    }

    public function checkout(Request $request) {
        // Calculate total price
        $cartItems = Cart::where('user_id', auth()->id())->get();
        $total = $cartItems->sum(fn($item) => $item->quantity * $item->price);

        // Create an order
        $order = Order::create([
            'user_id' => auth()->id(),
            'total' => $total,
            'status' => 'pending',
        ]);

        // Move cart items to bookings
        foreach ($cartItems as $item) {
            Booking::create([
                'event_id' => $item->event_id,
                'user_id' => auth()->id(),
                'booking_date' => $item['booking_date'] ?? now(),
                'details' => $item['details'],
                'status' => 'pending',  // Status could be 'confirmed' after payment processing
            ]);
        }

        // Clear the cart
        Cart::where('user_id', auth()->id())->delete();

        return response()->json(['message' => 'Checkout successful', 'order_id' => $order->id]);
    }
}
