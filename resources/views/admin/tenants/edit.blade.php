@extends('layouts.admin')

@section('content')
<div class="px-6 py-14">
    <div class="mx-auto max-w-4xl space-y-10">

        {{-- Header --}}
        <div class="mb-10 text-center animate-fade-in">
            <h1 class="text-4xl font-extrabold tracking-tight text-stone-100">
                Edit Tenant
            </h1>
            <p class="mt-3 text-sm text-stone-400 max-w-xl mx-auto">
                Control user identity, security and system access
            </p>
        </div>

        {{-- Main Card --}}
        <div class="relative rounded-3xl glass-card overflow-hidden">

            <div class="absolute inset-x-0 top-0 h-1 bg-gradient-to-r from-emerald-500 via-emerald-300 to-emerald-600"></div>

            <form method="POST"
                  action="{{ route('admin.tenants.update', $tenant) }}"
                  class="p-10 space-y-8">
                @csrf
                @method('PUT')

                {{-- Identity --}}
                <div>
                    <h2 class="text-sm font-semibold tracking-wide text-stone-500 uppercase mb-4">
                        Identity
                    </h2>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="glass-label">
                                Full name
                            </label>
                            <input
                                type="text"
                                name="name"
                                value="{{ old('name', $tenant->name) }}"
                                class="glass-input"
                                required
                            >
                        </div>

                        <div>
                            <label class="glass-label">
                                Email address
                            </label>
                            <input
                                type="email"
                                name="email"
                                value="{{ old('email', $tenant->email) }}"
                                class="glass-input"
                                required
                            >
                        </div>
                    </div>
                </div>

                {{-- Security --}}
                <div>
                    <h2 class="text-sm font-semibold tracking-wide text-stone-500 uppercase mb-4">
                        Security
                    </h2>

                    <label class="glass-label">
                        Password
                    </label>
                    <input
                        type="password"
                        name="password"
                        placeholder="Leave empty to keep current password"
                        class="glass-input"
                    >
                </div>

                {{-- Permissions --}}
                <div>
                    <h2 class="text-sm font-semibold tracking-wide text-stone-500 uppercase mb-4">
                        Permissions
                    </h2>

                    <div class="flex items-center justify-between rounded-2xl border border-white/10 bg-white/5 px-6 py-5">
                        <div>
                            <p class="text-sm font-semibold text-stone-100">
                                Administrator
                            </p>
                            <p class="text-xs text-stone-400 max-w-sm">
                                Full access to tenants, properties, leases and system settings
                            </p>
                        </div>

                        {{-- REAL ROLE FIELD --}}
                        <input type="hidden" name="role" value="user">

                        <label class="relative inline-flex items-center cursor-pointer">
                            <input 
                                type="checkbox"
                                name="role"
                                value="admin"
                                {{ $tenant->role === 'admin' ? 'checked' : '' }}
                                class="sr-only peer"
                            >
                            <div
                                class="w-14 h-7 bg-white/20 rounded-full peer
                                peer-checked:bg-emerald-600 transition-all duration-300
                                after:content-[''] after:absolute after:top-0.5 after:left-0.5
                                after:h-6 after:w-6 after:bg-white after:rounded-full
                                after:transition-all peer-checked:after:translate-x-7">
                            </div>
                        </label>
                    </div>
                </div>

                {{-- Actions --}}
                <div class="flex items-center justify-between pt-6 border-t border-white/10">
                    <a href="{{ route('admin.tenants.index') }}"
                       class="text-sm font-medium text-stone-400 hover:text-white">
                        ← Back to tenants
                    </a>

                    <button
                        type="submit"
                        class="rounded-xl bg-emerald-600 px-8 py-3 text-sm font-semibold text-white hover:bg-emerald-500">
                        Save Changes
                    </button>
                </div>
            </form>
        </div>

        <div class="mt-12 text-center text-xs text-stone-500">
            © {{ date('Y') }} RentSystem
        </div>
    </div>
</div>
@endsection


