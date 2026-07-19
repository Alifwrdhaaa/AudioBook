@extends('layouts.student')

@section('content')
    <!-- Top Stats Bar & Greeting -->
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-10 pb-6 border-b-4 border-sky-100 gap-4 mt-4">
        <div>
            <h2 class="text-4xl md:text-5xl font-black text-sky-900 mb-3">Halo, {{ explode(' ', $student->name)[0] }}! 👋</h2>
            <p class="text-xl md:text-2xl font-bold text-sky-600">Pilih hari untuk mulai belajarmu!</p>
        </div>
        
        <!-- Big Trophy Mascot (Optional) -->
        <div class="hidden md:block">
            <span class="text-6xl drop-shadow-xl animate-bounce" style="display:inline-block; animation-duration: 2s;">🏆</span>
        </div>
    </div>

    <!-- Day Selector (Playful Pills) -->
    <div class="flex overflow-x-auto space-x-4 mb-12 pb-4 hide-scrollbar py-2 px-1">
        @foreach($days as $day)
            <a href="{{ route('student.dashboard', ['day' => $day]) }}" 
                class="px-8 py-4 rounded-3xl font-black text-lg whitespace-nowrap transition-all border-4 {{ $activeDay === $day ? 'bg-[#58cc02] text-white border-[#46a302] shadow-[0_6px_0_0_#46a302] -translate-y-1' : 'bg-white text-gray-400 border-gray-200 hover:bg-gray-50 shadow-[0_6px_0_0_#e5e7eb] hover:text-gray-600' }}">
                {{ $day }}
            </a>
        @endforeach
    </div>

    <!-- Schedules for Active Day -->
    <div>
        @if($schedules->isEmpty())
            <div class="bg-white p-12 rounded-[3rem] border-4 border-gray-100 text-center relative overflow-hidden shadow-sm">
                <div class="text-7xl mb-6 opacity-80 animate-pulse">😴</div>
                <h4 class="text-3xl font-black text-sky-900 mb-4">Libur Dulu!</h4>
                <p class="text-gray-500 font-bold text-xl">Tidak ada jadwal pelajaran untuk hari ini. Waktunya istirahat atau bermain! 🎉</p>
            </div>
        @else
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach($schedules as $index => $schedule)
                    @php
                        $bgColors = [
                            'bg-[#1cb0f6] border-[#1899d6] shadow-[0_8px_0_0_#1899d6]', // Blue
                            'bg-[#58cc02] border-[#46a302] shadow-[0_8px_0_0_#46a302]', // Green
                            'bg-[#ff9600] border-[#cc7800] shadow-[0_8px_0_0_#cc7800]', // Yellow
                            'bg-[#ce82ff] border-[#a568cc] shadow-[0_8px_0_0_#a568cc]', // Purple
                            'bg-[#ff4b4b] border-[#cc3c3c] shadow-[0_8px_0_0_#cc3c3c]', // Red
                        ];
                        $style = $bgColors[$index % count($bgColors)];
                    @endphp
                    
                    <a href="{{ route('student.subjects.show', $schedule->subject) }}" class="block transform transition-transform hover:-translate-y-2 active:translate-y-1">
                        <div class="rounded-[2.5rem] p-8 border-4 relative overflow-hidden flex flex-col h-full text-white {{ $style }}">
                            
                            <div class="flex justify-between items-start mb-6">
                                <div class="bg-white/30 px-5 py-2 rounded-2xl font-black text-lg tracking-wider backdrop-blur-sm">
                                    {{ $schedule->start_time ? \Carbon\Carbon::parse($schedule->start_time)->format('H:i') : '00:00' }}
                                </div>
                                <div class="bg-white text-gray-800 w-16 h-16 rounded-full flex items-center justify-center font-black text-3xl shadow-sm transform -rotate-12">
                                    {{ substr($schedule->subject->name, 0, 1) }}
                                </div>
                            </div>
                            
                            <h4 class="text-4xl font-black mb-4 leading-tight">{{ $schedule->subject->name }}</h4>
                            
                            <div class="mt-auto bg-black/10 p-4 rounded-2xl flex items-center gap-3 backdrop-blur-sm">
                                <span class="text-3xl">👨‍🏫</span>
                                <span class="font-bold text-lg opacity-90">{{ $schedule->subject->teacher->name }}</span>
                            </div>
                        </div>
                    </a>
                @endforeach
            </div>
        @endif
    </div>
@endsection
