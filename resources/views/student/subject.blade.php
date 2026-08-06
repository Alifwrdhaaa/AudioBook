@extends('layouts.student')

@section('content')
        <!-- Top Stats Bar -->
        <div class="flex flex-col-reverse md:flex-row justify-between items-start md:items-center mb-8 pb-4 border-b-2 border-gray-100 gap-4">
            <a href="{{ route('student.dashboard') }}" class="text-[#30b37f] hover:text-[#258c63] font-bold text-sm transition-colors flex items-center bg-emerald-50 px-4 py-2 rounded-xl border border-emerald-100">
                <svg class="w-5 h-5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                Kembali ke Peta Belajar
            </a>
        </div>

           <div class="py-8 bg-sky-50 min-h-screen">
        <div class="max-w-4xl mx-auto px-4 md:px-6">
            
            <div class="bg-white rounded-3xl p-8 mb-10 shadow-[0_8px_0_0_#e5e7eb] border-4 border-gray-100 relative overflow-hidden">
                <div class="absolute top-0 right-0 w-32 h-32 bg-sky-100 rounded-bl-full opacity-50"></div>
                <h1 class="text-4xl font-black text-gray-800 relative z-10">{{ $subject->name }}</h1>
                <p class="text-xl text-gray-500 font-bold mt-2 relative z-10">Guru: {{ $subject->teacher->name }}</p>
                <div class="absolute -bottom-4 -right-4 text-8xl opacity-20 transform rotate-12">📚</div>
            </div>

            <div id="quest-map-content" class="space-y-12">
                @forelse($subject->chapters as $chapter)
                    <div class="relative">
                        <!-- Chapter Header -->
                        <div class="bg-[#ce82ff] rounded-3xl p-6 mb-8 text-white shadow-[0_8px_0_0_#a568cc] relative overflow-hidden transform hover:scale-[1.02] transition-transform">
                            <div class="absolute -right-6 -top-6 text-8xl opacity-30">✨</div>
                            <h2 class="text-3xl font-black mb-1 relative z-10">Bab {{ $chapter->order_number }}: {{ $chapter->title }}</h2>
                            @if($chapter->description)
                                <p class="text-white/90 text-lg font-bold relative z-10">{{ $chapter->description }}</p>
                            @endif
                        </div>

                        <!-- Map Track Container -->
                        <div class="relative py-4 px-2 md:px-12">
                            <!-- The line connecting the nodes -->
                            <div class="absolute top-0 bottom-0 left-[2rem] md:left-[4.5rem] w-4 bg-[#e5e7eb] rounded-full z-0"></div>

                            <div class="space-y-8 relative z-10">
                                @forelse($chapter->subChapters as $subChapter)
                                    <div class="mb-8">
                                        <div class="flex items-center gap-4 mb-6 bg-white py-3 px-6 rounded-2xl shadow-sm border-2 border-gray-100 w-fit ml-12 md:ml-24">
                                            <span class="text-2xl">🎯</span>
                                            <h5 class="text-xl font-black text-gray-700">{{ $subChapter->title }}</h5>
                                        </div>
                                        
                                        <div class="space-y-6">
                                            @php $subChapterCompletedCount = 0; @endphp
                                            @forelse($subChapter->materials as $material)
                                                @php
                                                    $isCompleted = isset($progresses[$material->id]) && $progresses[$material->id]->is_completed;
                                                    if ($isCompleted) $subChapterCompletedCount++;
                                                @endphp
                                                
                                                <!-- Map Node (Material) -->
                                                <div class="flex items-center gap-6 group">
                                                    <!-- Node Icon -->
                                                    <div class="relative flex-shrink-0 w-16 h-16 md:w-20 md:h-20 rounded-full flex items-center justify-center shadow-[0_6px_0_0_rgba(0,0,0,0.1)] transition-transform group-hover:-translate-y-2 {{ $isCompleted ? 'bg-[#58cc02] shadow-[#46a302]' : 'bg-[#1cb0f6] shadow-[#1899d6]' }} z-10">
                                                        @if($isCompleted)
                                                            <span class="text-3xl md:text-4xl text-white font-bold drop-shadow-md">✓</span>
                                                        @else
                                                            <span class="text-3xl md:text-4xl text-white font-bold drop-shadow-md">📖</span>
                                                        @endif
                                                    </div>
                                                    
                                                    <!-- Node Content Card -->
                                                    <a href="{{ route('student.materials.show', $material) }}" class="flex-1 bg-white rounded-3xl p-5 md:p-6 shadow-[0_6px_0_0_#e5e7eb] border-2 border-gray-100 hover:border-gray-300 transition-all active:translate-y-2 active:shadow-none flex items-center justify-between">
                                                        <div>
                                                            <h6 class="text-xl md:text-2xl font-black text-gray-800">{{ $material->title }}</h6>
                                                            <p class="text-gray-500 font-bold mt-1">{{ $isCompleted ? 'Selesai Dibaca! 🎉' : 'Klik untuk mulai membaca' }}</p>
                                                        </div>
                                                        <div class="w-12 h-12 bg-gray-100 rounded-full flex items-center justify-center group-hover:bg-[#1cb0f6] group-hover:text-white transition-colors">
                                                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M9 5l7 7-7 7"></path></svg>
                                                        </div>
                                                    </a>
                                                </div>
                                            @empty
                                                <div class="ml-24">
                                                    <p class="text-gray-500 font-bold italic bg-white p-4 rounded-xl border border-dashed border-gray-300 w-fit">Belum ada materi di sini.</p>
                                                </div>
                                            @endforelse

                                            <!-- Map Node (Quiz) -->
                                            @if($subChapter->quizzes->count() > 0)
                                                @php
                                                    $allMaterialsCompleted = ($subChapter->materials->count() > 0 && $subChapterCompletedCount === $subChapter->materials->count()) || $subChapter->materials->count() === 0;
                                                @endphp
                                                
                                                <div class="pt-6">
                                                    @foreach($subChapter->quizzes as $quiz)
                                                        @if($allMaterialsCompleted)
                                                            <div class="flex items-center gap-6 group">
                                                                <div class="relative flex-shrink-0 w-20 h-20 md:w-24 md:h-24 rounded-full flex items-center justify-center shadow-[0_8px_0_0_#cc7800] bg-[#ff9600] transition-transform group-hover:-translate-y-2 z-10 ring-8 ring-white">
                                                                    <span class="text-4xl md:text-5xl text-white font-black drop-shadow-md">🏆</span>
                                                                    <div class="absolute -top-2 -right-2 text-2xl animate-bounce">✨</div>
                                                                </div>
                                                                
                                                                <a href="{{ route('student.quizzes.show', $quiz) }}" class="flex-1 bg-[#ff9600] rounded-3xl p-5 md:p-6 shadow-[0_8px_0_0_#cc7800] hover:bg-[#ffaa33] transition-all active:translate-y-2 active:shadow-none flex flex-col md:flex-row items-start md:items-center justify-between text-white border-4 border-white">
                                                                    <div class="mb-4 md:mb-0">
                                                                        <h6 class="text-2xl font-black text-white drop-shadow-md">Kuis Petualangan: {{ $quiz->title }}</h6>
                                                                        <p class="text-white/90 font-bold mt-1 bg-black/10 inline-block px-3 py-1 rounded-full text-sm">Batas Lulus: {{ $quiz->passing_score }}</p>
                                                                    </div>
                                                                    <button class="bg-white text-[#ff9600] font-black px-6 py-3 rounded-2xl shadow-[0_4px_0_0_#e5e7eb] uppercase tracking-widest text-lg w-full md:w-auto">
                                                                        Mulai Kuis!
                                                                    </button>
                                                                </a>
                                                            </div>
                                                        @else
                                                            <div class="flex items-center gap-6 opacity-60 grayscale cursor-not-allowed">
                                                                <div class="relative flex-shrink-0 w-16 h-16 md:w-20 md:h-20 rounded-full flex items-center justify-center shadow-[0_6px_0_0_#9ca3af] bg-gray-400 z-10">
                                                                    <span class="text-3xl text-white font-bold drop-shadow-md">🔒</span>
                                                                </div>
                                                                
                                                                <div class="flex-1 bg-gray-200 rounded-3xl p-5 md:p-6 shadow-[0_6px_0_0_#d1d5db] border-2 border-gray-300">
                                                                    <h6 class="text-xl md:text-2xl font-black text-gray-500">Kuis: {{ $quiz->title }}</h6>
                                                                    <p class="text-gray-500 font-bold mt-1">Selesaikan semua buku materi di atas dulu ya! 📚</p>
                                                                </div>
                                                            </div>
                                                        @endif
                                                    @endforeach
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                @empty
                                    <div class="ml-24">
                                        <p class="text-gray-500 font-bold italic bg-white p-4 rounded-xl border border-dashed border-gray-300 w-fit">Belum ada materi di sini.</p>
                                    </div>
                                @endforelse
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="bg-white p-12 rounded-3xl border-4 border-gray-100 text-center shadow-sm">
                        <div class="text-6xl mb-4 opacity-50">🚧</div>
                        <h4 class="text-2xl font-black text-gray-800 mb-2">Materi Sedang Disiapkan</h4>
                        <p class="text-gray-500 font-bold">Guru sedang mempersiapkan petualangan seru untukmu di sini!</p>
                    </div>
                @endforelse
            </div>
        </div>
    </div>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Simple and robust AJAX polling for shared hosting (cPanel)
        // Checks for new materials/quizzes every 15 seconds without refreshing the page
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
                const newContent = doc.getElementById('quest-map-content');
                const currentContent = document.getElementById('quest-map-content');
                
                if (newContent && currentContent) {
                    // Check if content actually changed (ignoring dynamic CSRF tokens if any)
                    if (newContent.innerHTML !== currentContent.innerHTML) {
                        currentContent.innerHTML = newContent.innerHTML;
                        
                        // Optional: Show a subtle notification or play a sound
                        console.log('Misi baru dari Guru telah tiba!');
                        
                        // Add a subtle flash effect to indicate update
                        currentContent.classList.add('opacity-50', 'transition-opacity', 'duration-500');
                        setTimeout(() => {
                            currentContent.classList.remove('opacity-50');
                        }, 100);
                    }
                }
            })
            .catch(error => console.error('Gagal mengambil pembaruan real-time:', error));
        }, 15000); // 15 seconds
    });
</script>
@endpush
