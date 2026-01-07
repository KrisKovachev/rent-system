<form method="POST" action="{{ route('rental-requests.store', $apartment) }}">
    @csrf
    <input type="date" name="start_date" required>
    <input type="date" name="end_date">
    <textarea name="message"></textarea>
    <button class="btn">Request rental</button>
</form>
