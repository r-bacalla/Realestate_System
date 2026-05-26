@extends('layouts.admin')

@section('content')

<div class="p-6 space-y-6">

    <h1 class="text-2xl font-bold">
        Lease Details
    </h1>

    {{-- TENANT + PROPERTY --}}
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

        <div class="bg-white p-4 rounded shadow">
            <h2 class="font-bold mb-2">Tenant</h2>

            <p>
                {{ $lease->tenant?->first_name }} {{ $lease->tenant?->last_name }}
            </p>

            <p class="text-sm text-gray-600">
                {{ $lease->tenant?->email ?? 'N/A' }}
            </p>
        </div>

        <div class="bg-white p-4 rounded shadow">
            <h2 class="font-bold mb-2">Property</h2>

            <p>
                {{ $lease->property?->name }}
            </p>

            <p class="text-sm text-gray-600">
                {{ $lease->property?->address ?? 'No address' }}
            </p>
        </div>

    </div>

    {{-- LEASE DETAILS --}}
    <div class="bg-white p-4 rounded shadow">
        <h2 class="font-bold mb-2">Contract Details</h2>

        <div class="grid grid-cols-2 gap-4 text-sm">

            <p>
                <strong>Start:</strong>
                {{ $lease->start_date }}
            </p>

            <p>
                <strong>End:</strong>
                {{ $lease->end_date }}
            </p>

            <p>
                <strong>Status:</strong>
                {{ ucfirst($lease->status ?? 'active') }}
            </p>

            <p>
                <strong>Rent:</strong>
                ₱{{ number_format($lease->monthly_rent ?? 0) }}
            </p>

        </div>
    </div>

    {{-- PAYMENT HISTORY --}}
    <div class="bg-white p-4 rounded shadow">

        <h2 class="font-bold mb-4">Payment History</h2>

        <table class="w-full text-sm">

            <thead class="bg-gray-100">
                <tr>
                    <th class="p-2 text-left">Date</th>
                    <th class="p-2 text-left">Amount</th>
                    <th class="p-2 text-left">Status</th>
                </tr>
            </thead>

            <tbody>
                @forelse($lease->payments as $payment)
                    <tr class="border-t">

                        <td class="p-2">
                            {{ $payment->payment_date ?? $payment->created_at->format('Y-m-d') }}
                        </td>

                        <td class="p-2">
                            ₱{{ number_format($payment->amount, 2) }}
                        </td>

                        <td class="p-2">
                            <span class="text-green-600 font-semibold">
                                {{ ucfirst($payment->status) }}
                            </span>
                        </td>

                        <td class="p-2 text-right">
                            <form method="POST" action="{{ route('payments.destroy', $payment) }}" onsubmit="return confirm('Delete this payment?');">
                                @csrf
                                @method('DELETE')
                                <button class="text-red-600 text-sm">Delete</button>
                            </form>
                        </td>

                    </tr>
                @empty
                    <tr>
                        <td colspan="3" class="p-2 text-gray-500">
                            No payments found
                        </td>
                    </tr>
                @endforelse
            </tbody>

        </table>

    </div>

    {{-- RECORD PAYMENT FORM (ADMIN) --}}
    <div class="bg-white p-4 rounded shadow mt-6">
        <h2 class="font-bold mb-4">Record Payment</h2>

        <form method="POST" action="{{ route('payments.store', $lease) }}">
            @csrf

            <div class="grid grid-cols-1 md:grid-cols-3 gap-3">
                <div>
                    <label class="block text-sm font-medium">Amount</label>
                    <input name="amount" type="number" step="0.01" min="0" required class="border p-2 w-full" />
                </div>

                <div>
                    <label class="block text-sm font-medium">Date</label>
                    <input name="payment_date" type="date" value="{{ now()->toDateString() }}" required class="border p-2 w-full" />
                </div>

                <div>
                    <label class="block text-sm font-medium">Method</label>
                    <select name="method" class="border p-2 w-full">
                        <option value="cash">Cash</option>
                        <option value="gcash">Gcash</option>
                        <option value="bank">Bank Transfer</option>
                        <option value="manual">Manual</option>
                    </select>
                </div>
            </div>

            <div class="mt-3">
                <label class="block text-sm font-medium">Notes (optional)</label>
                <textarea name="notes" class="border p-2 w-full" rows="3"></textarea>
            </div>

            <div class="mt-4">
                <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">Record Payment</button>
            </div>
        </form>
    </div>

</div>

@endsection