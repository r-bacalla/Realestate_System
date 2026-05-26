@extends('layouts.admin')

@section('content')

<div class="p-6 bg-white rounded shadow">

    <h1 class="text-xl font-bold mb-4">
        Edit Maintenance Request
    </h1>

    <form method="POST"
          action="{{ route('maintenance.update', $maintenanceRequest) }}"
          class="space-y-4">

        @csrf
        @method('PUT')

        {{-- PROPERTY --}}
        <div>
            <label class="block font-medium">Property</label>
            <select name="property_id" class="w-full border rounded p-2" required>

                @foreach($properties as $property)
                    <option value="{{ $property->id }}"
                        {{ $maintenanceRequest->property_id == $property->id ? 'selected' : '' }}>
                        {{ $property->title }}
                    </option>
                @endforeach

            </select>
        </div>

        {{-- TENANT --}}
        <div>
            <label class="block font-medium">Tenant</label>
            <select name="tenant_id" class="w-full border rounded p-2">

                @foreach($tenants as $tenant)
                    <option value="{{ $tenant->id }}"
                        {{ $maintenanceRequest->tenant_id == $tenant->id ? 'selected' : '' }}>
                        {{ $tenant->name }}
                    </option>
                @endforeach

            </select>
        </div>

        {{-- TITLE --}}
        <div>
            <label class="block font-medium">Title</label>
            <input type="text"
                   name="title"
                   value="{{ $maintenanceRequest->title }}"
                   class="w-full border rounded p-2"
                   required>
        </div>

        {{-- DESCRIPTION --}}
        <div>
            <label class="block font-medium">Description</label>
            <textarea name="description"
                      class="w-full border rounded p-2"
                      rows="4"
                      required>{{ $maintenanceRequest->description }}</textarea>
        </div>

        <button class="bg-blue-600 text-white px-4 py-2 rounded">
            Update Request
        </button>

    </form>

</div>

@endsection