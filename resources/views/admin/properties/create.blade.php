@extends('layouts.admin')

@section('content')
<div class="p-6">
    <div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between mb-8">
        <div>
            <h1 class="text-3xl font-bold text-slate-900">Add New Property</h1>
            <p class="mt-2 text-sm text-slate-500">Enter the property details and publish it to your inventory.</p>
        </div>
        <a href="{{ route('admin.properties.index') }}" class="inline-flex items-center justify-center rounded-2xl border border-slate-200 bg-white px-5 py-3 text-sm font-semibold text-slate-700 shadow-sm hover:bg-slate-50">
            Back to Properties
        </a>
    </div>

    <div class="rounded-3xl bg-white p-6 shadow-sm border border-slate-200">
        <x-auth-validation-errors class="mb-6" :errors="$errors" />

        <form method="POST" action="{{ route('admin.properties.store') }}" enctype="multipart/form-data" class="space-y-6">
            @csrf

            <div class="grid gap-6 md:grid-cols-2">
                <div class="space-y-4">
                    <label class="block text-sm font-medium text-slate-700">Property Name</label>
                    <input type="text" name="name" placeholder="Property name" class="w-full rounded-2xl border border-slate-300 p-3 focus:border-blue-500 focus:ring-blue-100" required>
                </div>

                <div class="space-y-4">
                    <label class="block text-sm font-medium text-slate-700">Title (optional)</label>
                    <input type="text" name="title" placeholder="Short headline" class="w-full rounded-2xl border border-slate-300 p-3 focus:border-blue-500 focus:ring-blue-100">
                </div>
            </div>

            <div class="grid gap-6 md:grid-cols-2">
                <div class="space-y-4">
                    <label class="block text-sm font-medium text-slate-700">Type</label>
                    <input type="text" name="type" placeholder="Apartment, house, etc." class="w-full rounded-2xl border border-slate-300 p-3 focus:border-blue-500 focus:ring-blue-100" required>
                </div>
                <div class="space-y-4">
                    <label class="block text-sm font-medium text-slate-700">Status</label>
                    <select name="status" class="w-full rounded-2xl border border-slate-300 p-3 focus:border-blue-500 focus:ring-blue-100" required>
                        <option value="available">Available</option>
                        <option value="rented">Rented</option>
                        <option value="sold">Sold</option>
                        <option value="maintenance">Maintenance</option>
                    </select>
                </div>
            </div>

            <div class="grid gap-6 md:grid-cols-2">
                <div class="space-y-4">
                    <label class="block text-sm font-medium text-slate-700">Price</label>
                    <input type="number" name="price" placeholder="Property price" class="w-full rounded-2xl border border-slate-300 p-3 focus:border-blue-500 focus:ring-blue-100" required>
                </div>
                <div class="space-y-4">
                    <label class="block text-sm font-medium text-slate-700">Year Built</label>
                    <input type="number" name="year_built" placeholder="2024" class="w-full rounded-2xl border border-slate-300 p-3 focus:border-blue-500 focus:ring-blue-100">
                </div>
            </div>

            <div class="grid gap-6 md:grid-cols-2">
                <div class="space-y-4">
                    <label class="block text-sm font-medium text-slate-700">Address</label>
                    <input type="text" name="address" placeholder="Street address" class="w-full rounded-2xl border border-slate-300 p-3 focus:border-blue-500 focus:ring-blue-100" required>
                </div>
                <div class="space-y-4">
                    <label class="block text-sm font-medium text-slate-700">City</label>
                    <input type="text" name="city" placeholder="City" class="w-full rounded-2xl border border-slate-300 p-3 focus:border-blue-500 focus:ring-blue-100" required>
                </div>
            </div>

            <div class="grid gap-6 md:grid-cols-2">
                <div class="space-y-4">
                    <label class="block text-sm font-medium text-slate-700">Province</label>
                    <input type="text" name="province" placeholder="Province" class="w-full rounded-2xl border border-slate-300 p-3 focus:border-blue-500 focus:ring-blue-100" required>
                </div>
                <div class="space-y-4">
                    <label class="block text-sm font-medium text-slate-700">Area (sqm)</label>
                    <input type="number" name="area_sqm" placeholder="Square meters" class="w-full rounded-2xl border border-slate-300 p-3 focus:border-blue-500 focus:ring-blue-100" required>
                </div>
            </div>

            <div class="grid gap-6 md:grid-cols-2">
                <div class="space-y-4">
                    <label class="block text-sm font-medium text-slate-700">Bedrooms</label>
                    <input type="number" name="bedrooms" placeholder="Number of bedrooms" class="w-full rounded-2xl border border-slate-300 p-3 focus:border-blue-500 focus:ring-blue-100" required>
                </div>
                <div class="space-y-4">
                    <label class="block text-sm font-medium text-slate-700">Bathrooms</label>
                    <input type="number" name="bathrooms" placeholder="Number of bathrooms" class="w-full rounded-2xl border border-slate-300 p-3 focus:border-blue-500 focus:ring-blue-100" required>
                </div>
            </div>

            <div class="space-y-4">
                <label class="block text-sm font-medium text-slate-700">Short Description</label>
                <textarea name="description" placeholder="Write a short summary" class="min-h-[120px] w-full rounded-3xl border border-slate-300 p-4 focus:border-blue-500 focus:ring-blue-100"></textarea>
            </div>

            <div class="space-y-4">
                <label class="block text-sm font-medium text-slate-700">About This Property</label>
                <textarea name="about" placeholder="Share additional details" class="min-h-[140px] w-full rounded-3xl border border-slate-300 p-4 focus:border-blue-500 focus:ring-blue-100"></textarea>
            </div>

            <div class="space-y-4">
                <label class="block text-sm font-medium text-slate-700">Property Images</label>
                <input type="file" name="images[]" multiple class="w-full rounded-2xl border border-slate-300 p-3 focus:border-blue-500 focus:ring-blue-100">
                <p class="text-sm text-slate-500">Upload multiple images to show the property gallery.</p>
            </div>

            <div class="flex justify-end">
                <button type="submit" class="inline-flex items-center justify-center rounded-2xl bg-blue-600 px-6 py-3 text-sm font-semibold text-white shadow hover:bg-blue-700">
                    Save Property
                </button>
            </div>
        </form>
    </div>
</div>
@endsection