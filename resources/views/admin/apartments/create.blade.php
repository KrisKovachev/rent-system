@extends('layouts.admin')

@section('content')
<div class="max-w-3xl mx-auto">
    <h1 class="text-3xl font-bold mb-6">Create Property</h1>

    <form method="POST" action="{{ route('admin.apartments.store') }}"
          class="glass-card p-8">
        @csrf

        @include('admin.apartments._form')

        <div class="mt-8 flex justify-end gap-3">
            <a href="{{ route('admin.apartments.index') }}"
               class="px-5 py-2 bg-white/10 text-stone-200 rounded-lg">
                Cancel
            </a>
            <button class="px-6 py-2 bg-emerald-600 text-white rounded-lg">
                Save Property
            </button>
        </div>
    </form>
</div>
@endsection

