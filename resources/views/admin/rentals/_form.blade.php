<div class="grid grid-cols-1 md:grid-cols-2 gap-6">
    <div>
        <label class="block text-sm font-medium mb-1">Property</label>
        <select class="w-full border rounded-lg p-3" name="apartment_id" required>
            @foreach($apartments as $a)
                <option value="{{ $a->id }}"
                    @selected(old('apartment_id', $rental->apartment_id ?? null) == $a->id)>
                    {{ $a->address }} ({{ ucfirst($a->type) }})
                </option>
            @endforeach
        </select>
    </div>

    <div>
        <label class="block text-sm font-medium mb-1">Tenant</label>
        <select class="w-full border rounded-lg p-3" name="user_id" required>
            @foreach($tenants as $t)
                <option value="{{ $t->id }}"
                    @selected(old('user_id', $rental->user_id ?? null) == $t->id)>
                    {{ $t->name }} ({{ $t->email }})
                </option>
            @endforeach
        </select>
    </div>

    <div>
        <label class="block text-sm font-medium mb-1">Start Date</label>
        <input
            class="w-full border rounded-lg p-3"
            type="date"
            name="start_date"
            value="{{ old('start_date', $rental->start_date ?? '') }}"
            required
        >
    </div>

    <div>
        <label class="block text-sm font-medium mb-1">End Date</label>
        <input
            class="w-full border rounded-lg p-3"
            type="date"
            name="end_date"
            value="{{ old('end_date', $rental->end_date ?? '') }}"
        >
    </div>
</div>
