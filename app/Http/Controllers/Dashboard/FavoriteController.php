<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Favorite;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FavoriteController extends Controller
{
    public function index()
    {
        $favorites = Favorite::where('user_id', Auth::id())->get();
        return view('dashboard.favorites.index', compact('favorites'));
    }

    public function destroy($id)
    {
        $favorite = Favorite::where('user_id', Auth::id())->where('id', $id)->first();

        if (!$favorite) {
            return redirect()->route('dashboard.favorites.index')->with('error', 'Favorite not found.');
        }

        $favorite->delete();
        return redirect()->route('dashboard.favorites.index')->with('success', 'Favorite removed successfully.');
    }
}
