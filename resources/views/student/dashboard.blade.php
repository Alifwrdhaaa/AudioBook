@extends('layouts.student')

@section('content')
    <!-- Top Stats Bar & Greeting -->
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-10 pb-6 border-b-4 border-sky-100 gap-4 mt-4 relative z-20">
        <div>
            <h2 class="text-4xl md:text-5xl font-black text-sky-900 mb-3 drop-shadow-sm">Halo, {{ explode(' ', $student->name)[0] }}! 👋</h2>
            <p class="text-xl md:text-2xl font-bold text-sky-600">Pilih peta misi untuk hari ini!</p>
        </div>
        
        <!-- Big Trophy Mascot -->
        <div class="hidden md:block">
            <span class="text-6xl drop-shadow-xl animate-[bounce_2s_ease-in-out_infinite] inline-block">🏆</span>
        </div>
    </div>

    <!-- Quest Log (Day Selector) -->
    <div class="bg-white/90 backdrop-blur-md rounded-[2.5rem] p-5 shadow-[0_8px_30px_rgba(0,0,0,0.06)] border-4 border-white mb-16 relative z-20 overflow-hidden">
        <div class="absolute top-0 left-0 w-full h-2 bg-gradient-to-r from-[#1cb0f6] via-[#58cc02] to-[#ff9600]"></div>
        <div class="flex items-center justify-between mb-4 px-2">
            <h3 class="text-xl font-black text-sky-900 flex items-center gap-2"><span class="text-3xl">📜</span> Log Misi</h3>
            <span class="bg-sky-100 text-[#1cb0f6] font-bold px-4 py-1.5 rounded-full text-sm border-2 border-sky-200 shadow-sm">Pilih Hari</span>
        </div>
        <div class="flex overflow-x-auto gap-4 pb-4 pt-6 hide-scrollbar px-2">
            @foreach($days as $day)
                <a href="{{ route('student.dashboard', ['day' => $day]) }}" 
                    class="flex-1 min-w-[120px] flex flex-col items-center justify-center p-4 rounded-[2rem] font-black transition-all border-4 relative {{ $activeDay === $day ? 'bg-[#58cc02] text-white border-[#46a302] shadow-[0_6px_0_0_#46a302] -translate-y-2' : 'bg-gray-50 text-gray-400 border-gray-200 hover:bg-gray-100 shadow-[0_6px_0_0_#e5e7eb] hover:text-gray-600 hover:-translate-y-1' }}">
                    @if($activeDay === $day)
                        <div class="absolute -top-4 w-6 h-6 bg-yellow-400 rounded-full border-4 border-white shadow-md animate-pulse"></div>
                    @endif
                    <span class="text-sm md:text-base uppercase tracking-widest">{{ $day }}</span>
                </a>
            @endforeach
        </div>
    </div>

    <!-- Map Path Area -->
    <div id="dashboard-map-area" class="relative max-w-3xl mx-auto py-10 z-10 min-h-[500px]">
        
        <!-- Animated Background Companions -->
        <div class="absolute top-10 -left-10 md:-left-32 text-7xl animate-[float_5s_ease-in-out_infinite] opacity-60 pointer-events-none drop-shadow-lg hidden md:block">🛸</div>
        <div class="absolute bottom-20 -right-10 md:-right-32 text-7xl animate-[float_7s_ease-in-out_infinite] opacity-60 pointer-events-none drop-shadow-lg hidden md:block" style="animation-delay: 2s;">🦖</div>
        <div class="absolute top-1/2 left-1/2 text-9xl opacity-5 pointer-events-none transform -translate-x-1/2 -translate-y-1/2 hidden md:block">🗺️</div>

        @if($schedules->isEmpty())
            <!-- Campfire Rest Scene -->
            <div class="flex flex-col items-center justify-center py-10 text-center relative z-20">
                <div class="flex items-end justify-center mb-8 h-48">
                    <!-- Left: Fire -->
                    <div class="text-7xl animate-bounce mb-2 mr-2">🔥</div>
                    <!-- Center: Tent -->
                    <div class="text-[9rem] animate-[float_4s_ease-in-out_infinite] z-10 drop-shadow-xl">⛺</div>
                    <!-- Right: Zzz -->
                    <div class="text-6xl animate-[pulse_3s_ease-in-out_infinite] mb-24 -ml-4">💤</div>
                </div>
                <h4 class="text-4xl font-black text-sky-900 mb-6 bg-white px-8 py-3 rounded-full shadow-sm border-4 border-sky-100 inline-block">Waktunya Kemah!</h4>
                <p class="text-gray-600 font-bold text-lg md:text-xl bg-white px-8 py-5 rounded-[2rem] shadow-sm border-4 border-sky-50 max-w-lg mx-auto leading-relaxed">
                    Tidak ada misi petualangan hari ini. Simpan energimu, nikmati liburmu, dan bersiaplah untuk petualangan besok! 🎉
                </p>
            </div>
        @else
            <!-- Winding SVG Path Line (Background) -->
            <div class="absolute top-0 bottom-0 left-1/2 transform -translate-x-1/2 w-full h-full z-0 opacity-20 pointer-events-none flex justify-center hidden md:flex">
                <svg width="200" height="100%" preserveAspectRatio="none">
                    <path d="M 100 0 C 200 150, 0 300, 100 450 C 200 600, 0 750, 100 900 C 200 1050, 0 1200, 100 1350" fill="none" stroke="#1cb0f6" stroke-width="16" stroke-dasharray="30 20" stroke-linecap="round"/>
                </svg>
            </div>

            <!-- Vertical Nodes (Subjects) -->
            <div class="space-y-16 md:space-y-24 relative z-10 pb-20">
                @foreach($schedules as $index => $schedule)
                    @php
                        $bgColors = [
                            'bg-[#1cb0f6] border-[#1899d6] shadow-[0_12px_0_0_#1899d6]', // Blue
                            'bg-[#58cc02] border-[#46a302] shadow-[0_12px_0_0_#46a302]', // Green
                            'bg-[#ff9600] border-[#cc7800] shadow-[0_12px_0_0_#cc7800]', // Yellow
                            'bg-[#ce82ff] border-[#a568cc] shadow-[0_12px_0_0_#a568cc]', // Purple
                            'bg-[#ff4b4b] border-[#cc3c3c] shadow-[0_12px_0_0_#cc3c3c]', // Red
                        ];
                        $style = $bgColors[$index % count($bgColors)];
                        
                        // Zig-zag positioning logic
                        $alignments = ['justify-start', 'justify-center', 'justify-end', 'justify-center'];
                        $alignClass = $alignments[$index % 4];
                    @endphp
                    
                    <div class="flex {{ $alignClass }} w-full px-4 md:px-0">
                        <a href="{{ route('student.subjects.show', $schedule->subject) }}" class="block group transform transition-all hover:scale-[1.03] active:scale-95 w-full md:w-[320px]">
                            
                            <div class="relative">
                                <!-- 3D Node Card -->
                                <div class="rounded-[3rem] p-8 border-4 overflow-hidden flex flex-col text-white {{ $style }} relative z-10 bg-gradient-to-b from-white/20 to-transparent">
                                    
                                    <div class="flex justify-between items-center mb-6">
                                        <div class="bg-black/20 px-4 py-1.5 rounded-full font-black text-sm tracking-widest backdrop-blur-sm">
                                            {{ $schedule->start_time ? \Carbon\Carbon::parse($schedule->start_time)->format('H:i') : '00:00' }}
                                        </div>
                                        <!-- Animated Star -->
                                        <div class="text-3xl animate-[spin_4s_linear_infinite] opacity-60 group-hover:opacity-100 group-hover:scale-125 transition-all">⭐</div>
                                    </div>
                                    
                                    <!-- Big Subject Icon -->
                                    <div class="bg-white text-sky-900 w-24 h-24 rounded-full mx-auto flex items-center justify-center font-black text-5xl shadow-[inset_0_4px_8px_rgba(0,0,0,0.1)] mb-6 transform -rotate-12 group-hover:rotate-12 transition-transform duration-300 border-4 border-sky-50">
                                        {{ substr($schedule->subject->name, 0, 1) }}
                                    </div>
                                    
                                    <h4 class="text-3xl md:text-4xl font-black text-center mb-4 leading-tight drop-shadow-md">{{ $schedule->subject->name }}</h4>
                                    
                                    <!-- Teacher Info -->
                                    <div class="mt-auto bg-black/15 p-4 rounded-3xl flex items-center justify-center gap-3 backdrop-blur-sm border border-white/10">
                                        <span class="text-2xl">👨‍🏫</span>
                                        <span class="font-bold text-base md:text-lg truncate drop-shadow-sm">{{ $schedule->subject->teacher->name }}</span>
                                    </div>

                                </div>
                            </div>
                            
                        </a>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Simple and robust AJAX polling for the dashboard map
        setInterval(function() {
            fetch(window.location.href, {
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                    'Accept': 'text/html'
                }
            })
            .then(response => response.text())
            .then(html => {
                const parser = new DOMParser();
                const doc = parser.parseFromString(html, 'text/html');
                const newContent = doc.getElementById('dashboard-map-area');
                const currentContent = document.getElementById('dashboard-map-area');
                
                if (newContent && currentContent) {
                    if (newContent.innerHTML !== currentContent.innerHTML) {
                        currentContent.innerHTML = newContent.innerHTML;
                        
                        currentContent.classList.add('opacity-50', 'transition-opacity', 'duration-500');
                        setTimeout(() => {
                            currentContent.classList.remove('opacity-50');
                        }, 100);
                    }
                }
            })
            .catch(error => console.error('Gagal mengambil pembaruan peta:', error));
        }, 15000); // 15 seconds
    });
</script>
@endpush
