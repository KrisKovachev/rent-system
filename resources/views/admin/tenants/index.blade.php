@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto px-6 py-8">

    {{-- Flash message --}}
    @if(session('success'))
        <div class="mb-6 rounded-lg bg-green-100 border border-green-200 px-4 py-3 text-green-800">
            {{ session('success') }}
        </div>
    @endif

    {{-- Header --}}
    <div class="flex items-center justify-between mb-6">
        <div>
            <h1 class="text-2xl font-bold text-gray-900">Tenants</h1>
            <p class="text-sm text-gray-500 mt-1">
                Manage all users and their roles in the system
            </p>
        </div>

        <a href="{{ route('admin.tenants.create') }}"
           class="inline-flex items-center gap-2 rounded-lg bg-black px-4 py-2 text-sm font-medium text-white hover:bg-gray-800 transition">
            <span class="text-lg leading-none">+</span>
            New Tenant
        </a>
    </div>

    {{-- Table --}}
    <div class="overflow-hidden rounded-xl border border-gray-200 bg-white shadow-sm">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-semibold uppercase tracking-wider text-gray-500">
                        Name
                    </th>
                    <th class="px-6 py-3 text-left text-xs font-semibold uppercase tracking-wider text-gray-500">
                        Email
                    </th>
                    <th class="px-6 py-3 text-left text-xs font-semibold uppercase tracking-wider text-gray-500">
                        Role
                    </th>
                    <th class="px-6 py-3 text-right text-xs font-semibold uppercase tracking-wider text-gray-500">
                        Actions
                    </th>
                </tr>
            </thead>

            <tbody class="divide-y divide-gray-100">
                @forelse($tenants as $tenant)
                    <tr class="hover:bg-gray-50 transition">
                        <td class="px-6 py-4 font-medium text-gray-900">
                            {{ $tenant->name }}
                        </td>

                        <td class="px-6 py-4 text-gray-600">
                            {{ $tenant->email }}
                        </td>

                        <td class="px-6 py-4">
                            <span class="inline-flex items-center rounded-full px-3 py-1 text-xs font-semibold
                                {{ $tenant->isAdmin()
                                    ? 'bg-black text-white'
                                    : 'bg-gray-100 text-gray-700' }}">
                                {{ strtoupper($tenant->role) }}
                            </span>
                        </td>

                        <td class="px-6 py-4 text-right space-x-2">
                            <a href="{{ route('admin.tenants.edit', $tenant) }}"
                               class="inline-flex items-center rounded-md bg-gray-100 px-3 py-1.5 text-sm text-gray-700 hover:bg-gray-200 transition">
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
                                        class="inline-flex items-center rounded-md bg-red-600 px-3 py-1.5 text-sm text-white hover:bg-red-700 transition">
                                        Delete
                                    </button>
                                </form>
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="px-6 py-10 text-center text-sm text-gray-500">
                            No tenants found.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
