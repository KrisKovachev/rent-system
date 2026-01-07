<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin | RentSystem</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-gray-100 text-gray-900">

<!-- Top Navbar -->
<header class="bg-white border-b shadow-sm">
    <div class="max-w-7xl mx-auto px-6 py-4 flex items-center justify-between">
        <div class="flex items-center gap-8">
            <span class="text-xl font-bold text-indigo-600">🏢 RentSystem</span>

            <nav class="flex gap-6 text-sm font-medium">
                <a href="{{ route('admin.dashboard') }}" class="hover:text-indigo-600">Dashboard</a>
                <a href="{{ route('admin.apartments.index') }}" class="hover:text-indigo-600">Apartments</a>
                <a href="{{ route('admin.rentals.index') }}" class="hover:text-indigo-600">Rentals</a>
                <a href="{{ route('admin.tenants.index') }}" class="hover:text-indigo-600">Tenants</a>
            </nav>
        </div>

        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button class="text-sm text-red-600 hover:underline">
                Logout
            </button>
        </form>
    </div>
</header>

<!-- Page Content -->
<main class="max-w-7xl mx-auto px-6 py-10">
    @yield('content')
</main>

</body>
</html>
