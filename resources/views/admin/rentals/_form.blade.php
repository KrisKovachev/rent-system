<div class="grid grid-cols-1 md:grid-cols-2 gap-6">
    <div>
        <label class="glass-label">Property</label>
        <select class="glass-input" name="apartment_id" required>
            @foreach($apartments as $a)
                <option value="{{ $a->id }}"
                    @selected(old('apartment_id', $rental->apartment_id ?? null) == $a->id)>
                    {{ $a->address }} ({{ ucfirst($a->type) }})
                </option>
            @endforeach
        </select>
    </div>

    <div>
        <label class="glass-label">Tenant</label>
        <select class="glass-input" name="user_id" required>
            @foreach($tenants as $t)
                <option value="{{ $t->id }}"
                    @selected(old('user_id', $rental->user_id ?? null) == $t->id)>
                    {{ $t->name }} ({{ $t->email }})
                </option>
            @endforeach
        </select>
    </div>

    <div>
        <label class="glass-label">Start Date</label>
        <input
            class="glass-input"
            type="date"
            name="start_date"
            value="{{ old('start_date', $rental->start_date ?? '') }}"
            required
        >
    </div>

    <div>
        <label class="glass-label">End Date</label>
        <input
            class="glass-input"
            type="date"
            name="end_date"
            value="{{ old('end_date', $rental->end_date ?? '') }}"
        >
    </div>
</div>

