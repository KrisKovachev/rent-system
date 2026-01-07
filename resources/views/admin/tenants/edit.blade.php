@extends('layouts.app')

@section('content')
<div class="min-h-[85vh] bg-gradient-to-br from-gray-50 via-white to-gray-100 px-6 py-14">
    <div class="mx-auto max-w-4xl">

        {{-- Header --}}
        <div class="mb-10 text-center animate-fade-in">
            <h1 class="text-4xl font-extrabold tracking-tight text-gray-900">
                Edit Tenant
            </h1>
            <p class="mt-3 text-sm text-gray-500 max-w-xl mx-auto">
                Control user identity, security and system access
            </p>
        </div>

        {{-- Main Card --}}
        <div class="relative rounded-3xl bg-white shadow-2xl ring-1 ring-gray-200 overflow-hidden">

            <div class="absolute inset-x-0 top-0 h-1 bg-gradient-to-r from-black via-gray-700 to-black"></div>

            <form method="POST"
                  action="{{ route('admin.tenants.update', $tenant) }}"
                  class="p-10 space-y-8">
                @csrf
                @method('PUT')

                {{-- Identity --}}
                <div>
                    <h2 class="text-sm font-semibold tracking-wide text-gray-400 uppercase mb-4">
                        Identity
                    </h2>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">
                                Full name
                            </label>
                            <input
                                type="text"
                                name="name"
                                value="{{ old('name', $tenant->name) }}"
                                class="w-full rounded-xl border-gray-300 px-4 py-3 focus:border-black focus:ring-black"
                                required
                            >
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">
                                Email address
                            </label>
                            <input
                                type="email"
                                name="email"
                                value="{{ old('email', $tenant->email) }}"
                                class="w-full rounded-xl border-gray-300 px-4 py-3 focus:border-black focus:ring-black"
                                required
                            >
                        </div>
                    </div>
                </div>

                {{-- Security --}}
                <div>
                    <h2 class="text-sm font-semibold tracking-wide text-gray-400 uppercase mb-4">
                        Security
                    </h2>

                    <label class="block text-sm font-medium text-gray-700 mb-1">
                        Password
                    </label>
                    <input
                        type="password"
                        name="password"
                        placeholder="Leave empty to keep current password"
                        class="w-full rounded-xl border-gray-300 px-4 py-3 focus:border-black focus:ring-black"
                    >
                </div>

                {{-- Permissions --}}
                <div>
                    <h2 class="text-sm font-semibold tracking-wide text-gray-400 uppercase mb-4">
                        Permissions
                    </h2>

                    <div class="flex items-center justify-between rounded-2xl border border-gray-200 bg-gray-50 px-6 py-5">
                        <div>
                            <p class="text-sm font-semibold text-gray-900">
                                Administrator
                            </p>
                            <p class="text-xs text-gray-500 max-w-sm">
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
                                class="w-14 h-7 bg-gray-300 rounded-full peer
                                peer-checked:bg-black transition-all duration-300
                                after:content-[''] after:absolute after:top-0.5 after:left-0.5
                                after:h-6 after:w-6 after:bg-white after:rounded-full
                                after:transition-all peer-checked:after:translate-x-7">
                            </div>
                        </label>
                    </div>
                </div>

                {{-- Actions --}}
                <div class="flex items-center justify-between pt-6 border-t">
                    <a href="{{ route('admin.tenants.index') }}"
                       class="text-sm font-medium text-gray-500 hover:text-gray-800">
                        ← Back to tenants
                    </a>

                    <button
                        type="submit"
                        class="rounded-xl bg-black px-8 py-3 text-sm font-semibold text-white hover:bg-gray-800">
                        Save Changes
                    </button>
                </div>
            </form>
        </div>

        <div class="mt-12 text-center text-xs text-gray-400">
            © {{ date('Y') }} RentSystem
        </div>
    </div>
</div>
@endsection
