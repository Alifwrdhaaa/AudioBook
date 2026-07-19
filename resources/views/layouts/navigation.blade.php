@php
    $user = request()->user() ?? Auth::guard('admin')->user() ?? Auth::guard('teacher')->user() ?? Auth::user();
    $dashboardRoute = $user && $user->role === 'admin' ? route('admin.dashboard') : ($user && $user->role === 'teacher' ? route('teacher.dashboard') : route('welcome'));
@endphp

<nav x-data="{ open: false }" class="bg-white/90 backdrop-blur-md border-b-[3px] border-slate-200 sticky top-0 z-50">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-20">
            <div class="flex">
                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                    <a href="{{ $dashboardRoute }}" class="text-3xl font-black text-indigo-600 tracking-tight hover:scale-105 transition-transform flex items-center gap-2">
                        BelajarOnline
                    </a>
                </div>

                <!-- Navigation Links -->
                <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                    <x-nav-link :href="$dashboardRoute" :active="request()->routeIs('admin.dashboard') || request()->routeIs('teacher.dashboard')">
                        {{ __('Dashboard') }}
                    </x-nav-link>

                    @if($user->role === 'admin')
                        <x-nav-link :href="route('admin.teachers.index')" :active="request()->routeIs('admin.teachers.*')">
                            {{ __('Kelola Guru') }}
                        </x-nav-link>
                        <x-nav-link :href="route('admin.master-subjects.index')" :active="request()->routeIs('admin.master-subjects.*')">
                            {{ __('Master Pelajaran') }}
                        </x-nav-link>
                        <x-nav-link :href="route('admin.classes.index')" :active="request()->routeIs('admin.classes.*')">
                            {{ __('Kelola Kelas') }}
                        </x-nav-link>
                        <x-nav-link href="#" :active="false">
                            {{ __('Tahun Ajaran') }}
                        </x-nav-link>
                        <x-nav-link :href="route('admin.students.index')" :active="request()->routeIs('admin.students.*')">
                            {{ __('Data Siswa') }}
                        </x-nav-link>
                        <x-nav-link href="#" :active="false">
                            {{ __('Progress Belajar') }}
                        </x-nav-link>
                        <x-nav-link href="#" :active="false">
                            {{ __('Monitoring') }}
                        </x-nav-link>
                        <x-nav-link href="#" :active="false">
                            {{ __('Statistik') }}
                        </x-nav-link>
                    @elseif($user->role === 'teacher')
                        <x-nav-link :href="route('teacher.classes.index')" :active="request()->routeIs('teacher.classes.*')">
                            {{ __('Kelola Kelas') }}
                        </x-nav-link>
                        <x-nav-link :href="route('teacher.subjects.index')" :active="request()->routeIs('teacher.subjects.*')">
                            {{ __('Mata Pelajaran') }}
                        </x-nav-link>
                        <x-nav-link :href="route('teacher.schedules.index')" :active="request()->routeIs('teacher.schedules.*')">
                            {{ __('Jadwal') }}
                        </x-nav-link>
                        <x-nav-link :href="route('teacher.chapters.index')" :active="request()->routeIs('teacher.chapters.*')">
                            {{ __('Kelola Bab') }}
                        </x-nav-link>
                        <x-nav-link :href="route('teacher.materials.index')" :active="request()->routeIs('teacher.materials.*') || request()->routeIs('teacher.quizzes.*')">
                            {{ __('Materi & Quiz') }}
                        </x-nav-link>
                        <x-nav-link :href="route('teacher.progress')" :active="request()->routeIs('teacher.progress')">
                            {{ __('Progress Siswa') }}
                        </x-nav-link>
                        <x-nav-link :href="route('teacher.attempts.index')" :active="request()->routeIs('teacher.attempts.*')">
                            {{ __('Penilaian') }}
                        </x-nav-link>
                    @endif
                </div>
            </div>

            <!-- Settings Dropdown -->
            <div class="hidden sm:flex sm:items-center sm:ms-6">
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="inline-flex items-center px-4 py-2 border-2 border-transparent hover:border-slate-200 text-sm font-bold uppercase tracking-widest rounded-xl text-slate-500 bg-white hover:text-slate-700 focus:outline-none transition ease-in-out duration-150 shadow-sm active:translate-y-[2px]">
                            <div>{{ $user->name }}</div>

                            <div class="ms-2">
                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </div>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        @if(Auth::user()->role === 'admin')
                        <x-dropdown-link :href="route('profile.edit')">
                            {{ __('Profile') }}
                        </x-dropdown-link>
                        @endif

                        <!-- Authentication -->
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf

                            <x-dropdown-link :href="route('logout')"
                                    onclick="event.preventDefault();
                                                this.closest('form').submit();">
                                {{ __('Log Out') }}
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
            </div>

            <!-- Hamburger -->
            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">
        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link :href="$dashboardRoute" :active="request()->routeIs('admin.dashboard') || request()->routeIs('teacher.dashboard')">
                {{ __('Dashboard') }}
            </x-responsive-nav-link>

            @if($user->role === 'admin')
                <x-responsive-nav-link :href="route('admin.teachers.index')" :active="request()->routeIs('admin.teachers.*')">
                    {{ __('Kelola Guru') }}
                </x-responsive-nav-link>
                <x-responsive-nav-link :href="route('admin.master-subjects.index')" :active="request()->routeIs('admin.master-subjects.*')">
                    {{ __('Master Pelajaran') }}
                </x-responsive-nav-link>
                <x-responsive-nav-link :href="route('admin.classes.index')" :active="request()->routeIs('admin.classes.*')">
                    {{ __('Kelola Kelas') }}
                </x-responsive-nav-link>
                <x-responsive-nav-link href="#" :active="false">
                    {{ __('Tahun Ajaran') }}
                </x-responsive-nav-link>
                <x-responsive-nav-link :href="route('admin.students.index')" :active="request()->routeIs('admin.students.*')">
                    {{ __('Data Siswa') }}
                </x-responsive-nav-link>
                <x-responsive-nav-link href="#" :active="false">
                    {{ __('Progress Belajar') }}
                </x-responsive-nav-link>
                <x-responsive-nav-link href="#" :active="false">
                    {{ __('Monitoring') }}
                </x-responsive-nav-link>
                <x-responsive-nav-link href="#" :active="false">
                    {{ __('Statistik') }}
                </x-responsive-nav-link>
            @elseif($user->role === 'teacher')
                <x-responsive-nav-link :href="route('teacher.classes.index')" :active="request()->routeIs('teacher.classes.*')">
                    {{ __('Kelola Kelas') }}
                </x-responsive-nav-link>
                <x-responsive-nav-link :href="route('teacher.subjects.index')" :active="request()->routeIs('teacher.subjects.*')">
                    {{ __('Mata Pelajaran') }}
                </x-responsive-nav-link>
                <x-responsive-nav-link :href="route('teacher.schedules.index')" :active="request()->routeIs('teacher.schedules.*')">
                    {{ __('Jadwal') }}
                </x-responsive-nav-link>
                <x-responsive-nav-link :href="route('teacher.chapters.index')" :active="request()->routeIs('teacher.chapters.*')">
                    {{ __('Kelola Bab') }}
                </x-responsive-nav-link>
                <x-responsive-nav-link :href="route('teacher.materials.index')" :active="request()->routeIs('teacher.materials.*') || request()->routeIs('teacher.quizzes.*')">
                    {{ __('Materi & Quiz') }}
                </x-responsive-nav-link>
                <x-responsive-nav-link :href="route('teacher.progress')" :active="request()->routeIs('teacher.progress')">
                    {{ __('Progress Siswa') }}
                </x-responsive-nav-link>
                <x-responsive-nav-link :href="route('teacher.attempts.index')" :active="request()->routeIs('teacher.attempts.*')">
                    {{ __('Penilaian') }}
                </x-responsive-nav-link>
            @endif
        </div>

        <!-- Responsive Settings Options -->
        <div class="pt-4 pb-1 border-t border-gray-200">
            <div class="px-4">
                <div class="font-medium text-base text-gray-800">{{ $user->name }}</div>
                <div class="font-medium text-sm text-gray-500">{{ $user->email }}</div>
            </div>

            <div class="mt-3 space-y-1">
                @if(Auth::user()->role === 'admin')
                <x-responsive-nav-link :href="route('profile.edit')">
                    {{ __('Profile') }}
                </x-responsive-nav-link>
                @endif

                <!-- Authentication -->
                <form method="POST" action="{{ route('logout') }}">
                    @csrf

                    <x-responsive-nav-link :href="route('logout')"
                            onclick="event.preventDefault();
                                        this.closest('form').submit();">
                        {{ __('Log Out') }}
                    </x-responsive-nav-link>
                </form>
            </div>
        </div>
    </div>
</nav>
