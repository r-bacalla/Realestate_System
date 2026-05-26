<?php

namespace App\Http\Controllers;

use App\Models\Tenant;
use App\Models\Property;
use Illuminate\Http\Request;

class TenantController extends Controller
{
    public function index()
    {
        $tenants = Tenant::with('property')->latest()->get();
        return view('admin.tenants.index', compact('tenants'));
    }

    public function create()
    {
        $properties = Property::all();
        return view('admin.tenants.create', compact('properties'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'property_id' => 'nullable|exists:properties,id',
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|email',
        ]);

        Tenant::create($validated);

        return redirect()->route('tenants.index')
            ->with('success', 'Tenant created successfully');
    }

    public function show(Tenant $tenant)
    {
        $tenant->load('property', 'leases');
        return view('admin.tenants.show', compact('tenant'));
    }

    public function edit(Tenant $tenant)
    {
        $properties = Property::all();
        return view('admin.tenants.edit', compact('tenant', 'properties'));
    }

    public function update(Request $request, Tenant $tenant)
    {
        $validated = $request->validate([
            'property_id' => 'nullable|exists:properties,id',
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|email',
        ]);

        $tenant->update($validated);

        return redirect()->route('tenants.index')
            ->with('success', 'Tenant updated successfully');
    }

    public function destroy(Tenant $tenant)
    {
        $tenant->delete();

        return redirect()->route('tenants.index')
            ->with('success', 'Tenant deleted successfully');
    }
}