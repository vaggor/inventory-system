<?php

namespace App\Http\Controllers;

use App\Models\Location;
use Illuminate\Http\Request;

class LocationController extends Controller
{
    /**
     * Display a listing of locations.
     */
    public function index()
    {
        $locations = Location::all();
        return view('locations.index', compact('locations'));
    }

    /**
     * Show the form for creating a new location.
     */
    public function create()
    {
        return view('locations.create');
    }

    /**
     * Store a newly created location in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        if (Location::create($request->only('name', 'description'))) {
            return redirect()->route('locations.index')->with('success', 'Location created successfully.');
        } else {
            return redirect()->back()->withInput()->with('error', 'Failed to create location.');
        }
    }

    /**
     * Display the specified location.
     */
    public function show(Location $location)
    {
        //
    }

    /**
     * Show the form for editing the specified location.
     */
    public function edit(Location $location)
    {
        return view('locations.edit', compact('location'));
    }

    /**
     * Update the specified location in storage.
     */
    public function update(Request $request, Location $location)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        if ($location->update($request->only('name', 'description'))) {
            return redirect()->route('locations.index')->with('success', 'Location updated successfully.');
        } else {
            return redirect()->back()->withInput()->with('error', 'Failed to update location.');
        }
    }

    /**
     * Remove the specified location from storage.
     */
    public function destroy(Location $location)
    {
        if ($location->delete()) {
            return redirect()->route('locations.index')->with('success', 'Location deleted successfully.');
        } else {
            return redirect()->back()->with('error', 'Failed to delete location.');
        }
    }
}
