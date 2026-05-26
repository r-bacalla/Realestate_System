@extends('layouts.admin')

@section('content')
<div class="p-6">

    <h1 class="text-2xl font-bold mb-6">Add Tenant</h1>

    <form method="POST" action="{{ route('tenants.store') }}"
          class="bg-white p-6 rounded-lg shadow space-y-4">

        @csrf

        <div class="grid grid-cols-2 gap-4">

            <input name="first_name" placeholder="First Name"
                   class="border p-2 rounded w-full">

            <input name="last_name" placeholder="Last Name"
                   class="border p-2 rounded w-full">

            <input name="email" placeholder="Email"
                   class="border p-2 rounded w-full">

            <input name="phone" placeholder="Phone"
                   class="border p-2 rounded w-full">

        </div>

        <div>
            <label class="text-sm text-gray-600">Property (optional)</label>
            <select name="property_id" class="border p-2 rounded w-full">
                <option value="">-- No Property --</option>
                @foreach($properties as $property)
                    <option value="{{ $property->id }}">
                        {{ $property->name }}
                    </option>
                @endforeach
            </select>

            @if($properties->isEmpty())
                <p class="text-xs text-gray-500 mt-2">No properties yet. You can <a href="{{ route('admin.properties.create') }}" class="text-blue-600">add a property</a> first, or save the tenant without assigning a property.</p>
            @endif
        </div>

        <div>
            <select name="status" class="border p-2 rounded w-full">
                <option value="active">Active</option>
                <option value="inactive">Inactive</option>
            </select>
        </div>

        <textarea name="notes" placeholder="Notes"
                  class="border p-2 rounded w-full"></textarea>

        <button class="bg-blue-600 text-white px-4 py-2 rounded">
            Save Tenant
        </button>

    </form>

</div>
@endsection