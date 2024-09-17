<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\CommentRating;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CommentRatingController extends Controller
{
    public function index()
    {
        return response()->json(CommentRating::all());
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'event_id' => 'required|exists:events,id',
            'user_id' => 'required|exists:users,id',
            'comment' => 'nullable|string',
            'rating' => 'required|integer|min:1|max:5',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $commentRating = CommentRating::create($request->all());

        return response()->json($commentRating, 201);
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
