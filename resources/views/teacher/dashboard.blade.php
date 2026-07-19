<x-app-layout>
    <x-slot name="header">
        <h2 class="font-black text-2xl text-slate-800 leading-tight tracking-tight">
            {{ __('Dashboard Guru') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            <!-- Welcome Banner -->
            <div class="bg-gradient-to-r from-[#1a424a] to-[#235862] rounded-[2rem] p-8 md:p-12 shadow-xl mb-10 flex flex-col md:flex-row items-center justify-between text-white relative overflow-hidden">
                <div class="absolute -top-10 -right-10 w-48 h-48 bg-white opacity-10 rounded-full blur-2xl"></div>
                
                <div class="relative z-10 text-center md:text-left mb-6 md:mb-0">
                    <h3 class="text-4xl md:text-5xl font-black mb-3 tracking-tight">Selamat Datang, {{ Auth::user()->name }}! 👨‍🏫</h3>
                    <p class="text-emerald-100 font-bold text-lg md:text-xl max-w-2xl">Siap untuk membagikan ilmu hari ini? Pantau progres siswa dan kelola materi pelajaran dengan mudah.</p>
                </div>
                
                <div class="relative z-10 text-7xl drop-shadow-lg animate-bounce" style="animation-duration: 3s;">
                    📚
                </div>
            </div>
            
            <!-- Stat Cards -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mb-12">
                <!-- Stat Card: Total Classes -->
                <div class="bg-white rounded-3xl p-8 border-4 border-slate-100 shadow-xl relative overflow-hidden group hover:-translate-y-1 transition-transform">
                    <div class="absolute -right-6 -bottom-6 text-8xl opacity-10 group-hover:scale-110 transition-transform">🏫</div>
                    <div class="relative z-10">
                        <div class="text-sm font-extrabold text-[#44936d] uppercase tracking-widest mb-2">Kelas yang Diampu</div>
                        <div class="text-6xl font-black text-slate-800">{{ $totalClasses ?? 0 }}</div>
                    </div>
                </div>

                <!-- Stat Card: Total Chapters -->
                <div class="bg-white rounded-3xl p-8 border-4 border-slate-100 shadow-xl relative overflow-hidden group hover:-translate-y-1 transition-transform">
                    <div class="absolute -right-6 -bottom-6 text-8xl opacity-10 group-hover:scale-110 transition-transform">📖</div>
                    <div class="relative z-10">
                        <div class="text-sm font-extrabold text-duo-green uppercase tracking-widest mb-2">Total Bab Materi</div>
                        <div class="text-6xl font-black text-slate-800">0</div>
                    </div>
                </div>

                <!-- Stat Card: Quizzes -->
                <a href="{{ route('teacher.attempts.index') }}" class="block bg-white rounded-3xl p-8 border-4 border-slate-100 shadow-xl relative overflow-hidden group hover:-translate-y-1 transition-transform cursor-pointer">
                    <div class="absolute -right-6 -bottom-6 text-8xl opacity-10 group-hover:scale-110 transition-transform">📝</div>
                    <div class="relative z-10">
                        <div class="text-sm font-extrabold text-duo-yellow-dark uppercase tracking-widest mb-2">Menunggu Penilaian</div>
                        <div class="text-6xl font-black text-slate-800">0</div>
                    </div>
                </a>
            </div>

            <!-- Action Buttons -->
            <div class="flex flex-col sm:flex-row gap-5">
                <a href="{{ route('teacher.chapters.index') }}" class="w-full text-center bg-[#44936d] text-white font-black py-5 px-8 rounded-2xl text-xl shadow-[0_6px_0_0_#2b6b4e] hover:bg-[#347857] active:shadow-[0_0px_0_0_#2b6b4e] active:translate-y-[6px] transition-all uppercase tracking-widest">
                    Kelola Bab & Materi
                </a>
            </div>
        </div>
    </div>
</x-app-layout>
