<?php

namespace App\Http\Controllers\Dashboard;

use App\Helpers\ImageHelper;
use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::all();
        return view('dashboard.categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard.categories.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'required',
            'img' => 'required|image'
        ]);
        if ($request->has('img')) {
            $image = $request->file('img');
            $directory = '/uploads/categories'; // Replace with the desired directory
            $helper = new ImageHelper;
            $fullPath = $helper->storeImageInPublicDirectory($image, $directory, 600, 400);
            // Save the full path with name in the database
            $imagePath = $fullPath;
        }
        $category = Category::create($request->all());
        $category->img = $imagePath;
        $category->save();
        return redirect()->route('dashboard.categories.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        return view('dashboard.categories.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Category $category)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'required',

            'img' => 'required|image'
        ]);
        if ($request->has('img')) {
            $image = $request->file('img');
            $directory = '/uploads/categories'; // Replace with the desired directory
            $helper = new ImageHelper;
            $fullPath = $helper->storeImageInPublicDirectory($image, $directory, 600, 400);
            // Save the full path with name in the database
            $imagePath = $fullPath;
            $category->img = $imagePath;
            $category->save();
        }
        $category->update($request->except('img'));
        return redirect()->route('dashboard.categories.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        $category->delete();
        return redirect()->route('dashboard.categories.index');
    }
}
