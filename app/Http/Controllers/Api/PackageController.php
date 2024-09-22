<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Package;
use Illuminate\Http\Request;

class PackageController extends Controller
{
    // Fetch all packages
    public function index()
    {
        $packages = Package::with('events')->get();
        return response()->json($packages);
    }

    // Store a new package
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric',
            'deadline' => 'nullable|date',
        ]);

        $package = Package::create($request->all());
        return response()->json($package, 201);
    }

    // Show a specific package
    public function show($id)
    {
        $package = Package::with('events')->findOrFail($id);
        return response()->json($package);
    }

    // Update a package
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'sometimes|required|string|max:255',
            'description' => 'sometimes|required|string',
            'price' => 'sometimes|required|numeric',
            'deadline' => 'sometimes|nullable|date',
        ]);

        $package = Package::findOrFail($id);
        $package->update($request->all());
        return response()->json($package);
    }

    // Delete a package
    public function destroy($id)
    {
        $package = Package::findOrFail($id);
        $package->delete();
        return response()->json(null, 204);
    }
}
