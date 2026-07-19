<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center gap-4">
            <a href="{{ route('teacher.attempts.index') }}" class="text-gray-500 hover:text-gray-700 transition-colors">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
            </a>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Penilaian Detail') }}
            </h2>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-8 border border-gray-100 p-6 flex items-center justify-between">
                <div class="flex items-center">
                    @if($attempt->student->avatar)
                        <img class="h-12 w-12 rounded-full mr-4 object-cover" src="{{ Storage::url($attempt->student->avatar) }}" alt="">
                    @else
                        <div class="h-12 w-12 rounded-full bg-emerald-100 text-[#44936d] flex items-center justify-center font-bold text-xl mr-4">
                            {{ substr($attempt->student->name, 0, 1) }}
                        </div>
                    @endif
                    <div>
                        <h3 class="text-xl font-bold text-gray-900">{{ $attempt->student->name }}</h3>
                        <p class="text-sm text-gray-500">{{ $attempt->student->student_code }} • Kelas {{ $attempt->quiz->subChapter->chapter->subject->schoolClass->name ?? '-' }}</p>
                    </div>
                </div>
                <div class="text-right">
                    <p class="text-sm text-gray-500 font-semibold mb-1">Status Kuis</p>
                    @if($attempt->score === null)
                        <span class="px-3 py-1 inline-flex text-sm leading-5 font-bold rounded-full bg-yellow-100 text-yellow-800">Menunggu Penilaian</span>
                    @elseif($attempt->is_passed)
                        <span class="px-3 py-1 inline-flex text-sm leading-5 font-bold rounded-full bg-green-100 text-green-800">Lulus ({{ $attempt->score }}/100)</span>
                    @else
                        <span class="px-3 py-1 inline-flex text-sm leading-5 font-bold rounded-full bg-red-100 text-red-800">Gagal ({{ $attempt->score }}/100)</span>
                    @endif
                </div>
            </div>

            <form action="{{ route('teacher.attempts.grade', $attempt->id) }}" method="POST">
                @csrf
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-8 border border-gray-100">
                    <div class="p-6 bg-gray-50 border-b border-gray-200">
                        <h3 class="text-lg font-bold text-gray-800">Jawaban Siswa & Penilaian per Soal</h3>
                        <p class="text-sm text-gray-500 mt-1">{{ $attempt->quiz->title }}</p>
                    </div>
                
                <div class="p-6 space-y-8">
                    @forelse($attempt->answers as $index => $answer)
                        <div class="pb-6 {{ !$loop->last ? 'border-b border-gray-100' : '' }}">
                            <div class="flex gap-3 mb-4">
                                <span class="bg-gray-100 text-gray-600 w-8 h-8 rounded-full flex items-center justify-center shrink-0 font-bold">{{ $index + 1 }}</span>
                                <div class="pt-1">
                                    <h4 class="font-semibold text-gray-900 whitespace-pre-line">{{ $answer->question->question }}</h4>
                                    <span class="inline-block mt-2 px-2 py-1 bg-blue-50 text-blue-700 text-xs rounded-md font-medium">
                                        {{ $answer->question->question_type == 'multiple_choice' ? 'Pilihan Ganda' : ($answer->question->question_type == 'essay' ? 'Esai' : 'Benar / Salah') }}
                                    </span>
                                </div>
                            </div>
                            
                            <div class="ml-11">
                                <p class="text-sm text-gray-500 font-medium mb-2">Jawaban Siswa:</p>
                                @if($answer->question->question_type === 'essay')
                                    <div class="bg-gray-50 p-4 rounded-xl border border-gray-200 whitespace-pre-line text-gray-800">
                                        {{ $answer->answer_text ?: '(Tidak diisi)' }}
                                    </div>
                                @else
                                    @php
                                        // For multiple choice / true_false, the answer_text stores the selected option ID.
                                        $selectedOption = $answer->question->options->where('id', $answer->answer_text)->first();
                                    @endphp
                                    <div class="flex items-center gap-2 mb-3">
                                        @if($selectedOption)
                                            <div class="px-4 py-2 rounded-xl border {{ $selectedOption->is_correct ? 'bg-green-50 border-green-200 text-green-800' : 'bg-red-50 border-red-200 text-red-800' }}">
                                                {{ $selectedOption->option_text }}
                                                @if($selectedOption->is_correct)
                                                    <span class="ml-2 font-bold text-green-600">✓ Benar</span>
                                                @else
                                                    <span class="ml-2 font-bold text-red-600">✗ Salah</span>
                                                @endif
                                            </div>
                                        @else
                                            <div class="bg-gray-50 p-3 rounded-xl border border-gray-200 text-gray-500 italic">
                                                Tidak menjawab
                                            </div>
                                        @endif
                                    </div>

                                    @if(!$selectedOption || !$selectedOption->is_correct)
                                        @php
                                            $correctOption = $answer->question->options->where('is_correct', true)->first();
                                        @endphp
                                        @if($correctOption)
                                            <p class="text-sm text-gray-500 font-medium mb-1 mt-3">Jawaban yang benar:</p>
                                            <div class="px-4 py-2 rounded-xl border bg-emerald-50 border-emerald-200 text-emerald-800 inline-block">
                                                {{ $correctOption->option_text }}
                                            </div>
                                        @endif
                                    @endif
                                @endif
                                </div>
                            </div>
                            
                            <!-- Penilaian Per Soal -->
                            <div class="ml-11 mt-6 bg-sky-50 p-4 rounded-xl border border-sky-100">
                                <p class="text-sm font-bold text-sky-900 mb-3">Penilaian Guru untuk Soal Ini:</p>
                                
                                <div class="flex items-center gap-4 mb-4">
                                    <label class="inline-flex items-center">
                                        <input type="radio" name="answers[{{ $answer->id }}][is_correct]" value="1" class="text-green-600 focus:ring-green-500" {{ $answer->is_correct === 1 ? 'checked' : '' }} required>
                                        <span class="ml-2 text-sm font-bold text-green-700">✅ Benar</span>
                                    </label>
                                    <label class="inline-flex items-center">
                                        <input type="radio" name="answers[{{ $answer->id }}][is_correct]" value="0" class="text-red-600 focus:ring-red-500" {{ $answer->is_correct === 0 ? 'checked' : '' }} required>
                                        <span class="ml-2 text-sm font-bold text-red-700">❌ Salah</span>
                                    </label>
                                </div>

                                <textarea name="answers[{{ $answer->id }}][teacher_note]" rows="2" class="w-full text-sm border-gray-300 rounded-lg shadow-sm focus:ring-[#44936d] focus:border-[#44936d]" placeholder="Tulis catatan/koreksi khusus untuk soal ini (Opsional)...">{{ $answer->teacher_note }}</textarea>
                            </div>
                        </div>
                    @empty
                        <div class="text-center py-8 text-gray-500">
                            Tidak ada data jawaban yang tersimpan (Siswa mengisi kuis sebelum fitur ini diperbarui).
                        </div>
                    @endforelse
                </div>
            </div>

            <!-- Grading Form -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg border border-[#44936d]/30">
                    <div class="p-6 bg-emerald-50 border-b border-emerald-100 flex items-center gap-3">
                        <div class="w-10 h-10 rounded-full bg-white flex items-center justify-center text-xl shadow-sm">✍️</div>
                        <div>
                            <h3 class="text-lg font-bold text-emerald-900">Penilaian Guru</h3>
                            <p class="text-sm text-emerald-700">Berikan nilai akhir dan catatan/koreksi untuk siswa.</p>
                        </div>
                    </div>
                    
                    <div class="p-6 md:p-8 space-y-6">
                        <div>
                            <label for="score" class="block text-sm font-bold text-gray-700 mb-2">Nilai Akhir (0 - 100)</label>
                            <input type="number" id="score" name="score" value="{{ old('score', $attempt->score ?? 0) }}" min="0" max="100" class="w-full md:w-32 border-gray-300 rounded-lg shadow-sm focus:ring-[#44936d] focus:border-[#44936d] font-bold text-lg text-center" required>
                            <p class="mt-2 text-sm text-gray-500">Batas Lulus Kuis: {{ $attempt->quiz->passing_score }}</p>
                        </div>

                        <div>
                            <label for="feedback" class="block text-sm font-bold text-gray-700 mb-2">Catatan / Koreksi (Opsional)</label>
                            <textarea id="feedback" name="feedback" rows="5" class="w-full border-gray-300 rounded-xl shadow-sm focus:ring-[#44936d] focus:border-[#44936d]" placeholder="Tuliskan catatan Anda di sini... (Misal: Jawaban esai nomor 2 kurang tepat karena...)">{{ old('feedback', $attempt->feedback) }}</textarea>
                            <p class="mt-2 text-sm text-gray-500">Catatan ini akan muncul di layar kuis milik siswa.</p>
                        </div>

                        <div class="pt-4 border-t border-gray-100 flex justify-end gap-3">
                            <a href="{{ route('teacher.attempts.index') }}" class="px-6 py-3 border border-gray-300 shadow-sm text-sm font-medium rounded-xl text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#44936d]">
                                Batal
                            </a>
                            <button type="submit" class="px-6 py-3 border border-transparent text-sm font-medium rounded-xl shadow-sm text-white bg-[#44936d] hover:bg-[#2b6b4e] focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#44936d]">
                                Simpan Penilaian
                            </button>
                        </div>
                    </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
