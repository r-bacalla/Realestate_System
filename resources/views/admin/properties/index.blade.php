@extends('layouts.admin')

@section('content')

<div class="p-6">

    <div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between mb-8">
        <div>
            <h1 class="text-3xl font-bold text-slate-900">Property Management</h1>
            <p class="mt-2 text-sm text-slate-500">Create, organize, and manage all properties from one place.</p>
        </div>

        <div class="flex flex-col gap-3 sm:flex-row sm:items-center">
            <a href="{{ route('admin.properties.create') }}" class="inline-flex items-center justify-center rounded-2xl bg-blue-600 px-5 py-3 text-sm font-semibold text-white shadow hover:bg-blue-700">
                + Add Property
            </a>
            <a href="{{ route('admin.dashboard') }}" class="inline-flex items-center justify-center rounded-2xl border border-slate-200 bg-white px-5 py-3 text-sm font-semibold text-slate-700 shadow-sm hover:bg-slate-50">
                Dashboard
            </a>
        </div>
    </div>

    @if(session('success'))
        <div class="mb-6 rounded-2xl border border-green-200 bg-green-50 px-5 py-4 text-sm text-green-700">
            {{ session('success') }}
        </div>
    @endif

    <div class="grid gap-6 md:grid-cols-2 xl:grid-cols-3">
        @forelse($properties as $property)
            <div class="bg-white rounded-3xl border border-slate-200 p-5 shadow-sm hover:shadow-lg transition">
                <div class="flex items-start justify-between gap-3">
                    <div>
                        <h2 class="text-xl font-semibold text-slate-900">{{ $property->name }}</h2>
                        <p class="text-sm text-slate-500 mt-1">{{ ucfirst($property->type) }} · {{ $property->city }}, {{ $property->province }}</p>
                    </div>
                    <span class="rounded-full px-3 py-1 text-xs font-semibold uppercase tracking-wide {{ $property->status == 'sold' ? 'bg-red-100 text-red-700' : ($property->status == 'rented' ? 'bg-yellow-100 text-yellow-700' : 'bg-green-100 text-green-700') }}">
                        {{ ucfirst($property->status) }}
                    </span>
                </div>

                <div class="mt-4 text-slate-900">
                    <p class="text-2xl font-bold">₱{{ number_format($property->price, 2) }}</p>
                </div>

                <div class="mt-4 grid grid-cols-3 gap-3 text-sm text-slate-600">
                    <div class="rounded-2xl bg-slate-50 p-3 text-center">
                        <div class="font-semibold">{{ $property->bedrooms }}</div>
                        <div>Beds</div>
                    </div>
                    <div class="rounded-2xl bg-slate-50 p-3 text-center">
                        <div class="font-semibold">{{ $property->bathrooms }}</div>
                        <div>Baths</div>
                    </div>
                    <div class="rounded-2xl bg-slate-50 p-3 text-center">
                        <div class="font-semibold">{{ $property->area_sqm }} sqm</div>
                        <div>Area</div>
                    </div>
                </div>

                <div class="mt-5 flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
                    <a href="{{ route('admin.properties.show', $property) }}" class="inline-flex items-center justify-center rounded-2xl border border-slate-200 bg-slate-100 px-4 py-2 text-sm font-semibold text-slate-700 hover:bg-slate-200">
                        View
                    </a>
                    <a href="{{ route('admin.properties.edit', $property) }}" class="inline-flex items-center justify-center rounded-2xl bg-blue-600 px-4 py-2 text-sm font-semibold text-white hover:bg-blue-700">
                        Edit
                    </a>
                </div>
            </div>
        @empty
            <div class="col-span-full rounded-3xl border border-dashed border-slate-300 bg-white p-10 text-center text-slate-600">
                <h2 class="text-xl font-semibold text-slate-900">No properties yet</h2>
                <p class="mt-2">Start by adding your first property to the system.</p>
                <a href="{{ route('admin.properties.create') }}" class="mt-4 inline-flex items-center justify-center rounded-2xl bg-blue-600 px-5 py-3 text-sm font-semibold text-white hover:bg-blue-700">
                    Add Property
                </a>
            </div>
        @endforelse
    </div>

    <div class="mt-8">
        {{ $properties->links() }}
    </div>

</div>

@endsection