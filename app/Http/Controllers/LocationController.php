<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Location;

class LocationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $locations = Location::with('subRegion.region')->get()->map(function ($location) {
            return [
                'id' => $location->id,
                'name' => $location->name,
                'sub_region_id' => $location->subRegion->id,
                'region_id' => $location->subRegion->region->id
            ];
        });

        return response()->json($locations);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // This method can return a view for creating a new location
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'subregion_id' => 'required|integer',
            'name' => 'required|string|max:255',
        ]);

        $location = Location::create($validatedData);
        return response()->json($location, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $location = Location::findOrFail($id);
        return response()->json($location);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $location = Location::findOrFail($id);
        // This method can return a view for editing the location
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validatedData = $request->validate([
            'subregion_id' => 'required|integer',
            'name' => 'required|string|max:255',
        ]);

        $location = Location::findOrFail($id);
        $location->update($validatedData);
        return response()->json($location);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $location = Location::findOrFail($id);
        $location->delete();
        return response()->json(null, 204);
    }
}
