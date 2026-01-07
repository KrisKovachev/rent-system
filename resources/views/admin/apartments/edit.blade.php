@extends('layouts.app')

@section('content')
<div class="max-w-5xl mx-auto space-y-8">

    <div>
        <h1 class="text-2xl font-bold">Edit Apartment</h1>
        <p class="text-gray-500">Update apartment details and manage images</p>
    </div>

    <form method="POST"
          action="{{ route('admin.apartments.update', $apartment) }}"
          enctype="multipart/form-data"
          class="bg-white rounded-2xl shadow p-8 space-y-6">

        @csrf
        @method('PUT')

        <div class="grid md:grid-cols-2 gap-6">
            <div>
                <label class="label">Type</label>
                <input name="type" class="input" value="{{ old('type', $apartment->type) }}" required>
            </div>

            <div>
                <label class="label">Address</label>
                <input name="address" class="input" value="{{ old('address', $apartment->address) }}" required>
            </div>

            <div>
                <label class="label">Area (sq.m)</label>
                <input type="number" name="area" class="input" value="{{ old('area', $apartment->area) }}" required>
            </div>

            <div>
                <label class="label">Price (€)</label>
                <input type="number" step="0.01" name="price" class="input" value="{{ old('price', $apartment->price) }}" required>
            </div>
        </div>

        {{-- Images --}}
        <div>
            <label class="label">Add Images</label>
            <input type="file" name="images[]" multiple
                   class="block w-full border rounded-lg p-2">
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
               class="px-6 py-2 rounded-lg border">
                Cancel
            </a>

            <button class="px-6 py-2 bg-black text-white rounded-lg hover:bg-gray-800">
                Save Changes
            </button>
        </div>
    </form>
</div>
@endsection
