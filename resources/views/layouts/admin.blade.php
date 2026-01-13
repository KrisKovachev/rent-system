<!doctype html>
<html lang="en" class="h-full">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>@yield('title', 'Admin')</title>

    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700&family=Space+Mono:wght@400;700&display=swap">
    @vite(['resources/css/app.css','resources/js/app.js'])
</head>
<body class="min-h-screen bg-[#0a0f0d] text-stone-100 font-['Outfit']">
    <!-- background -->
    <div class="fixed inset-0 -z-20 bg-[linear-gradient(135deg,#0d1a14_0%,#132419_50%,#1a2e23_100%)]"></div>
    <div class="fixed -z-10 left-[10%] top-[10%] h-[400px] w-[400px] rounded-full bg-emerald-500/40 blur-[90px]"></div>
    <div class="fixed -z-10 right-[10%] top-[55%] h-[350px] w-[350px] rounded-full bg-amber-400/40 blur-[90px]"></div>
    <div class="fixed -z-10 left-[30%] bottom-[10%] h-[300px] w-[300px] rounded-full bg-rose-400/30 blur-[90px]"></div>

    <div class="min-h-screen flex">
        @include('admin.partials.sidebar')

        <div class="flex-1 lg:pl-[280px]">
            <header class="sticky top-0 z-20 backdrop-blur-xl bg-white/5 border-b border-white/10">
                <div class="px-6 py-4 flex items-center justify-between">
                    <h1 class="text-xl font-semibold">@yield('title', 'Admin')</h1>
                </div>
            </header>

            <main class="px-6 py-8">
                @yield('content')
            </main>
        </div>
    </div>

    <button class="lg:hidden fixed bottom-6 right-6 h-14 w-14 rounded-2xl
                   bg-gradient-to-br from-emerald-500 to-amber-400 text-black
                   shadow-[0_8px_32px_rgba(5,150,105,0.35)]">
        Menu
    </button>
</body>
</html>


