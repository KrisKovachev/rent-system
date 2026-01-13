<div class="grid grid-cols-1 md:grid-cols-2 gap-6">
    <div>
        <label class="glass-label">Name</label>
        <input
            class="glass-input"
            name="name"
            value="{{ old('name', $tenant->name ?? '') }}"
            required
        >
    </div>

    <div>
        <label class="glass-label">Email</label>
        <input
            class="glass-input"
            type="email"
            name="email"
            value="{{ old('email', $tenant->email ?? '') }}"
            required
        >
    </div>

    <div>
        <label class="glass-label">Password</label>
        <input
            class="glass-input"
            type="password"
            name="password"
            placeholder="Leave empty to keep current password"
        >
    </div>

    <div class="flex items-center gap-2 mt-6">
        <input
            type="checkbox"
            name="is_admin"
            value="1"
            @checked(old('is_admin', $tenant->is_admin ?? false))
        >
        <label class="text-sm font-medium text-stone-300">Administrator</label>
    </div>
</div>

