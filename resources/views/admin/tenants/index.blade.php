@extends('layouts.admin')

@section('content')
<div class="max-w-7xl mx-auto px-6 py-8">

    {{-- Flash message --}}
    @if(session('success'))
        <div class="mb-6 rounded-lg bg-emerald-500/15 border border-emerald-500/30 px-4 py-3 text-emerald-200">
            {{ session('success') }}
        </div>
    @endif

    {{-- Header --}}
    <div class="flex items-center justify-between mb-6">
        <div>
            <h1 class="text-2xl font-bold text-stone-100">Tenants</h1>
            <p class="text-sm text-stone-400 mt-1">
                Manage all users and their roles in the system
            </p>
        </div>

        <a href="{{ route('admin.tenants.create') }}"
           class="inline-flex items-center gap-2 rounded-lg bg-emerald-600 px-4 py-2 text-sm font-medium text-white hover:bg-emerald-500 transition">
            <span class="text-lg leading-none">+</span>
            New Tenant
        </a>
    </div>

    {{-- Table --}}
    <div class="overflow-hidden glass-card shadow-sm">
        <table class="min-w-full divide-y divide-white/10">
            <thead class="bg-white/5">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-semibold uppercase tracking-wider text-stone-400">
                        Name
                    </th>
                    <th class="px-6 py-3 text-left text-xs font-semibold uppercase tracking-wider text-stone-400">
                        Email
                    </th>
                    <th class="px-6 py-3 text-left text-xs font-semibold uppercase tracking-wider text-stone-400">
                        Role
                    </th>
                    <th class="px-6 py-3 text-right text-xs font-semibold uppercase tracking-wider text-stone-400">
                        Actions
                    </th>
                </tr>
            </thead>

            <tbody class="divide-y divide-white/10">
                @forelse($tenants as $tenant)
                    <tr class="hover:bg-white/5 transition">
                        <td class="px-6 py-4 font-medium text-stone-100">
                            {{ $tenant->name }}
                        </td>

                        <td class="px-6 py-4 text-stone-300">
                            {{ $tenant->email }}
                        </td>

                        <td class="px-6 py-4">
                            <span class="inline-flex items-center rounded-full px-3 py-1 text-xs font-semibold
                                {{ $tenant->isAdmin()
                                    ? 'bg-emerald-600 text-white'
                                    : 'bg-white/10 text-stone-200' }}">
                                {{ strtoupper($tenant->role) }}
                            </span>
                        </td>

                        <td class="px-6 py-4 text-right space-x-2">
                            <a href="{{ route('admin.tenants.edit', $tenant) }}"
                               class="inline-flex items-center rounded-md bg-white/10 px-3 py-1.5 text-sm text-stone-200 hover:bg-white/20 transition">
                                Edit
                            </a>

                            @if(auth()->id() !== $tenant->id)
                                <form action="{{ route('admin.tenants.destroy', $tenant) }}"
                                      method="POST"
                                      class="inline-block"
                                      onsubmit="return confirm('Are you sure you want to delete this tenant?');">
                                    @csrf
                                    @method('DELETE')
                                    <button
                                        class="inline-flex items-center rounded-md bg-rose-600 px-3 py-1.5 text-sm text-white hover:bg-rose-500 transition">
                                        Delete
                                    </button>
                                </form>
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="px-6 py-10 text-center text-sm text-stone-400">
                            No tenants found.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection


