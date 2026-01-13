<!doctype html>
<html lang="bg">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>RentSystem</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700&family=Space+Mono:wght@400;700&display=swap">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-screen bg-[#0a0f0d] text-stone-100 font-['Outfit']">
    <div class="fixed inset-0 -z-20 bg-[linear-gradient(135deg,#0d1a14_0%,#132419_50%,#1a2e23_100%)]"></div>
    <div class="fixed -z-10 left-[10%] top-[10%] h-[320px] w-[320px] rounded-full bg-emerald-500/40 blur-[90px]"></div>
    <div class="fixed -z-10 right-[10%] top-[60%] h-[300px] w-[300px] rounded-full bg-amber-400/35 blur-[90px]"></div>
    <div class="fixed -z-10 left-[30%] bottom-[10%] h-[280px] w-[280px] rounded-full bg-rose-400/25 blur-[100px]"></div>

    <div class="min-h-screen flex items-center justify-center px-6">
        <div class="w-full max-w-md glass-card-lg p-8">
            <div class="mb-6 text-center">
                <h1 class="text-3xl font-bold tracking-tight">RentSystem</h1>
                <p class="text-stone-400 mt-1">@yield('subtitle')</p>
            </div>

            @if($errors->any())
                <div class="mb-4 p-3 bg-rose-500/15 border border-rose-500/30 rounded-xl text-sm text-rose-200">
                    <ul class="list-disc pl-5">
                        @foreach($errors->all() as $e)
                            <li>{{ $e }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            @yield('content')
        </div>
    </div>

</body>
</html>
