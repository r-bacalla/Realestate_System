<?php

namespace App\Http\Controllers;

use App\Models\Lease;
use App\Models\Tenant;
use App\Models\Property;
use Illuminate\Http\Request;

class LeaseController extends Controller
{
    public function index()
    {
        $leases = Lease::with(['tenant', 'property'])
            ->latest()
            ->get();

        return view('admin.leases.index', compact('leases'));
    }

    public function create()
    {
        return view('admin.leases.create', [
            'tenants' => Tenant::all(),
            'properties' => Property::where('status', 'available')->get(),
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'tenant_id' => 'required|exists:tenants,id',
            'property_id' => 'required|exists:properties,id',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after:start_date',
            'monthly_rent' => 'required|numeric|min:0',
        ]);

        Lease::create([
            'lease_number' => 'L-' . time(),
            ...$validated,
        ]);

        return redirect()->route('leases.index')
            ->with('success', 'Lease created successfully');
    }

    public function show(Lease $lease)
    {
        $lease->load(['tenant', 'property', 'payments']);

        return view('admin.leases.show', compact('lease'));
    }

    public function edit(Lease $lease)
    {
        return view('admin.leases.edit', [
            'lease' => $lease,
            'tenants' => Tenant::all(),
            'properties' => Property::where('status', 'available')
                ->orWhere('id', $lease->property_id)
                ->get(),
        ]);
    }

    public function update(Request $request, Lease $lease)
    {
        $validated = $request->validate([
            'tenant_id' => 'required|exists:tenants,id',
            'property_id' => 'required|exists:properties,id',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after:start_date',
            'monthly_rent' => 'required|numeric|min:0',
        ]);

        $lease->update($validated);

        return redirect()->route('leases.index')
            ->with('success', 'Lease updated successfully');
    }

    public function destroy(Lease $lease)
    {
        $lease->delete();

        return redirect()->route('leases.index')
            ->with('success', 'Lease deleted successfully');
    }
}