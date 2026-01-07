<!doctype html>
<html lang="bg">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>RentSystem</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-screen bg-gradient-to-br from-gray-900 to-black flex items-center justify-center">

<div class="w-full max-w-md bg-white rounded-2xl shadow-xl p-8">
    <div class="mb-6 text-center">
        <h1 class="text-3xl font-bold tracking-tight">🏠 RentSystem</h1>
        <p class="text-gray-600 mt-1">@yield('subtitle')</p>
    </div>

    @if($errors->any())
        <div class="mb-4 p-3 bg-red-100 border border-red-300 rounded text-sm">
            <ul class="list-disc pl-5">
                @foreach($errors->all() as $e)
                    <li>{{ $e }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    @yield('content')
</div>

</body>
</html>
