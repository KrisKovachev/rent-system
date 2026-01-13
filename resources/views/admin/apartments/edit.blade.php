@extends('layouts.admin')

@section('content')
<div class="max-w-5xl mx-auto space-y-8">

    <div>
        <h1 class="text-2xl font-bold">Edit Apartment</h1>
        <p class="text-stone-400">Update apartment details and manage images</p>
    </div>

    <form method="POST"
          action="{{ route('admin.apartments.update', $apartment) }}"
          enctype="multipart/form-data"
          class="glass-card p-8 space-y-6">

        @csrf
        @method('PUT')

        <div class="grid md:grid-cols-2 gap-6">
            <div>
                <label class="glass-label">Type</label>
                <input name="type" class="glass-input" value="{{ old('type', $apartment->type) }}" required>
            </div>

            <div>
                <label class="glass-label">Address</label>
                <input name="address" class="glass-input" value="{{ old('address', $apartment->address) }}" required>
            </div>

            <div>
                <label class="glass-label">Area (sq.m)</label>
                <input type="number" name="area" class="glass-input" value="{{ old('area', $apartment->area) }}" required>
            </div>

            <div>
                <label class="glass-label">Price (€)</label>
                <input type="number" step="0.01" name="price" class="glass-input" value="{{ old('price', $apartment->price) }}" required>
            </div>
        </div>

        {{-- Images --}}
        <div>
            <label class="glass-label">Add Images</label>
            <input type="file" name="images[]" multiple
                   class="glass-input">
        </div>

        {{-- Existing images --}}
        @if($apartment->images->count())
            <div>
                <p class="font-medium mb-3">Current Images</p>
                <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                    @foreach($apartment->images as $img)
                        <div class="relative group">
                            <img src="{{ asset('storage/'.$img->path) }}"
                                 class="rounded-lg object-cover h-32 w-full">
                        </div>
                    @endforeach
                </div>
            </div>
        @endif

        <div class="flex justify-end gap-4 pt-6">
            <a href="{{ route('admin.apartments.index') }}"
               class="px-6 py-2 rounded-lg border border-white/10 text-stone-200 bg-white/10">
                Cancel
            </a>

            <button class="px-6 py-2 bg-emerald-600 text-white rounded-lg hover:bg-emerald-500">
                Save Changes
            </button>
        </div>
    </form>
</div>
@endsection


