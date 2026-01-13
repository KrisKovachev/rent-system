@extends('layouts.admin')

@section('content')
<div class="max-w-3xl mx-auto">
    <h1 class="text-3xl font-bold mb-6">Create Tenant</h1>

    <form method="POST" action="{{ route('admin.tenants.store') }}"
          class="glass-card p-8">
        @csrf

        @include('admin.tenants._form', ['tenant' => null])

        <div class="mt-8 flex justify-end gap-3">
            <a href="{{ route('admin.tenants.index') }}"
               class="px-5 py-2 bg-white/10 text-stone-200 rounded-lg">
                Cancel
            </a>
            <button class="px-6 py-2 bg-emerald-600 text-white rounded-lg">
                Save Tenant
            </button>
        </div>
    </form>
</div>
@endsection

