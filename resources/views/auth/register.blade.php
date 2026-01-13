@extends('layouts.guest')

@section('content')
<div class="text-center mb-8">
    <div class="text-3xl font-extrabold tracking-tight flex items-center justify-center gap-2">
        <span>RentSystem</span>
    </div>
    <p class="text-sm text-stone-400 mt-1">
        Create your account
    </p>
</div>

@if ($errors->any())
    <div class="mb-4 rounded-xl bg-rose-500/15 border border-rose-500/30 p-4 text-sm text-rose-200">
        {{ $errors->first() }}
    </div>
@endif

<form method="POST" action="{{ route('register') }}" class="space-y-5">
    @csrf

    <div>
        <label class="glass-label">Username</label>
        <input
            name="name"
            required
            class="glass-input">
    </div>

    <div>
        <label class="glass-label">Email</label>
        <input
            type="email"
            name="email"
            required
            class="glass-input">
    </div>

    <div>
        <label class="glass-label">Password</label>
        <input
            type="password"
            name="password"
            required
            class="glass-input">
    </div>

    <div>
        <label class="glass-label">Confirm Password</label>
        <input
            type="password"
            name="password_confirmation"
            required
            class="glass-input">
    </div>

    <button class="w-full mt-4 py-3 rounded-xl bg-emerald-600 text-white font-medium hover:bg-emerald-500 transition">
        Register
    </button>
</form>

<p class="text-sm text-center text-stone-400 mt-6">
    Have an account?
    <a href="{{ route('login') }}" class="font-medium text-emerald-300 hover:underline">
        Login
    </a>
</p>
@endsection
