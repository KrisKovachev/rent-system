@extends('layouts.app')

@section('content')
@php
    $isOccupied = $apartment->rentals()
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
            <p class="text-gray-500 mt-2 text-lg">
                {{ $apartment->address }}
            </p>
        </div>

        <span class="inline-flex items-center gap-2 px-6 py-2 rounded-full text-sm font-semibold shadow
            {{ $isOccupied
                ? 'bg-red-100 text-red-700'
                : 'bg-emerald-100 text-emerald-700' }}">
            <span class="h-2 w-2 rounded-full
                {{ $isOccupied ? 'bg-red-500' : 'bg-emerald-500' }}"></span>
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
                        class="absolute left-6 top-1/2 -translate-y-1/2 bg-white/90 hover:bg-white
                        px-4 py-2 rounded-full text-xl shadow transition">
                        ‹
                    </button>

                    <button onclick="nextSlide()"
                        class="absolute right-6 top-1/2 -translate-y-1/2 bg-white/90 hover:bg-white
                        px-4 py-2 rounded-full text-xl shadow transition">
                        ›
                    </button>
                @endif
            </div>

            {{-- DOTS --}}
            <div class="flex justify-center gap-2 mt-4">
                @foreach($apartment->images as $i => $img)
                    <button onclick="goToSlide({ $i })"
                        class="dot h-3 w-3 rounded-full
                        {{ $i === 0 ? 'bg-indigo-600' : 'bg-gray-300' }}">
                    </button>
                @endforeach
            </div>
        @endif
    </div>

    {{-- STATS --}}
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-14">
        <div class="glass-card">
            <p class="label">Area</p>
            <p class="value">{{ $apartment->area }} m²</p>
        </div>

        <div class="glass-card">
            <p class="label">Price</p>
            <p class="value">€{{ number_format($apartment->price, 2) }}</p>
        </div>

        <div class="glass-card">
            <p class="label">Status</p>
            <p class="value">
                {{ $isOccupied ? 'Not available' : 'Ready to rent' }}
            </p>
        </div>
    </div>

    {{-- RENT REQUEST CTA --}}
    @auth
        @if(!$isOccupied)
            <div class="bg-gradient-to-br from-slate-900 to-slate-800
                text-white rounded-[32px] p-10 shadow-2xl">
                <h3 class="text-3xl font-bold mb-3">
                    Interested in this apartment?
                </h3>
                <p class="text-gray-300 mb-8 text-lg">
                    Send a rental request directly to the owner.
                </p>

                <form method="POST" action="{{ route('rental-requests.store', $apartment) }}"
                    class="flex flex-wrap gap-4 items-end">
                    @csrf

                    <div>
                        <label class="text-sm text-gray-300">Start date</label>
                        <input type="date" name="start_date" required
                            class="block mt-1 rounded-xl px-4 py-2 text-black">
                    </div>

                    <div>
                        <label class="text-sm text-gray-300">End date</label>
                        <input type="date" name="end_date"
                            class="block mt-1 rounded-xl px-4 py-2 text-black">
                    </div>

                    <button
                        class="h-[44px] px-8 rounded-xl bg-white text-black font-semibold
                        hover:bg-gray-200 transition">
                        Request rental
                    </button>
                </form>
            </div>
        @endif
    @endauth
</div>

{{-- STYLES --}}
<style>
    .glass-card {
        background: rgba(255,255,255,0.85);
        backdrop-filter: blur(10px);
        border-radius: 24px;
        padding: 28px;
        box-shadow: 0 10px 30px rgba(0,0,0,0.08);
    }
    .label {
        font-size: 0.875rem;
        color: #6b7280;
    }
    .value {
        font-size: 1.5rem;
        font-weight: 600;
        margin-top: 4px;
    }
</style>

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
            d.classList.toggle('bg-indigo-600', idx === i);
            d.classList.toggle('bg-gray-300', idx !== i);
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
