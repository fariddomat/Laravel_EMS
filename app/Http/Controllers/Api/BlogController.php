<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\BlogNews;
use Illuminate\Http\Request;

class BlogController extends Controller
{
     // Get all blogs
    public function index()
    {
        return response()->json(BlogNews::all());
    }

    // Get single blog by id
    public function show($id)
    {
        $blog = BlogNews::findOrFail($id);
        return response()->json($blog);
    }

}
