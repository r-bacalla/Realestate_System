<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Property;
use App\Models\PropertyImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PropertyController extends Controller
{
    public function index()
    {
        $properties = Property::with('images')
            ->latest()
            ->paginate(12);

        return view('admin.properties.index', compact('properties'));
    }

    public function create()
    {
        return view('admin.properties.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required',
            'type' => 'required',
            'address' => 'required',
            'city' => 'required',
            'province' => 'required',
            'price' => 'required|numeric',
            'status' => 'required',
            'bedrooms' => 'required|integer',
            'bathrooms' => 'required|integer',
            'area_sqm' => 'required|integer',
            'description' => 'nullable',
            'year_built' => 'nullable|integer',
            'images.*' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $property = Property::create($data);

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $path = $image->store('properties', 'public');

                $property->images()->create([
                    'image_path' => $path
                ]);
            }
        }

        return redirect()
            ->route('admin.properties.index')
            ->with('success', 'Property created successfully.');
    }

    public function edit(Property $property)
    {
        $property->load('images');

        return view('admin.properties.edit', compact('property'));
    }

    public function update(Request $request, Property $property)
    {
        $data = $request->validate([
            'name' => 'required',
            'type' => 'required',
            'address' => 'required',
            'city' => 'required',
            'province' => 'required',
            'price' => 'required|numeric',
            'status' => 'required',
            'bedrooms' => 'required|integer',
            'bathrooms' => 'required|integer',
            'area_sqm' => 'required|integer',
            'description' => 'nullable',
            'year_built' => 'nullable|integer',
            'images.*' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $property->update($data);

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $path = $image->store('properties', 'public');

                $property->images()->create([
                    'image_path' => $path
                ]);
            }
        }

        return redirect()
            ->route('admin.properties.index')
            ->with('success', 'Property updated successfully.');
    }

    public function destroy(Property $property)
    {
        foreach ($property->images as $image) {
            Storage::disk('public')->delete($image->image_path);
            $image->delete();
        }

        $property->delete();

        return back()->with('success', 'Property deleted.');
    }

    public function deleteImage(PropertyImage $image)
    {
        Storage::disk('public')->delete($image->image_path);
        $image->delete();

        return back()->with('success', 'Image deleted.');
    }
}