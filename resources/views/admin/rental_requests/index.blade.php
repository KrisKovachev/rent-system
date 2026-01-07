@extends('layouts.admin')

@section('content')
<div class="max-w-7xl mx-auto space-y-6">

    <h1 class="text-2xl font-bold">Rental Requests</h1>

    @foreach($requests as $request)
        <div class="bg-white rounded-xl shadow p-6 flex justify-between items-center">

            <div>
                <p class="font-semibold">
                    {{ $request->apartment->address }}
                </p>
                <p class="text-sm text-gray-500">
                    Requested by {{ $request->user->name }}
                </p>
                <p class="text-sm">
                    {{ $request->start_date }}
                    @if($request->end_date)
                        → {{ $request->end_date }}
                    @endif
                </p>

                <span class="inline-block mt-2 px-3 py-1 text-sm rounded-full
                    {{ $request->status === 'pending' ? 'bg-yellow-100 text-yellow-700' :
                       ($request->status === 'approved' ? 'bg-green-100 text-green-700' :
                        'bg-red-100 text-red-700') }}">
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
                        <button class="px-4 py-2 rounded-lg bg-red-600 text-white hover:bg-red-700">
                            Reject
                        </button>
                    </form>
                </div>
            @endif
        </div>
    @endforeach

</div>
@endsection
