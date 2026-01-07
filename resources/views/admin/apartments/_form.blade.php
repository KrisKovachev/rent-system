<div class="grid grid-cols-1 md:grid-cols-2 gap-6">
    <div>
        <label class="block text-sm font-medium mb-1">Type</label>
        <input
            class="w-full border rounded-lg p-3"
            name="type"
            value="{{ old('type', $apartment->type ?? '') }}"
            placeholder="apartment / house / studio"
            required
        >
    </div>

    <div>
        <label class="block text-sm font-medium mb-1">Monthly Price</label>
        <input
            class="w-full border rounded-lg p-3"
            type="number"
            step="0.01"
            name="price"
            value="{{ old('price', $apartment->price ?? '') }}"
            required
        >
    </div>

    <div class="md:col-span-2">
        <label class="block text-sm font-medium mb-1">Address</label>
        <input
            class="w-full border rounded-lg p-3"
            name="address"
            value="{{ old('address', $apartment->address ?? '') }}"
            required
        >
    </div>

    <div>
        <label class="block text-sm font-medium mb-1">Area (sqm)</label>
        <input
            class="w-full border rounded-lg p-3"
            type="number"
            name="area"
            value="{{ old('area', $apartment->area ?? '') }}"
            required
        >
    </div>
</div>
