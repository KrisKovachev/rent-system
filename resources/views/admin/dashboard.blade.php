@extends('layouts.admin')

@section('content')
<div class="max-w-7xl mx-auto px-6 py-8">

    {{-- Header --}}
    <div class="flex items-center justify-between mb-8">
        <h1 class="text-2xl font-semibold">Dashboard</h1>
        <span class="text-sm text-gray-500">
            Welcome back, {{ auth()->user()->name }}
        </span>
    </div>

    {{-- Stats --}}
    <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-10">
        <div class="bg-white rounded-xl shadow p-5">
            <div class="text-sm text-gray-500">Apartments</div>
            <div class="text-2xl font-semibold">—</div>
        </div>

        <div class="bg-white rounded-xl shadow p-5">
            <div class="text-sm text-gray-500">Active Rentals</div>
            <div class="text-2xl font-semibold">—</div>
        </div>

        <div class="bg-white rounded-xl shadow p-5">
            <div class="text-sm text-gray-500">Tenants</div>
            <div class="text-2xl font-semibold">—</div>
        </div>

        <div class="bg-white rounded-xl shadow p-5">
            <div class="text-sm text-gray-500">Pending Requests</div>
            <div class="text-2xl font-semibold text-indigo-600">
                {{ $rentalRequests->where('status', 'pending')->count() }}
            </div>
        </div>
    </div>

    {{-- Rental Requests --}}
    <div class="bg-white rounded-2xl shadow mb-10">
        <div class="px-6 py-4 border-b">
            <h2 class="text-lg font-semibold">Rental Requests</h2>
        </div>

        @forelse($rentalRequests as $rental)
            <div class="px-6 py-5 border-b flex items-center justify-between">
                {{-- Left --}}
                <div>
                    <div class="font-medium">
                        {{ $rental->apartment->type }}
                    </div>
                    <div class="text-sm text-gray-500">
                        {{ $rental->apartment->address }}
                    </div>
                    <div class="text-xs text-gray-400 mt-1">
                        Requested by: {{ $rental->user->name }}
                    </div>
                </div>

                {{-- Right --}}
                <div class="flex items-center gap-3">
                    {{-- Status --}}
                    <span class="px-3 py-1 rounded-full text-xs font-medium
                        @if($rental->status === 'approved') bg-green-100 text-green-700
                        @elseif($rental->status === 'rejected') bg-red-100 text-red-700
                        @else bg-yellow-100 text-yellow-700
                        @endif
                    ">
                        {{ ucfirst($rental->status) }}
                    </span>

                    {{-- Actions --}}
                    @if($rental->status === 'pending')
                        <form method="POST"
                              action="{{ route('admin.rental-requests.approve', $rental) }}">
                            @csrf
                            <button
                                class="px-3 py-1 text-sm rounded bg-green-600 text-white hover:bg-green-700">
                                Approve
                            </button>
                        </form>

                        <form method="POST"
                              action="{{ route('admin.rental-requests.reject', $rental) }}">
                            @csrf
                            <button
                                class="px-3 py-1 text-sm rounded bg-red-600 text-white hover:bg-red-700">
                                Reject
                            </button>
                        </form>
                    @else
                        <form method="POST"
                              action="{{ route('admin.rental-requests.destroy', $rental) }}"
                              onsubmit="return confirm('Delete this request?')">
                            @csrf
                            @method('DELETE')
                            <button
                                class="px-3 py-1 text-sm rounded bg-gray-200 text-gray-700 hover:bg-gray-300">
                                Delete
                            </button>
                        </form>
                    @endif
                </div>
            </div>
        @empty
            <div class="px-6 py-8 text-center text-gray-400">
                No rental requests.
            </div>
        @endforelse
    </div>

    {{-- Quick actions --}}
    <div class="bg-white rounded-2xl shadow p-6">
        <h2 class="text-lg font-semibold mb-4">Quick actions</h2>
        <div class="flex flex-wrap gap-4">
            <a href="{{ route('admin.apartments.index') }}"
               class="px-4 py-2 bg-gray-100 rounded hover:bg-gray-200 text-sm">
                Manage Apartments
            </a>

            <a href="{{ route('admin.tenants.index') }}"
               class="px-4 py-2 bg-gray-100 rounded hover:bg-gray-200 text-sm">
                Manage Tenants
            </a>

            <a href="{{ route('admin.rentals.index') }}"
               class="px-4 py-2 bg-gray-100 rounded hover:bg-gray-200 text-sm">
                Manage Rentals
            </a>
        </div>
    </div>

</div>
@endsection
