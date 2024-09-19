<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Favorite;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class FavoriteController extends Controller
{
    public function index()
    {
        // Get all favorites for the authenticated user
        $userId = auth()->id();
        $favorites = Favorite::with(['event'])
            ->where('user_id', $userId)
            ->get();

        return response()->json($favorites);
    }

    public function store(Request $request)
    {
        // Validate the incoming request
        $validator = Validator::make($request->all(), [
            'event_id' => 'required|exists:events,id',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        // Get the authenticated user's ID
        $userId = auth()->id();

        // Check if the user has already favorited this event
        $existingFavorite = Favorite::where('user_id', $userId)
            ->where('event_id', $request->event_id)
            ->first();

        if ($existingFavorite) {
            $existingFavorite->delete();
            return response()->json(['message' => 'This event is already in your favorites'], 201); // Conflict
        }

        // Create a new favorite with the authenticated user's ID
        $favorite = Favorite::create([
            'user_id' => $userId,
            'event_id' => $request->event_id,
        ]);

        return response()->json($favorite, 201);
    }

    public function show(Favorite $favorite)
    {
        // Ensure the authenticated user can only access their own favorites
        $this->authorize('view', $favorite);

        // Return the single favorite with related event data
        $favorite->load(['event']);

        return response()->json($favorite);
    }

    public function update(Request $request, Favorite $favorite)
    {
        // Ensure the authenticated user can only update their own favorites
        $this->authorize('update', $favorite);

        // Validate the update request (event_id can be updated, user_id stays the same)
        $validator = Validator::make($request->all(), [
            'event_id' => 'exists:events,id',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        // Update favorite with the new event_id
        $favorite->update($request->all());

        return response()->json($favorite);
    }

    public function destroy(Favorite $favorite)
    {
        // Ensure the authenticated user can only delete their own favorites
        $this->authorize('delete', $favorite);

        // Delete the favorite
        $favorite->delete();

        return response()->json(['message' => 'Favorite deleted successfully'], 204);
    }
}
