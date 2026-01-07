@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto px-6 py-8">

    {{-- Flash --}}
    @if(session('success'))
        <div class="mb-6 rounded-xl bg-green-100 border border-green-200 px-5 py-3 text-green-800">
            {{ session('success') }}
        </div>
    @endif

    {{-- Header --}}
    <div class="flex items-center justify-between mb-8">
        <div>
            <h1 class="text-3xl font-extrabold tracking-tight text-gray-900">
                Leases
            </h1>
            <p class="mt-1 text-sm text-gray-500">
                Overview of all rental agreements
            </p>
        </div>

        <a href="{{ route('admin.rentals.create') }}"
           class="inline-flex items-center gap-2 rounded-xl bg-black px-5 py-2.5
                  text-sm font-semibold text-white hover:bg-gray-800 transition
                  hover:scale-[1.02] active:scale-[0.97]">
            <span class="text-lg leading-none">+</span>
            New Lease
        </a>
    </div>

    {{-- Table Card --}}
    <div class="overflow-hidden rounded-2xl border border-gray-200 bg-white shadow-lg">

        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider text-gray-500">
                        Property
                    </th>
                    <th class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider text-gray-500">
                        Tenant
                    </th>
                    <th class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider text-gray-500">
                        Period
                    </th>
                    <th class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider text-gray-500">
                        Status
                    </th>
                    <th class="px-6 py-4 text-right text-xs font-semibold uppercase tracking-wider text-gray-500">
                        Actions
                    </th>
                </tr>
            </thead>

            <tbody class="divide-y divide-gray-100">
                @forelse($rentals as $r)
                    <tr class="group hover:bg-gray-50 transition">
                        {{-- Property --}}
                        <td class="px-6 py-4">
                            <div class="font-semibold text-gray-900">
                                {{ $r->apartment->city }}
                            </div>
                            <div class="text-xs text-gray-500">
                                {{ $r->apartment->address }}
                            </div>
                        </td>

                        {{-- Tenant --}}
                        <td class="px-6 py-4 text-gray-800">
                            {{ $r->user?->name ?? '—' }}
                        </td>

                        {{-- Period --}}
                        <td class="px-6 py-4 text-sm text-gray-600">
                            <div>{{ $r->start_date }}</div>
                            <div class="text-xs text-gray-400">
                                → {{ $r->end_date ?? 'Open-ended' }}
                            </div>
                        </td>

                        {{-- Status --}}
                        <td class="px-6 py-4">
                            @if($r->end_date === null || $r->end_date >= now()->toDateString())
                                <span class="inline-flex items-center rounded-full
                                             bg-green-100 px-3 py-1 text-xs font-semibold text-green-700">
                                    Active
                                </span>
                            @else
                                <span class="inline-flex items-center rounded-full
                                             bg-gray-200 px-3 py-1 text-xs font-semibold text-gray-700">
                                    Completed
                                </span>
                            @endif
                        </td>

                        {{-- Actions --}}
                        <td class="px-6 py-4 text-right space-x-2 opacity-0
                                   group-hover:opacity-100 transition">
                            <a href="{{ route('admin.rentals.edit', $r) }}"
                               class="inline-flex items-center rounded-lg bg-gray-100
                                      px-3 py-1.5 text-sm text-gray-700
                                      hover:bg-gray-200 transition">
                                Edit
                            </a>

                            <form action="{{ route('admin.rentals.destroy', $r) }}"
                                  method="POST"
                                  class="inline-block"
                                  onsubmit="return confirm('Delete this lease?');">
                                @csrf
                                @method('DELETE')
                                <button
                                    class="inline-flex items-center rounded-lg bg-red-600
                                           px-3 py-1.5 text-sm text-white
                                           hover:bg-red-700 transition">
                                    Delete
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="px-6 py-14 text-center text-sm text-gray-500">
                            No leases found.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
