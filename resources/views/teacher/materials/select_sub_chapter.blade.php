<x-app-layout>
    <x-slot name="header">
        <h2 class="text-2xl font-bold text-gray-800 leading-tight">
            {{ __('Pilih Sub Judul untuk Kelola Materi & Kuis') }}
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            <div class="space-y-8">
                @forelse($subjects as $subject)
                    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
                        <div class="bg-gradient-to-r from-gray-50 to-white px-6 py-4 border-b border-gray-100">
                            <h3 class="text-lg font-bold text-gray-800 flex items-center gap-2">
                                <span class="text-2xl">{{ $subject->icon }}</span>
                                {{ $subject->name }}
                                <span class="text-sm font-normal text-gray-500 ml-2 px-2.5 py-0.5 rounded-full bg-gray-100">
                                    Kelas {{ $subject->schoolClass->level }} {{ $subject->schoolClass->major->name ?? '' }}
                                </span>
                            </h3>
                        </div>
                        
                        <div class="p-6">
                            @if($subject->chapters->isEmpty())
                                <p class="text-sm text-gray-500 italic">Belum ada bab untuk mata pelajaran ini.</p>
                            @else
                                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                                    @foreach($subject->chapters as $chapter)
                                        <div class="bg-gray-50 rounded-xl p-4 border border-gray-100">
                                            <h4 class="font-bold text-gray-700 mb-3 text-sm uppercase tracking-wider">Bab {{ $chapter->order_number }}: {{ $chapter->title }}</h4>
                                            
                                            @if($chapter->subChapters->isEmpty())
                                                <p class="text-xs text-gray-500 italic mb-3">Belum ada sub judul.</p>
                                            @else
                                                <div class="space-y-2">
                                                    @foreach($chapter->subChapters as $subChapter)
                                                        <a href="{{ route('teacher.materials.index', ['sub_chapter_id' => $subChapter->id]) }}" class="block w-full text-left bg-white border border-gray-200 hover:border-[#30b37f] hover:shadow-md transition-all rounded-lg p-3 group">
                                                            <div class="flex justify-between items-center">
                                                                <span class="font-medium text-gray-700 group-hover:text-[#30b37f] transition-colors text-sm">
                                                                    {{ $subChapter->order_number }}. {{ $subChapter->title }}
                                                                </span>
                                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-gray-400 group-hover:text-[#30b37f] transition-colors" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                                                                </svg>
                                                            </div>
                                                        </a>
                                                    @endforeach
                                                </div>
                                            @endif
                                            
                                            <div class="mt-4 pt-3 border-t border-gray-200">
                                                <a href="{{ route('teacher.sub_chapters.index', ['chapter_id' => $chapter->id]) }}" class="text-xs font-semibold text-[#30b37f] hover:text-[#258c63]">
                                                    + Kelola Sub Judul
                                                </a>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            @endif
                        </div>
                    </div>
                @empty
                    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-12 text-center">
                        <div class="inline-flex items-center justify-center w-16 h-16 rounded-full bg-gray-50 mb-4">
                            <svg class="w-8 h-8 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                            </svg>
                        </div>
                        <h3 class="text-lg font-medium text-gray-900 mb-1">Belum ada Mata Pelajaran</h3>
                        <p class="text-gray-500 mb-6 text-sm">Anda belum ditugaskan untuk mengajar mata pelajaran apapun.</p>
                    </div>
                @endforelse
            </div>

        </div>
    </div>
</x-app-layout>
