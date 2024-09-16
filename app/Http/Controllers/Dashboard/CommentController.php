<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function index()
    {
        $comments = Comment::all();
        return view('dashboard.properties.comments.index', compact('comments'));
    }

    public function create()
    {
        return view('dashboard.properties.comments.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'comment' => 'required|string',
            'user_id' => 'required|exists:users,id',
            'lesson_id' => 'required|exists:lessons,id',
        ]);

        Comment::create($request->all());
        return redirect()->route('dashboard.comments.index')->with('success', 'Comment created successfully.');
    }

    public function show($id)
    {
        $comment = Comment::find($id);
        if (!$comment) {
            return redirect()->route('dashboard.comments.index')->with('error', 'Comment not found.');
        }
        return view('dashboard.lessons.comments.show', compact('comment'));
    }

    public function edit($id)
    {
        $comment = Comment::find($id);
        if (!$comment) {
            return redirect()->route('comments.index')->with('error', 'Comment not found.');
        }
        return view('dashboard.lessons.comments.edit', compact('comment'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'comment' => 'string',
            'user_id' => 'exists:users,id',
            'lesson_id' => 'exists:lessons,id',
        ]);

        $comment = Comment::find($id);
        if (!$comment) {
            return redirect()->route('dashboard.comments.index')->with('error', 'Comment not found.');
        }

        $comment->update($request->all());
        return redirect()->route('dashboard.comments.index')->with('success', 'Comment updated successfully.');
    }

    public function destroy($id)
    {
        $comment = Comment::find($id);
        if (!$comment) {
            return redirect()->route('dashboard.comments.index')->with('error', 'Comment not found.');
        }

        $comment->delete();
        return redirect()->route('dashboard.comments.index')->with('success', 'Comment deleted successfully.');
    }
}
