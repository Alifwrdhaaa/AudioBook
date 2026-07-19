@php
    $user = null;
    $isStudent = false;

    if (request()->routeIs('student.*') && session()->has('student_id')) {
        $user = \App\Models\Student::find(session('student_id'));
        $isStudent = true;
    } elseif (request()->routeIs('admin.*')) {
        $user = Auth::guard('admin')->user() ?? Auth::user();
    } elseif (request()->routeIs('teacher.*')) {
        $user = Auth::guard('teacher')->user() ?? Auth::user();
    } else {
        // Fallback
        if (session()->has('student_id')) {
            $user = \App\Models\Student::find(session('student_id'));
            $isStudent = true;
        } else {
            $user = request()->user() ?? Auth::guard('admin')->user() ?? Auth::guard('teacher')->user() ?? Auth::user();
        }
    }
    
    if ($isStudent) {
        $dashboardRoute = route('student.dashboard');
        $panelName = 'Student Panel';
    } else {
        $dashboardRoute = $user && isset($user->role) && $user->role === 'admin' ? route('admin.dashboard') : ($user && isset($user->role) && $user->role === 'teacher' ? route('teacher.dashboard') : route('welcome'));
        $panelName = $user && isset($user->role) && $user->role === 'admin' ? 'Admin Panel' : 'Teacher Panel';
    }
    
    // Sidebar colors based on screenshot: Dark Teal (#1a424a) for bg, Lighter Teal (#44936d) for active
@endphp

<!-- Mobile Sidebar Overlay -->
<div x-show="sidebarOpen" class="fixed inset-0 z-40 bg-gray-900 bg-opacity-50 sm:hidden" @click="sidebarOpen = false" x-transition:enter="transition-opacity ease-linear duration-300" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" x-transition:leave="transition-opacity ease-linear duration-300" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"></div>

<!-- Sidebar -->
<aside :class="{'translate-x-0': sidebarOpen, '-translate-x-full': !sidebarOpen}" class="fixed inset-y-0 left-0 z-50 w-72 bg-[#1a424a] text-slate-300 transition-transform duration-300 ease-in-out sm:relative sm:translate-x-0 flex flex-col shadow-2xl">
    
    <!-- Logo / Header -->
    <div class="flex items-center justify-between h-20 px-6 bg-[#1a424a] border-b border-[#235862]">
        <a href="{{ $dashboardRoute }}" class="flex items-center gap-3 text-white">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-[#30b37f]" viewBox="0 0 24 24" fill="currentColor">
                <path d="M12 3L1 9l4 2.18v6L12 21l7-3.82v-6l2-1.09V17h2V9L12 3zm6.82 6L12 12.72 5.18 9 12 5.28 18.82 9zM17 15.99l-5 2.73-5-2.73v-3.72L12 15l5-2.73v3.72z" />
            </svg>
            <div>
                <h1 class="text-xl font-bold tracking-tight leading-tight">BelajarOnline</h1>
                <p class="text-xs text-[#30b37f] font-medium uppercase tracking-wider mt-0.5">{{ $panelName }}</p>
            </div>
        </a>
        <button @click="sidebarOpen = false" class="sm:hidden text-gray-400 hover:text-white focus:outline-none">
            <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" /></svg>
        </button>
    </div>

    <!-- Navigation Menu -->
    <nav class="flex-1 px-4 py-6 overflow-y-auto space-y-2 custom-scrollbar">
        
        <x-sidebar-link :href="$dashboardRoute" :active="request()->routeIs('admin.dashboard') || request()->routeIs('teacher.dashboard')">
            <x-slot name="icon">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z" /></svg>
            </x-slot>
            {{ __('Dashboard') }}
        </x-sidebar-link>

        @if(isset($user->role) && $user->role === 'admin')
            <x-sidebar-link :href="route('admin.teachers.index')" :active="request()->routeIs('admin.teachers.*')">
                <x-slot name="icon">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" /></svg>
                </x-slot>
                {{ __('Manajemen Guru') }}
            </x-sidebar-link>
            
            <x-sidebar-link :href="route('admin.master-subjects.index')" :active="request()->routeIs('admin.master-subjects.*')">
                <x-slot name="icon">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" /></svg>
                </x-slot>
                {{ __('Master Pelajaran') }}
            </x-sidebar-link>

            <x-sidebar-link :href="route('admin.classes.index')" :active="request()->routeIs('admin.classes.*')">
                <x-slot name="icon">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" /></svg>
                </x-slot>
                {{ __('Kelola Kelas') }}
            </x-sidebar-link>

            <x-sidebar-link :href="route('admin.students.index')" :active="request()->routeIs('admin.students.*')">
                <x-slot name="icon">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l9-5-9-5-9 5 9 5z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l9-5-9-5-9 5 9 5zm0 0l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14zm-4 6v-7.5l4-2.222" /></svg>
                </x-slot>
                {{ __('Data Siswa') }}
            </x-sidebar-link>
            
        @elseif(isset($user->role) && $user->role === 'teacher')
            <x-sidebar-link :href="route('teacher.classes.index')" :active="request()->routeIs('teacher.classes.*')">
                <x-slot name="icon">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" /></svg>
                </x-slot>
                {{ __('Kelola Kelas') }}
            </x-sidebar-link>
            
            <x-sidebar-link :href="route('teacher.subjects.index')" :active="request()->routeIs('teacher.subjects.*')">
                <x-slot name="icon">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" /></svg>
                </x-slot>
                {{ __('Mata Pelajaran') }}
            </x-sidebar-link>
            
            <x-sidebar-link :href="route('teacher.schedules.index')" :active="request()->routeIs('teacher.schedules.*')">
                <x-slot name="icon">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" /></svg>
                </x-slot>
                {{ __('Jadwal Mengajar') }}
            </x-sidebar-link>
            
            <x-sidebar-link :href="route('teacher.chapters.index')" :active="request()->routeIs('teacher.chapters.*')">
                <x-slot name="icon">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 19a2 2 0 01-2-2V7a2 2 0 012-2h4l2 2h4a2 2 0 012 2v1M5 19h14a2 2 0 002-2v-5a2 2 0 00-2-2H9a2 2 0 00-2 2v5a2 2 0 01-2 2z" /></svg>
                </x-slot>
                {{ __('Kelola Bab') }}
            </x-sidebar-link>
            
            <x-sidebar-link :href="route('teacher.sub_chapters.index')" :active="request()->routeIs('teacher.sub_chapters.*')">
                <x-slot name="icon">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" /></svg>
                </x-slot>
                {{ __('Kelola Sub Bab') }}
            </x-sidebar-link>
            
            <x-sidebar-link :href="route('teacher.materials.index')" :active="request()->routeIs('teacher.materials.*') || request()->routeIs('teacher.quizzes.*')">
                <x-slot name="icon">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" /></svg>
                </x-slot>
                {{ __('Materi & Quiz') }}
            </x-sidebar-link>
            
            <x-sidebar-link :href="route('teacher.progress')" :active="request()->routeIs('teacher.progress')">
                <x-slot name="icon">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6" /></svg>
                </x-slot>
                {{ __('Progress Siswa') }}
            </x-sidebar-link>
            
            <x-sidebar-link :href="route('teacher.attempts.index')" :active="request()->routeIs('teacher.attempts.*')">
                <x-slot name="icon">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4" /></svg>
                </x-slot>
                {{ __('Penilaian') }}
            </x-sidebar-link>
        @endif
    </nav>

    <!-- User Profile & Logout -->
    <div class="p-5 bg-[#1a424a] border-t border-[#235862]">
        <div class="flex items-center gap-4 px-2 py-2 mb-4 relative group cursor-pointer">
            @if(isset($user->profile_photo) && $user->profile_photo)
                <img src="{{ Storage::url($user->profile_photo) }}" alt="Profile" class="h-12 w-12 rounded-full object-cover border-2 border-white">
            @else
                <div class="h-12 w-12 rounded-full bg-white flex items-center justify-center font-bold text-[#1a424a] text-lg">
                    {{ substr($user->name, 0, 1) }}
                </div>
            @endif
            <div class="flex-1 overflow-hidden">
                <p class="text-sm font-bold text-white truncate">{{ $user->name }}</p>
                <p class="text-xs text-[#30b37f] truncate">{{ $user->email ?? $user->student_code }}</p>
            </div>
            @if(isset($user->role) && $user->role === 'admin')
            <a href="{{ route('profile.edit') }}" class="text-slate-400 hover:text-white transition-colors" title="Profile Settings">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" /></svg>
            </a>
            @endif
        </div>
        
        <form method="POST" action="{{ $isStudent ? route('student.logout') : route('logout') }}" class="w-full">
            @csrf
            <button type="submit" class="w-full flex items-center gap-3 py-2 px-2 text-sm font-medium text-slate-300 hover:text-white transition-colors duration-200">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 rotate-180" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" /></svg>
                Keluar Aplikasi
            </button>
        </form>
    </div>
</aside>
