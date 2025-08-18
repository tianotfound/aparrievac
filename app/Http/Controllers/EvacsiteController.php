<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Evacsite;
use Illuminate\Support\Facades\Validator;

class EvacsiteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {      
        $evacsites = \App\Models\Evacsite::all();
        return view('evacsite.index', compact('evacsites'));
    }

    public function manage()
    {
        $evacsites = Evacsite::all();
        return view('evacsite.main', compact('evacsites')); 
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('evacsite.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'sitename'     => 'required|string|max:255',
            'address'      => 'required|string|max:500',
            'type'         => 'required|string|in:school,gymnasium,community_center,other',
            'status'       => 'required|string|in:operational,under_maintenance,closed',
            'capacity'     => 'required|integer|min:1',
            'room'         => 'required|integer|min:1',
            'powerstatus'  => 'required|string|in:available,unavailable',
            'waterstatus'  => 'required|string|in:available,unavailable',
            'head'         => 'required|string|max:255',
            'contact'      => 'required|string|max:20',
            'medicine_qty'      => 'required|integer|min:1',
            'toiletries_qty'      => 'required|integer|min:1',
            'relief_goods_qty'      => 'required|integer|min:1',
            'beddings_qty'      => 'required|integer|min:1',
            'lat'          => 'required|numeric|between:-90,90',
            'lang'         => 'required|numeric|between:-180,180',
        ]);

        EvacSite::create($validated);

        return redirect()->route('evacsites.index')
        ->with('success', 'Evacuation site added successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $evacsites = Evacsite::findOrFail($id);
        return view('evacsite.show', compact('evacsites'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $evacsites = Evacsite::findOrFail($id);
        return view('evacsite.edit', compact('evacsites'));

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'sitename'     => 'required|string|max:255',
            'address'      => 'required|string|max:500',
            'type'         => 'required|string|in:school,gymnasium,community_center,other',
            'status'       => 'required|string|in:operational,under_maintenance,closed',
            'capacity'     => 'required|integer|min:1',
            'room'         => 'required|integer|min:1',
            'powerstatus'  => 'required|string|in:available,unavailable',
            'waterstatus'  => 'required|string|in:available,unavailable',
            'head'         => 'required|string|max:255',
            'contact'      => 'required|string|max:20',
            'medicine_qty'      => 'required|integer|min:1',
            'toiletries_qty'      => 'required|integer|min:1',
            'relief_goods_qty'      => 'required|integer|min:1',
            'beddings_qty'      => 'required|integer|min:1',
            'lat'          => 'required|numeric|between:-90,90',
            'lang'         => 'required|numeric|between:-180,180',
        ]);

        $evacSite = EvacSite::findOrFail($id); 
        $evacSite->update($validated);

        return redirect()->route('evacsites.index')
            ->with('success', 'Evacuation site updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $evacsites = Evacsite::findOrFail($id);
        $evacsites->delete();

        return redirect('')->with('status','Site Delete Successfully');
    }

}
