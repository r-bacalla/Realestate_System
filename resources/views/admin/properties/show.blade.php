@extends('layouts.admin')

@section('content')
<div class="p-6">
    <div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between mb-8">
        <div>
            <h1 class="text-3xl font-bold text-slate-900">{{ $property->name }}</h1>
            <p class="mt-2 text-sm text-slate-500">{{ $property->address }}, {{ $property->city }}, {{ $property->province }}</p>
        </div>
        <div class="flex flex-wrap gap-3">
            <a href="{{ route('admin.properties.index') }}" class="inline-flex items-center justify-center rounded-2xl border border-slate-200 bg-white px-5 py-3 text-sm font-semibold text-slate-700 shadow-sm hover:bg-slate-50">
                Back to Properties
            </a>
            <a href="{{ route('admin.properties.edit', $property) }}" class="inline-flex items-center justify-center rounded-2xl bg-blue-600 px-5 py-3 text-sm font-semibold text-white hover:bg-blue-700">
                Edit Property
            </a>
        </div>
    </div>

    <div class="grid gap-6 lg:grid-cols-12">
        <div class="lg:col-span-8 rounded-3xl bg-white p-6 shadow-sm border border-slate-200">
            @php $mainImage = $property->images->first(); @endphp
            <img id="mainImage" src="{{ $mainImage ? asset('storage/'.$mainImage->image_path) : 'https://via.placeholder.com/1200x700' }}" class="w-full rounded-3xl object-cover aspect-[16/9]">

            @if($property->images->count())
                <div class="mt-4 grid grid-cols-4 gap-3">
                    @foreach($property->images as $image)
                        <button type="button" onclick="changeImage('{{ asset('storage/'.$image->image_path) }}')" class="overflow-hidden rounded-3xl border border-slate-200">
                            <img src="{{ asset('storage/'.$image->image_path) }}" class="h-24 w-full object-cover" alt="Property image">
                        </button>
                    @endforeach
                </div>
            @endif

            <div class="mt-6 space-y-4">
                <div class="rounded-3xl bg-slate-50 p-6">
                    <h2 class="text-xl font-bold text-slate-900">About this property</h2>
                    <p class="mt-3 text-slate-600">{{ $property->about ?? $property->description }}</p>
                </div>

                <div class="grid gap-4 md:grid-cols-2">
                    <div class="rounded-3xl bg-white border border-slate-200 p-6">
                        <p class="text-sm text-slate-500">Property Type</p>
                        <p class="mt-2 text-lg font-semibold text-slate-900">{{ ucfirst($property->type) }}</p>
                    </div>
                    <div class="rounded-3xl bg-white border border-slate-200 p-6">
                        <p class="text-sm text-slate-500">Year Built</p>
                        <p class="mt-2 text-lg font-semibold text-slate-900">{{ $property->year_built ?? 'N/A' }}</p>
                    </div>
                </div>
            </div>
        </div>

        <aside class="lg:col-span-4 space-y-6">
            <div class="rounded-3xl bg-white border border-slate-200 p-6 shadow-sm">
                <div class="flex items-center justify-between gap-3">
                    <div>
                        <p class="text-sm text-slate-500">Price</p>
                        <p class="mt-2 text-3xl font-bold text-slate-900">₱{{ number_format($property->price, 2) }}</p>
                    </div>
                    <span class="rounded-full px-3 py-1 text-xs font-semibold uppercase tracking-wide {{ $property->status == 'sold' ? 'bg-red-100 text-red-700' : ($property->status == 'rented' ? 'bg-yellow-100 text-yellow-700' : 'bg-green-100 text-green-700') }}">
                        {{ ucfirst($property->status) }}
                    </span>
                </div>

                <div class="mt-6 grid gap-4">
                    <div class="rounded-3xl bg-slate-50 p-4">
                        <p class="text-sm text-slate-500">Bedrooms</p>
                        <p class="mt-2 text-lg font-semibold text-slate-900">{{ $property->bedrooms }}</p>
                    </div>
                    <div class="rounded-3xl bg-slate-50 p-4">
                        <p class="text-sm text-slate-500">Bathrooms</p>
                        <p class="mt-2 text-lg font-semibold text-slate-900">{{ $property->bathrooms }}</p>
                    </div>
                    <div class="rounded-3xl bg-slate-50 p-4">
                        <p class="text-sm text-slate-500">Area</p>
                        <p class="mt-2 text-lg font-semibold text-slate-900">{{ $property->area_sqm }} sqm</p>
                    </div>
                </div>
            </div>
        </aside>
    </div>
</div>

<script>
    function changeImage(src) {
        document.getElementById('mainImage').src = src;
    }
</script>
@endsection