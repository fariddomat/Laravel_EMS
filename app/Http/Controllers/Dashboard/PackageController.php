<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Package;
use App\Models\Event;
use Illuminate\Http\Request;

class PackageController extends Controller
{
    public function index()
    {
        $packages = Package::with('events')->get();
        return view('dashboard.packages.index', compact('packages'));
    }

    public function create()
    {
        $events = Event::all();
        return view('dashboard.packages.create', compact('events'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'required',
            'price' => 'required|numeric',
            'deadline' => 'required|date',
            'event_ids' => 'required|array',
        ]);

        $package = Package::create($request->except('event_ids'));
        $package->events()->attach($request->event_ids);

        return redirect()->route('dashboard.packages.index')->with('success', 'Package created successfully.');
    }

    public function show(Package $package)
    {
        return view('dashboard.packages.show', compact('package'));
    }

    public function edit(Package $package)
    {
        $events = Event::all();
        return view('dashboard.packages.edit', compact('package', 'events'));
    }

    public function update(Request $request, Package $package)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'required',
            'price' => 'required|numeric',
            'deadline' => 'required|date',
            'event_ids' => 'required|array',
        ]);

        $package->update($request->except('event_ids'));
        $package->events()->sync($request->event_ids);

        return redirect()->route('dashboard.packages.index')->with('success', 'Package updated successfully.');
    }

    public function destroy(Package $package)
    {
        $package->delete();
        return redirect()->route('dashboard.packages.index')->with('success', 'Package deleted successfully.');
    }
}
