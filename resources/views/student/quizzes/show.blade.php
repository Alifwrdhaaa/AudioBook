<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kuis: {{ $quiz->title }} - Belajar Online</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-50 font-sans text-gray-800 antialiased min-h-screen flex flex-col">
    
    <div class="w-full border-b border-gray-200 bg-white sticky top-0 z-50 shadow-sm">
        <div class="max-w-4xl mx-auto px-4 h-16 flex items-center justify-between">
            <a href="{{ route('student.subjects.show', $quiz->subChapter->chapter->subject_id) }}" class="text-gray-400 hover:text-gray-600 transition-colors flex items-center gap-2 font-medium">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                Kembali
            </a>
            <div class="font-bold text-gray-700">{{ $quiz->title }}</div>
            <div class="text-duo-yellow-dark font-bold flex items-center gap-1">
                <span>🔥</span> {{ $student->streak ?? 0 }}
            </div>
        </div>
    </div>

    <!-- Main Content Area -->
    <main class="flex-1 max-w-4xl mx-auto w-full px-4 py-8 flex flex-col">
        
        <div class="text-center mb-10">
            <div class="inline-block bg-white px-6 py-2 rounded-full border-4 border-amber-300 shadow-sm mb-4 transform rotate-2">
                <span class="text-xl font-bold text-amber-600">Kuis Petualangan 🏆</span>
            </div>
            <h1 class="text-4xl md:text-5xl font-black text-gray-800 tracking-tight mb-4">{{ $quiz->title }}</h1>
            <p class="text-2xl text-gray-600 font-bold max-w-2xl mx-auto">{{ $quiz->description }}</p>
        </div>

        <div class="flex flex-wrap justify-center gap-6 text-lg font-black mb-10">
            <span class="bg-blue-100 text-blue-700 px-6 py-3 rounded-[2rem] border-4 border-blue-200 shadow-sm">🎯 Target Lulus: {{ $quiz->passing_score }}</span>
            <span class="bg-emerald-100 text-emerald-700 px-6 py-3 rounded-[2rem] border-4 border-emerald-200 shadow-sm">❓ {{ $quiz->questions->count() }} Pertanyaan</span>
        </div>

        @if(isset($existingAttempt))
            <div class="bg-white rounded-[3rem] p-8 md:p-12 shadow-[0_8px_0_0_#e5e7eb] border-8 {{ $existingAttempt->score === null ? 'border-yellow-200 bg-yellow-50' : ($existingAttempt->is_passed ? 'border-emerald-200 bg-emerald-50' : 'border-rose-200 bg-rose-50') }} mb-12 relative overflow-hidden">
                <div class="absolute -top-6 -right-6 text-8xl opacity-30 transform rotate-12">📝</div>
                <h2 class="text-3xl font-black text-gray-900 mb-6 relative z-10">Hasil Petualanganmu!</h2>
                
                <div class="flex flex-col md:flex-row items-center gap-8 mb-8 relative z-10">
                    @if($existingAttempt->score === null)
                        <div class="text-7xl animate-pulse">⏳</div>
                        <div class="text-center md:text-left">
                            <h3 class="text-2xl font-black text-yellow-800 mb-2">Tunggu Penilaian Guru Ya!</h3>
                            <p class="text-lg text-yellow-700 font-bold">Jawaban hebatmu sudah terkirim. Guru akan segera memberikan nilai.</p>
                        </div>
                    @else
                        <div class="text-8xl">{{ $existingAttempt->is_passed ? '🎉' : '😔' }}</div>
                        <div class="text-center md:text-left">
                            <h3 class="text-3xl font-black {{ $existingAttempt->is_passed ? 'text-emerald-800' : 'text-rose-800' }} mb-2">
                                Nilai Kamu: <span class="text-5xl">{{ $existingAttempt->score }}</span> / 100
                            </h3>
                            <p class="text-xl font-bold {{ $existingAttempt->is_passed ? 'text-emerald-700' : 'text-rose-700' }}">
                                {{ $existingAttempt->is_passed ? 'Wah, luar biasa! Kamu lulus kuis ini.' : 'Jangan menyerah! Coba lagi dan pasti bisa.' }}
                            </p>
                        </div>
                    @endif
                </div>

                @if($existingAttempt->feedback)
                    <div class="bg-white rounded-3xl p-6 border-4 border-amber-300 mt-6 shadow-sm relative z-10">
                        <h4 class="text-xl font-black text-amber-900 mb-3 flex items-center gap-3">
                            <span class="text-3xl">💌</span> Surat dari Guru:
                        </h4>
                        <p class="text-gray-800 text-lg font-bold whitespace-pre-line leading-relaxed">{{ $existingAttempt->feedback }}</p>
                    </div>
                @endif
            </div>
            
            <div class="space-y-10">
                <h3 class="text-3xl font-black text-gray-800 border-b-4 border-gray-100 pb-4">Jejak Jawabanmu 🐾</h3>
                @forelse($existingAttempt->answers as $index => $answer)
                    <div class="bg-white rounded-[2rem] p-8 md:p-10 shadow-[0_6px_0_0_#e5e7eb] border-4 border-gray-100 opacity-90">
                        <h3 class="text-2xl font-black text-gray-800 mb-8 flex gap-4 items-start">
                            <span class="bg-[#1cb0f6] text-white w-12 h-12 rounded-full flex items-center justify-center shrink-0 shadow-[0_4px_0_0_#1899d6]">{{ $index + 1 }}</span>
                            <div class="whitespace-pre-line pt-1 leading-relaxed">{{ $answer->question->question }}</div>
                        </h3>
                        
                        <div class="space-y-4 pl-16">
                            <p class="text-lg text-gray-500 font-black mb-2">Jawaban Kamu:</p>
                            @if($answer->question->question_type === 'essay')
                                <div class="bg-sky-50 p-6 rounded-2xl border-4 border-sky-100 whitespace-pre-line text-gray-800 text-xl font-bold">
                                    {{ $answer->answer_text ?: '(Kosong - Wah lupa diisi ya?)' }}
                                </div>
                                @if($existingAttempt->score !== null && $answer->is_correct !== null)
                                    <div class="mt-4 px-6 py-4 rounded-2xl border-4 {{ $answer->is_correct ? 'border-emerald-300 bg-emerald-50 text-emerald-800' : 'border-rose-300 bg-rose-50 text-rose-800' }} text-xl font-bold flex items-center gap-3">
                                        @if($answer->is_correct)
                                            <span class="text-3xl">✅</span> Benar!
                                        @else
                                            <span class="text-3xl">❌</span> Kurang Tepat
                                        @endif
                                    </div>
                                @endif
                            @else
                                @php
                                    $selectedOption = $answer->question->options->where('id', $answer->answer_text)->first();
                                @endphp
                                @if($selectedOption)
                                    <div class="px-6 py-4 rounded-2xl border-4 {{ $existingAttempt->score !== null ? ($answer->is_correct ? 'border-emerald-300 bg-emerald-50' : 'border-rose-300 bg-rose-50') : 'border-sky-300 bg-sky-50' }} text-gray-800 text-xl font-bold flex items-center justify-between">
                                        <span>{{ $selectedOption->option_text }}</span>
                                        @if($existingAttempt->score !== null && $answer->is_correct !== null)
                                            @if($answer->is_correct)
                                                <span class="ml-4 font-black text-emerald-600 text-2xl flex items-center gap-2"><span class="text-3xl">✅</span> Benar!</span>
                                            @else
                                                <span class="ml-4 font-black text-rose-600 text-2xl flex items-center gap-2"><span class="text-3xl">❌</span> Kurang Tepat</span>
                                            @endif
                                        @endif
                                    </div>
                                @else
                                    <div class="px-6 py-4 rounded-2xl border-4 border-gray-200 bg-gray-50 text-gray-500 italic text-xl font-bold">
                                        Kamu belum memilih jawaban 🙈
                                    </div>
                                @endif
                                
                                @if($existingAttempt->score !== null && $answer->is_correct === 0)
                                    @php
                                        $correctOption = $answer->question->options->where('is_correct', true)->first();
                                    @endphp
                                    @if($correctOption)
                                        <div class="mt-4 p-4 bg-emerald-50 rounded-xl border-2 border-emerald-200 flex items-center gap-3">
                                            <span class="text-2xl">💡</span>
                                            <span class="text-emerald-800 font-black text-lg">Kunci Jawaban: </span>
                                            <span class="text-emerald-900 font-bold text-lg">{{ $correctOption->option_text }}</span>
                                        </div>
                                    @endif
                                @endif
                            @endif

                            @if($existingAttempt->score !== null && $answer->teacher_note)
                                <div class="mt-6 bg-amber-50 p-6 rounded-2xl border-4 border-amber-200 shadow-sm relative">
                                    <div class="absolute -top-4 -left-4 text-4xl">🧑‍🏫</div>
                                    <p class="text-amber-900 font-black text-lg mb-2 pl-6">Pesan dari Guru untuk soal ini:</p>
                                    <p class="text-amber-800 text-lg font-bold pl-6">{{ $answer->teacher_note }}</p>
                                </div>
                            @endif
                        </div>
                    </div>
                @empty
                    <div class="bg-white rounded-3xl p-12 text-center shadow-[0_6px_0_0_#e5e7eb] border-4 border-gray-100">
                        <div class="text-6xl mb-4">👻</div>
                        <p class="text-xl font-black text-gray-500">Kuis ini kosong, tidak ada jejak jawaban.</p>
                    </div>
                @endforelse
                
                <div class="pt-8 flex justify-center pb-12">
                    <a href="{{ route('student.subjects.show', $quiz->subChapter->chapter->subject_id) }}" class="px-10 py-5 bg-[#1cb0f6] text-white rounded-[2rem] font-black tracking-widest uppercase shadow-[0_8px_0_0_#1899d6] hover:bg-[#1fbfff] active:shadow-[0_0px_0_0_#1899d6] active:translate-y-[8px] transition-all text-xl">
                        KEMBALI KE PETA
                    </a>
                </div>
            </div>
        @else
            <form action="{{ route('student.quizzes.store', $quiz) }}" method="POST" class="space-y-10">
                @csrf
                
                @forelse($quiz->questions as $index => $question)
                    <div class="bg-white rounded-[2rem] p-8 md:p-10 shadow-[0_6px_0_0_#e5e7eb] border-4 border-gray-100">
                        <h3 class="text-2xl font-black text-gray-800 mb-8 flex gap-4 items-start">
                            <span class="bg-[#ff9600] text-white w-12 h-12 rounded-full flex items-center justify-center shrink-0 shadow-[0_4px_0_0_#cc7800]">{{ $index + 1 }}</span>
                            <div class="whitespace-pre-line pt-1 leading-relaxed">{{ $question->question }}</div>
                        </h3>
                        
                        <div class="space-y-4 pl-0 md:pl-16">
                            @if($question->question_type === 'essay')
                                <textarea name="q_{{ $question->id }}" rows="5" class="w-full p-6 text-xl font-bold rounded-3xl border-4 border-gray-200 focus:border-[#1cb0f6] focus:ring-0 transition-all bg-sky-50" placeholder="Ketik jawaban cerdasmu di sini..." required></textarea>
                            @else
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                @foreach($question->options as $option)
                                    <label class="block relative cursor-pointer group">
                                        <input type="radio" name="q_{{ $question->id }}" value="{{ $option->id }}" required class="peer sr-only">
                                        <div class="w-full p-5 rounded-2xl border-4 border-gray-200 peer-checked:border-[#1cb0f6] peer-checked:bg-sky-100 transition-all hover:bg-gray-50 flex items-center gap-4 h-full">
                                            <div class="w-8 h-8 rounded-full border-4 border-gray-300 peer-checked:border-[#1cb0f6] peer-checked:bg-[#1cb0f6] flex-shrink-0 transition-all flex items-center justify-center">
                                                <div class="w-3 h-3 bg-white rounded-full opacity-0 peer-checked:opacity-100"></div>
                                            </div>
                                            <span class="text-gray-700 font-bold text-xl group-hover:text-gray-900 peer-checked:text-[#1cb0f6]">{{ $option->option_text }}</span>
                                        </div>
                                    </label>
                                @endforeach
                                </div>
                            @endif
                        </div>
                    </div>
                @empty
                    <div class="bg-white rounded-3xl p-12 text-center shadow-[0_6px_0_0_#e5e7eb] border-4 border-gray-100">
                        <div class="text-6xl mb-4">🛌</div>
                        <p class="text-xl font-black text-gray-500">Guru belum memberikan pertanyaan untuk kuis ini. Asyik!</p>
                    </div>
                @endforelse

                @if($quiz->questions->count() > 0)
                    <div class="pt-8 flex justify-center pb-16">
                        <button type="submit" class="w-full md:w-auto px-12 py-6 bg-[#58cc02] text-white rounded-[2rem] font-black uppercase tracking-widest text-2xl shadow-[0_8px_0_0_#46a302] hover:bg-[#61E002] active:shadow-[0_0px_0_0_#46a302] active:translate-y-[8px] transition-all flex items-center justify-center gap-3">
                            <span class="text-3xl">🚀</span> KIRIM JAWABAN!
                        </button>
                    </div>
                @endif
            </form>
        @endif

    </main>

</body>
</html>
