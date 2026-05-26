@extends('layouts.admin')

@section('content')

<div class="p-6">

    <div class="flex justify-between mb-4">
        <h1 class="text-2xl font-bold">
            Maintenance Requests
        </h1>

        <a href="{{ route('maintenance.create') }}"
            class="bg-blue-600 text-white px-4 py-2 rounded">
            Add Request
        </a>
    </div>

    <div class="bg-white shadow rounded">
        <table class="w-full">

            <thead class="bg-gray-100">
            <tr>
                <th class="p-3 text-left">Tenant</th>
                <th class="p-3 text-left">Property</th>
                <th class="p-3 text-left">Title</th>
                <th class="p-3 text-left">Description</th>
                <th class="p-3 text-left">Status</th>
                <th class="p-3 text-left">Actions</th>
            </tr>
        </thead>

            <tbody>
                @foreach($requests as $request)
                    <tr class="border-t">

                        {{-- Tenant --}}
                        <td class="p-3">
                            {{ $request->tenant->first_name ?? 'N/A' }}
                            {{ $request->tenant->last_name ?? '' }}
                        </td>

                        {{-- Property --}}
                        <td class="p-3">
                            {{ $request->property->name ?? 'N/A' }}
                        </td>

                        {{-- Title --}}
                        <td class="p-3">
                            {{ $request->title }}
                        </td>

                        {{-- Description --}}
                        <td class="p-3">
                            {{ \Illuminate\Support\Str::limit($request->description, 40) }}
                        </td>

                        {{-- Status --}}
                        <td class="p-3">
                            {{ $request->status ?? 'pending' }}
                        </td>

                        {{-- Actions --}}
                        <td class="p-3 flex gap-2">

                            <a href="{{ route('maintenance.edit', $request) }}"
                            class="text-blue-600">
                                Edit
                            </a>

                            <form method="POST"
                                action="{{ route('maintenance.destroy', $request) }}">
                                @csrf
                                @method('DELETE')

                                <button class="text-red-600"
                                        onclick="return confirm('Delete this request?')">
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