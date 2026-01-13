@extends('layouts.app')

@section('content')
<div class="relative overflow-hidden rounded-[32px] bg-[#0a0f0d] text-stone-100 px-6 py-10 shadow-[0_25px_60px_-20px_rgba(0,0,0,0.6)]">
    {{-- background orbs --}}
    <div class="pointer-events-none absolute -top-20 -left-20 h-64 w-64 rounded-full bg-emerald-500/40 blur-[90px]"></div>
    <div class="pointer-events-none absolute top-10 right-0 h-72 w-72 rounded-full bg-amber-400/30 blur-[100px]"></div>
    <div class="pointer-events-none absolute -bottom-16 left-1/3 h-72 w-72 rounded-full bg-rose-400/20 blur-[110px]"></div>

    <div class="relative max-w-6xl mx-auto space-y-8">

        @include('profile.partials.flash')

        {{-- HEADER CARD --}}
        <div class="bg-white/5 border border-white/10 rounded-2xl backdrop-blur-xl p-6 flex flex-col md:flex-row md:items-center gap-6 shadow-[0_20px_50px_-12px_rgba(0,0,0,0.4)]">
            <div class="flex items-center gap-5">
                <img src="{{ $user->avatar_url }}"
                     class="w-20 h-20 rounded-2xl object-cover border border-white/20"
                     alt="Avatar">

                <div>
                    <h1 class="text-2xl font-semibold tracking-tight">{{ $user->name }}</h1>
                    <p class="text-stone-400">{{ $user->email }}</p>

                    <div class="mt-2 flex flex-wrap gap-2">
                        <span class="inline-flex items-center px-3 py-1 text-xs rounded-full bg-white/10 text-stone-200">
                            Account: Active
                        </span>
                        <span class="inline-flex items-center px-3 py-1 text-xs rounded-full bg-emerald-500/20 text-emerald-300">
                            Email: Verified.
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
                           class="block w-full md:w-72 text-sm text-stone-200
                                  file:mr-3 file:px-4 file:py-2 file:rounded-xl
                                  file:border-0 file:bg-emerald-600 file:text-white
                                  bg-white/5 border border-white/10 rounded-xl p-2">
                    <button class="px-4 py-2 rounded-xl bg-emerald-600 text-white hover:bg-emerald-500 transition">
                        Upload
                    </button>
                </form>
                @error('avatar')
                    <p class="text-sm text-rose-300 mt-2">{{ $message }}</p>
                @enderror
            </div>
        </div>

        {{-- GRID --}}
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

            {{-- PROFILE FORM --}}
            <div class="lg:col-span-2 bg-white/5 border border-white/10 rounded-2xl backdrop-blur-xl p-6 shadow-[0_20px_50px_-12px_rgba(0,0,0,0.4)]">
                <h2 class="text-lg font-semibold mb-1">Profile Information</h2>

                <form method="POST" action="{{ route('profile.update') }}" class="space-y-4">
                    @csrf
                    @method('PATCH')

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="text-sm text-stone-300">Name</label>
                            <input name="name"
                                   value="{{ old('name', $user->name) }}"
                                   class="mt-1 w-full bg-white/5 border border-white/10 rounded-xl px-3 py-2 text-stone-100">
                        </div>

                        <div>
                            <label class="text-sm text-stone-300">Phone</label>
                            <input name="phone"
                                   value="{{ old('phone', $user->phone) }}"
                                   class="mt-1 w-full bg-white/5 border border-white/10 rounded-xl px-3 py-2 text-stone-100">
                        </div>

                        <div class="md:col-span-2">
                            <label class="text-sm text-stone-300">Address</label>
                            <input name="address"
                                   value="{{ old('address', $user->address) }}"
                                   class="mt-1 w-full bg-white/5 border border-white/10 rounded-xl px-3 py-2 text-stone-100">
                        </div>

                        <div>
                            <label class="text-sm text-stone-300">City</label>
                            <input name="city"
                                   value="{{ old('city', $user->city) }}"
                                   class="mt-1 w-full bg-white/5 border border-white/10 rounded-xl px-3 py-2 text-stone-100">
                        </div>

                        <div>
                            <label class="text-sm text-stone-300">Country</label>
                            <input name="country"
                                   value="{{ old('country', $user->country) }}"
                                   class="mt-1 w-full bg-white/5 border border-white/10 rounded-xl px-3 py-2 text-stone-100">
                        </div>
                    </div>

                    <div class="flex items-center gap-3 pt-2">
                        <button class="px-5 py-2.5 rounded-xl bg-emerald-600 text-white hover:bg-emerald-500 transition">
                            Save changes
                        </button>
                        <span class="text-sm text-stone-400">
                            Member since: {{ $user->created_at->format('d.m.Y') }}
                        </span>
                    </div>
                </form>
            </div>

            {{-- SIDEBAR --}}
            <div class="space-y-6">

                {{-- SECURITY --}}
                <div class="bg-white/5 border border-white/10 rounded-2xl backdrop-blur-xl p-6 shadow-[0_20px_50px_-12px_rgba(0,0,0,0.4)]">
                    <h3 class="text-lg font-semibold mb-4">Security</h3>

                    <div class="text-sm text-stone-200 space-y-2">
                        <div class="flex justify-between">
                            <span>Last login</span>
                            <span class="text-stone-400">
                                {{ $user->last_login_at ? \Illuminate\Support\Carbon::parse($user->last_login_at)->format('d.m.Y H:i') : '—' }}
                            </span>
                        </div>
                    </div>
                </div>

                {{-- ACTIVITY --}}
                <div class="bg-white/5 border border-white/10 rounded-2xl backdrop-blur-xl p-6 shadow-[0_20px_50px_-12px_rgba(0,0,0,0.4)]">
                    <h3 class="text-lg font-semibold mb-4">Your Activity</h3>

                    <div class="grid grid-cols-2 gap-3">
                        <div class="rounded-2xl border border-white/10 bg-white/5 p-4">
                            <div class="text-2xl font-bold">{{ $stats['active_rentals'] }}</div>
                            <div class="text-sm text-stone-400">Active Rentals</div>
                        </div>
                        <div class="rounded-2xl border border-white/10 bg-white/5 p-4">
                            <div class="text-2xl font-bold">{{ $stats['pending_applications'] }}</div>
                            <div class="text-sm text-stone-400">Applications</div>
                        </div>
                    </div>
                </div>

            </div>
        </div>

    </div>
</div>
@endsection
