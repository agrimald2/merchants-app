<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Region;

class RegionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $regions = Region::all();
        return response()->json($regions);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // This method can return a view for creating a new region
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $region = Region::create($validatedData);

        return response()->json($region, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $region = Region::findOrFail($id);
        return response()->json($region);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        // This method can return a view for editing the specified region
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $region = Region::findOrFail($id);
        $region->update($validatedData);

        return response()->json($region);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $region = Region::findOrFail($id);
        $region->delete();

        return response()->json(null, 204);
    }
}
