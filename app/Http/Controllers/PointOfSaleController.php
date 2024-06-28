<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PointOfSale;

class PointOfSaleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pointsOfSale = PointOfSale::all();
        return response()->json($pointsOfSale);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // This method can return a view for creating a new point of sale
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'code' => 'required|string|max:255',
            'name' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'route' => 'required|string|max:255',
            'table' => 'required|string|max:255',
            'location_id' => 'required|integer|exists:locations,id',
        ]);

        $pointOfSale = PointOfSale::create($validatedData);
        return response()->json($pointOfSale, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $pointOfSale = PointOfSale::findOrFail($id);
        return response()->json($pointOfSale);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        // This method can return a view for editing the specified point of sale
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validatedData = $request->validate([
            'code' => 'sometimes|required|string|max:255',
            'name' => 'sometimes|required|string|max:255',
            'address' => 'sometimes|required|string|max:255',
            'route' => 'sometimes|required|string|max:255',
            'table' => 'sometimes|required|string|max:255',
            'location_id' => 'sometimes|required|integer|exists:locations,id',
        ]);

        $pointOfSale = PointOfSale::findOrFail($id);
        $pointOfSale->update($validatedData);
        return response()->json($pointOfSale);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $pointOfSale = PointOfSale::findOrFail($id);
        $pointOfSale->delete();
        return response()->json(null, 204);
    }
}
