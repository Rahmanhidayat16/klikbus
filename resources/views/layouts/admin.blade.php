<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Bus Lampung</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100 font-sans">

<div class="flex min-h-screen">

    {{-- SIDEBAR --}}
    <aside class="w-64 bg-gray-900 text-white flex flex-col fixed h-full">
        {{-- Logo --}}
        <div class="px-6 py-5 border-b border-gray-700">
            <h1 class="text-xl font-bold text-white">🚌 Bus Lampung</h1>
            <p class="text-xs text-gray-400 mt-1">Panel Admin</p>
        </div>

        {{-- Menu --}}
        <nav class="flex-1 px-4 py-4 space-y-1">

            <a href="{{ route('admin.dashboard') }}"
               class="flex items-center gap-3 px-3 py-2 rounded-lg text-sm
               {{ request()->routeIs('admin.dashboard') ? 'bg-blue-600 text-white' : 'text-gray-300 hover:bg-gray-700' }}">
                <span>🏠</span> Dashboard
            </a>

            <a href="{{ route('admin.bus.index') }}"
               class="flex items-center gap-3 px-3 py-2 rounded-lg text-sm
               {{ request()->routeIs('admin.bus.*') ? 'bg-blue-600 text-white' : 'text-gray-300 hover:bg-gray-700' }}">
                <span>🚌</span> Manajemen Bus
            </a>

            <a href="{{ route('admin.routes.index') }}"
               class="flex items-center gap-3 px-3 py-2 rounded-lg text-sm
               {{ request()->routeIs('admin.routes.*') ? 'bg-blue-600 text-white' : 'text-gray-300 hover:bg-gray-700' }}">
                <span>🗺️</span> Rute Perjalanan
            </a>

            <a href="{{ route('admin.schedules.index') }}"
               class="flex items-center gap-3 px-3 py-2 rounded-lg text-sm
               {{ request()->routeIs('admin.schedules.*') ? 'bg-blue-600 text-white' : 'text-gray-300 hover:bg-gray-700' }}">
                <span>🕐</span> Jadwal
            </a>

            <a href="{{ route('admin.reports.bookings') }}"
               class="flex items-center gap-3 px-3 py-2 rounded-lg text-sm
               {{ request()->routeIs('admin.reports.*') ? 'bg-blue-600 text-white' : 'text-gray-300 hover:bg-gray-700' }}">
                <span>📋</span> Laporan Booking
            </a>

        </nav>

        {{-- Logout --}}
        <div class="px-4 py-4 border-t border-gray-700">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit"
                    class="w-full flex items-center gap-3 px-3 py-2 rounded-lg text-sm text-gray-300 hover:bg-red-600 hover:text-white transition">
                    <span>🚪</span> Logout
                </button>
            </form>
        </div>
    </aside>

    {{-- MAIN CONTENT --}}
    <div class="flex-1 ml-64 flex flex-col">

        {{-- Topbar --}}
        <header class="bg-white shadow px-6 py-4 flex justify-between items-center">
            <h2 class="text-lg font-semibold text-gray-700">@yield('title', 'Dashboard')</h2>
            <div class="text-sm text-gray-500">
                👤 {{ auth()->user()->name ?? 'Admin' }}
            </div>
        </header>

        {{-- Page Content --}}
        <main class="flex-1 p-6">
            @if(session('success'))
                <div class="mb-4 px-4 py-3 bg-green-100 text-green-700 rounded-lg border border-green-300">
                    ✅ {{ session('success') }}
                </div>
            @endif

            @if(session('error'))
                <div class="mb-4 px-4 py-3 bg-red-100 text-red-700 rounded-lg border border-red-300">
                    ❌ {{ session('error') }}
                </div>
            @endif

            @yield('content')
        </main>

        {{-- Footer --}}
        <footer class="px-6 py-3 text-xs text-gray-400 text-center border-t bg-white">
            © {{ date('Y') }} Bus Lampung — Admin Panel
        </footer>

    </div>
</div>

</body>
</html>