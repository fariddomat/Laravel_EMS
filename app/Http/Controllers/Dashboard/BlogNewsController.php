<?php

namespace App\Http\Controllers\Dashboard;

use App\Helpers\ImageHelper;
use App\Http\Controllers\Controller;
use App\Models\BlogNews;
use App\Models\User;
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
        $authors=User::all();
        return view('dashboard.blog_news.create', compact('authors'));
    }

    /**
     * Store a newly created blog/news post in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required',
            'images.*' => 'image|mimes:jpeg,png,jpg,gif,svg,webp',
            'videos.*' => 'mimes:mp4,mov,ogg',
        ]);
        $images = $request->file('images');
        $videos = $request->file('videos');

        // Handle image upload
        if ($request->has('images')) {
            $imageHelper = new ImageHelper;
            $imagePaths = [];
            foreach ($images as $image) {
                $imagePaths[] = $imageHelper->storeImageInPublicDirectory($image, '/uploads/blogs/images', 600, 400);
            }
        }

        // Handle video upload
        if ($request->has('videos')) {
            $videoPaths = [];
            foreach ($videos as $video) {
                $videoPaths[] = $video->store('/uploads/blogs/videos', 'public');
            }
        }

        BlogNews::create([
            'title' => $request->input('title'),
            'content' => $request->input('content'),
            'images' => $imagePaths ?? [],
            'videos' => $videoPaths ?? [],
            'author_id' => auth()->id(),
        ]);

        return redirect()->route('dashboard.blog_news.index')->with('success', 'Blog/News post created successfully.');
    }

    /**
     * Show the form for editing the specified blog/news post.
     */
    public function edit($id)
    {
        $post = BlogNews::findOrFail($id);
        $authors=User::all();

        return view('dashboard.blog_news.edit', compact('post', 'authors'));
    }

    /**
     * Update the specified blog/news post in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required',
            'images.*' => 'image|mimes:jpeg,png,jpg,gif,svg,webp',
            'videos.*' => 'mimes:mp4,mov,ogg',
        ]);

        $blogNews = BlogNews::findOrFail($id);

        $images = $request->file('images');
        $videos = $request->file('videos');

        // Handle image upload
        if ($request->has('images')) {
            $imageHelper = new ImageHelper;
            $imagePaths = [];
            foreach ($images as $image) {
                $imagePaths[] = $imageHelper->storeImageInPublicDirectory($image, '/uploads/blogs/images', 600, 400);
            }
        }

        // Handle video upload
        if ($request->has('videos')) {
            $videoPaths = [];
            foreach ($videos as $video) {
                $videoPaths[] = $video->store('/uploads/blogs/videos', 'public');
            }
        }

        $blogNews->update([
            'title' => $request->input('title'),
            'content' => $request->input('content'),
            'images' => $imagePaths ?? [],
            'videos' => $videoPaths ?? [],
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
