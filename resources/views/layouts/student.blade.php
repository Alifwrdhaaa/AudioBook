<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name', 'Belajar Online') }} - Petualangan Siswa</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
</head>
<body class="bg-[#f0f9ff] font-sans antialiased text-gray-800 min-h-screen flex flex-col bg-[url('data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHdpZHRoPSI2MCIgaGVpZ2h0PSI2MCI+PGNpcmNsZSBjeD0iMzAiIGN5PSIzMCIgcj0iMiIgZmlsbD0iI2QxZWFmNyIvPjwvc3ZnPg==')]">
    
    <!-- Super Fun Top Navbar -->
    <header class="bg-white border-b-4 border-sky-100 shadow-[0_4px_20px_rgba(0,0,0,0.03)] sticky top-0 z-50">
        <div class="max-w-6xl mx-auto px-4 h-24 flex items-center justify-between">
            
            <!-- Logo -->
            <div class="flex items-center gap-3">
                <div class="w-12 h-12 bg-[#1cb0f6] rounded-2xl rotate-12 flex items-center justify-center shadow-[0_4px_0_0_#1899d6] transform transition hover:scale-110 hover:rotate-6">
                    <span class="text-3xl drop-shadow-md -rotate-12">🚀</span>
                </div>
                <a href="{{ route('student.dashboard') }}" class="hidden sm:block text-2xl font-black text-sky-900 tracking-tight ml-2">
                    Belajar<span class="text-[#1cb0f6]">Seru</span>
                </a>
            </div>

            <!-- Main Nav Buttons -->
            <div class="hidden md:flex items-center gap-6">
                <a href="{{ route('student.dashboard') }}" class="flex items-center gap-2 px-6 py-3 rounded-full font-black text-lg transition-transform hover:-translate-y-1 {{ request()->routeIs('student.dashboard') ? 'bg-sky-100 text-[#1cb0f6] border-2 border-[#1cb0f6]' : 'text-gray-400 hover:text-gray-600' }}">
                    <span class="text-2xl">🗺️</span> Peta Belajar
                </a>
                <a href="{{ route('student.leaderboard') }}" class="flex items-center gap-2 px-6 py-3 rounded-full font-black text-lg transition-transform hover:-translate-y-1 {{ request()->routeIs('student.leaderboard') ? 'bg-sky-100 text-[#1cb0f6] border-2 border-[#1cb0f6]' : 'text-gray-400 hover:text-gray-600' }}">
                    <span class="text-2xl">🏆</span> Papan Skor
                </a>
            </div>

            <!-- Stats & Profile -->
            <div class="flex items-center gap-4">
                
                <!-- Streak -->
                <div class="flex items-center gap-2 bg-amber-50 px-4 py-2 rounded-2xl border-2 border-amber-200 shadow-sm cursor-pointer hover:scale-105 transition-transform title="Hari Beruntun"">
                    <span class="text-2xl animate-pulse">🔥</span>
                    <span class="text-amber-600 font-black text-xl">{{ $currentStudent->streak ?? 0 }}</span>
                </div>
                
                <!-- XP -->
                <div class="flex items-center gap-2 bg-emerald-50 px-4 py-2 rounded-2xl border-2 border-emerald-200 shadow-sm cursor-pointer hover:scale-105 transition-transform" title="Total XP">
                    <span class="text-2xl">⚡</span>
                    <span class="text-emerald-600 font-black text-xl">{{ $currentStudent->xp ?? 0 }}</span>
                </div>

                <!-- Profile Dropdown -->
                <div x-data="{ open: false }" class="relative ml-2">
                    <button @click="open = !open" class="flex items-center gap-3 focus:outline-none transform transition hover:scale-105 active:scale-95">
                        <div class="w-12 h-12 rounded-full bg-purple-100 border-4 border-purple-200 flex items-center justify-center shadow-sm">
                            <span class="text-2xl">👦</span>
                        </div>
                    </button>

                    <!-- Dropdown Menu -->
                    <div x-show="open" @click.away="open = false" style="display: none;"
                         x-transition:enter="transition ease-out duration-200"
                         x-transition:enter-start="opacity-0 scale-95 -translate-y-2"
                         x-transition:enter-end="opacity-100 scale-100 translate-y-0"
                         class="absolute right-0 mt-4 w-56 bg-white rounded-3xl shadow-[0_10px_40px_rgba(0,0,0,0.1)] border-4 border-gray-100 overflow-hidden z-50">
                        <div class="px-6 py-4 border-b-2 border-gray-100 bg-sky-50">
                            <p class="text-sm font-bold text-gray-500">Halo, Petualang!</p>
                            <p class="text-lg font-black text-sky-900 truncate">{{ $currentStudent->name ?? 'Siswa' }}</p>
                        </div>
                        <form method="POST" action="{{ route('student.logout') }}">
                            @csrf
                            <button type="submit" class="w-full text-left px-6 py-4 font-bold text-rose-600 hover:bg-rose-50 flex items-center gap-3">
                                <span class="text-xl">🚪</span> Keluar Main
                            </button>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </header>

    <!-- Mobile Nav (Bottom) -->
    <nav class="md:hidden fixed bottom-0 left-0 w-full bg-white border-t-4 border-sky-100 px-6 py-4 flex justify-around items-center z-50 shadow-[0_-4px_20px_rgba(0,0,0,0.05)] pb-8">
        <a href="{{ route('student.dashboard') }}" class="flex flex-col items-center gap-1 {{ request()->routeIs('student.dashboard') ? 'text-[#1cb0f6]' : 'text-gray-400' }}">
            <span class="text-3xl {{ request()->routeIs('student.dashboard') ? 'animate-bounce' : '' }}">🗺️</span>
            <span class="text-xs font-black">Peta</span>
        </a>
        <a href="{{ route('student.leaderboard') }}" class="flex flex-col items-center gap-1 {{ request()->routeIs('student.leaderboard') ? 'text-[#1cb0f6]' : 'text-gray-400' }}">
            <span class="text-3xl {{ request()->routeIs('student.leaderboard') ? 'animate-bounce' : '' }}">🏆</span>
            <span class="text-xs font-black">Skor</span>
        </a>
    </nav>

    <!-- Main Content Area -->
    <main class="flex-1 max-w-6xl mx-auto w-full pt-8 px-4 pb-32 md:pb-16 relative page-enter">
        @yield('content')
    </main>

    <!-- Confetti Trigger Script -->
    <script type="module">
        import confetti from 'https://cdn.skypack.dev/canvas-confetti';
        window.fireConfetti = function() {
            var duration = 3000;
            var end = Date.now() + duration;

            (function frame() {
                confetti({
                    particleCount: 5,
                    angle: 60,
                    spread: 55,
                    origin: { x: 0 },
                    colors: ['#58cc02', '#1cb0f6', '#ffc800', '#ff4b4b']
                });
                confetti({
                    particleCount: 5,
                    angle: 120,
                    spread: 55,
                    origin: { x: 1 },
                    colors: ['#58cc02', '#1cb0f6', '#ffc800', '#ff4b4b']
                });

                if (Date.now() < end) {
                    requestAnimationFrame(frame);
                }
            }());
        };

        // Fire on load if session has success message
        @if(session('success'))
            setTimeout(window.fireConfetti, 500);
        @endif
    </script>
    @stack('scripts')
</body>
</html>
