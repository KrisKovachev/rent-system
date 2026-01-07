@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto px-6 py-10 space-y-12">

    {{-- Header --}}
    <div>
        <h1 class="text-4xl font-extrabold tracking-tight text-gray-900">
            Search for properties
        </h1>
        <p class="mt-2 text-gray-500">
            Discover apartments and houses available for rent
        </p>
    </div>

    {{-- Filters --}}
    <form method="GET"
          class="bg-white p-6 rounded-3xl border shadow-sm grid grid-cols-1 md:grid-cols-6 gap-4">

        <input class="border rounded-xl p-3"
               name="type"
               placeholder="Type (apartment, house)"
               value="{{ $filters['type'] ?? '' }}">

        <input class="border rounded-xl p-3"
               name="min_price"
               type="number"
               step="0.01"
               placeholder="Min. price"
               value="{{ $filters['min_price'] ?? '' }}">

        <input class="border rounded-xl p-3"
               name="max_price"
               type="number"
               step="0.01"
               placeholder="Max. price"
               value="{{ $filters['max_price'] ?? '' }}">

        <select class="border rounded-xl p-3" name="tenant_id">
            <option value="">Tenant (optional)</option>
            @foreach($tenants as $t)
                <option value="{{ $t->id }}" @selected(($filters['tenant_id'] ?? null) == $t->id)>
                    {{ $t->name }}
                </option>
            @endforeach
        </select>

        <input class="border rounded-xl p-3" type="date" name="from" value="{{ $filters['from'] ?? '' }}">
        <input class="border rounded-xl p-3" type="date" name="to" value="{{ $filters['to'] ?? '' }}">

        <div class="md:col-span-6 flex gap-3 pt-2">
            <button
                class="px-8 py-3 bg-black text-white rounded-xl font-medium
                       hover:bg-gray-800 transition">
                Search
            </button>
            <a href="{{ route('apartments.index') }}"
               class="px-8 py-3 bg-gray-200 rounded-xl hover:bg-gray-300 transition">
                Reset
            </a>
        </div>
    </form>

    {{-- Properties Grid --}}
    <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-8">

        @forelse($apartments as $a)
            <div
                class="group bg-white rounded-3xl overflow-hidden border shadow-sm
                       hover:shadow-2xl transition-all duration-300">

                {{-- Image --}}
                <div class="relative h-56 overflow-hidden">
                    @if($a->images->first())
                        <img
                            src="{{ asset('storage/'.$a->images->first()->path) }}"
                            class="w-full h-full object-cover
                                   group-hover:scale-105 transition duration-500">
                    @else
                        <div class="w-full h-full bg-gray-200 flex items-center justify-center text-gray-500">
                            No image
                        </div>
                    @endif

                    {{-- Status badge --}}
                    <span
                        class="absolute top-4 left-4 px-3 py-1 text-xs font-semibold rounded-full
                        {{ $a->isOccupied()
                            ? 'bg-red-100 text-red-700'
                            : 'bg-green-100 text-green-700' }}">
                        {{ $a->isOccupied() ? 'Occupied' : 'Available' }}
                    </span>

                    {{-- Price badge --}}
                    <div
                        class="absolute bottom-4 right-4 bg-black/80 backdrop-blur
                               text-white px-4 py-2 rounded-xl text-sm font-semibold">
                        €{{ number_format($a->price, 2) }} / mo
                    </div>
                </div>

                {{-- Content --}}
                <div class="p-6 space-y-3">
                    <div class="flex items-center justify-between">
                        <h3 class="text-lg font-bold capitalize">
                            {{ $a->type }}
                        </h3>
                        <span class="text-sm text-gray-500">
                            {{ $a->area }} m²
                        </span>
                    </div>

                    <p class="text-sm text-gray-600">
                        {{ $a->address }}
                    </p>

                    <a href="{{ route('apartments.show', $a) }}"
                       class="inline-flex items-center text-sm font-medium text-black
                              group-hover:underline">
                        View details →
                    </a>
                </div>
            </div>
        @empty
            <div class="lg:col-span-3 text-center text-gray-500 py-20">
                No properties found.
            </div>
        @endforelse

    </div>

</div>
@endsection
