<button {{ $attributes->merge(['type' => 'button', 'class' => 'inline-flex items-center justify-center rounded-xl px-4 py-2 text-xs font-semibold uppercase tracking-widest bg-white/10 text-stone-200 hover:bg-white/20 focus:outline-none disabled:opacity-25 transition']) }}>
    {{ $slot }}
</button>
