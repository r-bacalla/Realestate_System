<?php

namespace App\Http\Controllers;

use App\Models\MaintenanceRequest;
use App\Models\Property;
use App\Models\Tenant;
use Illuminate\Http\Request;

class MaintenanceRequestController extends Controller
{
    public function index()
    {
        $requests = MaintenanceRequest::with('property', 'tenant')
            ->latest()
            ->get();

        return view('admin.maintenance.index', compact('requests'));
    }

    public function create()
    {
        return view('admin.maintenance.create', [
            'properties' => Property::all(),
            'tenants' => Tenant::all(),
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'property_id' => 'required|exists:properties,id',
            'tenant_id' => 'required|exists:tenants,id',
            'title' => 'required',
            'description' => 'required',
        ]);

        MaintenanceRequest::create([
            'ticket_number' => 'T-' . time(),
            ...$validated,
            'reported_by' => auth()->id(),
        ]);

        return redirect()->route('maintenance.index')
            ->with('success', 'Request created successfully');
    }

    public function show(MaintenanceRequest $maintenanceRequest)
    {
        return view('admin.maintenance.show', compact('maintenanceRequest'));
    }

    public function edit(MaintenanceRequest $maintenanceRequest)
    {
        return view('admin.maintenance.edit', [
            'maintenanceRequest' => $maintenanceRequest,
            'properties' => Property::all(),
            'tenants' => Tenant::all(),
        ]);
    }

    public function update(Request $request, MaintenanceRequest $maintenanceRequest)
    {
        $maintenanceRequest->update($request->all());

        return redirect()->route('maintenance.index')
            ->with('success', 'Updated successfully');
    }

    public function destroy(MaintenanceRequest $maintenanceRequest)
    {
        $maintenanceRequest->delete();

        return redirect()->route('maintenance.index')
            ->with('success', 'Deleted successfully');
    }
}