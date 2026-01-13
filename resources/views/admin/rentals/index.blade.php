@extends('layouts.admin')

@section('content')
<div class="max-w-7xl mx-auto px-6 py-8">

    {{-- Flash --}}
    @if(session('success'))
        <div class="mb-6 rounded-xl bg-emerald-500/15 border border-emerald-500/30 px-5 py-3 text-emerald-200">
            {{ session('success') }}
        </div>
    @endif

    {{-- Header --}}
    <div class="flex items-center justify-between mb-8">
        <div>
            <h1 class="text-3xl font-extrabold tracking-tight text-stone-100">
                Leases
            </h1>
            <p class="mt-1 text-sm text-stone-400">
                Overview of all rental agreements
            </p>
        </div>

        <a href="{{ route('admin.rentals.create') }}"
           class="inline-flex items-center gap-2 rounded-xl bg-emerald-600 px-5 py-2.5
                  text-sm font-semibold text-white hover:bg-emerald-500 transition
                  hover:scale-[1.02] active:scale-[0.97]">
            <span class="text-lg leading-none">+</span>
            New Lease
        </a>
    </div>

    {{-- Table Card --}}
    <div class="overflow-hidden rounded-2xl glass-card shadow-lg">

        <table class="min-w-full divide-y divide-white/10">
            <thead class="bg-white/5">
                <tr>
                    <th class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider text-stone-400">
                        Property
                    </th>
                    <th class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider text-stone-400">
                        Tenant
                    </th>
                    <th class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider text-stone-400">
                        Period
                    </th>
                    <th class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider text-stone-400">
                        Status
                    </th>
                    <th class="px-6 py-4 text-right text-xs font-semibold uppercase tracking-wider text-stone-400">
                        Actions
                    </th>
                </tr>
            </thead>

            <tbody class="divide-y divide-white/10">
                @forelse($rentals as $r)
                    <tr class="group hover:bg-white/5 transition">
                        {{-- Property --}}
                        <td class="px-6 py-4">
                            <div class="text-xs text-stone-400">
                                {{ $r->apartment->address }}
                            </div>
                        </td>

                        {{-- Tenant --}}
                        <td class="px-6 py-4 text-stone-200">
                            {{ $r->tenant?->name ?? '—' }}
                        </td>

                        {{-- Period --}}
                        <td class="px-6 py-4 text-sm text-stone-300">
                            <div>{{ $r->start_date }}</div>
                            <div class="text-xs text-stone-400">
                                → {{ $r->end_date ?? 'Open-ended' }}
                            </div>
                        </td>

                        {{-- Status --}}
                        <td class="px-6 py-4">
                            @if($r->end_date === null || $r->end_date >= now()->toDateString())
                                <span class="inline-flex items-center rounded-full
                                             bg-emerald-500/20 px-3 py-1 text-xs font-semibold text-emerald-300">
                                    Active
                                </span>
                            @else
                                <span class="inline-flex items-center rounded-full
                                             bg-white/10 px-3 py-1 text-xs font-semibold text-stone-300">
                                    Completed
                                </span>
                            @endif
                        </td>

                        {{-- Actions --}}
                        <td class="px-6 py-4 text-right space-x-2 opacity-0
                                   group-hover:opacity-100 transition">
                            <a href="{{ route('admin.rentals.edit', $r) }}"
                               class="inline-flex items-center rounded-lg bg-white/10
                                      px-3 py-1.5 text-sm text-stone-300
                                      hover:bg-white/10 transition">
                                Edit
                            </a>

                            <form action="{{ route('admin.rentals.destroy', $r) }}"
                                  method="POST"
                                  class="inline-block"
                                  onsubmit="return confirm('Delete this lease?');">
                                @csrf
                                @method('DELETE')
                                <button
                                    class="inline-flex items-center rounded-lg bg-rose-600
                                           px-3 py-1.5 text-sm text-white
                                           hover:bg-rose-500 transition">
                                    Delete
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="px-6 py-14 text-center text-sm text-stone-400">
                            No leases found.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection

