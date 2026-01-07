@extends('layouts.guest')

@section('content')
<div class="min-h-screen flex items-center justify-center bg-gradient-to-br from-gray-900 via-black to-gray-800 px-6">

    <div class="w-full max-w-md bg-white/95 backdrop-blur-xl rounded-3xl shadow-2xl p-10
                animate-fade-in">

        {{-- Logo --}}
        <div class="text-center mb-8">
            <div class="text-3xl font-extrabold tracking-tight flex items-center justify-center gap-2">
                🏠 <span>RentSystem</span>
            </div>
            <p class="text-sm text-gray-500 mt-1">
                Вход в системата
            </p>
        </div>

        {{-- Errors --}}
        @if ($errors->any())
            <div class="mb-4 rounded-xl bg-red-50 border border-red-200 p-4 text-sm text-red-700">
                {{ $errors->first() }}
            </div>
        @endif

        <form method="POST" action="{{ route('login') }}" class="space-y-5">
            @csrf

            <div>
                <label class="block text-sm font-medium mb-1">Email</label>
                <input
                    type="email"
                    name="email"
                    required
                    autofocus
                    class="w-full rounded-xl border-gray-300 px-4 py-3
                           focus:border-black focus:ring-black transition">
            </div>

            <div>
                <label class="block text-sm font-medium mb-1">Парола</label>
                <input
                    type="password"
                    name="password"
                    required
                    class="w-full rounded-xl border-gray-300 px-4 py-3
                           focus:border-black focus:ring-black transition">
            </div>

            <button
                class="w-full mt-4 py-3 rounded-xl bg-black text-white font-medium
                       hover:bg-gray-800 hover:scale-[1.02] active:scale-[0.97]
                       transition-all">
                Вход
            </button>
        </form>

        <p class="text-sm text-center text-gray-500 mt-6">
            Нямаш акаунт?
            <a href="{{ route('register') }}" class="font-medium text-black hover:underline">
                Регистрация
            </a>
        </p>
    </div>
</div>

<style>
@keyframes fadeIn {
    from { opacity: 0; transform: translateY(12px); }
    to { opacity: 1; transform: translateY(0); }
}
.animate-fade-in {
    animation: fadeIn .5s ease-out;
}
</style>
@endsection
