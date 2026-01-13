<button {{ $attributes->merge(['type' => 'submit', 'class' => 'inline-flex items-center justify-center rounded-xl px-4 py-2 text-xs font-semibold uppercase tracking-widest bg-emerald-600 text-white hover:bg-emerald-500 focus:outline-none transition']) }}>
    {{ $slot }}
</button>
