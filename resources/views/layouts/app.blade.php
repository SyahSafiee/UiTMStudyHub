<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>UiTM StudyHub</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-50 flex">

    <aside class="w-64 bg-uitm-blue text-white min-h-screen fixed flex flex-col shadow-xl">
        <div class="p-8">
            <h1 class="font-extrabold text-2xl tracking-tighter">UiTM <span class="text-uitm-gold">StudyHub</span></h1>
            <p class="text-[10px] uppercase tracking-widest text-blue-200 mt-1">Collaborative Platform</p>
        </div>

        <nav class="flex-1 px-4 space-y-2">
            <a href="/library"
            class="flex items-center gap-3 px-4 py-3 rounded-xl transition {{ request()->is('library') || request()->is('/') ? 'bg-white/10 border-l-4 border-uitm-gold font-bold text-white' : 'text-blue-100 hover:bg-white/5' }}">
                Resource Library
            </a>

            <a href="/flashcards"
            class="flex items-center gap-3 px-4 py-3 rounded-xl transition {{ request()->is('flashcards*') ? 'bg-white/10 border-l-4 border-uitm-gold font-bold text-white' : 'text-blue-100 hover:bg-white/5' }}">
                Flashcards
            </a>

            <a href="{{ route('resources.my-uploads') }}"
            class="flex items-center gap-3 px-4 py-3 rounded-xl transition {{ request()->is('my-uploads*') ? 'bg-white/10 border-l-4 border-uitm-gold font-bold text-white' : 'text-blue-100 hover:bg-white/5' }}">
                My Uploads
            </a>
        </nav>

        <div class="p-4 border-t border-blue-900/50">
            <a href="/admin" class="flex items-center gap-3 px-4 py-3 rounded-xl text-blue-200 hover:text-white transition text-sm">
                Admin Dashboard
            </a>
        </div>
    </aside>

    <main class="flex-1 ml-64 min-h-screen">
        <header class="bg-white border-b border-gray-100 p-6 flex justify-between items-center sticky top-0 z-10">
            <form action="{{ route('resources.index') }}" method="GET" class="w-1/2 relative">
                <input type="text"
                    name="search"
                    value="{{ request('search') }}"
                    placeholder="Search Course Code (e.g. CSC101)..."
                    class="w-full bg-gray-50 border-gray-200 rounded-xl px-4 py-2 text-sm focus:ring-uitm-blue focus:border-uitm-blue border-gray-200">
            </form>
            <div class="flex items-center gap-4">
                <span class="text-sm font-semibold text-gray-700">UiTM Student</span>
                <div class="w-10 h-10 bg-uitm-violet rounded-full flex items-center justify-center text-white font-bold">
                    S
                </div>
            </div>
        </header>

        <div class="p-8">
            @yield('content')
        </div>
    </main>
</body>
</html>