@extends('layouts.app')

@section('content')
<!-- HERO -->
<section class="relative overflow-hidden rounded-3xl glass-card-lg text-stone-100 p-14 mb-20">
    <div class="max-w-5xl">
        <h1 class="text-5xl font-extrabold leading-tight mb-6">
            Manage <br>
            <span class="text-stone-300">in a smart way</span>
        </h1>

        <p class="text-lg text-stone-300 mb-10 max-w-2xl">
            RentSystem is a modern property management system for landlords and property managers.
        </p>

        <div class="flex flex-wrap gap-4">
            <a href="{{ route('public.apartments.index') }}"
               class="px-8 py-4 bg-emerald-600 text-white rounded-xl font-semibold hover:bg-emerald-500 transition">
                 Look for property
            </a>

            @auth
                @if(auth()->user()->isAdmin())
                    <a href="{{ route('admin.dashboard') }}"
                       class="px-8 py-4 bg-white/10 text-stone-200 rounded-xl hover:bg-white/20 transition">
                        Admin panel
                    </a>
                @endif
            @endauth
        </div>
    </div>

    <div class="absolute right-10 top-10 text-9xl opacity-10 select-none">
        
    </div>
</section>

<!-- STATS -->
<section class="grid grid-cols-1 md:grid-cols-3 gap-8 mb-20">
    <div class="glass-card p-8">
        <div class="text-4xl font-bold mb-2"></div>
        <div class="text-xl font-semibold mb-1">Properties</div>
        <p class="text-stone-400">
            Sort by type, price, tenant and availability.
        </p>
    </div>

    <div class="glass-card p-8">
        <div class="text-4xl font-bold mb-2"></div>
        <div class="text-xl font-semibold mb-1">Tenants</div>
        <p class="text-stone-400">
            Full tenants and leases history.
        </p>
    </div>

    <div class="glass-card p-8">
        <div class="text-4xl font-bold mb-2"></div>
        <div class="text-xl font-semibold mb-1">Договори</div>
        <p class="text-stone-400">
            Control rental agreements.
        </p>
    </div>
</section>

<!-- FEATURES -->
<section class="grid md:grid-cols-2 gap-12 items-center mb-24">
    <div>
        <h2 class="text-3xl font-bold mb-6">
            What does the system do?
        </h2>

        <ul class="space-y-4 text-lg text-stone-300">
            <li>Search by property type</li>
            <li>Filter by price</li>
            <li>Search by tenant</li>
            <li>Check rental period</li>
            <li>Status „Free / Occupied“</li>
            <li>Protected admin panel</li>
        </ul>
    </div>

    <div class="glass-card p-10">
        <p class="text-xl font-semibold mb-4">
             Perfect for:
        </p>

        <ul class="space-y-3 text-stone-300">
            <li>Publish your own properties</li>
            <li>Find your new home</li>
            <li>Find your new business property</li>
            <li>Find the best deals</li>
        </ul>
    </div>
</section>

<!-- CTA -->
<section class="text-center glass-card-lg text-stone-100 rounded-3xl p-16">
    <h2 class="text-4xl font-bold mb-4">
        Start managing your properties today!
    </h2>

    <p class="text-stone-300 mb-8">
        Register now and take control of your rental properties with ease.
    </p>

    <div class="flex justify-center gap-4">
        <a href="{{ route('login') }}"
           class="px-8 py-4 bg-emerald-600 text-white rounded-xl font-semibold">
            Login
        </a>

        <a href="{{ route('register') }}"
           class="px-8 py-4 bg-white/10 text-stone-200 rounded-xl">
            Register
        </a>
    </div>
</section>
@endsection
