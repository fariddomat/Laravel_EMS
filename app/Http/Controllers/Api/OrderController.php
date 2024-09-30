<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function getOrders() {
        $orders = Order::where('user_id', auth()->id())->with('events')->get();
        return response()->json($orders);
    }

    public function cancelOrder($orderId) {
        $order = Order::find($orderId);
        $order->status = 'cancelled';
        $order->save();
        return response()->json(['message' => 'Order cancelled']);
    }
}
