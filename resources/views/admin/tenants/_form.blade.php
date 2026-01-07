<div class="grid grid-cols-1 md:grid-cols-2 gap-6">
    <div>
        <label class="block text-sm font-medium mb-1">Name</label>
        <input
            class="w-full border rounded-lg p-3"
            name="name"
            value="{{ old('name', $tenant->name ?? '') }}"
            required
        >
    </div>

    <div>
        <label class="block text-sm font-medium mb-1">Email</label>
        <input
            class="w-full border rounded-lg p-3"
            type="email"
            name="email"
            value="{{ old('email', $tenant->email ?? '') }}"
            required
        >
    </div>

    <div>
        <label class="block text-sm font-medium mb-1">Password</label>
        <input
            class="w-full border rounded-lg p-3"
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
        <label class="text-sm font-medium">Administrator</label>
    </div>
</div>
