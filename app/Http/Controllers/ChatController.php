<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Message;
use App\Events\MessageSent;
use Illuminate\Support\Facades\Auth;

class ChatController extends Controller
{
    public function index()
    {
        $messages = Message::with('user')->orderBy('id')->get();
        return view('chat.index', compact('messages'));
    }

    public function store(Request $request)
    {
        $request->validate(['message' => 'required|string']);

        $message = Message::create([
            'user_id' => Auth::id(),
            'message' => $request->message,
        ]);

        // broadcast(new MessageSent($message))->toOthers();

        return response()->json(['status' => 'Message Sent!']);
    }

    public function fetchMessages()
    {
        $messages = Message::with('user')->orderBy('id')->get();
        return response()->json($messages);
    }

}


