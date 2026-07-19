<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Kelola Soal Kuis: ') }} {{ $quiz->title }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            <div class="flex justify-between items-center mb-6">
                <a href="{{ route('teacher.materials.index', ['sub_chapter_id' => $quiz->subChapter->id]) }}" class="text-[#44936d] hover:text-emerald-900 font-semibold">
                    &larr; Kembali ke Materi Bab
                </a>
                
                <div x-data="{ open: false }" class="relative">
                    <button @click="open = !open" class="bg-[#44936d] hover:bg-[#2b6b4e] text-white font-bold py-2 px-4 rounded transition">
                        + Tambah Soal Baru
                    </button>
                    <!-- Dropdown menu -->
                    <div x-show="open" @click.away="open = false" class="absolute right-0 mt-2 w-48 bg-white rounded-md shadow-xl z-20" x-cloak>
                        <a href="{{ route('teacher.quiz_questions.create', ['quiz_id' => $quiz->id, 'type' => 'multiple_choice']) }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-[#44936d] hover:text-white">Pilihan Ganda</a>
                        <a href="{{ route('teacher.quiz_questions.create', ['quiz_id' => $quiz->id, 'type' => 'true_false']) }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-[#44936d] hover:text-white">Benar / Salah</a>
                        <a href="{{ route('teacher.quiz_questions.create', ['quiz_id' => $quiz->id, 'type' => 'essay']) }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-[#44936d] hover:text-white">Esai</a>
                    </div>
                </div>
            </div>

            @if(session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
                    <span class="block sm:inline">{{ session('success') }}</span>
                </div>
            @endif

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
                <div class="p-6 bg-gray-50 border-b border-gray-200 flex justify-between">
                    <div>
                        <h3 class="text-lg font-bold text-gray-800">Detail Kuis</h3>
                        <p class="text-sm text-gray-600">KKM: {{ $quiz->passing_score }} | Max Percobaan: {{ $quiz->max_attempt }}</p>
                    </div>
                    <div>
                        <a href="{{ route('teacher.quizzes.edit', $quiz) }}" class="text-[#44936d] hover:underline">Edit Pengaturan</a>
                    </div>
                </div>
            </div>

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h3 class="text-lg font-bold mb-4">Daftar Soal ({{ $quiz->questions->count() }})</h3>
                    
                    @if($quiz->questions->count() > 0)
                        <div class="space-y-6">
                            @foreach($quiz->questions as $index => $question)
                                <div class="p-4 border border-gray-200 rounded-lg">
                                    <div class="flex justify-between items-start mb-4">
                                        <div>
                                            <span class="font-bold mr-2">{{ $index + 1 }}.</span>
                                            <span class="text-gray-800 font-semibold whitespace-pre-line">{{ $question->question }}</span>
                                            <span class="ml-2 px-2 py-1 bg-gray-100 text-gray-600 text-xs rounded-full">{{ $question->question_type == 'multiple_choice' ? 'Pilihan Ganda' : ($question->question_type == 'essay' ? 'Esai' : 'Benar / Salah') }}</span>
                                        </div>
                                        <div class="flex space-x-2">
                                            <a href="{{ route('teacher.quiz_questions.edit', $question) }}" class="text-[#44936d] hover:text-emerald-900 text-sm">Edit</a>
                                            <form action="{{ route('teacher.quiz_questions.destroy', $question) }}" method="POST" onsubmit="return confirm('Hapus soal ini?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="text-red-600 hover:text-red-900 text-sm">Hapus</button>
                                            </form>
                                        </div>
                                    </div>
                                    
                                    <div class="pl-6 space-y-2">
                                        @foreach($question->options as $option)
                                            <div class="flex items-center">
                                                <div class="w-4 h-4 rounded-full border {{ $option->is_correct ? 'bg-green-500 border-green-500' : 'border-gray-300' }} mr-3"></div>
                                                <span class="{{ $option->is_correct ? 'font-bold text-green-700' : 'text-gray-600' }}">{{ $option->option_text }}</span>
                                                @if($option->is_correct)
                                                    <span class="ml-2 text-xs text-green-600">(Jawaban Benar)</span>
                                                @endif
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="text-center py-8">
                            <p class="text-gray-500 italic mb-4">Belum ada soal untuk kuis ini.</p>
                        </div>
                    @endif
                </div>
            </div>
            
        </div>
    </div>
</x-app-layout>
