@extends('layouts.admin')

@section('content')

<div class="p-6">

    <div class="flex items-center justify-between mb-6">
        <h1 class="text-2xl font-bold">Payments</h1>
    </div>

    {{-- SUCCESS MESSAGE --}}
    @if(session('success'))
        <div class="bg-green-100 text-green-700 px-4 py-3 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    {{-- FILTER SECTION --}}
    <form method="GET"
          action="{{ route('admin.payments.index') }}"
          class="flex flex-wrap gap-3 mb-6">

        {{-- Month Filter --}}
        <input type="month"
               name="month"
               value="{{ request('month') }}"
               class="border rounded px-3 py-2">

        {{-- Property Filter --}}
        <select name="property_id" class="border rounded px-3 py-2">
            <option value="">All Properties</option>

            @foreach(\App\Models\Property::all() as $property)
                <option value="{{ $property->id }}"
                    {{ request('property_id') == $property->id ? 'selected' : '' }}>
                    {{ $property->name }}
                </option>
            @endforeach
        </select>

        <button class="bg-blue-600 text-white px-4 py-2 rounded">
            Filter
        </button>

        <a href="{{ route('admin.payments.index') }}"
           class="px-4 py-2 border rounded">
            Reset
        </a>

    </form>

    {{-- TABLE --}}
    <div class="bg-white rounded shadow overflow-x-auto">

        <table class="w-full text-sm">
            <thead class="bg-gray-100">
                <tr>
                    <th class="p-2 text-left">ID</th>
                    <th class="p-2 text-left">Lease</th>
                    <th class="p-2 text-left">Property</th>
                    <th class="p-2 text-left">Amount</th>
                    <th class="p-2 text-left">Method</th>
                    <th class="p-2 text-left">Date</th>
                    <th class="p-2 text-left">Actions</th>
                </tr>
            </thead>

            <tbody>
                @forelse($payments as $p)
                    <tr class="border-t">

                        <td class="p-2">{{ $p->id }}</td>

                        <td class="p-2">
                            {{ $p->lease?->lease_number }}
                        </td>

                        <td class="p-2">
                            {{ $p->lease?->property?->name }}
                        </td>

                        <td class="p-2">
                            ₱{{ number_format($p->amount,2) }}
                        </td>

                        <td class="p-2">
                            {{ ucfirst($p->method) }}
                        </td>

                        <td class="p-2">
                            {{ $p->payment_date ?? $p->created_at->toDateString() }}
                        </td>

                        <td class="p-2 flex gap-2">

                            {{-- PRINT RECEIPT --}}
                            <a href="{{ route('payments.receipt', $p) }}"
                               target="_blank"
                               class="bg-indigo-600 text-white px-3 py-1 rounded">
                                Print
                            </a>

                            {{-- DELETE --}}
                            <form method="POST"
                                  action="{{ route('payments.destroy', $p) }}"
                                  onsubmit="return confirm('Delete this payment?')">

                                @csrf
                                @method('DELETE')

                                <button class="bg-red-600 text-white px-3 py-1 rounded">
                                    Delete
                                </button>

                            </form>

                        </td>

                    </tr>
                @empty
                    <tr>
                        <td colspan="7"
                            class="p-4 text-center text-gray-500">
                            No payments found.
                        </td>
                    </tr>
                @endforelse
            </tbody>

        </table>

    </div>

    <div class="mt-4">
        {{ $payments->links() }}
    </div>

</div>

@endsection