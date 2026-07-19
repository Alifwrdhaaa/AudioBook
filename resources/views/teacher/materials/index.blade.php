<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Materi & Kuis untuk Sub Judul: ') }} {{ $subChapter->title }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="flex justify-between items-center mb-6">
                <a href="{{ route('teacher.materials.index') }}" class="text-[#44936d] hover:text-emerald-900 font-semibold">
                    &larr; Kembali Pilih Sub Judul
                </a>
                <div class="space-x-2">
                    <a href="{{ route('teacher.materials.create', ['sub_chapter_id' => $subChapter->id]) }}" class="bg-[#44936d] hover:bg-[#2b6b4e] text-white font-bold py-2 px-4 rounded transition">
                        + Tambah Materi
                    </a>
                    <a href="{{ route('teacher.quizzes.create', ['sub_chapter_id' => $subChapter->id]) }}" class="bg-yellow-500 hover:bg-yellow-600 text-white font-bold py-2 px-4 rounded transition">
                        + Tambah Kuis
                    </a>
                </div>
            </div>

            @if(session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
                    <span class="block sm:inline">{{ session('success') }}</span>
                </div>
            @endif

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h3 class="text-lg font-bold mb-4">Daftar Materi</h3>
                    
                    @if($materials->count() > 0)
                        <div class="space-y-4">
                            @foreach($materials as $material)
                                <div x-data="{ expanded: false }" class="border border-gray-200 rounded-lg overflow-hidden bg-white hover:border-[#44936d] transition-colors">
                                    <div class="flex items-center justify-between p-4 cursor-pointer" @click="expanded = !expanded">
                                        <div class="flex items-center space-x-4">
                                            <div class="p-3 bg-emerald-100 text-[#44936d] rounded-full flex-shrink-0 font-black text-xl w-12 h-12 flex items-center justify-center">
                                                {{ $material->order_number }}
                                            </div>
                                            <div>
                                                <h4 class="text-md font-bold text-gray-900">{{ $material->title }}</h4>
                                                <div class="flex gap-2 mt-1">
                                                    @if($material->content)
                                                        <span class="px-2 py-1 bg-blue-100 text-blue-700 text-xs font-bold rounded">Teks</span>
                                                    @endif
                                                    @if($material->audio_path)
                                                        <span class="px-2 py-1 bg-green-100 text-green-700 text-xs font-bold rounded">Audio</span>
                                                    @endif
                                                    @if($material->video_path)
                                                        <span class="px-2 py-1 bg-red-100 text-red-700 text-xs font-bold rounded">Video</span>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                        <div class="flex items-center space-x-4">
                                            <div class="flex items-center space-x-3" @click.stop>
                                                <a href="{{ route('teacher.materials.edit', $material) }}" class="text-[#44936d] hover:text-emerald-900 font-medium text-sm">Edit</a>
                                                <form action="{{ route('teacher.materials.destroy', $material) }}" method="POST" class="inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus materi ini?');">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="text-red-600 hover:text-red-900 font-medium text-sm">Hapus</button>
                                                </form>
                                            </div>
                                            <svg class="w-5 h-5 text-gray-400 transition-transform duration-200" :class="{'rotate-180': expanded}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                                        </div>
                                    </div>
                                    
                                    <div x-show="expanded" x-collapse>
                                        <div class="p-6 bg-slate-50 border-t border-gray-200" x-data="{ activeTab: '{{ $material->content ? 'text' : ($material->video_path ? 'video' : 'audio') }}' }">
                                            
                                            <!-- Tabs -->
                                            <div class="flex border-b border-gray-200 mb-6">
                                                @if($material->content)
                                                    <button @click="activeTab = 'text'" :class="{'border-[#44936d] text-[#44936d]': activeTab === 'text', 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300': activeTab !== 'text'}" class="whitespace-nowrap py-2 px-4 border-b-2 font-bold text-sm transition-colors">
                                                        Teks
                                                    </button>
                                                @endif
                                                @if($material->audio_path)
                                                    <button @click="activeTab = 'audio'" :class="{'border-[#44936d] text-[#44936d]': activeTab === 'audio', 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300': activeTab !== 'audio'}" class="whitespace-nowrap py-2 px-4 border-b-2 font-bold text-sm transition-colors">
                                                        Audio / Voice Over
                                                    </button>
                                                @endif
                                                @if($material->video_path)
                                                    <button @click="activeTab = 'video'" :class="{'border-[#44936d] text-[#44936d]': activeTab === 'video', 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300': activeTab !== 'video'}" class="whitespace-nowrap py-2 px-4 border-b-2 font-bold text-sm transition-colors">
                                                        Video Pembelajaran
                                                    </button>
                                                @endif
                                            </div>

                                            <!-- Preview Teks -->
                                            @if($material->content)
                                                <div x-show="activeTab === 'text'" class="prose max-w-none bg-white p-6 rounded-xl border border-gray-200 shadow-sm">
                                                    {!! $material->content !!}
                                                </div>
                                            @endif
                                            
                                            <!-- Preview Audio -->
                                            @if($material->audio_path)
                                                <div x-show="activeTab === 'audio'" class="mb-4 bg-white p-4 rounded-xl border border-gray-200 shadow-sm">
                                                    <p class="font-bold text-emerald-900 text-sm mb-2">Audio / Voice Over:</p>
                                                    <audio controls class="w-full">
                                                        <source src="{{ Storage::url($material->audio_path) }}" type="audio/mpeg">
                                                        Browser Anda tidak mendukung elemen audio.
                                                    </audio>
                                                </div>
                                            @endif

                                            <!-- Preview Video -->
                                            @if($material->video_path)
                                                <div x-show="activeTab === 'video'" class="mb-2 bg-white p-4 rounded-xl border border-gray-200 shadow-sm">
                                                    <p class="font-bold text-emerald-900 text-sm mb-2">Video Pembelajaran:</p>
                                                    @if(Str::startsWith($material->video_path, 'http'))
                                                        <div class="aspect-w-16 aspect-h-9 w-full max-w-3xl">
                                                            <iframe src="{{ str_replace('watch?v=', 'embed/', $material->video_path) }}" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen class="rounded-lg w-full h-64 md:h-96"></iframe>
                                                        </div>
                                                    @else
                                                        <video controls class="w-full max-w-3xl rounded-lg h-64 md:h-96 object-cover bg-black">
                                                            <source src="{{ Storage::url($material->video_path) }}" type="video/mp4">
                                                            Browser Anda tidak mendukung elemen video.
                                                        </video>
                                                    @endif
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <p class="text-gray-500 italic">Belum ada materi di sub judul ini.</p>
                    @endif

                    <hr class="my-8 border-gray-200">

                    <h3 class="text-lg font-bold mb-4">Daftar Kuis</h3>
                    
                    @if($subChapter->quizzes->count() > 0)
                        <div class="space-y-4">
                            @foreach($subChapter->quizzes as $quiz)
                                <div class="flex items-center justify-between p-4 border border-gray-200 rounded-lg hover:bg-gray-50">
                                    <div class="flex items-center space-x-4">
                                        <div class="p-3 bg-yellow-100 text-yellow-600 rounded-full">
                                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                        </div>
                                        <div>
                                            <h4 class="text-md font-bold text-gray-900">{{ $quiz->title }}</h4>
                                            <p class="text-sm text-gray-500">Nilai Kelulusan: {{ $quiz->passing_score }} | Max Percobaan: {{ $quiz->max_attempt }}</p>
                                        </div>
                                    </div>
                                    <div class="flex items-center space-x-3">
                                        <a href="{{ route('teacher.quizzes.attempts', $quiz) }}" class="text-green-600 hover:text-green-900 font-medium text-sm">Lihat Hasil & Nilai</a>
                                        <a href="{{ route('teacher.quizzes.show', $quiz) }}" class="text-[#44936d] hover:text-emerald-900 font-medium text-sm">Kelola Soal</a>
                                        <a href="{{ route('teacher.quizzes.edit', $quiz) }}" class="text-[#44936d] hover:text-emerald-900 font-medium text-sm">Edit Pengaturan</a>
                                        <form action="{{ route('teacher.quizzes.destroy', $quiz) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus kuis ini?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-600 hover:text-red-900 font-medium text-sm">Hapus</button>
                                        </form>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <p class="text-gray-500 italic">Belum ada kuis di sub judul ini.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
