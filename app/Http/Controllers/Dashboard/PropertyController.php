<?php

namespace App\Http\Controllers\Dashboard;

use App\Helpers\ImageHelper;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Property;
use App\Models\User;
use Illuminate\Http\Request;

class PropertyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (auth()->user()->hasRole('owner')) {
        $properties = auth()->user()->properties;

        }
        else{
        $properties = Property::latest()->get();

        }


        return view('dashboard.properties.index', compact('properties'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $users=User::all();
        $categories = Category::all();
        return view('dashboard.properties.create', compact('users', 'categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'required',
            'price' => 'required',
            'area' => 'required',
            'rooms' => 'required',
            'direction' =>  'required',
            'address' =>  'required',
            'status' =>  'required',
            'type' =>  'required',
            'user_id' =>  'required',
            'category_id' =>  'required',
            'img' => 'required|image'
        ]);
        if ($request->has('img')) {
            $image = $request->file('img');
            $directory = '/uploads/categroies'; // Replace with the desired directory
            $helper = new ImageHelper;
            $fullPath = $helper->storeImageInPublicDirectory($image, $directory, 600, 400);
            // Save the full path with name in the database
            $imagePath = $fullPath;
        }

        $property=Property::create($request->all());
        $property->img=$imagePath;
        $property->save();
        return redirect()->route('dashboard.properties.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $property = Property::find($id);
        if ($property) {

            return response()->json($property);
        } else {

            return response()->json(404);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $property = Property::find($id);
        $users=User::all();
        $categories = Category::all();

        return view('dashboard.properties.edit', compact('property', 'users', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $property = Property::find($id);
        $request->validate([
            'name' => 'required',
            'description' => 'required',
            'price' => 'required',
            'area' => 'required',
            'rooms' => 'required',
            'direction' =>  'required',
            'address' =>  'required',
            'status' =>  'required',
            'type' =>  'required',
            'user_id' =>  'required',
            'category_id' =>  'required',
            'img' => 'nullable|image'
        ]);
        if ($request->has('img')) {
            $image = $request->file('img');
            $directory = '/uploads/property'; // Replace with the desired directory
            $helper = new ImageHelper;
            $fullPath = $helper->storeImageInPublicDirectory($image, $directory, 600, 400);
            // Save the full path with name in the database
            $imagePath = $fullPath;
            $property->img=$imagePath;
        $property->save();
        }
        $property->update($request->except('img'));

        return redirect()->route('dashboard.properties.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $property = Property::find($id);
        $property->delete();

        return redirect()->route('dashboard.properties.index');
    }
}
