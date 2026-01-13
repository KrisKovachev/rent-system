@extends('layouts.app')

@section('content')
@php
    $isOccupied = $apartment->rentalAgreements()
        ->where('status', 'active')
        ->exists();
@endphp

<div class="max-w-7xl mx-auto px-6 py-12">

    {{-- HERO HEADER --}}
    <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-6 mb-10">
        <div>
            <h1 class="text-4xl font-extrabold tracking-tight">
                {{ $apartment->type ?? 'Apartment' }}
            </h1>
            <p class="text-stone-400 mt-2 text-lg">
                {{ $apartment->address }}
            </p>
        </div>

        <span class="inline-flex items-center gap-2 px-6 py-2 rounded-full text-sm font-semibold shadow
            {{ $isOccupied
                ? 'bg-rose-500/20 text-rose-300'
                : 'bg-emerald-500/20 text-emerald-300' }}">
            <span class="h-2 w-2 rounded-full
                {{ $isOccupied ? 'bg-rose-500' : 'bg-emerald-500' }}"></span>
            {{ $isOccupied ? 'Occupied' : 'Available' }}
        </span>
    </div>

    {{-- IMAGE SLIDER --}}
    <div class="relative mb-14">
        @if($apartment->images->count())
            <div class="relative h-[480px] overflow-hidden rounded-[32px] shadow-2xl">
                @foreach($apartment->images as $i => $image)
                    <img
                        src="{{ asset('storage/'.$image->path) }}"
                        class="slider-image absolute inset-0 w-full h-full object-cover transition-all duration-700
                        {{ $i === 0 ? 'opacity-100 scale-100' : 'opacity-0 scale-105' }}"
                        data-index="{{ $i }}"
                    >
                @endforeach

                {{-- Overlay --}}
                <div class="absolute inset-0 bg-gradient-to-t from-black/40 to-transparent"></div>

                {{-- Controls --}}
                @if($apartment->images->count() > 1)
                    <button onclick="prevSlide()"
                        class="absolute left-6 top-1/2 -translate-y-1/2 bg-white/10 hover:bg-white/20
                        px-4 py-2 rounded-full text-xl text-stone-200 shadow transition">
                        ‹
                    </button>

                    <button onclick="nextSlide()"
                        class="absolute right-6 top-1/2 -translate-y-1/2 bg-white/10 hover:bg-white/20
                        px-4 py-2 rounded-full text-xl text-stone-200 shadow transition">
                        ›
                    </button>
                @endif
            </div>

            {{-- DOTS --}}
            <div class="flex justify-center gap-2 mt-4">
                @foreach($apartment->images as $i => $img)
                    <button onclick="goToSlide({{ $i }})"
                        class="dot h-3 w-3 rounded-full
                        {{ $i === 0 ? 'bg-emerald-400' : 'bg-white/20' }}">
                    </button>
                @endforeach
            </div>
        @endif
    </div>

    {{-- STATS --}}
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-14">
        <div class="glass-card p-6">
            <p class="text-sm text-stone-400">Area</p>
            <p class="text-2xl font-semibold mt-1">{{ $apartment->area }} m²</p>
        </div>

        <div class="glass-card p-6">
            <p class="text-sm text-stone-400">Price</p>
            <p class="text-2xl font-semibold mt-1">€{{ number_format($apartment->price, 2) }}</p>
        </div>

        <div class="glass-card p-6">
            <p class="text-sm text-stone-400">Status</p>
            <p class="text-2xl font-semibold mt-1">
                {{ $isOccupied ? 'Not available' : 'Ready to rent' }}
            </p>
        </div>
    </div>

    {{-- RENT REQUEST CTA --}}
    @auth
        @if(!$isOccupied)
            <div class="glass-card-lg rounded-[32px] p-10">
                <h3 class="text-3xl font-bold mb-3">
                    Interested in this apartment?
                </h3>
                <p class="text-stone-300 mb-8 text-lg">
                    Send a rental request directly to the owner.
                </p>

                <form method="POST" action="{{ route('rental-requests.store', $apartment) }}"
                    class="flex flex-wrap gap-4 items-end">
                    @csrf

                    <div>
                        <label class="text-sm text-stone-300">Start date</label>
                        <input type="date" name="start_date" required
                            class="block mt-1 glass-input">
                    </div>

                    <div>
                        <label class="text-sm text-stone-300">End date</label>
                        <input type="date" name="end_date"
                            class="block mt-1 glass-input">
                    </div>

                    <button
                        class="h-[44px] px-8 rounded-xl bg-emerald-600 text-white font-semibold
                        hover:bg-emerald-500 transition">
                        Request rental
                    </button>
                </form>
            </div>
        @endif
    @endauth
</div>


{{-- SLIDER SCRIPT --}}
<script>
    let current = 0;
    const images = document.querySelectorAll('.slider-image');
    const dots = document.querySelectorAll('.dot');

    function showSlide(i) {
        images.forEach((img, idx) => {
            img.classList.toggle('opacity-100', idx === i);
            img.classList.toggle('opacity-0', idx !== i);
            img.classList.toggle('scale-100', idx === i);
            img.classList.toggle('scale-105', idx !== i);
        });

        dots.forEach((d, idx) => {
            d.classList.toggle('bg-emerald-400', idx === i);
            d.classList.toggle('bg-white/20', idx !== i);
        });

        current = i;
    }

    function nextSlide() {
        showSlide((current + 1) % images.length);
    }

    function prevSlide() {
        showSlide((current - 1 + images.length) % images.length);
    }

    function goToSlide(i) {
        showSlide(i);
    }
</script>
@endsection




