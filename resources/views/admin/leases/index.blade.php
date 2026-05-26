@extends('layouts.admin')

@section('content')

<div class="p-6">

    <div class="flex justify-between mb-4">
        <h1 class="text-2xl font-bold">Leases</h1>

        <a href="{{ route('leases.create') }}"
            class="bg-blue-600 text-white px-4 py-2 rounded">
            Add Lease
        </a>
    </div>

    <div class="bg-white shadow rounded-lg overflow-hidden">
        <table class="w-full">
            <thead class="bg-gray-120">
                <tr>
                    <th class="p-3 text-left">Tenant</th>
                    <th class="p-3 text-left">Property</th>
                    <th class="p-3 text-left">Start</th>
                    <th class="p-3 text-left">End</th>
                    <th class="p-3 text-left">Rent</th>
                    <th class="p-3 text-left">Actions</th>
                </tr>
            </thead>

            <tbody>
                @foreach($leases as $lease)
                    <tr class="border-t">

                        {{-- Tenant --}}
                        <td class="p-3">
                            {{ $lease->tenant->first_name }} {{ $lease->tenant->last_name }}
                        </td>

                        {{-- Property --}}
                        <td class="p-3">
                            {{ $lease->property->name }}
                        </td>

                        {{-- Start Date --}}
                        <td class="p-3">
                            {{ $lease->start_date }}
                        </td>

                        {{-- End Date --}}
                        <td class="p-3">
                            {{ $lease->end_date }}
                        </td>

                        {{-- Rent --}}
                        <td class="p-3">
                            ₱{{ $lease->monthly_rent }}
                        </td>

                        {{-- Actions --}}
                        <td class="p-3 flex gap-2">
                            <a href="{{ route('leases.edit', $lease) }}"
                            class="text-blue-600">
                                Edit
                            </a>

                            <form method="POST"
                                action="{{ route('leases.destroy', $lease) }}">
                                @csrf
                                @method('DELETE')

                                <button class="text-red-600"
                                        onclick="return confirm('Delete this lease?')">
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