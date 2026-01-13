@extends('layouts.admin')

@section('content')
<div class="max-w-3xl mx-auto">
    <div class="glass-card p-8">
        <form method="POST" action="{{ route('rental-requests.store', $apartment) }}" class="space-y-4">
            @csrf
            <div>
                <label class="glass-label">Start date</label>
                <input type="date" name="start_date" required class="glass-input">
            </div>
            <div>
                <label class="glass-label">End date</label>
                <input type="date" name="end_date" class="glass-input">
            </div>
            <div>
                <label class="glass-label">Message</label>
                <textarea name="message" class="glass-input" rows="4"></textarea>
            </div>
            <button class="glass-button-primary">
                Request rental
            </button>
        </form>
    </div>
</div>
@endsection
