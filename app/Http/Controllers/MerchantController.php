<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Merchant;

class MerchantController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $merchants = Merchant::all();
        return response()->json($merchants);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // This method can return a view for creating a new merchant
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:merchants,email',
            'phone' => 'required|string|max:15',
        ]);

        $merchant = Merchant::create($validatedData);
        return response()->json($merchant, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $merchant = Merchant::findOrFail($id);
        return response()->json($merchant);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        // This method can return a view for editing the specified merchant
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validatedData = $request->validate([
            'name' => 'sometimes|required|string|max:255',
            'email' => 'sometimes|required|email|unique:merchants,email,' . $id,
            'phone' => 'sometimes|required|string|max:15',
        ]);

        $merchant = Merchant::findOrFail($id);
        $merchant->update($validatedData);
        return response()->json($merchant);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $merchant = Merchant::findOrFail($id);
        $merchant->delete();
        return response()->json(null, 204);
    }
}
