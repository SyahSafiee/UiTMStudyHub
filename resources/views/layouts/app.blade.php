<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>UiTM StudyHub</title>
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-50 flex">

    {{-- SIDEBAR --}}
    <aside class="w-64 bg-uitm-blue text-white min-h-screen fixed flex flex-col shadow-xl z-20">
        <div class="p-8">
            <h1 class="font-extrabold text-2xl tracking-tighter">UiTM <span class="text-uitm-gold">StudyHub</span></h1>
            <p class="text-[10px] uppercase tracking-widest text-blue-200 mt-1">Collaborative Platform</p>
        </div>

        <nav class="flex-1 px-4 space-y-2">
            <a href="{{ route('resources.index') }}"
            class="flex items-center gap-3 px-4 py-3 rounded-xl transition {{ request()->is('library') || request()->is('/') ? 'bg-white/10 border-l-4 border-uitm-gold font-bold text-white' : 'text-blue-100 hover:bg-white/5' }}">
                Resource Library
            </a>

            <a href="{{ route('flashcards.index') }}"
            class="flex items-center gap-3 px-4 py-3 rounded-xl transition {{ request()->is('flashcards*') ? 'bg-white/10 border-l-4 border-uitm-gold font-bold text-white' : 'text-blue-100 hover:bg-white/5' }}">
                Flashcards
            </a>

            @auth
            <a href="{{ route('resources.my-uploads') }}"
            class="flex items-center gap-3 px-4 py-3 rounded-xl transition {{ request()->is('my-uploads*') ? 'bg-white/10 border-l-4 border-uitm-gold font-bold text-white' : 'text-blue-100 hover:bg-white/5' }}">
                My Uploads
            </a>
            @endauth
        </nav>

        <div class="p-4 border-t border-blue-900/10">
            <p class="text-[10px] text-center text-blue-300/50">© 2026 UiTM StudyHub</p>
        </div>
    </aside>

    {{-- MAIN CONTENT --}}
    <main class="flex-1 ml-64 min-h-screen relative">
        <header class="bg-white border-b border-gray-100 p-6 flex justify-between items-center sticky top-0 z-10">
            
            {{-- SEARCH BAR --}}
            <form action="{{ request()->is('flashcards*') ? route('flashcards.index') : route('resources.index') }}"
                  method="GET"
                  class="w-1/2 relative">
                
                <input type="text"
                    name="search"
                    value="{{ request('search') }}"
                    placeholder="{{ request()->is('flashcards*') ? 'Search Flashcards...' : 'Search Resources...' }}"
                    class="w-full bg-gray-50 border-gray-200 rounded-xl px-4 py-2 text-sm focus:ring-uitm-blue focus:border-uitm-blue transition-all">
                    
                <svg class="w-5 h-5 text-gray-400 absolute right-3 top-2.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
            </form>

            {{-- USER PROFILE / LOGIN SECTION --}}
            <div class="flex items-center gap-4">
                
                @auth
                    {{-- JIKA SUDAH LOGIN: Tunjuk Profile & Logout --}}
                    <div class="relative" x-data="{ open: false }">
                        <button @click="open = !open" @click.away="open = false" class="flex items-center gap-4 focus:outline-none group">
                            <div class="text-right hidden md:block">
                                <span class="block text-sm font-bold text-gray-700 group-hover:text-uitm-blue transition">{{ Auth::user()->name }}</span>
                                <span class="block text-xs text-gray-400 capitalize">{{ Auth::user()->role ?? 'Student' }}</span>
                            </div>
                            <div class="w-10 h-10 bg-uitm-violet rounded-full flex items-center justify-center text-white font-bold shadow-sm group-hover:scale-105 transition transform ring-2 ring-white">
                                {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                            </div>
                        </button>

                        {{-- Dropdown Menu --}}
                        <div x-show="open"
                             x-transition:enter="transition ease-out duration-100"
                             x-transition:enter-start="transform opacity-0 scale-95"
                             x-transition:enter-end="transform opacity-100 scale-100"
                             class="absolute right-0 mt-2 w-48 bg-white border border-gray-100 rounded-xl shadow-xl py-2 z-50"
                             style="display: none;">
                            
                            <a href="{{ route('profile.edit') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-50 hover:text-uitm-blue font-medium">My Profile</a>
                            <a href="{{ route('settings.edit') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-50 hover:text-uitm-blue border-b border-gray-50">Settings</a>

                            @if(Auth::user()->role === 'admin')
                                <a href="{{ route('admin.dashboard') }}" class="block px-4 py-2 text-sm text-uitm-blue font-bold hover:bg-blue-50">
                                    🛡️ Admin Dashboard
                                </a>
                            @endif

                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="w-full text-left px-4 py-2 text-sm text-red-500 hover:bg-red-50 font-bold flex items-center gap-2">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path></svg>
                                    Logout
                                </button>
                            </form>
                        </div>
                    </div>
                @else
                    {{-- JIKA BELUM LOGIN: Tunjuk Button Hijau --}}
                    <a href="{{ route('login') }}" class="bg-green-500 text-white px-6 py-2.5 rounded-xl font-bold hover:bg-green-600 transition shadow-lg shadow-green-200 flex items-center gap-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"></path></svg>
                        Login
                    </a>
                @endauth

            </div>
        </header>

        <div class="p-8">
            @yield('content')
        </div>
    </main>
</body>
</html>
