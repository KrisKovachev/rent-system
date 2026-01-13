@extends('layouts.app')

@section('content')
<div class="max-w-5xl mx-auto px-6 py-12 space-y-10">

    {{-- Header --}}
    <div class="flex items-center justify-between">
        <div>
            <h1 class="text-4xl font-extrabold tracking-tight text-stone-100">
                Edit Property
            </h1>
            <p class="mt-2 text-stone-400">
                Update details, pricing and photos
            </p>
        </div>

        <a href="{{ route('apartments.my') }}"
           class="text-sm font-medium text-stone-400 hover:text-white transition">
            ← Back to My Properties
        </a>
    </div>

    {{-- Card --}}
    <div class="glass-card p-10 space-y-10">

        <form method="POST"
              action="{{ route('apartments.update', $apartment) }}"
              enctype="multipart/form-data"
              class="space-y-10">
            @csrf
            @method('PUT')

            {{-- BASIC INFO --}}
            <div>
                <h2 class="text-sm font-semibold tracking-wide text-stone-500 uppercase mb-4">
                    Basic information
                </h2>

                <div class="grid md:grid-cols-2 gap-6">
                    <div>
                        <label class="glass-label">Type</label>
                        <input
                            name="type"
                            value="{{ old('type', $apartment->type) }}"
                            class="glass-input">
                    </div>

                    <div>
                        <label class="glass-label">Address</label>
                        <input
                            name="address"
                            value="{{ old('address', $apartment->address) }}"
                            class="glass-input">
                    </div>
                </div>
            </div>

            {{-- SIZE & PRICE --}}
            <div>
                <h2 class="text-sm font-semibold tracking-wide text-stone-500 uppercase mb-4">
                    Size & price
                </h2>

                <div class="grid md:grid-cols-2 gap-6">
                    <div>
                        <label class="glass-label">Area (m²)</label>
                        <input
                            name="area"
                            type="number"
                            value="{{ old('area', $apartment->area) }}"
                            class="glass-input">
                    </div>

                    <div>
                        <label class="glass-label">Price / month (€)</label>
                        <input
                            name="price"
                            type="number"
                            step="0.01"
                            value="{{ old('price', $apartment->price) }}"
                            class="glass-input">
                    </div>
                </div>
            </div>

            {{-- IMAGES --}}
            <div>
                <h2 class="text-sm font-semibold tracking-wide text-stone-500 uppercase mb-4">
                    Photos
                </h2>

                {{-- Upload --}}
                <div class="border-2 border-dashed border-white/20 rounded-2xl p-6 text-center hover:border-white/40 transition">
                    <input type="file" name="images[]" multiple class="hidden" id="imagesInput">

                    <label for="imagesInput" class="cursor-pointer inline-flex flex-col items-center gap-2">
                        <div class="h-12 w-12 rounded-full bg-emerald-600 text-white flex items-center justify-center text-xl">
                            ＋
                        </div>
                        <p class="text-sm font-medium">Click to upload images</p>
                        <p class="text-xs text-stone-500">JPG, PNG — multiple files allowed</p>
                    </label>
                </div>

                {{-- Existing images --}}
                @if($apartment->images->count())
                    <div class="mt-6 grid sm:grid-cols-2 md:grid-cols-3 gap-4">
                        @foreach($apartment->images as $img)
                            <div class="group relative rounded-xl overflow-hidden shadow-sm">
                                <img
                                    src="{{ asset('storage/'.$img->path) }}"
                                    class="w-full h-40 object-cover group-hover:scale-105 transition duration-300">

                                <div class="absolute inset-0 bg-black/50 opacity-0 group-hover:opacity-100 transition
                                            flex items-center justify-center">
                                    <form method="POST"
                                          action="{{ route('apartments.images.destroy', [$apartment, $img]) }}"
                                          onsubmit="return confirm('Delete this image?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                                class="px-4 py-2 bg-red-600 text-white text-sm rounded-xl
                                                       hover:bg-red-700 hover:scale-105 transition">
                                            Delete
                                        </button>
                                    </form>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>

            {{-- ACTIONS --}}
            <div class="flex items-center justify-between pt-6 border-t border-white/10">
                <a href="{{ route('apartments.my') }}"
                   class="text-sm font-medium text-stone-400 hover:text-white transition">
                    Cancel
                </a>

                <button
                    class="px-8 py-3 rounded-xl bg-emerald-600 text-white font-medium
                           hover:bg-emerald-500 hover:scale-[1.02] active:scale-[0.97] transition-all">
                    Update Property
                </button>
            </div>

        </form>
    </div>

</div>
@endsection

