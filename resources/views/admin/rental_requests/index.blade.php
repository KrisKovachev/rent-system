@extends('layouts.admin')

@section('content')
<div class="max-w-7xl mx-auto space-y-6">

    <h1 class="text-2xl font-bold">Rental Requests</h1>

    @foreach($requests as $request)
        <div class="glass-card p-6 flex justify-between items-center">

            <div>
                <p class="font-semibold">
                    {{ $request->apartment->address }}
                </p>
                <p class="text-sm text-stone-400">
                    Requested by {{ $request->tenant?->name }}
                </p>
                <p class="text-sm text-stone-300">
                    {{ $request->start_date }}
                    @if($request->end_date)
                        → {{ $request->end_date }}
                    @endif
                </p>

                <span class="inline-block mt-2 px-3 py-1 text-sm rounded-full
                    {{ $request->status === 'pending' ? 'bg-amber-500/20 text-amber-300' :
                       ($request->status === 'approved' ? 'bg-emerald-500/20 text-emerald-300' :
                        'bg-rose-500/20 text-rose-300') }}">
                    {{ ucfirst($request->status) }}
                </span>
            </div>

            @if($request->status === 'pending')
                <div class="flex gap-2">
                    <form method="POST"
                          action="{{ route('admin.rental-requests.approve', $request) }}">
                        @csrf
                        <button class="px-4 py-2 rounded-lg bg-emerald-600 text-white hover:bg-emerald-700">
                            Approve
                        </button>
                    </form>

                    <form method="POST"
                          action="{{ route('admin.rental-requests.reject', $request) }}">
                        @csrf
                        <button class="px-4 py-2 rounded-lg bg-rose-600 text-white hover:bg-rose-500">
                            Reject
                        </button>
                    </form>
                </div>
            @endif
        </div>
    @endforeach

</div>
@endsection

