@extends('layouts.admin')

@section('content')

<div class="p-6 space-y-6">

    <h1 class="text-2xl font-bold">
        Maintenance Details
    </h1>

    {{-- INFO CARDS --}}
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

        <div class="bg-white p-4 rounded shadow">
            <h2 class="font-bold mb-2">Property</h2>
            <p>{{ $maintenanceRequest->property->title ?? 'N/A' }}</p>
        </div>

        <div class="bg-white p-4 rounded shadow">
            <h2 class="font-bold mb-2">Tenant</h2>
            <p>{{ $maintenanceRequest->tenant->name ?? 'N/A' }}</p>
        </div>

    </div>

    {{-- ISSUE DETAILS --}}
    <div class="bg-white p-4 rounded shadow">
        <h2 class="font-bold mb-2">Issue</h2>

        <p class="text-sm text-gray-700">
            {{ $maintenanceRequest->title }}
        </p>

        <p class="mt-2 text-gray-600">
            {{ $maintenanceRequest->description }}
        </p>
    </div>

    {{-- META --}}
    <div class="bg-white p-4 rounded shadow text-sm">

        <p><strong>Status:</strong> {{ $maintenanceRequest->status ?? 'Pending' }}</p>
        <p><strong>Created:</strong> {{ $maintenanceRequest->created_at }}</p>

    </div>

</div>

@endsection