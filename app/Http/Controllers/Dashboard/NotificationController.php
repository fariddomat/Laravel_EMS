<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Notification;

class NotificationController extends Controller
{
    /**
     * Display a listing of the notifications.
     */
    public function index()
    {
        $notifications = Notification::where('user_id', auth()->id())->get();
        return view('dashboard.notifications.index', compact('notifications'));
    }

    /**
     * Store a newly created notification in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'message' => 'required|string',
            'type' => 'required|in:auto,manual',
            'status' => 'required|in:read,unread',
        ]);

        Notification::create([
            'user_id' => auth()->id(),
            'message' => $request->message,
            'type' => $request->type,
            'status' => $request->status,
        ]);

        return redirect()->route('dashboard.notifications.index');
    }

    /**
     * Mark a notification as read.
     */
    public function markAsRead(Notification $notification)
    {
        $notification->update(['status' => 'read']);
        return redirect()->route('dashboard.notifications.index');
    }
}
