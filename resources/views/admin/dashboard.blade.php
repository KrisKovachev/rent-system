@extends('layouts.admin')

@section('title', 'Dashboard')

@section('content')
<div class="max-w-7xl mx-auto space-y-8">

    <!-- header -->
    <div class="flex items-center justify-between">
        <div>
            <h1 class="text-3xl font-semibold">Dashboard</h1>
            <p class="text-sm text-stone-400 mt-1">Welcome back, {{ auth()->user()->name }}</p>
        </div>
    </div>

    <!-- stats -->
    <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-4 gap-6">
        <div class="bg-white/5 border border-white/10 rounded-2xl p-6 backdrop-blur-xl shadow-[0_25px_50px_-12px_rgba(0,0,0,0.35)]">
            <div class="text-xs uppercase tracking-wider text-stone-400">Apartments</div>
            <div class="mt-3 text-3xl font-bold font-['Space_Mono']">—</div>
        </div>
        <div class="bg-white/5 border border-white/10 rounded-2xl p-6 backdrop-blur-xl shadow-[0_25px_50px_-12px_rgba(0,0,0,0.35)]">
            <div class="text-xs uppercase tracking-wider text-stone-400">Active Rentals</div>
            <div class="mt-3 text-3xl font-bold font-['Space_Mono']">—</div>
        </div>
        <div class="bg-white/5 border border-white/10 rounded-2xl p-6 backdrop-blur-xl shadow-[0_25px_50px_-12px_rgba(0,0,0,0.35)]">
            <div class="text-xs uppercase tracking-wider text-stone-400">Tenants</div>
            <div class="mt-3 text-3xl font-bold font-['Space_Mono']">—</div>
        </div>
        <div class="bg-white/5 border border-white/10 rounded-2xl p-6 backdrop-blur-xl shadow-[0_25px_50px_-12px_rgba(0,0,0,0.35)]">
            <div class="text-xs uppercase tracking-wider text-stone-400">Pending Requests</div>
            <div class="mt-3 text-3xl font-bold text-emerald-300 font-['Space_Mono']">
                {{ $rentalRequests->where('status', 'pending')->count() }}
            </div>
        </div>
    </div>

    <!-- rental requests -->
    <div class="bg-white/5 border border-white/10 rounded-3xl overflow-hidden backdrop-blur-xl shadow-[0_25px_50px_-12px_rgba(0,0,0,0.35)]">
        <div class="px-6 py-4 border-b border-white/10">
            <h2 class="text-lg font-semibold">Rental Requests</h2>
        </div>

        @forelse($rentalRequests as $rental)
            <div class="px-6 py-5 border-b border-white/5 flex items-center justify-between">
                <div>
                    <div class="font-medium">{{ $rental->apartment->type }}</div>
                    <div class="text-sm text-stone-400">{{ $rental->apartment->address }}</div>
                    <div class="text-xs text-stone-500 mt-1">Requested by: {{ $rental->tenant->name }}</div>
                </div>

                <div class="flex items-center gap-3">
                    <span class="px-3 py-1 rounded-full text-xs font-medium
                        @if($rental->status === 'approved') bg-emerald-500/20 text-emerald-300
                        @elseif($rental->status === 'rejected') bg-rose-500/20 text-rose-300
                        @else bg-amber-500/20 text-amber-300
                        @endif">
                        {{ ucfirst($rental->status) }}
                    </span>

                    @if($rental->status === 'pending')
                        <form method="POST" action="{{ route('admin.rental-requests.approve', $rental) }}">
                            @csrf
                            <button class="px-3 py-1 text-sm rounded bg-emerald-600 text-white hover:bg-emerald-500 transition">
                                Approve
                            </button>
                        </form>
                        <form method="POST" action="{{ route('admin.rental-requests.reject', $rental) }}">
                            @csrf
                            <button class="px-3 py-1 text-sm rounded bg-rose-600 text-white hover:bg-rose-500 transition">
                                Reject
                            </button>
                        </form>
                    @else
                        <form method="POST" action="{{ route('admin.rental-requests.destroy', $rental) }}"
                              onsubmit="return confirm('Delete this request?')">
                            @csrf
                            @method('DELETE')
                            <button class="px-3 py-1 text-sm rounded bg-white/10 text-stone-200 hover:bg-white/20 transition">
                                Delete
                            </button>
                        </form>
                    @endif
                </div>
            </div>
        @empty
            <div class="px-6 py-8 text-center text-stone-500">No rental requests.</div>
        @endforelse
    </div>

    <!-- quick actions -->
    <div class="bg-white/5 border border-white/10 rounded-2xl p-6 backdrop-blur-xl shadow-[0_25px_50px_-12px_rgba(0,0,0,0.35)]">
        <h2 class="text-lg font-semibold mb-4">Quick actions</h2>
        <div class="flex flex-wrap gap-4">
            <a href="{{ route('admin.apartments.index') }}"
               class="px-4 py-2 bg-white/10 rounded-xl hover:bg-white/20 transition text-sm">
                Manage Apartments
            </a>
            <a href="{{ route('admin.tenants.index') }}"
               class="px-4 py-2 bg-white/10 rounded-xl hover:bg-white/20 transition text-sm">
                Manage Tenants
            </a>
            <a href="{{ route('admin.rentals.index') }}"
               class="px-4 py-2 bg-white/10 rounded-xl hover:bg-white/20 transition text-sm">
                Manage Rentals
            </a>
        </div>
    </div>

</div>
@endsection
