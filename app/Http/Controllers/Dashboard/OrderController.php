<?php

namespace App\Http\Controllers\Dashboard;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Property;
use App\Http\Controllers\Controller;

class OrderController extends Controller
{
    // عرض جميع الطلبات للمسؤول
    public function indexAdmin()
    {
        $orders = Order::with('property', 'user')->get();
        return view('dashboard.orders.index', compact('orders'));
    }

    // عرض جميع الطلبات لصاحب العقار
    public function indexOwner()
    {
        $orders = Order::with('property', 'user')
                    ->whereHas('property', function($query) {
                        $query->where('user_id', auth()->id());
                    })->get();
        return view('dashboard.orders.index', compact('orders'));
    }

    public function indexUser()
    {
        $orders = Order::with('property', 'user')
                    ->whereHas('user', function($query) {
                        $query->where('id', auth()->id());
                    })->get();
        return view('dashboard.orders.index', compact('orders'));
    }


    // عرض تفاصيل الطلب
    public function show($id)
    {
        $order = Order::with('property', 'user')->findOrFail($id);
        return view('dashboard.orders.show', compact('order'));
    }

    // تحديث حالة الطلب
    public function update(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|string',
            'reply' => 'nullable|string',
        ]);

        $order = Order::findOrFail($id);
        $order->status = $request->status;
        $order->reply = $request->reply;
        $order->save();

        return redirect()->route('dashboard.orders.show', $id)->with('success', 'تم تحديث الطلب بنجاح');
    }
}
