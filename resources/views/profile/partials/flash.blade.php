@if(session('success'))
    <div class="mb-6 rounded-xl bg-emerald-500/15 border border-emerald-500/30 px-5 py-3 text-sm text-emerald-200">
        {{ session('success') }}
    </div>
@endif

@if(session('error'))
    <div class="mb-6 rounded-xl bg-rose-500/15 border border-rose-500/30 px-5 py-3 text-sm text-rose-200">
        {{ session('error') }}
    </div>
@endif

@if($errors->any())
    <div class="mb-6 rounded-xl bg-rose-500/15 border border-rose-500/30 px-5 py-3 text-rose-200">
        <ul class="list-disc pl-6 text-sm space-y-1">
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
