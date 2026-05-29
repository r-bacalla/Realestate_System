@extends('layouts.admin')

@section('content')

<div class="p-6 max-w-xl">

    <h1 class="text-2xl font-bold mb-4">
        Pay Rent - {{ $lease->lease_number }}
    </h1>

    <form method="POST" action="{{ route('payments.store', $lease) }}" class="space-y-4">

        @csrf

        <div>
            <label class="block">Amount</label>
            <input type="number" name="amount" class="w-full border p-2 rounded" required>
        </div>

        <div>
            <label class="block">Payment Date</label>
            <input type="date" name="payment_date" class="w-full border p-2 rounded" required>
        </div>

        <div>
            <label class="block">Method</label>
            <select name="method" class="w-full border p-2 rounded">
                <option value="cash">Cash</option>
                <option value="bank">Bank Transfer</option>
                <option value="gcash">GCash</option>
            </select>
        </div>

        <div>
            <label class="block">Notes</label>
            <textarea name="notes" class="w-full border p-2 rounded"></textarea>
        </div>

        <button class="bg-blue-600 text-white px-4 py-2 rounded">
            Submit Payment
        </button>

    </form>

</div>

@endsection