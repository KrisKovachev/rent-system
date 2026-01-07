@extends('layouts.app')

@section('content')
<div class="max-w-3xl mx-auto">
    <h1 class="text-3xl font-bold mb-6">Create Rental Agreement</h1>

    <form method="POST" action="{{ route('admin.rentals.store') }}"
          class="bg-white border rounded-2xl p-8 shadow-sm">
        @csrf

        @include('admin.rentals._form', ['rental' => null])

        <div class="mt-8 flex justify-end gap-3">
            <a href="{{ route('admin.rentals.index') }}"
               class="px-5 py-2 bg-gray-200 rounded-lg">
                Cancel
            </a>
            <button class="px-6 py-2 bg-black text-white rounded-lg">
                Save Agreement
            </button>
        </div>
    </form>
</div>
@endsection
