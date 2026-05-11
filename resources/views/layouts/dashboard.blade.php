<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'KlikBus Dashboard')</title>

    {{-- FONT --}}
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    {{-- ICON --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    {{-- TAILWIND --}}
    <script src="https://cdn.tailwindcss.com"></script>

    {{-- VITE --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
        }

        input[type="date"]::-webkit-calendar-picker-indicator {
            opacity: 0;
            position: absolute;
            inset: 0;
            width: 100%;
            cursor: pointer;
        }
        
        /* Custom scrollbar for better UI */
        ::-webkit-scrollbar {
            width: 6px;
        }
        ::-webkit-scrollbar-track {
            background: transparent;
        }
        ::-webkit-scrollbar-thumb {
            background: #cbd5e1;
            border-radius: 10px;
        }
        ::-webkit-scrollbar-thumb:hover {
            background: #94a3b8;
        }
    </style>
    @stack('styles')
</head>

<body class="bg-slate-50 text-slate-800">

<div class="flex min-h-screen relative">

    {{-- ================= SIDEBAR ================= --}}
    <aside class="w-64 min-h-screen bg-white border-r border-slate-200 fixed left-0 top-0 flex flex-col justify-between z-50 shadow-sm">
        <div>
            {{-- LOGO --}}
            <div class="p-6 flex items-center gap-3">
                <div class="w-12 h-12 rounded-xl bg-yellow-400 flex items-center justify-center shadow-lg shadow-yellow-200">
                    <i class="fa-solid fa-bus text-xl text-blue-700"></i>
                </div>
                <div>
                    <h1 class="text-2xl font-black italic text-yellow-400 leading-none">
                        KlikBus.
                    </h1>
                    <p class="text-slate-400 text-xs font-semibold">
                        Travel Lampung
                    </p>
                </div>
            </div>

            {{-- MENU --}}
            <nav class="px-4 mt-6 space-y-2">
                <a href="{{ route('dashboard') }}"
                   class="flex items-center gap-3 px-4 py-3 rounded-2xl font-semibold text-sm transition-all {{ request()->routeIs('dashboard') ? 'bg-blue-600 text-white font-bold shadow-md shadow-blue-200' : 'text-slate-600 hover:bg-slate-50 hover:text-blue-600' }}">
                    <i class="fa-solid fa-house w-5 text-center"></i>
                    Dashboard
                </a>

                <a href="{{ route('bookings.active') }}"
                   class="flex items-center gap-3 px-4 py-3 rounded-2xl font-semibold text-sm transition-all {{ request()->routeIs('bookings.active') ? 'bg-blue-600 text-white font-bold shadow-md shadow-blue-200' : 'text-slate-600 hover:bg-slate-50 hover:text-blue-600' }}">
                    <i class="fa-solid fa-ticket w-5 text-center"></i>
                    Tiket Saya
                </a>

                <a href="{{ route('history.index') }}"
                   class="flex items-center gap-3 px-4 py-3 rounded-2xl font-semibold text-sm transition-all {{ request()->routeIs('history.index') ? 'bg-blue-600 text-white font-bold shadow-md shadow-blue-200' : 'text-slate-600 hover:bg-slate-50 hover:text-blue-600' }}">
                    <i class="fa-solid fa-clock-rotate-left w-5 text-center"></i>
                    Riwayat
                </a>

                <a href="{{ route('profile.edit') }}"
                   class="flex items-center gap-3 px-4 py-3 rounded-2xl font-semibold text-sm transition-all {{ request()->routeIs('profile.edit') ? 'bg-blue-600 text-white font-bold shadow-md shadow-blue-200' : 'text-slate-600 hover:bg-slate-50 hover:text-blue-600' }}">
                    <i class="fa-solid fa-user-pen w-5 text-center"></i>
                    Edit Profil
                </a>
            </nav>
        </div>

        {{-- LOGOUT --}}
        <div class="p-4">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit"
                        class="w-full flex items-center gap-3 text-red-500 hover:bg-red-50 px-4 py-3 rounded-2xl font-bold text-sm transition-all">
                    <i class="fa-solid fa-right-from-bracket w-5 text-center"></i>
                    Keluar
                </button>
            </form>
        </div>
    </aside>

    {{-- ================= MAIN ================= --}}
    <main class="ml-64 flex-1 p-8 min-h-screen max-w-[1600px] mx-auto">
        @yield('content')
    </main>
</div>

@stack('scripts')
</body>
</html>
