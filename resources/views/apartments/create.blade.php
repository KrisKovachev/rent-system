@extends('layouts.app')

@section('content')
<div class="max-w-3xl mx-auto">

    {{-- Header --}}
    <div class="mb-8">
        <h1 class="text-3xl font-semibold mb-1">Add new apartment</h1>
        <p class="text-stone-400">Fill in the details below.</p>
    </div>

    {{-- Form --}}
    <form method="POST"
          action="{{ route('apartments.store') }}"
          enctype="multipart/form-data"
          class="glass-card p-8 space-y-6">

        @csrf

        {{-- Type --}}
        <div>
            <label class="glass-label">Type</label>
            <input name="type" required
                   value="{{ old('type') }}"
                   placeholder="Apartment"
                   class="glass-input">
        </div>

        {{-- Address --}}
        <div>
            <label class="glass-label">Address</label>
            <input name="address" required
                   value="{{ old('address') }}"
                   placeholder="City, street, number"
                   class="glass-input">
        </div>

        {{-- Area & Price --}}
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <label class="glass-label">Area (m²)</label>
                <input name="area" type="number" required
                       value="{{ old('area') }}"
                       class="glass-input">
            </div>

            <div>
                <label class="glass-label">Price (€)</label>
                <input name="price" type="number" step="0.01" required
                       value="{{ old('price') }}"
                       class="glass-input">
            </div>
        </div>

        {{-- Images --}}
        <div>
            <label class="glass-label">Photos</label>
            <input type="file"
                   name="images[]"
                   multiple
                   class="block w-full text-sm text-stone-200
                          file:mr-4 file:py-2 file:px-4
                          file:rounded-xl file:border-0
                          file:bg-emerald-600 file:text-white
                          hover:file:bg-emerald-500">
            <p class="text-sm text-stone-400 mt-1">
                You can upload multiple images.
            </p>
        </div>

        {{-- Actions --}}
        <div class="flex justify-between items-center pt-4">
            <a href="{{ route('apartments.my') }}"
               class="text-stone-400 hover:text-white">
                ← Back
            </a>

            <button class="px-6 py-2 bg-emerald-600 text-white rounded-lg hover:bg-emerald-500">
                Save apartment
            </button>
        </div>

    </form>
</div>
@endsection

