@extends('layouts.admin')

@section('content')

<div class="p-6">
    <div class="flex items-center justify-between mb-6">
        <h1 class="text-2xl font-bold">Payments</h1>
        <div>
            <a href="{{ route('admin.payments.export') }}" class="bg-gray-800 text-white px-3 py-2 rounded">Export CSV</a>
        </div>
    </div>

    <div class="bg-white rounded shadow">
        <table class="w-full text-sm">
            <thead class="bg-gray-100">
                <tr>
                    <th class="p-2 text-left">ID</th>
                    <th class="p-2 text-left">Lease</th>
                    <th class="p-2 text-left">Property</th>
                    <th class="p-2 text-left">Amount</th>
                    <th class="p-2 text-left">Method</th>
                    <th class="p-2 text-left">Date</th>
                </tr>
            </thead>
            <tbody>
                @foreach($payments as $p)
                <tr class="border-t">
                    <td class="p-2">{{ $p->id }}</td>
                    <td class="p-2">{{ $p->lease?->lease_number }}</td>
                    <td class="p-2">{{ $p->lease?->property?->name }}</td>
                    <td class="p-2">₱{{ number_format($p->amount,2) }}</td>
                    <td class="p-2">{{ $p->method }}</td>
                    <td class="p-2">{{ $p->payment_date ?? $p->created_at->toDateString() }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="mt-4">
        {{ $payments->links() }}
    </div>
</div>

@endsection
