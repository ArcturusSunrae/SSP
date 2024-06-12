<?php

namespace App\Http\Controllers;

use App\Models\Property;
use App\Http\Requests\StorePropertyRequest;
use App\Http\Requests\UpdatePropertyRequest;

class PropertyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('properties.index', [
            'properties' => Property::orderBy('created_at', 'DESC')->paginate(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('properties.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePropertyRequest $request)
    {
        //get the validated data
        $validated = $request->validated();

        //create the slug
        $validated['slug'] = \Str::slug($validated['name']);


        Property::create($validated);

        return redirect()->route('properties.index')
            ->with('flash.banner', 'Property created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Property $property)
    {
        return view('properties.show', [
            'property' => $property,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Property $property)
    {
        return view('properties.edit', [
            'property' => $property,
        ]);

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePropertyRequest $request, Property $property)
    {
        //get the validated data
        $validated = $request->validated();

        //create the slug
        $validated['slug'] = \Str::slug($validated['name']);

        $property->update($validated);

        return redirect()->route('properties.index')
            ->with('flash.banner', 'Property updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Property $property)
    {
        $model = $property;
        $property->delete();

        //set the banner status to danger

        session()->flash('flash.bannerStyle', 'danger');
        return redirect()->route('properties.index')
            ->with('flash.banner', 'Property deleted successfully');

    }
}
