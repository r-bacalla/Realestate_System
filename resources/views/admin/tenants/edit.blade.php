@extends('layouts.admin')

@section('content')
<div class="p-6">

    <h1 class="text-2xl font-bold mb-6">Edit Tenant</h1>

    <form method="POST"
          action="{{ route('tenants.update', $tenant->id) }}"
          class="bg-white p-6 rounded-lg shadow space-y-4">

        @csrf
        @method('PUT')

        <input name="first_name" value="{{ $tenant->first_name }}"
               class="border p-2 rounded w-full">

        <input name="last_name" value="{{ $tenant->last_name }}"
               class="border p-2 rounded w-full">

        <input name="email" value="{{ $tenant->email }}"
               class="border p-2 rounded w-full">

        <input name="phone" value="{{ $tenant->phone }}"
               class="border p-2 rounded w-full">

        <select name="property_id" class="border p-2 rounded w-full">
            @foreach($properties as $property)
                <option value="{{ $property->id }}"
                    {{ $tenant->property_id == $property->id ? 'selected' : '' }}>
                    {{ $property->name }}
                </option>
            @endforeach
        </select>

        <select name="status" class="border p-2 rounded w-full">
            <option value="active" {{ $tenant->status == 'active' ? 'selected' : '' }}>Active</option>
            <option value="inactive" {{ $tenant->status == 'inactive' ? 'selected' : '' }}>Inactive</option>
        </select>

        <textarea name="notes" class="border p-2 rounded w-full">
            {{ $tenant->notes }}
        </textarea>

        <button class="bg-green-600 text-white px-4 py-2 rounded">
            Update Tenant
        </button>

    </form>

</div>
@endsection