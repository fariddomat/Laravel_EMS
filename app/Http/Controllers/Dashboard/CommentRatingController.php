<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\CommentRating;
use App\Models\Event;
use App\Models\User;
use Illuminate\Http\Request;

class CommentRatingController extends Controller
{
    /**
     * Display a listing of the comments and ratings.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $commentsRatings = CommentRating::with('event', 'user')->get();
        return view('dashboard.comments_ratings.index', compact('commentsRatings'));
    }

    /**
     * Show the form for creating a new comment or rating.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $events = Event::all();
        $users = User::all();
        return view('dashboard.comments_ratings.create', compact('events', 'users'));
    }

    /**
     * Store a newly created comment or rating in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'event_id' => 'required|exists:events,id',
            'user_id' => 'required|exists:users,id',
            'comment' => 'nullable|string',
            'rating' => 'required|integer|min:1|max:5',
        ]);

        CommentRating::create($request->all());

        return redirect()->route('dashboard.comments_ratings.index')->with('success', 'Comment/Rating created successfully.');
    }

    /**
     * Show the form for editing the specified comment or rating.
     *
     * @param \App\Models\CommentRating $commentRating
     * @return \Illuminate\Http\Response
     */
    public function edit(CommentRating $commentRating)
    {
        $events = Event::all();
        $users = User::all();
        return view('dashboard.comments_ratings.edit', compact('commentRating', 'events', 'users'));
    }

    /**
     * Update the specified comment or rating in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\CommentRating $commentRating
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, CommentRating $commentRating)
    {
        $request->validate([
            'event_id' => 'required|exists:events,id',
            'user_id' => 'required|exists:users,id',
            'comment' => 'nullable|string',
            'rating' => 'required|integer|min:1|max:5',
        ]);

        $commentRating->update($request->all());

        return redirect()->route('dashboard.comments_ratings.index')->with('success', 'Comment/Rating updated successfully.');
    }

    /**
     * Remove the specified comment or rating from storage.
     *
     * @param \App\Models\CommentRating $commentRating
     * @return \Illuminate\Http\Response
     */
    public function destroy(CommentRating $commentRating)
    {
        $commentRating->delete();
        return redirect()->route('dashboard.comments_ratings.index')->with('success', 'Comment/Rating deleted successfully.');
    }
}
