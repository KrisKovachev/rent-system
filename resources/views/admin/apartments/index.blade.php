@extends('layouts.admin')

@section('content')
<div class="flex items-center justify-between mb-8">
    <h1 class="text-3xl font-bold">Properties</h1>
    <a href="{{ route('admin.apartments.create') }}"
       class="px-5 py-2 bg-emerald-600 text-white rounded-xl">
        + New Property
    </a>
</div>

<div class="glass-card overflow-hidden">
    <table class="w-full text-left">
        <thead class="bg-white/5 text-sm uppercase text-stone-400">
            <tr>
                <th class="p-4">Type</th>
                <th class="p-4">Address</th>
                <th class="p-4">Price</th>
                <th class="p-4">Area</th>
                <th class="p-4">Status</th>
                <th class="p-4 text-right">Actions</th>
            </tr>
        </thead>
        <tbody>
        @foreach($apartments as $a)
            <tr class="border-t border-white/10 hover:bg-white/5">
                <td class="p-4 font-semibold">{{ ucfirst($a->type) }}</td>
                <td class="p-4 text-stone-300">{{ $a->address }}</td>
                <td class="p-4">{{ number_format($a->price,2) }} euro</td>
                <td class="p-4">{{ $a->area }} sq.m</td>
                <td class="p-4">
                    @if($a->isOccupied())
                        <span class="px-3 py-1 text-xs bg-rose-500/20 text-rose-300 rounded-full">Occupied</span>
                    @else
                        <span class="px-3 py-1 text-xs bg-emerald-500/20 text-emerald-300 rounded-full">Available</span>
                    @endif
                </td>
                <td class="p-4 text-right">
                    <div class="flex justify-end gap-2">
                        <a href="{{ route('admin.apartments.edit', $a) }}"
                           class="px-3 py-1 bg-white/10 text-stone-200 rounded-lg text-sm">
                            Edit
                        </a>
                        <form method="POST" action="{{ route('admin.apartments.destroy', $a) }}">
                            @csrf @method('DELETE')
                            <button onclick="return confirm('Are you sure?')"
                                    class="px-3 py-1 bg-red-600 text-white rounded-lg text-sm">
                                Delete
                            </button>
                        </form>
                    </div>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
@endsection


