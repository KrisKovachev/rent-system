@if(session('success'))
    <div class="mb-6 rounded-xl bg-green-100 border border-green-300 px-5 py-3 text-sm">
        {{ session('success') }}
    </div>
@endif

@if(session('error'))
    <div class="mb-6 rounded-xl bg-red-100 border border-red-300 px-5 py-3 text-sm">
        {{ session('error') }}
    </div>
@endif

@if($errors->any())
    <div class="mb-6 rounded-xl bg-red-100 border border-red-300 px-5 py-3">
        <ul class="list-disc pl-6 text-sm space-y-1">
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
