@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto px-6 py-10 space-y-12">

    {{-- Header --}}
    <div class="flex items-center justify-between">
        <div>
            <h1 class="text-4xl font-extrabold tracking-tight text-stone-100">
                My Properties
            </h1>
            <p class="mt-2 text-stone-400">
                Manage your apartments, photos and availability
            </p>
        </div>

        <a href="{{ route('apartments.create') }}"
           class="inline-flex items-center gap-2 px-6 py-3
                  rounded-2xl bg-emerald-600 text-white font-medium
                  hover:bg-emerald-500 transition hover:scale-[1.03] active:scale-[0.97]">
            <span class="text-lg">＋</span>
            Add Property
        </a>
    </div>

    {{-- Grid --}}
    <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-8">

        @forelse($apartments as $a)
            <div
                class="group glass-card rounded-3xl overflow-hidden
                       shadow-sm hover:shadow-2xl transition-all duration-300">

                {{-- IMAGE --}}
                <div class="relative h-56 overflow-hidden">

                    @if($a->images->first())
                        <img
                            src="{{ asset('storage/'.$a->images->first()->path) }}"
                            class="w-full h-full object-cover
                                   group-hover:scale-105 transition duration-500">
                    @else
                        <div
                            class="w-full h-full bg-white/5 flex items-center
                                   justify-center text-stone-400">
                            No image
                        </div>
                    @endif

                    {{-- Status --}}
                    <span
                        class="absolute top-4 left-4 px-3 py-1 text-xs font-semibold rounded-full
                        {{ $a->isOccupied()
                            ? 'bg-rose-500/20 text-rose-300'
                            : 'bg-emerald-500/20 text-emerald-300' }}">
                        {{ $a->isOccupied() ? 'Occupied' : 'Available' }}
                    </span>

                    {{-- Hover actions --}}
                    <div
                        class="absolute inset-0 bg-black/40 backdrop-blur-sm
                               opacity-0 group-hover:opacity-100
                               transition flex items-center justify-center gap-4">

                        <a href="{{ route('apartments.show', $a) }}"
                           class="px-5 py-2 bg-white/10 text-stone-200 rounded-xl text-sm font-medium
                                  hover:scale-105 transition">
                            View
                        </a>

                        <a href="{{ route('apartments.edit', $a) }}"
                           class="px-5 py-2 bg-emerald-600 text-white rounded-xl text-sm font-medium
                                  hover:scale-105 transition">
                            Edit
                        </a>
                    </div>
                </div>

                {{-- CONTENT --}}
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

                    <div class="flex items-center justify-between pt-2">
                        <span class="text-lg font-semibold">
                            €{{ number_format($a->price, 2) }}
                        </span>

                        <span class="text-xs text-stone-500">
                            / month
                        </span>
                    </div>
                </div>
            </div>
        @empty
            <div class="lg:col-span-3 text-center py-24 text-stone-400">
                You don’t have any properties yet.
            </div>
        @endforelse

    </div>

</div>
@endsection

