<!doctype html>
<html lang="bg" class="h-full">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Rent System</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700&family=Space+Mono:wght@400;700&display=swap">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="min-h-screen bg-[#0a0f0d] text-stone-100 font-['Outfit'] flex flex-col">
    {{-- Background --}}
    <div class="fixed inset-0 -z-20 bg-[linear-gradient(135deg,#0d1a14_0%,#132419_50%,#1a2e23_100%)]"></div>
    <div class="fixed -z-10 left-[10%] top-[10%] h-[360px] w-[360px] rounded-full bg-emerald-500/40 blur-[90px]"></div>
    <div class="fixed -z-10 right-[10%] top-[60%] h-[320px] w-[320px] rounded-full bg-amber-400/35 blur-[90px]"></div>
    <div class="fixed -z-10 left-[30%] bottom-[10%] h-[300px] w-[300px] rounded-full bg-rose-400/25 blur-[100px]"></div>

    {{-- NAVBAR --}}
    <nav id="navbar"
         class="sticky top-0 z-50 backdrop-blur-2xl bg-white/5 border-b border-white/10 transition-all duration-300">
        <div class="max-w-7xl mx-auto px-6">
            <div class="flex h-16 items-center justify-between">

                {{-- LEFT --}}
                <div class="flex items-center gap-10">
                    {{-- Logo --}}
                    <a href="{{ route('apartments.index') }}"
                       class="flex items-center gap-3 text-lg font-semibold tracking-tight">
                        <span class="text-transparent bg-clip-text bg-gradient-to-br from-emerald-300 to-amber-300">
                            RentSystem
                        </span>
                    </a>

                    {{-- Links --}}
                    <div class="hidden md:flex items-center gap-8">
                        <a href="{{ route('apartments.index') }}"
                           class="relative group text-sm font-medium text-stone-300 hover:text-white transition">
                            Search
                            <span class="absolute -bottom-1 left-0 h-[2px] bg-emerald-400 transition-all duration-300
                                {{ request()->routeIs('apartments.index') ? 'w-full' : 'w-0 group-hover:w-full' }}">
                            </span>
                        </a>

                        @auth
                            <a href="{{ route('apartments.my') }}"
                               class="relative group text-sm font-medium text-stone-300 hover:text-white transition">
                                My Properties
                                <span class="absolute -bottom-1 left-0 h-[2px] bg-emerald-400 transition-all duration-300
                                    {{ request()->routeIs('apartments.my') ? 'w-full' : 'w-0 group-hover:w-full' }}">
                                </span>
                            </a>
                        @endauth

                        @auth
                            @if(auth()->user()->isAdmin())
                                <a href="{{ route('admin.dashboard') }}"
                                   class="relative group text-sm font-medium text-stone-300 hover:text-white transition">
                                    Dashboard
                                    <span class="absolute -bottom-1 left-0 h-[2px] bg-emerald-400 transition-all duration-300
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
                        @php $u = auth()->user(); @endphp

                        <div class="relative" data-dropdown>
                            <button type="button"
                                    class="flex items-center gap-3 rounded-full px-3 py-1.5 hover:bg-white/10 transition"
                                    data-dropdown-button>
                                <img src="{{ $u->avatar_url }}"
                                     class="h-9 w-9 rounded-full object-cover border border-white/20"
                                     alt="Avatar">
                                <span class="hidden sm:block text-sm font-medium">
                                    {{ $u->name }}
                                </span>
                                <svg class="h-4 w-4 text-stone-300" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd"
                                          d="M5.23 7.21a.75.75 0 011.06.02L10 11.168l3.71-3.94a.75.75 0 111.08 1.04l-4.24 4.5a.75.75 0 01-1.08 0l-4.24-4.5a.75.75 0 01.02-1.06z"
                                          clip-rule="evenodd"/>
                                </svg>
                            </button>

                            <div class="hidden absolute right-0 mt-2 w-56 rounded-2xl border border-white/10 bg-[#0f1512] shadow-lg p-2"
                                 data-dropdown-menu>
                                <a href="{{ route('profile.show') }}"
                                   class="block px-3 py-2 rounded-xl text-sm hover:bg-white/10">
                                    Profile
                                </a>

                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button class="w-full text-left px-3 py-2 rounded-xl text-sm text-rose-300 hover:bg-rose-500/10">
                                        Logout
                                    </button>
                                </form>
                            </div>
                        </div>
                    @else
                        <a class="text-sm font-medium text-stone-300 hover:text-white transition"
                           href="{{ route('login') }}">
                            Login
                        </a>
                        <a class="text-sm font-medium text-stone-300 hover:text-white transition"
                           href="{{ route('register') }}">
                            Register
                        </a>
                    @endauth
                </div>
            </div>
        </div>
    </nav>

    {{-- MAIN --}}
    <main class="max-w-7xl mx-auto px-6 py-10 w-full flex-1">
        @if(session('success'))
            <div class="mb-6 rounded-xl bg-emerald-500/15 border border-emerald-500/30 px-5 py-3 text-emerald-200">
                {{ session('success') }}
            </div>
        @endif

        @if($errors->any())
            <div class="mb-6 rounded-xl bg-rose-500/15 border border-rose-500/30 px-5 py-3 text-rose-200">
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
    <footer class="mt-auto border-t border-white/10 bg-white/5 w-full">
        <div class="text-center max-w-7xl mx-auto px-6 py-6 text-sm text-stone-400">
            Ac {{ date('Y') }} RentSystem. All rights reserved.
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
