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
        return response()->json(Favorite::all());
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'user_id' => 'required|exists:users,id',
            'event_id' => 'required|exists:events,id',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $favorite = Favorite::create($request->all());

        return response()->json($favorite, 201);
    }

    public function show(Favorite $favorite)
    {
        return response()->json($favorite);
    }

    public function update(Request $request, Favorite $favorite)
    {
        $favorite->update($request->all());

        return response()->json($favorite);
    }

    public function destroy(Favorite $favorite)
    {
        $favorite->delete();

        return response()->json(null, 204);
    }
}
