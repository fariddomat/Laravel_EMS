<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\CommentRating;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class CommentRatingController extends Controller
{
    public function index()
    {
        return response()->json(CommentRating::all());
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'event_id' => 'required|exists:events,id',
            'comment' => 'required|string|max:500',
            'rating' => 'required|integer|min:1|max:5',
        ]);

        $comment = CommentRating::create([
            'event_id' => $validatedData['event_id'],
            'user_id' => Auth::id(),
            'comment' => $validatedData['comment'],
            'rating' => $validatedData['rating'],
        ]);
        return response()->json($comment, 201);
    }

    public function show(CommentRating $commentRating)
    {
        return response()->json($commentRating);
    }

    public function update(Request $request, CommentRating $commentRating)
    {
        $commentRating->update($request->all());

        return response()->json($commentRating);
    }

    public function destroy(CommentRating $commentRating)
    {
        $commentRating->delete();

        return response()->json(null, 204);
    }
}
