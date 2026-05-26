@extends('layouts.admin')

@section('content')
<div class="p-6">
    <h1 class="text-2xl font-bold text-gray-800 dark:text-white">
        Admin Dashboard
    </h1>

    <div class="grid gap-6 md:grid-cols-4 mt-6">
        <div class="p-6 bg-white dark:bg-gray-800 rounded-lg shadow">
            <p>Total properties</p>
            <p class="text-2xl font-bold">{{ $propertyCount ?? 0 }}</p>
        </div>

        <div class="p-6 bg-white dark:bg-gray-800 rounded-lg shadow">
            <p>Available</p>
            <p class="text-2xl font-bold text-green-500">{{ $availableCount ?? 0 }}</p>
        </div>

        <div class="p-6 bg-white dark:bg-gray-800 rounded-lg shadow">
            <p>Sold</p>
            <p class="text-2xl font-bold text-red-500">{{ $soldCount ?? 0 }}</p>
        </div>

        <div class="p-6 bg-white dark:bg-gray-800 rounded-lg shadow">
            <p>Pending</p>
            <p class="text-2xl font-bold text-yellow-500">{{ $pendingCount ?? 0 }}</p>
        </div>
    </div>

    <div class="mt-8 flex flex-col gap-4 sm:flex-row">
        <a href="{{ route('admin.properties.index') }}" class="inline-flex items-center justify-center rounded-2xl bg-blue-600 px-6 py-3 text-sm font-semibold text-white shadow hover:bg-blue-700">
            Manage Properties
        </a>
        <a href="{{ route('admin.properties.create') }}" class="inline-flex items-center justify-center rounded-2xl border border-slate-300 bg-white px-6 py-3 text-sm font-semibold text-slate-700 shadow-sm hover:bg-slate-50">
            Add New Property
        </a>
    </div>
</div>
@endsection