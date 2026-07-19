@extends('layouts.student')

@section('content')
    <div class="py-4 md:py-8">
        
        <!-- Header Section -->
        <div class="text-center mb-12">
            <h1 class="text-5xl md:text-6xl font-black text-sky-900 tracking-tight mb-4 animate-bounce" style="animation-duration: 2s;">
                Papan Skor 🏆
            </h1>
            <p class="text-xl md:text-2xl font-bold text-sky-600 max-w-2xl mx-auto">
                Kumpulkan XP dari kuis dan jadilah juara di kelasmu!
            </p>
        </div>

        @if($students->isEmpty())
            <div class="bg-white p-12 rounded-[3rem] border-4 border-gray-100 text-center shadow-sm max-w-2xl mx-auto">
                <div class="text-7xl mb-6 opacity-80">🤔</div>
                <h4 class="text-3xl font-black text-sky-900 mb-4">Belum ada pemain!</h4>
                <p class="text-gray-500 font-bold text-xl">Jadilah yang pertama untuk mulai belajar dan meraih posisi puncak!</p>
            </div>
        @else
            <!-- Podium (Top 3) -->
            <div class="flex flex-col md:flex-row justify-center items-end gap-4 md:gap-8 mb-16 mt-20 md:mt-24 max-w-4xl mx-auto px-4">
                
                <!-- Rank 2 -->
                @if(isset($students[1]))
                <div class="w-full md:w-1/3 flex flex-col items-center order-2 md:order-1 transform transition hover:-translate-y-2">
                    <div class="relative w-24 h-24 mb-4">
                        <div class="absolute -top-6 -left-4 text-4xl rotate-12 z-20">🥈</div>
                        <div class="w-full h-full bg-slate-100 border-4 border-slate-300 rounded-full flex items-center justify-center shadow-lg relative z-10 overflow-hidden">
                            <span class="text-4xl font-black text-slate-400">2</span>
                        </div>
                    </div>
                    <div class="bg-slate-100 w-full pt-6 pb-8 px-4 rounded-t-3xl border-4 border-slate-200 border-b-0 text-center shadow-[0_-8px_0_0_rgba(0,0,0,0.05)] h-32 md:h-40 flex flex-col justify-start">
                        <p class="font-black text-slate-700 text-lg md:text-xl truncate w-full">{{ $students[1]->name }}</p>
                        <div class="mt-2 inline-block bg-white px-3 py-1 rounded-full border-2 border-slate-200 font-bold text-sky-600">
                            ⚡ {{ $students[1]->xp }} XP
                        </div>
                    </div>
                </div>
                @endif

                <!-- Rank 1 (Center) -->
                @if(isset($students[0]))
                <div class="w-full md:w-1/3 flex flex-col items-center order-1 md:order-2 transform transition hover:-translate-y-2 relative z-10 -mt-12 md:-mt-16">
                    <div class="absolute -top-12 animate-pulse text-4xl" style="animation-duration: 3s;">✨</div>
                    <div class="relative w-32 h-32 mb-4">
                        <div class="absolute -top-8 -right-4 text-6xl rotate-12 z-20">👑</div>
                        <div class="w-full h-full bg-amber-100 border-4 border-amber-400 rounded-full flex items-center justify-center shadow-[0_8px_0_0_#fbbf24] relative z-10 overflow-hidden ring-8 ring-white">
                            <span class="text-6xl font-black text-amber-500">1</span>
                        </div>
                    </div>
                    <div class="bg-gradient-to-b from-amber-300 to-amber-200 w-full pt-8 pb-10 px-4 rounded-t-3xl border-4 border-amber-400 border-b-0 text-center shadow-[0_-12px_0_0_rgba(0,0,0,0.05)] h-40 md:h-56 flex flex-col justify-start relative">
                        <p class="font-black text-amber-900 text-xl md:text-2xl truncate w-full drop-shadow-sm">{{ $students[0]->name }}</p>
                        <div class="mt-3 inline-block bg-white px-4 py-2 rounded-full border-4 border-amber-100 font-black text-amber-600 text-lg shadow-sm">
                            ⚡ {{ $students[0]->xp }} XP
                        </div>
                    </div>
                </div>
                @endif

                <!-- Rank 3 -->
                @if(isset($students[2]))
                <div class="w-full md:w-1/3 flex flex-col items-center order-3 transform transition hover:-translate-y-2">
                    <div class="relative w-24 h-24 mb-4">
                        <div class="absolute -top-6 -right-4 text-4xl -rotate-12 z-20">🥉</div>
                        <div class="w-full h-full bg-orange-100 border-4 border-orange-300 rounded-full flex items-center justify-center shadow-lg relative z-10 overflow-hidden">
                            <span class="text-4xl font-black text-orange-400">3</span>
                        </div>
                    </div>
                    <div class="bg-orange-100 w-full pt-6 pb-8 px-4 rounded-t-3xl border-4 border-orange-200 border-b-0 text-center shadow-[0_-8px_0_0_rgba(0,0,0,0.05)] h-28 md:h-32 flex flex-col justify-start">
                        <p class="font-black text-orange-800 text-lg md:text-xl truncate w-full">{{ $students[2]->name }}</p>
                        <div class="mt-2 inline-block bg-white px-3 py-1 rounded-full border-2 border-orange-200 font-bold text-sky-600">
                            ⚡ {{ $students[2]->xp }} XP
                        </div>
                    </div>
                </div>
                @endif

            </div>

            <!-- The Rest of the Ranking List -->
            @if($students->count() > 3)
            <div class="max-w-3xl mx-auto bg-white rounded-3xl p-4 md:p-8 shadow-[0_8px_0_0_#e5e7eb] border-4 border-gray-100 relative z-20">
                <div class="space-y-4">
                    @foreach($students->skip(3) as $index => $rankedStudent)
                        @php
                            $isCurrentUser = $rankedStudent->id === $student->id;
                            $rank = $index + 4;
                        @endphp
                        
                        <div class="flex items-center justify-between p-4 md:p-6 rounded-2xl border-4 {{ $isCurrentUser ? 'bg-sky-50 border-sky-200 shadow-[0_4px_0_0_#bae6fd]' : 'bg-white border-gray-100 hover:border-gray-200 hover:bg-gray-50' }} transition-colors">
                            <div class="flex items-center gap-4 md:gap-6 w-full">
                                <div class="w-12 h-12 flex-shrink-0 bg-gray-100 rounded-full flex items-center justify-center font-black text-gray-500 text-xl border-2 border-gray-200">
                                    {{ $rank }}
                                </div>
                                <div class="flex-1 truncate">
                                    <h4 class="text-xl md:text-2xl font-black {{ $isCurrentUser ? 'text-sky-900' : 'text-gray-700' }} truncate">
                                        {{ $rankedStudent->name }}
                                        @if($isCurrentUser)
                                            <span class="ml-2 inline-block bg-sky-200 text-sky-800 text-xs px-2 py-1 rounded-full uppercase tracking-widest align-middle">Kamu</span>
                                        @endif
                                    </h4>
                                </div>
                                <div class="flex-shrink-0 bg-emerald-50 border-2 border-emerald-100 px-4 py-2 rounded-xl text-emerald-600 font-black text-lg shadow-sm">
                                    {{ $rankedStudent->xp }} XP
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
            @endif

            <!-- Current User Status if not in top 3 and no list displayed -->
            @if($students->count() <= 3 && !in_array($student->id, $students->take(3)->pluck('id')->toArray()))
                <!-- This shouldn't logically happen if they are in the class, but just in case -->
                <div class="max-w-3xl mx-auto mt-8 bg-sky-50 rounded-3xl p-6 border-4 border-sky-200 flex justify-between items-center shadow-sm">
                    <p class="text-xl font-black text-sky-900">Ayo mulai kumpulkan XP agar masuk ke Papan Skor!</p>
                </div>
            @endif
            
        @endif

    </div>
@endsection
