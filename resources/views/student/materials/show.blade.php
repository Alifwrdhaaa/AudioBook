<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $material->title }} - AudioBook</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-white font-sans text-gray-800 antialiased min-h-screen flex flex-col">
    
    <!-- Top Progress/Nav Bar -->
    <div class="w-full border-b-2 border-gray-200 sticky top-0 bg-white z-50">
        <div class="max-w-4xl mx-auto px-4 h-20 flex items-center justify-between">
            <a href="{{ route('student.dashboard') }}" class="text-gray-400 hover:text-gray-600 transition-colors">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M6 18L18 6M6 6l12 12"></path></svg>
            </a>
            
            <!-- Fake Progress Bar for UI feel -->
            <div class="flex-1 mx-8 relative">
                <div class="h-4 w-full bg-gray-200 rounded-full overflow-hidden">
                    <div class="h-full bg-duo-green rounded-full w-1/2"></div>
                </div>
            </div>

            <div class="flex items-center text-duo-yellow-dark font-bold text-lg">
                <span class="text-2xl mr-1">🔥</span> {{ $student->streak ?? 0 }}
            </div>
        </div>
    </div>

    <!-- Main Content Area -->
    <main class="flex-1 max-w-4xl mx-auto w-full px-4 py-8 flex flex-col">
        
        <div class="text-center mb-8">
            <div class="inline-block bg-white px-6 py-2 rounded-full border-4 border-yellow-300 shadow-sm mb-4 transform -rotate-2">
                <span class="text-xl font-bold text-yellow-600">Buku Ajaib 📖</span>
            </div>
            <h1 class="text-4xl md:text-5xl font-black text-gray-800 tracking-tight">{{ $material->title }}</h1>
        </div>

        <div class="bg-white rounded-[3rem] p-8 md:p-12 border-8 border-sky-100 shadow-[0_8px_0_0_#e0f2fe] flex-1 relative"
             x-data="{ 
                 activeTab: '{{ $material->video_path ? 'video' : ($material->audio_path ? 'audio' : 'text') }}' 
             }">
             
            <!-- Decorative Elements -->
            <div class="absolute -top-6 -left-6 text-6xl animate-bounce" style="animation-duration: 3s;">✨</div>
            <div class="absolute -bottom-6 -right-6 text-6xl transform rotate-12">🎨</div>
            
            <!-- Tabs Navigation -->
            <div class="flex flex-wrap justify-center gap-4 mb-10 border-b-4 border-dashed border-gray-100 pb-8 relative z-10">
                @if($material->video_path)
                <button @click="activeTab = 'video'" 
                        :class="activeTab === 'video' ? 'bg-[#ff9600] text-white shadow-[0_6px_0_0_#cc7800] translate-y-[-4px]' : 'bg-gray-100 text-gray-500 hover:bg-gray-200 shadow-[0_4px_0_0_#e5e7eb]'"
                        class="px-8 py-4 rounded-3xl font-black transition-all flex items-center gap-3 text-lg border-4 border-transparent">
                    <span class="text-3xl">📺</span> Tonton Video
                </button>
                @endif
                
                @if($material->audio_path)
                <button @click="activeTab = 'audio'"
                        :class="activeTab === 'audio' ? 'bg-[#1cb0f6] text-white shadow-[0_6px_0_0_#1899d6] translate-y-[-4px]' : 'bg-gray-100 text-gray-500 hover:bg-gray-200 shadow-[0_4px_0_0_#e5e7eb]'"
                        class="px-8 py-4 rounded-3xl font-black transition-all flex items-center gap-3 text-lg border-4 border-transparent">
                    <span class="text-3xl">🎧</span> Dengarkan Suara
                </button>
                @endif
                
                @if($material->content)
                <button @click="activeTab = 'text'"
                        :class="activeTab === 'text' ? 'bg-[#ce82ff] text-white shadow-[0_6px_0_0_#a568cc] translate-y-[-4px]' : 'bg-gray-100 text-gray-500 hover:bg-gray-200 shadow-[0_4px_0_0_#e5e7eb]'"
                        class="px-8 py-4 rounded-3xl font-black transition-all flex items-center gap-3 text-lg border-4 border-transparent">
                    <span class="text-3xl">📝</span> Baca Cerita
                </button>
                @endif
            </div>

            <!-- Tab Contents -->
            <div class="relative z-10">
                @if($material->video_path)
                    <div x-show="activeTab === 'video'" style="display: none;"
                         x-transition:enter="transition ease-out duration-300" 
                         x-transition:enter-start="opacity-0 translate-y-4" 
                         x-transition:enter-end="opacity-100 translate-y-0" 
                         class="flex flex-col items-center justify-center bg-gray-900 rounded-[2rem] p-4 border-8 border-gray-800 shadow-2xl relative">
                        <div class="absolute -top-4 -left-4 w-8 h-8 rounded-full bg-red-500 border-2 border-white z-20"></div>
                        <div class="absolute -top-4 right-8 w-8 h-8 rounded-full bg-yellow-400 border-2 border-white z-20"></div>
                        @if(Str::startsWith($material->video_path, 'http'))
                            <div class="w-full relative rounded-2xl overflow-hidden" style="padding-top: 56.25%;">
                                <iframe class="absolute top-0 left-0 w-full h-full" src="{{ str_replace('watch?v=', 'embed/', $material->video_path) }}" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                            </div>
                        @else
                            <video controls class="w-full rounded-2xl" controlsList="nodownload">
                                <source src="{{ Storage::url($material->video_path) }}" type="video/mp4">
                                Browser Anda tidak mendukung video.
                            </video>
                        @endif
                    </div>
                @endif

                @if($material->audio_path)
                    <div x-show="activeTab === 'audio'" style="display: none;"
                         x-transition:enter="transition ease-out duration-300" 
                         x-transition:enter-start="opacity-0 translate-y-4" 
                         x-transition:enter-end="opacity-100 translate-y-0" 
                         class="flex flex-col items-center justify-center bg-sky-50 p-12 rounded-[3rem] border-4 border-sky-200">
                        <div class="text-8xl mb-8 animate-bounce">📻</div>
                        <p class="text-sky-800 font-black mb-8 text-2xl text-center">Pasang telingamu baik-baik! 👂</p>
                        <audio controls class="w-full max-w-xl shadow-lg rounded-full border-4 border-sky-300 bg-white">
                            <source src="{{ Storage::url($material->audio_path) }}" type="audio/mpeg">
                            Browser Anda tidak mendukung elemen audio.
                        </audio>
                    </div>
                @endif

                @if($material->content)
                    <div x-show="activeTab === 'text'" style="display: none;"
                         x-transition:enter="transition ease-out duration-300" 
                         x-transition:enter-start="opacity-0 translate-y-4" 
                         x-transition:enter-end="opacity-100 translate-y-0" 
                         class="prose max-w-none text-2xl leading-[2.5] text-gray-800 font-medium">
                        {!! $material->content !!}
                    </div>
                @endif
            </div>

        </div>

    </main>

    <!-- Bottom Action Bar -->
    <div class="w-full border-t-4 border-gray-200 bg-white sticky bottom-0 p-4 shadow-[0_-10px_20px_rgba(0,0,0,0.05)] z-50">
        <div class="max-w-4xl mx-auto flex justify-between items-center">
            
            <div class="text-duo-green font-black text-2xl hidden sm:flex items-center gap-2">
                @if($progress && $progress->is_completed)
                    <span class="text-3xl">🌟</span> Hebat! Selesai dibaca!
                @endif
            </div>

            <form action="{{ route('student.materials.complete', $material) }}" method="POST" class="w-full sm:w-auto">
                @csrf
                @if($progress && $progress->is_completed)
                    <a href="{{ route('student.subjects.show', $material->subChapter->chapter->subject_id) }}" class="block w-full sm:w-72 text-center px-10 py-5 bg-[#1cb0f6] text-white rounded-[2rem] font-black uppercase tracking-widest text-xl shadow-[0_8px_0_0_#1899d6] hover:bg-[#1fbfff] active:shadow-[0_0px_0_0_#1899d6] active:translate-y-[8px] transition-all">
                        KEMBALI KE PETA
                    </a>
                @else
                    <button type="submit" class="w-full sm:w-72 px-10 py-5 bg-[#58cc02] text-white rounded-[2rem] font-black uppercase tracking-widest text-xl shadow-[0_8px_0_0_#46a302] hover:bg-[#61E002] active:shadow-[0_0px_0_0_#46a302] active:translate-y-[8px] transition-all flex items-center justify-center gap-2">
                        AKU SUDAH PAHAM! <span class="text-2xl">👍</span>
                    </button>
                @endif
            </form>
        </div>
    </div>

</body>
</html>
