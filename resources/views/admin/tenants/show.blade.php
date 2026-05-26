@extends('layouts.admin')

@section('content')
<div class="p-6 space-y-6">

    <h1 class="text-2xl font-bold">Tenant Profile</h1>

    <div class="bg-white p-6 rounded shadow">
        <h2 class="text-xl font-semibold">
            {{ $tenant->first_name }} {{ $tenant->last_name }}
        </h2>

        <p>Email: {{ $tenant->email }}</p>
        <p>Phone: {{ $tenant->phone }}</p>

        <p>Status:
            <span class="px-2 py-1 text-xs rounded
                {{ $tenant->status == 'active' ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700' }}">
                {{ ucfirst($tenant->status) }}
            </span>
        </p>
    </div>

    <div class="bg-white p-6 rounded shadow">
        <h2 class="font-bold mb-2">Property</h2>
        <p>{{ $tenant->property->name ?? 'N/A' }}</p>
    </div>

    <div class="bg-white p-6 rounded shadow">
        <h2 class="font-bold mb-2">Leases</h2>

        @foreach($tenant->leases as $lease)
            <div class="border-b py-2">
                <p>Lease #: {{ $lease->lease_number }}</p>
                <p>Rent: {{ $lease->monthly_rent }}</p>
                <p>Status: {{ $lease->status }}</p>
            </div>
        @endforeach
    </div>

</div>
@endsection