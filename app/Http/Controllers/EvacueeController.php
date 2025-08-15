<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Evacuee;

class EvacueeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('evacuee.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {   
        $evacsites = \App\Models\Evacsite::all();
        return view('evacuee.create', compact('evacsites'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
        'evacsites_id' => 'required|exists:evacsites,id',
        'last_name' => 'required|string|max:100',
        'first_name' => 'required|string|max:100',
        'middle_name' => 'nullable|string|max:100',
        'contact_number' => 'required|string|max:20',
        'age' => 'required|integer|min:0|max:120',
        'gender' => 'required|in:Male,Female,Other',
        'barangay' => 'required|string|max:100',
        'address' => 'required|string|max:255',
        'family_count' => 'required|integer|min:1',
        'medical_condition' => 'nullable|string',
        'remarks' => 'nullable|string',
        ]);

        Evacuee::create($validated);

        return redirect()->route('evacuee.index')
        ->with('success', 'Evacuee added successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
