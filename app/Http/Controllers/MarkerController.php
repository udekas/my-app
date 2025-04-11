<?php

namespace App\Http\Controllers;

use App\Models\Marker;
use Illuminate\Http\Request;

class MarkerController extends Controller
{
    /**
     * Display a listing of the resource
     */
    public function index()
    {
        //
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
       
        $validateData = $request->validate([
           'title' => 'required|string|max:255',
        ]);
        Marker::create([
            'name' => $validateData['title'],
            'description' => "",
            'latitude' => 58.0,
            'longitude' => 22.0,
        ]);
        
    }

    /**
     * Display the specified resource.
     */
    public function show(marker $marker)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(marker $marker)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, marker $marker)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(marker $marker)
    {
        //
    }
}
