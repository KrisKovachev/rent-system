@extends('layouts.app')

@section('content')
<div class="max-w-3xl mx-auto">

    {{-- Header --}}
    <div class="mb-8">
        <h1 class="text-3xl font-semibold mb-1">Add new apartment</h1>
        <p class="text-gray-500">Fill in the details below.</p>
    </div>

    {{-- Form --}}
    <form method="POST"
          action="{{ route('apartments.store') }}"
          enctype="multipart/form-data"
          class="bg-white border rounded-xl shadow-sm p-8 space-y-6">

        @csrf

        {{-- Type --}}
        <div>
            <label class="block text-sm font-medium mb-1">Type</label>
            <input name="type" required
                   value="{{ old('type') }}"
                   placeholder="Apartment"
                   class="w-full border rounded-lg px-4 py-2 focus:ring focus:ring-black/10">
        </div>

        {{-- Address --}}
        <div>
            <label class="block text-sm font-medium mb-1">Address</label>
            <input name="address" required
                   value="{{ old('address') }}"
                   placeholder="City, street, number"
                   class="w-full border rounded-lg px-4 py-2 focus:ring focus:ring-black/10">
        </div>

        {{-- Area & Price --}}
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <label class="block text-sm font-medium mb-1">Area (m²)</label>
                <input name="area" type="number" required
                       value="{{ old('area') }}"
                       class="w-full border rounded-lg px-4 py-2 focus:ring focus:ring-black/10">
            </div>

            <div>
                <label class="block text-sm font-medium mb-1">Price (€)</label>
                <input name="price" type="number" step="0.01" required
                       value="{{ old('price') }}"
                       class="w-full border rounded-lg px-4 py-2 focus:ring focus:ring-black/10">
            </div>
        </div>

        {{-- Images --}}
        <div>
            <label class="block text-sm font-medium mb-2">Photos</label>
            <input type="file"
                   name="images[]"
                   multiple
                   class="block w-full text-sm
                          file:mr-4 file:py-2 file:px-4
                          file:rounded-lg file:border-0
                          file:bg-gray-100 file:text-gray-700
                          hover:file:bg-gray-200">
            <p class="text-sm text-gray-500 mt-1">
                You can upload multiple images.
            </p>
        </div>

        {{-- Actions --}}
        <div class="flex justify-between items-center pt-4">
            <a href="{{ route('apartments.my') }}"
               class="text-gray-500 hover:text-black">
                ← Back
            </a>

            <button class="px-6 py-2 bg-black text-white rounded-lg hover:bg-gray-800">
                Save apartment
            </button>
        </div>

    </form>
</div>
@endsection
