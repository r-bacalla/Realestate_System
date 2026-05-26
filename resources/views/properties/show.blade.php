<x-app-layout>

<div class="max-w-6xl mx-auto p-4 md:p-6 space-y-6">

    <div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
        <div>
            <h1 class="text-3xl font-bold text-slate-900">{{ $property->name }}</h1>
            <p class="text-slate-600 mt-1">📍 {{ $property->address }}, {{ $property->city }}, {{ $property->province }}</p>
        </div>
        <div class="flex flex-wrap gap-3">
            <a href="{{ route('properties.index') }}" class="inline-flex items-center justify-center rounded-2xl border border-slate-200 bg-white px-5 py-3 text-sm font-semibold text-slate-700 hover:bg-slate-50">
                Back to Listings
            </a>
            @auth
                @if(auth()->user()->isAdmin())
                    <a href="{{ route('admin.properties.edit', $property) }}" class="inline-flex items-center justify-center rounded-2xl bg-blue-600 px-5 py-3 text-sm font-semibold text-white hover:bg-blue-700">
                        Edit Property
                    </a>
                @endif
            @endauth
        </div>
    </div>

    @php
        $images = $property->images;
        $firstImage = $images->first();
    @endphp

    <div class="grid grid-cols-1 gap-6 lg:grid-cols-[2fr_1fr]">
        <div class="space-y-6 rounded-3xl bg-white p-6 shadow-sm border border-slate-200">
            <div class="rounded-3xl overflow-hidden bg-slate-100">
                @if($firstImage)
                    <img id="mainImage" src="{{ asset('storage/'.$firstImage->image_path) }}" class="w-full object-cover" style="aspect-ratio:16/9;">
                @else
                    <div class="flex h-full min-h-[320px] items-center justify-center text-slate-500">No image available</div>
                @endif
            </div>

            @if($images->count() > 1)
                <div class="grid grid-cols-3 gap-3">
                    @foreach($images as $image)
                        <button type="button" onclick="changeImage('{{ asset('storage/'.$image->image_path) }}')" class="overflow-hidden rounded-3xl border border-slate-200">
                            <img src="{{ asset('storage/'.$image->image_path) }}" class="h-28 w-full object-cover" alt="{{ $property->name }}">
                        </button>
                    @endforeach
                </div>
            @endif

            <div class="rounded-3xl bg-slate-50 p-6">
                <h2 class="text-xl font-bold text-slate-900">About this property</h2>
                <p class="mt-3 text-slate-600 leading-relaxed">{{ $property->description }}</p>
            </div>
        </div>

        <aside class="space-y-6">
            <div class="rounded-3xl bg-white border border-slate-200 p-6 shadow-sm">
                <div class="flex items-start justify-between gap-4">
                    <div>
                        <p class="text-sm text-slate-500">Price</p>
                        <p class="mt-2 text-3xl font-bold text-slate-900">{{ $property->formatted_price }}</p>
                    </div>
                    <span class="rounded-full px-3 py-1 text-xs font-semibold uppercase tracking-wide {{ $property->status == 'sold' ? 'bg-red-100 text-red-700' : ($property->status == 'rented' ? 'bg-yellow-100 text-yellow-700' : 'bg-green-100 text-green-700') }}">
                        {{ ucfirst($property->status) }}
                    </span>
                </div>

                <div class="mt-6 grid gap-4">
                    <div class="rounded-3xl bg-slate-50 p-4">
                        <p class="text-sm text-slate-500">Type</p>
                        <p class="mt-2 text-lg font-semibold text-slate-900">{{ ucfirst($property->type) }}</p>
                    </div>
                    <div class="rounded-3xl bg-slate-50 p-4">
                        <p class="text-sm text-slate-500">Area</p>
                        <p class="mt-2 text-lg font-semibold text-slate-900">{{ $property->area_sqm }} sqm</p>
                    </div>
                    <div class="rounded-3xl bg-slate-50 p-4">
                        <p class="text-sm text-slate-500">Bedrooms</p>
                        <p class="mt-2 text-lg font-semibold text-slate-900">{{ $property->bedrooms }}</p>
                    </div>
                    <div class="rounded-3xl bg-slate-50 p-4">
                        <p class="text-sm text-slate-500">Bathrooms</p>
                        <p class="mt-2 text-lg font-semibold text-slate-900">{{ $property->bathrooms }}</p>
                    </div>
                    <div class="rounded-3xl bg-slate-50 p-4">
                        <p class="text-sm text-slate-500">Year Built</p>
                        <p class="mt-2 text-lg font-semibold text-slate-900">{{ $property->year_built ?? 'N/A' }}</p>
                    </div>
                </div>
            </div>

            <div class="rounded-3xl bg-blue-600 p-6 text-white shadow-sm">
                <h2 class="text-xl font-bold">Ready to move forward?</h2>
                <p class="mt-3 text-sm leading-6 text-blue-100">If you want to manage this property, start a lease or contact the team for more details.</p>
                <a href="{{ route('leases.create') }}" class="mt-6 inline-flex w-full items-center justify-center rounded-2xl bg-white px-5 py-3 text-sm font-semibold text-blue-700 shadow hover:bg-slate-100">
                    Create Lease
                </a>
            </div>
        </aside>
    </div>

</div>

{{-- IMAGE SWITCH SCRIPT --}}
<script>
    function changeImage(el) {
        document.getElementById('mainImage').src = el.src;
    }
</script>

</x-app-layout>