<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-2xl text-slate-800 leading-tight flex items-center gap-3">
            <span class="bg-[#44936d] text-white p-2 rounded-xl">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                </svg>
            </span>
            {{ __('Admin Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12 bg-slate-50 min-h-screen overflow-x-hidden">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-8">
            
            <!-- Welcome Banner -->
            <div class="bg-gradient-to-r from-[#1a424a] to-[#235862] rounded-3xl p-8 md:p-12 shadow-2xl relative overflow-hidden text-white flex flex-col md:flex-row justify-between items-center">
                <div class="relative z-10 space-y-4">
                    <h1 class="text-4xl md:text-5xl font-black tracking-tight">Halo, Admin! 👋</h1>
                    <p class="text-emerald-100 text-lg max-w-xl leading-relaxed">Selamat datang kembali di pusat kendali. Pantau aktivitas belajar mengajar, kelola data pengajar dan siswa, serta tingkatkan performa sekolah hari ini.</p>
                </div>
                <div class="absolute right-0 top-0 opacity-10 transform translate-x-1/4 -translate-y-1/4">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-96 w-96" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2L2 7l10 5 10-5-10-5zM2 17l10 5 10-5M2 12l10 5 10-5"/></svg>
                </div>
            </div>

            <!-- Stats Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                <!-- Stat Card: Teachers -->
                <div class="bg-white rounded-3xl p-6 border-4 border-slate-100 shadow-lg relative overflow-hidden group hover-lift transition-all duration-300 page-enter" style="animation-delay: 100ms;">
                    <div class="absolute -right-4 -bottom-4 text-7xl opacity-5 group-hover:scale-110 transition-transform text-[#44936d]">👨‍🏫</div>
                    <div class="relative z-10 flex flex-col h-full justify-between">
                        <div class="w-12 h-12 rounded-full bg-emerald-100 flex items-center justify-center text-[#44936d] mb-4">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" /></svg>
                        </div>
                        <div>
                            <h3 class="text-slate-500 text-xs font-bold uppercase tracking-widest mb-1">Total Guru</h3>
                            <p class="text-4xl font-black text-slate-800">{{ $stats['total_teachers'] }}</p>
                        </div>
                    </div>
                </div>

                <!-- Stat Card: Students -->
                <div class="bg-white rounded-3xl p-6 border-4 border-slate-100 shadow-lg relative overflow-hidden group hover-lift transition-all duration-300 page-enter" style="animation-delay: 200ms;">
                    <div class="absolute -right-4 -bottom-4 text-7xl opacity-5 group-hover:scale-110 transition-transform text-[#44936d]">👨‍🎓</div>
                    <div class="relative z-10 flex flex-col h-full justify-between">
                        <div class="w-12 h-12 rounded-full bg-emerald-100 flex items-center justify-center text-[#44936d] mb-4">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" /></svg>
                        </div>
                        <div>
                            <h3 class="text-slate-500 text-xs font-bold uppercase tracking-widest mb-1">Total Siswa</h3>
                            <p class="text-4xl font-black text-slate-800">{{ $stats['total_students'] }}</p>
                        </div>
                    </div>
                </div>

                <!-- Stat Card: Classes -->
                <div class="bg-white rounded-3xl p-6 border-4 border-slate-100 shadow-lg relative overflow-hidden group hover-lift transition-all duration-300 page-enter" style="animation-delay: 300ms;">
                    <div class="absolute -right-4 -bottom-4 text-7xl opacity-5 group-hover:scale-110 transition-transform text-emerald-500">🏫</div>
                    <div class="relative z-10 flex flex-col h-full justify-between">
                        <div class="w-12 h-12 rounded-full bg-emerald-100 flex items-center justify-center text-emerald-600 mb-4">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" /></svg>
                        </div>
                        <div>
                            <h3 class="text-slate-500 text-xs font-bold uppercase tracking-widest mb-1">Total Kelas</h3>
                            <p class="text-4xl font-black text-slate-800">{{ $stats['total_classes'] }}</p>
                        </div>
                    </div>
                </div>

                <!-- Stat Card: Modules -->
                <div class="bg-white rounded-3xl p-6 border-4 border-slate-100 shadow-lg relative overflow-hidden group hover-lift transition-all duration-300 page-enter" style="animation-delay: 400ms;">
                    <div class="absolute -right-4 -bottom-4 text-7xl opacity-5 group-hover:scale-110 transition-transform text-amber-500">📚</div>
                    <div class="relative z-10 flex flex-col h-full justify-between">
                        <div class="w-12 h-12 rounded-full bg-amber-100 flex items-center justify-center text-amber-600 mb-4">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" /></svg>
                        </div>
                        <div>
                            <h3 class="text-slate-500 text-xs font-bold uppercase tracking-widest mb-1">Bab & Kuis</h3>
                            <p class="text-4xl font-black text-slate-800">{{ $stats['total_chapters'] }} <span class="text-xl text-slate-400 font-medium">/ {{ $stats['total_quizzes'] }}</span></p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Quick Actions -->
            <div class="pt-8">
                <h3 class="text-xl font-bold text-slate-800 mb-6 flex items-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-[#44936d]" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" /></svg>
                    Akses Cepat
                </h3>
                <div class="grid grid-cols-1 sm:grid-cols-3 gap-6">
                    <a href="{{ route('admin.teachers.index') }}" class="group flex items-center gap-4 bg-white p-6 rounded-2xl shadow-sm border-2 border-transparent hover:border-emerald-100 hover:shadow-lg transition-all">
                        <div class="w-14 h-14 rounded-xl bg-emerald-50 text-[#44936d] flex items-center justify-center group-hover:scale-110 group-hover:bg-[#44936d] group-hover:text-white transition-all">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" /></svg>
                        </div>
                        <div>
                            <h4 class="font-bold text-slate-800 text-lg">Kelola Guru</h4>
                            <p class="text-sm text-slate-500">Tambah/edit data guru</p>
                        </div>
                    </a>
                    
                    <a href="{{ route('admin.students.index') }}" class="group flex items-center gap-4 bg-white p-6 rounded-2xl shadow-sm border-2 border-transparent hover:border-emerald-100 hover:shadow-lg transition-all">
                        <div class="w-14 h-14 rounded-xl bg-emerald-50 text-[#44936d] flex items-center justify-center group-hover:scale-110 group-hover:bg-[#44936d] group-hover:text-white transition-all">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l9-5-9-5-9 5 9 5z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l9-5-9-5-9 5 9 5zm0 0l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14zm-4 6v-7.5l4-2.222" /></svg>
                        </div>
                        <div>
                            <h4 class="font-bold text-slate-800 text-lg">Data Siswa</h4>
                            <p class="text-sm text-slate-500">Lihat semua siswa terdaftar</p>
                        </div>
                    </a>

                    <a href="{{ route('admin.classes.index') }}" class="group flex items-center gap-4 bg-white p-6 rounded-2xl shadow-sm border-2 border-transparent hover:border-emerald-100 hover:shadow-lg transition-all">
                        <div class="w-14 h-14 rounded-xl bg-emerald-50 text-emerald-600 flex items-center justify-center group-hover:scale-110 group-hover:bg-emerald-600 group-hover:text-white transition-all">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" /></svg>
                        </div>
                        <div>
                            <h4 class="font-bold text-slate-800 text-lg">Kelola Kelas</h4>
                            <p class="text-sm text-slate-500">Atur ruangan kelas siswa</p>
                        </div>
                    </a>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
