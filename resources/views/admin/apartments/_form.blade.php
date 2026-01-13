<div class="grid grid-cols-1 md:grid-cols-2 gap-6">
    <div>
        <label class="glass-label">Type</label>
        <input
            class="glass-input"
            name="type"
            value="{{ old('type', $apartment->type ?? '') }}"
            placeholder="apartment / house / studio"
            required
        >
    </div>

    <div>
        <label class="glass-label">Monthly Price</label>
        <input
            class="glass-input"
            type="number"
            step="0.01"
            name="price"
            value="{{ old('price', $apartment->price ?? '') }}"
            required
        >
    </div>

    <div class="md:col-span-2">
        <label class="glass-label">Address</label>
        <input
            class="glass-input"
            name="address"
            value="{{ old('address', $apartment->address ?? '') }}"
            required
        >
    </div>

    <div>
        <label class="glass-label">Area (sqm)</label>
        <input
            class="glass-input"
            type="number"
            name="area"
            value="{{ old('area', $apartment->area ?? '') }}"
            required
        >
    </div>
</div>

