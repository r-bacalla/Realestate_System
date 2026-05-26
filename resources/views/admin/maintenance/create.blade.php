@extends('layouts.admin')

@section('content')

<div class="p-6 bg-white rounded shadow">

    <h1 class="text-xl font-bold mb-4">
        Create Maintenance Request
    </h1>

    <form method="POST" action="{{ route('maintenance.store') }}">
        @csrf

        <div class="space-y-4">

            {{-- PROPERTY --}}
            <div>
                <label class="font-semibold">Property</label>
                <select name="property_id" class="w-full border rounded p-2" required>
                    <option value="">Select Property</option>
                    @foreach($properties as $property)
                        <option value="{{ $property->id }}">
                            {{ $property->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            {{-- TENANT --}}
            <div>
                <label class="font-semibold">Tenant</label>
                <select name="tenant_id" class="w-full border rounded p-2" required>
                    <option value="">Select Tenant</option>
                    @foreach($tenants as $tenant)
                        <option value="{{ $tenant->id }}">
                            {{ $tenant->first_name }} {{ $tenant->last_name }}
                        </option>
                    @endforeach
                </select>
            </div>

            {{-- TITLE --}}
            <div>
                <label class="font-semibold">Title</label>
                <input type="text" name="title" class="w-full border rounded p-2" required>
            </div>

            {{-- DESCRIPTION --}}
            <div>
                <label class="font-semibold">Description</label>
                <textarea name="description" class="w-full border rounded p-2" rows="4" required></textarea>
            </div>

        </div>

        <button class="mt-4 bg-green-600 text-white px-4 py-2 rounded">
            Save Request
        </button>

    </form>

</div>

@endsection