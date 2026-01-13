@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto px-6 py-10 space-y-12">

    {{-- Header --}}
    <div>
        <h1 class="text-4xl font-extrabold tracking-tight text-stone-100">
            Search for properties
        </h1>
        <p class="mt-2 text-stone-400">
            Discover apartments and houses available for rent
        </p>
    </div>

    {{-- Filters --}}
    <form method="GET"
          class="glass-card p-6 grid grid-cols-1 md:grid-cols-6 gap-4">

        <input class="glass-input"
               name="type"
               placeholder="Type (apartment, house)"
               value="{{ $filters['type'] ?? '' }}">

        <input class="glass-input"
               name="min_price"
               type="number"
               step="0.01"
               placeholder="Min. price"
               value="{{ $filters['min_price'] ?? '' }}">

        <input class="glass-input"
               name="max_price"
               type="number"
               step="0.01"
               placeholder="Max. price"
               value="{{ $filters['max_price'] ?? '' }}">

        <select class="glass-input" name="tenant_id">
            <option value="">Tenant (optional)</option>
            @foreach($tenants as $t)
                <option value="{{ $t->id }}" @selected(($filters['tenant_id'] ?? null) == $t->id)>
                    {{ $t->name }}
                </option>
            @endforeach
        </select>

        <input class="glass-input" type="date" name="from" value="{{ $filters['from'] ?? '' }}">
        <input class="glass-input" type="date" name="to" value="{{ $filters['to'] ?? '' }}">

        <div class="md:col-span-6 flex gap-3 pt-2">
            <button
                class="px-8 py-3 bg-emerald-600 text-white rounded-xl font-medium
                       hover:bg-emerald-500 transition">
                Search
            </button>
            <a href="{{ route('apartments.index') }}"
               class="px-8 py-3 bg-white/10 text-stone-200 rounded-xl hover:bg-white/20 transition">
                Reset
            </a>
        </div>
    </form>

    {{-- Properties Grid --}}
    <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-8">

        @forelse($apartments as $a)
            <div
                class="group glass-card rounded-3xl overflow-hidden
                       hover:bg-white/10 transition-all duration-300">

                {{-- Image --}}
                <div class="relative h-56 overflow-hidden">
                    @if($a->images->first())
                        <img
                            src="{{ asset('storage/'.$a->images->first()->path) }}"
                            class="w-full h-full object-cover
                                   group-hover:scale-105 transition duration-500">
                    @else
                        <div class="w-full h-full bg-white/5 flex items-center justify-center text-stone-400">
                            No image
                        </div>
                    @endif

                    {{-- Status badge --}}
                    <span
                        class="absolute top-4 left-4 px-3 py-1 text-xs font-semibold rounded-full
                        {{ $a->isOccupied()
                            ? 'bg-rose-500/20 text-rose-300'
                            : 'bg-emerald-500/20 text-emerald-300' }}">
                        {{ $a->isOccupied() ? 'Occupied' : 'Available' }}
                    </span>

                    {{-- Price badge --}}
                    <div
                        class="absolute bottom-4 right-4 bg-black/60 backdrop-blur
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
                        <span class="text-sm text-stone-400">
                            {{ $a->area }} m²
                        </span>
                    </div>

                    <p class="text-sm text-stone-300">
                        {{ $a->address }}
                    </p>

                    <a href="{{ route('apartments.show', $a) }}"
                       class="inline-flex items-center text-sm font-medium text-emerald-300
                              group-hover:underline">
                        View details →
                    </a>
                </div>
            </div>
        @empty
            <div class="lg:col-span-3 text-center text-stone-400 py-20">
                No properties found.
            </div>
        @endforelse

    </div>

</div>
@endsection
