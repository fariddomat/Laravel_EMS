<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class EventController extends Controller
{
    public function index()
    {
        return response()->json(Event::where('status','accepted')->with('company')->get());
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|string',
            'images' => 'nullable|array',
            'videos' => 'nullable|array',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $event = Event::create($request->all());

        return response()->json($event, 201);
    }

    public function show($id)
    {
        $event = Event::where('status','accepted')->with(['company', 'comments.user'])->findOrFail($id);  // Load the company relationship
        return response()->json($event->append('is_favorite'));
    }

    public function update(Request $request, Event $event)
    {
        $event->update($request->all());

        return response()->json($event);
    }

    public function destroy(Event $event)
    {
        $event->delete();

        return response()->json(null, 204);
    }
    public function getEventsByCompany($companyId)
    {
        // Retrieve events associated with the company
        $events = Event::where('status','accepted')->where('company_id', $companyId)->get();

        if ($events->isEmpty()) {
            return response()->json(['message' => 'No events found for this company'], 404);
        }

        return response()->json($events); // Return the events as JSON
    }
}
