@extends('layouts.app')

@section('content')
<div class="max-w-6xl mx-auto py-10 space-y-8">

    @include('profile.partials.flash')

    {{-- HEADER CARD --}}
    <div class="bg-white rounded-2xl shadow-sm border p-6 flex flex-col md:flex-row md:items-center gap-6">
        <div class="flex items-center gap-5">
            <img src="{{ $user->avatar_url }}"
                 class="w-20 h-20 rounded-2xl object-cover border"
                 alt="Avatar">

            <div>
                <h1 class="text-2xl font-bold tracking-tight">{{ $user->name }}</h1>
                <p class="text-gray-500">{{ $user->email }}</p>

                <div class="mt-2 flex flex-wrap gap-2">
                    <span class="inline-flex items-center px-3 py-1 text-xs rounded-full bg-gray-100 text-gray-700">
                        Account: Active
                    </span>
                    <span class="inline-flex items-center px-3 py-1 text-xs rounded-full bg-green-100 text-green-700">
                        Email: Verified ✅
                    </span>
                </div>
            </div>
        </div>

        <div class="md:ml-auto w-full md:w-auto">
            <form method="POST"
                  action="{{ route('profile.avatar') }}"
                  enctype="multipart/form-data"
                  class="flex items-center gap-3">
                @csrf
                <input type="file"
                       name="avatar"
                       accept="image/*"
                       class="block w-full md:w-72 text-sm
                              file:mr-3 file:px-4 file:py-2 file:rounded-xl
                              file:border-0 file:bg-black file:text-white
                              border rounded-xl p-2">
                <button class="px-4 py-2 rounded-xl bg-black text-white hover:opacity-90">
                    Upload
                </button>
            </form>
            @error('avatar')
                <p class="text-sm text-red-600 mt-2">{{ $message }}</p>
            @enderror
        </div>
    </div>

    {{-- GRID --}}
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

        {{-- PROFILE FORM --}}
        <div class="lg:col-span-2 bg-white rounded-2xl shadow-sm border p-6">
            <h2 class="text-lg font-semibold mb-1">Profile Information</h2>
            <p class="text-sm text-gray-500 mb-6">
                Used for contracts, contact, and admin processes.
            </p>

            <form method="POST" action="{{ route('profile.update') }}" class="space-y-4">
                @csrf
                @method('PATCH')

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="text-sm text-gray-600">Name</label>
                        <input name="name"
                               value="{{ old('name', $user->name) }}"
                               class="mt-1 w-full border rounded-xl px-3 py-2">
                    </div>

                    <div>
                        <label class="text-sm text-gray-600">Phone</label>
                        <input name="phone"
                               value="{{ old('phone', $user->phone) }}"
                               class="mt-1 w-full border rounded-xl px-3 py-2">
                    </div>

                    <div class="md:col-span-2">
                        <label class="text-sm text-gray-600">Address</label>
                        <input name="address"
                               value="{{ old('address', $user->address) }}"
                               class="mt-1 w-full border rounded-xl px-3 py-2">
                    </div>

                    <div>
                        <label class="text-sm text-gray-600">City</label>
                        <input name="city"
                               value="{{ old('city', $user->city) }}"
                               class="mt-1 w-full border rounded-xl px-3 py-2">
                    </div>

                    <div>
                        <label class="text-sm text-gray-600">Country</label>
                        <input name="country"
                               value="{{ old('country', $user->country) }}"
                               class="mt-1 w-full border rounded-xl px-3 py-2">
                    </div>
                </div>

                <div class="flex items-center gap-3 pt-2">
                    <button class="px-5 py-2.5 rounded-xl bg-black text-white">
                        Save changes
                    </button>
                    <span class="text-sm text-gray-500">
                        Member since: {{ $user->created_at->format('d.m.Y') }}
                    </span>
                </div>
            </form>
        </div>

        {{-- SIDEBAR --}}
        <div class="space-y-6">

            {{-- SECURITY --}}
            <div class="bg-white rounded-2xl shadow-sm border p-6">
                <h3 class="text-lg font-semibold mb-4">Security</h3>

                <div class="text-sm text-gray-700 space-y-2">
                    <div class="flex justify-between">
                        <span>Last login</span>
                        <span class="text-gray-500">
                            {{ $user->last_login_at?->format('d.m.Y H:i') ?? '—' }}
                        </span>
                    </div>
                </div>
            </div>

            {{-- ACTIVITY --}}
            <div class="bg-white rounded-2xl shadow-sm border p-6">
                <h3 class="text-lg font-semibold mb-4">Your Activity</h3>

                <div class="grid grid-cols-2 gap-3">
                    <div class="rounded-2xl border p-4">
                        <div class="text-2xl font-bold">{{ $stats['active_rentals'] }}</div>
                        <div class="text-sm text-gray-500">Active Rentals</div>
                    </div>
                    <div class="rounded-2xl border p-4">
                        <div class="text-2xl font-bold">{{ $stats['pending_applications'] }}</div>
                        <div class="text-sm text-gray-500">Applications</div>
                    </div>
                </div>
            </div>

        </div>
    </div>

</div>
@endsection
