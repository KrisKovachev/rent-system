<!doctype html>
<html lang="bg">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Rent System</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-gray-50 text-gray-900">

{{-- NAVBAR --}}
<nav id="navbar"
     class="sticky top-0 z-50 bg-white/70 backdrop-blur-xl
            border-b border-white/30 transition-all duration-300">

    <div class="max-w-7xl mx-auto px-6">
        <div class="flex h-16 items-center justify-between">

            {{-- LEFT --}}
            <div class="flex items-center gap-10">

                {{-- Logo --}}
                <a href="{{ route('apartments.index') }}"
                   class="flex items-center gap-2 text-xl font-extrabold tracking-tight">
                    <span class="text-xl">🏠</span>
                    <span class="bg-gradient-to-r from-black to-gray-600 bg-clip-text text-transparent">
                        RentSystem
                    </span>
                </a>

                {{-- Links --}}
                <div class="hidden md:flex items-center gap-8">

                    {{-- Search --}}
                    <a href="{{ route('apartments.index') }}"
                       class="relative group text-sm font-medium text-gray-600 hover:text-black transition">
                        Search
                        <span class="absolute -bottom-1 left-0 h-[2px] bg-black transition-all duration-300
                            {{ request()->routeIs('apartments.index') ? 'w-full' : 'w-0 group-hover:w-full' }}">
                        </span>
                    </a>

                    @auth
                        <a href="{{ route('apartments.my') }}"
                           class="relative group text-sm font-medium text-gray-600 hover:text-black transition">
                            My Properties
                            <span class="absolute -bottom-1 left-0 h-[2px] bg-black transition-all duration-300
                                {{ request()->routeIs('apartments.my') ? 'w-full' : 'w-0 group-hover:w-full' }}">
                            </span>
                        </a>
                    @endauth

                    @auth
                        @if(auth()->user()->isAdmin())
                            <a href="{{ route('admin.dashboard') }}"
                               class="relative group text-sm font-medium text-gray-600 hover:text-black transition">
                                Dashboard
                                <span class="absolute -bottom-1 left-0 h-[2px] bg-black transition-all duration-300
                                    {{ request()->routeIs('admin.*') ? 'w-full' : 'w-0 group-hover:w-full' }}">
                                </span>
                            </a>
                        @endif
                    @endauth
                </div>
            </div>

            {{-- RIGHT --}}
            <div class="flex items-center gap-4">
                @auth
                    {{-- User dropdown --}}
                    @auth
@php $u = auth()->user(); @endphp

<div class="relative" data-dropdown>
    <button type="button"
            class="flex items-center gap-3 rounded-full px-3 py-1.5 hover:bg-black/5 transition"
            data-dropdown-button>

        <img src="{{ $u->avatar_url }}"
             class="h-9 w-9 rounded-full object-cover border border-black/10"
             alt="Avatar">

        <span class="hidden sm:block text-sm font-medium">
            {{ $u->name }}
        </span>

        <svg class="h-4 w-4 text-gray-500" viewBox="0 0 20 20" fill="currentColor">
            <path fill-rule="evenodd"
                  d="M5.23 7.21a.75.75 0 011.06.02L10 11.168l3.71-3.94a.75.75 0 111.08 1.04l-4.24 4.5a.75.75 0 01-1.08 0l-4.24-4.5a.75.75 0 01.02-1.06z"
                  clip-rule="evenodd"/>
        </svg>
    </button>

    <div class="hidden absolute right-0 mt-2 w-56 rounded-2xl border bg-white shadow-lg p-2"
         data-dropdown-menu>

        <a href="{{ route('profile.show') }}"
           class="block px-3 py-2 rounded-xl text-sm hover:bg-black/5">
            👤 Profile
        </a>

        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button class="w-full text-left px-3 py-2 rounded-xl text-sm text-red-600 hover:bg-red-50">
                🚪 Logout
            </button>
        </form>
    </div>
</div>
@endauth


                @else
                    <a class="text-sm font-medium text-gray-600 hover:text-black transition"
                       href="{{ route('login') }}">
                        Login
                    </a>
                    <a class="text-sm font-medium text-gray-600 hover:text-black transition"
                       href="{{ route('register') }}">
                        Register
                    </a>
                @endauth
            </div>

        </div>
    </div>
</nav>

{{-- MAIN --}}
<main class="max-w-7xl mx-auto px-6 py-10">

    @if(session('success'))
        <div class="mb-6 rounded-xl bg-green-100 border border-green-300 px-5 py-3">
            {{ session('success') }}
        </div>
    @endif

    @if($errors->any())
        <div class="mb-6 rounded-xl bg-red-100 border border-red-300 px-5 py-3">
            <ul class="list-disc pl-6 text-sm">
                @foreach($errors->all() as $e)
                    <li>{{ $e }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    @yield('content')
</main>

{{-- FOOTER --}}
<footer class="border-t bg-white mt-20">
    <div class="max-w-7xl mx-auto px-6 py-6 text-sm text-gray-500">
        © {{ date('Y') }} RentSystem. All rights reserved.
    </div>
</footer>

{{-- Scroll shadow + Dropdown --}}
<script>
    const nav = document.getElementById('navbar');
    window.addEventListener('scroll', () => {
        nav.classList.toggle('shadow-lg', window.scrollY > 10);
    });

    // Dropdown (no dependencies)
    document.addEventListener('click', (e) => {
        const dropdown = e.target.closest('[data-dropdown]');
        document.querySelectorAll('[data-dropdown-menu]').forEach(menu => {
            const isThisMenu = dropdown && dropdown.querySelector('[data-dropdown-menu]') === menu;
            if (!isThisMenu) menu.classList.add('hidden');
        });

        if (!dropdown) return;

        const btn = e.target.closest('[data-dropdown-button]');
        if (!btn) return;

        const menu = dropdown.querySelector('[data-dropdown-menu]');
        if (menu) menu.classList.toggle('hidden');
    });

    // Close on ESC
    document.addEventListener('keydown', (e) => {
        if (e.key === 'Escape') {
            document.querySelectorAll('[data-dropdown-menu]').forEach(menu => menu.classList.add('hidden'));
        }
    });
</script>

</body>
</html>
