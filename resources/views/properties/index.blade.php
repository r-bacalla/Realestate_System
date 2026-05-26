<x-app-layout>

<div class="min-h-screen bg-slate-50">

    {{-- HERO HEADER --}}
    <div class="bg-gradient-to-r from-blue-700 to-indigo-700 text-white py-12">
        <div class="max-w-7xl mx-auto px-6">

            <div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
                <div>
                    <h1 class="text-4xl font-bold">
                        Find Your Perfect Property
                    </h1>

                    <p class="mt-2 text-blue-100 max-w-2xl">
                        Browse available homes, apartments, and rentals with updated filters and quick property previews.
                    </p>
                </div>

                @auth
                    @if(auth()->user()->isAdmin())
                        <a href="{{ route('admin.properties.create') }}" class="inline-flex items-center justify-center rounded-full bg-white px-6 py-3 text-sm font-semibold text-blue-700 shadow-lg hover:bg-slate-100">
                            + Add Property
                        </a>
                    @endif
                @endauth
            </div>

            <div class="mt-10 rounded-3xl border border-white/20 bg-white/10 p-6 shadow-lg backdrop-blur-lg">
                <form method="GET" action="{{ route('properties.index') }}" class="grid gap-4 md:grid-cols-[1.4fr_1fr_1fr_auto] items-end">
                    <div class="space-y-2">
                        <label class="text-sm font-medium text-slate-100">Search</label>
                        <input type="text" name="search" value="{{ request('search') }}" placeholder="Search property name or description" class="w-full rounded-2xl border border-white/20 bg-white/90 px-4 py-3 text-slate-900 shadow-sm focus:border-blue-400 focus:outline-none">
                    </div>
                    <div class="space-y-2">
                        <label class="text-sm font-medium text-slate-100">City</label>
                        <input type="text" name="city" value="{{ request('city') }}" placeholder="City" class="w-full rounded-2xl border border-white/20 bg-white/90 px-4 py-3 text-slate-900 shadow-sm focus:border-blue-400 focus:outline-none">
                    </div>
                    <div class="space-y-2">
                        <label class="text-sm font-medium text-slate-100">Type</label>
                        <input type="text" name="type" value="{{ request('type') }}" placeholder="House, apartment..." class="w-full rounded-2xl border border-white/20 bg-white/90 px-4 py-3 text-slate-900 shadow-sm focus:border-blue-400 focus:outline-none">
                    </div>
                    <div>
                        <button type="submit" class="inline-flex h-full w-full items-center justify-center rounded-2xl bg-white px-6 py-4 text-sm font-semibold text-blue-700 shadow hover:bg-slate-100">
                            Search
                        </button>
                    </div>
                </form>
            </div>

            <div class="mt-8 text-sm text-blue-100/90">
                Showing {{ $properties->count() }} of {{ $properties->total() }} properties
            </div>

        </div>
    </div>

    {{-- PROPERTY GRID --}}
    <div class="max-w-7xl mx-auto px-6 py-10">

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">

            @forelse($properties as $property)

                <a href="{{ route('properties.show', $property) }}" class="group overflow-hidden rounded-3xl border border-slate-200 bg-white shadow-sm transition hover:-translate-y-1 hover:shadow-xl">
                    <div class="relative h-64 overflow-hidden bg-slate-100">
                        @if($property->images->first())
                            <img src="{{ asset('storage/'.$property->images->first()->image_path) }}" class="h-full w-full object-cover transition duration-500 group-hover:scale-105" alt="{{ $property->name }}">
                        @else
                            <div class="flex h-full items-center justify-center text-slate-500">No image available</div>
                        @endif

                        <div class="absolute inset-x-0 bottom-0 bg-gradient-to-t from-slate-950/80 to-transparent px-4 py-3 text-white">
                            <p class="text-sm font-semibold">{{ ucfirst($property->status) }}</p>
                        </div>
                    </div>

                    <div class="p-6">
                        <div class="flex items-center justify-between gap-3">
                            <div>
                                <h3 class="text-xl font-semibold text-slate-900">{{ $property->name }}</h3>
                                <p class="mt-1 text-sm text-slate-500">📍 {{ $property->city }}, {{ $property->province }}</p>
                            </div>
                            <div class="rounded-2xl bg-slate-100 px-3 py-2 text-sm font-semibold text-slate-700">{{ $property->formatted_price }}</div>
                        </div>

                        <p class="mt-4 text-sm leading-6 text-slate-600 line-clamp-3">{{ $property->excerpt }}</p>

                        <div class="mt-6 grid gap-3 sm:grid-cols-3 text-sm text-slate-600">
                            <div class="rounded-2xl bg-slate-50 px-4 py-3 text-center">
                                <span class="block font-semibold">{{ $property->bedrooms }}</span>
                                Beds
                            </div>
                            <div class="rounded-2xl bg-slate-50 px-4 py-3 text-center">
                                <span class="block font-semibold">{{ $property->bathrooms }}</span>
                                Baths
                            </div>
                            <div class="rounded-2xl bg-slate-50 px-4 py-3 text-center">
                                <span class="block font-semibold">{{ $property->area_sqm }} sqm</span>
                                Area
                            </div>
                        </div>
                    </div>
                </a>

            @empty

                <div class="col-span-full text-center py-20 rounded-3xl border border-dashed border-slate-200 bg-white">
                    <h2 class="text-2xl font-semibold text-slate-900">No properties found</h2>
                    <p class="mt-3 text-slate-500">Use the filters above to broaden your search.</p>
                </div>

            @endforelse

        </div>

        {{-- PAGINATION --}}
        <div class="mt-10">
            {{ $properties->links() }}
        </div>

    </div>

</div>

</x-app-layout>