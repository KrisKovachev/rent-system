<aside id="sidebar"
       class="fixed left-0 top-0 h-screen w-[280px] overflow-y-auto
              bg-white/5 backdrop-blur-2xl border-r border-white/10
              px-6 py-6 hidden lg:flex flex-col">
    <div class="flex items-center gap-3 pb-6 border-b border-white/10">
        <div class="text-lg font-semibold text-transparent bg-clip-text
                    bg-gradient-to-br from-emerald-300 to-amber-300">RentSystem</div>
    </div>

    <nav class="mt-6 space-y-2 text-sm">
        <a href="{{ route('profile.show') }}"
        class="mb-4 flex items-center gap-3 rounded-xl px-4 py-3
                bg-white/5 border border-white/10 backdrop-blur-xl
                hover:bg-white/10 transition">
            <img src="{{ auth()->user()->avatar_url }}"
                alt="{{ auth()->user()->name }}"
                class="h-10 w-10 rounded-xl object-cover">
            <div class="min-w-0">
                <div class="text-sm font-semibold truncate">{{ auth()->user()->name }}</div>
                <div class="text-xs text-stone-400 truncate">View profile</div>
            </div>
        </a>
        <a href="{{ route('admin.dashboard') }}"
           class="block px-4 py-3 rounded-xl text-stone-200 hover:bg-white/10 hover:text-white transition">
            Dashboard
        </a>
        <a href="{{ route('admin.apartments.index') }}"
           class="block px-4 py-3 rounded-xl text-stone-200 hover:bg-white/10 hover:text-white transition">
            Apartments
        </a>
        <a href="{{ route('admin.rentals.index') }}"
           class="block px-4 py-3 rounded-xl text-stone-200 hover:bg-white/10 hover:text-white transition">
            Rentals
        </a>
        <a href="{{ route('admin.tenants.index') }}"
           class="block px-4 py-3 rounded-xl text-stone-200 hover:bg-white/10 hover:text-white transition">
            Tenants
        </a>
    </nav>

    <div class="mt-auto pt-6 border-t border-white/10">
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button class="text-sm text-rose-300 hover:text-rose-200 transition w-full text-left">
                Logout
            </button>
        </form>
    </div>
</aside>
