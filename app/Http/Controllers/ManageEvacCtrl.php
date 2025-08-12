<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Evacsite;

class ManageEvacCtrl extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $evacsites = Evacsite::all();
        return view('evacsite.main', compact('evacsites'));
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
        //
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
        $evacsite = Evacsite::findOrFail($id);
        return view('evacsite.edit', compact('evacsite'));
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
