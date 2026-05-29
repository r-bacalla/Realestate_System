<?php

namespace App\Http\Controllers;

use App\Models\Property;
use Illuminate\Http\Request;

class PropertyController extends Controller
{
    public function index(Request $request)
    {
        $query = Property::with('images')->latest();

        if ($request->filled('search')) {
            $query->where(function ($query) use ($request) {
                $query->where('name', 'like', '%'.$request->search.'%')
                    ->orWhere('description', 'like', '%'.$request->search.'%');
            });
        }

        if ($request->filled('city')) {
            $query->where('city', 'like', '%'.$request->city.'%');
        }

        if ($request->filled('type')) {
            $query->where('type', 'like', '%'.$request->type.'%');
        }

        $properties = $query->paginate(12)->withQueryString();

        return view('properties.index', compact('properties'));
    }

    public function show(Property $property)
    {
        $property->load('images');
        return view('properties.show', compact('property'));
    }

    public function update(Request $request, Property $property)
{
    $validated = $request->validate([
        'name' => 'required|string|max:255',
        'title' => 'nullable|string|max:255',
        'type' => 'required|string|max:255',
        'address' => 'required|string|max:255',
        'city' => 'required|string|max:255',
        'province' => 'required|string|max:255',
        'price' => 'required|numeric',
        'status' => 'required',
        'bedrooms' => 'required|integer',
        'bathrooms' => 'required|integer',
        'area_sqm' => 'required|numeric',
        'description' => 'nullable|string',
        'about' => 'nullable|string',
        'year_built' => 'nullable|integer',
        'images.*' => 'nullable|image|max:2048',
    ]);
    

    $property->update($validated);

    if ($request->hasFile('images')) {
        foreach ($request->file('images') as $image) {
            $path = $image->store('properties', 'public');

            $property->images()->create([
                'image_path' => $path,
            ]);
        }
    }

    return redirect()
        ->route('admin.properties.index')
        ->with('success', 'Property updated successfully.');
}
}