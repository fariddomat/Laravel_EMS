<?php

namespace App\Http\Controllers\Dashboard;

use App\Helpers\ImageHelper;
use App\Http\Controllers\Controller;
use App\Models\Property;
use App\Models\PropertyImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PropertyImageController extends Controller
{
   /**
     * Display a listing of the resource.
     */
    public function index(Property $property)
    {
        $propertyImages=$property->property_images;
        return view('dashboard.properties.images.index', compact('property', 'propertyImages'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create($property)
    {
        return view('dashboard.properties.images.create', compact('property'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Property $property,Request $request)
    {

        $validatedData = $request->validate([
            'img' => 'required|image', // Validation for the uploaded file
        ]);

        if ($request->has('img')) {
            $image = $request->file('img');
            $directory = '/uploads/property'; // Replace with the desired directory
            $helper = new ImageHelper;
            $fullPath = $helper->storeImageInPublicDirectory($image, $directory);
            // Save the full path with name in the database
            $imagePath = $fullPath;
        }
        PropertyImage::create([
            'property_id' => $property->id,
            'img' => $imagePath,
        ]);

        return redirect()->route('dashboard.image.index', $property);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Property $property,  $propertyImage)
    {
        $propertyImage= PropertyImage::findOrFail($propertyImage);
        // Delete the file from storage
        Storage::delete($propertyImage->path);
        // Delete the database record
        $propertyImage->delete();
        return redirect()->route('dashboard.image.index', $property);
    }
}
