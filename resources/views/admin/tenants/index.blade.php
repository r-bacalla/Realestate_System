@extends('layouts.admin')

@section('content')
<div class="p-6">

    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold">Tenants</h1>

        <a href="{{ route('tenants.create') }}"
           class="bg-blue-600 text-white px-4 py-2 rounded-lg">
            + Add Tenant
        </a>
    </div>

    <div class="bg-white shadow rounded-lg overflow-hidden">

        <table class="w-full text-sm">
            <thead class="bg-gray-100 text-left">
                <tr>
                    <th class="p-3">Name</th>
                    <th class="p-3">Email</th>
                    <th class="p-3">Phone</th>
                    <th class="p-3">Property</th>
                    <th class="p-3">Status</th>
                    <th class="p-3">Actions</th>
                </tr>
            </thead>

            <tbody>
                @foreach($tenants as $tenant)
                <tr class="border-t">
                    <td class="p-3 font-medium">
                        {{ $tenant->first_name }} {{ $tenant->last_name }}
                    </td>

                    <td class="p-3">{{ $tenant->email }}</td>
                    <td class="p-3">{{ $tenant->phone }}</td>

                    <td class="p-3">
                        {{ $tenant->property->name ?? 'N/A' }}
                    </td>

                    <td class="p-3">
                        <span class="px-2 py-1 text-xs rounded 
                            {{ $tenant->status == 'active' ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700' }}">
                            {{ ucfirst($tenant->status) }}
                        </span>
                    </td>

                    <td class="p-3 flex gap-2">
                        <a href="{{ route('tenants.show', $tenant->id) }}"
                           class="text-blue-600">View</a>

                        <a href="{{ route('tenants.edit', $tenant->id) }}"
                           class="text-yellow-600">Edit</a>

                        <form action="{{ route('tenants.destroy', $tenant->id) }}"
                              method="POST">
                            @csrf
                            @method('DELETE')

                            <button class="text-red-600"
                                    onclick="return confirm('Delete tenant?')">
                                Delete
                            </button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>

        </table>

    </div>
</div>
@endsection