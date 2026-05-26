@extends('layouts.admin')

@section('content')
<div class="p-6">
    <div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between mb-8">
        <div>
            <h1 class="text-3xl font-bold text-slate-900">Edit Property</h1>
            <p class="mt-2 text-sm text-slate-500">Update property details and save changes.</p>
        </div>
        <a href="{{ route('admin.properties.index') }}" class="inline-flex items-center justify-center rounded-2xl border border-slate-200 bg-white px-5 py-3 text-sm font-semibold text-slate-700 shadow-sm hover:bg-slate-50">
            Back to Properties
        </a>
    </div>

    <div class="rounded-3xl bg-white p-6 shadow-sm border border-slate-200">
        <x-auth-validation-errors class="mb-6" :errors="$errors" />

        <form method="POST" action="{{ route('admin.properties.update', $property) }}" enctype="multipart/form-data" class="space-y-6">
            @csrf
            @method('PUT')

            <div class="grid gap-6 md:grid-cols-2">
                <div class="space-y-4">
                    <label class="block text-sm font-medium text-slate-700">Property Name</label>
                    <input type="text" name="name" value="{{ old('name', $property->name) }}" class="w-full rounded-2xl border border-slate-300 p-3 focus:border-blue-500 focus:ring-blue-100" required>
                </div>
                <div class="space-y-4">
                    <label class="block text-sm font-medium text-slate-700">Title (optional)</label>
                    <input type="text" name="title" value="{{ old('title', $property->title) }}" class="w-full rounded-2xl border border-slate-300 p-3 focus:border-blue-500 focus:ring-blue-100">
                </div>
            </div>

            <div class="grid gap-6 md:grid-cols-2">
                <div class="space-y-4">
                    <label class="block text-sm font-medium text-slate-700">Price</label>
                    <input type="number" name="price" value="{{ old('price', $property->price) }}" class="w-full rounded-2xl border border-slate-300 p-3 focus:border-blue-500 focus:ring-blue-100" required>
                </div>
                <div class="space-y-4">
                    <label class="block text-sm font-medium text-slate-700">Type</label>
                    <input type="text" name="type" value="{{ old('type', $property->type) }}" class="w-full rounded-2xl border border-slate-300 p-3 focus:border-blue-500 focus:ring-blue-100" required>
                </div>
            </div>

            <div class="grid gap-6 md:grid-cols-2">
                <div class="space-y-4">
                    <label class="block text-sm font-medium text-slate-700">Address</label>
                    <input type="text" name="address" value="{{ old('address', $property->address) }}" class="w-full rounded-2xl border border-slate-300 p-3 focus:border-blue-500 focus:ring-blue-100" required>
                </div>
                <div class="space-y-4">
                    <label class="block text-sm font-medium text-slate-700">City</label>
                    <input type="text" name="city" value="{{ old('city', $property->city) }}" class="w-full rounded-2xl border border-slate-300 p-3 focus:border-blue-500 focus:ring-blue-100" required>
                </div>
            </div>

            <div class="grid gap-6 md:grid-cols-2">
                <div class="space-y-4">
                    <label class="block text-sm font-medium text-slate-700">Province</label>
                    <input type="text" name="province" value="{{ old('province', $property->province) }}" class="w-full rounded-2xl border border-slate-300 p-3 focus:border-blue-500 focus:ring-blue-100" required>
                </div>
                <div class="space-y-4">
                    <label class="block text-sm font-medium text-slate-700">Area (sqm)</label>
                    <input type="number" name="area_sqm" value="{{ old('area_sqm', $property->area_sqm) }}" class="w-full rounded-2xl border border-slate-300 p-3 focus:border-blue-500 focus:ring-blue-100" required>
                </div>
            </div>

            <div class="grid gap-6 md:grid-cols-3">
                <div class="space-y-4">
                    <label class="block text-sm font-medium text-slate-700">Bedrooms</label>
                    <input type="number" name="bedrooms" value="{{ old('bedrooms', $property->bedrooms) }}" class="w-full rounded-2xl border border-slate-300 p-3 focus:border-blue-500 focus:ring-blue-100" required>
                </div>
                <div class="space-y-4">
                    <label class="block text-sm font-medium text-slate-700">Bathrooms</label>
                    <input type="number" name="bathrooms" value="{{ old('bathrooms', $property->bathrooms) }}" class="w-full rounded-2xl border border-slate-300 p-3 focus:border-blue-500 focus:ring-blue-100" required>
                </div>
                <div class="space-y-4">
                    <label class="block text-sm font-medium text-slate-700">Year Built</label>
                    <input type="number" name="year_built" value="{{ old('year_built', $property->year_built) }}" class="w-full rounded-2xl border border-slate-300 p-3 focus:border-blue-500 focus:ring-blue-100">
                </div>
            </div>

            <div class="space-y-4">
                <label class="block text-sm font-medium text-slate-700">Status</label>
                <select name="status" class="w-full rounded-2xl border border-slate-300 p-3 focus:border-blue-500 focus:ring-blue-100" required>
                    <option value="available" @selected(old('status', $property->status) == 'available')>Available</option>
                    <option value="rented" @selected(old('status', $property->status) == 'rented')>Rented</option>
                    <option value="sold" @selected(old('status', $property->status) == 'sold')>Sold</option>
                    <option value="maintenance" @selected(old('status', $property->status) == 'maintenance')>Maintenance</option>
                </select>
            </div>

            <div class="space-y-4">
                <label class="block text-sm font-medium text-slate-700">Short Description</label>
                <textarea name="description" class="min-h-[120px] w-full rounded-3xl border border-slate-300 p-4 focus:border-blue-500 focus:ring-blue-100">{{ old('description', $property->description) }}</textarea>
            </div>

            <div class="space-y-4">
                <label class="block text-sm font-medium text-slate-700">About This Property</label>
                <textarea name="about" class="min-h-[140px] w-full rounded-3xl border border-slate-300 p-4 focus:border-blue-500 focus:ring-blue-100">{{ old('about', $property->about) }}</textarea>
            </div>

            <div class="space-y-4">
                <label class="block text-sm font-medium text-slate-700">Add Images</label>
                <input type="file" name="images[]" multiple class="w-full rounded-2xl border border-slate-300 p-3 focus:border-blue-500 focus:ring-blue-100">
                <p class="text-sm text-slate-500">Upload images to show the property in the listing.</p>
            </div>

            @if($property->images->count())
                <div class="space-y-4">
                    <h3 class="text-sm font-semibold text-slate-900">Current Images</h3>
                    <div class="grid grid-cols-3 gap-3">
                        @foreach($property->images as $img)
                            <div class="relative overflow-hidden rounded-3xl">
                                <img src="{{ asset('storage/'.$img->image_path) }}" class="h-28 w-full object-cover" alt="Property image">
                                <form method="POST" action="{{ route('admin.properties.image.delete', $img) }}" class="absolute top-2 right-2">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" onclick="return confirm('Delete this image?')" class="rounded-full bg-white/90 px-2 py-1 text-xs text-red-600 shadow-sm">✕</button>
                                </form>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif

            <div class="flex justify-end">
                <button type="submit" class="inline-flex items-center justify-center rounded-2xl bg-blue-600 px-6 py-3 text-sm font-semibold text-white shadow hover:bg-blue-700">
                    Update Property
                </button>
            </div>
        </form>
    </div>
</div>
@endsection