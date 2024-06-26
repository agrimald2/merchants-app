<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SubRegion;

class SubRegionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $subRegions = SubRegion::all();
        return response()->json($subRegions);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'region_id' => 'required|integer',
            'name' => 'required|string|max:255',
        ]);

        $subRegion = SubRegion::create($validatedData);
        return response()->json($subRegion, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $subRegion = SubRegion::findOrFail($id);
        return response()->json($subRegion);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validatedData = $request->validate([
            'region_id' => 'integer',
            'name' => 'string|max:255',
        ]);

        $subRegion = SubRegion::findOrFail($id);
        $subRegion->update($validatedData);
        return response()->json($subRegion);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $subRegion = SubRegion::findOrFail($id);
        $subRegion->delete();
        return response()->json(null, 204);
    }
}
