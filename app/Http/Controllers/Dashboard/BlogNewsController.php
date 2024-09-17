<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\BlogNews;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BlogNewsController extends Controller
{
    /**
     * Display a listing of the blog/news posts.
     */
    public function index()
    {
        $blogNews = BlogNews::all();
        return view('dashboard.blog_news.index', compact('blogNews'));
    }

    /**
     * Show the form for creating a new blog/news post.
     */
    public function create()
    {
        return view('dashboard.blog_news.create');
    }

    /**
     * Store a newly created blog/news post in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required',
            'images.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'videos.*' => 'mimes:mp4,mov,ogg|max:10240',
        ]);

        // Handle image upload
        $imagePaths = [];
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $path = $image->store('blog_images', 'public');
                $imagePaths[] = $path;
            }
        }

        // Handle video upload
        $videoPaths = [];
        if ($request->hasFile('videos')) {
            foreach ($request->file('videos') as $video) {
                $path = $video->store('blog_videos', 'public');
                $videoPaths[] = $path;
            }
        }

        BlogNews::create([
            'title' => $request->input('title'),
            'content' => $request->input('content'),
            'images' => json_encode($imagePaths),
            'videos' => json_encode($videoPaths),
            'author_id' => auth()->id(),
        ]);

        return redirect()->route('dashboard.blog_news.index')->with('success', 'Blog/News post created successfully.');
    }

    /**
     * Show the form for editing the specified blog/news post.
     */
    public function edit($id)
    {
        $blogNews = BlogNews::findOrFail($id);
        return view('dashboard.blog_news.edit', compact('blogNews'));
    }

    /**
     * Update the specified blog/news post in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required',
            'images.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'videos.*' => 'mimes:mp4,mov,ogg|max:10240',
        ]);

        $blogNews = BlogNews::findOrFail($id);

        // Handle image upload
        $imagePaths = json_decode($blogNews->images, true) ?? [];
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $path = $image->store('blog_images', 'public');
                $imagePaths[] = $path;
            }
        }

        // Handle video upload
        $videoPaths = json_decode($blogNews->videos, true) ?? [];
        if ($request->hasFile('videos')) {
            foreach ($request->file('videos') as $video) {
                $path = $video->store('blog_videos', 'public');
                $videoPaths[] = $path;
            }
        }

        $blogNews->update([
            'title' => $request->input('title'),
            'content' => $request->input('content'),
            'images' => json_encode($imagePaths),
            'videos' => json_encode($videoPaths),
        ]);

        return redirect()->route('dashboard.blog_news.index')->with('success', 'Blog/News post updated successfully.');
    }

    /**
     * Remove the specified blog/news post from storage.
     */
    public function destroy($id)
    {
        $blogNews = BlogNews::findOrFail($id);

        // Delete images and videos from storage
        $images = json_decode($blogNews->images, true);
        if ($images) {
            foreach ($images as $image) {
                Storage::disk('public')->delete($image);
            }
        }

        $videos = json_decode($blogNews->videos, true);
        if ($videos) {
            foreach ($videos as $video) {
                Storage::disk('public')->delete($video);
            }
        }

        $blogNews->delete();

        return redirect()->route('dashboard.blog_news.index')->with('success', 'Blog/News post deleted successfully.');
    }
}
